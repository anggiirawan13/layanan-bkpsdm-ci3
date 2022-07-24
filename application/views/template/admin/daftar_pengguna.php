<div class="container-fluid">
	<!-- Page Heading -->

	<div class="row">
		<div class="col-xl-12">
			<!-- DataTales Example -->
			<div class="card shadow mb-4">
				<div class="card-header py-3">
					<h4 class="m-0 font-weight-bold text-default">Daftar Pengguna</h4>
				</div>
				<div class="card-body">
					<div class="form-group">
						<button type="button" name="tambah_pengguna" id="" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#InputPengguna_Modal"><i class="fas fa-database fa-sm text-white-100"></i> Tambah Pengguna</button>
					</div>
					<hr>
					<div class="table-responsive">
						<table class="table table-bordered table-responsive" id="daftar_pengguna" width="100%">
							<thead>
								<tr>
									<th width="1%">
										<center>No</center>
									</th>
									<th width="15%">
										<center>username</center>
									</th>
									<th width="15%">
										<center>NIP</center>
									</th>
									<th width="15%">
										<center>Nama Pegawai</center>
									</th>
									<th width="20%">
										<center>Jabatan</center>
									</th>
									<th width="4%">
										<center>Golongan</center>
									</th>
									<th width="25%">
										<center>Unit Kerja</center>
									</th>
									<th width="30%">
										<center>Action</center>
									</th>
								</tr>
							</thead>
							<tbody>

							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- /.container-fluid -->

<!-- Modal Tambah Data Proyek Form -->
<div class="modal fade bd-example-modal-xl" id="InputPengguna_Modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-xl" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Tambah Pengguna</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="col-md-12">
					<h3>Form Tambah Pengguna</h3>
					<form id="input_pengguna_form" class="user" method="POST">
						<div class="form-group">
							<label>Username : </label>
							<input type="text" class="form-control" id="username" value="" name="username" required>
						</div>
						<div class="form-group">
							<label>Password : </label>
							<input type="password" class="form-control" id="password" value="" name="password" required>
						</div>
						<div class="form-group">
							<label>NIP : </label>
							<input type="text" class="form-control" id="nip" value="" name="nip" required>
						</div>
						<div class="form-group">
							<label>Nama Pegawai: </label>
							<input type="text" class="form-control" id="nama_pegawai" value="" name="nama_pegawai" required>
						</div>
						<div class="form-group">
							<label>Jabatan : </label>
							<input type="text" class="form-control" id="jabatan" value="" name="jabatan" required>
						</div>
						<div class="form-group">
							<label>Golongan : </label>
							<select class="form-control" id="nama_golongan" name="nama_golongan" required>
								<option value="">Pilih Golongan</option>
								<?php
								foreach ($golongan as $row) {
									echo "<option value='" . $row['id_golongan'] . "'>" . $row['nama_golongan'] . "</option>";
								}
								?>
							</select>
						</div>
						<div class="form-group">
							<label>Unit Kerja : </label>
							<input type="text" class="form-control" id="unit_kerja" value="" name="unit_kerja" required>
						</div>
						<button type="submit" class="btn btn-danger" name="btn_simpan" id="btn_simpan">Simpan</button>
					</form>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>

<!-- Modal Edit -->
<div class="modal fade bd-example-modal-xl" id="EditModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-xl" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Edit Pengguna</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="col-md-12">
					<h3>Edit Data Pengguna</h3>
					<form id="edit_form" class="user" method="POST">
						<input type="hidden" id="id_user" name="id_user" required>
						<div class="form-group">
							<label>Username : </label>
							<input type="text" class="form-control" id="edit_username" value="" name="username" required>
						</div>
						<div class="form-group">
							<label>Password : </label>
							<input type="password" class="form-control" id="edit_password" value="" name="password" required>
						</div>
						<div class="form-group">
							<label>NIP : </label>
							<input type="text" class="form-control" id="edit_nip" value="" name="nip" required>
						</div>
						<div class="form-group">
							<label>Nama Pegawai : </label>
							<input type="text" class="form-control" id="edit_nama_pegawai" value="" name="nama_pegawai" required>
						</div>
						<div class="form-group">
							<label>Jabatan : </label>
							<input type="text" class="form-control" id="edit_jabatan" value="" name="jabatan" required>
						</div>
						<div class="form-group">
							<label>Golongan : </label>
							<select class="form-control" id="edit_nama_golongan" name="nama_golongan" required>
								<!-- <option value="">Pilih Golongan</option> -->
								<?php
								foreach ($golongan as $row) :
								?>
									<option value="<?= $row['id_golongan']; ?>"><?= $row['nama_golongan']; ?></option>
								<?php
								endforeach;
								?>
							</select>
						</div>
						<div class="form-group">
							<label>Unit Kerja : </label>
							<input type="text" class="form-control" id="edit_unit_kerja" value="" name="unit_kerja" required>
						</div>
						<button type="submit" class="btn btn-primary" name="btn_ubah" id="btn_ubah">Change</button>
					</form>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>

