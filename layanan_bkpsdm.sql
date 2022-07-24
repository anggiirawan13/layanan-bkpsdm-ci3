# Host: localhost  (Version 5.5.5-10.1.38-MariaDB)
# Date: 2022-07-19 08:25:50
# Generator: MySQL-Front 6.0  (Build 2.20)


#
# Structure for table "golongan"
#

DROP TABLE IF EXISTS `golongan`;
CREATE TABLE `golongan` (
  `id_golongan` int(11) NOT NULL AUTO_INCREMENT,
  `nama_golongan` varchar(128) NOT NULL,
  PRIMARY KEY (`id_golongan`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

#
# Data for table "golongan"
#

INSERT INTO `golongan` VALUES (1,'I/a (Juru Muda)'),(2,'I/b (Juru Muda Tingkat I)'),(3,'I/c (Juru)'),(4,'I/d (Juru Tingkat I)'),(5,'II/a (Pengatur Muda)'),(6,'II/b (Pengatur Muda Tingkat I)'),(7,'II/c (Pengatur)'),(8,'II/d (Pengatur Tingkat I)'),(9,'III/a (Penata Muda)'),(10,'III/b (Penata Muda Tingkat I)'),(11,'III/c Penata'),(12,'III/d (Penata Tingkat I)'),(13,'IV/a (Pembina)'),(14,'IV/b (Pembina Tingkat I)'),(15,'IV/c (Pembina Utama Muda)'),(16,'IV/d (Pembina Utama Madya)'),(17,'IV/e (Pembina Utama)');

#
# Structure for table "izin_belajar"
#

DROP TABLE IF EXISTS `izin_belajar`;
CREATE TABLE `izin_belajar` (
  `id_izin_belajar` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` varchar(50) NOT NULL DEFAULT '',
  `nama_instansi_pendidikan` varchar(50) NOT NULL DEFAULT '',
  `jenjang_pendidikan` varchar(50) NOT NULL DEFAULT '',
  `dok_ijazah_terakhir` varchar(50) NOT NULL DEFAULT '',
  `dok_surat_dinas` varchar(50) NOT NULL DEFAULT '',
  `dok_surat_humdis` varchar(50) NOT NULL DEFAULT '',
  `status_pengajuan` enum('MENUNGGU KONFIRMASI','DITERIMA','DITOLAK') DEFAULT 'MENUNGGU KONFIRMASI',
  `tgl_pengajuan` date DEFAULT NULL,
  `tgl_disposisi_bkpsdm` date DEFAULT NULL,
  `tgl_disposisi_sekda` date DEFAULT NULL,
  PRIMARY KEY (`id_izin_belajar`)
) ENGINE=InnoDB AUTO_INCREMENT=62 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

#
# Data for table "izin_belajar"
#

INSERT INTO `izin_belajar` VALUES (59,'24','Universitas Bina Darma','S2','Bab_I.pdf','Bab_II.pdf','Bab_III.pdf','DITERIMA','2022-06-28','2022-06-30','2022-07-05'),(60,'26','Universitas Taman Siswa','S2','document.pdf','8751-16536-1-SM.pdf','4618-Article_Text-13207-2-10-20200308.pdf','DITOLAK','2022-06-28','0000-00-00','0000-00-00'),(61,'33','Universitas Sriwijaya ','S2','1642087806.pdf','1642087811.pdf','1642098919.pdf','MENUNGGU KONFIRMASI','2022-06-28','0000-00-00','0000-00-00');

#
# Structure for table "pensiun"
#

DROP TABLE IF EXISTS `pensiun`;
CREATE TABLE `pensiun` (
  `id_pensiun` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` varchar(50) DEFAULT NULL,
  `tmt_pensiun` date DEFAULT NULL,
  `dok_akte_anak` varchar(50) NOT NULL DEFAULT '',
  `dok_kk` varchar(50) NOT NULL DEFAULT '',
  `dok_buku_nikah` varchar(50) NOT NULL DEFAULT '',
  `status_pengajuan` enum('MENUNGGU KONFIRMASI','DITERIMA','DITOLAK') DEFAULT 'MENUNGGU KONFIRMASI',
  `tgl_pengajuan` date DEFAULT NULL,
  `tgl_asistentiga` date DEFAULT NULL,
  `tgl_disposisi_sekda` date DEFAULT NULL,
  `tgl_disposisi_bkn_pusat` date DEFAULT NULL,
  PRIMARY KEY (`id_pensiun`)
) ENGINE=InnoDB AUTO_INCREMENT=56 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

#
# Data for table "pensiun"
#

INSERT INTO `pensiun` VALUES (54,'27','2022-06-28','1480557_pdf.pdf','266-273-3-PB.pdf','4047-Article_Text-17814-2-10-20210906.pdf','DITERIMA','2022-06-28','2022-07-14','2022-07-26','2022-07-31'),(55,'30','2022-06-29','DAFTAR_PEJABAT_DILANTIK_25-05-2022.pdf','syarat_pensiun.pdf','SK3D.pdf','DITOLAK','2022-06-28','0000-00-00','0000-00-00','0000-00-00');

#
# Structure for table "user"
#

DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id_user` int(4) NOT NULL AUTO_INCREMENT,
  `id_role` int(11) NOT NULL DEFAULT '0',
  `username` varchar(50) NOT NULL DEFAULT '',
  `password` varchar(256) NOT NULL DEFAULT '',
  `nip` varchar(50) NOT NULL DEFAULT '',
  `nama_pegawai` varchar(100) DEFAULT '',
  `jabatan` varchar(100) NOT NULL DEFAULT '',
  `unit_kerja` varchar(200) NOT NULL DEFAULT '',
  `id_golongan` int(10) NOT NULL DEFAULT '0',
  `date_created` date DEFAULT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

#
# Data for table "user"
#

INSERT INTO `user` VALUES (1,1,'admin','e10adc3949ba59abbe56e057f20f883e','-','-','-','-',0,'0000-00-00'),(2,3,'atasan','e10adc3949ba59abbe56e057f20f883e','-','-','-','-',0,'0000-00-00'),(24,2,'198701052010011003','e10adc3949ba59abbe56e057f20f883e','198701052010011003','RYAN ANDRIAN, S.T.','Kepala Sub Bidang Data dan Informasi','Badan Kepegawaian dan Pengembangan Sumber Daya Manusia',11,'2022-02-08'),(26,2,'197807132010011007','e10adc3949ba59abbe56e057f20f883e','197807132010011007','ROMI MAWARMAN, S.E.','ANALIS KEPEGAWAIAN','Badan Kepegawaian dan Pengembangan Sumber Daya Manusia',12,'2022-02-08'),(27,2,'198203252011011008','e10adc3949ba59abbe56e057f20f883e','198203252011011008','RECKY MARDIANSYAH, S.H., M.Si.','Kepala Sub Bidang Penilaian dan Evaluasi Kinerja Aparatur','Badan Kepegawaian Dan Pengembangan Sumber Daya Manusia',11,'2022-02-08'),(30,2,'199007082014021001','e10adc3949ba59abbe56e057f20f883e','199007082014021001','MUHAMMAD BOBBY SALAM, S.Kom.','ANALIS PERENCANAAN SDM APARATUR','Badan Kepegawaian dan Pengembangan Sumber Daya Manusia',10,'2022-02-08'),(33,2,'199611132020122019','e10adc3949ba59abbe56e057f20f883e','199611132020122019','AYU NOVITASARI, S.Kom','PRANATA KOMPUTER','Badan Kepegawaian dan Pengembangan Sumber Daya Manusia Kota Palembang',9,'2022-06-28');

#
# Structure for table "user_role"
#

DROP TABLE IF EXISTS `user_role`;
CREATE TABLE `user_role` (
  `id_role` int(11) NOT NULL AUTO_INCREMENT,
  `nama_role` varchar(128) NOT NULL,
  PRIMARY KEY (`id_role`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

#
# Data for table "user_role"
#

INSERT INTO `user_role` VALUES (1,'Admin'),(2,'Pegawai'),(3,'Atasan');
