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
		Admin
	</div>
	<li class="nav-item">
		<a class="nav-link" href="<?= base_url('AdminController/dashboard'); ?>">
			<i class="fas fa-fw fa-tachometer-alt"></i>
			<span>Dashboard</span></a>
	</li>
	<li class="nav-item">
		<a class="nav-link" href="<?= base_url('AdminController/daftar_pengguna'); ?>">
			<i class="fas fa-fw fa-users"></i>
			<span>Data Pengguna</span></a>
	</li>
	<li class="nav-item">
		<a class="nav-link" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true"
			aria-controls="collapseTwo">
			<i class="fas fa-fw fa-check-square"></i>
			<span>Izin Belajar</span>
		</a>
		<div id="collapseTwo" class="collapse show" aria-labelledby="headingTwo" data-parent="#accordionSidebar" style="">
			<div class="bg-white py-2 collapse-inner rounded">
				<h6 class="collapse-header">Pengajuan Izin Belajar</h6>
				<a class="collapse-item" href="<?= base_url('AdminController/daftar_konfirmasi_izin_belajar'); ?>">Konfirmasi Izin Belajar</a>
				<a class="collapse-item" href="<?= base_url('AdminController/rekap_izin_belajar'); ?>">Rekap Laporan Izin Belajar</a>
			</div>
		</div>
	</li>
	<li class="nav-item">
		<a class="nav-link" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true"
			aria-controls="collapseTwo">
			<i class="fas fa-check-circle"></i>
			<span>Pensiun</span>
		</a>
		<div id="collapseTwo" class="collapse show" aria-labelledby="headingTwo" data-parent="#accordionSidebar" style="">
			<div class="bg-white py-2 collapse-inner rounded">
				<h6 class="collapse-header">Pengajuan Pensiun</h6>
				<a class="collapse-item" href="<?= base_url('AdminController/daftar_konfirmasi_pensiun'); ?>">Konfirmasi Pensiun</a>
				<a class="collapse-item" href="<?= base_url('AdminController/rekap_pensiun'); ?>">Rekap Laporan Pensiun</a>
			</div>
		</div>
	</li>
	
	<!-- <li class="nav-item">
		<a class="nav-link" href="<?= base_url('AdminController/grafik'); ?>">
			<i class="fas fa-fw fa-chart-line"></i>
			<span>Grafik</span></a>
	</li> -->
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
