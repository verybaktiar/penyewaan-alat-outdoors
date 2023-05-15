@extends('dashboard.layouts.main')

@section( 'container')
<html>
    <title>users</title>
</html>

        <!-- START DATA -->
        <div class="my-3 p-3 bg-body rounded shadow-sm">
            <!-- FORM PENCARIAN -->
            <div class="pb-3">
              <form class="d-flex" action="" method="get">
                  <input class="form-control me-1" type="search" name="katakunci" value="{{ Request::get('katakunci') }}" placeholder="Masukkan kata kunci" aria-label="Search">
                  <button class="btn btn-secondary" type="submit">Cari</button>
              </form>
            </div>
            
            <!-- TOMBOL TAMBAH DATA -->
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th class="col-md-1">Id User</th>
                        <th class="col-md-1">Username</th>
                        <th class="col-md-2">Email</th>
                        <th class="col-md-2">Role</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($datauser as $item)
                    <tr>
                        <td>{{ $item->id_user }}</td>
                        <td>{{ $item->username }}</td>
                        <td>{{ $item->email }}</td>
                        <td>
                            <a href='' class="btn btn-warning btn-sm">Edit</a>
                            <a href='' class="btn btn-danger btn-sm">Del</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
           
      </div>
@endsection