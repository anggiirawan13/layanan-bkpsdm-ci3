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
