@extends('layouts.main')
@section('container')

	<div class="container">
		<div class="row">
			<div class="col-md-12 text-center">
				<div class="text-homeimage">
					<div class="maintext-image" data-scrollreveal="enter top over 1.5s after 0.1s">
						Rent and Gear
					</div>
					<div class="subtext-image" data-scrollreveal="enter bottom over 1.7s after 0.3s">
						Boost rent with Bakool Outdoor
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
</header>

<!-- STEPS =============================-->
<div class="item content">
	<div class="container toparea">
		<div class="row text-center">
			<div class="col-md-4">
				<div class="col editContent">
					<span class="numberstep"><i class="fa fa-shopping-cart"></i></span>
                    <h3 class="numbertext">Bakool Outdoor</h3>
					<p>
						 Menyediakan perlengkapan alat camping/kemah outdoor terlengkap dengan berbagai jenis dan kondisi yang baik. Booking alat outdoor yang anda inginkan dan tentukan waktu pengambilan sendiri
					</p>
				</div>
				<!-- /.col-md-4 -->
			</div>
			<!-- /.col-md-4 col -->
			<div class="col-md-4 editContent">
				<div class="col">
					<span class="numberstep"><i class="fa fa-gift"></i></span>
					<h3 class="numbertext">Bayar Qris, BCA & Mandiri</h3>
					<p>
						 Pembayaran mudah dan cepat dapat dilakukan melalui Qris, transfer bank BCA & Mandiri. Dengan harga yang terjangkau, barang yang kami sewakan memiliki kualitas yang sangat bagus dan terawat demi keamanan dan kenyamanan anda
					</p>
				</div>
				<!-- /.col -->
			</div>
			<!-- /.col-md-4 col -->
			<div class="col-md-4 editContent">
				<div class="col">
					<span class="numberstep"><i class="fa fa-download"></i></span>
					<h3 class="numbertext">Booking Sewa Alat Outdoor</h3>
					<p>
						 Booking penyewaan alat outdoor dengan cepat dan mudah, cek update ketersediaan stok produk alat outdoor pada website. Bagi Anda yang ingin menghabiskan waktu liburan Anda untuk hiking namun bingung ingin menyewa perlengkapan camping. Kami adalah solusi yang tepat untuk anda
				</div>
			</div>
		</div>
	</div>
</div>
	
<!-- LATEST ITEMS =============================-->
<section class="item content">
	<div class="container">
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

		<div class="row">

			@foreach($sample_alatoutdoor as $alatoutdoor)

			<!-- /.productbox -->
			<div class="col-md-4">
				<div class="productbox">
					<div class="fadeshop">
						<div class="captionshop text-center" style="display: none;">
							<h3>{{$alatoutdoor->nama_alat}}</h3>
							<p>
							   {{$alatoutdoor->spesifikasi}}
							</p>
							<p>
								<a class="learn-more add-item-{{ $alatoutdoor }}" id-product="{{ $alatoutdoor->id_alatoutdoor }}"><i class="fa fa-shopping-cart"></i> Keranjang</a>
								<a class="learn-more view-item-{{ $alatoutdoor }}" id-product="{{ $alatoutdoor->id_alatoutdoor }}"><i class="fa fa-link"></i> Details</a>
							</p>
						</div>
						<span class="maxproduct"><img src="alatoutdoor1/{{ $alatoutdoor->image }}" alt=""></span>
					</div>
					<div class="product-details">
						<a href="/details">
						<h1>{{$alatoutdoor->nama_alat}}</h1>
						</a>
						<span class="price">
						<span class="edd_price">{{$alatoutdoor->harga_sewa}}</span>
						</span>
					</div>
				</div>
			</div>

			@endforeach

		</div>
	</div>
</div>
</section>

<!-- BUTTON =============================-->
<div class="item content">
	<div class="container text-center">
		<a href="/sewa" class="homebrowseitems">Browse All Products
		<div class="homebrowseitemsicon">
			<i class="fa fa-star fa-spin"></i>
		</div>
		</a>
	</div>
</div>
<br/>

<!-- AREA =============================-->
<div class="item content">
	<div class="container">
		<div class="row">
			<div class="col-md-4">
				<i class="fa fa-microphone infoareaicon"></i>
				<div class="infoareawrap">
					<h1 class="text-center subtitle">Pertanyaan Umum</h1>
					<p>
						Ingin melakukan transaksi sewa tetapi masih ragu? Kesulitan menyelesaikan pembayaran? Atau hanya ingin menyapa? Kirimkan pesan Anda dan kami akan menjawab sesegera mungkin!
					</p>
					<p class="text-center">
						<a href="whatsapp://send?text=Hello&phone=+6285749252096">- Hubungi Kami -</a>
					</p>
				</div>
			</div>
			<!-- /.col-md-4 col -->
			<div class="col-md-4">
				<i class="fa fa-comments infoareaicon"></i>
				<div class="infoareawrap">
					<h1 class="text-center subtitle">Alat - alat pilihan</h1>
					<p>
						 Alat - alat outdoor yang kami sewakan merupakan alat yang sudah terpilih dalam pengujian kualitas layak pemakaian dan layak keamanan.  
					</p>
					<p class="text-center">
						<a href="#">- Select Theme -</a>
					</p>
				</div>
			</div>
			<!-- /.col-md-4 col -->
			<div class="col-md-4">
				<i class="fa fa-bullhorn infoareaicon"></i>
				<div class="infoareawrap">
					<h1 class="text-center subtitle">Hire Us</h1>
					<p>
						 If you wish to change an element to look or function differently than shown in the demo, we will be glad to assist you. This is a paid service due to theme support requests solved with priority.
					</p>
					<p class="text-center">
						<a href="#">- Get in Touch -</a>
					</p>
				</div>
			</div>
		</div>
	</div>
</div>

<!-- TESTIMONIAL =============================-->
<div class="item content">
	<div class="container">
		<div class="col-md-10 col-md-offset-1">
			<div class="slide-text">
				<div>
					<h2><span class="uppercase">Reviewers</span></h2>
					<img src="http://wowthemes.net/demo/salique/salique-boxed/images/temp/avatar2.png" alt="Awesome Support">
					<p>
						 The support... I can only say it's awesome. You make a product and you help people out any way you can even if it means that you have to log in on their dashboard to sort out any problems that customer might have. Simply Outstanding!
					</p>
					<i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection