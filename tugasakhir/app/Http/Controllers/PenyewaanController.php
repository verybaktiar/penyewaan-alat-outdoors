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
use App\Models\Kategori;

class PenyewaanController extends Controller
{

    public function index()
    {
        //get posts
        $penyewaan = DB::table('transaksis')
                            ->select('transaksis.*','pelanggans.nama_pelanggan')
                            ->join('pelanggans', 'pelanggans.id_pelanggan', '=', 'transaksis.id_pelanggan')
                            ->get();
        //render view with posts
        return view('dashboard.penyewaan.index', compact('penyewaan'));
    }

    public function sewa()
    {
        $arr_data = array();
        
        $arr_data['title'] = 'Sewa';
        $arr_data['kategoris'] = Kategori::all();
        $arr_data['alatoutdoors'] = DB::table('alatoutdoors')
                                    ->select('alatoutdoors.*', 'kategoris.nama_kategori')
                                    ->join('kategoris', 'kategoris.id_kategori', '=', 'alatoutdoors.id_kategori')
                                    ->get();

        if(!empty(Auth::user()->id_user)){
            $get_pelanggan = Pelanggan::where(['id_user'=>Auth::user()->id_user])->first();
            $arr_data['total_keranjang'] = Keranjang::where(['id_pelanggan'=>$get_pelanggan->id_pelanggan,'status_checkout'=>'N'])->get()->count();
        }

        return view('sewa', $arr_data);
    }

    public function get_alatoutdoor(Request $request)
    {
        $id_alatoutdoor = $request->post('id_alatoutdoor');
        $get_alatoutdoor = Alatoutdoor::where(['id_alatoutdoor'=>$id_alatoutdoor])->first();

        return response()->json($get_alatoutdoor);
    }

    public function check_confirm(Request $request)
    {
        $id_transaksi = $request->post('id_transaksi');
        $get_transaksi = Transaksi::where(['id_transaksi'=>$id_transaksi])->first();

        return response()->json($get_transaksi);
    }

    public function confirm_payment(Request $request)
    {
        $id_transaksi = $request->post('id_transaksi');
        Transaksi::where(['id_transaksi'=>$id_transaksi])->update(['status_bayar' => 'Sudah']);
    }

    public function list_item(Request $request)
    {
        $id_transaksi = $request->post('id_transaksi');
        $get_transaksi = Transaksi::where(['id_transaksi'=>$id_transaksi])->first();

        $arr_data = array();
        $list_keranjang = explode(',',$get_transaksi->list_id_keranjang);
        foreach($list_keranjang as $val_id){
            $arr_data[$val_id] = DB::table('keranjangs')
                                ->select('keranjangs.mulai_sewa','keranjangs.akhir_sewa', 'alatoutdoors.nama_alat', 'alatoutdoors.harga_sewa', 'penyewaans.tgl_ambil')
                                ->join('alatoutdoors', 'alatoutdoors.id_alatoutdoor', '=', 'keranjangs.id_alatoutdoor')
                                ->join('penyewaans', 'penyewaans.id_keranjang', '=', 'keranjangs.id_keranjang')
                                ->where(['keranjangs.id_keranjang'=>$val_id])
                                ->first();
        }

        return response()->json($arr_data);
    }

    public function ambil_item(Request $request)
    {
        $id_transaksi = $request->post('id_transaksi');
        $get_transaksi = Transaksi::where(['id_transaksi'=>$id_transaksi])->first();

        $data_form = $request->all();
        $value_form =  array();
        parse_str($data_form['data_form'], $value_form);

        $list_keranjang = explode(',',$get_transaksi->list_id_keranjang);
        foreach($list_keranjang as $keranjang_id){
            Penyewaan::where(['id_keranjang'=>$keranjang_id])->update([
                'tgl_ambil' => date('Y-m-d',strtotime($value_form['tgl_ambil-'.$keranjang_id])),
                'status_sewa' => 'Berjalan'
            ]);

            $get_keranjang = Keranjang::where(['id_keranjang'=>$keranjang_id])->first();
            $get_alatoutdoor = Alatoutdoor::where(['id_alatoutdoor'=>$get_keranjang->id_alatoutdoor])->first();

            Alatoutdoor::where(['id_alatoutdoor'=>$get_keranjang->id_alatoutdoor])->update([
                'stok' => $get_alatoutdoor->stok - $get_keranjang->total_sewa
            ]);
        }
    }
}
