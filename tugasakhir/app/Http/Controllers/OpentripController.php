<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Opentrip;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class OpentripController extends Controller
{
    public function index()
    {
        //get posts
        $opentrip = Opentrip::latest()->simplePaginate(5);
        $navbar = 'active';

        if(session('is_logged_in')){
            if(session('is_admin')){
                //render view with posts
                return view('dashboard.opentrip.index', compact('opentrip','navbar'));
            }else{
                return view('forbidden');
            }
        }else{
            return view('adminlogin.index');
        }
    }

    public function create()
    {
        $opentrip = Opentrip::all();
        
        // Get ID opentrip
        $get_id_opentrip=Opentrip::orderBy('id_opentrip', 'DESC')->first();
        if(!empty($get_id_opentrip)){
            $id_opentrip=(int)substr($get_id_opentrip->id_opentrip,2)+(int)1;
        }else{
            $id_opentrip=1;
        }

        return view('dashboard.opentrip.create', compact('opentrip', 'id_opentrip'));
    }

    public function store(Request $request)
    {
        //validate form
        $this->validate($request, [
            'nm_opentrip'=>'required',
            'deskripsi'=>'required',
            'fasilitas'=>'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        //upload image
        $image = $request->file('image');
        $imageName = time() . '.' . $image->getClientOriginalName();
        $image->move('opentrip1', $imageName);

        //create post
        Opentrip::create([
            'id_opentrip'=>$request->id_opentrip,
            'nm_opentrip'=>$request->nm_opentrip,
            'deskripsi'=>$request->deskripsi,
            'fasilitas'=>$request->fasilitas,
            'harga'=>$request->harga,
            'image' => $imageName,
        ]);

        //redirect to index
        return redirect()->route('opentrip.index')->with(['success' => 'Data Berhasil Disimpan!']);
    }

    public function edit(Opentrip $opentrip)
    {
        if(session('is_logged_in')){
            if(session('is_admin')){
                return view('dashboard.opentrip.edit', compact('opentrip'));
            }else{
                return view('forbidden');
            }
        }else{
            return view('forbidden');
        }
    }
 
    public function update(Request $request, Opentrip $opentrip)
    {
        //validate form
        $this->validate($request, [
            'id_opentrip'=>'required',
            'nm_opentrip'=>'required',
            'deskripsi'=>'required',
            'fasilitas'=>'required',
            'harga'=>'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        //check if image is uploaded
        if ($request->hasFile('image')) {

            //upload new image
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalName();
            $image->move('opentrip1', $imageName);

            //delete old image
            Storage::delete('public/opentrip1/'.$opentrip->image);

            //update post with new image
            $opentrip->update([
                'nm_opentrip'=>$request->nm_opentrip,
                'deskripsi'=>$request->deskripsi,
                'fasilitas'=>$request->fasilitas,
                'harga'=>$request->harga,
                'image' => $imageName,
            ]);

        } else {

            //update post without image
            $opentrip->update([
                'nm_opentrip'=>$request->nm_opentrip,
                'deskripsi'=>$request->deskripsi,
                'fasilitas'=>$request->fasilitas,
                'harga'=>$request->harga
            ]);
        }

        //redirect to index
        return redirect()->route('opentrip.index')->with(['success' => 'Data Berhasil Diubah!']);
    }

    public function destroy(Opentrip $opentrip)
    {
        //delete image
        Storage::delete('public/opentrip1/'. $opentrip->image);

        //delete post
        $opentrip->delete();

        //redirect to index
        return redirect()->route('opentrip.index')->with(['success' => 'Data Berhasil Dihapus!']);
    }

    public function show(Opentrip $opentrip)
    {
        return view('detailsopentrip', [
            'opentrip' => $opentrip
        ]);
    }
}