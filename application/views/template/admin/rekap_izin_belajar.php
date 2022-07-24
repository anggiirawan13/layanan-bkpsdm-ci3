<?php $date = date('Y'); ?>

<div class="container">
	<!-- DataTales Example -->
	<div class="card shadow mb-4">
		<div class="card-header py-3">
			<h4 class="m-0 font-weight-bold text-primary">Rekap Izin Belajar</h4>
		</div>
		<div class="card-body">
			<form id="form-tampil-rekap" class="form-horizontal form-label-left" onsubmit="return false;">
				<div class="form-row">
					<div class="form-group col-md-3">
						<label class="control-label">Tahun</label>
						<select class="form-control" id="tahun" name="tahun">
							<option value=''>SEMUA</option>
							<?php for ($i = $date; $i >= 2021; $i--) { ?>
								<option value='<?php echo $i; ?>'> <?php echo $i; ?> </option>
							<?php } ?>
						</select>
					</div>
					<div class="form-group col-md-3">
						<label class="control-label">Bulan</label>
						<select class="form-control" id="bulan" name="bulan">
							<option value=''>SEMUA</option>
							<option value='01'>Januari</option>
							<option value='02'>Februari</option>
							<option value='03'>Maret</option>
							<option value='04'>April</option>
							<option value='05'>Mei</option>
							<option value='06'>Juni</option>
							<option value='07'>Juli</option>
							<option value='08'>Agustus</option>
							<option value='09'>September</option>
							<option value='10'>Oktober</option>
							<option value='11'>November</option>
							<option value='12'>Desember</option>
						</select>
					</div>
					<div class="form-group col-md-3">
						<label class="control-label">Status Pengajuan</label>
						<select class="form-control" id="status" name="status">
							<option value=''>SEMUA</option>
							<option value="DITERIMA">DITERIMA</option>
							<option value="DITOLAK">DITOLAK</option>
						</select>
					</div>
					<div class="form-group col-md-3">
						<label class="control-label">Jenjang Pendidikan</label>
						<select class="form-control" id="pendidikan" name="pendidikan">
							<option value=''>SEMUA</option>
							<option value="D3">D3</option>
							<option value="S1">S1</option>
							<option value="S2">S2</option>
							<option value="S3">S3</option>
						</select>
					</div>
				</div>
				<div class="form-group">
					<button type="submit" id="tampilkan_rekap" onclick="tampilkan();" class="btn btn-primary">Tampilkan</button>
					<button type="submit" id="cetak_rekap1" onchange="Cetak_pns()" onclick="cetak_rekap();" class="btn btn-danger">Cetak</button>
				</div>
			</form>
			<hr>
			<div class="table-responsive">
				<table class="table table-bordered" id="rekap_all_izin_belajar" width="100%">
					<thead>
						<tr>
							<th width="1%">
								<center>No</center>
							</th>
							<th width="15%">
								<center>NIP</center>
							</th>
							<th width="12%">
								<center>Nama Pengajuan</center>
							</th>
							<th width="10%">
								<center>Unit Kerja</center>
							</th>
							<th width="10%">
								<center>Instansi Pendidikan</center>
							</th>
							<th width="10%">
								<center>Jenjang <br />Pendidikan</center>
							</th>
							<th width="6%">
								<center>Status Pengajuan</center>
							</th>
							<th width="6%">
								<center>Tanggal Pengajuan</center>
							</th>
							<th width="20%">
								<center>Dokumen</center>
							</th>
							<th width="20%">
								<center>Berkas</center>
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

<script src="<?= base_url('assets/'); ?>vendor/jquery/jquery.min.js"></script>

<script>
	$(document).ready(function() {
		$('#rekap_all_izin_belajar').DataTable();
	});
</script>

