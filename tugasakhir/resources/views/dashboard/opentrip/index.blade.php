@extends('dashboard.layouts.main')

@section('container')  
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Open Trip</title>
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
                        <a href="{{ route('opentrip.create') }}" class="btn btn-md btn-success mb-3"><i class="fa fa-plus"></i> Tambah Data</a>
                        <table class="table table-bordered">
                            <thead>
                              <tr>
                                <th scope="col">Kode</th>
                                <th scope="col">Nama Open Trip</th>
                                <th scope="col">Deskripsi</th>
                                <th scope="col">Fasilitas</th>
                                <th scope="col">Harga</th>
                                <th scope="col">Gambar</th>
                                <th scope="col">Aksi</th>
                              </tr>
                            </thead>
                            <tbody>
                              @forelse ($opentrip as $item)
                                <tr>
                                    <td>{{ $item->id_opentrip }}</td>
                                    <td>{{ $item->nm_opentrip }}</td>
                                    <td>
                                        <?php 
                                            if(!empty($item->deskripsi)){
                                                $deskripsi = explode(' ',$item->deskripsi);
                                                $param_increment = 10;
                                                $output_string = '';
                                                foreach($deskripsi as $idx => $val){
                                                    if(($idx+1) == $param_increment){
                                                        $param_increment += 10;
                                                        $output_string .= $val . ' ' . '<br>';
                                                    }else{
                                                        $output_string .= $val . ' '; 
                                                    }
                                                }

                                                echo $output_string;
                                            }else{
                                                echo '';
                                            }
                                        ?>
                                    </td>
                                    <td>{{ $item->fasilitas }}</td>
                                    <td>{{ ke_rupiah($item->harga) }}</td>
                                    <td class="text-center">
                                        <div class="box">
                                            <a class="pop" attr-value="{{ $item->id_opentrip }}">
                                                <img id="imgToPreview-{{ $item->id_opentrip }}" src="opentrip1/{{ $item->image }}" class="rounded" style="width: 150px">
                                            </a>
                                        </div>
                                    </td>
                                    <td>
                                        <a class="btn btn-sm btn-warning" href="{{ route('opentrip.edit', $item) }}"><i class="fa fa-pencil"></i> Edit</a>
                                        <form method="POST" action="{{ route('opentrip.destroy', $item) }}" style="display: inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-sm btn-danger" onclick="return confirm('Delete?')"><i class="fa fa-trash"></i> Delete</button>
                                        </form>
                                    </td>
                                </tr>
                              @empty
                                  <div class="alert alert-danger">
                                      Data Post belum Tersedia.
                                  </div>
                              @endforelse
                            </tbody>
                          </table>  
                          {{ $opentrip->links() }}
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
        $('.pop').on('click', function() {
            $('#imagepreview').attr('src', $('#imgToPreview-' + $(this).attr('attr-value')).attr('src'));
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