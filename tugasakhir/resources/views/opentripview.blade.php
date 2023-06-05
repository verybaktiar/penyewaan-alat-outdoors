@extends('layouts.main')
@section( 'container')

	<div class="container">
		<div class="row">
			<div class="col-md-12 text-center">
				<div class="text-pageheader">
					<div class="subtext-image" data-scrollreveal="enter bottom over 1.7s after 0.1s">
						 Open Trip
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
			<h1 class="text-center latestitems">JOIN WITH OUR TRIP</h1>
		</div>
		<div class="wow-hr type_short">
			<span class="wow-hr-h">
			<i class="fa fa-star"></i>
			<i class="fa fa-star"></i>
			<i class="fa fa-star"></i>
			</span>
		</div>
	</div>
	@foreach($opentrips as $opentrip)
	<div class="row">
		<div class="col-md-4">
			<div class="productbox">
				<div class="fadeshop">
					<div class="captionshop text-center" style="display: none;">
						<h3>{{ $opentrip->nm_opentrip }}</h3>
						<p>
							 {{ $opentrip->deskripsi }}
						</p>
						<p>
							<a class="learn-more detail-opentrip-{{ $opentrip->id_opentrip }}" id-product="{{ $opentrip->id_opentrip }}"><i class="fa fa-link"></i> Details</a>
						</p>
					</div>
					<span class="maxproduct"><img src="opentrip1/{{ $opentrip->image }}" alt=""></span>
				</div>
				<div class="product-details">
					<a>
					<h1>{{ $opentrip->nm_opentrip }}</h1>
					</a>
				</div>
			</div>
		</div>
		@endforeach
	</div>

	<!-- Modal Detail Opentrip  -->
	<div id="modal-detail-opentrip" class="modal fade" role="dialog" tabindex="-1">
		 <div class="modal-dialog modal-dialog-centered">
		    <div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Detail Opentrip</h4>
				</div>
		      	<div class="modal-body">
			        <form id="detail-item" class="form" method="POST" enctype="multipart/form-data">
			        	@csrf
			    	    <div class="row">
			    	    	<div class="col-md-12">
			    	    		<p><b>Nama Opentrip	:</b> <span class="nama-item"></span></p>
			    	    	</div>
			    	    	<div class="col-md-12">
			    	    		<p><b>Fasilitas	: </b><span class="fasilitas-item"></span></p> 
			    	    	</div>
			    	    	<div class="col-md-12">
			    	    		<p><b>Harga	: </b><span class="harga-item"></span></p>
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
</section>
@endsection