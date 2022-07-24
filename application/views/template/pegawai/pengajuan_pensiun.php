<!-- Begin Page Content -->
<div class="container-fluid">
	<div class="card mb-12" style="width: 800px; margin-left: 120px;">
		<div class="card-header">
			<h1 class="h3" align="center">Form Pengajuan Pensiun</h1>
		</div>
		<div class="card-body">
			<div class="row">
				<div class="col-lg-12" align="left">
					<form id="pengajuan_form" class="user" method="POST" enctype="multipart/form-data">
						<input type="hidden" id="id_user" value="<?= $session['id_user'] ?>" name="id_user">
						<div class="form-row">
							<div class="form-group col-md-6">
								<label>Nama Pegawai : </label>
								<input type="text" class="form-control" id="nama_pegawai" value="<?= $session['nama_pegawai'] ?>" name="nama_pegawai" readonly>
							</div>
							<div class="form-group col-md-6">
								<label>NIP : </label>
								<input type="text" class="form-control" id="nip" value="<?= $session['nip'] ?>" name="nip" readonly>
							</div>
						</div>
						<div class="form-group">
							<label>TMT Pensiun: </label>
							<input type="date" class="form-control" id="tmt_pensiun" value="" name="tmt_pensiun" required>
						</div>
						<div class="form-row">
							<div class="form-group col-md-4">
								<label for="nama_pengajuan">Upload Kartu Keluarga : </label>
								<div class="custom-file"><input type="file" name="dok_kk" id="dok_kk" required accept=".pdf,.doc,.docx"></div>
							</div>
							<div class="form-group col-md-4">
								<label for="nama_pengajuan">Upload Akte Anak : </label>
								<div class="custom-file"><input type="file" name="dok_akte_anak" id="dok_akte_anak" required accept=".pdf,.doc,.docx"></div>
							</div>
							<div class="form-group col-md-4">
								<label for="nama_pengajuan">Upload Buku Nikah : </label>
								<div class="custom-file"><input type="file" name="dok_buku_nikah" id="dok_buku_nikah" required accept=".pdf,.doc,.docx"></div>
							</div>
						</div>
						<button type="submit" class="btn btn-info">Submit</button>
					</form>
				</div>
			</div>
		</div>
	</div>
	<!-- Page Heading -->
</div>
</div>
<script type="text/javascript" src="<?php echo base_url() . 'assets/js/jquery-3.2.1.js' ?>"></script>

<script type="text/javascript">
	$(document).ready(function() {
		$('#pengajuan_form').submit(function(e) {
			e.preventDefault();
			$.ajax({
				url: '<?php echo site_url(); ?>PegawaiController/submit_pengajuan_pensiun',
				type: "POST",
				data: new FormData(this),
				processData: false,
				contentType: false,
				// cache: false,
				// async: false,
				success: function(data) {
					if (data.indexOf('salah') > 0) {
						swal({
							title: data,
							text: 'PDF, DOC, DOCX',
							type: 'error',
							confirmButtonClass: "btn-danger",
							confirmButtonText: "OK",
							closeOnConfirm: false
						});
					} else if (data.indexOf('bisa') > 0) {
						swal({
							title: 'Pengajuan Pensiun Gagal Dikirim',
							text: data,
							type: 'error',
							confirmButtonClass: "btn-danger",
							confirmButtonText: "OK",
							closeOnConfirm: false
						}, function(isConfirm) {
							if (isConfirm) {
								window.location.reload();
							}
						});
					} else {
						swal({
							title: 'Pengajuan Pensiun Berhasil Dikirim',
							text: '',
							type: 'success',
							confirmButtonClass: "btn-success",
							confirmButtonText: "OK",
							closeOnConfirm: false
						}, function(isConfirm) {
							if (isConfirm) {
								window.location.reload();
							}
						});
					}
				},
				error: function(status) {
					swal({
						title: 'Pengajuan Pensiun Gagal Dikirim',
						text: '',
						type: 'error',
						confirmButtonClass: "btn-danger",
						confirmButtonText: "OK",
						closeOnConfirm: false
					}, function(isConfirm) {
						if (isConfirm) {
							window.location.reload();
						}
					});
				}
			});
		});
	});
</script>