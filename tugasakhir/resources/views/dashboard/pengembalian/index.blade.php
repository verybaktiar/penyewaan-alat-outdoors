@extends('dashboard.layouts.main')

@section('container')  
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Data Pengembalian Barang</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
</head>
<body style="background: lightgray">

    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card border-0 shadow rounded">
                    <div class="card-body">
                        
                        <table class="table table-bordered">
                            <thead>
                              <tr>
                                <th scope="col">Id Transaksi</th>
                                <th scope="col">Nama Pelanggan</th>
                                <th scope="col">Total Harga</th>
                                <th scope="col">Action</th>
                              </tr>
                            </thead>
                            <tbody>
                            @forelse ($pengembalian as $item)
                                <tr>
                                    <td><b>{{ $item->id_transaksi }}</b></td>
                                    <td>{{ $item->nama_pelanggan }} <b>({{ $item->id_pelanggan }})</b></td>
                                    <td>{{ ke_rupiah($item->total_bayar) }}</td>
                                    <td>
                                        <button class="btn btn-sm btn-success list-item-trans" attr-value="{{ $item->id_transaksi }}"><i class="fa fa-eye"></i> Item Kembali</button>
                                        <button class="btn btn-sm btn-warning notif-denda" attr-value="{{ $item->id_transaksi }}"><i class="fa fa-exclamation"></i> Notif Denda</button>
                                    </td>
                                </tr>
                            @empty
                                  <div class="alert alert-danger">
                                      Data Post belum Tersedia.
                                  </div>
                            @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="imagemodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="row">
                        <div class="col-md-12">
                            <h5 class="modal-title" id="myModalLabel">Image preview</h5>
                        </div>
                    </div>
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                </div>
                 <div class="modal-body">
                    <img src="" id="imagepreview" style="width: 600px; height: 400px;" >
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- List Item -->
    <div class="modal fade" id="modal-list-item" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="row">
                        <div class="col-md-12">
                            <h5 class="modal-title" id="myModalLabel">List Item Pelanggan</h5>
                        </div>
                    </div>
                </div>
                <div class="modal-body">
                    <form method="POST" id="form-kembali-item">
                        <table class="table table-bordered">
                            <thead>
                              <tr>
                                <th scope="col">Nama Item</th>
                                <th scope="col">Akhir Sewa</th>
                                <th scope="col">Lama Sewa</th>
                                <th scope="col">Lama Denda</th>
                                <th scope="col">Bayar Denda (Hari)</th>
                                <th scope="col">Subtotal Bayar Denda</th>
                                <th scope="col">Tanggal Kembali</th>
                              </tr>
                            </thead>
                            <tbody class="list-data"></tbody>
                        </table>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary simpan-kembali-item" data-dismiss="modal" attr-value=""><i class="fa fa-save"></i> Simpan</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
                </div>
            </div>
        </div>
    </div>
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.4/moment.min.js"></script>

    <script type="text/javascript">
    $(document).ready(function() {

        $('.list-item-trans').on('click',function(){
            var idTransaksi = $(this).attr('attr-value');

            $.ajax({
                url: "{{ route('pengembalian.list_item_kembali') }}" ,
                type: 'POST',
                data: {
                    _token : '{{csrf_token()}}',
                    id_transaksi : idTransaksi
                },
                success: function (response) {
                    var output = ''; var totalBayarDenda = '';
                    $.each(response, function (index,value) {

                        var tanggalKembali = !!value.tgl_kembali ? 
                            '<td>'+ moment(value.tgl_kembali).format('D-MMM-YYYY') +'</td>' : // Jika item telah kembali
                            '<td><input type="text" class="form-control datepicker tanggal-kembali" attr-index="'+ index + '" name="tgl_kembali-'+ index +'" />'
                            '<input type="hidden" class="akhir-sewa-' + index +'" /></td>'; // Jika item belum kembali

                        var lamaSewa = getDateDiff(value.akhir_sewa,value.mulai_sewa);

                        //  Jika tgl kembali SUDAH ada
                        var lamaDenda = '';
                        if(!!value.tgl_kembali){
                            lamaDenda = getDateDiff(value.tgl_kembali,value.akhir_sewa);
                            totalBayarDenda = lamaDenda * value.harga_sewa;
                        }

                        if(lamaDenda < 0){
                            lamaDenda = 0;
                            totalBayarDenda = 0;
                        }

                        output += '<tr>';
                        output += '<td>'+ value.nama_alat +'</td>';
                        output += '<td>'+ moment(value.akhir_sewa).format('D-MMM-YYYY') +'</td>';
                        output += '<td>'+ lamaSewa +' Hari</td>';
                        output += '<td>'+ lamaDenda +' Hari</td>';
                        output += '<td>'+ formatRupiah(value.harga_sewa,',') +'</td>';
                        output += '<td>'+ formatRupiah(totalBayarDenda.toString(),',') +'</td>';
                        output +=  tanggalKembali;
                        output += '</tr>';

                        $('.akhir-sewa-' + index).val(index);

                        if(!!value.tgl_kembali){
                            $('.simpan-kembali-item').hide();
                        }else{
                            $('.simpan-kembali-item').show();
                        }
                    });

                    $('.list-data').html(output);
                    $('.simpan-kembali-item').attr('attr-value',idTransaksi);

                    $('.datepicker').datepicker({
                        dateFormat : 'dd-mm-yy',
                        setDate : new Date(),
                        minDate : 0,
                        autoclose : true
                    });

                    $('.tanggal-kembali').datepicker('setDate','today');

                    var outputTotalDenda = '<tr><th colspan="5" class="text-right">Total Bayar Denda</th><td colspan="2">'+ formatRupiah(totalBayarDenda.toString(),',') +'</td></tr>';
                    $('.list-data').append(outputTotalDenda);

                    $('#modal-list-item').modal('show');
                },
                error: function(xhr, status, error) {
                    console.log(xhr);
                    console.log(status);
                    console.log(error);
                }
            });
        })

        $('.simpan-kembali-item').on('click',function(){
            var idTransaksi = $(this).attr('attr-value');
            var formTglKembali = $('#form-kembali-item').serialize();

            $.ajax({
                url: "{{ route('pengembalian.kembalikan_item') }}" ,
                type: 'POST',
                data: {
                    _token : '{{csrf_token()}}',
                    id_transaksi : idTransaksi,
                    data_form : formTglKembali
                },
                success: function (response) {
                    Swal.fire('Berhasil !', 'Tanggal kembali berhasil tersimpan !', 'success');
                },
                error: function(xhr, status, error) {
                    console.log(xhr);
                    console.log(status);
                    console.log(error);
                }
            });
        })


        $('.notif-denda').on('click',function(){
            var idTransaksi = $(this).attr('attr-value');

            $.ajax({
                url: "{{ route('pengembalian.notifikasi_denda') }}" ,
                type: 'POST',
                data: {
                    _token : '{{csrf_token()}}',
                    id_transaksi : idTransaksi
                },
                success: function (response) {
                    Swal.fire('Berhasil !', 'Notifikasi denda berhasil terkirim !', 'success');
                },
                error: function(xhr, status, error) {
                    console.log(xhr);
                    console.log(status);
                    console.log(error);
                }
            });
        })

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

        function getDateDiff(date1,date2){
            let akhirSewa = new Date(date1);
            let mulaiSewa = new Date(date2);

            let difference = akhirSewa.getTime() - mulaiSewa.getTime();
            let TotalDays = Math.ceil(difference / (1000 * 3600 * 24));
            return TotalDays;
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