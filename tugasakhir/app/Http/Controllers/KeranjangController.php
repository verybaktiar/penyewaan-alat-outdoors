<?php

namespace App\Http\Controllers;

use App\Models\Keranjang;
use App\Models\Pelanggan;
use App\Models\Transaksi;
use App\Models\Penyewaan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use DateTime;

class KeranjangController extends Controller
{
    public function index()
    {
        $arr_data = array();
        $get_pelanggan = Pelanggan::where(['id_user'=>Auth::user()->id_user])->first();

        $arr_data['title'] = 'Keranjang';
        $arr_data['total_keranjang'] = Keranjang::where(['id_pelanggan'=>$get_pelanggan->id_pelanggan,'status_checkout'=>'N'])->get()->count();
        $arr_data['get_pelanggan'] = DB::table('pelanggans')
            ->join('users', 'pelanggans.id_user', '=', 'users.id_user')
            ->select('users.email', 'pelanggans.nama_pelanggan', 'pelanggans.alamat', 'pelanggans.no_telepon')
            ->where(['id_pelanggan'=>$get_pelanggan->id_pelanggan])
            ->first();

        $arr_data['list_keranjang'] = DB::table('keranjangs')
            ->join('alatoutdoors', 'alatoutdoors.id_alatoutdoor', '=', 'keranjangs.id_alatoutdoor')
            ->select('keranjangs.*', 'alatoutdoors.nama_alat', 'alatoutdoors.harga_sewa', 'alatoutdoors.image')
            ->where([
                'id_pelanggan'=>$get_pelanggan->id_pelanggan,
                'status_checkout'=>'N'
            ])
            ->get();

        return view('keranjang', $arr_data);
    }

    public function upload_payment(Request $request) 
    {
        // Validasi
        $validated = $request->validate([
            'file_upload_payment' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'file_upload_jaminan' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'jaminan' => 'required'
        ]);

        // Get Data
        $get_pelanggan = Pelanggan::where(['id_user'=>Auth::user()->id_user])->first();

        $img_payment = $request->file('file_upload_payment');
        $img_payment_name = time() . '.' . $img_payment->getClientOriginalName();
        $img_jaminan = $request->file('file_upload_jaminan');
        $img_jaminan_name = time() . '.' . $img_jaminan->getClientOriginalName();

        $get_keranjang = DB::table('keranjangs')
            ->join('alatoutdoors', 'alatoutdoors.id_alatoutdoor', '=', 'keranjangs.id_alatoutdoor')
            ->select('keranjangs.*', 'alatoutdoors.nama_alat', 'alatoutdoors.harga_sewa', 'alatoutdoors.image')
            ->where([
                'id_pelanggan'=>$get_pelanggan->id_pelanggan,
                'status_checkout'=>'N'
            ])
            ->get();

        if($validated){ // Jika validasi return TRUE
            $img_payment->move('payment1', $img_payment_name);
            $img_jaminan->move('jaminan1', $img_jaminan_name);

            // Set Variabel ID Keranjang &  Pelanggan
            $id_pelanggan = ''; $list_id_keranjang = '';$total_harga = 0;

            $list_item_sewa = [];
            foreach($get_keranjang as $idx_keranjang => $row_keranjang){

                // Set Variabel ID Keranjang &  Pelanggan
                $id_pelanggan = $row_keranjang->id_pelanggan;
                if($idx_keranjang != (count($get_keranjang) - 1) ){
                    $list_id_keranjang .= $row_keranjang->id_keranjang . ',';
                }else{
                    $list_id_keranjang .= $row_keranjang->id_keranjang;
                }

                // Get ID Sewa
                $get_id_sewa=Penyewaan::orderBy('id_sewa', 'DESC')->first();
                if(!empty($get_id_sewa)){
                    $id_sewa=(int)substr($get_id_sewa->id_sewa,3) + (int)1 + $idx_keranjang;
                }else{
                    $id_sewa=$idx_keranjang + 1;
                }

                // Get Lama sewa
                $mulai_sewa = new DateTime($row_keranjang->mulai_sewa);
                $akhir_sewa = new DateTime($row_keranjang->akhir_sewa);
                $lama_sewa = $mulai_sewa->diff($akhir_sewa)->d;

                // Set Total Harga
                $total_harga += (int)$row_keranjang->harga_sewa * (int)$lama_sewa;

                // Data Sewa yang akan di input
                $list_item_sewa[$idx_keranjang] = [
                    'id_sewa' => 'SWA'. $id_sewa,
                    'id_pelanggan' => $row_keranjang->id_pelanggan,
                    'id_keranjang' => $row_keranjang->id_keranjang,
                    'harga_item' => $row_keranjang->harga_sewa * $lama_sewa
                ];

                // Ubah status checkout di keranjang
                $checkout_item=[
                    'status_checkout' => 'Y'
                ];
            }

            // Get ID Transaksi
            $get_id_trans=Transaksi::orderBy('id_transaksi', 'DESC')->first();
            if(!empty($get_id_trans)){
                $id_trans=(int)substr($get_id_trans->id_transaksi,4)+(int)1;
            }else{
                $id_trans= 1;
            }

            // Data Sewa masuk ke table transaksi
            $item_transaksi = [
                'id_transaksi' => 'TRNS'. $id_trans,
                'id_pelanggan' => $id_pelanggan,
                'list_id_keranjang' => $list_id_keranjang,
                'jaminan' => $request->post('jaminan'),
                'foto_jaminan'=> $img_jaminan_name,
                'total_bayar'=> $total_harga,
                'bukti_bayar' => $img_payment_name
            ];

            // Insert data & validasi jika ada error
            if(Penyewaan::insert($list_item_sewa) && 
                Keranjang::where(['id_pelanggan'=>$get_pelanggan->id_pelanggan])->update($checkout_item) &&
                Transaksi::insert($item_transaksi) 
            ){
                return redirect('/keranjang')->with('status_checkout', 'Berhasil Checkout !');;
            }

            return response()->json(['status'=>'error','message'=>'Terjadi kesalahan : Gagal Input']);
        }

        return response()->json(['status'=>'error','message'=>'Terjadi kesalahan : Validasi Gagal']);
    }

    public function delete_item(Request $request) 
    {
        $data = $request->validate([
            'id_keranjang' => 'required'
        ]);

        if(Keranjang::where('id_keranjang', $data)->delete()){
            return response()->json(['status'=>'success','message'=>'Item berhasil dihapus dari keranjang !']);
        }

        return response()->json(['status'=>'error','message'=>'Terjadi kesalahan']);
    }
}
