@extends('dashboard.layouts.main')

@section('container')  
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Data Penyewaan User</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <style type="text/css">
    img{
        max-width: 100%;
        max-height: 100%;
        display: block;
    }
    .box{
        width: 100px;
        height: 100px;
        border: 1px solid black;
    }  
    </style>
</head>
<body style="background: lightgray">

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card border-0 shadow rounded">
                    <div class="card-body">
                        
                        <table class="table table-bordered">
                            <thead>
                              <tr>
                                <th scope="col">Id Transaksi</th>
                                <th scope="col">Pelanggan</th>
                                <th scope="col">Total Item</th>
                                <th scope="col">Jaminan</th>
                                <th scope="col">Foto Jaminan</th>
                                <th scope="col">Total Bayar</th>
                                <th scope="col">Bukti Bayar</th>
                                <th scope="col">Action</th>
                              </tr>
                            </thead>
                            <tbody>
                            @forelse ($penyewaan as $item)
                                <tr>
                                    <td><b>{{ $item->id_transaksi }}</b></td>
                                    <td>{{ $item->nama_pelanggan }} <b>({{ $item->id_pelanggan }})</b></td>
                                    <td>
                                        <?php $total_id_keranjang = count(explode(',', $item->list_id_keranjang)); ?>
                                        {{ $total_id_keranjang }}
                                    </td>
                                    <td>{{ $item->jaminan}}</td>
                                    <td class="text-center">
                                        <div class="box">
                                            <a class="pop1" attr-data="jaminan" attr-value="{{ $item->id_transaksi }}">
                                                <img id="imgToPreview-jaminan-{{ $item->id_transaksi }}" src="jaminan1/{{ $item->foto_jaminan }}" class="rounded" style="width: 150px">
                                            </a>
                                        </div>
                                    </td>
                                    <td>{{ ke_rupiah($item->total_bayar) }}</td>
                                    <td class="text-center">
                                        <div class="box">
                                            <a class="pop2" attr-data="payment" attr-value="{{ $item->id_transaksi }}">
                                                <img id="imgToPreview-payment-{{ $item->id_transaksi }}" src="payment1/{{ $item->bukti_bayar }}" class="rounded" style="width: 150px">
                                            </a>
                                        </div>
                                    </td>
                                    <td>
                                        <?php if($item->status_bayar == 'Belum'){ ?>
                                        <button class="btn btn-sm btn-primary confirm-trans" attr-value="{{ $item->id_transaksi }}"><i class="fa fa-check"></i> Confirm</button>
                                        <?php } ?>
                                        <button class="btn btn-sm btn-success list-item-trans" attr-value="{{ $item->id_transaksi }}"><i class="fa fa-eye"></i> Ambil Item</button>
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
        
    <!-- Images Preview -->
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
                    <form method="POST" id="form-ambil-item">
                        <table class="table table-bordered">
                            <thead>
                              <tr>
                                <th scope="col">Nama Item</th>
                                <th scope="col">Mulai Sewa</th>
                                <th scope="col">Akhir Sewa</th>
                                <th scope="col">Harga Item(Hari)</th>
                                <th scope="col">Tanggal Ambil</th>
                              </tr>
                            </thead>
                            <tbody class="list-data"></tbody>
                        </form>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary simpan-ambil-item" data-dismiss="modal" attr-value=""><i class="fa fa-save"></i> Simpan</button>
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

        $('[class*=pop]').on('click', function() {
            if($(this).attr('attr-data') == 'jaminan'){
                $('#imagepreview').attr('src', $('#imgToPreview-jaminan-' + $(this).attr('attr-value')).attr('src'));
            }else{
                $('#imagepreview').attr('src', $('#imgToPreview-payment-' + $(this).attr('attr-value')).attr('src'));
            }

            $('#imagemodal').modal('show');
        });

        $('.list-item-trans').on('click',function(){
            var idTransaksi = $(this).attr('attr-value');

            $.ajax({
                url: "{{ route('penyewaan.check_confirm') }}" ,
                type: 'POST',
                data: {
                    _token : '{{csrf_token()}}',
                    id_transaksi : idTransaksi
                },
                success: function (response) {
                    if(response.status_bayar != 'Belum'){ // Jika sudah Terkonfirmasi
                        $.ajax({
                            url: "{{ route('penyewaan.list_item') }}" ,
                            type: 'POST',
                            data: {
                                _token : '{{csrf_token()}}',
                                id_transaksi : idTransaksi
                            },
                            success: function (response) {
                                var output = '';
                                $.each(response, function (index,value) {

                                    var tanggalAmbil = !!value.tgl_ambil ? 
                                        '<td>'+ moment(value.tgl_ambil).format('D-MMM-YYYY') +'</td>' : // Jika item telah diambil
                                        '<td><input type="text" class="form-control datepicker tanggal-ambil" name="tgl_ambil-'+ index +'" /></td>'; // Jika item belum diambil

                                    output += '<tr>';
                                    output += '<td>'+ value.nama_alat +'</td>';
                                    output += '<td>'+ moment(value.mulai_sewa).format('D-MMM-YYYY') +'</td>';
                                    output += '<td>'+ moment(value.akhir_sewa).format('D-MMM-YYYY') +'</td>';
                                    output += '<td>'+ formatRupiah(value.harga_sewa,',') +'</td>';
                                    output +=  tanggalAmbil;
                                    output += '</tr>';

                                    if(!!value.tgl_ambil){
                                        $('.simpan-ambil-item').hide();
                                    }else{
                                        $('.simpan-ambil-item').show();
                                    }
                                });

                                $('.list-data').html(output);
                                $('.simpan-ambil-item').attr('attr-value',idTransaksi);

                                $('.datepicker').datepicker({
                                    dateFormat : 'dd-mm-yy',
                                    setDate : new Date(),
                                    minDate : 0,
                                    autoclose : true
                                });

                                $('.tanggal-ambil').datepicker('setDate','today');

                                $('#modal-list-item').modal('show');
                            },
                            error: function(xhr, status, error) {
                                console.log(xhr);
                                console.log(status);
                                console.log(error);
                            }
                        });
                    }else{
                        Swal.fire('Gagal !', 'Anda harus konfirmasi transaksi terlebih dahulu !', 'error'); // Jika belum Terkonfirmasi
                    }
                },
                error: function(xhr, status, error) {
                    console.log(xhr);
                    console.log(status);
                    console.log(error);
                }
            });
        })

        $('.confirm-trans').on('click',function(){
            var idTransaksi = $(this).attr('attr-value');

            $(this).fadeOut(1000);

            $.ajax({
                url: "{{ route('penyewaan.confirm_payment') }}" ,
                type: 'POST',
                data: {
                    _token : '{{csrf_token()}}',
                    id_transaksi : idTransaksi
                },
                success: function (response) {
                   Swal.fire('Berhasil !', 'Item berhasil terkonfirmasi', 'success');
                },
                error: function(xhr, status, error) {
                    console.log(xhr);
                    console.log(status);
                    console.log(error);
                }
            });
        })

        $('.simpan-ambil-item').on('click',function(){
            var idTransaksi = $(this).attr('attr-value');
            var formTglAmbil = $('#form-ambil-item').serialize();

            $.ajax({
                url: "{{ route('penyewaan.ambil_item') }}" ,
                type: 'POST',
                data: {
                    _token : '{{csrf_token()}}',
                    id_transaksi : idTransaksi,
                    data_form : formTglAmbil
                },
                success: function (response) {
                    Swal.fire('Berhasil !', 'Tanggal ambil berhasil tersimpan !', 'success');
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