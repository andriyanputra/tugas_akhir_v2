-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Sep 26, 2014 at 04:16 AM
-- Server version: 5.5.27
-- PHP Version: 5.4.7

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `tugas_akhir`
--

-- --------------------------------------------------------

--
-- Table structure for table `bangunan`
--

CREATE TABLE IF NOT EXISTS `bangunan` (
  `ID_BANGUNAN` int(11) NOT NULL AUTO_INCREMENT,
  `ID_MASTER` int(11) NOT NULL,
  `NAMA_BANGUNAN` varchar(100) NOT NULL,
  `TINGKAT_BANGUNAN` int(2) NOT NULL,
  `KET_BANGUNAN` varchar(100) NOT NULL,
  PRIMARY KEY (`ID_BANGUNAN`),
  KEY `FK_master_bangunan` (`ID_MASTER`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=96 ;

--
-- Dumping data for table `bangunan`
--

INSERT INTO `bangunan` (`ID_BANGUNAN`, `ID_MASTER`, `NAMA_BANGUNAN`, `TINGKAT_BANGUNAN`, `KET_BANGUNAN`) VALUES
(1, 3, 'Pabrik tepung', 3, ''),
(2, 2, 'Minyak hidrolik', 3, 'Mudah terbakar.'),
(3, 3, 'Pabrik pemintalan kapas', 3, ''),
(4, 3, 'Pengecoran logam', 3, ''),
(5, 3, 'Pabrik dan penyimpanan bahan peledak dan piroteknik', 3, ''),
(6, 3, 'Pabrik biji padi-padian', 3, ''),
(7, 2, 'Pengecatan/penyemprotan', 3, 'Dengan cairan mudah terbakar'),
(8, 2, 'Pelapisan/pencelupan', 3, ''),
(9, 3, 'Pabrik minyak biji rami', 3, ''),
(10, 2, 'Perakitan rumah modular', 3, ''),
(11, 3, 'Pengolahan metal (metal extruding)', 3, ''),
(12, 3, 'Pabrik plastik', 3, ''),
(13, 3, 'Pabrik plywood dan semacamnya', 3, ''),
(14, 2, 'Percetakan', 3, 'Menggunakan tinta mudah terbakar'),
(15, 3, 'Daur ulang karet', 3, ''),
(16, 3, 'Penggergajian kayu', 3, ''),
(17, 3, 'Tempat penyimpanan jerami', 3, ''),
(18, 2, 'Pelapisan furnitur', 3, 'Dengan busa plastik'),
(19, 2, 'Kandang kuda komersial', 4, ''),
(20, 3, 'Gudang bahan bangunan', 4, ''),
(21, 2, 'Pusat perbelanjaan', 4, ''),
(22, 2, 'Ruang pamer, audiotorium dan teater', 4, ''),
(23, 3, 'Tempat penyimpanan bahan pangan', 4, ''),
(24, 3, 'Terminal pengangkutan', 4, ''),
(25, 3, 'Pertokoan/perdagangan', 4, ''),
(26, 3, 'Pabrik kertas dan pulp', 4, ''),
(27, 3, 'Pemrosesan kertas', 4, ''),
(28, 4, 'Pelabuhan', 4, ''),
(29, 2, 'Bengkel', 4, ''),
(30, 3, 'Pabrik dan penyimpanan produk karet', 4, ''),
(31, 3, 'Gudang', 4, 'Furnitur, umum, cat, kertas, minuman keras, dan produk kayu'),
(32, 1, 'Tempat hiburan', 5, ''),
(33, 3, 'Pabrik pakaian', 5, ''),
(34, 3, 'Gudang pendingin', 5, ''),
(35, 3, 'Gudang kembang gula', 5, ''),
(36, 3, 'Gudang hasil pertanian', 5, ''),
(37, 2, 'Binatu ruang pamer dagang', 5, ''),
(38, 2, 'Kandang kuda komersial', 5, ''),
(39, 3, 'Pabrik produk kulit', 5, ''),
(40, 1, 'Perpustakaan', 5, 'Dengan gudang buku yang besar'),
(41, 2, 'Kios sablon', 5, ''),
(42, 2, 'Toko mesin', 5, ''),
(43, 2, 'Toko besi', 5, ''),
(44, 6, 'Kebun bibit', 5, ''),
(45, 3, 'Pabrik farmasi', 5, ''),
(46, 1, 'Percetakan', 5, ''),
(47, 5, 'Rumah makan', 5, ''),
(48, 3, 'Pabrik tali', 5, ''),
(49, 3, 'Pabrik gula', 5, ''),
(50, 2, 'Penyamakan kulit', 5, ''),
(51, 3, 'Pabrik tekstil', 5, ''),
(52, 3, 'Gudang tembakau', 5, ''),
(53, 5, 'Bangunan kosong', 5, ''),
(54, 3, 'Gudang/pabrik senjata', 6, ''),
(55, 5, 'Garasi parkir mobil', 6, ''),
(56, 3, 'Pabrik roti', 6, ''),
(57, 2, 'Salon kecantikan dan potong rambut', 6, ''),
(58, 3, 'Pabrik minuman/bier', 6, ''),
(59, 3, 'Ruang Boiler', 6, ''),
(60, 3, 'Pabrik bata, ubin dan produk tanah liat', 6, ''),
(61, 3, 'Pabrik kembang gula', 6, ''),
(62, 3, 'Pabrik semen', 6, ''),
(63, 5, 'Rumah ibadah', 6, ''),
(64, 3, 'Pabrik susu', 6, ''),
(65, 2, 'Tempat praktek dokter', 6, ''),
(66, 3, 'Pabrik elektronik', 6, ''),
(67, 5, 'Tungku/dapur', 6, ''),
(68, 3, 'Pabrik pakaian bulu hewan', 6, ''),
(69, 2, 'Pompa bensin', 6, ''),
(70, 3, 'Pabrik gelas', 6, ''),
(71, 2, 'Kandang kuda', 6, ''),
(72, 2, 'Kamar mayat', 6, ''),
(73, 1, 'Gedung pemerintah', 6, ''),
(74, 1, 'Kantor pos', 6, ''),
(75, 2, 'Rumah pemotongan hewan', 6, ''),
(76, 2, 'Kantor telepon', 6, ''),
(77, 3, 'Pabrik produk tembakau', 6, ''),
(78, 3, 'Pabrik arloji/pehiasan', 6, ''),
(79, 3, 'Pabrik anggur', 6, ''),
(80, 5, 'Apartemen', 7, ''),
(81, 1, 'Universitas', 7, ''),
(82, 2, 'Kelab', 7, ''),
(83, 5, 'Asrama', 7, ''),
(84, 5, 'Perumahan', 7, ''),
(85, 1, 'Pos kebakaran', 7, ''),
(86, 5, 'Rumah sakit', 7, ''),
(87, 2, 'Hotel dan Motel', 7, ''),
(88, 1, 'Perpustakaan', 7, 'Kecuali gudang buku'),
(89, 2, 'Museum', 7, ''),
(90, 2, 'Rumah perawatan', 7, ''),
(91, 1, 'Perkantoran', 7, ''),
(92, 1, 'Kantor polisi', 7, ''),
(93, 1, 'Penjara', 7, ''),
(94, 1, 'Sekolah', 7, ''),
(95, 2, 'Teater tanpa panggung', 7, '');

-- --------------------------------------------------------

--
-- Table structure for table `desa`
--

CREATE TABLE IF NOT EXISTS `desa` (
  `DESA_ID` int(2) NOT NULL AUTO_INCREMENT,
  `DESA_NAMA` varchar(50) NOT NULL,
  `KECAMATAN_ID` int(2) NOT NULL,
  PRIMARY KEY (`DESA_ID`),
  KEY `FK_kecamatan` (`KECAMATAN_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=355 ;

--
-- Dumping data for table `desa`
--

INSERT INTO `desa` (`DESA_ID`, `DESA_NAMA`, `KECAMATAN_ID`) VALUES
(1, 'Bakalan Wiringinpitu', 1),
(2, 'Bakung Pringgodani', 1),
(3, 'Bakung Temenggungan', 1),
(4, 'Balongbendo', 1),
(5, 'Bogem Pinggir', 1),
(6, 'Gagang Kepuhsari', 1),
(7, 'Jabaran', 1),
(8, 'Jeruk Legi', 1),
(9, 'Kedung Sukodani', 1),
(10, 'Kemangsen', 1),
(11, 'Penambangan', 1),
(12, 'Seduri', 1),
(13, 'Seketi', 1),
(14, 'Singkalan', 1),
(15, 'Sumokembangsri', 1),
(16, 'Suwaluh', 1),
(17, 'Waruberon', 1),
(18, 'Watesari', 1),
(19, 'Wonokarang', 1),
(20, 'Wonokupang', 1),
(21, 'Banjarkemantren', 2),
(22, 'Banjarsari', 2),
(23, 'Buduran', 2),
(24, 'Damarsi', 2),
(25, 'Dukuhtengah', 2),
(26, 'Entalsewu', 2),
(27, 'Pagerwojo', 2),
(28, 'Prasung', 2),
(29, 'Sawohan', 2),
(30, 'Sidokepung', 2),
(31, 'Sidokerto', 2),
(32, 'Sidomulyo', 2),
(33, 'Siwalan Panji', 2),
(34, 'Sukorejo', 2),
(35, 'Wadungasih', 2),
(36, 'Balongdowo', 3),
(37, 'Balonggabus', 3),
(38, 'Bligo', 3),
(40, 'Candi', 3),
(41, 'Durungbanjar', 3),
(42, 'Durungbedug', 3),
(43, 'Gelam', 3),
(44, 'Jambangan', 3),
(45, 'Kalipecabean', 3),
(46, 'Karangtanjung', 3),
(47, 'Kebunsari', 3),
(48, 'Kedung Peluk', 3),
(49, 'Kedungkendo', 3),
(50, 'Kendalpencabean', 3),
(51, 'Klurak', 3),
(52, 'Larangan', 3),
(53, 'Ngampelsari', 3),
(54, 'Sepande', 3),
(55, 'Sidodadi', 3),
(56, 'Sugih Waras', 3),
(57, 'Sumokali', 3),
(58, 'Sumorame', 3),
(59, 'Tenggulunan', 3),
(60, 'Wedoro Klurak', 3),
(61, 'Bangah', 4),
(62, 'Ganting', 4),
(63, 'Gedangan', 4),
(64, 'Gemurung', 4),
(65, 'Karangbong', 4),
(66, 'Keboansikep', 4),
(67, 'Keboananom', 4),
(68, 'Ketajen', 4),
(69, 'Kragan', 4),
(70, 'Punggul', 4),
(71, 'Sawotratap', 4),
(72, 'Semambung', 4),
(73, 'Sruni', 4),
(74, 'Tebel', 4),
(75, 'Wedi', 4),
(76, 'Balongtani', 5),
(77, 'Besuki', 5),
(78, 'Dukuhsari', 5),
(79, 'Jemirahan', 5),
(80, 'Keboguyang', 5),
(81, 'Kedungcangkring', 5),
(82, 'Kedungpandan', 5),
(83, 'Kedungrejo', 5),
(84, 'Kupang', 5),
(85, 'Panggreh', 5),
(86, 'Pejarakan', 5),
(87, 'Permisan', 5),
(88, 'Semambung', 5),
(89, 'Tambak Kalisogo', 5),
(90, 'Trompoasri', 5),
(91, 'Balong Garut', 6),
(92, 'Cangkring', 6),
(93, 'Gading', 6),
(94, 'Jenggot', 6),
(95, 'Kandangan', 6),
(96, 'Kedungrawan', 6),
(97, 'Kedungsumur', 6),
(98, 'Keper', 6),
(99, 'Keret', 6),
(100, 'Krembung', 6),
(101, 'Lemujut', 6),
(102, 'Mojoruntut', 6),
(103, 'Ploso', 6),
(104, 'Rejeni', 6),
(105, 'Tambakrejo', 6),
(106, 'Tanjeg Wagir', 6),
(107, 'Wangkal', 6),
(108, 'Waung', 6),
(109, 'Wonomlati', 6),
(110, 'Barengkrajan', 7),
(111, 'Gamping', 7),
(112, 'Jatikalang', 7),
(113, 'Jeruk Gamping', 7),
(114, 'Junwangi', 7),
(115, 'Katrungan', 7),
(116, 'Keboharan', 7),
(117, 'Kemasan', 7),
(118, 'Kraton', 7),
(119, 'Krian', 7),
(120, 'Ponokawan', 7),
(121, 'Sedengan Mijen', 7),
(122, 'Sidomojo', 7),
(123, 'Sidomulyo', 7),
(124, 'Sidorejo', 7),
(125, 'Tambak Kemerakan', 7),
(126, 'Tempel', 7),
(127, 'Terik', 7),
(128, 'Terung Kulon', 7),
(129, 'Terung Wetan', 7),
(130, 'Tropodo', 7),
(131, 'Watugolong', 7),
(132, 'Candipari', 8),
(133, 'Gedang', 8),
(134, 'Glagah Arum', 8),
(135, 'Jatirejo', 8),
(136, 'Juwet Kenongo', 8),
(137, 'Kebakalan', 8),
(138, 'Kebonagung', 8),
(139, 'Kedungboto', 8),
(140, 'Kedungsolo', 8),
(141, 'Kesambi', 8),
(142, 'Lajuk', 8),
(143, 'Mindi', 8),
(144, 'Pamotan', 8),
(145, 'Pesawahan', 8),
(146, 'Plumbon', 8),
(147, 'Porong', 8),
(148, 'Renokenongo', 8),
(149, 'Siring', 8),
(150, 'Wunut', 8),
(151, 'Bendotretek', 9),
(152, 'Bulang', 9),
(153, 'Cangkringturi', 9),
(154, 'Gampang', 9),
(155, 'Gedangrowo', 9),
(156, 'Jati Alun Alun', 9),
(157, 'Jatikalang', 9),
(158, 'Jedongcangkring', 9),
(159, 'Kajartengguli', 9),
(160, 'Kedungkembar', 9),
(161, 'Kedungsugo', 9),
(162, 'Kedungwonokerto', 9),
(163, 'Pejangkungan', 9),
(164, 'Prambon', 9),
(165, 'Simogirang', 9),
(166, 'Simpang', 9),
(167, 'Temu', 9),
(168, 'Watutulis', 9),
(169, 'Wirobiting', 9),
(170, 'Wono Plintahan', 9),
(171, 'Banjar Kemuning', 10),
(172, 'Betro', 10),
(173, 'Buncitan', 10),
(174, 'Cemandi', 10),
(175, 'Gisik Cemandi', 10),
(176, 'Kalanganyar', 10),
(177, 'Kwangsan', 10),
(178, 'Pabean', 10),
(179, 'Pepe', 10),
(180, 'Pranti', 10),
(181, 'Pulungan', 10),
(182, 'Sedati Agung', 10),
(183, 'Sedati Gede', 10),
(184, 'Segoro Tambak', 10),
(185, 'Semampir', 10),
(186, 'Tambak Cemandi', 10),
(187, 'Magersari', 11),
(188, 'Sidokumpul', 11),
(189, 'Lemahputro', 11),
(190, 'Pekauman', 11),
(191, 'Sidokare', 11),
(192, 'Celep', 11),
(193, 'Sekardangan', 11),
(194, 'Pucanganom', 11),
(195, 'Sidoklumpuk', 11),
(196, 'Pucang', 11),
(197, 'Lebo', 11),
(198, 'Suko', 11),
(199, 'Banjarbendo', 11),
(200, 'Jati', 11),
(201, 'Sumput', 11),
(202, 'Gebang', 11),
(203, 'Bluru Kidul', 11),
(204, 'Bulusidokare', 11),
(205, 'Cemeng Bakalan', 11),
(206, 'Cemeng Kalang', 11),
(207, 'Kemiri', 11),
(208, 'Rangkahkidul', 11),
(209, 'Sari Rogo', 11),
(210, 'Urangagung (Jedong)', 11),
(211, 'Panjunan', 12),
(212, 'Anggaswangi', 12),
(213, 'Bangsri', 12),
(214, 'Cangkringsari', 12),
(215, 'Jogosatru', 12),
(216, 'Jumputrejo', 12),
(217, 'Kebonagung', 12),
(218, 'Keloposepuluh', 12),
(219, 'Masangan Kulon', 12),
(220, 'Masangan Wetan', 12),
(221, 'Ngaresrejo', 12),
(222, 'Pademonegoro', 12),
(223, 'Pekarungan', 12),
(224, 'Plumbungan', 12),
(225, 'Sambungrejo', 12),
(226, 'Suko', 12),
(227, 'Sukodono', 12),
(228, 'Suruh', 12),
(229, 'Wilayut', 12),
(230, 'Krembangan', 13),
(231, 'Bebekan', 13),
(232, 'Bohar', 13),
(233, 'Bringinbendo', 13),
(234, 'Geluran', 13),
(235, 'Gilang', 13),
(236, 'Jemundo', 13),
(237, 'Kalijaten', 13),
(238, 'Kedungturi', 13),
(239, 'Ketegan', 13),
(240, 'Kletek', 13),
(241, 'Kramat Jegu', 13),
(242, 'Ngelom', 13),
(243, 'Pertapan Maduretno', 13),
(244, 'Sadang', 13),
(245, 'Sambi Bulu', 13),
(246, 'Sepanjang', 13),
(247, 'Sidodadi', 13),
(248, 'Taman', 13),
(249, 'Tanjungsari', 13),
(250, 'Tawangsari', 13),
(251, 'Trosobo', 13),
(252, 'Wage', 13),
(253, 'Wonocolo', 13),
(254, 'Banjar Asri', 14),
(255, 'Banjar Panji', 14),
(256, 'Boro', 14),
(257, 'Ganggang Panjang', 14),
(258, 'Gempol Sari', 14),
(259, 'Kalidawir', 14),
(260, 'Kalisampurno', 14),
(261, 'Kalitengah', 14),
(262, 'Kedensari', 14),
(263, 'Kedung Banteng', 14),
(264, 'Kedung Bendo', 14),
(265, 'Ketapang', 14),
(266, 'Ketegan', 14),
(267, 'Kludan', 14),
(268, 'Ngaban', 14),
(269, 'Penatarsewu', 14),
(270, 'Putat', 14),
(271, 'Randegan', 14),
(272, 'Sentul', 14),
(273, 'Balongmacekan', 15),
(274, 'Banjarwungu', 15),
(275, 'Gampingrowo', 15),
(276, 'Gempolklutuk', 15),
(277, 'Janti', 15),
(278, 'Kalimati', 15),
(279, 'Kedinding', 15),
(280, 'Kedungbocok', 15),
(281, 'Kemuning', 15),
(282, 'Kendalsewu', 15),
(283, 'Klantingsari', 15),
(284, 'Kramat Temenggung', 15),
(285, 'Mergobener', 15),
(286, 'Mergosari', 15),
(287, 'Mindugading', 15),
(288, 'Miriprowo', 15),
(289, 'Sebani', 15),
(290, 'Segodobancang', 15),
(291, 'Singogalih', 15),
(292, 'Tarik', 15),
(293, 'Gelang', 16),
(294, 'Grabagan', 16),
(295, 'Grinting', 16),
(296, 'Grogol', 16),
(297, 'Janti', 16),
(298, 'Jiken', 16),
(299, 'Kajeksan', 16),
(300, 'Kebaron', 16),
(301, 'Kedondong', 16),
(302, 'Kemantren', 16),
(303, 'Kenongo', 16),
(304, 'Kepadangan', 16),
(305, 'Kepatihan', 16),
(306, 'Kepuh Kemiri', 16),
(307, 'Kepunten', 16),
(308, 'Medalem', 16),
(309, 'Modong', 16),
(310, 'Pangkemiri', 16),
(311, 'Singopadu', 16),
(312, 'Sudimoro', 16),
(313, 'Tlasih', 16),
(314, 'Tulangan', 16),
(315, 'Berbek', 17),
(316, 'Bungurasih', 17),
(317, 'Janti', 17),
(318, 'Kedungrejo', 17),
(319, 'Kepuh Kiriman', 17),
(320, 'Kureksari', 17),
(321, 'Medaeng', 17),
(322, 'Ngingas', 17),
(323, 'Pepelegi', 17),
(324, 'Tambak Oso', 17),
(325, 'Tambak Rejo', 17),
(326, 'Tambak Sawah', 17),
(327, 'Tambak Sumur', 17),
(328, 'Tropodo', 17),
(329, 'Wadungasri', 17),
(330, 'Waru', 17),
(331, 'Wedoro', 17),
(332, 'Becirongengor', 18),
(333, 'Candinegoro', 18),
(334, 'Jimbaran Kulon', 18),
(335, 'Jimbaran Wetan', 18),
(336, 'Karangpuri', 18),
(337, 'Ketimang', 18),
(338, 'Lambangan', 18),
(339, 'Mojorangagung', 18),
(340, 'Mulyodadi', 18),
(341, 'Pagerngumbuk', 18),
(342, 'Pilang', 18),
(343, 'Plaosan', 18),
(344, 'Ploso', 18),
(345, 'Popoh', 18),
(346, 'Sawocangkring', 18),
(347, 'Semambung', 18),
(348, 'Simo Angin-angin', 18),
(349, 'Simoketawang', 18),
(350, 'Sumberejo', 18),
(351, 'Tanggul', 18),
(352, 'Wonoayu', 18),
(353, 'Wonokalang', 18),
(354, 'Wonokasian', 18);

-- --------------------------------------------------------

--
-- Table structure for table `jabatan`
--

CREATE TABLE IF NOT EXISTS `jabatan` (
  `jabatan_id` int(2) NOT NULL AUTO_INCREMENT,
  `jabatan_nama` varchar(30) NOT NULL,
  PRIMARY KEY (`jabatan_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `jabatan`
--

INSERT INTO `jabatan` (`jabatan_id`, `jabatan_nama`) VALUES
(1, 'Kepala Bidang PMK'),
(2, 'Kepala Seksi Oprasional'),
(3, 'Kepala Seksi Sarana'),
(4, 'Staff Administrasi Umum'),
(5, 'Komandan Pleton'),
(6, 'Komandan Regu'),
(7, 'Operator'),
(8, 'Anggota');

-- --------------------------------------------------------

--
-- Table structure for table `kecamatan`
--

CREATE TABLE IF NOT EXISTS `kecamatan` (
  `KECAMATAN_ID` int(2) NOT NULL AUTO_INCREMENT,
  `KECAMATAN_NAMA` varchar(50) NOT NULL,
  `KECAMATAN_DIR` varchar(255) NOT NULL,
  PRIMARY KEY (`KECAMATAN_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=19 ;

--
-- Dumping data for table `kecamatan`
--

INSERT INTO `kecamatan` (`KECAMATAN_ID`, `KECAMATAN_NAMA`, `KECAMATAN_DIR`) VALUES
(1, 'Balongbendo', 'balongbendo.png'),
(2, 'Buduran', 'buduran.png'),
(3, 'Candi', 'candi.png'),
(4, 'Gedangan', 'gedangan.png'),
(5, 'Jabon', 'jabon.png'),
(6, 'Krembung', 'krembung.png'),
(7, 'Krian', 'krian.png'),
(8, 'Porong', 'porong.png'),
(9, 'Prambon', 'prambon.png'),
(10, 'Sedati', 'sedati.png'),
(11, 'Sidoarjo', 'sidoarjo.png'),
(12, 'Sukodono', 'sukodono.png'),
(13, 'Taman', 'taman.png'),
(14, 'Tanggulangin', 'tanggulangin.png'),
(15, 'Tarik', 'tarik.png'),
(16, 'Tulangan', 'tulangan.png'),
(17, 'Waru', 'waru.png'),
(18, 'Wonoayu', 'wonoayu.png');

-- --------------------------------------------------------

--
-- Table structure for table `level_user`
--

CREATE TABLE IF NOT EXISTS `level_user` (
  `ID_LEVEL_USER` int(11) NOT NULL AUTO_INCREMENT,
  `NAMA_LEVEL_USER` varchar(40) NOT NULL,
  PRIMARY KEY (`ID_LEVEL_USER`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `level_user`
--

INSERT INTO `level_user` (`ID_LEVEL_USER`, `NAMA_LEVEL_USER`) VALUES
(1, 'Admin (Staff Administrasi Umum)'),
(2, 'Kepala Bidang');

-- --------------------------------------------------------

--
-- Table structure for table `master_bangunan`
--

CREATE TABLE IF NOT EXISTS `master_bangunan` (
  `ID_MASTER` int(11) NOT NULL AUTO_INCREMENT,
  `NAMA_MASTER` varchar(50) NOT NULL,
  PRIMARY KEY (`ID_MASTER`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `master_bangunan`
--

INSERT INTO `master_bangunan` (`ID_MASTER`, `NAMA_MASTER`) VALUES
(1, 'Perkantoran'),
(2, 'Usaha Dagang dan Jasa'),
(3, 'Industri'),
(4, 'Kendaraan Bermotor'),
(5, 'Rumah'),
(6, 'Lahan / Sawah');

-- --------------------------------------------------------

--
-- Table structure for table `pasca`
--

CREATE TABLE IF NOT EXISTS `pasca` (
  `pasca_id` int(11) NOT NULL AUTO_INCREMENT,
  `resiko_id` int(11) NOT NULL,
  `pasca_penyebab` varchar(20) NOT NULL,
  `pasca_luas` varchar(20) NOT NULL,
  `pasca_bangunan_add` varchar(50) NOT NULL,
  `pasca_luka` varchar(20) NOT NULL,
  `pasca_meninggal` varchar(20) NOT NULL,
  `pasca_biaya` varchar(20) NOT NULL,
  `pasca_status` enum('selesai','belum') DEFAULT NULL,
  PRIMARY KEY (`pasca_id`),
  KEY `FK_resiko` (`resiko_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

-- --------------------------------------------------------

--
-- Table structure for table `pegawai`
--

CREATE TABLE IF NOT EXISTS `pegawai` (
  `pegawai_nip` int(20) NOT NULL,
  `id_level_user` int(11) NOT NULL,
  `pegawai_nama` varchar(50) NOT NULL,
  `pegawai_tempat` varchar(50) NOT NULL,
  `pegawai_tanggal` date NOT NULL,
  `pegawai_kelamin` varchar(20) NOT NULL,
  `pegawai_alamat` varchar(50) NOT NULL,
  `pegawai_no_telp` varchar(20) NOT NULL,
  `jabatan_id` int(2) NOT NULL,
  `pegawai_email` varchar(50) NOT NULL,
  `pegawai_password` varchar(200) NOT NULL,
  `pegawai_foto` varchar(255) NOT NULL,
  PRIMARY KEY (`pegawai_nip`),
  KEY `FK_jabatan` (`jabatan_id`),
  KEY `id_level_user` (`id_level_user`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pegawai`
--

INSERT INTO `pegawai` (`pegawai_nip`, `id_level_user`, `pegawai_nama`, `pegawai_tempat`, `pegawai_tanggal`, `pegawai_kelamin`, `pegawai_alamat`, `pegawai_no_telp`, `jabatan_id`, `pegawai_email`, `pegawai_password`, `pegawai_foto`) VALUES
(115623001, 1, 'Achmad Fatoni', 'Surabaya', '1992-01-01', 'Laki-laki', 'Surabaya', '085733964366', 4, 'fatoni@gmail.com', '96e9befa8d7aec506eed783915a237f3', '120814-Achmad-Fatoni.jpg'),
(115623003, 2, 'Andriyan Dwi P', 'Sidoarjo', '2014-04-30', 'Laki-laki', 'Sidoarjo', '242112321421', 1, 'andriyan.115623003@gmail.com', '21232f297a57a5a743894a0e4a801fc3', 'Downfall342.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `pengiriman_air`
--

CREATE TABLE IF NOT EXISTS `pengiriman_air` (
  `ID_PENGIRIMAN` int(11) NOT NULL AUTO_INCREMENT,
  `literMenit` int(5) NOT NULL,
  `galonMenit` int(5) NOT NULL,
  PRIMARY KEY (`ID_PENGIRIMAN`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `pengiriman_air`
--

INSERT INTO `pengiriman_air` (`ID_PENGIRIMAN`, `literMenit`, `galonMenit`) VALUES
(1, 946, 250),
(2, 1893, 500),
(3, 2839, 750),
(4, 3785, 1000);

-- --------------------------------------------------------

--
-- Table structure for table `resiko`
--

CREATE TABLE IF NOT EXISTS `resiko` (
  `resiko_id` int(11) NOT NULL AUTO_INCREMENT,
  `resiko_tanggal` datetime NOT NULL,
  `nama_pelapor` varchar(50) NOT NULL,
  `nomor_telp` varchar(12) NOT NULL,
  `alamat_pelapor` varchar(100) NOT NULL,
  `ID_BANGUNAN` int(11) NOT NULL,
  `DESA_ID` int(2) NOT NULL,
  `KECAMATAN_ID` int(2) NOT NULL,
  `ID_SUMBER` int(11) NOT NULL,
  `exposure` varchar(50) NOT NULL,
  `tepol` varchar(50) NOT NULL,
  `panjang` varchar(10) NOT NULL,
  `lebar` varchar(10) NOT NULL,
  `tinggi` varchar(10) NOT NULL,
  `pasokan_air_minimum` varchar(10) NOT NULL,
  `penerapan_air` varchar(10) NOT NULL,
  `pengangkutan_air` varchar(10) NOT NULL,
  `tipe_proteksi` enum('MPKP','MPKL','MPKBG') DEFAULT NULL,
  PRIMARY KEY (`resiko_id`),
  KEY `FK_kecamatan` (`KECAMATAN_ID`),
  KEY `FK_bangunan` (`ID_BANGUNAN`),
  KEY `FK_desa` (`DESA_ID`),
  KEY `FK_sumber_air` (`ID_SUMBER`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC AUTO_INCREMENT=14 ;

--
-- Dumping data for table `resiko`
--

INSERT INTO `resiko` (`resiko_id`, `resiko_tanggal`, `nama_pelapor`, `nomor_telp`, `alamat_pelapor`, `ID_BANGUNAN`, `DESA_ID`, `KECAMATAN_ID`, `ID_SUMBER`, `exposure`, `tepol`, `panjang`, `lebar`, `tinggi`, `pasokan_air_minimum`, `penerapan_air`, `pengangkutan_air`, `tipe_proteksi`) VALUES
(13, '2014-09-26 09:03:06', 'Putri Lestari', '085645339345', 'Jalan Gedangan No. 19', 31, 204, 11, 8, 'Tanpa resiko bangunan berdekatan.', '<b>Tidak</b> Menggunakan Tepol', '100.00', '30.00', '4.00', '104468', '8357', '28', 'MPKP');

-- --------------------------------------------------------

--
-- Table structure for table `sumber_air`
--

CREATE TABLE IF NOT EXISTS `sumber_air` (
  `ID_SUMBER` int(11) NOT NULL AUTO_INCREMENT,
  `NAMA_SUMBER` varchar(50) NOT NULL,
  `KET_SUMBER` varchar(100) NOT NULL,
  PRIMARY KEY (`ID_SUMBER`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=46 ;

--
-- Dumping data for table `sumber_air`
--

INSERT INTO `sumber_air` (`ID_SUMBER`, `NAMA_SUMBER`, `KET_SUMBER`) VALUES
(1, 'K. Kanal Pelayaran', '-'),
(2, 'K. Kanal Porong', '-'),
(3, 'K. Tambak Oso', '-'),
(4, 'K. Buntung', '-'),
(5, 'K. Tambakagung', '-'),
(6, 'K. Cangkring', '-'),
(7, 'K. Ketingan', '-'),
(8, 'K. Pucang', '-'),
(9, 'K. Porong', '-'),
(10, 'K. Semambung', '-'),
(11, 'K. Kendil', '-'),
(12, 'K. Brasan', '-'),
(13, 'K. Kedunguling', '-'),
(14, 'K. Gisik', '-'),
(15, 'K. Kanal Mangetan', '-'),
(16, 'K. Mas', '-'),
(17, 'K. Brantas', '-'),
(18, 'K. Kemambang', '-'),
(19, 'K. Bungepuh', '-'),
(37, 'Hydrant Air Candi', 'Perum Taman Tiara (Candi)'),
(43, 'Kolam Pancuran', 'Alun - alun Kota Sidoarjo'),
(45, 'Kali Mboto', 'wew');

-- --------------------------------------------------------

--
-- Table structure for table `sumber_air_desa`
--

CREATE TABLE IF NOT EXISTS `sumber_air_desa` (
  `ID_SAD` int(11) NOT NULL AUTO_INCREMENT,
  `ID_SUMBER` int(11) NOT NULL,
  `DESA_ID` int(2) NOT NULL,
  PRIMARY KEY (`ID_SAD`),
  KEY `FK_sumber_air` (`ID_SUMBER`),
  KEY `DESA_ID` (`DESA_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=74 ;

--
-- Dumping data for table `sumber_air_desa`
--

INSERT INTO `sumber_air_desa` (`ID_SAD`, `ID_SUMBER`, `DESA_ID`) VALUES
(1, 1, 14),
(2, 1, 3),
(3, 1, 2),
(4, 1, 5),
(5, 1, 11),
(6, 1, 126),
(7, 1, 242),
(8, 1, 253),
(9, 1, 249),
(10, 2, 147),
(11, 2, 138),
(12, 2, 81),
(13, 2, 78),
(14, 2, 76),
(15, 3, 324),
(16, 4, 248),
(17, 4, 238),
(18, 4, 316),
(19, 4, 318),
(20, 4, 320),
(21, 4, 184),
(22, 5, 176),
(23, 5, 179),
(24, 5, 177),
(25, 6, 346),
(26, 7, 29),
(27, 7, 27),
(28, 8, 196),
(29, 8, 206),
(30, 8, 210),
(31, 8, 356),
(32, 8, 26),
(33, 9, 147),
(34, 9, 140),
(35, 9, 143),
(36, 10, 88),
(37, 11, 269),
(38, 11, 259),
(39, 11, 146),
(40, 11, 103),
(41, 11, 94),
(42, 11, 36),
(43, 11, 87),
(44, 12, 50),
(45, 12, 255),
(46, 12, 146),
(47, 13, 508),
(48, 13, 302),
(49, 13, 158),
(50, 13, 42),
(51, 13, 283),
(52, 14, 176),
(53, 14, 186),
(54, 15, 176),
(55, 15, 151),
(56, 15, 119),
(57, 15, 23),
(58, 15, 333),
(59, 15, 4),
(60, 15, 212),
(61, 16, 249),
(62, 16, 230),
(63, 17, 280),
(64, 17, 288),
(65, 18, 60),
(66, 19, 310),
(67, 19, 268),
(68, 19, 109),
(69, 19, 51),
(70, 19, 50),
(71, 37, 40),
(72, 43, 196),
(73, 45, 63);

-- --------------------------------------------------------

--
-- Table structure for table `sumber_air_kecamatan`
--

CREATE TABLE IF NOT EXISTS `sumber_air_kecamatan` (
  `ID_SAK` int(11) NOT NULL AUTO_INCREMENT,
  `ID_SUMBER` int(11) NOT NULL,
  `KECAMATAN_ID` int(2) NOT NULL,
  PRIMARY KEY (`ID_SAK`),
  KEY `FK_kecamatan` (`KECAMATAN_ID`),
  KEY `FK_sumber_air` (`ID_SUMBER`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=50 ;

--
-- Dumping data for table `sumber_air_kecamatan`
--

INSERT INTO `sumber_air_kecamatan` (`ID_SAK`, `ID_SUMBER`, `KECAMATAN_ID`) VALUES
(1, 1, 1),
(2, 1, 7),
(3, 1, 13),
(4, 2, 5),
(5, 2, 8),
(6, 3, 17),
(7, 4, 10),
(8, 4, 13),
(9, 4, 17),
(10, 5, 10),
(11, 6, 18),
(12, 7, 2),
(13, 8, 2),
(14, 8, 9),
(15, 8, 11),
(16, 8, 18),
(17, 9, 8),
(19, 10, 5),
(20, 11, 3),
(21, 11, 5),
(22, 11, 6),
(23, 11, 8),
(24, 11, 14),
(25, 12, 3),
(26, 12, 8),
(27, 12, 14),
(28, 13, 3),
(29, 13, 9),
(30, 13, 15),
(31, 13, 16),
(32, 14, 10),
(33, 15, 1),
(34, 15, 2),
(35, 15, 7),
(36, 15, 9),
(37, 15, 10),
(38, 15, 12),
(39, 15, 18),
(40, 16, 13),
(41, 17, 15),
(42, 18, 3),
(43, 19, 3),
(44, 19, 6),
(45, 19, 14),
(46, 19, 16),
(47, 37, 3),
(48, 43, 11),
(49, 45, 4);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bangunan`
--
ALTER TABLE `bangunan`
  ADD CONSTRAINT `bangunan_ibfk_1` FOREIGN KEY (`ID_MASTER`) REFERENCES `master_bangunan` (`ID_MASTER`) ON UPDATE CASCADE;

--
-- Constraints for table `desa`
--
ALTER TABLE `desa`
  ADD CONSTRAINT `FK_kecamatan` FOREIGN KEY (`KECAMATAN_ID`) REFERENCES `kecamatan` (`KECAMATAN_ID`);

--
-- Constraints for table `pegawai`
--
ALTER TABLE `pegawai`
  ADD CONSTRAINT `FK_jabatan` FOREIGN KEY (`jabatan_id`) REFERENCES `jabatan` (`jabatan_id`),
  ADD CONSTRAINT `pegawai_ibfk_1` FOREIGN KEY (`id_level_user`) REFERENCES `level_user` (`ID_LEVEL_USER`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `sumber_air_desa`
--
ALTER TABLE `sumber_air_desa`
  ADD CONSTRAINT `sumber_air_desa_ibfk_1` FOREIGN KEY (`ID_SUMBER`) REFERENCES `sumber_air` (`ID_SUMBER`) ON UPDATE CASCADE;

--
-- Constraints for table `sumber_air_kecamatan`
--
ALTER TABLE `sumber_air_kecamatan`
  ADD CONSTRAINT `sumber_air_kecamatan_ibfk_2` FOREIGN KEY (`KECAMATAN_ID`) REFERENCES `kecamatan` (`KECAMATAN_ID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `sumber_air_kecamatan_ibfk_1` FOREIGN KEY (`ID_SUMBER`) REFERENCES `sumber_air` (`ID_SUMBER`) ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
