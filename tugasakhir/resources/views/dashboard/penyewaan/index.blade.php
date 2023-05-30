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

    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card border-0 shadow rounded">
                    <div class="card-body">
                        
                        <table class="table table-bordered">
                            <thead>
                              <tr>
                                <th scope="col">Pelanggan</th>
                                <th scope="col">Nama Item</th>
                                <th scope="col">Tgl Ambil</th>
                                <th scope="col">Jaminan</th>
                                <th scope="col">Foto Jaminan</th>
                                <th scope="col">Total Bayar</th>
                                <th scope="col">Bukti Bayar</th>
                                <th scope="col">Status Sewa</th>
                                <th scope="col">Action</th>
                              </tr>
                            </thead>
                            <tbody>
                            @forelse ($penyewaan as $item)
                                <tr>
                                    <td>{{ $item->id_sewa }}</td>
                                    <td>{{ $item->id_sewa }}</td>
                                    <td>{{ $item->tgl_ambil}}</td>
                                    <td>{{ $item->jaminan }}</td>
                                    <td class="text-center">
                                        <div class="box">
                                            <a class="pop1" attr-data="jaminan" attr-value="{{ $item->id_sewa }}">
                                                <img id="imgToPreview-jaminan-{{ $item->id_sewa }}" src="jaminan1/{{ $item->foto_jaminan }}" class="rounded" style="width: 150px">
                                            </a>
                                        </div>
                                    </td>
                                    <td>{{ $item->total_bayar }}</td>
                                    <td class="text-center">
                                        <div class="box">
                                            <a class="pop2" attr-data="payment" attr-value="{{ $item->id_sewa }}">
                                                <img id="imgToPreview-payment-{{ $item->id_sewa }}" src="payment1/{{ $item->bukti_bayar }}" class="rounded" style="width: 150px">
                                            </a>
                                        </div>
                                    </td>
                                    <td>{{ $item->status_sewa }}</td>
                                    <td>
                                        <button class="btn btn-sm btn-primary"><i class="fa fa-check"></i> Confirm</button>
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
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <script type="text/javascript">
        $('[class*=pop]').on('click', function() {
            if($(this).attr('attr-data') == 'jaminan'){
                $('#imagepreview').attr('src', $('#imgToPreview-jaminan-' + $(this).attr('attr-value')).attr('src'));
            }else{
                $('#imagepreview').attr('src', $('#imgToPreview-payment-' + $(this).attr('attr-value')).attr('src'));
            }

            $('#imagemodal').modal('show');
        });
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