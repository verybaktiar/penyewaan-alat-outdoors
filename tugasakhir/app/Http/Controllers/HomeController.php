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

    public function send_chat(Request $request)
    {
        $data = $request->validate([
            'chat_message' => 'required'
        ]);


        if(!empty(Auth::user()->id_user)){
            $get_id_chat=DB::select('SELECT * FROM chats ORDER BY LENGTH(id_chat) DESC, id_chat DESC LIMIT 1');
            if(!empty($get_id_chat)){
                $id_chat=(int)substr($get_id_chat[0]->id_chat,4)+(int)1;
            }else{
                $id_chat=1;
            }

            $sesi_chat = md5(mt_rand()); // Random String untuk keperluan membuat sesi chat baru
            $get_user=User::where(['id_user'=>Auth::user()->id_user])->first();

            if(!empty($get_user->sesi_chat)){
                $sesi_chat = $get_user->sesi_chat;
            }else{
                // Jika ada sesi chat user baru, update user 
                $data_sesi = ['sesi_chat' => $sesi_chat];
                User::where(['id_user'=>Auth::user()->id_user])->update($data_sesi);
            }
            
            $data_chat=[
                'id_chat' => 'CHAT'. $id_chat,
                'id_user' => Auth::user()->id_user,
                'sesi_chat' => $sesi_chat,
                'chat_message' => $request->post('chat_message'),
                'status_read' => 'Belum'
            ];

            if(Chat::create($data_chat)){
                $message_list = Chat::where(['sesi_chat'=>$sesi_chat])->latest()->take(4)->get();
                return response()->json(['status'=>'success','message_list'=>$message_list]);
            }

            return response()->json(['status'=>'error','message'=>'Terjadi kesalahan']);
        }

        return response()->json(['status'=>'warning','message'=>'Anda harus login terlebih dahulu']);
    }

    public function load_chat()
    {
        if(!empty(Auth::user()->id_user)){
            $get_user=User::where(['id_user'=>Auth::user()->id_user])->first();

            if(!empty($get_user->sesi_chat)){
                $sesi_chat = $get_user->sesi_chat;
                $message_list = Chat::where(['sesi_chat'=>$sesi_chat])->latest()->take(4)->get();
                return response()->json(['status'=>'success','message_list'=>$message_list]);
            }

            return response()->json(['status'=>'empty']);
        }

        return response()->json(['status'=>'warning','message'=>'Anda harus login terlebih dahulu']);
    }

}
