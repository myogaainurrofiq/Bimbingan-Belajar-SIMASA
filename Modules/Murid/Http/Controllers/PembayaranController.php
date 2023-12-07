<?php

namespace Modules\Murid\Http\Controllers;

use App\Models\Bank;
use App\Models\MasterPayment;
use App\Models\User;
use Carbon\Carbon;
use ErrorException;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Modules\Murid\Http\Requests\ConfirmPaymentRequest;
use Modules\SPP\Entities\DetailPaymentSpp;
use Modules\SPP\Entities\PaymentSpp;

class PembayaranController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $cek = false;
        $payment = DetailPaymentSpp::with('payment')->where('user_id', Auth::id())->get();
        $getBln = Carbon::now()->format('F');
        $monthNow = Carbon::now()->format('F');
        $cekPayment = PaymentSpp::where('user_id', Auth::id())->first();
        $data = $cekPayment->$monthNow;
        return view('murid::pembayaran.index', compact('payment', 'cek', 'cekPayment', 'data'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        $accountbanks = User::with('banks')->first();
        $bank = Bank::all();
        $getBln = Carbon::now()->format('F');
        $biaya = MasterPayment::where('user_id', Auth::id())->orderBy('created_at', 'desc')->first();
        if (!$biaya) {
            Session::flash('error', 'Biaya belum ditentukan, silahkan hubungi Admin.');
            return redirect('home');
        }
        return view('murid::pembayaran.tambah_pembayaran', compact('accountbanks', 'bank', 'getBln', 'biaya'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        try {
            DB::beginTransaction();
            $cekPayment = PaymentSpp::where('user_id', Auth::id())->where('year', date('Y'))->first();
            $getBln = Carbon::now()->format('F');
            $biaya = MasterPayment::where('user_id', Auth::id())->first();

            if (!$cekPayment) {
                $payment = PaymentSpp::create([
                    'user_id'   => Auth::id(),
                    'year'      => date('Y'),
                    'is_active' =>  1
                ]);
            }
            if ($getBln == 'January') {
                $cekPayment->January = 'pending';
            } elseif ($getBln == 'February') {
                $cekPayment->February = 'pending';
            } elseif ($getBln == 'March') {
                $cekPayment->March = 'pending';
            } elseif ($getBln == 'April') {
                $cekPayment->April = 'pending';
            } elseif ($getBln == 'May') {
                $cekPayment->May = 'pending';
            } elseif ($getBln == 'June') {
                $cekPayment->June = 'pending';
            } elseif ($getBln == 'July') {
                $cekPayment->July = 'pending';
            } elseif ($getBln == 'August') {
                $cekPayment->August = 'pending';
            } elseif ($getBln == 'September') {
                $cekPayment->September = 'pending';
            } elseif ($getBln == 'October') {
                $cekPayment->October = 'pending';
            } elseif ($getBln == 'November') {
                $cekPayment->November = 'pending';
            } elseif ($getBln == 'December') {
                $cekPayment->December = 'pending';
            }
            $cekPayment->update();

            if ($request->file) {
                $file = $request->file('file');
                $file_payment = 'payment-' . time() . Auth::id() . "." . $file->getClientOriginalExtension();
                // isi dengan nama folder tempat kemana file diupload
                $tujuan_upload = 'public/images/bukti_payment';
                $file->storeAs($tujuan_upload, $file_payment);
            }

            DetailPaymentSpp::create([
                'payment_id'        => $cekPayment ? $cekPayment->id : $payment->id,
                'user_id'           => Auth::id(),
                'sender'            => $request->sender,
                'bank_sender'       => $request->bank_sender,
                'destination_bank'  => $request->destination_bank,
                'month'             => $getBln,
                'status'            => 'unpaid',
                'amount'            => $biaya->biaya,
                'file'              => $file_payment,
                'date_file'         => Carbon::now()
            ]);
            DB::commit();
            Session::flash('success', 'Pembayaran Berhasil dikirim,');
            return redirect('murid/pembayaran');
        } catch (\ErrorException $e) {
            DB::rollBack();
            throw new ErrorException($e->getMessage());
        }
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('murid::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        $payment = DetailPaymentSpp::with('user.muridDetail')->where('user_id', Auth::id())->findOrFail($id);
        $accountbanks = User::with('banks')->first();
        $bank = Bank::all();

        if ($payment->status == 'paid') {
            Session::flash('error', 'Pembayaran Sudah Diterima.');
            return redirect('murid/pembayaran');
        }
        return view('murid::pembayaran.edit', compact('payment', 'accountbanks', 'bank'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(ConfirmPaymentRequest $request, $id)
    {
        try {
            DB::beginTransaction();

            if ($request->file) {
                $file = $request->file('file');
                $file_payment = 'payment-' . time() . Auth::id() . "." . $file->getClientOriginalExtension();
                // isi dengan nama folder tempat kemana file diupload
                $tujuan_upload = 'public/images/bukti_payment';
                $file->storeAs($tujuan_upload, $file_payment);
            }

            $payment = DetailPaymentSpp::where('user_id', Auth::id())->findOrFail($id);
            $payment->file              = $file_payment ?? $payment->file;
            $payment->date_file         = $request->date_file;
            $payment->sender            = $request->sender;
            $payment->bank_sender       = $request->bank_sender;
            $payment->destination_bank  = $request->destination_bank;
            $payment->update();

            DB::commit();
            Session::flash('success', 'Pembayaran Berhasil dikirim,');
            return redirect('murid/pembayaran');
        } catch (\ErrorException $e) {
            DB::rollBack();
            throw new ErrorException($e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        //
    }
}
