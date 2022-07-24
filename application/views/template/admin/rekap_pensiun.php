<?php $date = date('Y'); ?>

<div class="container">
	<!-- DataTales Example -->
	<div class="card shadow mb-4">
		<div class="card-header py-3">
			<h4 class="m-0 font-weight-bold text-primary">Rekap Pensiun</h4>
		</div>
		<div class="card-body">
			<form id="form-tampil-rekap" class="form-horizontal form-label-left" onsubmit="return false;">
				<div class="form-row">
					<div class="form-group col-md-3">
						<label class="control-label">Tahun</label>
						<select class="form-control" id="tahun" name="tahun">
							<option value="">SEMUA</option>
							<?php for ($i = $date; $i >= 2021; $i--) { ?>
								<option value='<?php echo $i; ?>'> <?php echo $i; ?> </option>
							<?php } ?>
						</select>
					</div>
					<div class="form-group col-md-3">
						<label class="control-label">Bulan</label>
						<select class="form-control" id="bulan" name="bulan">
							<option value="">SEMUA</option>
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
							<option value="">SEMUA</option>
							<option value='DITERIMA'>DITERIMA</option>
							<option value='DITOLAK'>DITOLAK</option>
						</select>
					</div>
					<div class="form-group col-md-3">
						<label class="control-label">Nama Golongan</label>
						<select class="form-control" id="nama_golongan" name="nama_golongan">
							<option value="">SEMUA</option>
							<?php foreach ($golongan as $gol) : ?>
								<option value='<?= $gol['id_golongan']; ?>'><?= $gol['nama_golongan']; ?></option>
							<?php endforeach; ?>
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
				<table class="table table-bordered" id="rekap_all_pensiun" width="100%">
					<thead>
						<tr>
							<th width="1%">
								<center>No</center>
							</th>
							<th width="10%">
								<center>NIP</center>
							</th>
							<th width="12%">
								<center>Nama Pengajuan</center>
							</th>
							<th width="10%">
								<center>Jabatan</center>
							</th>
							<th width="8%">
								<center>Golongan</center>
							</th>
							<th width="10%">
								<center>Unit Kerja</center>
							</th>
							<th width="10%">
								<center>TMT Pensiun</center>
							</th>
							<th width="6%">
								<center>Tanggal Pengajuan</center>
							</th>
							<th width="6%">
								<center>Status Pengajuan</center>
							</th>
							<th width="15%">
								<center>Dokumen</center>
							</th>
							<th width="15%">
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
		$('#rekap_all_pensiun').DataTable();
	});
</script>

