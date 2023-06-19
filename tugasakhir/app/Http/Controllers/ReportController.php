<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class Reportcontroller extends Controller
{
    public function index()
    {
        return view('dashboard.report.index');
    }

    public function filter_penjualan(Request $request)
    {
        $filter_dari = $request->post('filter_dari');
        $filter_sampai = $request->post('filter_sampai');

        $get_report = DB::table('transaksis')
        						->join('pelanggans', 'pelanggans.id_pelanggan', '=', 'transaksis.id_pelanggan')
                                // ->whereBetween('updated_at', [$filter_dari, $filter_sampai])
                                ->get();

        return response()->json($get_report);
    }
};
