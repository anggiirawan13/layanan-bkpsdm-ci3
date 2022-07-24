<div class="container">
	<!-- DataTales Example -->
	<div class="card shadow mb-4">
		<div class="card-header py-3">
			<h4 class="m-0 font-weight-bold text-info">Status Pensiun</h4>
		</div>
		<div class="card-body">
			<div class="table-responsive">
				<table class="table table-bordered" id="tanggapan_aju_pensiun" width="100%">
					<thead>
						<tr>
							<th width="1%"><center>No</center></th>
							<th width="15%"><center>Tanggal Pengajuan</center></th>
							<th width="15%"><center>TMT Pensiun</center></th>
							<th width="10%"><center>Tanggal Asisten 3</center></th>
							<th width="10%"><center>Tanggal Sekretaris Daerah</center></th>
							<th width="10%"><center>Tanggal BKN Pusat</center></th>
							<th width="15%"><center>Status Pengajuan</center></th>
							<th width="20%"><center>Dokumen</center></th>
							<th width="15%"><center>Tanggapan</center></th>
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
		$('#tanggapan_aju_pensiun').DataTable();
	});
</script>

<script type="text/javascript" language="javascript">-
	$('#tanggapan_aju_pensiun').ready(function() {
		var c = $('#tanggapan_aju_pensiun').DataTable();
		load_data();

		function load_data() {
			$.ajax({

				url: '<?php echo site_url('PegawaiController/get_tanggapan_pengajuan_pensiun') ?>',
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

						var btn1 = '<a href="http://localhost/layanan_bkpsdm/CetakTerimaPensiunController/terimaAjuPensiun?id=' + data[i]['id_pensiun'] + '" target="_blank" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" style="font-size:5;"><i class="fa fa-download"></i> Report</a>';
						var btn_tampil, txt, txt1, txt2;

						if (data[i]['status_pengajuan'] == "DITERIMA") {
							btn_tampil = "<b>"+ btn1 +"</b>";
							txt1 = "<b>"+ data[i]['tgl_asistentiga'] +"</b>";
							txt2 = "<b>"+ data[i]['tgl_disposisi_sekda'] +"</b>";
							txt3 = "<b>"+ data[i]['tgl_disposisi_bkn_pusat'] +"</b>";
						} else if (data[i]['status_pengajuan'] == "DITOLAK") {
							btn_tampil = "<b>Dokumen yang diminta belum memenuhi persyaratan, mohon di cek dan diajukan kembali</b>";
							txt1 = "<b>-</b>";
							txt2 = "<b>-</b>";
							txt3 = "<b>-</b>";		
						} else {
							btn_tampil = "<b>belum tersedia</b>";
							txt1 = "<b>-</b>";
							txt2 = "<b>-</b>";		
							txt3 = "<b>-</b>";							
						}

						c.row.add([
							"<center>" + [i + 1] + "</center>",
							"<center>" + data[i]['tgl_pengajuan'] + "</center>",
							"<center>" + data[i]['tmt_pensiun'] + "</center>",
							"<center>" + txt1 + "</center>",
							"<center>" + txt2 + "</center>",
							"<center>" + txt3 + "</center>",
							"<center>" + data[i]['status_pengajuan'] + "</center>",
							"<center>" + kk + "<br/>"  + akte_anak + "<br/>" + buku_nikah +"</center>",
							"<center>" + btn_tampil + "</center>",
						]).draw();
					}
				}
			});
		}
	});
</script>
