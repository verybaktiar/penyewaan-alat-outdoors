
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edit Data</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body style="background: lightgray">

    <div class="container mt-2 mb-2">
        <div class="row">
            <div class="col-md-12">
                <div class="card border-0 shadow rounded">
                    <div class="card-body">
                        <form action="{{ route('alatoutdoor.update', $alatoutdoor) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label class="font-weight-bold">Id Alat Outdoor</label>
                                <input type="text" class="form-control" name="id_alatoutdoor" value="{{ old('id_alatoutdoor', $alatoutdoor->id_alatoutdoor) }}" readonly>
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">Nama Alat Outdoor</label>
                                <input type="text" class="form-control @error('nama_alat') is-invalid @enderror" name="nama_alat" value="{{ old('nama_alat', $alatoutdoor->nama_alat) }}" placeholder="Nama Alat Outdoor">
                            
                                <!-- error message untuk title -->
                                @error('nama_alat')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label class="font-weight-bold">Kategori</label>
                                <select name="id_kategori" id="id_kategori" class="custom-select">
                                    <option value="" selected disabled hidden>--- Pilih Kategori ---</option>
                                    @foreach($kategori as $item)

                                    @if(old('id_kategori', $alatoutdoor->id_kategori) == $item->id_kategori)
                                    <option value="{{ $item->id_kategori }}" selected>{{ $item->nama_kategori }}</option>
                                    @endif
                                    <option value="{{ $item->id_kategori }}">{{ $item->nama_kategori }}</option>
                                        
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">Spesifikasi</label>
                                <input type="text" class="form-control @error('spesifikasi') is-invalid @enderror" name="spesifikasi" value="{{ old('spesifikasi', $alatoutdoor->spesifikasi) }}" placeholder="Spesifikasi">
                            
                                <!-- error message untuk title -->
                                @error('spesifikasi')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">Deskripsi</label>
                                <input type="text" class="form-control @error('deskripsi') is-invalid @enderror" name="deskripsi" value="{{ old('deskripsi', $alatoutdoor->deskripsi) }}" placeholder="Deskripsi">
                            
                                <!-- error message untuk title -->
                                @error('deskripsi')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">Stok</label>
                                <input type="text" class="form-control @error('stok') is-invalid @enderror" name="stok" value="{{ old('stok', $alatoutdoor->stok) }}" placeholder="Stok">
                            
                                <!-- error message untuk title -->
                                @error('stok')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">Harga Sewa</label>
                                <input type="text" class="form-control @error('harga_sewa') is-invalid @enderror" name="harga_sewa" value="{{ old('harga_sewa', $alatoutdoor->harga_sewa) }}" placeholder="Harga Sewa">
                            
                                <!-- error message untuk title -->
                                @error('harga_sewa')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">Merk</label>
                                <input type="text" class="form-control @error('merk') is-invalid @enderror" name="merk" value="{{ old('merk', $alatoutdoor->merk) }}" placeholder="Merk">
                            
                                <!-- error message untuk title -->
                                @error('merk')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">Gambar</label>
                                <input type="file" class="form-control" name="image">
                            </div>
                            <button type="submit" class="btn btn-md btn-primary">UPDATE</button>
                            <button type="reset" class="btn btn-md btn-warning">RESET</button>

                        </form> 
                    </div>
                </div>
            </div>
        </div>
    </div>
    
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://cdn.ckeditor.com/4.13.1/standard/ckeditor.js"></script>
<script>
    CKEDITOR.replace( 'content' );
</script>
</body>
</html>