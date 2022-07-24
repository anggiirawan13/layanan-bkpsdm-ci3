<div class="container">
	<!-- Page Heading 
	<h1 class="h3 mb-2 text-gray-800">Konfirmasi Konsultasi</h1>
	-->
	<!-- DataTales Example -->
	<div class="card shadow mb-4">
		<div class="card-header py-3">
			<h4 class="m-0 font-weight-bold text-primary">Update Disposisi Pengajuan Pensiun</h4>
		</div>
		<div class="card-body">
			<div class="table-responsive">
				<table class="table table-bordered" id="konfirmasi_pensiun" width="100%">
					<thead>
						<tr>
							<th width="1%"><center>No</center></th>
							<th width="10%"><center>NIP</center></th>
							<th width="12%"><center>Nama Pengajuan</center></th>
							<th width="10%"><center>Jabatan</center></th>
							<th width="8%"><center>Golongan</center></th>
							<th width="10%"><center>Unit Kerja</center></th>
							<th width="10%"><center>TMT Pensiun</center></th>
							<th width="6%"><center>Tanggal Pengajuan</center></th>
							<th width="15%"><center>Dokumen</center></th>
							<th width="15%"><center>Aksi</center></th>
						</tr>
					</thead>
					<tbody>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
<!-- Modal Terima -->
<div class="modal fade bd-example-modal-lg" id="TerimaModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Isi Disposisi</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="col-md-12">
					<form id="disposisi_form" class="user" method="POST">
						<input type="hidden" id="id_pensiun" name="id_pensiun">
						<div class="form-row">
							<div class="form-group col-md-4">
								<label>Tanggal Disposisi Asisten 3 : </label>
								<input type="date" class="form-control" id="tgl_asistentiga" name="tgl_asistentiga">
							</div>
							<div class="form-group col-md-4">
								<label>Tanggal Disposisi Sekretaris Daerah : </label>
								<input type="date" class="form-control" id="tgl_disposisi_sekda" name="tgl_disposisi_sekda">
							</div>
							<div class="form-group col-md-4">
								<label>Tanggal Disposisi BKN Pusat : </label>
								<input type="date" class="form-control" id="tgl_disposisi_bkn_pusat" name="tgl_disposisi_bkn_pusat">
							</div>
						</div>	
						<button type="button" class="btn btn-primary" name="btn_terima" id="btn_terima">Terima</button>
					</form>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>

<script src="<?= base_url('assets/'); ?>vendor/jquery/jquery.min.js"></script>

<script type="text/javascript" language="javascript">
	$('#konfirmasi_pensiun').ready(function() {
		var c = $('#konfirmasi_pensiun').DataTable();
		load_data();

		function load_data() {
			$.ajax({
				url: '<?php echo site_url('AdminController/get_konfirmasi_pengajuan_pensiun') ?>',
				dataType: "JSON",
				success: function(data) {
					c.clear().draw();
					var HTMLbuilder = "";
					var base_url = "<?php echo base_url(); ?>";
					for (var i = 0; i < data.length; i++) {
						var berkas = base_url+"assets/img/"+data[i]['dok_kk'];
						var berkas1 = base_url+"assets/img/"+data[i]['dok_akte_anak'];
						var berkas2 = base_url+"assets/img/"+data[i]['dok_buku_nikah'];
						var kk ="<a href='"+berkas+"' target='_blank'>Kartu Keluarga</a>";
						var akte_anak ="<a href='"+berkas1+"' target='_blank'>Akte Anak</a>";
						var buku_nikah ="<a href='"+berkas2+"' target='_blank'>Buku Nikah</a>";

						var btn1 = '<button type="button" name="btn_isi_disposisi" id="' + data[i]['id_pensiun'] + '" class="btn btn-xs btn-primary btn-circle btn_isi_disposisi" data-toggle="modal" data-target="#TerimaModal"><i class="fas fa-check"></i></button>';
						var btn2 = '<button type="button" name="btn_ditolak" id="' + data[i]['id_pensiun'] + '" class="btn btn-xs btn-danger btn-circle btn_tolak"><i class="fas fa-times"></i></button>';
						
						c.row.add([
							"<center>" + [i + 1] + "</center>",
							"<center>" + data[i]['nip'] + "</center>",
							"<center>" + data[i]['nama_pegawai'] + "</center>",
							"<center>" + data[i]['jabatan'] + "</center>",
							"<center>" + data[i]['nama_golongan'] + "</center>",
							"<center>" + data[i]['unit_kerja'] + "</center>",
							"<center>" + data[i]['tmt_pensiun'] + "</center>",
							"<center>" + data[i]['tgl_pengajuan'] + "</center>",
							"<center>" + kk + "<br/>"  + akte_anak + "<br/>" + buku_nikah +"</center>",
							"<center>" + btn1 + " " + btn2 + "</center>",
						]).draw();
					}
				}
			});
		}

		$(document).on("click", ".btn_isi_disposisi", function() {
			var id_pensiun = $(this).attr('id');
			console.log(id_pensiun);
			$.ajax({
				url: "<?php echo site_url('AdminController/get_nama_aju_pensiun'); ?>",
				method: "GET",
				data: {
					id_pensiun : id_pensiun
				},
				success: function(ajaxData) {
					console.log(ajaxData);
					var result = JSON.parse(ajaxData);
					$('#id_pensiun').val(result[0]['id_pensiun']);
					$('#tgl_asistentiga').val(result[0]['tgl_asistentiga']);
					$('#tgl_disposisi_sekda').val(result[0]['tgl_disposisi_sekda']);
					$('#tgl_disposisi_bkn_pusat').val(result[0]['tgl_disposisi_bkn_pusat']);
				}
			});
		});

		$('#btn_terima').click(function () {
			var update_data = $('#disposisi_form').serialize();
			$.ajax({
			url: "<?php echo site_url('AdminController/terima_aju_pensiun'); ?>",
			type: "POST",
			data: update_data,
			success: function (ajaxData) {
				$('#TerimaModal').modal('hide');
				swal({
				  title: 'Pengajuan Berhasil Diterima',
				  text: '',
				  type: 'success'
				});
				location.reload()
			},
			error: function (status) {
				swal({
				title: 'Edit Data Gagal',
				text: '',
				type: 'danger'
				});
			}
			});
		});

		$(document).on("click", ".btn_tolak", function() {
			var id_pensiun = $(this).attr('id');
			var status_pengajuan = 'DITOLAK';

			swal({
					title: "Tolak Pengajuan Pensiun",
					text: "Apakah anda yakin akan Menolak Pengajuan ini?",
					type: "warning",
					showCancelButton: true,
					confirmButtonText: "Tolak",
					closeOnConfirm: true,
				},
				function() {
					$.ajax({
						url: "<?php echo site_url('AdminController/tolak_pengajuan_pensiun'); ?>",
						method: "POST",
						data: {
							id_pensiun: id_pensiun,
							status_pengajuan: status_pengajuan
						},
						success: function(data) {
							load_data();
							swal({
								title:'Pengajuan Berhasil Ditolak',
								text: '',
								type: 'success'
							});
						}
					});
				});
		});
	});
</script>