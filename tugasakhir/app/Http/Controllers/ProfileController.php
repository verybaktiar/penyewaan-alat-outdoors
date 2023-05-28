<?php

namespace App\Http\Controllers;

use App\Models\Keranjang;
use App\Models\Pelanggan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProfileController extends Controller
{
    public function index()
    {
        $arr_data = array();
        $get_pelanggan = Pelanggan::where(['id_user'=>Auth::user()->id_user])->first();

        $arr_data['title'] = 'Keranjang';
        $arr_data['total_keranjang'] = Keranjang::where(['id_pelanggan'=>$get_pelanggan->id_pelanggan])->get()->count();
        $arr_data['get_pelanggan'] = DB::table('pelanggans')
            ->join('users', 'pelanggans.id_user', '=', 'users.id_user')
            ->select('users.email', 'pelanggans.nama_pelanggan', 'pelanggans.alamat', 'pelanggans.no_telepon')
            ->where(['id_pelanggan'=>$get_pelanggan->id_pelanggan])
            ->first();

        $arr_data['list_keranjang'] = DB::table('keranjangs')
            ->join('alatoutdoors', 'alatoutdoors.id_alatoutdoor', '=', 'keranjangs.id_alatoutdoor')
            ->select('alatoutdoors.nama_alat', 'alatoutdoors.harga_sewa', 'alatoutdoors.image')
            ->where(['id_pelanggan'=>$get_pelanggan->id_pelanggan])
            ->get();

        return view('profil', $arr_data);
    }
}
