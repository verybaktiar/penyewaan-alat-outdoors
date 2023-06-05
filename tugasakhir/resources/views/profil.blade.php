@extends('layouts.main')
@section( 'container')

	<div class="container">
		<div class="row">
			<div class="col-md-12 text-center">
				<div class="text-pageheader">
					<div class="subtext-image" data-scrollreveal="enter bottom over 1.7s after 0.0s">
						 Profil
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
	<p>
		Bakool Outdoor merupakan tempat penyewaan perlengkapan camping/kemah outdoor terbaik dan terlengkap di Surabaya, dalam hal pelayanan kami selalu mengedepankan kepuasan pelanggan sebagai preoritas utama.
		Berdiri sejak tahun 2020 dengan menawarkan harga yang sangat murah dengan alat - alat yang berkualitas dan terawat. jika anda ingin menghabiskan waktu libuaran anda untuk hiking
		dan bingung ingin menyewa perlengkapan camping/kemah, kami adalah solusi yang tepat untuk anda dengan harga yang terjangkau dan mengutamakan keselamatan.
	</p>
	<br>
	<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3957.780572679162!2d112.77792977486432!3d-7.2657942927410835!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd7fbfb03d3394f%3A0x8b75b0c06d8a8f3a!2sBAKOOL%20OUTDOOR!5e0!3m2!1sid!2sid!4v1678799906213!5m2!1sid!2sid" width="1000" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
	<br>
	<div class="underlined-title">
		<div class="editContent">
			<h1 class="text-center latestitems">Kritik dan Saran</h1>
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
		@if (session('status_input'))
			<div class="done">
				<div class="alert alert-success">
					<button type="button" class="close" data-dismiss="alert">X</button>
					OK Gann
				</div>
			</div>
		@endif
		<div class="col-lg-8 col-lg-offset-2">
			<?php if(!empty($data_user)){ ?>
			<form method="POST" action="{{ route('profile.user_comment') }}" id="contactform">
				<div class="form">
					@csrf
			        <div class="form-group">
			        	<label for="jaminan">Nama Pelanggan</label> *
			            <input type="text" name="nama_pelanggan" placeholder="Your Name *" value="{{ $data_user->nama_pelanggan }}" disabled />
			        </div>

			        <div class="form-group">
			        	<label for="jaminan">Email</label> *
			            <input type="text" name="email_pelanggan" placeholder="Your E-mail Address *" value="{{ $data_user->email }}" disabled />
			        </div>

					<div class="form-group">
			        	<label for="jaminan">Komentar</label> *
			            <textarea name="komentar" rows="7" placeholder="Type your Message *"></textarea>
			        </div>
					
					<input type="submit" id="submit" class="clearfix btn" value="Send">
				</div>
			</form>
			<?php } else { ?>
				<h3 class="text-center latestitems">Anda Harus login terlebih dahulu</h3>
			<?php } ?>
		</div>
	</div>
</div>
</div>
</section>
@endsection