@extends('layouts.main')
@section('container')

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
							<a class="learn-more add-item-{{ $alatoutdoor }}" id-product="{{ $alatoutdoor->id_alatoutdoor }}"><i class="fa fa-shopping-cart"></i> Keranjang</a>
							<a href="{{ route('details.show', $alatoutdoor->id_alatoutdoor) }}" class="learn-more detailslearn"><i class="fa fa-link"></i> Details</a>
						</p>
					</div>
					<span class="maxproduct"><img src="alatoutdoor1/{{ $alatoutdoor->image }}" alt=""></span>
				</div>
				<div class="product-details">
					<a href="{{ route('details.show', $alatoutdoor->id_alatoutdoor) }}">
					<h1>{{ $alatoutdoor->nama_alat }}</h1>
					</a>
					<span class="price">
					<span class="edd_price"> Rp. {{ $alatoutdoor->harga_sewa }} / Hari</span>
					</span>
				</div>
			</div>
			<div id="modal-rental-period" class="modal fade" role="dialog" tabindex="-1">
			  <div class="modal-dialog modal-dialog-centered">
			    <div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h4 class="modal-title">Mau sewa sampai kapan ?</h4>
					</div>
			      	<div class="modal-body">
				        <form id="rental-period" class="form" method="POST" enctype="multipart/form-data">
				        	@csrf
				    	    <div class="row">
				    	    	<input class="attr-id" type="hidden" name="id_alatoutdoor"/>
				    	    	<div class="col-md-1 text-center">Dari</div>
				    	    	<div class="col-md-4">
				    	    		<input type="date" class="form-control datepicker" name="mulai_sewa"/>
				    	    	</div>
				    	    	<div class="col-md-2 text-center">Sampai </div>
				    	    	<div class="col-md-4">
				    	    		<input type="date" class="form-control datepicker" name="akhir_sewa"/>
				    	    	</div>
				    	    </div>
				        </form>
			      	</div>
			      	<div class="modal-footer">
				        <button type="button" class="btn btn-primary input-to-cart">Masukan keranjang</button>
				        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				    </div>
			    </div>
			  </div>
			</div>
		</div>
		@endforeach
		
	</div>
</div>
</div>
</section>
@endsection