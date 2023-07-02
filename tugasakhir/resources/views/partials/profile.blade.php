<!-- Modal Profile User  -->
<div id="modal-profile-user" class="modal fade" role="dialog" tabindex="-1">
  	<div class="modal-dialog modal-dialog-centered modal-md">
	    <div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Profile User</h4>
			</div>
	      	<div class="modal-body">
			    <div class="container">
					<!-- <div class="row">
			            <div class="col-md-7">
			                <div class="card mb-4 mb-xl-0" style="padding: 3%;margin: 3%;">
			                    <div class="card-header">Profile Picture</div>
			                    <div class="card-body text-center" style="padding: 3%;">
			                        <img class="img-account-profile rounded-circle mb-2" src="http://bootdey.com/img/Content/avatar/avatar1.png" alt="">
			                        <div class="small font-italic text-muted mb-4">JPG or PNG no larger than 2 MB</div>
			                        <label class="btn btn-primary" type="button" for="user_profile"><i class="fa fa-image"></i> Upload new image</label>
			                        <input type="file" id="user_profile" class="form-control" name="user_profile" style="display: none;" />
			                    </div>
			                </div>
			            </div>
			        </div> -->
			        <div class="row">
			            <div class="col-md-7">
			                <div class="card mb-4" style="margin: 3%;">
			                    <div class="card-header" style="padding: 3%;">Account Details</div>
			                    <div class="card-body" style="padding: 3%;">
			                        <form id="form-profile-user" class="form" method="POST">
			                        	@csrf
			                        	<input type="text" id="id_user" name="id_user" style="display: none;">
			                            <div class="mb-3">
			                                <label class="small mb-1" for="username">Username</label>
			                                <input class="form-control" name="username" id="username" type="text" placeholder="Username">
			                            </div>

			                            <div class="mb-3">
			                                <label class="small mb-1" for="nama_lengkap">Nama Lengkap</label>
			                                <input class="form-control" name="nama_lengkap" id="nama_lengkap" type="text" placeholder="Alamat Email">
			                            </div>

			                            <div class="mb-3">
			                                <label class="small mb-1" for="email">Email</label>
			                                <input class="form-control" name="email" id="email" type="email" placeholder="Alamat Email">
			                            </div>

			                            <div class="mb-3">
			                                <label class="small mb-1" for="password">Password</label>
			                                <input class="form-control" name="password" id="password" type="password" placeholder="Password">
			                            </div>

			                            <div class="rowmb-3">
			                                <label class="small mb-1" for="no_telepon">No Telepon</label>
		                                    <input class="form-control" name="no_telepon" id="no_telepon" type="text" placeholder="+62">
			                            </div>

			                            <div class="rowmb-3">
			                                <label class="small mb-1" for="alamat">Alamat</label>
		                                    <input class="form-control" name="alamat" id="alamat" type="text" placeholder="Alamat">
			                            </div><br>

			                            <div class="row">
			                            	<div class="col-md-12 text-center">
			                            		<button class="btn btn-primary btn-update-user" type="button"><i class="fa fa-save"></i> Simpan</button>
			                            	</div>
			                            </div>
			                        </form>
			                    </div>
			                </div>
			            </div>
			        </div>
			    </div>
	      	</div>
	      	<div class="modal-footer">
		        <button type="button" class="btn btn-primary" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
		    </div>
	    </div>
  	</div>
</div>

<!-- <style type="text/css">
    .img-account-profile {
        height: 10rem;
    }
    .rounded-circle {
        border-radius: 50% !important;
    }
</style> -->