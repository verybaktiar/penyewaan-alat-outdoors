@extends('layouts.main')
<title>Details</title>
@section('container')

	<div class="container">
		<div class="row">
			<div class="col-md-12 text-center">
				<div class="text-pageheader">
					<div class="subtext-image" data-scrollreveal="enter bottom over 1.7s after 0.0s">
						 Product Name
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
			<h1 class="text-center latestitems">Awesome Product</h1>
		</div>
		<div class="wow-hr type_short">
			<span class="wow-hr-h">
			<i class="fa fa-star"></i>
			<i class="fa fa-star"></i>
			<i class="fa fa-star"></i>
			</span>
		</div>
	</div>
	
	<div class="row">
		<div class="col-md-8">
			<div class="productbox">
				<img src="{{ url('storage/alatoutdoor1/') }}/{{ $alatoutdoor->image }}" alt="">
				<div class="clearfix">
				</div>
				<br/>
				<div class="product-details text-left">
					<p>
						Your description here. Serenity is a highly-professional & modern website theme crafted with you, the user, in mind. This light-weight theme is generous, built with custom types and enough shortcodes to customize each page according to your project. You will notice some examples of pages in demo, but this theme can do much more.
					</p>
				</div>
			</div>
		</div>
		<div class="col-md-4">
			<a href="/keranjang" class="btn btn-buynow">Masukkan Keranjang</a>
			<div class="properties-box">
				<ul class="unstyle">
					<li><b class="propertyname">Spesifikasi:</b> {{ $alatoutdoor->spesifikasi }}</li>
					<li><b class="propertyname">Merk:</b> {{ $alatoutdoor->merk }}</li>
					<li><b class="propertyname">Harga:</b> {{ $alatoutdoor->harga_sewa }}</li>
					<li><b class="propertyname">Stok:</b> {{ $alatoutdoor->stok }}</li>
				</ul>
			</div>
		</div>
	</div>
	
</div>
</section>
@endsection