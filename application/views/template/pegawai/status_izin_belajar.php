<div class="container">
	<!-- Page Heading 
	<h1 class="h3 mb-2 text-gray-800">Konfirmasi Konsultasi</h1>
	-->
	<!-- DataTales Example -->
	<div class="card shadow mb-4">
		<div class="card-header py-3">
			<h4 class="m-0 font-weight-bold text-info">Status Izin Belajar</h4>
		</div>
		<div class="card-body">
			<div class="table-responsive">
				<table class="table table-bordered" id="tanggapan_aju_izin_belajar" width="100%">
					<thead>
						<tr>
							<th width="1%"><center>No</center></th>
							<th width="10%"><center>Tanggal Pengajuan</center></th>
							<th width="20%"><center>Instansi Pendidikan</center></th>
							<th width="5%"><center>Jenjang Pendidikan</center></th>
							<th width="10%"><center>Tanggal Disposisi BKPSDM</center></th>
							<th width="10%"><center>Tanggal Disposisi Sekretaris Daerah</center></th>
							<th width="10%"><center>Status Pengajuan</center></th>
							<th width="20%"><center>Dokumen</center></th>
							<th width="20%"><center>Aksi</center></th>
						</tr>
					</thead>
					<tbody>

					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
<!-- /.container-fluid -->

<script src="<?= base_url('assets/'); ?>vendor/jquery/jquery.js"></script>
<script src="<?= base_url('assets/'); ?>vendor/jquery/jquery.min.js"></script>

<script>
	$(document).ready(function() {
		$('#tanggapan_aju_izin_belajar').DataTable();
	});
</script>

<script type="text/javascript" language="javascript">-
	$('#tanggapan_aju_izin_belajar').ready(function() {
		var c = $('#tanggapan_aju_izin_belajar').DataTable();
		load_data();

		function load_data() {
			$.ajax({
				url: '<?php echo site_url('PegawaiController/get_tanggapan_pengajuan_izin_belajar') ?>',
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

						var btn1 = '<a href="http://localhost/layanan_bkpsdm/CetakTerimaIzinBelajarController/terimaAjuIzinBelajar?id=' + data[i]['id_izin_belajar'] + '" target="_blank" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" style="font-size:5;"><i class="fa fa-download"></i> Report</a>';
						var btn2 = '<a href="http://localhost/layanan_bkpsdm/CetakTolakIzinBelajarController/tolakAjuIzinBelajar?id=' + data[i]['id_izin_belajar'] + '" target="_blank" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" style="font-size:5;"><i class="fa fa-download"></i> Report</a>';
						var btn_tampil, txt1, txt2 ;

						if (data[i]['status_pengajuan'] == "DITERIMA") {
							btn_tampil = "<b>"+ btn1 +"</b>";
							txt1 = "<b>"+ data[i]['tgl_disposisi_bkpsdm'] +"</b>";
							txt2 = "<b>"+ data[i]['tgl_disposisi_sekda'] +"</b>";
						} else if (data[i]['status_pengajuan'] == "DITOLAK") {
							btn_tampil = "<b>"+ btn2 +"</b>";
							txt1 = "<b>-</b>";
							txt2 = "<b>-</b>";
						} else {
							btn_tampil = "<b>belum tersedia</b>";
							txt1 = "<b>-</b>";
							txt2 = "<b>-</b>";							
						}

						c.row.add([
							"<center>" + [i + 1] + "</center>",
							"<center>" + data[i]['tgl_pengajuan'] + "</center>",
							"<center>" + data[i]['nama_instansi_pendidikan'] + "</center>",
							"<center>" + data[i]['jenjang_pendidikan'] + "</center>",
							"<center>" + txt1 + "</center>",
							"<center>" + txt2 + "</center>",
							"<center>" + data[i]['status_pengajuan'] + "</center>",
							"<center>" + ijazah_terakhir + "<br/>"  + surat_dinas + "<br/>" + surat_humdis +"</center>",
							"<center>" + btn_tampil + "</center>",
						]).draw();
					}
				}
			});
		}
	});
</script>
