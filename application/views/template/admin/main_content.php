<!-- Begin Page Content -->
<div class="container-fluid">
	<!-- Page Heading  -->
	<h2 class="h3 mb-4 text-gray-800">Dashboard</h2>

	<div class="row">
		<div class="col-xl-4 col-md-6 mb-4">
			<div class="card bg-warning text-white shadow h-100 py-2">
				<div class="card-body">
					<div class="row no-gutters align-items-center">
						<div class="col mr-2">
							<div class="h6 text-md font-weight-bold text-uppercase">
								<h4 class="text-white font-weight-bold font-italic">Rekap Pengguna</h4>
								<div>
									<i class=" fas fa-clipboard-list fa-6x text-gray-100 mt-5" style="opacity: .5;"></i>
								</div>
							</div>
						</div>
						<div class="col-auto mt-5">
							<i>
								<h1 style="font-size: 5em;"><?= $rekapUser[0]['rekap']; ?></h1>
							</i>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-xl-4 col-md-6 mb-4">
			<div class="card bg-info text-white shadow h-100 py-2">
				<div class="card-body">
					<div class="row no-gutters align-items-center">
						<div class="col mr-2">
							<div class="h6 text-md font-weight-bold text-uppercase">
								<h4 class="text-white font-weight-bold font-italic">Rekap Konfirmasi Izin Belajar</h4>
								<div>
									<i class=" fas fa-clipboard-list fa-6x text-gray-100 mt-3" style="opacity: .5;"></i>
								</div>
							</div>
						</div>
						<div class="col-auto mt-5">
							<i>
								<h1 style="font-size: 5em;"><?= $rekapKonfirmasiBelajar[0]->rekap; ?></h1>
							</i>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-xl-4 col-md-6 mb-4">
			<div class="card text-white shadow h-100 py-2" style="background-color: #e43f60;">
				<div class="card-body">
					<div class="row no-gutters align-items-center">
						<div class="col mr-2">
							<div class="h6 text-md font-weight-bold text-uppercase">
								<h4 class="text-white font-weight-bold font-italic">Rekap Konfirmasi Pensiun</h4>
								<div>
									<i class=" fas fa-clipboard-list fa-6x text-gray-100 mt-3" style="opacity: .5;"></i>
								</div>
							</div>
						</div>
						<div class="col-auto mt-5">
							<i>
								<h1 style="font-size: 5em;"><?= $rekapKonfirmasiPensiun[0]->rekap; ?></h1>
							</i>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-lg-7 mb-4">
			<div class="card shadow mb-4">
				<div class="card-header py-3">
					<h6 class="m-0 font-weight-bold text-success" align="center">Grafik Pengajuan Izin Belajar Pertahun</h6>
				</div>
				<div class="card-body">
					<div class="chart-pie">
						<canvas id="statistikChart"></canvas>
					</div>
				</div>
			</div>
		</div>
		<div class="col-lg-5 mb-4">
			<div class="card shadow mb-4">
				<div class="card-header py-3">
					<h6 class="m-0 font-weight-bold text-success" align="center">Grafik Status Izin Belajar</h6>
				</div>
				<div class="card-body">

					<div class="chart-pie">
						<canvas id="statistikChart1" height="210"></canvas>
					</div>
				</div>
			</div>
		</div>

	</div>

	<div class="row">
		<div class="col-lg-7 mb-4">
			<div class="card shadow mb-4">
				<div class="card-header py-3">
					<h6 class="m-0 font-weight-bold text-success" align="center">Grafik Pengajuan Pensiun Pertahun</h6>
				</div>
				<div class="card-body">
					<div class="chart-pie">
						<canvas id="statistikChart2"></canvas>
					</div>
				</div>
			</div>
		</div>
		<div class="col-lg-5 mb-4">
			<div class="card shadow mb-4">
				<div class="card-header py-3">
					<h6 class="m-0 font-weight-bold text-success" align="center">Grafik Pengajuan Pensiun</h6>
				</div>
				<div class="card-body">

					<div class="chart-pie">
						<canvas id="statistikChart3" height="210"></canvas>
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
<script>
	$('#statistikChart').ready(function() {
		tampilkan();

		function tampilkan() {
			var chartBulan = $('#statistikChart');
			$.ajax({
				url: '<?php echo site_url("AdminController/get_tahun_izin_belajar") ?>',
				type: "POST",
				//data: postData,

				success: function(ajaxData) {
					//load-pns
					var result = JSON.parse(ajaxData);

					var tahun = [];
					var jumlah = [];

					for (var i in result) {
						tahun.push(result[i].jumlahtahun);
						jumlah.push(result[i].jumlahdata);
					}

					var ctx = document.getElementById('statistikChart').getContext('2d');

					var stat_bulanan = new Chart(ctx, {
						type: 'line',
						data: {
							labels: tahun,
							datasets: [{
								data: jumlah,
								backgroundColor: 'rgb(252, 116, 101)',
								hoverBackgroundColor: 'rgb(255, 255, 255)',
								hoverBorderColor: "rgba(234, 236, 244, 1)",
								label: 'Jumlah Pengajuan',
							}]
						},
						options: {
							responsive: true,
							title: {
								display: true,
								text: 'Statistik Status Pengajuan Pensiun'
							},
							scales: {
								yAxes: [{
									ticks: {
										beginAtZero: true
									}
								}]
							}
						}
					});
					// chart_tahunan();
				}
			})
		};
	});

	$('#statistikChart1').ready(function() {
		tampilkan();

		function tampilkan() {
			var chartBulan = $('#statistikChart1');
			$.ajax({
				url: '<?php echo site_url("AdminController/get_grafik_aju_izin_belajar") ?>',
				type: "POST",
				//data: postData,

				success: function(ajaxData) {
					//load-pns
					var result = JSON.parse(ajaxData);

					var jumlah = [];

					jumlah.push(result['DITERIMA'], result['DITOLAK']);

					var ctx = document.getElementById('statistikChart1').getContext('2d');

					var stat_bulanan = new Chart(ctx, {
						type: 'doughnut',
						data: {
							labels: ['DITERIMA', 'DITOLAK'],
							datasets: [{
								data: [jumlah[0], jumlah[1]],
								backgroundColor: ['#4e73df', '#1cc88a', '#36b9cc', 'rgba(254, 241, 96, 1)'],
								hoverBackgroundColor: ['#2e59d9', '#17a673', '#2c9faf', 'rgba(255, 236, 139, 1)'],
								hoverBorderColor: "rgba(234, 236, 244, 1)",
							}]
						},
						options: {
							responsive: true,
							title: {
								display: true,
								text: 'Statistik Status Pengajuan Izin Belajar'
							},
							scales: {
								yAxes: [{
									ticks: {
										beginAtZero: true
									}
								}]
							}
						}
					});
					// chart_tahunan();
				}

			})
		};
	});

	$('#statistikChart2').ready(function() {
		tampilkan();

		function tampilkan() {
			var chartBulan = $('#statistikChart2');
			$.ajax({
				url: '<?php echo site_url("AdminController/get_tahun_pensiun") ?>',
				type: "POST",
				//data: postData,

				success: function(ajaxData) {
					//load-pns
					var result = JSON.parse(ajaxData);

					var tahun = [];
					var jumlah = [];

					for (var i in result) {
						tahun.push(result[i].jumlahtahun);
						jumlah.push(result[i].jumlahdata);
					}

					var ctx = document.getElementById('statistikChart2').getContext('2d');

					var stat_bulanan = new Chart(ctx, {
						type: 'line',
						data: {
							labels: tahun,
							datasets: [{
								data: jumlah,
								backgroundColor: 'rgb(252, 116, 101)',
								hoverBackgroundColor: 'rgb(255, 255, 255)',
								hoverBorderColor: "rgba(234, 236, 244, 1)",
								label: 'Jumlah Pengajuan',
							}]
						},
						options: {
							responsive: true,
							title: {
								display: true,
								text: 'Statistik Status Pengajuan Pensiun'
							},
							scales: {
								yAxes: [{
									ticks: {
										beginAtZero: true
									}
								}]
							}
						}
					});
					// chart_tahunan();
				}
			})
		};
	});

	$('#statistikChart3').ready(function() {
		tampilkan();

		function tampilkan() {
			var chartBulan = $('#statistikChart3');
			$.ajax({
				url: '<?php echo site_url("AdminController/get_grafik_aju_pensiun") ?>',
				type: "POST",
				//data: postData,

				success: function(ajaxData) {
					//load-pns
					var result = JSON.parse(ajaxData);

					var jumlah = [];

					jumlah.push(result['DITERIMA'], result['DITOLAK']);

					var ctx = document.getElementById('statistikChart3').getContext('2d');

					var stat_bulanan = new Chart(ctx, {
						type: 'doughnut',
						data: {
							labels: ['DITERIMA', 'DITOLAK'],
							datasets: [{
								data: [jumlah[0], jumlah[1]],
								backgroundColor: ['#4e73df', '#1cc88a', '#36b9cc', 'rgba(254, 241, 96, 1)'],
								hoverBackgroundColor: ['#2e59d9', '#17a673', '#2c9faf', 'rgba(255, 236, 139, 1)'],
								hoverBorderColor: "rgba(234, 236, 244, 1)",
							}]
						},
						options: {
							responsive: true,
							title: {
								display: true,
								text: 'Statistik Status Pengajuan Pensiun'
							},
							scales: {
								yAxes: [{
									ticks: {
										beginAtZero: true
									}
								}]
							}
						}
					});
					// chart_tahunan();
				}

			})
		};
	});
</script>