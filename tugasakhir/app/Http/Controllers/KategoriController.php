<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kategori;

class KategoriController extends Controller
{
    public function index()
    {
        $kategori = Kategori::get();

        if(session('is_logged_in')){
            if(session('is_admin')){
                // Render view with data
                return view('dashboard.kategori.index', ['kategori' => $kategori]);
            }else{
                return view('forbidden');
            }
        }else{
            return view('adminlogin.index');
        }
    }

    public function create()
    {
        // Get ID kategori
        $get_id_kategori=DB::select('SELECT id_kategori FROM kategoris ORDER BY LENGTH(id_kategori) DESC, id_kategori DESC LIMIT 1');
        if(!empty($get_id_kategori)){
            $id_kategori=(int)substr($get_id_kategori[0]->id_kategori,2)+(int)1;
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
        if(session('is_logged_in')){
            if(session('is_admin')){
                // Render view with data
                return view('dashboard.kategori.edit', compact('kategori'));
            }else{
                return view('forbidden');
            }
        }else{
            return view('forbidden');
        }
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
