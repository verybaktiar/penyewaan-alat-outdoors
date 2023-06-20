<div class="wrapper">
	<nav role="navigation" class="navbar navbar-white navbar-embossed navbar-lg navbar-fixed-top">
	<div class="container">
		<div class="navbar-header">
			<button data-target="#navbar-collapse-02" data-toggle="collapse" class="navbar-toggle" type="button">
			<i class="fa fa-bars"></i>
			<span class="sr-only">Toggle navigation</span>
			</button>
			<a href="/home" class="navbar-brand brand"> Bakool Outdoor </a>
		</div>
		<div id="navbar-collapse-02" class="collapse navbar-collapse">
			<div class="nav navbar-nav navbar-right ms-auto">
				<li class="propClone"><a href="/home">Home</a></li>
				<li class="propClone"><a href="/profil">Profil</a></li>
				<li class="propClone"><a href="/sewa">Sewa</a></li>
				<li class="propClone"><a href="/opentripview">Open Trip</a></li>
				@auth
					<li class="propClone" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						<a class="nav-link dropdown-toggle" href="javascript:void(0)" role="button" data-bs-toggle="dropdown" aria-expanded="false">
							{{ auth()->user()->username }}
							</a>
						</li>
					  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" style="left: 0%;right:0%">
						<li class="dropdown-item nav-link" ><a href="/account">Profile</a></li>
						<li class="dropdown-item nav-link" ><a href="/logout">Logout</a></li>
						<li class="dropdown-item nav-link" ><a href="/list_trans">List Transaksi</a></li>
					  </div>	
					@if (!empty(auth()->user()->username))
					<li>
						<a href="/keranjang"><i class="fa fa-shopping-cart"> <div class="badge cart-badge">{{ !empty($total_keranjang) ? $total_keranjang : 0 }}</div></i></a>
					</li>
					@endif
				@else
					<li class="propClone"><a href="/login">Login</a></li>
				@endauth
		</div>
	</div>
	</nav>
</div>