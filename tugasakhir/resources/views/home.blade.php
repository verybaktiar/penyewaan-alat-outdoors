<!DOCTYPE html>
<html>
<head>
<title>{{ $title }}</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="generator" content="">
<link href="home1/css/bootstrap.min.css" rel="stylesheet">
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css" rel="stylesheet">
<link href="home1/css/style.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Dosis:200,300,400,500,600,700" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Roboto:200,300,400,500,600,700" rel="stylesheet">
<style type="text/css">
.badge {
  padding-left: 9px;
  padding-right: 9px;
  margin-bottom: 9px;
}
</style>
</head>
<body>

<!-- HEADER =============================-->
<header class="item header margin-top-0">
    @include('partials.navbar')
<div class="container mt-4">
    @yield('container')
</div>

<!-- SCRIPTS =============================-->
<script src="home1/js/jquery-.js"></script>
<script src="home1/js/bootstrap.min.js"></script>
<script src="home1/js/anim.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<title>Home</title>
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
			<!-- /.productbox -->
			<div class="col-md-4">
				<div class="productbox">
					<div class="fadeshop">
						<div class="captionshop text-center" style="display: none;">
							<h3>Tenda</h3>
							<p>
							   TENDA CAMPING KAPASITAS 4 - 5 ORANG DOUBLE LAYER 
							</p>
							<p>
								<a class="learn-more add-item-1" id-product="KD01"><i class="fa fa-shopping-cart"></i> Keranjang</a>
								<a class="learn-more view-item-1" id-product="KD01"><i class="fa fa-link"></i> Details</a>
							</p>
						</div>
						<span class="maxproduct"><img src="home1/images/tenda.jpg" alt=""></span>
					</div>
					<div class="product-details">
						<a href="/details">
						<h1>TENDA</h1>
						</a>
						<span class="price">
						<span class="edd_price">30.000</span>
						</span>
					</div>
				</div>
			</div>

			<!-- /.productbox -->
			<div class="col-md-4">
				<div class="productbox">
					<div class="fadeshop">
						<div class="captionshop text-center" style="display: none;">
							<h3>Carrier 80L</h3>
							<p>
								 Carrier Eiger 80L
							</p>
							<p>
								<a class="learn-more add-item-2" id-product="KD2"><i class="fa fa-shopping-cart"></i> Keranjang</a>
								<a class="learn-more view-item-2" id-product="KD2"><i class="fa fa-link"></i> Details</a>
							</p>
						</div>
						<span class="maxproduct"><img src="home1/images/carrier.jpg" alt=""></span>
					</div>
					<div class="product-details">
						<a href="/details">
						<h1>Carrier 80L</h1>
						</a>
						<span class="price">
						<span class="edd_price">20.000</span>
						</span>
					</div>
				</div>
			</div>

			<!-- /.productbox -->
			<div class="col-md-4">
				<div class="productbox">
					<div class="fadeshop">
						<div class="captionshop text-center" style="display: none;">
							<h3>Sepatu Safety</h3>
							<p>
								 Sepatu hiking size 39 - 34
							</p>
							<p>
								<a class="learn-more add-item-3" id-product="KD3"><i class="fa fa-shopping-cart"></i> Keranjang</a>
								<a class="learn-more view-item-3" id-product="KD3"><i class="fa fa-link"></i> Details</a>
							</p>
						</div>
						<span class="maxproduct"><img src="home1/images/sepatu.jpg" alt=""></span>
					</div>
					<div class="product-details">
						<a href="/details">
						<h1>Sepatu Safety</h1>
						</a>
						<span class="price">
						<span class="edd_price">15.000</span>
						</span>
					</div>
				</div>
			</div>
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

<!-- CALL TO ACTION =============================-->
<section class="content-block" style="background-color:#808080;">
<div class="container text-center">
    <div class="row">
        <div class="col-sm-10 col-sm-offset-1">
            <div class="item" data-scrollreveal="enter top over 0.4s after 0.1s">
                <h1 class="callactiontitle"> Promote Items Area Give Discount to Buyers <span class="callactionbutton"><i class="fa fa-gift"></i> WOW24TH</span>
                </h1>
            </div>
        </div>
    </div>
</div>
</section>


<!-- FOOTER =============================-->
<div class="footer text-center">
    <div class="container">
        <div class="row">
            <p class="footernote">
                 Connect with Bakool Outdoor
            </p>
            <ul class="social-iconsfooter">
                <li><a href="#"><i class="fa fa-phone"></i></a></li>
                <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                <li><a href="#"><i class="fa fa-pinterest"></i></a></li>
            </ul>
            <p>
                 &copy; 2023 Bakool Outdoor<br/>
                Follow us <a href="https://www.instagram.com/bakool_outdoor/">Bakool Outdoor</a>
            </p>
        </div>
    </div>
</div>

<script>	  
jQuery(document).ready(function ($) {
    $('.fadeshop').hover(
        function(){
            $(this).find('.captionshop').fadeIn(150);
        },
        function(){
            $(this).find('.captionshop').fadeOut(150);
        }
    );

	$('[class*=add-item-]').click(function() {
		var idAlatOutdoor = $(this).attr('id-product');

		$.ajax({
	        url: "{{ route('home.store') }}" ,
	        type: 'POST',
	        data: {
	        	_token: '{{csrf_token()}}',
	        	id_alatoutdoor:idAlatOutdoor,
	        },
	        success: function (response) {
    			if(response.status == 'success'){
    				var cartTotal = parseInt($('.cart-badge').html());
                    Swal.fire('Berhasil !', response.message, response.status);
                    $('.cart-badge').html(cartTotal + 1);
                }else{
                    Swal.fire('Gagal !',response.message, response.status);
                }
	        },
	        error: function(response, jqXHR, textStatus, errorThrown) {
	        	Swal.fire('Gagal !', response.message, response.status);
	        	console.log(jqXHR, textStatus, errorThrown);
	        }
	    });
	});
});
</script>