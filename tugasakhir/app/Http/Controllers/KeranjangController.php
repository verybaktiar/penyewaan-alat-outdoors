<?php

namespace App\Http\Controllers;

use App\Models\Keranjang;
use App\Models\Pelanggan;
use App\Models\Penyewaan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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
            'file_upload_payment' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
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

            $list_item_sewa = [];
            foreach($get_keranjang as $idx_keranjang => $row_keranjang){

                // Get ID Sewa
                $get_id_sewa=Penyewaan::orderBy('id_sewa', 'DESC')->first();
                if(!empty($get_id_sewa)){
                    $id_sewa=(int)substr($get_id_sewa->id_sewa,3)+(int)1;
                }else{
                    $id_sewa=$idx_keranjang + 1;
                }

                // Data Sewa yang akan di input
                $list_item_sewa[$idx_keranjang] = [
                    'id_sewa' => 'SWA'. $id_sewa,
                    'id_pelanggan' => $row_keranjang->id_pelanggan,
                    'id_keranjang' => $row_keranjang->id_keranjang,
                    'jaminan' => $request->post('jaminan'),
                    'foto_jaminan' => $img_jaminan_name,
                    'total_bayar' => $row_keranjang->harga_sewa * $row_keranjang->total_sewa,
                    'bukti_bayar' => $img_payment_name
                ];

                // Ubah status checkout di keranjang
                $checkout_item=[
                    'status_checkout' => 'Y'
                ];
            }

            // Insert data & validasi jika ada error
            if(Penyewaan::insert($list_item_sewa) && Keranjang::where(['id_pelanggan'=>$get_pelanggan->id_pelanggan])->update($checkout_item)){
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
