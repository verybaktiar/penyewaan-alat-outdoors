<?php

namespace App\Http\Controllers;

use App\Models\Alatoutdoor;
use App\Models\Keranjang;
use App\Models\Pelanggan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {

        $arr_data = array();

        $arr_data['title'] = 'Home';
        $arr_data['sample_alatoutdoor'] = Alatoutdoor::take(3)->get();
        
        if(!empty(Auth::user()->id_user)){
            $get_pelanggan = Pelanggan::where(['id_user'=>Auth::user()->id_user])->first();
            $arr_data['total_keranjang'] = Keranjang::where(['id_pelanggan'=>$get_pelanggan->id_pelanggan,'status_checkout'=>'N'])->get()->count();
        }

        return view('home', $arr_data);
    }

    public function store(Request $request) 
    {
        $data = $request->validate([
            'id_alatoutdoor' => 'required',
            'mulai_sewa' => 'required',
            'akhir_sewa' => 'required'
        ]);


        if(!empty(Auth::user()->id_user)){
            $get_id_keranjang=Keranjang::orderBy('id_keranjang', 'DESC')->first();
            if(!empty($get_id_keranjang)){
                $id_keranjang=(int)substr($get_id_keranjang->id_keranjang,3)+(int)1;
            }else{
                $id_keranjang=1;
            }

            $get_pelanggan = Pelanggan::where(['id_user'=>Auth::user()->id_user])->get('id_pelanggan');
            $id_pelanggan = $get_pelanggan[0]->id_pelanggan;

            $get_total_sewa = (Keranjang::where([
                'id_pelanggan'=> $id_pelanggan,
                'id_alatoutdoor'=> $request->post('id_alatoutdoor')
            ])->get()->count()) + 1;
            
            $keranjang=[
                'id_keranjang' => 'KRJ'. $id_keranjang,
                'id_pelanggan' => $id_pelanggan,
                'id_alatoutdoor' => $request->post('id_alatoutdoor'),
                'mulai_sewa' => $request->post('mulai_sewa'),
                'akhir_sewa' => $request->post('akhir_sewa'),
                'total_sewa' => $get_total_sewa,
                'status_checkout' => 'N'
            ];

            if(Keranjang::create($keranjang)){
                return response()->json(['status'=>'success','message'=>'Item yang yang diinginkan sudah masuk keranjang !']);
            }

            return response()->json(['status'=>'error','message'=>'Terjadi kesalahan']);
        }

        return response()->json(['status'=>'warning','message'=>'Anda harus login terlebih dahulu']);
    }
}
