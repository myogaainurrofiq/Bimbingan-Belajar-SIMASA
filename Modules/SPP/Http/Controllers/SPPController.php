<?php

namespace Modules\SPP\Http\Controllers;

use App\Helpers\GlobalHelpers;
use App\Models\User;
use Carbon\Carbon;
use ErrorException;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Modules\SPP\Entities\DetailPaymentSpp;
use Modules\SPP\Entities\PaymentSpp;

class SPPController extends Controller
{
    use GlobalHelpers;
    public function index()
    {
        return view('spp::index');
    }

    // Murid
    public function murid(Request $params)
    {
        $status = $params['status'];

        $getBln = Carbon::now()->format('F');
        $payment = User::with('payment')
            ->whereHas('payment', function ($a) use ($status, $getBln) {
                $a->when($status, function ($x) use ($status, $getBln) {
                    switch ($status) {
                        case 'paid':
                            if ($getBln == 'January') {
                                $x->where('January', 'paid');
                            } elseif ($getBln == 'February') {
                                $x->where('February', 'paid');
                            } elseif ($getBln == 'March') {
                                $x->where('March', 'paid');
                            } elseif ($getBln == 'April') {
                                $x->where('April', 'paid');
                            } elseif ($getBln == 'May') {
                                $x->where('May', 'paid');
                            } elseif ($getBln == 'June') {
                                $x->where('June', 'paid');
                            } elseif ($getBln == 'July') {
                                $x->where('July', 'paid');
                            } elseif ($getBln == 'August') {
                                $x->where('August', 'paid');
                            } elseif ($getBln == 'September') {
                                $x->where('September', 'paid');
                            } elseif ($getBln == 'October') {
                                $x->where('October', 'paid');
                            } elseif ($getBln == 'November') {
                                $x->where('November', 'paid');
                            } elseif ($getBln == 'December') {
                                $x->where('December', 'paid');
                            }
                            break;
                        case 'unpaid':
                            if ($getBln == 'January') {
                                $x->where('January', 'unpaid');
                            } elseif ($getBln == 'February') {
                                $x->where('February', 'unpaid');
                            } elseif ($getBln == 'March') {
                                $x->where('March', 'unpaid');
                            } elseif ($getBln == 'April') {
                                $x->where('April', 'unpaid');
                            } elseif ($getBln == 'May') {
                                $x->where('May', 'unpaid');
                            } elseif ($getBln == 'June') {
                                $x->where('June', 'unpaid');
                            } elseif ($getBln == 'July') {
                                $x->where('July', 'unpaid');
                            } elseif ($getBln == 'August') {
                                $x->where('August', 'unpaid');
                            } elseif ($getBln == 'September') {
                                $x->where('September', 'unpaid');
                            } elseif ($getBln == 'October') {
                                $x->where('October', 'unpaid');
                            } elseif ($getBln == 'November') {
                                $x->where('November', 'unpaid');
                            } elseif ($getBln == 'December') {
                                $x->where('December', 'unpaid');
                            }
                            break;
                            $x->where('year', date('Y'));
                    }
                });
            })
            ->where('role', 'Murid')
            ->get();
        return view('spp::murid.index', compact('payment'));
    }

    // Detail Pembayaran
    public function detail($id)
    {
        $payment = PaymentSpp::with('detailPayment.aprroveBy', 'user.muridDetail')->findOrFail($id);
        // return $payment;
        return view('spp::murid.show', compact('payment'));
    }

    // Update Pembayaran
    public function updatePembayaran(Request $request)
    {
        try {
            DB::beginTransaction();

            $payment = DetailPaymentSpp::find($request->id_payment);
            $payment->status        = 'paid';
            $payment->approve_by    = Auth::id();
            $payment->approve_date  = Carbon::now();
            $payment->update();

            // Update Payment
            $pay = PaymentSpp::find($payment->payment_id);
            if ($payment->month == 'January') {
                $pay->January = 'paid';
            } elseif ($payment->month == 'February') {
                $pay->February = 'paid';
            } elseif ($payment->month == 'March') {
                $pay->March = 'paid';
            } elseif ($payment->month == 'April') {
                $pay->April = 'paid';
            } elseif ($payment->month == 'May') {
                $pay->May = 'paid';
            } elseif ($payment->month == 'June') {
                $pay->June = 'paid';
            } elseif ($payment->month == 'July') {
                $pay->July = 'paid';
            } elseif ($payment->month == 'August') {
                $payment->August = 'paid';
            } elseif ($payment->month == 'September') {
                $pay->September = 'paid';
            } elseif ($payment->month == 'October') {
                $pay->October = 'paid';
            } elseif ($payment->month == 'November') {
                $pay->November = 'paid';
            } elseif ($payment->month == 'December') {
                $pay->December = 'paid';
            }
            $pay->update();

            DB::commit();
            Session::flash('success', 'Pembayaran Berhasil Dikonfirmasi.');
            return $payment;
        } catch (\ErrorException $e) {
            DB::rollback();
            throw new ErrorException($e->getMessage());
        }
    }
}
