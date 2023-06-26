@extends('dashboard.layouts.main')

@section('container')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Kategori</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
</head>
<body style="background: lightgray">
    <div class="container-fluid mt-2">
        <div class="row">
            <div class="col-lg-2 col-sm-6">
                <div class="card gradient-1">
                    <div class="card-body">
                        <h3 class="card-title text-white">Total Transaksi</h3>
                        <div class="d-inline-block">
                            <h2 class="text-white">{{ $data['total_transaksi'] }}</h2>
                        </div>
                        <span class="float-right display-5 opacity-5"><i class="fa fa-shopping-cart"></i></span>
                    </div>
                </div>
            </div>
            <div class="col-lg-2 col-sm-6">
                <div class="card gradient-2">
                    <div class="card-body">
                        <h3 class="card-title text-white">Belum Konfirmasi</h3>
                        <div class="d-inline-block">
                            <h2 class="text-white">{{ $data['total_transaksi_belum'] }}</h2>
                        </div>
                        <span class="float-right display-5 opacity-5"><i class="fa fa-money"></i></span>
                    </div>
                </div>
            </div>
            <div class="col-lg-2 col-sm-6">
                <div class="card gradient-3">
                    <div class="card-body">
                        <h3 class="card-title text-white">Jumlah Open Trip</h3>
                        <div class="d-inline-block">
                            <h2 class="text-white">{{ $data['total_opentrip'] }}</h2>
                        </div>
                        <span class="float-right display-5 opacity-5"><i class="fa fa-motorcycle"></i></span>
                    </div>
                </div>
            </div>
            <div class="col-lg-2 col-sm-6">
                <div class="card gradient-4">
                    <div class="card-body">
                        <h3 class="card-title text-white">Total Alat Outdoor</h3>
                        <div class="d-inline-block">
                            <h2 class="text-white">{{ $data['total_alatoutdoor'] }}</h2>
                        </div>
                        <span class="float-right display-5 opacity-5"><i class="fa fa-shopping-bag"></i></span>
                    </div>
                </div>
            </div>
            <div class="col-lg-2 col-sm-6">
                <div class="card gradient-7">
                    <div class="card-body">
                        <h3 class="card-title text-white">Total Data User</h3>
                        <div class="d-inline-block">
                            <h2 class="text-white">{{ $data['total_pelanggan'] }}</h2>
                        </div>
                        <span class="float-right display-5 opacity-5"><i class="fa fa-users"></i></span>
                    </div>
                </div>
            </div>
            <div class="col-lg-2 col-sm-6">
                <div class="card gradient-8">
                    <div class="card-body">
                        <h3 class="card-title text-white">Kritik & Saran</h3>
                        <div class="d-inline-block">
                            <h2 class="text-white">{{ $data['total_komentar'] }}</h2>
                        </div>
                        <span class="float-right display-5 opacity-5"><i class="fa fa-quote-right"></i></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
@endsection