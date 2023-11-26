<?php

namespace Modules\Perpustakaan\Http\Controllers;

use ErrorException;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Session;
use Modules\Perpustakaan\Entities\Publisher;
use Modules\Perpustakaan\Http\Requests\PublisherRequest;

class PublisherController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $publisher = Publisher::all();
        return view('perpustakaan::backend.publisher.index', compact('publisher'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('perpustakaan::backend.publisher.create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(PublisherRequest $request)
    {
        try {
            Publisher::create([
                'name'    => $request->name,
                'address' => $request->address,
                'phone'   => $request->phone,
            ]);

            Session::flash('success', 'Penerbit Berhasil di tambah!');
            return redirect()->route('publisher.index');
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
        return view('perpustakaan::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        $data   = Publisher::find($id);
        return view('perpustakaan::backend.publisher.edit', compact('data'));
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
            $data = Publisher::find($id);
            $data->name     = $request->name;
            $data->address  = $request->address;
            $data->phone    = $request->phone;
            $data->update();

            Session::flash('success', 'Penerbit Berhasil di update!');
            return redirect()->route('publisher.index');
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
