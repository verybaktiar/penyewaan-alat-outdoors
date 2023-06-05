<!-- CUSTOMSCRIPTS =============================-->
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
		$('.attr-id-rental').val(idAlatOutdoor);

		$('#modal-rental-period').modal('toggle');
	});

	$('[class*=detail-item-]').click(function() {
		var idAlatOutdoor = $(this).attr('id-product');

		$.ajax({
	        url: "{{ route('penyewaan.get_alatoutdoor') }}" ,
	        type: 'POST',
	        dataType: 'JSON',
	        data: {
	        	_token : '{{csrf_token()}}',
	        	id_alatoutdoor : idAlatOutdoor
	        },
	        success: function (response) {
	        	$('.nama-item').text(response.nama_alat);
	        	$('.spesifikasi-item').text(response.spesifikasi);
	        	$('.harga-item').html(formatRupiah(response.harga_sewa,',') + '<b> / Hari </b>');
	        	$('.deskripsi-item').text(response.deskripsi);

    			$('#modal-detail-item').modal('toggle');
	        },
	        error: function(xhr, status, error) {
	        	Swal.fire('Gagal !', 'Terjadi Kesalahan', 'error');
				console.log(xhr);
				console.log(status);
				console.log(error);
	        }
	    });
	});

	$('[class*=detail-opentrip-]').click(function() {
		var idOpentrip = $(this).attr('id-product');

		$.ajax({
	        url: "{{ route('opentripview.get_opentrip') }}" ,
	        type: 'POST',
	        dataType: 'JSON',
	        data: {
	        	_token : '{{csrf_token()}}',
	        	id_opentrip : idOpentrip
	        },
	        success: function (response) {
	        	$('.nama-item').text(response.nm_opentrip);
	        	$('.fasilitas-item').text(response.fasilitas);
	        	$('.harga-item').html(formatRupiah(response.harga,',') + '<b> / Trip </b>');
	        	$('.deskripsi-item').text(response.deskripsi);

    			$('#modal-detail-opentrip').modal('toggle');
	        },
	        error: function(xhr, status, error) {
	        	Swal.fire('Gagal !', 'Terjadi Kesalahan', 'error');
				console.log(xhr);
				console.log(status);
				console.log(error);
	        }
	    });
	});

	$('.input-to-cart').click(function(){
		var itemData = $('#rental-period').serialize();
		$.ajax({
	        url: "{{ route('home.store') }}" ,
	        type: 'POST',
	        data: itemData,
	        success: function (response) {
    			if(response.status == 'success'){
    				var cartTotal = parseInt($('.cart-badge').html());
                    Swal.fire('Berhasil !', response.message, response.status);
                    
                    $('.cart-badge').html(cartTotal + 1);
                    $('#modal-rental-period').modal('toggle');
                }else{
                    Swal.fire('Gagal !',response.message, response.status);
                }
	        },
	        error: function(xhr, status, error) {
	        	Swal.fire('Gagal !', 'Terjadi Kesalahan', 'error');
				console.log(xhr);
				console.log(status);
				console.log(error);
	        }
	    });
	})

	 $('#checkout-button').on('submit', function(e){
	 	e.preventDefault();

 		$.ajax({
	        url: "{{ route('keranjang.upload_payment') }}" ,
	        method: 'POST',
	        data: new FormData(this),
	        success: function (response) {
    			if(response.status == 'success'){
    				Swal.fire('Berhasil !', response.message, response.status);
                }else{
                    Swal.fire('Gagal !',response.message, response.status);
                }
	        },
	        error: function(xhr, status, error) {
	        	Swal.fire('Gagal !', 'Terjadi Kesalahan', 'error');
				console.log(xhr);
				console.log(status);
				console.log(error);
	        }
	    });
	});

	$('.edd_cart_remove_item_btn').click(function() {
		var idKeranjang = $(this).attr('id-keranjang');

		$.ajax({
	        url: "{{ route('keranjang.delete_item') }}" ,
	        type: 'POST',
	        dataType: 'JSON',
	        data: {
	        	_token : '{{csrf_token()}}',
	        	id_keranjang : idKeranjang
	        },
	        success: function (response) {
    			if(response.status == 'success'){
                    Swal.fire('Berhasil !', response.message, response.status);
                    window.location.href = 'keranjang';
                }else{
                    Swal.fire('Gagal !',response.message, response.status);
                }
	        },
	        error: function(xhr, status, error) {
	        	Swal.fire('Gagal !', response.message, response.status);
				console.log(xhr);
				console.log(status);
				console.log(error);
			}
	    });
	});

	function formatRupiah(angka, prefix) {

        var number_string = angka.replace(/[^,\d]/g, '').toString(),
                split   = number_string.split(','),
                sisa    = split[0].length % 3,
                rupiah  = split[0].substr(0, sisa),
                ribuan  = split[0].substr(sisa).match(/\d{3}/gi);

        if (ribuan) {
            separator = sisa ? '.' : '';
            rupiah += separator + ribuan.join('.');
        }

        rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
        return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
    }
});
</script>