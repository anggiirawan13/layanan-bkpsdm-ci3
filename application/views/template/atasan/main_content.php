<!-- Begin Page Content -->
<div class="container-fluid">
	<!-- Page Heading  -->
	<h2 class="h3 mb-4 text-gray-800">Dashboard</h2>
	<div class="row">
		<div class="col-xl-4 col-md-6 mb-4">
			<div class="card bg-success text-white shadow h-100 py-2">
				<div class="card-body">
					<div class="row no-gutters align-items-center">
						<div class="col mr-2">
							<div class="h6 text-md font-weight-bold text-uppercase">
								<h4 class="text-white font-weight-bold font-italic">Rekap Izin Belajar</h4>
								<div>
									<i class=" fas fa-clipboard-list fa-6x text-gray-100 mt-3" style="opacity: .5;"></i>
								</div>
							</div>
						</div>
						<div class="col-auto mt-5">
							<i>
								<h1 style="font-size: 5em;"><?= $rekapBelajar[0]['rekap']; ?></h1>
							</i>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-xl-4 col-md-6 mb-4">
			<div class="card bg-warning text-white shadow h-100 py-2">
				<div class="card-body">
					<div class="row no-gutters align-items-center">
						<div class="col mr-2">
							<div class="h6 text-md font-weight-bold text-uppercase">
								<h4 class="text-white font-weight-bold font-italic">Rekap Pensiun</h4>
								<div>
									<i class=" fas fa-clipboard-list fa-6x text-gray-100 mt-3" style="opacity: .5;"></i>
								</div>
							</div>
						</div>
						<div class="col-auto mt-5">
							<i>
								<h1 style="font-size: 5em;"><?= $rekapPensiun[0]['rekap']; ?></h1>
							</i>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- /.container-fluid -->
</div>
<!-- End of Main Content -->
<script src="<?= base_url('assets/'); ?>vendor/jquery/jquery.js"></script>
<script src="<?= base_url('assets/'); ?>vendor/jquery/jquery.min.js"></script>