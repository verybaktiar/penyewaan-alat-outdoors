<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Penyewaan;
use App\Models\Alatoutdoor;
use App\Models\Keranjang;
use App\Models\Pelanggan;
use App\Models\Transaksi;

class PengembalianController extends Controller
{

    public function index()
    {
        //get posts
        $pengembalian = DB::table('transaksis')
                            ->select('transaksis.*','pelanggans.nama_pelanggan')
                            ->join('pelanggans', 'pelanggans.id_pelanggan', '=', 'transaksis.id_pelanggan')
                            ->where(['transaksis.status_bayar'=>'Sudah'])
                            ->get();
        //render view with posts
        return view('dashboard.pengembalian.index', compact('pengembalian'));
    }

    public function list_item(Request $request)
    {
        $id_transaksi = $request->post('id_transaksi');
        $get_transaksi = Transaksi::where(['id_transaksi'=>$id_transaksi])->first();

        $arr_data = array();
        $list_keranjang = explode(',',$get_transaksi->list_id_keranjang);
        foreach($list_keranjang as $val_id){
            $arr_data[$val_id] = DB::table('keranjangs')
                                ->select('keranjangs.mulai_sewa','keranjangs.akhir_sewa', 'alatoutdoors.nama_alat', 'alatoutdoors.harga_sewa', 'penyewaans.tgl_kembali')
                                ->join('alatoutdoors', 'alatoutdoors.id_alatoutdoor', '=', 'keranjangs.id_alatoutdoor')
                                ->join('penyewaans', 'penyewaans.id_keranjang', '=', 'keranjangs.id_keranjang')
                                ->where(['keranjangs.id_keranjang'=>$val_id])
                                ->first();
        }

        return response()->json($arr_data);
    }

    public function kembalikan_item(Request $request)
    {
        $id_transaksi = $request->post('id_transaksi');
        $get_transaksi = Transaksi::where(['id_transaksi'=>$id_transaksi])->first();

        $data_form = $request->all();
        $value_form =  array();
        parse_str($data_form['data_form'], $value_form);

        $arr_data = array();
        $list_keranjang = explode(',',$get_transaksi->list_id_keranjang);
        foreach($list_keranjang as $keranjang_id){
            Penyewaan::where(['id_keranjang'=>$keranjang_id])->update([
                'tgl_kembali' => date('Y-m-d',strtotime($value_form['tgl_kembali-'.$keranjang_id])),
                'status_sewa' => 'Berakhir'
            ]);

            $get_keranjang = Keranjang::where(['id_keranjang'=>$keranjang_id])->first();
            $get_alatoutdoor = Alatoutdoor::where(['id_alatoutdoor'=>$get_keranjang->id_alatoutdoor])->first();

            Alatoutdoor::where(['id_alatoutdoor'=>$get_keranjang->id_alatoutdoor])->update([
                'stok' => $get_alatoutdoor->stok + $get_keranjang->total_sewa
            ]);
        }
    }
}
