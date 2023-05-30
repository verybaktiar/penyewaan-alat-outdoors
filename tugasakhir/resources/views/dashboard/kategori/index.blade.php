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

    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card border-0 shadow rounded">
                    <div class="card-body">
                        <a href="{{ route('kategori.create') }}" class="btn btn-md btn-success mb-3"><i class="fa fa-plus"></i> Tambah Data</a>
                        <table class="table table-bordered">
                            <thead>
                              <tr>
                                <th scope="col">Kode</th>
                                <th scope="col">Nama Kategori</th>
                                <th scope="col">Aksi</th>
                              </tr>
                            </thead>
                            <tbody>
                              @forelse ($kategori as $item)
                                <tr>
                                    <td>{{ $item->id_kategori }}</td>
                                    <td>{{ $item->nama_kategori }}</td>
                                    <td>
                                        <a class="btn btn-sm btn-warning" href="{{ route('kategori.edit', $item) }}"><i class="fa fa-pencil"></i> Edit</a>
                                        <form method="POST" action="{{ route('kategori.destroy', $item) }}" style="display: inline-block;">
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