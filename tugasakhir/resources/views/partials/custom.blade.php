<!-- CUSTOMSCRIPTS =============================-->
<script>  
jQuery(document).ready(function ($) {

	// Plugin Init

	// Datepicker
	$('.datepicker').datepicker({
        dateFormat : 'dd-mm-yy',
        setDate : new Date(),
        minDate : 0,
        autoclose : true
    });

    $('#mulai_sewa').datepicker('setDate','today');

    // Select2
	$('.select2').select2();

	$('#filterKategori').on('select2:select', function (e) {
		if($(this).val() != 'ALL'){
			$("[data-kategori]").fadeOut();
	    	$("[data-kategori*='"+ $(this).val() + "']").fadeIn();
		}else{
			$("[data-kategori]").fadeIn();
		}
	});

	// Animasi item Barang on hover : alat outdoor / opentrip
	$('.fadeshop').hover(
		function(){
			$(this).find('.captionshop').fadeIn(150);
		},
		function(){
			$(this).find('.captionshop').fadeOut(150);
		}
	);

	// Buka modal masa sewa alat outdoor
	$('[class*=add-item-]').click(function() {
		var idAlatOutdoor = $(this).attr('id-product');
		$('.attr-id-rental').val(idAlatOutdoor);

		$('#modal-rental-period').modal('toggle');
	});

	// Load data user untuk kebutuhan update user profile
	$('.profile_user').on('click',function(){
		var idUser = $(this).attr('attr-id-user');

		$.ajax({
	        url: "{{ route('home.get_user') }}" ,
	        type: 'POST',
	        dataType: 'JSON',
	        data: {
	        	_token : '{{csrf_token()}}',
	        	id_user : idUser
	        },
	        success: function (response) {
	        	$('#id_user').val(response.id_user);
	        	$('#username').val(response.username);
	        	$('#nama_lengkap').val(response.nama_pelanggan);
	        	$('#email').val(response.email);
	        	$('#no_telepon').val(response.no_telepon);
	        	$('#alamat').val(response.alamat);

    			$('#modal-profile-user').modal('toggle');
	        },
	        error: function(xhr, status, error) {
	        	Swal.fire('Gagal !', 'Terjadi Kesalahan', 'error');
				console.log(xhr);
				console.log(status);
				console.log(error);
	        }
	    });
	});

	// Update user profile
	$('.btn-update-user').click(function(){
		var itemData = $('#form-profile-user').serialize();
		$.ajax({
	        url: "{{ route('home.update_user') }}" ,
	        type: 'POST',
	        data: itemData,
	        success: function (response) {
    			if(response.status == 'success'){
                    Swal.fire('Berhasil !', response.message, response.status);
                    
                    $('#form-profile-user')[0].reset();
                    $('#modal-profile-user').modal('toggle');
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

	// Load data alat outdoor
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

	// Load data opentrip
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

	// Tambahkan item ke keranjang
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

	// Hapus item dari keranjang
	$('.remove_item_btn').click(function() {
		var idKeranjang = $(this).attr('id-keranjang');

		Swal.fire({
            text: 'Apa Anda yakin ingin menghapus ?',
            icon: 'question',
            buttonsStyling: !1,
            confirmButtonText: 'Sangat yakin !',
            customClass: {
                confirmButton: "btn btn-danger"
            }
        }).then(function(result) {
        	if (result.isConfirmed) {
	    		$.ajax({
			        url: "{{ route('keranjang.delete_cart_item') }}" ,
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
        	}
        });
	});

	// List Transaksi
	$('[class*=detail-trans-]').click(function() {
		var idTransaksi = $(this).attr('id-trans');

		$.ajax({
	        url: "{{ route('home.get_trans') }}" ,
	        type: 'POST',
	        dataType: 'JSON',
	        data: {
	        	_token : '{{csrf_token()}}',
	        	id_transaksi : idTransaksi
	        },
	        success: function (response) {
	        	var output = '';
	        	$('.table-detail tbody').empty();

	        	$.each(response,function(i,v){
	        		var start = moment(v.akhir_sewa, 'YYYY-MM-DD');
					var end = moment(v.mulai_sewa, 'YYYY-MM-DD');
					var dateDiff = moment.duration(start.diff(end)).asDays();

	        		output += '<tr>';
	        		output += '<td>' + v.nama_alat + '</td>';
	        		output += '<td>' + formatRupiah(v.harga_sewa,',') + '</td>';
	        		output += '<td>' + moment(v.mulai_sewa).format('DD-MM-YYYY') + '</td>';
	        		output += '<td>' + moment(v.akhir_sewa).format('DD-MM-YYYY') + '</td>';
	        		output += '<td>' + dateDiff + '</td>';
	        		output += '<td>' + formatRupiah((v.harga_sewa * dateDiff).toString(),',') + '</td>';
	        		output += '</tr>';
	        	})

	        	$('.table-detail tbody').append(output);
    			$('#modal-detail-trans').modal('toggle');
	        },
	        error: function(xhr, status, error) {
	        	Swal.fire('Gagal !', 'Terjadi Kesalahan', 'error');
				console.log(xhr);
				console.log(status);
				console.log(error);
	        }
	    });
	});


	// Custom Function //

	// Format angka ke Rupiah
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