@extends('layouts.main')
<title>Sewa</title>
@section( 'container')

	<div class="container">
		<div class="row">
			<div class="col-md-12 text-center">
				<div class="text-pageheader">
					<div class="subtext-image" data-scrollreveal="enter bottom over 1.7s after 0.1s">
						 Shop
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
			<h1 class="text-center latestitems">OUR PRODUCTS</h1>
		</div>
		<div class="wow-hr type_short">
			<span class="wow-hr-h">
			<i class="fa fa-star"></i>
			<i class="fa fa-star"></i>
			<i class="fa fa-star"></i>
			</span>
		</div>
	</div>
	@foreach($alatoutdoors as $alatoutdoor)
	<div class="row">
		<div class="col-md-4">
			<div class="productbox">
				<div class="fadeshop">
					<div class="captionshop text-center" style="display: none;">
						<h3>{{ $alatoutdoor->nama_alat }}</h3>
						<p>
							{{ $alatoutdoor->spesifikasi }}
						</p>
						<p>
							<a href="/keranjang" class="learn-more detailslearn"><i class="fa fa-shopping-cart"></i> Keranjang</a>
							<a href="{{ route('details.show', $alatoutdoor->id_alatoutdoor) }}" class="learn-more detailslearn"><i class="fa fa-link"></i> Details</a>
						</p>
					</div>
					<span class="maxproduct"><img src="{{ url('storage/alatoutdoor1/') }}/{{ $alatoutdoor->image }}" alt=""></span>
				</div>
				<div class="product-details">
					<a href="{{ route('details.show', $alatoutdoor->id_alatoutdoor) }}">
					<h1>{{ $alatoutdoor->nama_alat }}</h1>
					</a>
					<span class="price">
					<span class="edd_price"> {{ $alatoutdoor->harga_sewa }}</span>
					</span>
				</div>
			</div>
		</div>
		@endforeach
		
	</div>
</div>
</div>
</section>
@endsection