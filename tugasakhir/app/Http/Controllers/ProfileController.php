<?php

namespace App\Http\Controllers;

use App\Models\Keranjang;
use App\Models\Pelanggan;
use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProfileController extends Controller
{
    public function index()
    {
        $arr_data = array();

        $arr_data['title'] = 'Profil';

        if(!empty(Auth::user()->id_user)){
            $get_pelanggan = Pelanggan::where(['id_user'=>Auth::user()->id_user])->first();

            $arr_data['total_keranjang'] = Keranjang::where(['id_pelanggan'=>$get_pelanggan->id_pelanggan,'status_checkout'=>'N'])->get()->count();
            $arr_data['data_user'] = DB::table('users')
                                        ->select('pelanggans.nama_pelanggan','users.email')
                                        ->join('pelanggans', 'pelanggans.id_user', '=', 'users.id_user')
                                        ->where(['users.id_user'=>Auth::user()->id_user])
                                        ->first();
        }

        return view('profil', $arr_data);
    }

    public function user_comment(Request $request)
    {
        $get_pelanggan = Pelanggan::where(['id_user'=>Auth::user()->id_user])->first();

        // Get ID Comment
        $get_id_comment = DB::select('SELECT id_comment FROM user_comments ORDER BY LENGTH(id_comment) DESC, id_comment DESC LIMIT 1');
        if(!empty($get_id_comment)){
            $id_comment = (int)substr($get_id_comment->id_comment,4) + (int)1;
        }else{
            $id_comment = 1;
        }

        $data_comment=[
            'id_comment' => 'CMNT'. $id_comment,
            'id_pelanggan' => $get_pelanggan->id_pelanggan,
            'message_comment' => $request->post('komentar')
        ];

        if(Profile::create($data_comment)){
            return redirect('/profile')->with('status_input', 'Pesan mu telah terkirim. Terima Kasih');;
        }

        return redirect('/profile')->with('status_input', 'Gagal');;
    }
}
