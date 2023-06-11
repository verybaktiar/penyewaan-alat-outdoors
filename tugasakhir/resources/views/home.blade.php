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
						 Menyediakan perlengkapan alat camping/kemah outdoor terlengkap dengan berbagai jenis dan kondisi yang baik. Booking alat outdoor yang anda inginkan dan tentukan waktu pengambilan sendiri. Kami adalah solusi yang tepat untuk anda
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
						 Booking penyewaan alat outdoor dengan cepat dan mudah, cek update ketersediaan stok produk alat outdoor pada website. Bagi Anda yang ingin menghabiskan waktu liburan Anda untuk hiking namun bingung ingin menyewa perlengkapan.
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
				<h1 class="text-center latestitems">PRODUK UNGGULAN KAMI</h1>
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
								<a class="learn-more add-item-{{ $alatoutdoor->id_alatoutdoor }}" id-product="{{ $alatoutdoor->id_alatoutdoor }}"><i class="fa fa-shopping-cart"></i> Keranjang</a>
								<a class="learn-more detail-item-{{ $alatoutdoor->id_alatoutdoor }}" id-product="{{ $alatoutdoor->id_alatoutdoor }}"><i class="fa fa-link"></i> Details</a>
							</p>
						</div>
						<span class="maxproduct"><img src="alatoutdoor1/{{ $alatoutdoor->image }}" alt=""></span>
					</div>
					<div class="product-details">
						<a href="/details">
						<h1>{{$alatoutdoor->nama_alat}}</h1>
						</a>
						<span class="price">
						<span class="edd_price">{{ ke_rupiah($alatoutdoor->harga_sewa) }} / Hari</span>
						</span>
					</div>
				</div>

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

			@endforeach

		</div>
	</div>
</div>
</section>

<!-- BUTTON =============================-->
<div class="item content">
	<div class="container text-center">
		<a href="/sewa" class="homebrowseitems">Lihat Semua Produk
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
						 Alat - alat outdoor yang kami sewakan merupakan alat yang sudah terpilih dalam pengujian kualitas layak pemakaian dan layak keamanan. Jadi tunggu apa lagi ? pesan sekarang !
					</p>
					<p class="text-center">
						<a href="/sewa">- Go To Open Alatoutdoor -</a>
					</p>
				</div>
			</div>
			<!-- /.col-md-4 col -->
			<div class="col-md-4">
				<i class="fa fa-bullhorn infoareaicon"></i>
				<div class="infoareawrap">
					<h1 class="text-center subtitle">Berpetualang tanpa batas !</h1>
					<p>
						 Alih-alih mencoba membuat hidupmu sempurna, berikan dirimu kebebasan untuk menjadikannya sebuah petualangan. Lakukan perjalanan kemana saja mulai dari sekarang !
					</p>
					<p class="text-center">
						<a href="/opentripview">- Go To Open Trip -</a>
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