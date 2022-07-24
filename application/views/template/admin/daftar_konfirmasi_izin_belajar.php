<div class="container">
	<!-- Page Heading 
	<h1 class="h3 mb-2 text-gray-800">Konfirmasi Konsultasi</h1>
	-->
	<!-- DataTales Example -->
	<div class="card shadow mb-4">
		<div class="card-header py-3">
			<h4 class="m-0 font-weight-bold text-primary">Konfirmasi Pengajuan Izin Belajar</h4>
		</div>
		<div class="card-body">
			<div class="table-responsive">
				<table class="table table-bordered" id="konfirmasi_izin_belajar" width="100%">
					<thead>
						<tr>
							<th width="1%"><center>No</center></th>
							<th width="10%"><center>NIP</center></th>
							<th width="12%"><center>Nama Pengajuan</center></th>
							<th width="10%"><center>Unit Kerja</center></th>
							<th width="10%"><center>Instansi Pendidikan</center></th>
							<th width="10%"><center>Jenjang <br/>Pendidikan</center></th>
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
						<input type="hidden" id="id_izin_belajar" name="id_izin_belajar">
						<div class="form-row">
							<div class="form-group col-md-6">
								<label>Tanggal Disposisi BKPSDM : </label>
								<input type="date" class="form-control" id="tgl_disposisi_bkpsdm" name="tgl_disposisi_bkpsdm">
							</div>
							<div class="form-group col-md-6">
								<label>Tanggal Disposisi Sekretaris Daerah : </label>
								<input type="date" class="form-control" id="tgl_disposisi_sekda" name="tgl_disposisi_sekda">
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
	$('#konfirmasi_izin_belajar').ready(function() {
		var c = $('#konfirmasi_izin_belajar').DataTable();
		load_data();

		function load_data() {
			$.ajax({
				url: '<?php echo site_url('AdminController/get_konfirmasi_pengajuan_izin_belajar') ?>',
				dataType: "JSON",
				success: function(data) {
					c.clear().draw();
					var HTMLbuilder = "";
					var base_url = "<?php echo base_url(); ?>";
					for (var i = 0; i < data.length; i++) {
						var berkas = base_url+"assets/img/"+data[i]['dok_ijazah_terakhir'];
						var berkas1 = base_url+"assets/img/"+data[i]['dok_surat_humdis'];
						var berkas2 = base_url+"assets/img/"+data[i]['dok_surat_dinas'];
						var ijazah_terakhir ="<a href='"+berkas+"' target='_blank'>ijazah terakhir</a>";
						var surat_dinas ="<a href='"+berkas1+"' target='_blank'>surat dinas</a>";
						var surat_humdis ="<a href='"+berkas2+"' target='_blank'>surat hukuman disiplin</a>";

						var btn1 = '<button type="button" name="btn_isi_disposisi" id="' + data[i]['id_izin_belajar'] + '" class="btn btn-xs btn-primary btn-circle btn_isi_disposisi" data-toggle="modal" data-target="#TerimaModal"><i class="fas fa-check"></i></button>';
						var btn2 = '<button type="button" name="btn_ditolak" id="' + data[i]['id_izin_belajar'] + '" class="btn btn-xs btn-danger btn-circle btn_tolak"><i class="fas fa-times"></i></button>';
						
						c.row.add([
							"<center>" + [i + 1] + "</center>",
							"<center>" + data[i]['nip'] + "</center>",
							"<center>" + data[i]['nama_pegawai'] + "</center>",
							"<center>" + data[i]['unit_kerja'] + "</center>",
							"<center>" + data[i]['nama_instansi_pendidikan'] + "</center>",
							"<center>" + data[i]['jenjang_pendidikan'] + "</center>",
							"<center>" + data[i]['tgl_pengajuan'] + "</center>",
							"<center>" + ijazah_terakhir + "<br/>"  + surat_dinas + "<br/>" + surat_humdis +"</center>",
							"<center>" + btn1 + " " + btn2 + "</center>",
						]).draw();
					}
				}
			});
		}

		$(document).on("click", ".btn_isi_disposisi", function() {
			var id_izin_belajar = $(this).attr('id');
			console.log(id_izin_belajar);
			$.ajax({
				url: "<?php echo site_url('AdminController/get_nama_aju_izin_belajar'); ?>",
				method: "GET",
				data: {
					id_izin_belajar : id_izin_belajar
				},
				success: function(ajaxData) {
					console.log(ajaxData);
					var result = JSON.parse(ajaxData);
					$('#id_izin_belajar').val(result[0]['id_izin_belajar']);
					$('#tgl_disposisi_bkpsdm').val(result[0]['tgl_disposisi_bkpsdm']);
					$('#tgl_disposisi_sekda').val(result[0]['tgl_disposisi_sekda']);
				}
			});
		});

		$('#btn_terima').click(function () {
			var update_data = $('#disposisi_form').serialize();
			$.ajax({
			url: "<?php echo site_url('AdminController/terima_aju_izin_belajar'); ?>",
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
			var id_izin_belajar = $(this).attr('id');
			var status_pengajuan = 'DITOLAK';

			swal({
					title: "Tolak Pengajuan Izin Belajar",
					text: "Apakah anda yakin akan Menolak Pengajuan ini?",
					type: "warning",
					showCancelButton: true,
					confirmButtonText: "Tolak",
					closeOnConfirm: true,
				},
				function() {
					$.ajax({
						url: "<?php echo site_url('AdminController/tolak_pengajuan_izin_belajar'); ?>",
						method: "POST",
						data: {
							id_izin_belajar: id_izin_belajar,
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