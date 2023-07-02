<?php

namespace App\Http\Controllers;

use App\Models\Alatoutdoor;
use App\Models\Keranjang;
use App\Models\Transaksi;
use App\Models\Pelanggan;
use App\Models\User;
use App\Models\Chat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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
            $get_id_keranjang=DB::select('SELECT id_keranjang FROM keranjangs ORDER BY LENGTH(id_keranjang) DESC, id_keranjang DESC LIMIT 1');
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
                'mulai_sewa' => date('Y-m-d',strtotime($request->post('mulai_sewa'))),
                'akhir_sewa' => date('Y-m-d',strtotime($request->post('akhir_sewa'))),
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

    public function list_trans()
    {
        $arr_data = array();

        $arr_data['title'] = 'Home';
        
        $get_pelanggan = Pelanggan::where(['id_user'=>Auth::user()->id_user])->first();
        $arr_data['total_keranjang'] = Keranjang::where(['id_pelanggan'=>$get_pelanggan->id_pelanggan,'status_checkout'=>'N'])->get()->count();
        $arr_data['total_transaksi'] = Transaksi::where(['id_pelanggan'=>$get_pelanggan->id_pelanggan])->get()->count();
        $arr_data['list_transaksi'] = Transaksi::where(['id_pelanggan'=>$get_pelanggan->id_pelanggan])->get();

        return view('transaksi', $arr_data);
    }

    public function get_trans(Request $request){
        $id_transaksi = $request->post('id_transaksi');
        $get_transaksi = Transaksi::where(['id_transaksi'=>$id_transaksi])->first();

        $list_keranjang = explode(',',$get_transaksi->list_id_keranjang);
        foreach($list_keranjang as $item_keranjang){
            $get_keranjang[] = DB::table('keranjangs')
                                  ->select('keranjangs.*','alatoutdoors.*')
                                  ->join('alatoutdoors', 'alatoutdoors.id_alatoutdoor', '=', 'keranjangs.id_alatoutdoor')
                                  ->where(['id_keranjang'=>$item_keranjang])
                                  ->first();
        }

        return response()->json($get_keranjang);
    }

    public function get_invoice(Request $request)
    {
        $arr_data = array();

        $arr_data['title'] = 'Invoice Pelanggan';
        $id_transaksi = $request->id;

        $get_transaksi = Transaksi::where(['id_transaksi'=>$id_transaksi])->first();
        $get_pelanggan = Pelanggan::where(['id_pelanggan'=>$get_transaksi->id_pelanggan])->first();

        $arr_data['transaksi'] = $get_transaksi;
        $arr_data['pelanggan'] = $get_pelanggan;

        $list_keranjang = explode(',',$get_transaksi->list_id_keranjang);
        foreach($list_keranjang as $item_keranjang){
            $get_keranjang[] = DB::table('keranjangs')
                                  ->select('keranjangs.*','alatoutdoors.*')
                                  ->join('alatoutdoors', 'alatoutdoors.id_alatoutdoor', '=', 'keranjangs.id_alatoutdoor')
                                  ->where(['id_keranjang'=>$item_keranjang])
                                  ->first();
        }
        $arr_data['list_item'] = $get_keranjang;

        return view('invoice', $arr_data);
    }

    public function get_user(Request $request){
        $id_user = $request->post('id_user');
        $get_user = DB::table('users')
                      ->select('*')
                      ->join('pelanggans', 'pelanggans.id_user', '=', 'users.id_user')
                      ->where(['users.id_user'=>$id_user])
                      ->first();

        return response()->json($get_user);
    }

    public function update_user(Request $request)
    {
        if(!empty(Auth::user()->id_user)){
            $id_user = $request->post('id_user');

            $data_user = [
                'username' => $request->post('username'),
                'email' => $request->post('email'),
                'password' => bcrypt($request->post('password'))
            ];
            
            $data_pelanggan = [
                'nama_pelanggan' => $request->post('nama_lengkap'),
                'no_telepon' => $request->post('no_telepon'),
                'alamat' => $request->post('alamat')
            ];

            if(User::where(['users.id_user'=>$id_user])->update($data_user)){
                Pelanggan::where(['pelanggans.id_user'=>$id_user])->update($data_pelanggan);
                return response()->json(['status'=>'success','message'=>'Data mu berhasil di Update !']);
            }

            return response()->json(['status'=>'error','message'=>'Terjadi kesalahan']);
        }

        return response()->json(['status'=>'warning','message'=>'Anda harus login terlebih dahulu']);
    }

}
