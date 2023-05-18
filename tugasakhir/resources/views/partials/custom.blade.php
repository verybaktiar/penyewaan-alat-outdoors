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
});
</script>