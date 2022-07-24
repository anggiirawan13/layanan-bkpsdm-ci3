	<br />
	<br />
	<br />
	<br />
	<?php
 		foreach ($info as $result) :
    ?>
	<?php
	setlocale(LC_ALL, 'IND');
    endforeach ?>
	<table border="">
		<tr>
			<td rowspan="3" width="100"><img src="<?= base_url('assets/'); ?>img/Palembang_CoA_svg.png" style="width:65px; height:80px;"></td>
			<td width="700"></td>
		</tr>
		<tr>
			<td></td>
		</tr>
	</table>
	 <h3 align="center">
		BADAN KEPEGAWAIAN DAN PENGEMBANGAN <br/>SUMBER DAYA MANUSIA KOTA PALEMBANG
		</h3>
		<h5 align="center">
			Jl. Merdeka No.252, 19 Ilir, Kec. Bukit Kecil, Kota Palembang, Sumatera Selatan 30113
		</h5>
		<hr />
		<h2 class="h5 mb-2 text-gray-800" align="center">Surat Izin Belajar</h2>
	 	<h2 class="h5 mb-2 text-gray-800" align="center">NOMOR : 851/&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;/BKPSDM/<?php echo strftime('%Y', strtotime($result['tgl_pengajuan'])) ; ?></h2>
	 <table cellpadding="1">
		<tr>
			<td width="250"></td>
			<td width="600" align="left"></td>
		</tr>
	</table>
	<p align="left">Nomor : &nbsp;&nbsp;851/&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; /BKPSDM/<?php echo strftime('%Y', strtotime($result['tgl_pengajuan'])) ; ?></p>
	<br />
	<p align="left">Palembang, &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;<?php echo strftime('%B %Y', strtotime($result['tgl_pengajuan'])) ; ?></p>

	<p align="left">Kepada YTH.
	<br/><?php echo $result['nama_pegawai'];?></p>
	<br />
	<p align="left">Perihal : Izin Belajar</p>
	<br />
	<br />
	<p align="left">Dengan Hormat, </p>
	<br />
	<p align="justify">Menindaklanjuti surat permohonan pada tanggal <?php echo strftime('%d %B %Y', strtotime($result['tgl_pengajuan'])) ; ?> perihal permohonan Izin Belajar, dengan ini diberitahukan bahwa 
	kepada Saudara/i dibawah ini :
	</p>
    <br />
	<br />
	<br />
	<table cellpadding="3">
		<tr>
			<td width="80"></td>
			<td width="150">NIP </td>
			<td width="400" align="left">: <?php print $result['nip']; ?></td>
		</tr>
		<tr>
			<td width="80"></td>
			<td width="150">Nama Pegawai</td>
			<td width="400" align="left">: <?php print $result['nama_pegawai']; ?></td>
		</tr>
		<tr>
			<td width="80"></td>
			<td width="150">Jabatan</td>
			<td width="400" align="left">: <?php print $result['jabatan']; ?></td>
		</tr>
	</table>
	<table cellpadding="2">
		<tr>
			<td width="80"></td>
			<td width="150">Golongan </td>
			<td width="400" align="left">: <?php print $result['nama_golongan']; ?></td>
		</tr>
		<tr>
			<td width="80"></td>
			<td width="150">Unit Kerja</td>
			<td width="400" align="left">: <?php print $result['unit_kerja']; ?></td>
		</tr>
	</table>
	<br/>
	<p align="left">Untuk belum dapat disetujui Surat Tugas Belajar, dikarenakan terdapat kesalahan 
		pada syarat dan ketentuan yang telah ditentukan. Silahkan di dikirim ulang kembali sesuai syarat dan ketentuan.</p>
	<br/>
	<p align="left">Demikian surat ini disampaikan, atas perhatian dan kerja sama Saudara/i kami ucapkan terima kasih.</p>
	<br/>
	<table cellpadding="3">
		<tr>
			<td width="200"></td>
			<td width="200"></td>
			<td width="200" align="center"></td>
		</tr>
		<tr>
			<td width="400"></td>
			<td width="200" align="left">Hormat Kami,</td>
			<td width="200" align="center"></td>
		</tr>
		<tr>
			
			<td width="400"></td>
			<td width="200" align="left">Kepala BKPSDM</td>
			<td width="200" align="center"></td>
		</tr>
	</table>
	<table cellpadding="2">
		<tr>
			<td width="250"></td>
			<td width="600" align="left"></td>
		</tr>
		<tr>
			<td width="250"></td>
			<td width="600" align="left"></td>
		</tr>
		<tr>
			<td width="250"></td>
			<td width="600" align="left"></td>
		</tr>
	</table>
	<br/>
	<br/>
	<table cellpadding="3">
		<tr>
			<td width="400"></td>
			<td width="200" align="left">RIZA PAHLEVI, S.Sos.I, M.A</td>
			<td width="200" align="center"></td>
		</tr>
		<tr>
			<td width="400"></td>
			<td width="200" align="left">NIP. 197612052005011010</td>
			<td width="200" align="center"></td>
		</tr>
	</table>
	<br/>
</div>