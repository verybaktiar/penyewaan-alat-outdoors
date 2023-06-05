<?php

namespace App\Http\Controllers;

use App\Models\Opentrip;
use App\Models\Keranjang;
use App\Models\Pelanggan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OpenTripViewController extends Controller
{

    public function index()
    {
        $arr_data = array();

        $arr_data['title'] = 'Open Trip';
        $arr_data['opentrips'] = Opentrip::paginate(9);

        if(!empty(Auth::user()->id_user)){
            $get_pelanggan = Pelanggan::where(['id_user'=>Auth::user()->id_user])->first();
            $arr_data['total_keranjang'] = Keranjang::where(['id_pelanggan'=>$get_pelanggan->id_pelanggan,'status_checkout'=>'N'])->get()->count();
        }

        return view('opentripview', $arr_data);
    }

    public function get_opentrip(Request $request)
    {
        $id_opentrip = $request->post('id_opentrip');
        $get_opentrip = Opentrip::where(['id_opentrip'=>$id_opentrip])->first();

        return response()->json($get_opentrip);
    }
}
