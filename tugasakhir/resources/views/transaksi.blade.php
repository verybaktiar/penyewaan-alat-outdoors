@extends('layouts.main')
@section('container')

	<div class="container">
		<div class="row">
			<div class="col-md-12 text-center">
				<div class="text-pageheader">
					<div class="subtext-image" data-scrollreveal="enter bottom over 1.7s after 0.0s">
						 Transaksi
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
</header>

<!-- CONTENT =============================-->
<section class="item content">
<div class="container toparea">
	<div class="underlined-title">
		<div class="editContent">
			<h1 class="text-center latestitems">List Transaksi</h1>
		</div>
		<div class="wow-hr type_short">
			<span class="wow-hr-h">
			<i class="fa fa-star"></i>
			<i class="fa fa-star"></i>
			<i class="fa fa-star"></i>
			</span>
		</div>
	</div>
	<div id="edd_checkout_wrap" class="col-md-12">

		@if (session('status_checkout'))
		    <div class="alert alert-success">
		        {{ session('status_checkout') }}
		    </div>
		@endif

		@if(!empty($total_transaksi))

		<div id="edd_checkout_cart_wrap">
			<table id="edd_checkout_cart" class="ajaxed">
				<thead>
				<tr class="edd_cart_header_row">
					<th>ID Transaksi</th>
					<th>Jaminan</th>
					<th>Total Item</th>
					<th>Tanggal Order</th>
					<th>Total Harga</th>
					<th>Status</th>
					<th>Action</th>
				</tr>
				</thead>
				<tbody>
					@foreach($list_transaksi as $item_transaksi)
					<tr>
						<td>{{ $item_transaksi->id_transaksi }}</td>
						<td>{{ $item_transaksi->jaminan }}</td>
						<td>
							<?php
								$list_item = explode(',',$item_transaksi->list_id_keranjang);
								echo count($list_item);
							?>
						</td>
						<td>{{ date('d-m-Y H:m:s', strtotime($item_transaksi->created_at)) }}</td>
						<td>{{ ke_rupiah($item_transaksi->total_bayar) }}</td>
						<td>
							<?php
								if($item_transaksi->status_bayar == 'Sudah'){
									echo '<span class="label label-md label-success">Sudah</span>';
								}else{
									echo '<span class="label label-md label-warning">Belum</span>';
								}
							?>
						</td>
						<td>
							<button type="button" class="btn btn-sm btn-primary detail-trans-{{ $item_transaksi->id_transaksi }}" id-trans="{{ $item_transaksi->id_transaksi }}"><i class="fa fa-exclamation"></i> Detail</button>
							<a href="{{ route('home.get_invoice', 'id='.$item_transaksi->id_transaksi) }}" class="btn btn-sm btn-warning invoice-trans-{{ $item_transaksi->id_transaksi }}" id-trans="{{ $item_transaksi->id_transaksi }}" target="_blank"><i class="fa fa-book"></i> Invoice</a>
						</td>
					</tr>
					@endforeach
				</tbody>
			</table>
		</div>

		<div id="modal-detail-trans" class="modal fade" role="dialog">
		  <div class="modal-dialog modal-lg">
		    <div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">List Item</h4>
				</div>
		      	<div class="modal-body">
				<table class="table table-detail">
					<thead>
						<tr>
							<th>Nama Barang</th>
							<th>Harga Sewa (/hari)</th>
							<th>Mulai Sewa</th>
							<th>Akhir Sewa</th>
							<th>Masa Sewa</th>
							<th>Total Harga</th>
						</tr>
					</thead>
					<tbody></tbody>
					<tfoot></tfoot>
				</table>
		    </div>
		  </div>
		</div>

		@else
		<fieldset class="text-center">
			<h3>Tidak ada Item apapun</h3>
		</fieldset>
		@endif

	</div>
</div>
</section>
@endsection
