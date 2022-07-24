<div class="container">
    <!-- Page Heading -->
    
    <?php 
    foreach ($list as $result) :
    ?>
    <?php 
    setlocale(LC_ALL, 'IND');
    endforeach ?>
    <h2 class="h5 mb-2 text-gray-800" align="center">Laporan Rekap Pensiun</h2>
    <h2 class="h5 mb-2 text-gray-800" align="center">Bulan <?php echo strftime('%B', strtotime($result['tgl_pengajuan'])); ?> Tahun <?php echo strftime('%Y', strtotime($result['tgl_pengajuan'])); ?></h2>
    <h2 class="h5 mb-2 text-gray-800" align="center">BKPSDM Kota Palembang</h2>
    <br />
	<br />
    <!-- DataTales Example -->
    <div class="table-responsive">
        <table class="table table-bordered" border="1" id="rekap_pengajuan" width="100%">
            <thead>
                <tr align="center">
                    <td width="25">No</td>
                    <td width="150">NIP</td>
                    <td width="150">Nama <br/>Pegawai</td>
                    <td width="100">Golongan</td>
                    <td width="160">Unit <br/>Kerja</td>
                    <td width="80">Status Pengajuan</td>
                    <td width="100">Tanggal Pengajuan</td>
                    <td width="80">Tanggal Disposisi Asisten 3</td>
                    <td width="80">Tanggal Disposisi Sekretaris Daerah</td>
                    <td width="80">Tanggal Disposisi BKN Pusat</td>
                </tr>
            </thead>
            <tbody>
                <?php
                    $i = 0;
                    foreach ($list as $row) :
                ?>
                    <tr align="center">
                        <td width="25"><?php echo $i + 1 ?></td>
                        <td width="150"><?php echo $row['nip'] ?></td>
                        <td width="150"><?php echo $row['nama_pegawai'] ?></td>
                        <td width="100"><?php echo $row['nama_golongan'] ?></td>
                        <td width="160"><?php echo $row['unit_kerja'] ?></td>
                        <td width="80"><?php echo $row['status_pengajuan'] ?></td>
                        <td width="100"><?php echo $row['tgl_pengajuan'] ?></td>
                        <td width="80"><?php echo $row['tgl_asistentiga'] ?></td>
                        <td width="80"><?php echo $row['tgl_disposisi_sekda'] ?></td>
                        <td width="80"><?php echo $row['tgl_disposisi_bkn_pusat'] ?></td>
                    </tr>
                    <?php
                    $i++;
                endforeach ?>
            </tbody>
        </table>
    </div>


</div>