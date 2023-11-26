<?php

namespace Modules\Perpustakaan\Http\Controllers;

use ErrorException;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Session;
use Modules\Perpustakaan\Entities\Category;
use Modules\Perpustakaan\Http\Requests\CategoryRequest;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $kategori = Category::all();
        return view('perpustakaan::backend.category.index', compact('kategori'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('perpustakaan::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(CategoryRequest $request)
    {
        try {
            Category::create([
                'name'  => $request->name
            ]);
            Session::flash('success', 'Kategori berhasil di tambah.');
            return redirect()->route('kategori.index');
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
        $data = Category::find($id);
        $kategori = Category::all();
        return view('perpustakaan::backend.category.edit', compact('data', 'kategori'));
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
            $data = Category::find($id);
            $data->name  = $request->name;
            $data->update();

            Session::flash('success', 'Kategori berhasil di update.');
            return redirect()->route('kategori.index');
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
