<?php

namespace App\Http\Controllers;

use App\Models\Pelanggan;
use App\Models\User;
use App\Models\Chat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ChatController extends Controller
{
    // User - Send Chat
    public function send_chat(Request $request)
    {
        $data = $request->validate([
            'chat_message' => 'required'
        ]);


        if(!empty(Auth::user()->id_user)){
            $get_id_chat=DB::select('SELECT id_chat FROM chats ORDER BY LENGTH(id_chat) DESC, id_chat DESC LIMIT 1');
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
                $message_list = DB::table('chats')
                                ->select('chats.*','users.role')
                                ->join('users', 'users.id_user', '=', 'chats.id_user')
                                ->where(['chats.sesi_chat'=>$sesi_chat])
                                ->latest()->take(4)->get();

                return response()->json(['status'=>'success','message_list'=>$message_list]);
            }

            return response()->json(['status'=>'error','message'=>'Terjadi kesalahan']);
        }

        return response()->json(['status'=>'warning','message'=>'Anda harus login terlebih dahulu']);
    }

    // User - Load Chat
    public function load_chat()
    {
        if(!empty(Auth::user()->id_user)){
            $get_user=User::where(['id_user'=>Auth::user()->id_user])->first();

            if(!empty($get_user->sesi_chat)){
                $sesi_chat = $get_user->sesi_chat;
                $message_list = DB::table('chats')
                                   ->select('chats.*','users.role')
                                   ->join('users', 'users.id_user', '=', 'chats.id_user')
                                   ->where(['chats.sesi_chat'=>$sesi_chat])
                                   ->latest()->take(4)->get();
                                
                return response()->json(['status'=>'success','message_list'=>$message_list]);
            }

            return response()->json(['status'=>'empty']);
        }

        return response()->json(['status'=>'warning','message'=>'Anda harus login terlebih dahulu']);
    }

    // Admin - List User
    public function list_user()
    {
        $list_user = DB::table('users')
                        ->select('users.sesi_chat','users.id_user','pelanggans.nama_pelanggan')
                        ->join('pelanggans', 'pelanggans.id_user', '=', 'users.id_user')
                        ->whereNotNull('users.sesi_chat')
                        ->get();

        return response()->json(['status'=>'success','list_user'=>$list_user]);
    }

    public function send_chat_admin(Request $request)
    {
        $data = $request->validate([
            'chat_message' => 'required'
        ]);

        if(!empty(Auth::user()->id_user)){
            $get_id_chat=DB::select('SELECT id_chat FROM chats ORDER BY LENGTH(id_chat) DESC, id_chat DESC LIMIT 1');
            if(!empty($get_id_chat)){
                $id_chat=(int)substr($get_id_chat[0]->id_chat,4)+(int)1;
            }else{
                $id_chat=1;
            }
            
            $data_chat=[
                'id_chat' => 'CHAT'. $id_chat,
                'id_user' => Auth::user()->id_user,
                'sesi_chat' => $request->post('sesi_chat'),
                'chat_message' => $request->post('chat_message'),
                'status_read' => 'Belum'
            ];

            if(Chat::create($data_chat)){
                $message_list = DB::table('chats')
                                ->select('chats.*','users.role')
                                ->join('users', 'users.id_user', '=', 'chats.id_user')
                                ->where(['chats.sesi_chat'=>$request->post('sesi_chat')])
                                ->latest()->take(4)->get();

                return response()->json(['status'=>'success','message_list'=>$message_list]);
            }

            return response()->json(['status'=>'error','message'=>'Terjadi kesalahan']);
        }

        return response()->json(['status'=>'warning','message'=>'Anda harus login terlebih dahulu']);  
    }

    // Admin - Load Chat by Selected User
    public function load_chat_by_user(Request $request)
    {
        $id_user = $request->post('id_user');
        $get_user = DB::table('users')
                            ->select('users.id_user','users.sesi_chat','users.username','pelanggans.nama_pelanggan')
                            ->join('pelanggans', 'pelanggans.id_user', '=', 'users.id_user')
                            ->where(['users.id_user'=>$id_user])
                            ->first();

        if(!empty($get_user->sesi_chat)){
            $sesi_chat = $get_user->sesi_chat;
            $message_list = DB::table('chats')
                            ->select('chats.*','users.role')
                            ->join('users', 'users.id_user', '=', 'chats.id_user')
                            ->where(['chats.sesi_chat'=>$sesi_chat])
                            ->latest()->take(4)->get();
                            
            return response()->json(['status'=>'success','data_user'=>$get_user,'message_list'=>$message_list]);
        }

        return response()->json(['status'=>'empty']);
    }

}
