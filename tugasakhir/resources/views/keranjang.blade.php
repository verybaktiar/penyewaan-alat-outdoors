@extends('layouts.main')
@section('container')

	<div class="container">
		<div class="row">
			<div class="col-md-12 text-center">
				<div class="text-pageheader">
					<div class="subtext-image" data-scrollreveal="enter bottom over 1.7s after 0.0s">
						 Checkout
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
</header>

@if (session('status_checkout'))
    <div class="alert alert-success">
        {{ session('status_checkout') }}
    </div>
@endif

<!-- CONTENT =============================-->
<section class="item content">
<div class="container toparea">
	<div class="underlined-title">
		<div class="editContent">
			<h1 class="text-center latestitems">Buat Pembayaran</h1>
		</div>
		<div class="wow-hr type_short">
			<span class="wow-hr-h">
			<i class="fa fa-star"></i>
			<i class="fa fa-star"></i>
			<i class="fa fa-star"></i>
			</span>
		</div>
	</div>
	<div id="edd_checkout_wrap" class="col-md-8 col-md-offset-2">
		<form id="edd_checkout_cart_form" method="post">
			<div id="edd_checkout_cart_wrap">
				<table id="edd_checkout_cart" class="ajaxed">
				<thead>
				<tr class="edd_cart_header_row">
					<th class="edd_cart_item_name">Nama Barang</th>
					<th class="edd_cart_item_price">Harga Sewa (/hari)</th>
					<th class="edd_cart_rental_period">Masa Sewa</th>
					<th class="edd_cart_total_price">Total Harga</th>
					<th class="edd_cart_actions">Actions</th>
				</tr>
				</thead>
				<tbody>
					<?php $total_harga = 0; ?>
					@foreach($list_keranjang as $val_keranjang)
					<tr class="edd_cart_item" id="edd_cart_item_0_25" data-download-id="25">
						<td class="edd_cart_item_name">
							<div class="edd_cart_item_image">
								<img width="25" height="25" src="alatoutdoor1/{{ $val_keranjang->image }}" alt="">  
								<span class="edd_checkout_cart_item_title">{{ $val_keranjang->nama_alat }}</span>
							</div>
						</td>
						<td class="edd_cart_item_price">
							{{ ke_rupiah($val_keranjang->harga_sewa) }}
						</td>
						<td class="edd_cart_rental_period">
							<?php
								$mulai_sewa = new DateTime($val_keranjang->mulai_sewa);
								$akhir_sewa = new DateTime($val_keranjang->akhir_sewa);
								$lama_sewa = $mulai_sewa->diff($akhir_sewa)->d;
							?>
							<b>{{ $lama_sewa }} Hari</b>
						</td>
						<td class="edd_cart_total_price">
							{{ ke_rupiah($lama_sewa * $val_keranjang->harga_sewa) }}
						</td>
						<td class="edd_cart_actions">
							<button class="btn btn-danger edd_cart_remove_item_btn" id-keranjang="{{ $val_keranjang->id_keranjang }}"><i class="fa fa-trash"></i> Hapus</button>
						</td>
					</tr>
					<?php $total_harga += $lama_sewa * $val_keranjang->harga_sewa; ?>
					@endforeach
				</tbody>
				<tfoot>
				<tr class="edd_cart_footer_row edd_cart_discount_row" style="display:none;">
					<th colspan="5" class="edd_cart_discount">
					</th>
				</tr>
				<tr class="edd_cart_footer_row">
					<th colspan="5" class="edd_cart_total_price">
						 Total: <span class="edd_cart_amount">{{ ke_rupiah($total_harga) }}</span>
					</th>
				</tr>
				</tfoot>
				</table>
			</div>
		</form>

		@if(!empty($total_keranjang))

		<div id="edd_checkout_form_wrap" class="edd_clearfix">
			<form id="edd_purchase_form" class="edd_form" action="#" method="POST">
				<fieldset id="edd_checkout_user_info">
					<legend>Personal Info</legend>
					<p id="edd-email-wrap">
						<label class="edd-label" for="edd-email">
						Email Address <span class="edd-required-indicator">*</span></label>
						<input class="edd-input required" type="email" name="email" placeholder="Email address" id="edd-email" value="{{ $get_pelanggan->email }}" required>
					</p>
					<p id="edd-fullname-wrap">
						<label class="edd-label" for="edd-fullname">
						Fullname <span class="edd-required-indicator">*</span>
						</label>
						<input class="edd-input required" type="text" name="fullname" placeholder="Full Name" id="edd-fullname" value="{{ $get_pelanggan->nama_pelanggan }}" required>
					</p>
					<p id="edd-address-wrap">
						<label class="edd-label" for="edd-address">
						Address <span class="edd-required-indicator">*</span></label>
						<input class="edd-input required" type="text" name="address" placeholder="Address" id="edd-address" value="{{ $get_pelanggan->alamat }}" required>
					</p>
					<p id="edd-nophone-wrap">
						<label class="edd-label" for="edd-nophone">
						No Phone <span class="edd-required-indicator">*</span></label>
						<input class="edd-input required" type="text" name="nophone" placeholder="No. Phone" id="edd-nophone" value="{{ $get_pelanggan->no_telepon }}" required>
					</p>
				</fieldset>
				<fieldset>
					<div class="container mt-5 mb-5 d-flex justify-content-center">
						<div class="card p-5">
						  	<div>
						    	<h4 class="heading">Detail Pembayaran</h4>
						    	<p class="text">Please make the payment as soon as possible</p>
						    </div>
						    <span class="detail mt-5">Metode Transfer</span>
							    <div class="col-md-12">
									<div class="d-flex flex-row align-items-center">
										<div class="d-flex flex-column">
											<div class="col-md-1"><img src="https://www.bca.co.id/-/media/Feature/Card/List-Card/2022/BCA-Union-Pay-Card-Final-Front.png?v=1" class="rounded" width="70"></div>
											<div class="col-md-3"><span class="business">( <b> BCA </b> ) <b>A.N</b> Bambang GG</span></div>
											<div class="col-md-8"><span class="plan">1234 5678 9011 1234</span></div>
										</div>
									</div>
							    </div>
							    <div class="col-md-12">
									<div class="d-flex flex-row align-items-center">
										<div class="d-flex flex-column">
											<div class="col-md-1"><img src="https://www.bni.co.id/portals/3/BNI/CreditCard/Produk/Images/kartu-kredit-bni-visa-infinite-v1.jpg" class="rounded" width="70"></div>
											<div class="col-md-3"><span class="business">( <b> BNI </b> ) <b>A.N</b> Bambang GG</span></div>
											<div class="col-md-8"><span class="plan">1234 5678 9011 1234</span></div>
										</div>
									</div>
							    </div>
							</span>
						</div>
					</div>
				</fieldset>
				<fieldset class="text-center">
					<input type="hidden" name="edd_action" value="purchase">
					<input type="hidden" name="edd-gateway" value="manual">
					<button class="btn btn-primary" id="checkout-button" data-toggle="modal" data-target="#modal-upload-payment">
						<i class="fa fa-check-square"></i> Checkout 
					</button>
				</fieldset>
			</form>
		</div>

		@else
		<fieldset class="text-center">
			<b>You dont have any items !</b>
		</fieldset>
		@endif

		<div id="modal-upload-payment" class="modal fade" role="dialog">
		  <div class="modal-dialog">
		    <div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Upload Data</h4>
				</div>
		      	<div class="modal-body">

	        		<form id="edd_form_upload_payment" class="edd_form" method="POST" enctype="multipart/form-data">
	        			@csrf
				        <div class="form-group">
				        	<label for="file_upload_payment">Bukti Pembayaran</label> *
				            <input type="file" name="file_upload_payment" id="file_upload_payment" class="form-control">
				            <small id="emailHelp" class="form-text text-muted">Data mu aman bersama kami !</small>
				        </div>

				        <div class="form-group">
				        	<label for="jaminan">Jaminan</label> *
				            <select class="form-control select2" name="jaminan">
				            	<option value="KTP">KTP</option>
				            	<option value="SIM">SIM</option>
				            </select>
				        </div>

				        <div class="form-group">
				        	<label for="file_upload_jaminan">Foto Jaminan</label> *
				            <input type="file" name="file_upload_jaminan" id="file_upload_jaminan" class="form-control">
				            <small id="emailHelp" class="form-text text-muted">Data mu aman bersama kami !</small>
				        </div>

				        <button type="submit" class="btn btn-info" id="btn_upload">Upload</button>
    		      	</form>
    		      	
		      	</div>
		    </div>
		  </div>
		</div>

	</div>
</div>
</section>
@endsection
