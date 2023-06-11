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
	<div class="row" style="padding-bottom: 100px;">
		<div class="col-md-1">Kategori</div>
		<div class="col-md-3">
			<select class="form-control select2" id="filterKategori">
					<option value="ALL">ALL</option>
				@foreach($kategoris as $kategori)
					<option value="{{ $kategori->nama_kategori }}"> {{ $kategori->nama_kategori }} </option>
				@endforeach
			</select>
		</div>
	</div>
	<div class="row">
		@foreach($alatoutdoors as $alatoutdoor)
		<div class="col-md-4 alatoutdoor-item" data-kategori="{{ $alatoutdoor->nama_kategori }}">
			<div class="productbox">
				<div class="fadeshop">
					<div class="captionshop text-center" style="display: none;">
						<h3>{{ $alatoutdoor->nama_alat }}</h3>
						<p>
							{{ $alatoutdoor->spesifikasi }}
						</p>
						<p>
							<a class="learn-more add-item-{{ $alatoutdoor->id_alatoutdoor }}" id-product="{{ $alatoutdoor->id_alatoutdoor }}"><i class="fa fa-shopping-cart"></i> Keranjang</a>
							<a class="learn-more detail-item-{{ $alatoutdoor->id_alatoutdoor }}" id-product="{{ $alatoutdoor->id_alatoutdoor }}"><i class="fa fa-link"></i> Details</a>
						</p>
					</div>
					<span class="maxproduct"><img src="alatoutdoor1/{{ $alatoutdoor->image }}" alt=""></span>
				</div>
				<div class="product-details">
					<a>
					<h1>{{ $alatoutdoor->nama_alat }}</h1>
					</a>
					<span class="price">
					<span class="edd_price">{{ ke_rupiah($alatoutdoor->harga_sewa)  }} / Hari</span>
					</span>
				</div>
			</div>
		</div>
		@endforeach

		<!-- Modal Masa Rental  -->
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
			    	    	<input class="attr-id-rental" type="hidden" name="id_alatoutdoor"/>
			    	    	<div class="col-md-1 text-center">Dari</div>
			    	    	<div class="col-md-4">
			    	    		<input type="text" id="mulai_sewa" class="form-control datepicker" name="mulai_sewa"/>
			    	    	</div>
			    	    	<div class="col-md-2 text-center">Sampai </div>
			    	    	<div class="col-md-4">
			    	    		<input type="text" id="akhir_sewa" class="form-control datepicker" name="akhir_sewa"/>
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

		<!-- Modal Detail Item  -->
		<div id="modal-detail-item" class="modal fade" role="dialog" tabindex="-1">
		  <div class="modal-dialog modal-dialog-centered">
		    <div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Detail Barang</h4>
				</div>
		      	<div class="modal-body">
			        <form id="detail-item" class="form" method="POST" enctype="multipart/form-data">
			        	@csrf
			    	    <div class="row">
			    	    	<div class="col-md-12">
			    	    		<p><b>Nama Alat	:</b> <span class="nama-item"></span></p>
			    	    	</div>
			    	    	<div class="col-md-12">
			    	    		<p><b>Spesifikasi	: </b><span class="spesifikasi-item"></span></p> 
			    	    	</div>
			    	    	<div class="col-md-12">
			    	    		<p><b>Harga Sewa	: </b><span class="harga-item"></span></p>
			    	    	</div>
			    	    	<div class="col-md-12">
			    	    		<p><b>Deskripsi	: </b><span class="deskripsi-item"></span></p>
			    	    	</div>
			    	    </div>
			        </form>
		      	</div>
		      	<div class="modal-footer">
			        <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
			    </div>
		    </div>
		  </div>
		</div>
		
	</div>
</div>
</div>
</section>
@endsection