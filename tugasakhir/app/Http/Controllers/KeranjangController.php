<?php

namespace App\Http\Controllers;

use App\Models\Keranjang;
use App\Models\Pelanggan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class KeranjangController extends Controller
{
    public function index()
    {
        $arr_data = array();
        $arr_data['title'] = 'Keranjang';

        if(!empty(Auth::user()->id_user)){
            $get_pelanggan = Pelanggan::where(['id_user'=>Auth::user()->id_user])->get('id_pelanggan');
            $id_pelanggan = $get_pelanggan[0]->id_pelanggan;

            $arr_data['total_keranjang'] = Keranjang::where(['id_pelanggan'=>$id_pelanggan])->get()->count();
        }

        $arr_data['list_keranjang'] = DB::table('keranjangs')
            ->join('alatoutdoors', 'alatoutdoors.id_alatoutdoor', '=', 'keranjangs.id_alatoutdoor')
            ->select('alatoutdoors.nama_alat', 'alatoutdoors.harga_sewa', 'alatoutdoors.image')
            ->get();

        return view('keranjang', $arr_data);
    }
}
