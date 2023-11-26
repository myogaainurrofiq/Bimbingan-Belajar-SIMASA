<?php

namespace App\Http\Controllers\Backend\Pengguna;

use ErrorException;
use App\Models\User;
use App\Models\dataMurid;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\MasterPayment;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Modules\SPP\Entities\DetailPaymentSpp;

class MuridController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $murid = User::whereIn('role', ['Guest', 'Murid'])->get();
        return view('backend.pengguna.murid.index', compact('murid'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.pengguna.murid.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            DB::beginTransaction();

            $validator = Validator::make(
                $request->all(),
                [
                    'name'      => 'required|max:255',
                    'email'     => 'required|email|unique:users',
                    'biaya'     => 'required|numeric'
                ],
                [
                    'name.required'     => 'Nama tidak boleh kosong.',
                    'email.required'    => 'Email tidak boleh kosong.',
                    'email.unique'      => 'Email sudah pernah digunakan.',
                    'email.email'       => 'Email yang dimasukan tidak valid.',
                    'biaya.required'    => 'Nominal Biaya Pembayaran tidak boleh kosong.',
                    'biaya.numeric'     => 'Nominal Biaya Pembayaran tidak valid.'
                ]
            );

            if ($validator->fails()) {
                return redirect()->back()
                    ->withErrors($validator)
                    ->withInput();
            }

            $errors = $validator->errors();

            if ($request->foto_profile) {
                $image = $request->file('foto_profile');
                $nama_img = time() . "_" . $image->getClientOriginalName();
                // isi dengan nama folder tempat kemana file diupload
                $tujuan_upload = 'public/images/profile';
                $image->storeAs($tujuan_upload, $nama_img);
            }

            // Pilih kalimat
            $kalimatKe  = "1";
            $username   = implode(" ", array_slice(explode(" ", $request->name), 0, $kalimatKe)); // ambil kalimat

            $murid = new User();
            $murid->name            = $request->name;
            $murid->username        = $username;
            $murid->email           = $request->email;
            $murid->role            = 'Guest';
            $murid->foto_profile    = $nama_img ?? '';
            $murid->password        = bcrypt($request->password);
            $murid->save();

            if ($murid) {
                $detail = new dataMurid();
                $detail->user_id    = $murid->id;
                $detail->save();
            }

            $murid->assignRole($murid->role);

            // Setting biaya murid
            MasterPayment::updateOrCreate([
                'user_id'   => $murid->id,
                'biaya'     => $request->biaya
            ]);

            DB::commit();
            Session::flash('success', 'Calon Murid Berhasil disimpan !');
            return redirect()->route('backend-pengguna-murid.index');
        } catch (ErrorException $e) {
            DB::rollback();
            throw new ErrorException($e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $murid = User::with('masterBiaya', 'payment')->whereIn('role', ['Guest', 'Murid'])->find($id);
        return view('backend.pengguna.murid.edit', compact('murid'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            DB::beginTransaction();

            $validator = Validator::make(
                $request->all(),
                [
                    'name'      => 'required|max:255',
                    'email'     => 'required',
                    'status'    => ['required', Rule::in(['Aktif', 'Tidak Aktif'])],
                    'role'      => ['required', Rule::in(['Murid', 'Guest'])],
                    'biaya'     => 'required|numeric'
                ],
                [
                    'name.required'     => 'Nama tidak boleh kosong.',
                    'email.required'    => 'Email tidak boleh kosong.',
                    'email.email'       => 'Email yang dimasukan tidak valid.',
                    'status.required'   => 'Status Murid harus dipilih.',
                    'status.in'         => 'Status yang dipilih tidak valid.',
                    'role.required'     => 'Role Murid harus dipilih.',
                    'role.in'           => 'Role yang dipilih tidak valid.',
                    'biaya.required'    => 'Nominal Biaya Pembayaran tidak boleh kosong.',
                    'biaya.numeric'     => 'Nominal Biaya Pembayaran tidak valid.'
                ]
            );

            if ($validator->fails()) {
                return redirect()->back()
                    ->withErrors($validator)
                    ->withInput();
            }

            $errors = $validator->errors();

            $murid = User::find($id);
            $murid->name            = $request->name;
            $murid->email           = $request->email;
            $murid->role            = $request->role;
            $murid->status          = $request->status;
            $murid->update();

            DB::table('model_has_roles')->where('model_id', $id)->delete();
            $murid->assignRole($request->role);

            // Setting biaya murid
            MasterPayment::updateOrCreate([
                'user_id'   => $murid->id,
                'biaya'     => $request->biaya
            ]);

            $detailPay = DetailPaymentSpp::where('user_id', $murid->id)->where('status', 'unpaid')->first();
            if($detailPay !== null){
                if($detailPay->status === 'unpaid'){
                    $detailPay->amount  =   $request->biaya;
                    $detailPay->update();
                }else{
                    Session::flash('error','Tidak dapat mengganti nominal pada murid yang sudah membayar!');
                }
            }

            DB::commit();
            Session::flash('success', 'Data Murid Berhasil diupdate !');
            return redirect()->route('backend-pengguna-murid.index');
        } catch (ErrorException $e) {
            DB::rollback();
            throw new ErrorException($e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