<!-- Bootstrap core JavaScript-->
<script src="<?= base_url('assets/'); ?>vendor/jquery/jquery.js"></script>
<script src="<?= base_url('assets/'); ?>vendor/jquery/jquery.min.js"></script>
<script>
	$(document).ready(function() {
		$('#daftar_pengguna').DataTable({});
	});

	$('#daftar_pengguna').ready(function() {
		var c = $('#daftar_pengguna').DataTable();
		load_data();

		function load_data() {
			$.ajax({
				url: '<?php echo site_url("AdminController/get_all_pengguna") ?>',
				dataType: "JSON",
				success: function(data) {
					c.clear().draw();
					var HTMLbuilder = "";
					for (var i = 0; i < data.length; i++) {
						var btn1 = '<button type="button" name="btn_edit" id="' + data[i]['id_user'] + '" class="btn btn-xs btn-primary btn_edit" data-toggle="modal" data-target="#EditModal">Edit</button>';
						var btn2 = '<button type="button" name="btn_delete" id="' + data[i]['id_user'] + '" class="btn btn-xs btn-danger btn_delete">Hapus</button>';

						c.row.add([
							"<center>" + [i + 1] + "</center>",
							"<center>" + data[i]['username'] + "</center>",
							"<center>" + data[i]['nip'] + "</center>",
							"<center>" + data[i]['nama_pegawai'] + "</center>",
							"<center>" + data[i]['jabatan'] + "</center>",
							"<center>" + data[i]['nama_golongan'] + "</center>",
							"<center>" + data[i]['unit_kerja'] + "</center>",
							"<center>" + btn1 + ' ' + btn2 + "</center>",
						]).draw();
					}
				}
			});
		}

		$('#btn_simpan').click(function(e) {
			e.preventDefault();
			var update_data = $('#input_pengguna_form').serialize();
			$.ajax({
				url: "<?php echo site_url('AdminController/tambah_pengguna'); ?>",
				type: "POST",
				data: update_data,
				success: function(ajaxData) {
					if (ajaxData === "Username sudah ada!") {
						swal({
							title: ajaxData,
							text: '',
							type: 'error'
						});
					} else if (ajaxData === "NIP sudah ada!") {
						swal({
							title: ajaxData,
							text: '',
							type: 'error'
						});
					} else if (ajaxData.indexOf("8") > 0) {
						swal({
							title: ajaxData,
							text: '',
							type: 'error'
						});
					} else {
						load_data();
						$('#InputPengguna_Modal').modal('hide');
						swal({
							title: 'Berhasil Disimpan!',
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
						title: 'Gagal Disimpan!',
						text: '',
						type: 'danger'
					});
				}
			});
		});

		$('#btn_ubah').click(function(e) {
			e.preventDefault();
			var update_data = $('#edit_form').serialize();
			$.ajax({
				url: "<?php echo site_url('AdminController/update_pengguna'); ?>",
				type: "POST",
				data: update_data,
				success: function(ajaxData) {
					if (ajaxData === "Username sudah ada!") {
						swal({
							title: ajaxData,
							text: '',
							type: 'error'
						});
					} else if (ajaxData === "NIP sudah ada!") {
						swal({
							title: ajaxData,
							text: '',
							type: 'error'
						});
					} else if (ajaxData.indexOf("8") > 0) {
						swal({
							title: ajaxData,
							text: '',
							type: 'error'
						});
					} else {
						load_data();
						$('#EditModal').modal('hide');
						swal({
							title: 'Edit Data Pengguna Berhasil!',
							text: '',
							type: 'success',
							confirmButtonClass: "btn-success",
							confirmButtonText: "OK",
							closeOnConfirm: false
						}, function(isConfirm) {
							if (isConfirm) {
								load_data();
								window.location.reload();
							}
						});
					}
				},
				error: function(status) {
					swal({
						title: 'Edit Data Pengguna Gagal!',
						text: '',
						type: 'error'
					});
				}
			});
		});

		$(document).on("click", ".btn_edit", function() {
			var id_user = $(this).attr('id');
			$.ajax({
				url: "<?php echo site_url('AdminController/get_nama_pengguna'); ?>",
				method: "GET",
				data: {
					id_user: id_user
				},
				success: function(ajaxData) {
					var result = JSON.parse(ajaxData);
					$('#id_user').val(result[0]['id_user']);
					$('#edit_username').val(result[0]['username']);
					$('#edit_password').val(result[0]['password']);
					$('#edit_nip').val(result[0]['nip']);
					$('#edit_nama_pegawai').val(result[0]['nama_pegawai']);
					$('#edit_jabatan').val(result[0]['jabatan']);
					$('#edit_nama_golongan').val(result[0]['id_golongan']);
					$('#edit_unit_kerja').val(result[0]['unit_kerja']);
					$('#edit_nama_golongan').val(result[0]['id_golongan']);
				}
			});
		});

		$(document).on("click", ".btn_delete", function() {
			var id_user = $(this).attr('id');
			swal({
					title: "Hapus Pengguna",
					text: "Apakah anda yakin akan menghapus Pengguna ini?",
					type: "warning",
					showCancelButton: true,
					confirmButtonText: "Hapus",
					closeOnConfirm: true,
				},
				function() {
					$.ajax({
						url: "<?php echo site_url('AdminController/hapus_pengguna'); ?>",
						method: "POST",
						data: {
							id_user: id_user
						},
						success: function(data) {
							load_data();
							swal({
								title: 'Hapus Pengguna Berhasil',
								text: '',
								type: 'success'
							});
						}
					});
				});
		});
	});
</script>