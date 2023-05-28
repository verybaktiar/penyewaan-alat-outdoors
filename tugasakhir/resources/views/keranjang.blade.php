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

<!-- CONTENT =============================-->
<section class="item content">
<div class="container toparea">
	<div class="underlined-title">
		<div class="editContent">
			<h1 class="text-center latestitems">MAKE PAYMENT</h1>
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
					<th class="edd_cart_item_name">
						 Item Name
					</th>
					<th class="edd_cart_item_price">
						 Item Price
					</th>
					<th class="edd_cart_actions">
						 Actions
					</th>
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
							Rp. {{ $val_keranjang->harga_sewa }}
						</td>
						<td class="edd_cart_actions">
							<a class="edd_cart_remove_item_btn" id-keranjang="{{ $val_keranjang->id_keranjang }}">Remove</a>
						</td>
					</tr>
					<?php $total_harga += $val_keranjang->harga_sewa; ?>
					@endforeach
				</tbody>
				<tfoot>
				<tr class="edd_cart_footer_row edd_cart_discount_row" style="display:none;">
					<th colspan="5" class="edd_cart_discount">
					</th>
				</tr>
				<tr class="edd_cart_footer_row">
					<th colspan="5" class="edd_cart_total">
						 Total: <span class="edd_cart_amount">Rp. {{ $total_harga }}</span>
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
						    	<h4 class="heading">Payment Details</h4>
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
					<input type="submit" class="edd-submit button" id="edd-purchase-button" name="edd-purchase" value="Purchase" data-toggle="modal" data-target="#modal-upload-payment">
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
					<h4 class="modal-title">Upload Proof of Payment</h4>
				</div>
		      	<div class="modal-body">
			        <form id="edd_form_upload_payment" class="edd_form" method="POST" enctype="multipart/form-data">
			        	@csrf
			        	<div class="body">
				    	    <div>Select file : <input type="file" name="file_upload_payment" id="file_upload_payment" class="form-control"></div><br>
				         	<div class="text-center"><button type="submit" class="btn btn-info" id="btn_upload">Upload</button></div>
				        </div>
			        </form>
		      	</div>
		    </div>
		  </div>
		</div>

	</div>
</div>
</section>
@endsection
