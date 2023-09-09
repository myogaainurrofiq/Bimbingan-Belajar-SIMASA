<?php

namespace Modules\Kelas\Http\Controllers;

use App\Models\User;
use ErrorException;
use Illuminate\Http\Request;
use Modules\Kelas\Entities\Kelas;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Contracts\Support\Renderable;

class KelasController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $kelas = Kelas::with('mentor')->get();
        return view('kelas::kelas.index', compact('kelas'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        $mentor = User::where('role', 'Guru')->where('status', 'Aktif')->get();
        return view('kelas::kelas.create', compact('mentor'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        try {
            $kelas = new Kelas();
            $kelas->mapel       = $request->mapel;
            $kelas->mentor_id   = $request->mentor_id;
            $kelas->hari        = $request->hari;
            $kelas->jam_mulai   = $request->jam_mulai;
            $kelas->jam_selesai = $request->jam_selesai;
            $kelas->ruangan     = $request->ruangan;
            $kelas->desc        = $request->desc;
            $kelas->save();

            Session::flash('success', 'Kelas Berhasil di tambah.');
            return redirect('kelas');
        } catch (\ErrorException $e) {
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
        return view('kelas::kelas.show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        $kelas = Kelas::find($id);
        $mentor = User::where('role', 'Guru')->where('status', 'Aktif')->get();
        return view('kelas::kelas.edit', compact('kelas', 'mentor'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        try {
            $kelas = Kelas::find($id);
            $kelas->mapel       = $request->mapel;
            $kelas->mentor_id   = $request->mentor_id;
            $kelas->hari        = $request->hari;
            $kelas->jam_mulai   = $request->jam_mulai;
            $kelas->jam_selesai = $request->jam_selesai;
            $kelas->ruangan     = $request->ruangan;
            $kelas->desc        = $request->desc;
            $kelas->update();

            Session::flash('success', 'Kelas Berhasil di update.');
            return redirect('kelas');
        } catch (\ErrorException $e) {
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
