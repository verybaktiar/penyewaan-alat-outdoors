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

	 $('#edd_form_upload_payment').on('submit', function(e){
	 	e.preventDefault();

 		$.ajax({
	        url: "{{ route('keranjang.upload_payment') }}" ,
	        method: 'POST',
            dataType: 'JSON',
            contentType: false,
            cache: false,
            processData: false,
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
	        data: {
	        	_token: '{{csrf_token()}}',
	        	id_keranjang:idKeranjang,
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
});
</script>