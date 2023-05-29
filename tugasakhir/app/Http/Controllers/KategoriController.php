<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kategori;

class KategoriController extends Controller
{
    public function index()
    {
        $kategori = Kategori::get();

        return view('dashboard.kategori.index', ['kategori' => $kategori]);
    }

    public function create()
    {
        // Get ID kategori
        $get_id_kategori=Kategori::orderBy('id_kategori', 'DESC')->first();
        if(!empty($get_id_kategori)){
            $id_kategori=(int)substr($get_id_kategori->id_kategori,2)+(int)1;
        }else{
            $id_kategori=1;
        }

        return view('dashboard.kategori.create', compact('id_kategori'));
    }

    public function store(Request $request)
    {

        Kategori::create([
            'id_kategori'=> $request->id_kategori,
            'nama_kategori'=> $request->nama_kategori

        ]);

        return redirect()->route('kategori.index')->with(['success' => 'Data Berhasil Disimpan!']);
    }

    public function edit(Kategori $kategori)
    {
        return view('dashboard.kategori.edit', compact('kategori'));
    }

    public function update(Request $request, Kategori $kategori)
    {
        //validate form
        $this->validate($request, [
            'id_kategori'=>'required',
            'nama_kategori'=>'required',
        ]);
        $kategori->update([
            'nama_kategori'=>$request->nama_kategori,
           
        ]);
        //redirect to index
        return redirect()->route('kategori.index')->with(['success' => 'Data Berhasil Diubah!']);
    }

    public function destroy(Kategori $kategori)
    {
        //delete post
        $kategori->delete();

        //redirect to index
        return redirect()->route('kategori.index')->with(['success' => 'Data Berhasil Dihapus!']);
    }
}
