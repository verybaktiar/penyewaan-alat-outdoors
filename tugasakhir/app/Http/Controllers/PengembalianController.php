<?php

namespace App\Http\Controllers;

use DateTime;
use Mail;
use App\Mail\NotifDendaMail;

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

        if(session('is_logged_in')){
            if(session('is_admin')){
                //render view with posts
                return view('dashboard.pengembalian.index', compact('pengembalian'));
            }else{
                return view('forbidden');
            }
        }else{
            return view('adminlogin.index');
        }
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

    public function notifikasi_denda(Request $request)
    {
        $id_transaksi = $request->post('id_transaksi');
        $get_transaksi = Transaksi::where(['id_transaksi'=>$id_transaksi])->first();

        $get_user = DB::table('transaksis')
                    ->select('users.email')
                    ->join('pelanggans', 'pelanggans.id_pelanggan', '=', 'transaksis.id_pelanggan')
                    ->join('users', 'pelanggans.id_user', '=', 'users.id_user')
                    ->where(['pelanggans.id_pelanggan'=>$get_transaksi->id_pelanggan])
                    ->first();

        $arr_data = array();
        $list_keranjang = explode(',',$get_transaksi->list_id_keranjang);
        foreach($list_keranjang as $keranjang_id){
            $get_keranjang = Keranjang::where(['id_keranjang'=>$keranjang_id])->first();
            $get_alatoutdoor = Alatoutdoor::where(['id_alatoutdoor'=>$get_keranjang->id_alatoutdoor])->first();
            
            if (date('Y-m-d') > $get_keranjang->akhir_sewa){ // Hanya notifikasi user dgn barang yang telat pengembaliannya
                $akhir_sewa = new \DateTime($get_keranjang->akhir_sewa);
                $tanggal_sekarang = new DateTime(date('Y-m-d'));
                $lama_telat = $akhir_sewa->diff($tanggal_sekarang)->d;

                $arr_data[] = [
                    'nama_item' => $get_alatoutdoor->nama_alat,
                    'tanggal_sewa' => date('d-m-Y',strtotime($get_keranjang->created_at)),
                    'akhir_sewa' => date('d-m-Y',strtotime($get_keranjang->akhir_sewa)),
                    'lama_telat' => $lama_telat,
                    'denda' => $lama_telat * $get_alatoutdoor->harga_sewa
                ];
            }
        }

        $mailData = [
            'title' => 'Harap Segera lakukan pengembalian',
            'body' => 'Pengembalian item yang dimaksud sebagai berikut : ',
            'data_email' => $arr_data
        ];
         
        Mail::to($get_user->email)->send(new NotifDendaMail($mailData));
        return response()->json(['status'=>'sucess']);
    }
}
