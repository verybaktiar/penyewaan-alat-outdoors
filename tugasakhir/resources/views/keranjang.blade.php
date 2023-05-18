@extends('layouts.main')
<title>Keranjang</title>
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
					@foreach($list_keranjang as $val_keranjang)
					<tr class="edd_cart_item" id="edd_cart_item_0_25" data-download-id="25">
						<td class="edd_cart_item_name">
							<div class="edd_cart_item_image">
								<img width="25" height="25" src="home1/images/scorilo2-70x70.jpg" alt="">  
								<span class="edd_checkout_cart_item_title">{{ $val_keranjang->nama_alat }}</span>
							</div>
						</td>
						<td class="edd_cart_item_price">
							 {{ $val_keranjang->harga_sewa }}
						</td>
						<td class="edd_cart_actions">
							<a class="edd_cart_remove_item_btn" href="/keranjang">Remove</a>
						</td>
					</tr>
					@endforeach
				</tbody>
				<tfoot>
				<tr class="edd_cart_footer_row edd_cart_discount_row" style="display:none;">
					<th colspan="5" class="edd_cart_discount">
					</th>
				</tr>
				<tr class="edd_cart_footer_row">
					<th colspan="5" class="edd_cart_total">
						 Total: <span class="edd_cart_amount" data-subtotal="11.99" data-total="11.99">$11.99</span>
					</th>
				</tr>
				</tfoot>
				</table>
			</div>
		</form>
		<div id="edd_checkout_form_wrap" class="edd_clearfix">
			<form id="edd_purchase_form" class="edd_form" action="#" method="POST">
				<fieldset id="edd_checkout_user_info">
					<legend>Personal Info</legend>
					<p id="edd-email-wrap">
						<label class="edd-label" for="edd-email">
						Email Address <span class="edd-required-indicator">*</span></label>
						<input class="edd-input required" type="email" name="edd_email" placeholder="Email address" id="edd-email" value="">
					</p>
					<p id="edd-first-name-wrap">
						<label class="edd-label" for="edd-first">
						First Name <span class="edd-required-indicator">*</span>
						</label>
						<input class="edd-input required" type="text" name="edd_first" placeholder="First name" id="edd-first" value="" required="">
					</p>
					<p id="edd-last-name-wrap">
						<label class="edd-label" for="edd-last">
						Last Name </label>
						<input class="edd-input" type="text" name="edd_last" id="edd-last" placeholder="Last name" value="">
					</p>
				</fieldset>
				<fieldset id="edd_purchase_submit">
					<p id="edd_final_total_wrap">
						<strong>Purchase Total:</strong>
						<span class="edd_cart_amount" data-subtotal="11.99" data-total="11.99">$11.99</span>
					</p>
					<input type="hidden" name="edd_action" value="purchase">
					<input type="hidden" name="edd-gateway" value="manual">
					<input type="submit" class="edd-submit button" id="edd-purchase-button" name="edd-purchase" value="Purchase">
				</fieldset>
			</form>
		</div>
	</div>
</div>
</section>
@endsection
