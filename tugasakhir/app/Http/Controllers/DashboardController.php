<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use App\Models\Transaksi;
use App\Models\Opentrip;
use App\Models\Alatoutdoor;
use App\Models\Pelanggan;
use App\Models\Profile;

class Dashboardcontroller extends Controller
{
    //get data for dashboard
    public function index(){
        $data['total_transaksi'] = Transaksi::get()->count();
        $data['total_transaksi_belum'] = Transaksi::where(['status_bayar'=>'Belum'])->get()->count();
        $data['total_opentrip'] = Opentrip::get()->count();
        $data['total_alatoutdoor'] = Alatoutdoor::get()->count();
        $data['total_pelanggan'] = Pelanggan::get()->count();
        $data['total_komentar'] = Profile::get()->count();

        //render view with data
        return view('dashboard.dashboard', compact('data'));
    }
};
