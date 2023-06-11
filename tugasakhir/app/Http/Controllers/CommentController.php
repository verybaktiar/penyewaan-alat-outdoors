<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CommentController extends Controller
{
    public function index()
    {
        $komentar = DB::table('user_comments')
                            ->select('user_comments.*','pelanggans.nama_pelanggan','users.email')
                            ->join('pelanggans', 'pelanggans.id_pelanggan', '=', 'user_comments.id_pelanggan')
                            ->join('users', 'users.id_user', '=', 'pelanggans.id_user')
                            ->get();

        return view('dashboard.komentar.index', ['komentar' => $komentar]);
    }
}
