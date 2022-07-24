<!-- Begin Page Content -->
<div class="container-fluid">
	<div class="card mb-12" style="width: 800px; margin-left: 120px;">
		<div class="card-header">
			<h1 class="h3" align="center">Form Pengajuan Izin Belajar </h1>
		</div>
		<div class="card-body">
			<div class="row">
				<div class="col-lg-12" align="left">
					<form id="pengajuan_form" class="user" method="POST">
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
							<label>Nama Instansi Pendidikan: </label>
							<input type="text" class="form-control" id="nama_instansi_pendidikan" value="" name="nama_instansi_pendidikan" required>
						</div>
						<div class="form-group">
							<label>Jenjang Pendidikan : </label>
							<select class="form-control" id="jenjang_pendidikan" name="jenjang_pendidikan" required>
								<option value="">Pilih</option>
								<option>D3</option>
								<option>S1</option>
								<option>S2</option>
								<option>S3</option>
							</select>
						</div>
						<div class="form-row">
							<div class="form-group col-md-4">
								<label for="nama_pengajuan">Upload Ijazah Terakhir : </label>
								<div class="custom-file"><input type="file" name="dok_ijazah_terakhir" id="dok_ijazah_terakhir" required accept=".pdf,.doc,.docx"></div>
							</div>
							<div class="form-group col-md-4">
								<label for="nama_pengajuan">Upload Surat dari Dinas : </label>
								<div class="custom-file"><input type="file" name="dok_surat_dinas" id="dok_surat_dinas" required accept=".pdf,.doc,.docx"></div>
							</div>
							<div class="form-group col-md-4">
								<label for="nama_pengajuan">Upload Surat Hukuman Disipin : </label>
								<div class="custom-file"><input type="file" name="dok_surat_humdis" id="dok_surat_humdis" required accept=".pdf,.doc,.docx"></div>
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
				url: '<?php echo site_url(); ?>PegawaiController/submit_pengajuan_izin_belajar',
				type: "POST",
				data: new FormData(this),
				processData: false,
				contentType: false,
				// cache: false,
				// async: false,
				success: function(result) {
					if (result.indexOf('salah') > 0) {
						swal({
							title: result,
							text: 'PDF, DOC, DOCX',
							type: 'error'
						});
					} else {
						swal({
							title: 'Pengajuan Izin Belajar Berhasil Dikirim',
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
						title: 'Pengajuan Izin Belajar Gagal Dikirim',
						text: '',
						type: 'error'
					});
				}
			});
		});
	});
</script>