<script type="text/javascript" language="javascript">
	function tampilkan() {
		postData = $('#form-tampil-rekap').serialize();
		var t = $('#rekap_all_pensiun').DataTable();
		$.ajax({
			url: '<?php echo base_url("AdminController/get_rekap_bulanan_pensiun") ?>',
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
					var berkas = base_url + "assets/img/" + data[i]['dok_kk'];
					var berkas1 = base_url + "assets/img/" + data[i]['dok_akte_anak'];
					var berkas2 = base_url + "assets/img/" + data[i]['dok_buku_nikah'];
					var kk = "<a href='" + berkas + "' target='_blank'>Kartu Keluarga</a>";
					var akte_anak = "<a href='" + berkas1 + "' target='_blank'>Akte Anak</a>";
					var buku_nikah = "<a href='" + berkas2 + "' target='_blank'>Buku Nikah</a>";

					var btn1 = '<a href="http://localhost/layanan_bkpsdm/CetakTerimaPensiunController/terimaAjuPensiun?id=' + data[i]['id_pensiun'] + '" target="_blank" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" style="font-size:5;"><i class="fa fa-download"></i> Report</a>';
					var btn_tampil;

					if (data[i]['status_pengajuan'] === "DITERIMA") {
						btn_tampil = btn1;
					} else if (data[i]['status_pengajuan'] === "DITOLAK") {
						btn_tampil = "Dokumen yang diminta belum memenuhi persyaratan, mohon di cek dan diajukan kembali";
					}

					t.row.add([
						"<center>" + [i + 1] + "</center>",
						"<center>" + data[i]['nip'] + "</center>",
						"<center>" + data[i]['nama_pegawai'] + "</center>",
						"<center>" + data[i]['jabatan'] + "</center>",
						"<center>" + data[i]['nama_golongan'] + "</center>",
						"<center>" + data[i]['unit_kerja'] + "</center>",
						"<center>" + data[i]['tmt_pensiun'] + "</center>",
						"<center>" + data[i]['tgl_pengajuan'] + "</center>",
						"<center>" + data[i]['status_pengajuan'] + "</center>",
						"<center>" + kk + "<br/>" + akte_anak + "<br/>" + buku_nikah + "</center>",
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
		gol = $('#nama_golongan').val();

		window.open("<?php echo base_url(); ?>CetakRekapPensiunController/getRekapPensiun/" + bulan + '/' + tahun + '/' + status + '/' + gol, '_blank');
	}

	$('#rekap_all_pensiun').ready(function() {
		var c = $('#rekap_all_pensiun').DataTable();
		$("#cetak_rekap1").hide();
		load_data();

		function load_data() {
			$.ajax({
				url: '<?php echo site_url("AdminController/get_all_rekap_pensiun") ?>',
				dataType: "JSON",
				success: function(data) {
					c.clear().draw();
					var HTMLbuilder = "";
					var base_url = "<?php echo base_url(); ?>";
					for (var i = 0; i < data.length; i++) {
						var berkas = base_url + "assets/img/" + data[i]['dok_kk'];
						var berkas1 = base_url + "assets/img/" + data[i]['dok_akte_anak'];
						var berkas2 = base_url + "assets/img/" + data[i]['dok_buku_nikah'];
						var kk = "<a href='" + berkas + "' target='_blank'>Kartu Keluarga</a>";
						var akte_anak = "<a href='" + berkas1 + "' target='_blank'>Akte Anak</a>";
						var buku_nikah = "<a href='" + berkas2 + "' target='_blank'>Buku Nikah</a>";

						var btn1 = '<a href="http://localhost/layanan_bkpsdm/CetakTerimaPensiunController/terimaAjuPensiun?id=' + data[i]['id_pensiun'] + '" target="_blank" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" style="font-size:5;"><i class="fa fa-download"></i> Report</a>';
						var btn_tampil;

						if (data[i]['status_pengajuan'] === "DITERIMA") {
							btn_tampil = btn1;
						} else if (data[i]['status_pengajuan'] === "DITOLAK") {
							btn_tampil = "Dokumen yang diminta belum memenuhi persyaratan, mohon di cek dan diajukan kembali";
						}

						c.row.add([
							"<center>" + [i + 1] + "</center>",
							"<center>" + data[i]['nip'] + "</center>",
							"<center>" + data[i]['nama_pegawai'] + "</center>",
							"<center>" + data[i]['jabatan'] + "</center>",
							"<center>" + data[i]['nama_golongan'] + "</center>",
							"<center>" + data[i]['unit_kerja'] + "</center>",
							"<center>" + data[i]['tmt_pensiun'] + "</center>",
							"<center>" + data[i]['tgl_pengajuan'] + "</center>",
							"<center>" + data[i]['status_pengajuan'] + "</center>",
							"<center>" + kk + "<br/>" + akte_anak + "<br/>" + buku_nikah + "</center>",
							"<center>" + btn_tampil + "</center>",
						]).draw();
					}
					5
				}
			});
		}

		$(document).on("click", ".btn_cetak", function() {
			var id_pensiun = $(this).attr('id');

			$.ajax({
				url: "<?php echo site_url('CetakRekapPensiunController/getRekapPensiun') ?>",
				method: "POST",
				data: {
					id_pensiun: id_pensiun
				},
				success: function(data) {
					//load_data();
				}
			});
		});
	});
</script>