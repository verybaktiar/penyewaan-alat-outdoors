@extends('dashboard.layouts.main')

@section('container')  
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Report Penjualan</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.10.0/css/bootstrap-datepicker.min.css">

    <style>
        @media print {
            .page-title{display: none;}
            .title{display: none;}
            .footer{display: none;}
            .btn-print{display: none;}
            .btn-filter{display: none;}
            .noprint{display: none;}
            @page {size: A4;}
            body{
                position: absolute;
            }
        }
    </style>
</head>
<body style="background: lightgray">

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card border-0 shadow rounded">
                    <div class="card-body">
                        <h4 class="text-center" style="line-height: .2;">Report Penjualan</h4><br>
                        <h5 class="text-center" style="line-height: .2;">Bakool Outdoor</h6><br>
                        <h6 class="text-center" style="line-height: .2;">Jl.Mulyorejo pertanian 1 14 Dharmahusada Indah Utara Block, Surabaya, Jawa Timur 60115</h6><br>
                        <button type="button" class="btn btn-primary btn-filter" data-toggle="modal" data-target="#modal-filter" style="margin-bottom: 1%;"><i class="fa fa-search"></i> Filter</button>
                        <table class="table table-bordered">
                            <thead>
                              <tr>
                                <th scope="col">ID Transaksi</th>
                                <th scope="col">Nama Pelanggan</th>
                                <th scope="col">Total harga</th>
                              </tr>
                            </thead>
                            <tbody></tbody>
                        </table>

                        <button type="button" class="btn btn-warning btn-print" onclick="window.print()" style="display:none;"><i class="fa fa-print"></i> Print</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- List Item -->
    <div class="modal fade" id="modal-filter" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="row">
                        <div class="col-md-12">
                            <h5 class="modal-title" id="myModalLabel">List Item Pelanggan</h5>
                        </div>
                    </div>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-12">
                                <label class="font-weight-bold">Dari</label>
                                <input type="text" class="form-control datepicker periodStart" placeholder="Dari" />
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <label class="font-weight-bold">Sampai</label>
                                <input type="text" class="form-control datepicker periodEnd" placeholder="Sampai" />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
                    <button type="button" class="btn btn-primary btn-filter-search" data-dismiss="modal"><i class="fa fa-search"></i> Filter</button>
                </div>
            </div>
        </div>
    </div>
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.4/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.10.0/js/bootstrap-datepicker.min.js"></script>

    <script type="text/javascript">
    $(document).ready(function() {
        $('#main-wrapper').toggleClass("menu-toggle");
        $(".hamburger").toggleClass("is-active");

        $('.datepicker').datepicker({
            format : 'dd/mm/yyyy',
            autoclose : true
        });

        $('.btn-filter-search').on('click',function(){
            var filterDari = $('#periodStart').val();
            var filterSampai = $('#periodEnd').val();

            $.ajax({
                url: "{{ route('report.filter_penjualan') }}" ,
                type: 'POST',
                data: {
                    _token : '{{csrf_token()}}',
                    filter_dari : filterDari,
                    filter_sampai : filterSampai
                },
                success: function (response) {
                    $('#modal-filter').modal('toggle');
                    $('.modal-backdrop').remove();
                    $('.table tbody').empty();

                    var output = '';
                    var totalHarga = 0;
                    $.each(response,function(index,value){
                        totalHarga += parseInt(value.total_bayar);

                        output += "<tr>";
                        output += "<td>" + value.id_transaksi + "</td>";
                        output += "<td>" + value.nama_pelanggan + "</td>";
                        output += "<td>" + formatRupiah(value.total_bayar.toString(),',') + "</td>";
                        output += "</tr>";

                        output += "<tr><th colspan='2' class='text-right'>Total</th><td>"+ formatRupiah(totalHarga.toString(),',') +"</td></tr>";
                    })

                    $('.btn-print').show();
                    $('.table tbody').append(output);
                },
                error: function(xhr, status, error) {
                    console.log(xhr);
                    console.log(status);
                    console.log(error);
                }
            });
        })

        // Custom Function
        function formatRupiah(angka, prefix) {

            var number_string = angka.replace(/[^,\d]/g, '').toString(),
                    split   = number_string.split(','),
                    sisa    = split[0].length % 3,
                    rupiah  = split[0].substr(0, sisa),
                    ribuan  = split[0].substr(sisa).match(/\d{3}/gi);

            if (ribuan) {
                separator = sisa ? '.' : '';
                rupiah += separator + ribuan.join('.');
            }

            rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
            return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
        }

    })
    </script>

    <script>
        //message with toastr
        @if(session()->has('success'))
        
            toastr.success('{{ session('success') }}', 'BERHASIL!'); 

        @elseif(session()->has('error'))

            toastr.error('{{ session('error') }}', 'GAGAL!'); 
            
        @endif
    </script>

</body>
</html>
@endsection