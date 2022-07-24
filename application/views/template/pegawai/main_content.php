<!-- Begin Page Content -->
<div class="container-fluid">
	<!-- Page Heading  -->
	<h2 class="h3 mb-4 text-gray-800">Dashboard</h2>

	<div class="row">
		<div class="col-xl-3 col-md-6 mb-4">
			<div class="card bg-info text-white shadow h-100 py-2">
				<div class="card-body">
					<div class="row no-gutters align-items-center">
						<div class="col mr-2">
							<div class="h6 text-md font-weight-bold text-uppercase">
								<a href="<?= base_url(); ?>assets/img/syarat_pensiun.pdf" class="text-white" download="syarat pensiun.pdf">Download Persyratan Pensiun</a>
							</div>
						</div>
						<div class="col-auto">
							<i class="fas fa-folder fa-6x text-gray-100"></i>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="row" style="font-size: 1rem;">
		<div class="col-sm-10">
			<div class="box box-default">
				<div class="box-header with-border">
					<h3 class="box-title">Informasi Akun</h3>
				</div>
				<table class="table table-hover">
					<tr>
						<th>Username</th>
						<td><?= $informasiAkun[0]['username']; ?></td>
					</tr>
					<tr>
						<th>Nama Pegawai</th>
						<td><?= $informasiAkun[0]['nama_pegawai']; ?></td>
					</tr>
					<tr>
						<th>NIP</th>
						<td><?= $informasiAkun[0]['nip']; ?></td>
					</tr>
					<tr>
						<th>Jabatan</th>
						<td><?= $informasiAkun[0]['jabatan']; ?></td>
					</tr>
					<tr>
						<th>Unit Kerja</th>
						<td><?= $informasiAkun[0]['unit_kerja']; ?></td>
					</tr>
					<tr>
						<th>Golongan</th>
						<td><?= $informasiAkun[0]['nama_golongan']; ?></td>
					</tr>
				</table>
			</div>
		</div>
	</div>

	<!-- <div class="row">
		<div class="col-lg-7 mb-4">
			<div class="card shadow mb-4">
				<div class="card-header py-3">
						<h6 class="m-0 font-weight-bold text-success" align="center">Grafik Daftar Kontrak Kerja PerTahun</h6>
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
					<h6 class="m-0 font-weight-bold text-success" align="center">Grafik Status Kontrak Kerja</h6>
				</div>
				<div class="card-body">
				
					<div class="chart-pie">
						<canvas id="statistikChart1" height="210"></canvas>
					</div>
				</div>
			</div>
		</div>
	</div> -->
</div>
<!-- /.container-fluid -->
</div>
<!-- End of Main Content -->
<script src="<?= base_url('assets/'); ?>vendor/jquery/jquery.js"></script>
<script src="<?= base_url('assets/'); ?>vendor/jquery/jquery.min.js"></script>