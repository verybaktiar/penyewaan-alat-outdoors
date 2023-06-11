@extends('dashboard.layouts.main')

@section('container')  
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Komentar</title>
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
                                <th scope="col">Nama Pelanggan</th>
                                <th scope="col">Email</th>
                                <th scope="col">Komentar</th>
                              </tr>
                            </thead>
                            <tbody>
                              @forelse ($komentar as $item)
                                <tr>
                                    <td>{{ $item->nama_pelanggan }}</td>
                                    <td>{{ $item->email }}</td>
                                    <td>
                                        <?php 
                                            if(!empty($item->message_comment)){
                                                $deskripsi = explode(' ',$item->message_comment);
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
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

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