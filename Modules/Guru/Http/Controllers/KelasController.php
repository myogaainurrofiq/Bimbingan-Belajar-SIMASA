<?php

namespace Modules\Guru\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Modules\Kelas\Entities\Kelas;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Modules\Kelas\Entities\KelasMurid;
use Illuminate\Contracts\Support\Renderable;

class KelasController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $kelas = Kelas::with('mentor')->where('mentor_id', Auth::id())->get();
        return view('guru::kelas.index', compact('kelas'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('guru::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        $kelas = Kelas::find($id);
        $murid = User::whereDoesntHave('kelasMurid')
            ->where('Role', 'Murid')->where('status', 'Aktif')->get();
        $kelasAll = KelasMurid::with('murid', 'kelas.mentor')
            ->where('kelas_id', $id)->get();
        return view('guru::kelas.show', compact('kelas', 'murid', 'kelasAll'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('guru::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        //
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