<script type="text/javascript" language="javascript">
	function tampilkan() {
		postData = $('#form-tampil-rekap').serialize();
		var t = $('#rekap_all_izin_belajar').DataTable();
		$.ajax({
			url: '<?php echo base_url("AdminController/get_rekap_bulanan_izin_belajar") ?>',
			type: "GET",
			data: postData,

			beforeSend: function() {
				t.clear().draw();
			},

			success: function(ajaxData) {
				var data = JSON.parse(ajaxData);
				if (data.length > 0) {
					$("#cetak_rekap1").show();
				} else {
					$("#cetak_rekap1").hide();
				}

				t.clear().draw();
				var base_url = "<?php echo base_url(); ?>";
				for (var i = 0; i < data.length; i++) {
					var berkas = base_url + "assets/img/" + data[i]['dok_ijazah_terakhir'];
					var berkas1 = base_url + "assets/img/" + data[i]['dok_surat_humdis'];
					var berkas2 = base_url + "assets/img/" + data[i]['dok_surat_dinas'];
					var ijazah_terakhir = "<a href='" + berkas + "' target='_blank'>ijazah terakhir</a>";
					var surat_dinas = "<a href='" + berkas1 + "' target='_blank'>surat dinas</a>";
					var surat_humdis = "<a href='" + berkas2 + "' target='_blank'>surat hukuman disiplin</a>";
					var btn1 = '<a href="http://localhost/layanan_bkpsdm/CetakTerimaIzinBelajarController/terimaAjuIzinBelajar?id=' + data[i]['id_izin_belajar'] + '" target="_blank" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" style="font-size:5;"><i class="fa fa-download"></i> Report</a>';
					var btn2 = '<a href="http://localhost/layanan_bkpsdm/CetakTolakIzinBelajarController/tolakAjuIzinBelajar?id=' + data[i]['id_izin_belajar'] + '" target="_blank" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" style="font-size:5;"><i class="fa fa-download"></i> Report</a>';
					var btn_tampil;

					if (data[i]['status_pengajuan'] === "DITERIMA") {
						btn_tampil = btn1;
					} else if (data[i]['status_pengajuan'] === "DITOLAK") {
						btn_tampil = btn2;
					}
					t.row.add([
						"<center>" + [i + 1] + "</center>",
						"<center>" + data[i]['nip'] + "</center>",
						"<center>" + data[i]['nama_pegawai'] + "</center>",
						"<center>" + data[i]['unit_kerja'] + "</center>",
						"<center>" + data[i]['nama_instansi_pendidikan'] + "</center>",
						"<center>" + data[i]['jenjang_pendidikan'] + "</center>",
						"<center>" + data[i]['status_pengajuan'] + "</center>",
						"<center>" + data[i]['tgl_pengajuan'] + "</center>",
						"<center>" + ijazah_terakhir + "<br/>" + surat_dinas + "<br/>" + surat_humdis + "</center>",
						"<center>" + btn_tampil + "</center>",
					]).draw();
				}
			},
			error: function(status) {
				t.clear().draw();
			}
		});
	}

	function cetak_rekap() {
		bulan = $('#bulan').val();
		tahun = $('#tahun').val();
		status = $('#status').val();
		pendidikan = $('#pendidikan').val();

		window.open("<?php echo base_url(); ?>CetakRekapIzinBelajarController/getRekapIzinBelajar/" + bulan + '/' + tahun + '/' + status + '/' + pendidikan, '_blank');
	}

	$('#rekap_all_izin_belajar').ready(function() {
		var c = $('#rekap_all_izin_belajar').DataTable();
		$("#cetak_rekap1").hide();
		load_data();

		function load_data() {
			$.ajax({
				url: '<?php echo site_url("AdminController/get_all_rekap_izin_belajar") ?>',
				dataType: "JSON",
				success: function(data) {
					c.clear().draw();
					var HTMLbuilder = "";
					var base_url = "<?php echo base_url(); ?>";
					for (var i = 0; i < data.length; i++) {
						var berkas = base_url + "assets/img/" + data[i]['dok_ijazah_terakhir'];
						var berkas1 = base_url + "assets/img/" + data[i]['dok_surat_humdis'];
						var berkas2 = base_url + "assets/img/" + data[i]['dok_surat_dinas'];
						var ijazah_terakhir = "<a href='" + berkas + "' target='_blank'>ijazah terakhir</a>";
						var surat_dinas = "<a href='" + berkas1 + "' target='_blank'>surat dinas</a>";
						var surat_humdis = "<a href='" + berkas2 + "' target='_blank'>surat hukuman disiplin</a>";
						var btn1 = '<a href="http://localhost/layanan_bkpsdm/CetakTerimaIzinBelajarController/terimaAjuIzinBelajar?id=' + data[i]['id_izin_belajar'] + '" target="_blank" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" style="font-size:5;"><i class="fa fa-download"></i> Report</a>';
						var btn2 = '<a href="http://localhost/layanan_bkpsdm/CetakTolakIzinBelajarController/tolakAjuIzinBelajar?id=' + data[i]['id_izin_belajar'] + '" target="_blank" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" style="font-size:5;"><i class="fa fa-download"></i> Report</a>';
						var btn_tampil;

						if (data[i]['status_pengajuan'] == "DITERIMA") {
							btn_tampil = btn1;
						} else if (data[i]['status_pengajuan'] == "DITOLAK") {
							btn_tampil = btn2;
						}

						c.row.add([
							"<center>" + [i + 1] + "</center>",
							"<center>" + data[i]['nip'] + "</center>",
							"<center>" + data[i]['nama_pegawai'] + "</center>",
							"<center>" + data[i]['unit_kerja'] + "</center>",
							"<center>" + data[i]['nama_instansi_pendidikan'] + "</center>",
							"<center>" + data[i]['jenjang_pendidikan'] + "</center>",
							"<center>" + data[i]['status_pengajuan'] + "</center>",
							"<center>" + data[i]['tgl_pengajuan'] + "</center>",
							"<center>" + ijazah_terakhir + "<br/>" + surat_dinas + "<br/>" + surat_humdis + "</center>",
							"<center>" + btn_tampil + "</center>",
						]).draw();
					}
					5
				}
			});
		}

		$(document).on("click", ".btn_cetak", function() {
			var id_izin_belajar = $(this).attr('id');

			$.ajax({
				url: "<?php echo site_url('CetakRekapIzinBelajarController/getRekapIzinBelajar') ?>",
				method: "POST",
				data: {
					id_izin_belajar: id_izin_belajar
				},
				success: function(data) {
					//load_data();
				}
			});
		});
	});
</script>