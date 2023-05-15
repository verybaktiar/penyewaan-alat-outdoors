@extends('layouts.main')
<title>Open Trip</title>
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
							<a href="{{ route('detailsopentrip.show', $opentrip->id_opentrip) }}" class="learn-more detailslearn"><i class="fa fa-link"></i> Details</a>
						</p>
					</div>
					<span class="maxproduct"><img src="{{ url('storage/opentrip1/') }}/{{ $opentrip->image }}" alt=""></span>
				</div>
				<div class="product-details">
					<a href="{{ route('detailsopentrip.show', $opentrip->id_opentrip) }}">
					<h1>{{ $opentrip->nm_opentrip }}</h1>
					</a>
				</div>
			</div>
		</div>
		@endforeach
	</div>
</div>
</div>
</section>
@endsection