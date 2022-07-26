<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-success sidebar sidebar-dark accordion" id="accordionSidebar">

	<!-- Sidebar - Brand -->
	<a class="sidebar-brand d-flex align-items-center justify-content-center" href="#">
		<!--href="<?= base_url('auth/index'); ?>-->
		<div class="sidebar-brand-icon">
			<!-- <img class="img-profile rounded-circle " src="<?= base_url('assets/img/profile/') . $user['image']; ?>"> -->
			<i class="fas fa-fw fa-code"></i>
		</div>
		<div class="sidebar-brand-text mx-3">Layanan BKPSDM</div>
	</a>
	<!-- Divider -->
	<hr class="sidebar-divider">
	<!-- Nav Item - Dashboard -->
	<div class="sidebar-heading">
		Manajer
	</div>
	<li class="nav-item">
		<a class="nav-link" href="<?= base_url('AtasanController/dashboard'); ?>">
			<i class="fas fa-fw fa-tachometer-alt"></i>
			<span>Dashboard</span></a>
	</li>
	<li class="nav-item">
		<a class="nav-link" href="<?= base_url('AtasanController/rekap_izin_belajar'); ?>">
			<i class="fas fa-fw fa-folder"></i><span>Rekap Izin Belajar</span>
		</a>
	</li>
	<li class="nav-item">
		<a class="nav-link" href="<?= base_url('AtasanController/rekap_pensiun'); ?>">
			<i class="fas fa-fw fa-folder"></i><span>Rekap Pensiun</span>
		</a>
	</li>
	<!-- Divider -->
	<hr class="sidebar-divider d-none d-md-block">

	<li class="nav-item">
		<span class="nav-link" name="change_password" id="" data-toggle="modal" data-target="#change_password_modal" style="cursor: pointer;">
			<i class="fas fa-fw fa-key"></i>
			Change Password</span>
	</li>
	<!-- Divider -->
	<hr class="sidebar-divider d-none d-md-block">


	<li class="nav-item">
	        <a class="nav-link" href="<?= base_url('MainController/logout'); ?>">
		<i class="fas fa-fw fa-sign-out-alt"></i>
	        <span>Log Out</span></a>
	</li>
	<!-- Divider -->
	<hr class="sidebar-divider">
	<!-- Sidebar Toggler (Sidebar) -->
	<div class="text-center d-none d-md-inline">
		<button class="rounded-circle border-0" id="sidebarToggle"></button>
	</div>
</ul>
<!-- End of Sidebar -->

<!-- Modal Change Password Form -->
<div class="modal fade bd-example-modal-xl" id="change_password_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-xl" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Change Password</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="col-md-12">
					<h3>Change Password</h3>
					<form id="change_password_form" class="user" method="POST">
						<div class="form-group">
							<label>Password Lama : </label>
							<input type="password" class="form-control" id="oldpass" value="" name="oldpass" required>
						</div>
						<div class="form-group">
							<label>Password Baru : </label>
							<input type="password" class="form-control" id="newpass" value="" name="newpass" required>
						</div>
						<div class="form-group">
							<label>Konfirmasi Password Baru</label>
							<input type="password" class="form-control" id="confnewpass" value="" name="confnewpass" required>
						</div>
						<button type="submit" class="btn btn-danger" name="btn_change_password" id="btn_change_password">Simpan</button>
					</form>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>

<script src="<?= base_url('assets/'); ?>vendor/jquery/jquery.js"></script>
<script src="<?= base_url('assets/'); ?>vendor/jquery/jquery.min.js"></script>
<script>
	$('#btn_change_password').click(function(e) {
			e.preventDefault();
			var update_data = $('#change_password_form').serialize();
			$.ajax({
				url: "<?php echo site_url('AtasanController/change_password'); ?>",
				type: "POST",
				data: update_data,
				success: function(ajaxData) {
					if (ajaxData.indexOf("password") >= 0 || ajaxData.indexOf("Password") >= 0) {
						swal({
							title: ajaxData,
							text: '',
							type: 'error'
						});
					} else {
						$('#change_password_modal').modal('hide');
						swal({
							title: 'Password Berhasil Diubah',
							text: '',
							type: 'success',
							confirmButtonClass: "btn-success",
							confirmButtonText: "OK",
							closeOnConfirm: false
						}, function(isConfirm) {
							if (isConfirm) {
								window.location.href = "<?= base_url('MainController/logout'); ?>";
							}
						});
					}
				},
				error: function(status) {
					swal({
						title: 'Password Gagal Diubah!',
						text: '',
						type: 'danger'
					});
				}
			});
		});
</script>