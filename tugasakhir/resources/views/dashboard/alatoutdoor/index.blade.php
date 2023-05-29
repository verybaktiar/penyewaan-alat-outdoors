@extends('dashboard.layouts.main')

@section('container')  
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Alat Outdoor</title>
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
                        <a href="{{ route('alatoutdoor.create') }}" class="btn btn-md btn-success mb-3">TAMBAH DATA</a>
                        <table class="table table-bordered">
                            <thead>
                              <tr>
                                <th scope="col">Kode</th>
                                <th scope="col">Nama</th>
                                <th scope="col">Kategori</th>
                                <th scope="col">Spesifikasi</th>
                                <th scope="col">Deskripsi</th>
                                <th scope="col">Stok</th>
                                <th scope="col">Harga</th>
                                <th scope="col">Merk</th>
                                <th scope="col">Gambar</th>
                                <th scope="col">Aksi</th>
                              </tr>
                            </thead>
                            <tbody>
                              @forelse ($alatoutdoor as $item)
                                <tr>
                                    <td>{{ $item->id_alatoutdoor }}</td>
                                    <td>{{ $item->nama_alat }}</td>
                                    <td>{{ $item->kategori->nama_kategori }}</td>
                                    <td>{{ $item->spesifikasi }}</td>
                                    <td>{{ $item->deskripsi }}</td>
                                    <td>{{ $item->stok }}</td>
                                    <td>{{ $item->harga_sewa }}</td>
                                    <td>{{ $item->merk }}</td>
                                    <td class="text-center">
                                        <div class="box"><img src="alatoutdoor1/{{ $item->image }}" class="rounded" style="width: 150px"></div>
                                    </td>
                                    <td>
                                        <a class="btn btn-sm btn-warning" href="{{ route('alatoutdoor.edit', $item) }}">Edit</a>
                                        <form method="POST" action="{{ route('alatoutdoor.destroy', $item) }}" style="display: inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-sm btn-danger" onclick="return confirm('Delete?')">Delete</button>
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
                          {{ $alatoutdoor->links() }}
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