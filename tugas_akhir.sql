-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Inang: 127.0.0.1
-- Waktu pembuatan: 06 Nov 2014 pada 09.35
-- Versi Server: 5.5.27
-- Versi PHP: 5.4.7

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Basis data: `tugas_akhir`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `bangunan`
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
-- Dumping data untuk tabel `bangunan`
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
-- Struktur dari tabel `desa`
--

CREATE TABLE IF NOT EXISTS `desa` (
  `DESA_ID` int(2) NOT NULL AUTO_INCREMENT,
  `DESA_NAMA` varchar(50) NOT NULL,
  `KECAMATAN_ID` int(2) NOT NULL,
  PRIMARY KEY (`DESA_ID`),
  KEY `FK_kecamatan` (`KECAMATAN_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=355 ;

--
-- Dumping data untuk tabel `desa`
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
-- Struktur dari tabel `foto_resiko`
--

CREATE TABLE IF NOT EXISTS `foto_resiko` (
  `foto_id` int(11) NOT NULL AUTO_INCREMENT,
  `resiko_id` int(11) NOT NULL,
  `foto_nama` varchar(50) DEFAULT NULL,
  `foto_dir` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`foto_id`),
  KEY `FK_resiko` (`resiko_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data untuk tabel `foto_resiko`
--

INSERT INTO `foto_resiko` (`foto_id`, `resiko_id`, `foto_nama`, `foto_dir`) VALUES
(1, 115, 'Rumah Makan (Buduran)', '251014-rm.jpg'),
(2, 115, 'wew', '271014-Capture2.jpg'),
(3, 56, 'Pabrik biji', '271014-pabrik (sidoarjo).jpg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `grafik`
--

CREATE TABLE IF NOT EXISTS `grafik` (
  `grafik_id` int(11) NOT NULL DEFAULT '0',
  `grafik_bln` varchar(2) DEFAULT NULL,
  `grafik_thn` int(4) DEFAULT NULL,
  `grafik_mpkp` int(2) DEFAULT NULL,
  `grafik_mpkl` int(2) DEFAULT NULL,
  `grafik_mpkbg` int(2) DEFAULT NULL,
  `grafik_luka` int(2) DEFAULT NULL,
  `grafik_meninggal` int(2) DEFAULT NULL,
  `grafik_bbm` int(2) DEFAULT NULL,
  `grafik_kpr` int(2) DEFAULT NULL,
  `grafik_lst` int(2) DEFAULT NULL,
  `grafik_rk` int(2) DEFAULT NULL,
  `grafik_lain` int(2) DEFAULT NULL,
  `grafik_perkantoran` int(2) DEFAULT NULL,
  `grafik_udj` int(2) DEFAULT NULL,
  `grafik_industri` int(2) DEFAULT NULL,
  `grafik_kb` int(2) DEFAULT NULL,
  `grafik_rumah` int(2) DEFAULT NULL,
  `grafik_lahan` int(2) DEFAULT NULL,
  PRIMARY KEY (`grafik_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `grafik`
--

INSERT INTO `grafik` (`grafik_id`, `grafik_bln`, `grafik_thn`, `grafik_mpkp`, `grafik_mpkl`, `grafik_mpkbg`, `grafik_luka`, `grafik_meninggal`, `grafik_bbm`, `grafik_kpr`, `grafik_lst`, `grafik_rk`, `grafik_lain`, `grafik_perkantoran`, `grafik_udj`, `grafik_industri`, `grafik_kb`, `grafik_rumah`, `grafik_lahan`) VALUES
(1, '01', 2013, 8, 0, 3, 2, 0, 4, 3, 2, 1, 1, 0, 0, 7, 0, 0, 0),
(2, '02', 2013, 5, 0, 1, 0, 0, 2, 0, 4, 0, 0, 0, 1, 4, 1, 1, 0),
(3, '03', 2013, 2, 0, 1, 0, 0, 2, 0, 1, 0, 0, 0, 0, 1, 2, 0, 0),
(4, '04', 2013, 3, 0, 0, 0, 0, 2, 0, 1, 0, 0, 0, 1, 2, 0, 0, 0),
(5, '05', 2013, 4, 0, 0, 0, 0, 2, 1, 1, 0, 0, 0, 0, 4, 0, 0, 0),
(6, '06', 2013, 1, 0, 1, 0, 0, 0, 1, 1, 0, 0, 0, 0, 1, 0, 0, 0),
(7, '07', 2013, 4, 0, 0, 0, 0, 1, 1, 0, 0, 2, 0, 1, 0, 1, 0, 0),
(8, '08', 2013, 9, 5, 0, 0, 0, 3, 3, 4, 3, 1, 0, 1, 3, 0, 1, 5),
(9, '09', 2013, 9, 13, 0, 0, 0, 6, 1, 3, 8, 4, 0, 2, 2, 0, 3, 12),
(10, '10', 2013, 13, 12, 1, 0, 0, 6, 6, 5, 7, 2, 0, 1, 1, 0, 1, 12),
(11, '11', 2013, 2, 13, 0, 0, 0, 4, 1, 0, 7, 3, 0, 0, 0, 1, 0, 13),
(12, '12', 2013, 0, 3, 0, 0, 0, 0, 0, 0, 1, 2, 0, 0, 0, 0, 0, 3),
(13, '01', 2012, 3, 0, 0, 0, 0, 0, 0, 2, 0, 1, 0, 0, 2, 0, 1, 0),
(14, '02', 2012, 4, 0, 0, 0, 0, 0, 0, 3, 0, 1, 0, 0, 2, 0, 2, 0),
(15, '03', 2012, 6, 0, 0, 0, 0, 0, 0, 7, 0, 0, 0, 0, 1, 0, 5, 0),
(16, '04', 2012, 8, 1, 0, 0, 0, 0, 0, 3, 0, 6, 0, 1, 5, 1, 1, 1),
(17, '05', 2012, 4, 1, 0, 0, 0, 0, 0, 0, 0, 4, 0, 0, 2, 0, 1, 1),
(18, '06', 2012, 9, 2, 0, 0, 0, 1, 2, 2, 0, 6, 0, 2, 3, 0, 4, 2),
(19, '07', 2012, 6, 13, 0, 1, 0, 0, 0, 2, 0, 17, 0, 3, 1, 0, 2, 13),
(20, '08', 2012, 9, 19, 0, 0, 0, 0, 3, 1, 0, 24, 0, 3, 2, 0, 4, 19),
(21, '09', 2012, 18, 20, 1, 0, 0, 0, 1, 6, 0, 32, 0, 6, 2, 2, 9, 20),
(22, '10', 2012, 22, 21, 2, 0, 0, 0, 0, 2, 0, 22, 0, 1, 0, 0, 2, 21),
(23, '11', 2012, 8, 10, 0, 0, 0, 0, 0, 2, 2, 16, 0, 5, 0, 0, 3, 10),
(24, '12', 2012, 8, 0, 0, 0, 0, 0, 1, 5, 0, 2, 0, 2, 2, 0, 4, 0),
(25, '01', 2011, 8, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 3, 3, 0, 3, 0),
(26, '02', 2011, 2, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 1, 0),
(27, '03', 2011, 6, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 0, 2, 0, 3, 0),
(28, '04', 2011, 4, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 3, 0, 1, 0),
(29, '05', 2011, 6, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 2, 4, 1),
(30, '06', 2011, 12, 11, 0, 2, 0, 0, 0, 0, 0, 0, 1, 4, 5, 0, 2, 11),
(31, '07', 2011, 10, 11, 0, 0, 2, 0, 0, 0, 0, 0, 1, 1, 2, 1, 5, 11),
(32, '08', 2011, 17, 19, 0, 0, 0, 0, 0, 0, 0, 0, 0, 5, 6, 0, 6, 19),
(33, '09', 2011, 13, 17, 0, 0, 0, 0, 0, 0, 0, 0, 1, 2, 5, 0, 5, 17),
(34, '10', 2011, 21, 9, 1, 0, 0, 0, 0, 0, 0, 0, 0, 6, 8, 2, 6, 9),
(35, '11', 2011, 5, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 4, 0, 1, 1),
(36, '12', 2011, 7, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 2, 3, 2, 0, 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `grafik_bangunan`
--

CREATE TABLE IF NOT EXISTS `grafik_bangunan` (
  `grafik_id` int(11) NOT NULL AUTO_INCREMENT,
  `grafik_tahun` int(4) NOT NULL,
  `ID_MASTER` int(11) NOT NULL,
  `grafik_nilai` int(2) NOT NULL,
  PRIMARY KEY (`grafik_id`),
  KEY `FK_master_bangunan` (`ID_MASTER`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Dumping data untuk tabel `grafik_bangunan`
--

INSERT INTO `grafik_bangunan` (`grafik_id`, `grafik_tahun`, `ID_MASTER`, `grafik_nilai`) VALUES
(1, 2011, 1, 4),
(2, 2011, 2, 23),
(3, 2011, 3, 41),
(4, 2011, 4, 8),
(5, 2011, 5, 37),
(6, 2011, 6, 69),
(7, 2012, 1, 0),
(8, 2012, 2, 23),
(9, 2012, 3, 22),
(10, 2012, 4, 3),
(11, 2012, 5, 39),
(12, 2012, 6, 86);

-- --------------------------------------------------------

--
-- Struktur dari tabel `grafik_bangunan_terbakar`
--

CREATE TABLE IF NOT EXISTS `grafik_bangunan_terbakar` (
  `grafik_id` int(11) NOT NULL AUTO_INCREMENT,
  `tahun` int(4) NOT NULL,
  `KECAMATAN_ID` int(2) NOT NULL,
  `industri` int(2) NOT NULL,
  `perkantoran` int(2) NOT NULL,
  `udj` int(2) NOT NULL,
  `kb` int(2) NOT NULL,
  `rumah` int(2) NOT NULL,
  `lahan` int(2) NOT NULL,
  `luka` int(2) NOT NULL,
  `meninggal` int(2) NOT NULL,
  PRIMARY KEY (`grafik_id`),
  KEY `FK_kecamatan` (`KECAMATAN_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=37 ;

--
-- Dumping data untuk tabel `grafik_bangunan_terbakar`
--

INSERT INTO `grafik_bangunan_terbakar` (`grafik_id`, `tahun`, `KECAMATAN_ID`, `industri`, `perkantoran`, `udj`, `kb`, `rumah`, `lahan`, `luka`, `meninggal`) VALUES
(1, 2011, 11, 5, 2, 4, 5, 8, 34, 0, 2),
(2, 2011, 2, 3, 0, 1, 0, 5, 6, 0, 0),
(3, 2011, 3, 3, 0, 2, 1, 4, 7, 0, 0),
(4, 2011, 14, 0, 0, 0, 0, 1, 0, 0, 0),
(5, 2011, 4, 7, 0, 1, 0, 1, 2, 0, 0),
(6, 2011, 17, 8, 2, 3, 0, 9, 7, 2, 0),
(7, 2011, 10, 0, 0, 1, 0, 1, 0, 0, 0),
(8, 2011, 12, 3, 0, 2, 0, 1, 5, 0, 0),
(9, 2011, 18, 2, 0, 1, 1, 0, 0, 0, 0),
(10, 2011, 13, 6, 0, 6, 1, 4, 4, 0, 0),
(11, 2011, 7, 3, 0, 0, 0, 3, 4, 0, 0),
(12, 2011, 6, 0, 0, 0, 0, 0, 0, 0, 0),
(13, 2011, 1, 1, 0, 0, 0, 0, 0, 0, 0),
(14, 2011, 9, 0, 0, 0, 0, 0, 0, 0, 0),
(15, 2011, 15, 0, 0, 0, 0, 0, 0, 0, 0),
(16, 2011, 5, 0, 0, 0, 0, 0, 0, 0, 0),
(17, 2011, 8, 0, 0, 0, 0, 0, 0, 0, 0),
(18, 2011, 16, 0, 0, 2, 0, 0, 0, 0, 0),
(19, 2012, 11, 3, 0, 5, 1, 8, 32, 0, 0),
(20, 2012, 2, 3, 0, 1, 1, 3, 8, 0, 0),
(21, 2012, 3, 4, 0, 2, 0, 2, 6, 0, 0),
(22, 2012, 14, 0, 0, 0, 0, 2, 1, 0, 0),
(23, 2012, 4, 1, 0, 3, 0, 1, 3, 0, 0),
(24, 2012, 17, 2, 0, 5, 0, 10, 13, 1, 0),
(25, 2012, 10, 1, 0, 1, 0, 1, 1, 0, 0),
(26, 2012, 12, 1, 0, 0, 0, 1, 1, 0, 0),
(27, 2012, 18, 1, 0, 0, 0, 0, 0, 0, 0),
(28, 2012, 13, 1, 0, 3, 0, 6, 5, 0, 0),
(29, 2012, 7, 3, 0, 2, 0, 2, 4, 0, 0),
(30, 2012, 6, 1, 0, 0, 0, 0, 1, 0, 0),
(31, 2012, 1, 1, 0, 0, 0, 0, 1, 0, 0),
(32, 2012, 9, 0, 0, 0, 0, 0, 1, 0, 0),
(33, 2012, 15, 0, 0, 0, 0, 0, 1, 0, 0),
(34, 2012, 5, 0, 0, 0, 0, 0, 1, 0, 0),
(35, 2012, 8, 0, 0, 0, 1, 1, 3, 0, 0),
(36, 2012, 16, 0, 0, 1, 0, 2, 4, 0, 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `grafik_kebakaran`
--

CREATE TABLE IF NOT EXISTS `grafik_kebakaran` (
  `id` int(11) NOT NULL,
  `tahun` int(11) NOT NULL,
  `jumlah_kejadian` int(11) NOT NULL,
  `industri` int(11) NOT NULL,
  `perkantoran` int(11) NOT NULL,
  `udj` int(11) NOT NULL,
  `rumah` int(11) NOT NULL,
  `kb` int(11) NOT NULL,
  `ls` int(11) NOT NULL,
  `bbm` int(11) NOT NULL,
  `kpr` int(11) NOT NULL,
  `lst` int(11) NOT NULL,
  `rk` int(11) NOT NULL,
  `lain` int(11) NOT NULL,
  `luka` int(11) NOT NULL,
  `meninggal` int(11) NOT NULL,
  `nominal_kerugian` varchar(15) NOT NULL,
  `luas_area` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `grafik_kebakaran`
--

INSERT INTO `grafik_kebakaran` (`id`, `tahun`, `jumlah_kejadian`, `industri`, `perkantoran`, `udj`, `rumah`, `kb`, `ls`, `bbm`, `kpr`, `lst`, `rk`, `lain`, `luka`, `meninggal`, `nominal_kerugian`, `luas_area`) VALUES
(1, 2009, 147, 45, 28, 0, 34, 4, 36, 0, 10, 27, 1, 109, 4, 0, '3543000000', 1899716000),
(2, 2010, 80, 22, 19, 0, 22, 1, 16, 0, 8, 22, 1, 49, 1, 0, '2563000000', 1291689);

-- --------------------------------------------------------

--
-- Struktur dari tabel `grafik_kecamatan`
--

CREATE TABLE IF NOT EXISTS `grafik_kecamatan` (
  `grafik_id` int(3) NOT NULL AUTO_INCREMENT,
  `KECAMATAN_ID` int(2) DEFAULT NULL,
  `jml_kejadian` int(2) DEFAULT NULL,
  `bulan` varchar(2) DEFAULT NULL,
  `tahun` int(4) DEFAULT NULL,
  PRIMARY KEY (`grafik_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=433 ;

--
-- Dumping data untuk tabel `grafik_kecamatan`
--

INSERT INTO `grafik_kecamatan` (`grafik_id`, `KECAMATAN_ID`, `jml_kejadian`, `bulan`, `tahun`) VALUES
(1, 11, 0, '01', 2011),
(2, 2, 1, '01', 2011),
(3, 3, 2, '01', 2011),
(4, 14, 0, '01', 2011),
(5, 4, 1, '01', 2011),
(6, 17, 1, '01', 2011),
(7, 10, 0, '01', 2011),
(8, 12, 0, '01', 2011),
(9, 18, 1, '01', 2011),
(10, 13, 0, '01', 2011),
(11, 7, 1, '01', 2011),
(12, 6, 0, '01', 2011),
(13, 1, 0, '01', 2011),
(14, 9, 0, '01', 2011),
(15, 15, 0, '01', 2011),
(16, 5, 0, '01', 2011),
(17, 8, 0, '01', 2011),
(18, 16, 1, '01', 2011),
(19, 11, 2, '02', 2011),
(20, 2, 0, '02', 2011),
(21, 3, 0, '02', 2011),
(22, 14, 0, '02', 2011),
(23, 4, 0, '02', 2011),
(24, 17, 0, '02', 2011),
(25, 10, 0, '02', 2011),
(26, 12, 0, '02', 2011),
(27, 18, 0, '02', 2011),
(28, 13, 0, '02', 2011),
(29, 7, 0, '02', 2011),
(30, 6, 0, '02', 2011),
(31, 1, 0, '02', 2011),
(32, 9, 0, '02', 2011),
(33, 15, 0, '02', 2011),
(34, 5, 0, '02', 2011),
(35, 8, 0, '02', 2011),
(36, 16, 0, '02', 2011),
(37, 11, 2, '03', 2011),
(38, 2, 0, '03', 2011),
(39, 3, 1, '03', 2011),
(40, 14, 0, '03', 2011),
(41, 4, 0, '03', 2011),
(42, 17, 1, '03', 2011),
(43, 10, 1, '03', 2011),
(44, 12, 1, '03', 2011),
(45, 18, 0, '03', 2011),
(46, 13, 0, '03', 2011),
(47, 7, 0, '03', 2011),
(48, 6, 0, '03', 2011),
(49, 1, 0, '03', 2011),
(50, 9, 0, '03', 2011),
(51, 15, 0, '03', 2011),
(52, 5, 0, '03', 2011),
(53, 8, 0, '03', 2011),
(54, 16, 0, '03', 2011),
(55, 11, 0, '04', 2011),
(56, 2, 0, '04', 2011),
(57, 3, 0, '04', 2011),
(58, 14, 0, '04', 2011),
(59, 4, 0, '04', 2011),
(60, 17, 0, '04', 2011),
(61, 10, 0, '04', 2011),
(62, 12, 0, '04', 2011),
(63, 18, 0, '04', 2011),
(64, 13, 2, '04', 2011),
(65, 7, 2, '04', 2011),
(66, 6, 0, '04', 2011),
(67, 1, 0, '04', 2011),
(68, 9, 0, '04', 2011),
(69, 15, 0, '04', 2011),
(70, 5, 0, '04', 2011),
(71, 8, 0, '04', 2011),
(72, 16, 0, '04', 2011),
(73, 11, 3, '05', 2011),
(74, 2, 1, '05', 2011),
(75, 3, 1, '05', 2011),
(76, 14, 0, '05', 2011),
(77, 4, 0, '05', 2011),
(78, 17, 0, '05', 2011),
(79, 10, 0, '05', 2011),
(80, 12, 0, '05', 2011),
(81, 18, 0, '05', 2011),
(82, 13, 2, '05', 2011),
(83, 7, 0, '05', 2011),
(84, 6, 0, '05', 2011),
(85, 1, 0, '05', 2011),
(86, 9, 0, '05', 2011),
(87, 15, 0, '05', 2011),
(88, 5, 0, '05', 2011),
(89, 8, 0, '05', 2011),
(90, 16, 0, '05', 2011),
(91, 11, 6, '06', 2011),
(92, 2, 3, '06', 2011),
(93, 3, 2, '06', 2011),
(94, 14, 0, '06', 2011),
(95, 4, 0, '06', 2011),
(96, 17, 5, '06', 2011),
(97, 10, 0, '06', 2011),
(98, 12, 2, '06', 2011),
(99, 18, 1, '06', 2011),
(100, 13, 2, '06', 2011),
(101, 7, 2, '06', 2011),
(102, 6, 0, '06', 2011),
(103, 1, 0, '06', 2011),
(104, 9, 0, '06', 2011),
(105, 15, 0, '06', 2011),
(106, 5, 0, '06', 2011),
(107, 8, 0, '06', 2011),
(108, 16, 0, '06', 2011),
(109, 11, 9, '07', 2011),
(110, 2, 2, '07', 2011),
(111, 3, 0, '07', 2011),
(112, 14, 0, '07', 2011),
(113, 4, 2, '07', 2011),
(114, 17, 4, '07', 2011),
(115, 10, 0, '07', 2011),
(116, 12, 1, '07', 2011),
(117, 18, 0, '07', 2011),
(118, 13, 3, '07', 2011),
(119, 7, 0, '07', 2011),
(120, 6, 0, '07', 2011),
(121, 1, 0, '07', 2011),
(122, 9, 0, '07', 2011),
(123, 15, 0, '07', 2011),
(124, 5, 0, '07', 2011),
(125, 8, 0, '07', 2011),
(126, 16, 1, '07', 2011),
(127, 11, 12, '08', 2011),
(128, 2, 4, '08', 2011),
(129, 3, 2, '08', 2011),
(130, 14, 0, '08', 2011),
(131, 4, 2, '08', 2011),
(132, 17, 6, '08', 2011),
(133, 10, 1, '08', 2011),
(134, 12, 2, '08', 2011),
(135, 18, 1, '08', 2011),
(136, 13, 3, '08', 2011),
(137, 7, 3, '08', 2011),
(138, 6, 0, '08', 2011),
(139, 1, 0, '08', 2011),
(140, 9, 0, '08', 2011),
(141, 15, 0, '08', 2011),
(142, 5, 0, '08', 2011),
(143, 8, 0, '08', 2011),
(144, 16, 0, '08', 2011),
(145, 11, 15, '09', 2011),
(146, 2, 1, '09', 2011),
(147, 3, 3, '09', 2011),
(148, 14, 0, '09', 2011),
(149, 4, 1, '09', 2011),
(150, 17, 5, '09', 2011),
(151, 10, 0, '09', 2011),
(152, 12, 3, '09', 2011),
(153, 18, 0, '09', 2011),
(154, 13, 2, '09', 2011),
(155, 7, 0, '09', 2011),
(156, 6, 0, '09', 2011),
(157, 1, 0, '09', 2011),
(158, 9, 0, '09', 2011),
(159, 15, 0, '09', 2011),
(160, 5, 0, '09', 2011),
(161, 8, 0, '09', 2011),
(162, 16, 0, '09', 2011),
(163, 11, 7, '10', 2011),
(164, 2, 1, '10', 2011),
(165, 3, 4, '10', 2011),
(166, 14, 1, '10', 2011),
(167, 4, 1, '10', 2011),
(168, 17, 6, '10', 2011),
(169, 10, 0, '10', 2011),
(170, 12, 2, '10', 2011),
(171, 18, 1, '10', 2011),
(172, 13, 5, '10', 2011),
(173, 7, 2, '10', 2011),
(174, 6, 0, '10', 2011),
(175, 1, 1, '10', 2011),
(176, 9, 0, '10', 2011),
(177, 15, 0, '10', 2011),
(178, 5, 0, '10', 2011),
(179, 8, 0, '10', 2011),
(180, 16, 0, '10', 2011),
(181, 11, 1, '11', 2011),
(182, 2, 1, '11', 2011),
(183, 3, 1, '11', 2011),
(184, 14, 0, '11', 2011),
(185, 4, 2, '11', 2011),
(186, 17, 1, '11', 2011),
(187, 10, 0, '11', 2011),
(188, 12, 0, '11', 2011),
(189, 18, 0, '11', 2011),
(190, 13, 0, '11', 2011),
(191, 7, 0, '11', 2011),
(192, 6, 0, '11', 2011),
(193, 1, 0, '11', 2011),
(194, 9, 0, '11', 2011),
(195, 15, 0, '11', 2011),
(196, 5, 0, '11', 2011),
(197, 8, 0, '11', 2011),
(198, 16, 0, '11', 2011),
(199, 11, 2, '12', 2011),
(200, 2, 1, '12', 2011),
(201, 3, 0, '12', 2011),
(202, 14, 0, '12', 2011),
(203, 4, 2, '12', 2011),
(204, 17, 0, '12', 2011),
(205, 10, 0, '12', 2011),
(206, 12, 0, '12', 2011),
(207, 18, 0, '12', 2011),
(208, 13, 2, '12', 2011),
(209, 7, 0, '12', 2011),
(210, 6, 0, '12', 2011),
(211, 1, 0, '12', 2011),
(212, 9, 0, '12', 2011),
(213, 15, 0, '12', 2011),
(214, 5, 0, '12', 2011),
(215, 8, 0, '12', 2011),
(216, 16, 0, '12', 2011),
(217, 11, 0, '01', 2012),
(218, 2, 0, '01', 2012),
(219, 3, 1, '01', 2012),
(220, 14, 0, '01', 2012),
(221, 4, 0, '01', 2012),
(222, 17, 0, '01', 2012),
(223, 10, 0, '01', 2012),
(224, 12, 0, '01', 2012),
(225, 18, 1, '01', 2012),
(226, 13, 1, '01', 2012),
(227, 7, 0, '01', 2012),
(228, 6, 0, '01', 2012),
(229, 1, 0, '01', 2012),
(230, 9, 0, '01', 2012),
(231, 15, 0, '01', 2012),
(232, 5, 0, '01', 2012),
(233, 8, 0, '01', 2012),
(234, 16, 0, '01', 2012),
(235, 11, 1, '02', 2012),
(236, 2, 1, '02', 2012),
(237, 3, 0, '02', 2012),
(238, 14, 0, '02', 2012),
(239, 4, 0, '02', 2012),
(240, 17, 0, '02', 2012),
(241, 10, 1, '02', 2012),
(242, 12, 0, '02', 2012),
(243, 18, 0, '02', 2012),
(244, 13, 1, '02', 2012),
(245, 7, 0, '02', 2012),
(246, 6, 0, '02', 2012),
(247, 1, 0, '02', 2012),
(248, 9, 0, '02', 2012),
(249, 15, 0, '02', 2012),
(250, 5, 0, '02', 2012),
(251, 8, 0, '02', 2012),
(252, 16, 0, '02', 2012),
(253, 11, 2, '03', 2012),
(254, 2, 0, '03', 2012),
(255, 3, 0, '03', 2012),
(256, 14, 0, '03', 2012),
(257, 4, 0, '03', 2012),
(258, 17, 3, '03', 2012),
(259, 10, 0, '03', 2012),
(260, 12, 0, '03', 2012),
(261, 18, 0, '03', 2012),
(262, 13, 0, '03', 2012),
(263, 7, 2, '03', 2012),
(264, 6, 0, '03', 2012),
(265, 1, 0, '03', 2012),
(266, 9, 0, '03', 2012),
(267, 15, 0, '03', 2012),
(268, 5, 0, '03', 2012),
(269, 8, 0, '03', 2012),
(270, 16, 0, '03', 2012),
(271, 11, 2, '04', 2012),
(272, 2, 0, '04', 2012),
(273, 3, 3, '04', 2012),
(274, 14, 0, '04', 2012),
(275, 4, 1, '04', 2012),
(276, 17, 3, '04', 2012),
(277, 10, 0, '04', 2012),
(278, 12, 0, '04', 2012),
(279, 18, 0, '04', 2012),
(280, 13, 0, '04', 2012),
(281, 7, 0, '04', 2012),
(282, 6, 0, '04', 2012),
(283, 1, 0, '04', 2012),
(284, 9, 0, '04', 2012),
(285, 15, 0, '04', 2012),
(286, 5, 0, '04', 2012),
(287, 8, 0, '04', 2012),
(288, 16, 0, '04', 2012),
(289, 11, 0, '05', 2012),
(290, 2, 2, '05', 2012),
(291, 3, 0, '05', 2012),
(292, 14, 0, '05', 2012),
(293, 4, 0, '05', 2012),
(294, 17, 0, '05', 2012),
(295, 10, 0, '05', 2012),
(296, 12, 0, '05', 2012),
(297, 18, 0, '05', 2012),
(298, 13, 1, '05', 2012),
(299, 7, 0, '05', 2012),
(300, 6, 0, '05', 2012),
(301, 1, 0, '05', 2012),
(302, 9, 1, '05', 2012),
(303, 15, 0, '05', 2012),
(304, 5, 0, '05', 2012),
(305, 8, 0, '05', 2012),
(306, 16, 0, '05', 2012),
(307, 11, 1, '06', 2012),
(308, 2, 0, '06', 2012),
(309, 3, 1, '06', 2012),
(310, 14, 1, '06', 2012),
(311, 4, 2, '06', 2012),
(312, 17, 1, '06', 2012),
(313, 10, 0, '06', 2012),
(314, 12, 1, '06', 2012),
(315, 18, 0, '06', 2012),
(316, 13, 1, '06', 2012),
(317, 7, 1, '06', 2012),
(318, 6, 0, '06', 2012),
(319, 1, 1, '06', 2012),
(320, 9, 0, '06', 2012),
(321, 15, 0, '06', 2012),
(322, 5, 0, '06', 2012),
(323, 8, 0, '06', 2012),
(324, 16, 1, '06', 2012),
(325, 11, 7, '07', 2012),
(326, 2, 1, '07', 2012),
(327, 3, 2, '07', 2012),
(328, 14, 0, '07', 2012),
(329, 4, 0, '07', 2012),
(330, 17, 2, '07', 2012),
(331, 10, 0, '07', 2012),
(332, 12, 0, '07', 2012),
(333, 18, 0, '07', 2012),
(334, 13, 3, '07', 2012),
(335, 7, 3, '07', 2012),
(336, 6, 1, '07', 2012),
(337, 1, 0, '07', 2012),
(338, 9, 0, '07', 2012),
(339, 15, 0, '07', 2012),
(340, 5, 0, '07', 2012),
(341, 8, 0, '07', 2012),
(342, 16, 0, '07', 2012),
(343, 11, 10, '08', 2012),
(344, 2, 3, '08', 2012),
(345, 3, 2, '08', 2012),
(346, 14, 0, '08', 2012),
(347, 4, 2, '08', 2012),
(348, 17, 7, '08', 2012),
(349, 10, 0, '08', 2012),
(350, 12, 1, '08', 2012),
(351, 18, 0, '08', 2012),
(352, 13, 1, '08', 2012),
(353, 7, 0, '08', 2012),
(354, 6, 0, '08', 2012),
(355, 1, 0, '08', 2012),
(356, 9, 0, '08', 2012),
(357, 15, 1, '08', 2012),
(358, 5, 0, '08', 2012),
(359, 8, 1, '08', 2012),
(360, 16, 0, '08', 2012),
(361, 11, 13, '09', 2012),
(362, 2, 6, '09', 2012),
(363, 3, 3, '09', 2012),
(364, 14, 0, '09', 2012),
(365, 4, 0, '09', 2012),
(366, 17, 4, '09', 2012),
(367, 10, 2, '09', 2012),
(368, 12, 1, '09', 2012),
(369, 18, 0, '09', 2012),
(370, 13, 4, '09', 2012),
(371, 7, 1, '09', 2012),
(372, 6, 0, '09', 2012),
(373, 1, 0, '09', 2012),
(374, 9, 0, '09', 2012),
(375, 15, 0, '09', 2012),
(376, 5, 1, '09', 2012),
(377, 8, 1, '09', 2012),
(378, 16, 2, '09', 2012),
(379, 11, 9, '10', 2012),
(380, 2, 0, '10', 2012),
(381, 3, 0, '10', 2012),
(382, 14, 1, '10', 2012),
(383, 4, 0, '10', 2012),
(384, 17, 4, '10', 2012),
(385, 10, 0, '10', 2012),
(386, 12, 0, '10', 2012),
(387, 18, 0, '10', 2012),
(388, 13, 1, '10', 2012),
(389, 7, 3, '10', 2012),
(390, 6, 0, '10', 2012),
(391, 1, 1, '10', 2012),
(392, 9, 0, '10', 2012),
(393, 15, 0, '10', 2012),
(394, 5, 0, '10', 2012),
(395, 8, 1, '10', 2012),
(396, 16, 3, '10', 2012),
(397, 11, 4, '11', 2012),
(398, 2, 2, '11', 2012),
(399, 3, 2, '11', 2012),
(400, 14, 1, '11', 2012),
(401, 4, 3, '11', 2012),
(402, 17, 2, '11', 2012),
(403, 10, 1, '11', 2012),
(404, 12, 0, '11', 2012),
(405, 18, 0, '11', 2012),
(406, 13, 1, '11', 2012),
(407, 7, 1, '11', 2012),
(408, 6, 0, '11', 2012),
(409, 1, 0, '11', 2012),
(410, 9, 0, '11', 2012),
(411, 15, 0, '11', 2012),
(412, 5, 0, '11', 2012),
(413, 8, 1, '11', 2012),
(414, 16, 1, '11', 2012),
(415, 11, 0, '12', 2012),
(416, 2, 1, '12', 2012),
(417, 3, 0, '12', 2012),
(418, 14, 0, '12', 2012),
(419, 4, 0, '12', 2012),
(420, 17, 4, '12', 2012),
(421, 10, 0, '12', 2012),
(422, 12, 0, '12', 2012),
(423, 18, 0, '12', 2012),
(424, 13, 1, '12', 2012),
(425, 7, 0, '12', 2012),
(426, 6, 1, '12', 2012),
(427, 1, 0, '12', 2012),
(428, 9, 0, '12', 2012),
(429, 15, 0, '12', 2012),
(430, 5, 0, '12', 2012),
(431, 8, 1, '12', 2012),
(432, 16, 0, '12', 2012);

-- --------------------------------------------------------

--
-- Struktur dari tabel `jabatan`
--

CREATE TABLE IF NOT EXISTS `jabatan` (
  `jabatan_id` int(2) NOT NULL AUTO_INCREMENT,
  `jabatan_nama` varchar(50) NOT NULL,
  PRIMARY KEY (`jabatan_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Dumping data untuk tabel `jabatan`
--

INSERT INTO `jabatan` (`jabatan_id`, `jabatan_nama`) VALUES
(1, 'Kepala Bidang PMK'),
(2, 'Kepala Seksi Oprasional'),
(3, 'Kepala Seksi Sarana'),
(4, 'Staff Administrasi'),
(5, 'Komandan Pleton'),
(6, 'Komandan Regu'),
(7, 'Operator'),
(8, 'Anggota'),
(9, 'Staff Administrasi Umum (Petugas PP APK)'),
(10, 'Staff Administrasi Umum (BPP)'),
(11, 'Staff Administrasi Umum (Mekanik)'),
(12, 'Staff Administrasi Umum (Administrasi)');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kecamatan`
--

CREATE TABLE IF NOT EXISTS `kecamatan` (
  `KECAMATAN_ID` int(2) NOT NULL AUTO_INCREMENT,
  `KECAMATAN_NAMA` varchar(50) NOT NULL,
  `KECAMATAN_DIR` varchar(255) NOT NULL,
  PRIMARY KEY (`KECAMATAN_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=19 ;

--
-- Dumping data untuk tabel `kecamatan`
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
-- Struktur dari tabel `level_user`
--

CREATE TABLE IF NOT EXISTS `level_user` (
  `ID_LEVEL_USER` int(11) NOT NULL AUTO_INCREMENT,
  `NAMA_LEVEL_USER` varchar(40) NOT NULL,
  PRIMARY KEY (`ID_LEVEL_USER`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data untuk tabel `level_user`
--

INSERT INTO `level_user` (`ID_LEVEL_USER`, `NAMA_LEVEL_USER`) VALUES
(1, 'Admin (Staff Administrasi)'),
(2, 'Kepala Bidang'),
(3, 'Kepala Seksi Oprasional');

-- --------------------------------------------------------

--
-- Struktur dari tabel `log_user`
--

CREATE TABLE IF NOT EXISTS `log_user` (
  `log_id` int(11) NOT NULL AUTO_INCREMENT,
  `pegawai_nip` int(20) NOT NULL,
  `login_date` datetime NOT NULL,
  `logout_date` datetime NOT NULL,
  `log_ket` varchar(200) NOT NULL,
  PRIMARY KEY (`log_id`),
  KEY `FK_pegawai` (`pegawai_nip`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data untuk tabel `log_user`
--

INSERT INTO `log_user` (`log_id`, `pegawai_nip`, `login_date`, `logout_date`, `log_ket`) VALUES
(1, 115623001, '2014-10-30 11:22:07', '2014-10-30 11:28:14', '-'),
(2, 115623003, '2014-11-03 19:33:35', '2014-11-03 20:46:44', '-'),
(3, 115623212, '2014-11-05 09:36:09', '2014-11-05 09:54:07', '-'),
(4, 115623333, '2014-11-05 23:46:23', '2014-11-05 09:35:57', '-');

-- --------------------------------------------------------

--
-- Struktur dari tabel `master_bangunan`
--

CREATE TABLE IF NOT EXISTS `master_bangunan` (
  `ID_MASTER` int(11) NOT NULL AUTO_INCREMENT,
  `NAMA_MASTER` varchar(50) NOT NULL,
  PRIMARY KEY (`ID_MASTER`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data untuk tabel `master_bangunan`
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
-- Struktur dari tabel `pasca`
--

CREATE TABLE IF NOT EXISTS `pasca` (
  `pasca_id` int(11) NOT NULL AUTO_INCREMENT,
  `resiko_id` int(11) NOT NULL,
  `pasca_lama_perjalanan` time NOT NULL,
  `pasca_penyelesaian` time NOT NULL,
  `penyebab_id` int(11) NOT NULL,
  `ID_BANGUNAN_BARU` int(11) NOT NULL,
  `pasca_luas` varchar(20) NOT NULL,
  `pasca_luka` varchar(20) NOT NULL,
  `pasca_meninggal` varchar(20) NOT NULL,
  `pasca_biaya` int(20) NOT NULL,
  PRIMARY KEY (`pasca_id`),
  KEY `FK_resiko` (`resiko_id`),
  KEY `FK_penyebab` (`penyebab_id`),
  KEY `FK_bangunan` (`ID_BANGUNAN_BARU`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=118 ;

--
-- Dumping data untuk tabel `pasca`
--

INSERT INTO `pasca` (`pasca_id`, `resiko_id`, `pasca_lama_perjalanan`, `pasca_penyelesaian`, `penyebab_id`, `ID_BANGUNAN_BARU`, `pasca_luas`, `pasca_luka`, `pasca_meninggal`, `pasca_biaya`) VALUES
(1, 115, '00:20:00', '00:15:00', 4, 0, '30', '2', '0', 500000),
(3, 55, '00:48:00', '00:45:00', 5, 7, '3000.00', '2', '0', 5000000),
(4, 56, '00:15:00', '00:25:00', 2, 0, '4500', '0', '0', 3000000),
(5, 54, '00:16:00', '02:00:00', 3, 0, '3500', '0', '0', 50000000),
(6, 3, '00:49:00', '01:00:00', 4, 0, '3500', '0', '0', 500000),
(7, 4, '00:38:00', '00:30:00', 4, 0, '2000', '0', '0', 0),
(8, 5, '00:34:00', '00:30:00', 4, 0, '3920', '0', '0', 0),
(9, 6, '00:27:00', '00:30:00', 4, 0, '3870', '0', '0', 500000),
(10, 8, '00:33:00', '02:00:00', 3, 0, '7000', '0', '0', 2000000),
(11, 7, '00:31:00', '01:00:00', 4, 0, '1500', '0', '0', 500000),
(12, 9, '00:50:00', '01:38:00', 3, 0, '3400', '0', '0', 1500000),
(13, 10, '00:47:00', '01:00:00', 3, 0, '84', '0', '0', 50000),
(14, 11, '00:47:00', '01:00:00', 4, 0, '1000', '0', '0', 400000),
(15, 12, '00:53:00', '01:00:00', 4, 0, '900', '0', '0', 300000),
(16, 13, '00:53:00', '01:10:00', 4, 0, '1950', '0', '0', 250000),
(17, 14, '00:48:00', '01:00:00', 1, 0, '1000', '0', '0', 300000),
(18, 15, '00:45:00', '00:30:00', 1, 0, '450', '0', '0', 200000),
(19, 16, '00:57:00', '01:00:00', 5, 0, '250', '0', '0', 2000000),
(20, 17, '00:55:00', '01:00:00', 5, 0, '1500', '0', '0', 400000),
(21, 18, '00:50:00', '01:00:00', 4, 0, '800', '0', '0', 400000),
(22, 19, '00:48:00', '02:00:00', 5, 0, '3000', '0', '0', 1000000),
(23, 20, '00:46:00', '01:00:00', 5, 0, '3850', '0', '0', 200000),
(24, 21, '01:03:00', '01:58:00', 2, 0, '300', '0', '0', 500000),
(25, 22, '01:00:00', '01:00:00', 5, 0, '6000', '0', '0', 1000000),
(26, 23, '00:59:00', '02:00:00', 1, 0, '800', '0', '0', 2000000),
(27, 24, '00:51:00', '01:00:00', 3, 0, '70', '0', '0', 500000),
(28, 25, '01:04:00', '02:00:00', 5, 0, '1500', '0', '0', 1500000),
(29, 26, '00:43:00', '01:30:00', 3, 0, '60', '0', '0', 2000000),
(30, 27, '00:40:00', '02:00:00', 2, 0, '90', '0', '0', 2000000),
(31, 28, '00:54:00', '02:00:00', 4, 0, '6400', '0', '0', 1000000),
(32, 29, '00:40:00', '01:00:00', 5, 0, '5000', '0', '0', 2500000),
(33, 30, '00:42:00', '01:00:00', 4, 0, '3500', '0', '0', 1000000),
(34, 31, '00:24:00', '01:00:00', 3, 7, '100.00', '0', '0', 5000000),
(35, 32, '00:17:00', '01:00:00', 1, 0, '99', '0', '0', 2000000),
(36, 33, '00:34:00', '01:00:00', 4, 0, '4250', '0', '0', 500000),
(37, 34, '00:32:00', '01:00:00', 4, 0, '4000', '0', '0', 1500000),
(38, 35, '00:24:00', '02:30:00', 2, 0, '5200', '0', '0', 4500000),
(39, 35, '00:19:00', '02:00:00', 2, 0, '5200', '0', '0', 5000000),
(40, 36, '00:26:00', '01:00:00', 3, 0, '5400', '0', '0', 2500000),
(41, 37, '00:44:00', '02:00:00', 3, 0, '10000', '0', '0', 50000000),
(42, 38, '00:51:00', '01:00:00', 1, 0, '3200', '0', '0', 4000000),
(43, 39, '00:40:00', '01:20:00', 2, 0, '72', '0', '0', 3000000),
(44, 40, '00:40:00', '01:00:00', 2, 0, '30', '0', '0', 2000000),
(45, 41, '00:47:00', '01:00:00', 3, 0, '54', '0', '0', 1000000),
(46, 42, '00:36:00', '01:00:00', 1, 0, '99', '0', '0', 3000000),
(47, 43, '00:45:00', '02:00:00', 5, 0, '5400', '0', '0', 1500000),
(48, 44, '00:50:00', '02:00:00', 4, 0, '3200', '0', '0', 1000000),
(49, 45, '00:44:00', '01:00:00', 4, 0, '3500', '0', '0', 500000),
(50, 46, '01:05:00', '02:00:00', 5, 0, '5000', '0', '0', 2000000),
(51, 47, '00:12:00', '01:00:00', 4, 0, '4800', '0', '0', 0),
(52, 48, '00:49:00', '01:00:00', 4, 0, '3850', '0', '0', 250000),
(53, 49, '00:50:00', '02:00:00', 1, 0, '3000', '0', '0', 1000000),
(54, 50, '00:31:00', '01:01:00', 1, 0, '4500', '0', '0', 200000),
(55, 51, '00:29:00', '01:00:00', 4, 0, '2700', '0', '0', 300000),
(56, 52, '00:21:00', '01:00:00', 5, 0, '3200', '0', '0', 200000),
(57, 53, '00:21:00', '01:00:00', 4, 0, '1500', '0', '0', 2000000),
(58, 57, '00:22:00', '02:00:00', 1, 0, '3600', '0', '0', 40000000),
(59, 58, '00:19:00', '02:00:00', 3, 0, '1500', '0', '0', 30000000),
(60, 59, '00:27:00', '01:00:00', 3, 0, '4800', '0', '0', 9000000),
(61, 60, '00:24:00', '02:00:00', 5, 0, '1800', '0', '0', 4000000),
(62, 61, '00:26:00', '01:30:00', 1, 0, '200', '0', '0', 10000000),
(63, 62, '00:38:00', '01:00:00', 3, 0, '150', '0', '0', 4000000),
(64, 63, '00:40:00', '01:00:00', 2, 0, '300', '0', '0', 5000000),
(65, 64, '00:22:00', '01:30:00', 3, 0, '80', '0', '0', 2000000),
(66, 65, '00:18:00', '01:00:00', 1, 0, '48', '0', '0', 20000000),
(67, 66, '00:35:00', '01:00:00', 2, 0, '54', '0', '0', 1500000),
(68, 67, '00:18:00', '01:00:00', 3, 0, '40', '0', '0', 3000000),
(69, 68, '00:21:00', '01:00:00', 2, 0, '60', '0', '0', 1000000),
(70, 69, '00:19:00', '01:00:00', 1, 0, '48', '0', '0', 20000000),
(71, 70, '00:17:00', '01:00:00', 2, 0, '63', '0', '0', 2000000),
(72, 71, '00:28:00', '02:00:00', 5, 0, '4200', '0', '0', 2000000),
(73, 72, '00:26:00', '02:00:00', 4, 0, '3300', '0', '0', 1000000),
(74, 73, '01:02:00', '02:00:00', 1, 0, '600', '0', '0', 40000000),
(75, 74, '01:29:00', '02:30:00', 1, 0, '7000', '0', '0', 30000000),
(76, 75, '01:36:00', '02:30:00', 4, 0, '5600', '0', '0', 3000000),
(77, 76, '01:14:00', '02:00:00', 1, 0, '1750', '0', '0', 500000),
(78, 77, '01:00:00', '01:00:00', 1, 0, '4560', '0', '0', 2000000),
(79, 78, '01:22:00', '02:30:00', 4, 0, '7000', '0', '0', 3000000),
(80, 79, '00:40:00', '01:00:00', 1, 0, '1000', '0', '0', 1500000),
(81, 80, '00:47:00', '01:30:00', 4, 0, '3500', '0', '0', 250000),
(82, 81, '00:34:00', '01:00:00', 1, 0, '4550', '0', '0', 1000000),
(83, 82, '01:02:00', '02:00:00', 1, 0, '4200', '0', '0', 30000000),
(84, 83, '01:00:00', '02:00:00', 2, 0, '63', '0', '0', 30000000),
(85, 84, '01:08:00', '02:00:00', 2, 0, '40', '0', '0', 40000000),
(86, 85, '00:30:00', '01:00:00', 1, 0, '2800', '0', '0', 10000000),
(87, 86, '00:38:00', '02:00:00', 3, 0, '1500', '0', '0', 40000000),
(88, 87, '00:35:00', '01:00:00', 3, 0, '450', '0', '0', 9000000),
(89, 88, '00:32:00', '01:00:00', 1, 0, '84', '0', '0', 1000000),
(90, 89, '00:50:00', '01:00:00', 3, 0, '40', '0', '0', 2000000),
(91, 90, '00:36:00', '01:00:00', 2, 0, '35', '0', '0', 20000000),
(92, 91, '00:36:00', '02:00:00', 5, 0, '4875', '0', '0', 30000000),
(93, 92, '00:42:00', '02:00:00', 1, 0, '1500', '0', '0', 500000),
(94, 93, '00:59:00', '02:00:00', 3, 0, '2250', '0', '0', 20000000),
(95, 94, '00:57:00', '02:00:00', 1, 0, '90', '0', '0', 20000000),
(96, 95, '00:45:00', '02:00:00', 1, 0, '300', '0', '0', 10000000),
(97, 96, '00:34:00', '02:00:00', 2, 0, '63', '0', '0', 30000000),
(98, 97, '00:52:00', '02:00:00', 1, 0, '56', '0', '0', 20000000),
(99, 98, '00:55:00', '01:00:00', 1, 0, '70', '0', '0', 1000000),
(100, 99, '00:42:00', '01:00:00', 3, 0, '40', '0', '0', 15000000),
(101, 100, '00:52:00', '02:00:00', 4, 0, '1250', '0', '0', 1500000),
(102, 101, '00:25:00', '02:00:00', 1, 0, '2500', '0', '0', 35000000),
(103, 102, '00:53:00', '02:00:00', 4, 0, '2800', '0', '0', 10000000),
(104, 103, '00:37:00', '02:00:00', 1, 0, '3500', '0', '0', 10000000),
(105, 104, '00:43:00', '02:00:00', 1, 0, '1500', '0', '0', 30000000),
(106, 105, '00:51:00', '02:00:00', 5, 7, '1010.00', '0', '0', 40000000),
(107, 106, '00:48:00', '02:00:00', 1, 0, '90', '0', '0', 2000000),
(108, 107, '00:55:00', '02:00:00', 2, 0, '56', '0', '0', 3000000),
(109, 108, '00:44:00', '02:00:00', 4, 0, '3500', '0', '0', 10000000),
(110, 109, '00:42:00', '02:00:00', 4, 0, '4500', '0', '0', 2000000),
(111, 110, '00:41:00', '02:00:00', 3, 0, '2700', '0', '0', 30500000),
(112, 111, '00:45:00', '02:00:00', 1, 0, '2800', '0', '0', 25000000),
(113, 112, '00:50:00', '02:00:00', 2, 0, '2400', '0', '0', 34000000),
(114, 113, '00:52:00', '02:00:00', 3, 0, '800', '0', '0', 3000000),
(115, 114, '00:45:00', '02:00:00', 1, 0, '450', '0', '0', 10000000),
(116, 1, '00:57:00', '02:00:00', 3, 0, '3000', '0', '0', 40500000),
(117, 2, '00:55:00', '02:00:00', 1, 0, '50', '0', '0', 20000000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pegawai`
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
-- Dumping data untuk tabel `pegawai`
--

INSERT INTO `pegawai` (`pegawai_nip`, `id_level_user`, `pegawai_nama`, `pegawai_tempat`, `pegawai_tanggal`, `pegawai_kelamin`, `pegawai_alamat`, `pegawai_no_telp`, `jabatan_id`, `pegawai_email`, `pegawai_password`, `pegawai_foto`) VALUES
(115623001, 2, 'Achmad Fatoni', 'Surabaya', '1992-01-01', 'Laki-laki', 'Surabaya', '085733964366', 1, 'fatoni@gmail.com', 'e807f1fcf82d132f9bb018ca6738a19f', '120814-Achmad-Fatoni.jpg'),
(115623003, 1, 'Andriyan Dwi P', 'Sidoarjo', '2014-04-30', 'Laki-laki', 'Sidoarjo', '242112321421', 4, 'andriyan.115623003@gmail.com', '21232f297a57a5a743894a0e4a801fc3', 'Downfall342.jpg'),
(115623212, 3, 'Muhammad Rudi', 'Jombang', '1992-02-28', 'Laki-laki', 'Ds. Ploso Jombang', '082134222233', 2, 'rudi_westlife@gmail.com', 'bfcd3eee9746714ca4fcba684344bbc0', '211014-rudi.jpg'),
(115623333, 1, 'SHOLIKHUDDIN', 'Surabaya', '1992-05-29', 'Laki-laki', 'Surabaya', '085733964366', 4, 'abang_kuning@yahoo.co.id', '21232f297a57a5a743894a0e4a801fc3', '311014-editan_PP.jpg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengiriman_air`
--

CREATE TABLE IF NOT EXISTS `pengiriman_air` (
  `ID_PENGIRIMAN` int(11) NOT NULL AUTO_INCREMENT,
  `literMenit` int(5) NOT NULL,
  `galonMenit` int(5) NOT NULL,
  PRIMARY KEY (`ID_PENGIRIMAN`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data untuk tabel `pengiriman_air`
--

INSERT INTO `pengiriman_air` (`ID_PENGIRIMAN`, `literMenit`, `galonMenit`) VALUES
(1, 946, 250),
(2, 1893, 500),
(3, 2839, 750),
(4, 3785, 1000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `penyebab`
--

CREATE TABLE IF NOT EXISTS `penyebab` (
  `penyebab_id` int(11) NOT NULL AUTO_INCREMENT,
  `penyebab_nama` varchar(50) NOT NULL,
  PRIMARY KEY (`penyebab_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data untuk tabel `penyebab`
--

INSERT INTO `penyebab` (`penyebab_id`, `penyebab_nama`) VALUES
(1, 'Bahan Bakar Minyak'),
(2, 'Kompor Gas / LPG'),
(3, 'Listrik'),
(4, 'Rokok'),
(5, 'Lain-lain');

-- --------------------------------------------------------

--
-- Struktur dari tabel `penyebab_lain`
--

CREATE TABLE IF NOT EXISTS `penyebab_lain` (
  `lain_ID` int(11) NOT NULL AUTO_INCREMENT,
  `pasca_id` int(11) NOT NULL,
  `penyebab_id` int(11) NOT NULL,
  `lain_tgl` datetime NOT NULL,
  `lain_nama` varchar(50) NOT NULL,
  PRIMARY KEY (`lain_ID`),
  KEY `FK_penyebab` (`penyebab_id`),
  KEY `FK_pasca` (`pasca_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

--
-- Dumping data untuk tabel `penyebab_lain`
--

INSERT INTO `penyebab_lain` (`lain_ID`, `pasca_id`, `penyebab_id`, `lain_tgl`, `lain_nama`) VALUES
(1, 3, 5, '2014-10-27 02:00:00', 'wew'),
(2, 19, 5, '2013-07-05 16:03:16', 'Kembang Api'),
(3, 20, 5, '2013-08-22 16:05:58', 'Pembakaran Sampah'),
(4, 22, 5, '2013-09-28 16:12:16', 'Pembakaran Sampah'),
(5, 23, 5, '2013-12-24 16:14:41', 'Pembakaran Sampah'),
(6, 25, 5, '2013-10-15 16:20:16', 'Pembakaran Sampah Daun'),
(7, 28, 5, '2013-12-20 16:31:12', 'Pembakaran sampah kertas'),
(8, 32, 5, '2013-09-25 08:30:10', 'Pembakaran Sampah'),
(9, 47, 5, '2013-09-07 09:15:30', 'Pembakaran Sampah'),
(10, 50, 5, '2013-10-03 10:15:48', 'Pembakaran Sampah'),
(11, 56, 5, '2013-11-17 10:34:14', 'Pembakaran Daun Kering'),
(12, 61, 5, '2013-09-07 10:56:21', 'Human Error'),
(13, 72, 5, '2013-11-15 12:12:41', 'Pembakaran daun kering'),
(14, 92, 5, '2013-11-27 13:14:30', 'Human Error'),
(15, 106, 5, '2013-07-27 15:49:52', 'Human error');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pesan`
--

CREATE TABLE IF NOT EXISTS `pesan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pesan_id` varchar(20) NOT NULL,
  `resiko_id` int(11) NOT NULL,
  `pesan_tgl_masuk` datetime NOT NULL,
  `pesan_tgl_keluar` datetime NOT NULL,
  `pesan_nama` varchar(100) NOT NULL,
  `pesan_jml` int(20) NOT NULL,
  `pesan_isi` text NOT NULL,
  `pesan_status` int(11) NOT NULL,
  `pegawai_nip` int(20) NOT NULL,
  `pesan_dari` int(11) NOT NULL,
  `pesan_untuk` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_resiko` (`resiko_id`),
  KEY `FK_pegawai` (`pegawai_nip`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=20 ;

--
-- Dumping data untuk tabel `pesan`
--

INSERT INTO `pesan` (`id`, `pesan_id`, `resiko_id`, `pesan_tgl_masuk`, `pesan_tgl_keluar`, `pesan_nama`, `pesan_jml`, `pesan_isi`, `pesan_status`, `pegawai_nip`, `pesan_dari`, `pesan_untuk`) VALUES
(1, 'SK-102114-19', 55, '2013-01-19 10:42:12', '0000-00-00 00:00:00', 'APAR', 2, 'Karena kebakaran terlalu menyulitkan dengan terpaksa, sembari menunggu mobil tangki pemadam. Kami menggunakan APAR', 0, 115623003, 4, 2),
(2, 'SK-102114-19', 55, '2013-01-19 10:42:12', '0000-00-00 00:00:00', 'APAR', 2, 'Karena kebakaran terlalu menyulitkan dengan terpaksa, sembari menunggu mobil tangki pemadam. Kami menggunakan APAR', 0, 115623003, 4, 4),
(3, 'SK-102114-19', 55, '2013-01-19 10:42:12', '0000-00-00 00:00:00', 'APAR', 2, 'WEW', 0, 115623003, 4, 4),
(4, 'SK-102114-19', 55, '2013-01-19 10:42:12', '0000-00-00 00:00:00', 'APAR', 2, 'wew', 0, 115623003, 4, 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `resiko`
--

CREATE TABLE IF NOT EXISTS `resiko` (
  `resiko_id` int(11) NOT NULL AUTO_INCREMENT,
  `resiko_tanggal_start` datetime NOT NULL,
  `resiko_tanggal_end` datetime NOT NULL,
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
  `resiko_status` enum('no','yes') NOT NULL,
  PRIMARY KEY (`resiko_id`),
  KEY `FK_kecamatan` (`KECAMATAN_ID`),
  KEY `FK_bangunan` (`ID_BANGUNAN`),
  KEY `FK_desa` (`DESA_ID`),
  KEY `FK_sumber_air` (`ID_SUMBER`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=117 ;

--
-- Dumping data untuk tabel `resiko`
--

INSERT INTO `resiko` (`resiko_id`, `resiko_tanggal_start`, `resiko_tanggal_end`, `nama_pelapor`, `nomor_telp`, `alamat_pelapor`, `ID_BANGUNAN`, `DESA_ID`, `KECAMATAN_ID`, `ID_SUMBER`, `exposure`, `tepol`, `panjang`, `lebar`, `tinggi`, `pasokan_air_minimum`, `penerapan_air`, `pengangkutan_air`, `tipe_proteksi`, `resiko_status`) VALUES
(1, '2014-09-26 09:03:06', '2014-09-26 11:04:12', 'Putri Lestari', '085645339345', 'Jalan Gedangan No. 19', 31, 204, 11, 8, 'Tanpa resiko bangunan berdekatan.', '<b>Tidak</b> Menggunakan Tepol', '100.00', '30.00', '4.00', '104468', '8357', '28', 'MPKP', 'yes'),
(2, '2014-09-26 10:00:28', '2014-09-26 12:05:43', 'Achmad', '089863476123', 'Sumorame', 83, 271, 14, 12, 'Tanpa resiko bangunan berdekatan.', '<b>Tidak</b> Menggunakan Tepol', '10.00', '5.00', '5.00', '1207', '169', '28', 'MPKP', 'yes'),
(3, '2013-08-06 14:11:34', '2013-08-06 15:11:34', 'Wahyu Indah', '8918476', 'Jalan Kampung Masjid No 20 RT 07 RW 01', 44, 342, 18, 6, 'Tanpa resiko bangunan berdekatan.', '<b>Tidak</b> Menggunakan Tepol', '50.00', '70.00', '2.00', '52808', '5281', '29', 'MPKL', 'yes'),
(4, '2013-08-23 14:22:02', '2013-08-23 14:52:02', 'Dika Lestari', '0811089011', 'Jalan Setiabudi No 16 RT 02 RW 04', 44, 333, 18, 6, 'Tanpa resiko bangunan berdekatan.', '<b>Tidak</b> Menggunakan Tepol', '50.00', '40.00', '2.00', '30078', '3008', '25', 'MPKL', 'yes'),
(5, '2013-09-26 14:26:52', '2013-09-26 14:56:52', 'Sundari', '8853456', 'Jalan Mastrip No. 20 RT 01 RW 09', 44, 339, 18, 6, 'Tanpa resiko bangunan berdekatan.', '<b>Tidak</b> Menggunakan Tepol', '80.00', '49.00', '1.00', '25309', '2536', '26', 'MPKL', 'yes'),
(6, '2013-10-19 14:33:57', '2013-10-19 15:03:57', 'Sukardi Sutono', '8090765', 'Jalan Sentana No. 300 RT 02 RW 05', 44, 336, 18, 6, 'Tanpa resiko bangunan berdekatan.', '<b>Tidak</b> Menggunakan Tepol', '86.00', '45.00', '2.00', '58430', '5843', '24', 'MPKL', 'yes'),
(7, '2013-01-26 15:29:43', '2013-01-26 16:29:43', 'Linduaji', '88445578', 'Jalan Makmur No.24 RT 05 RW 09', 60, 231, 13, 4, 'Tanpa resiko bangunan berdekatan.', '<b>Tidak</b> Menggunakan Tepol', '50.00', '30.00', '3.00', '40180', '3214', '25', 'MPKP', 'yes'),
(8, '2013-06-16 15:32:28', '2013-06-05 17:32:28', 'Hendro', '71123456', 'Jalan Bromo No.44 RT 07 RW 01', 62, 236, 13, 4, 'Tanpa resiko bangunan berdekatan.', '<b>Tidak</b> Menggunakan Tepol', '100.00', '70.00', '5.00', '150880', '24141', '24', 'MPKBG', 'yes'),
(9, '2013-08-12 15:35:38', '2013-08-12 17:02:38', 'Sari Nurul', '0887685477', 'Jalan Wetan No.55 RT 08 RW 03', 1, 240, 13, 16, 'Tanpa resiko bangunan berdekatan.', '<b>Tidak</b> Menggunakan Tepol', '68.00', '50.00', '4.00', '158479', '9509', '23', 'MPKP', 'yes'),
(10, '2013-08-26 15:38:40', '2013-08-26 16:38:40', 'Yudha', '8955674', 'Jalan kamboja NO. 17 RT 03 RW 06', 90, 244, 13, 4, 'Tanpa resiko bangunan berdekatan.', '<b>Tidak</b> Menggunakan Tepol', '12.00', '7.00', '4.00', '1666', '236', '24', 'MPKP', 'yes'),
(11, '2013-09-05 15:49:38', '2013-11-05 16:49:38', 'Totok', '8675344', 'Jalan Harum N.13 RT 05 RW 01', 44, 240, 13, 16, 'Tanpa resiko bangunan berdekatan.', '<b>Tidak</b> Menggunakan Tepol', '40.00', '25.00', '1.00', '6445', '645', '28', 'MPKL', 'yes'),
(12, '2013-09-26 15:52:09', '2013-09-26 16:52:33', 'Aliyah', '0856389048', 'Jalan Slamet No.89 Rt 07 RW 01', 44, 251, 13, 4, 'Tanpa resiko bangunan berdekatan.', '<b>Tidak</b> Menggunakan Tepol', '45.00', '20.00', '1.00', '5861', '584', '29', 'MPKL', 'yes'),
(13, '2013-11-16 15:54:27', '2013-11-16 17:04:10', 'Sutardji', '71123456', 'Jalan Madurasa NO.98 RT 01 RW 01', 44, 246, 13, 16, 'Tanpa resiko bangunan berdekatan.', '<b>Tidak</b> Menggunakan Tepol', '65.00', '30.00', '1.00', '12524', '1255', '29', 'MPKL', 'yes'),
(14, '2013-01-26 15:57:55', '2013-01-26 16:57:55', 'Akbar Santoso', '08923785094', 'JAlan Pinang Indah NO.17 RT 03 RW 01', 34, 119, 7, 1, 'Tanpa resiko bangunan berdekatan.', '<b>Tidak</b> Menggunakan Tepol', '50.00', '20.00', '4.00', '21107', '2814', '28', 'MPKP', 'yes'),
(15, '2013-04-20 16:00:45', '2013-04-20 16:30:34', 'Lazuardy', '7317089', 'Jalan Kebon Jeruk No.150 RT 05 RW 11', 89, 127, 7, 15, 'Tanpa resiko bangunan berdekatan.', '<b>Tidak</b> Menggunakan Tepol', '30.00', '15.00', '4.00', '6689', '1255', '31', 'MPKP', 'yes'),
(16, '2013-07-05 16:03:16', '2013-07-05 17:03:40', 'Kemal', '0813429098', 'Jalan Mekar NO.123 RT 09 RW 01', 71, 112, 7, 1, 'Tanpa resiko bangunan berdekatan.', '<b>Tidak</b> Menggunakan Tepol', '25.00', '10.00', '3.00', '6765', '541', '29', 'MPKP', 'yes'),
(17, '2013-08-22 16:05:58', '2013-08-22 17:05:56', 'Widya', '8999308', 'Jalan Sentosa NO.33 RT 07 RW 02', 44, 130, 7, 15, 'Tanpa resiko bangunan berdekatan.', '<b>Tidak</b> Menggunakan Tepol', '50.00', '30.00', '1.00', '9643', '964', '31', 'MPKL', 'yes'),
(18, '2013-09-26 16:10:17', '2013-09-26 17:11:39', 'Fajrin', '0811089011', 'Jalan Kemuning NO. 19 RT 08 RW 07', 44, 127, 7, 1, 'Tanpa resiko bangunan berdekatan.', '<b>Tidak</b> Menggunakan Tepol', '40.00', '20.00', '1.00', '5188', '519', '25', 'MPKL', 'yes'),
(19, '2013-09-28 16:12:16', '2013-09-28 18:13:35', 'Aslim', '8918476', 'Jalan Sugih Waras NO 300 RT 08 RW 01', 44, 119, 7, 15, 'Tanpa resiko bangunan berdekatan.', '<b>Tidak</b> Menggunakan Tepol', '60.00', '50.00', '2.00', '45231', '4523', '26', 'MPKL', 'yes'),
(20, '2013-12-24 16:14:41', '2013-12-24 17:15:12', 'Zaeni', '7384758', 'Jalan Urip No.33 RT 08 RW 01', 44, 114, 7, 15, 'Tanpa resiko bangunan berdekatan.', '<b>Tidak</b> Menggunakan Tepol', '70.00', '55.00', '1.00', '24840', '2479', '28', 'MPKL', 'yes'),
(21, '2013-05-26 16:17:49', '2013-05-26 18:25:17', 'Yunita Risky', '0813429098', 'Jalan Ampelsari No.39 RT 02 RW 04', 6, 105, 6, 11, 'Tanpa resiko bangunan berdekatan.', '<b>Tidak</b> Menggunakan Tepol', '30.00', '10.00', '3.00', '16170', '650', '28', 'MPKP', 'yes'),
(22, '2013-10-15 16:20:16', '2013-10-15 17:20:23', 'Widhayanti', '7223980', 'Jalan Makmur No..23 RT 07 RW 03', 44, 97, 6, 19, 'Tanpa resiko bangunan berdekatan.', '<b>Tidak</b> Menggunakan Tepol', '100.00', '60.00', '1.00', '38770', '3877', '26', 'MPKL', 'yes'),
(23, '2013-05-24 16:26:05', '2013-05-24 18:26:03', 'Laksmana Eka', '0887685477', 'Jalan Banjar No.44 RT 08 RW 01', 64, 78, 5, 2, 'Tanpa resiko bangunan berdekatan.', '<b>Tidak</b> Menggunakan Tepol', '40.00', '20.00', '4.00', '18733', '2248', '28', 'MPKP', 'yes'),
(24, '2013-10-24 16:29:04', '2013-10-24 17:29:16', 'Johan Adi', '0813429098', 'Jalan Kebayoran No.80 RT 06 RW 01', 84, 80, 5, 10, 'Tanpa resiko bangunan berdekatan.', '<b>Tidak</b> Menggunakan Tepol', '10.00', '7.00', '3.00', '1084', '152', '28', 'MPKP', 'yes'),
(25, '2013-12-20 16:31:12', '2013-12-20 18:31:42', 'Julita', '7223980', 'Jalan Sumber No.14 RT 08 RW 09', 44, 83, 5, 11, 'Tanpa resiko bangunan berdekatan.', '<b>Tidak</b> Menggunakan Tepol', '50.00', '30.00', '1.00', '9643', '964', '29', 'MPKL', 'yes'),
(26, '2013-02-27 08:17:54', '2013-02-27 09:47:04', 'Fitri Kartika', '0811089011', 'Jalan Mundu No.13 RT 01 RW 08', 84, 148, 8, 9, 'Tanpa resiko bangunan berdekatan.', '<b>Tidak</b> Menggunakan Tepol', '10.00', '6.00', '3.00', '1414', '132', '31', 'MPKP', 'yes'),
(27, '2013-07-12 08:20:52', '2013-07-12 10:21:57', 'Andriyan', '0887685477', 'Jalan Semeru No.300 RT 01 RW 07', 84, 149, 8, 9, 'Dengan resiko bangunan berdekatan.', '<b>Tidak</b> Menggunakan Tepol', '10.00', '9.00', '4.00', '2758', '257', '30', 'MPKP', 'yes'),
(28, '2013-09-09 08:26:16', '2013-09-09 10:26:30', 'Muhammad', '7231098', 'Jalan Komplek NO.20 RT 01 RW 01', 44, 147, 8, 9, 'Tanpa resiko bangunan berdekatan.', '<b>Tidak</b> Menggunakan Tepol', '80.00', '80.00', '1.00', '41186', '4127', '29', 'MPKL', 'yes'),
(29, '2013-09-25 08:30:10', '2013-09-25 09:30:45', 'Rahmad Hidayat', '8933445', 'Jalan Asem NO.14 RT 02 RW 08', 44, 140, 8, 11, 'Dengan resiko bangunan berdekatan.', '<b>Tidak</b> Menggunakan Tepol', '100.00', '50.00', '1.00', '48413', '3228', '30', 'MPKL', 'yes'),
(30, '2013-11-28 08:33:37', '2013-11-28 09:33:49', 'Guntur', '7022345', 'Jalan Merdeka NO.17 RT 01 RW 02', 44, 142, 8, 9, 'Tanpa resiko bangunan berdekatan.', '<b>Tidak</b> Menggunakan Tepol', '70.00', '50.00', '1.00', '22632', '2258', '31', 'MPKL', 'yes'),
(31, '2013-01-27 08:36:41', '2013-01-27 09:37:17', 'Jihan Fahira', '08653748278', 'Jalan Berkah No.400 RT 01 RW 05', 84, 312, 16, 13, 'Dengan resiko bangunan berdekatan.', '<b>Tidak</b> Menggunakan Tepol', '8.00', '6.00', '3.00', '1671', '104', '26', 'MPKP', 'yes'),
(32, '2013-07-27 08:43:01', '2013-07-27 09:43:56', 'Joseph Santoso', '7317089', 'Jalan Ksatria No.300 RT 01 RW 02', 83, 306, 16, 19, 'Dengan resiko bangunan berdekatan.', '<b>Tidak</b> Menggunakan Tepol', '11.00', '9.00', '4.00', '4513', '281', '26', 'MPKP', 'yes'),
(33, '2013-09-19 08:46:00', '2013-09-19 09:46:17', 'Winda Meliani', '08395874930', 'Jalan Urip Sumoharjo No.29 RT 01 RW 05', 44, 313, 16, 13, 'Tanpa resiko bangunan berdekatan.', '<b>Tidak</b> Menggunakan Tepol', '85.00', '50.00', '1.00', '27454', '2745', '31', 'MPKL', 'yes'),
(34, '2013-11-22 08:48:24', '2013-11-22 09:48:43', 'Rizki Rahmad', '8955674', 'Jalan Harapan No.89 RT 01 RW 07', 44, 301, 16, 13, 'Tanpa resiko bangunan berdekatan.', '<b>Tidak</b> Menggunakan Tepol', '100.00', '40.00', '1.00', '25781', '2578', '29', 'MPKL', 'yes'),
(35, '2013-01-27 08:51:35', '2013-01-27 11:21:49', 'Wulansuci', '8853456', 'Jalan Santri No.58 RT 01 RW 05', 77, 189, 11, 8, 'Dengan resiko bangunan berdekatan.', '<b>Menggunkan</b> Tepol (Cairan Basa)', '80.00', '65.00', '4.00', '181370', '14537', '30', 'MPKBG', 'yes'),
(36, '2013-02-21 08:54:02', '2013-02-21 09:54:59', 'Azizah', '7022345', 'Jalan Indah NO.78 RT 01 RW 09', 62, 196, 11, 8, 'Dengan resiko bangunan berdekatan.', '<b>Tidak</b> Menggunakan Tepol', '90.00', '60.00', '4.00', '141655', '15136', '28', 'MPKBG', 'yes'),
(37, '2013-03-10 08:56:42', '2013-03-10 10:56:37', 'Rania', '8999308', 'Jalan Raden Patah No.38 RT 01 RW 03', 49, 207, 11, 43, 'Dengan resiko bangunan berdekatan.', '<b>Menggunkan</b> Tepol (Cairan Basa)', '100.00', '100.00', '5.00', '258202', '34427', '30', 'MPKBG', 'yes'),
(38, '2013-03-27 08:59:56', '2013-03-27 09:59:50', 'Jojon', '8090765', 'Jalan Hidup No.12 RT 01 RW 07', 28, 194, 11, 8, 'Tanpa resiko bangunan berdekatan.', '<b>Tidak</b> Menggunakan Tepol', '80.00', '40.00', '5.00', '205932', '11004', '26', 'MPKP', 'yes'),
(39, '2013-08-07 09:05:43', '2013-08-07 10:26:27', 'Fitarina', '8090765', 'Jalan Kembang Sepatu No.290 RT 01 RW 02', 37, 192, 11, 8, 'Dengan resiko bangunan berdekatan.', '<b>Tidak</b> Menggunakan Tepol', '9.00', '8.00', '5.00', '5616', '245', '25', 'MPKP', 'yes'),
(40, '2013-08-17 09:08:11', '2013-08-17 10:08:44', 'Septiadi', '7317089', 'Jalan Sono No.45 Rt 01 RW 03', 67, 193, 11, 8, 'Dengan resiko bangunan berdekatan.', '<b>Tidak</b> Menggunakan Tepol', '6.00', '5.00', '3.00', '800', '62', '29', 'MPKP', 'yes'),
(41, '2013-08-20 09:10:52', '2013-08-20 10:20:16', 'Azzahra', '0813429098', 'Jalan A Yani No.32 RT 05 RW 01', 53, 198, 11, 8, 'Tanpa resiko bangunan berdekatan.', '<b>Tidak</b> Menggunakan Tepol', '9.00', '6.00', '3.00', '1800', '118', '31', 'MPKP', 'yes'),
(42, '2013-08-24 09:13:18', '2013-08-24 10:13:56', 'Stefanie', '08123857999', 'Jalan Kota No.66 Rt 01 RW 04', 84, 190, 11, 8, 'Dengan resiko bangunan berdekatan.', '<b>Tidak</b> Menggunakan Tepol', '11.00', '9.00', '5.00', '2777', '346', '23', 'MPKP', 'yes'),
(43, '2013-09-07 09:15:30', '2013-09-07 11:20:09', 'Putri', '08123857999', 'Jalan Indah No.50 Rt 06 RW 01', 44, 189, 11, 8, 'Tanpa resiko bangunan berdekatan.', '<b>Tidak</b> Menggunakan Tepol', '90.00', '60.00', '1.00', '34869', '3493', '31', 'MPKL', 'yes'),
(44, '2013-09-11 10:10:04', '2013-09-11 12:10:31', 'Sukarno', '0813429098', 'Jalan Surabaya NO.20 RT 01 RW 08', 44, 189, 11, 8, 'Tanpa resiko bangunan berdekatan.', '<b>Tidak</b> Menggunakan Tepol', '80.00', '40.00', '1.00', '20593', '2063', '28', 'MPKL', 'yes'),
(45, '2013-09-17 10:12:40', '2013-09-17 11:12:51', 'Kartono', '71123456', 'Jalan Semanggi NO.55 RT 01 RW 07', 44, 199, 11, 43, 'Tanpa resiko bangunan berdekatan.', '<b>Tidak</b> Menggunakan Tepol', '70.00', '50.00', '1.00', '22632', '2258', '26', 'MPKL', 'yes'),
(46, '2013-10-03 10:15:48', '2013-10-03 12:23:04', 'Rahmadi', '7384758', 'Jalan Sempu NO.400 RT 01 Rw 07', 44, 197, 11, 8, 'Tanpa resiko bangunan berdekatan.', '<b>Tidak</b> Menggunakan Tepol', '100.00', '50.00', '1.00', '32275', '3228', '31', 'MPKL', 'yes'),
(47, '2013-10-09 10:18:59', '2013-10-09 11:24:28', 'Indah', '8955674', 'Jalan Ratu Ayu No. 90 RT 07 RW 09', 44, 204, 11, 8, 'Tanpa resiko bangunan berdekatan.', '<b>Tidak</b> Menggunakan Tepol', '80.00', '60.00', '1.00', '30968', '3103', '31', 'MPKL', 'yes'),
(48, '2013-10-11 10:21:55', '2013-10-11 11:26:00', 'Zulfa', '7022345', 'Jalan Kamboja No.13 RT 09 RW 06', 44, 202, 11, 8, 'Tanpa resiko bangunan berdekatan.', '<b>Tidak</b> Menggunakan Tepol', '70.00', '55.00', '2.00', '57960', '5783', '31', 'MPKL', 'yes'),
(49, '2013-10-18 10:25:06', '2013-10-18 12:27:05', 'Maimunah', '0811089011', 'Jalan Sentosa No.300 RT 01 RW 01', 44, 196, 11, 8, 'Tanpa resiko bangunan berdekatan.', '<b>Tidak</b> Menggunakan Tepol', '100.00', '30.00', '1.00', '19286', '1929', '28', 'MPKL', 'yes'),
(50, '2013-10-23 10:29:05', '2013-10-23 11:30:23', 'Ekwien', '0856389048', 'Jalan Sederhana NO.45 RT 01 Rw 03', 44, 200, 11, 8, 'Tanpa resiko bangunan berdekatan.', '<b>Tidak</b> Menggunakan Tepol', '90.00', '50.00', '1.00', '29028', '2908', '31', 'MPKL', 'yes'),
(51, '2013-10-27 10:31:26', '2013-10-27 11:32:39', 'Rumanah', '71123456', 'Jalan Urip Sumoharjo NO.39 RT 08 RW 03', 44, 193, 11, 8, 'Tanpa resiko bangunan berdekatan.', '<b>Tidak</b> Menggunakan Tepol', '60.00', '45.00', '1.00', '17494', '1749', '29', 'MPKL', 'yes'),
(52, '2013-11-17 10:34:14', '2013-11-17 11:34:15', 'Dwi Ayu', '8933445', 'Jalan Kencana No.300 RT 01 RW 02', 44, 190, 11, 8, 'Tanpa resiko bangunan berdekatan.', '<b>Tidak</b> Menggunakan Tepol', '80.00', '40.00', '1.00', '20593', '2063', '31', 'MPKL', 'yes'),
(53, '2013-11-25 10:36:12', '2013-11-25 11:45:29', 'Ratna', '7022345', 'Jalan Sentosa NO.39 RT 01 RW 05', 44, 198, 11, 8, 'Tanpa resiko bangunan berdekatan.', '<b>Tidak</b> Menggunakan Tepol', '50.00', '30.00', '1.00', '9643', '964', '29', 'MPKL', 'yes'),
(54, '2013-01-01 10:39:04', '2013-01-05 12:39:04', 'Robby', '0811089011', 'Jalan Kauman NO.200 RT 08 RW 01', 30, 23, 2, 7, 'Dengan resiko bangunan berdekatan.', '<b>Tidak</b> Menggunakan Tepol', '70.00', '50.00', '4.00', '275828', '9786', '26', 'MPKP', 'yes'),
(55, '2013-01-19 10:42:12', '2013-01-19 11:27:12', 'Iswatun', '7231098', 'Jalan Arjuno No.30 RT 01 RW 02', 60, 26, 2, 8, 'Tanpa resiko bangunan berdekatan.', '<b>Tidak</b> Menggunakan Tepol', '70.00', '40.00', '4.00', '97923', '7817', '31', 'MPKP', 'yes'),
(56, '2013-01-26 10:45:22', '2013-01-26 11:05:22', 'Suhartik', '08123857999', 'Jalan Pahlawan NO. 39 RT 01 RW 03', 6, 31, 2, 7, 'Tanpa resiko bangunan berdekatan.', '<b>Tidak</b> Menggunakan Tepol', '90.00', '50.00', '5.00', '258027', '15508', '31', 'MPKP', 'yes'),
(57, '2013-05-11 10:48:21', '2013-05-11 12:49:50', 'Roni', '8918476', 'Jalan Maju JAya NO.29 RT 03 RW 01', 36, 24, 2, 8, 'Dengan resiko bangunan berdekatan.', '<b>Tidak</b> Menggunakan Tepol', '90.00', '40.00', '5.00', '139122', '12387', '31', 'MPKP', 'yes'),
(58, '2013-05-20 10:51:16', '2013-05-20 12:52:56', 'Totok', '7231098', 'Jalan Randu Agung NO.100 RT 01 RW 02', 31, 28, 2, 7, 'Tanpa resiko bangunan berdekatan.', '<b>Tidak</b> Menggunakan Tepol', '50.00', '30.00', '5.00', '64288', '5143', '28', 'MPKP', 'yes'),
(59, '2013-08-27 10:53:56', '2013-08-27 11:53:17', 'Julita', '0811089011', 'Jalan Sigura-gura NO.39 RT 02 RW 01', 56, 22, 2, 8, 'Tanpa resiko bangunan berdekatan.', '<b>Tidak</b> Menggunakan Tepol', '80.00', '60.00', '4.00', '167746', '13445', '31', 'MPKP', 'yes'),
(60, '2013-09-07 10:56:21', '2013-09-07 12:57:48', 'Sari', '7317089', 'Jalan HArum NO.400 RT 01 RW 02', 1, 27, 2, 7, 'Tanpa resiko bangunan berdekatan.', '<b>Tidak</b> Menggunakan Tepol', '60.00', '30.00', '4.00', '83659', '5020', '30', 'MPKP', 'yes'),
(61, '2013-09-24 10:59:26', '2013-09-24 12:29:52', 'Suhardi', '0856389048', 'Jalan Kertajaya NO.20 RT 01 RW 02', 29, 26, 2, 15, 'Tanpa resiko bangunan berdekatan.', '<b>Tidak</b> Menggunakan Tepol', '20.00', '10.00', '5.00', '8712', '692', '31', 'MPKP', 'yes'),
(62, '2013-09-27 11:02:16', '2013-09-27 12:17:06', 'Maliq', '8933445', 'JAlan Sumoharjo NO 400 RT 01 RW 09', 95, 35, 2, 15, 'Tanpa resiko bangunan berdekatan.', '<b>Tidak</b> Menggunakan Tepol', '15.00', '10.00', '6.00', '4620', '647', '29', 'MPKP', 'yes'),
(63, '2013-10-01 11:04:39', '2013-10-01 12:28:27', 'Sariyah', '0887685477', 'Jalan Kenongo NO.40 RT 01 RW 02', 43, 35, 2, 7, 'Tanpa resiko bangunan berdekatan.', '<b>Tidak</b> Menggunakan Tepol', '20.00', '15.00', '4.00', '6306', '834', '29', 'MPKP', 'yes'),
(64, '2013-10-11 11:48:04', '2013-10-11 12:49:51', 'Wahyuni', '71123456', 'Jalan Makmur NO.20 RT 01 RW 03', 83, 23, 2, 7, 'Dengan resiko bangunan berdekatan.', '<b>Tidak</b> Menggunakan Tepol', '10.00', '8.00', '3.00', '2758', '172', '31', 'MPKP', 'yes'),
(65, '2013-10-13 11:52:18', '2013-10-13 13:05:55', 'Putri', '08123857999', 'Jalan Kartini NO.20 RT 01 RW 02', 84, 23, 2, 8, 'Dengan resiko bangunan berdekatan.', '<b>Tidak</b> Menggunakan Tepol', '8.00', '6.00', '3.00', '1114', '104', '30', 'MPKP', 'yes'),
(66, '2013-10-17 11:55:06', '2013-10-17 13:01:51', 'Siskawati', '7223980', 'Jalan Ijen NO.24 Rt 01 RW 03', 84, 29, 2, 7, 'Dengan resiko bangunan berdekatan.', '<b>Tidak</b> Menggunakan Tepol', '9.00', '6.00', '3.00', '1929', '118', '31', 'MPKP', 'yes'),
(67, '2013-10-19 11:57:20', '2013-10-19 12:58:00', 'Putra', '7022345', 'Jalan Sewu Candi NO.20 RT 01 RW 02', 84, 28, 2, 8, 'Tanpa resiko bangunan berdekatan.', '<b>Tidak</b> Menggunakan Tepol', '8.00', '5.00', '3.00', '891', '83', '30', 'MPKP', 'yes'),
(68, '2013-10-22 11:59:13', '2013-10-22 12:59:18', 'Sulastri', '0813429098', 'JAlan Supratman NO.10 RT 09 RW 01', 84, 24, 2, 7, 'Tanpa resiko bangunan berdekatan.', '<b>Tidak</b> Menggunakan Tepol', '10.00', '6.00', '6.00', '1886', '264', '28', 'MPKP', 'yes'),
(69, '2013-10-25 12:01:22', '2013-10-25 13:17:09', 'Fahmi', '08123857999', 'Jalan Manggis NO.14 RT 07 RW 01', 55, 30, 2, 8, 'Tanpa resiko bangunan berdekatan.', '<b>Tidak</b> Menggunakan Tepol', '8.00', '6.00', '3.00', '1300', '104', '31', 'MPKP', 'yes'),
(70, '2013-10-27 12:03:36', '2013-10-27 13:18:47', 'Karunia', '08123857999', 'Jalan Sawo NO.30 RT 02 RW 06', 84, 28, 2, 7, 'Tanpa resiko bangunan berdekatan.', '<b>Tidak</b> Menggunakan Tepol', '9.00', '7.00', '3.00', '986', '136', '29', 'MPKP', 'yes'),
(71, '2013-11-15 12:12:41', '2013-11-15 14:19:30', 'Rusliawan', '7384758', 'Jalan Jeruk NO.34 RT 01 RW 08', 44, 22, 2, 15, 'Tanpa resiko bangunan berdekatan.', '<b>Tidak</b> Menggunakan Tepol', '70.00', '60.00', '1.00', '27186', '2713', '29', 'MPKL', 'yes'),
(72, '2013-11-26 12:14:50', '2013-11-26 14:20:53', 'Saritoga', '0811089011', 'Jalan Kebomas NO.33 RT 01 Rw 02', 44, 25, 2, 7, 'Tanpa resiko bangunan berdekatan.', '<b>Tidak</b> Menggunakan Tepol', '60.00', '55.00', '1.00', '21276', '2128', '28', 'MPKL', 'yes'),
(73, '2013-01-21 12:18:10', '2013-01-21 14:18:10', 'Suryanto', '7223980', 'Jalan Merbabu NO.89 RT 01 RW 04', 28, 38, 3, 11, 'Dengan resiko bangunan berdekatan.', '<b>Menggunkan</b> Tepol (Cairan Basa)', '40.00', '15.00', '4.00', '23469', '1669', '29', 'MPKP', 'yes'),
(74, '2013-08-17 12:21:59', '2013-08-17 14:53:10', 'Riniwati', '0811089011', 'Jalan Sumo Kali NO.39 RT 01 RW 02', 44, 40, 3, 19, 'Tanpa resiko bangunan berdekatan.', '<b>Tidak</b> Menggunakan Tepol', '100.00', '70.00', '1.00', '45264', '4526', '28', 'MPKL', 'yes'),
(75, '2013-08-29 12:24:12', '2013-08-29 14:55:10', 'Rozaq', '7022345', 'Jalan Kemuning Raya NO.28 RT 01 RW 03', 44, 51, 3, 12, 'Tanpa resiko bangunan berdekatan.', '<b>Tidak</b> Menggunakan Tepol', '80.00', '70.00', '1.00', '36156', '3623', '30', 'MPKL', 'yes'),
(76, '2013-09-03 12:26:34', '2013-09-03 14:30:10', 'Setya Uswatun', '08123857999', 'Jalan Cempaka NO.300 RT 01 RW 03', 44, 44, 3, 18, 'Tanpa resiko bangunan berdekatan.', '<b>Tidak</b> Menggunakan Tepol', '50.00', '35.00', '1.00', '11316', '1132', '24', 'MPKL', 'yes'),
(77, '2013-09-15 12:29:25', '2013-09-15 14:56:46', 'Joko Samudro', '71123456', 'Jalan Rahayu Dalam NO.49 RT 01 RW 02', 44, 52, 3, 19, 'Tanpa resiko bangunan berdekatan.', '<b>Tidak</b> Menggunakan Tepol', '95.00', '48.00', '1.00', '29390', '2934', '28', 'MPKL', 'yes'),
(78, '2013-10-12 12:38:28', '2013-10-05 14:07:44', 'Sumarjo', '0887685477', 'Jalan Setiabudi NO.23 RT 01 Rw 02', 44, 58, 3, 19, 'Tanpa resiko bangunan berdekatan.', '<b>Tidak</b> Menggunakan Tepol', '100.00', '70.00', '1.00', '45264', '4526', '28', 'MPKL', 'yes'),
(79, '2013-10-18 12:40:36', '2013-10-18 13:48:18', 'Srihartini', '7317089', 'Jalan Palem No.30 RT 01 RW 02', 44, 54, 3, 37, 'Tanpa resiko bangunan berdekatan.', '<b>Tidak</b> Menggunakan Tepol', '40.00', '25.00', '1.00', '6445', '645', '28', 'MPKL', 'yes'),
(80, '2013-10-26 12:43:16', '2013-10-26 14:31:04', 'Deni', '0813429098', 'Jalan Slamet NO.34 RT 02 Rw 04', 44, 37, 3, 12, 'Tanpa resiko bangunan berdekatan.', '<b>Tidak</b> Menggunakan Tepol', '70.00', '50.00', '1.00', '22632', '2258', '28', 'MPKL', 'yes'),
(81, '2013-11-13 12:46:03', '2013-11-13 13:46:45', 'Rahmawati', '0813429098', 'Jalan Rukun Warga NO.50 RT 01 RW 04', 44, 46, 3, 12, 'Tanpa resiko bangunan berdekatan.', '<b>Tidak</b> Menggunakan Tepol', '70.00', '65.00', '1.00', '29394', '2933', '28', 'MPKL', 'yes'),
(82, '2013-11-26 12:48:10', '2013-11-26 14:48:21', 'Fajar Budi', '7223980', 'Jalan jambu NO.400 RT 01 Rw 03', 44, 52, 3, 18, 'Tanpa resiko bangunan berdekatan.', '<b>Tidak</b> Menggunakan Tepol', '70.00', '60.00', '1.00', '27186', '2713', '31', 'MPKL', 'yes'),
(83, '2013-06-19 12:55:33', '2013-06-19 14:55:18', 'Rahardjo', '0811089011', 'Jalan Sudimampir No.30 RT 01 Rw 02', 84, 256, 14, 12, 'Dengan resiko bangunan berdekatan.', '<b>Tidak</b> Menggunakan Tepol', '9.00', '7.00', '3.00', '2218', '136', '31', 'MPKP', 'yes'),
(84, '2013-09-04 12:57:55', '2013-09-04 14:57:09', 'Rasita', '7223980', 'Jalan Rekoso No.34 RT 01 RW 08', 53, 267, 14, 19, 'Tanpa resiko bangunan berdekatan.', '<b>Tidak</b> Menggunakan Tepol', '8.00', '5.00', '3.00', '1248', '83', '29', 'MPKP', 'yes'),
(85, '2013-01-21 13:00:34', '2013-01-21 14:09:09', 'Rahmi', '8955674', 'Jalan Kuning Mas NO.34 RT 02 RW 01', 29, 63, 4, 45, 'Dengan resiko bangunan berdekatan.', '<b>Menggunkan</b> Tepol (Cairan Basa)', '70.00', '40.00', '5.00', '135585', '9621', '28', 'MPKBG', 'yes'),
(86, '2013-02-22 13:02:55', '2013-02-22 15:02:51', 'Yanto', '7223980', 'Jalan Kanjeng Jimat', 20, 64, 4, 45, 'Tanpa resiko bangunan berdekatan.', '<b>Tidak</b> Menggunakan Tepol', '50.00', '30.00', '4.00', '78351', '4179', '29', 'MPKP', 'yes'),
(87, '2013-09-19 13:05:47', '2013-09-19 14:13:11', 'Mustika', '0856389048', 'Jalan Sedap Malam NO.35 RT 01 Rw 03', 78, 73, 4, 45, 'Dengan resiko bangunan berdekatan.', '<b>Tidak</b> Menggunakan Tepol', '30.00', '15.00', '3.00', '12005', '965', '29', 'MPKP', 'yes'),
(88, '2013-10-18 13:08:16', '2013-10-18 14:13:55', 'Lilik', '7317089', 'Jalan Sekar BUmi No.33 RT 01 RW 03', 53, 62, 4, 45, 'Tanpa resiko bangunan berdekatan.', '<b>Tidak</b> Menggunakan Tepol', '12.00', '7.00', '3.00', '2691', '182', '31', 'MPKP', 'yes'),
(89, '2013-10-27 13:10:22', '2013-10-27 14:20:43', 'Hartatik', '8918476', 'Jalan Sono NO 55 Rt 02 RW 03', 84, 66, 4, 45, 'Dengan resiko bangunan berdekatan.', '<b>Tidak</b> Menggunakan Tepol', '8.00', '5.00', '3.00', '1337', '83', '29', 'MPKP', 'yes'),
(90, '2013-11-11 13:12:29', '2013-11-11 14:15:22', 'Pujiono', '88445578', 'Jalan Bambu Asri NO.32 RT 01 RW 01', 84, 69, 4, 45, 'Dengan resiko bangunan berdekatan.', '<b>Tidak</b> Menggunakan Tepol', '7.00', '5.00', '3.00', '789', '74', '31', 'MPKP', 'yes'),
(91, '2013-11-27 13:14:30', '2013-11-27 15:14:19', 'Dhani', '71123456', 'Jalan Untung No.26 RT 01 RW 02', 44, 75, 4, 45, 'Tanpa resiko bangunan berdekatan.', '<b>Tidak</b> Menggunakan Tepol', '75.00', '65.00', '1.00', '31439', '3144', '28', 'MPKL', 'yes'),
(92, '2013-01-10 13:38:52', '2013-01-10 15:38:59', 'Dinda', '0813429098', 'Jalan Kartini No.30 RT 01 RW 03', 60, 316, 17, 3, 'Dengan resiko bangunan berdekatan.', '<b>Tidak</b> Menggunakan Tepol', '50.00', '30.00', '4.00', '39176', '4179', '29', 'MPKP', 'yes'),
(93, '2013-02-20 13:41:19', '2013-02-20 15:43:37', 'Salma', '7022345', 'Jalan Jati NO.45 RT 01 RW 02', 49, 320, 17, 4, 'Tanpa resiko bangunan berdekatan.', '<b>Tidak</b> Menggunakan Tepol', '50.00', '45.00', '7.00', '111651', '11165', '29', 'MPKP', 'yes'),
(94, '2013-02-28 13:43:30', '2013-02-28 15:51:15', 'Ningrum', '0856389048', 'Jalan Lembayung NO.20 RT 01 RW 02', 29, 329, 17, 3, 'Tanpa resiko bangunan berdekatan.', '<b>Tidak</b> Menggunakan Tepol', '15.00', '6.00', '4.00', '3185', '255', '31', 'MPKP', 'yes'),
(95, '2013-03-27 13:45:39', '2013-03-27 15:53:28', 'Rendy', '08123857999', 'Jalan Jemursari NO 30 RT 03 Rw 01', 28, 321, 17, 4, 'Tanpa resiko bangunan berdekatan.', '<b>Tidak</b> Menggunakan Tepol', '20.00', '15.00', '5.00', '9702', '1027', '31', 'MPKP', 'yes'),
(96, '2013-08-22 13:56:30', '2013-08-22 15:56:58', 'Fahmia', '0813429098', 'Jalan Asem NO 32 RT 01 RW 02', 83, 330, 17, 4, 'Dengan resiko bangunan berdekatan.', '<b>Tidak</b> Menggunakan Tepol', '9.00', '7.00', '3.00', '2218', '136', '31', 'MPKP', 'yes'),
(97, '2013-09-07 13:58:18', '2013-09-07 15:58:46', 'Galang', '74564738', 'Jalan Jati NO.35 RT 07 RW 02', 53, 331, 17, 4, 'Tanpa resiko bangunan berdekatan.', '<b>Tidak</b> Menggunakan Tepol', '8.00', '7.00', '3.00', '1794', '120', '27', 'MPKP', 'yes'),
(98, '2013-09-18 14:00:22', '2013-09-18 15:00:32', 'Fadli', '08123857999', 'Jalan erdeka NO.45 RT 01 RW 07', 83, 331, 17, 4, 'Dengan resiko bangunan berdekatan.', '<b>Tidak</b> Menggunakan Tepol', '10.00', '7.00', '3.00', '2440', '152', '31', 'MPKP', 'yes'),
(99, '2013-09-25 14:02:05', '2013-09-25 15:07:13', 'Dimas', '7317089', 'Jalan Sawojajar NO.34 RT 01 RW 03', 55, 320, 17, 3, 'Tanpa resiko bangunan berdekatan.', '<b>Tidak</b> Menggunakan Tepol', '8.00', '5.00', '3.00', '693', '83', '31', 'MPKP', 'yes'),
(100, '2013-11-12 14:03:53', '2013-11-12 16:08:28', 'Zahra', '0813429098', 'Jalan Semangka No.23 RT 01 RW 02', 44, 328, 17, 4, 'Tanpa resiko bangunan berdekatan.', '<b>Tidak</b> Menggunakan Tepol', '50.00', '25.00', '1.00', '8069', '807', '29', 'MPKL', 'yes'),
(101, '2013-11-24 14:05:47', '2013-11-24 16:05:22', 'Rona', '8955674', 'Jalan Mujur NO.13 RT 01 RW 02', 44, 323, 17, 3, 'Tanpa resiko bangunan berdekatan.', '<b>Tidak</b> Menggunakan Tepol', '50.00', '50.00', '1.00', '16138', '1614', '27', 'MPKL', 'yes'),
(102, '2013-11-27 14:07:50', '2013-11-27 16:08:04', 'khusnul Khotimah', '8933445', 'Jalan Sepatu NO.30 RT 01 RW 03', 44, 322, 17, 4, 'Tanpa resiko bangunan berdekatan.', '<b>Tidak</b> Menggunakan Tepol', '70.00', '40.00', '1.00', '18078', '1804', '31', 'MPKL', 'yes'),
(103, '2013-02-23 15:43:01', '2013-02-23 17:43:38', 'Ninis', '7022345', 'Jalan Mayjend Sungkono NO.36 RT 02 RW 04', 52, 172, 10, 5, 'Dengan resiko bangunan berdekatan.', '<b>Tidak</b> Menggunakan Tepol', '70.00', '50.00', '5.00', '169740', '12044', '30', 'MPKP', 'yes'),
(104, '2013-04-20 15:47:11', '2013-04-20 17:47:26', 'Prima', '7317089', 'JAlan Sekar NO.30 RT 02 RW 01', 68, 181, 10, 14, 'Dengan resiko bangunan berdekatan.', '<b>Tidak</b> Menggunakan Tepol', '50.00', '30.00', '4.00', '78351', '4179', '31', 'MPKP', 'yes'),
(105, '2013-07-27 15:49:52', '2013-07-27 17:49:59', 'Joseph', '8933445', 'Jalan Boyolali NO.88 RT 02 RW 01', 28, 179, 10, 5, 'Tanpa resiko bangunan berdekatan.', '<b>Tidak</b> Menggunakan Tepol', '50.00', '20.00', '5.00', '43296', '3464', '28', 'MPKP', 'yes'),
(106, '2013-09-20 15:52:04', '2013-09-20 17:52:27', 'Raden Aji', '71123456', 'Jalan Raden Patah NO.300 RT 01 RW 02', 83, 177, 10, 5, 'Dengan resiko bangunan berdekatan.', '<b>Tidak</b> Menggunakan Tepol', '10.00', '9.00', '6.00', '6364', '396', '31', 'MPKP', 'yes'),
(107, '2013-10-17 15:54:07', '2013-10-17 17:54:15', 'Muhklis', '0811089011', 'Jalan Banjar NO.14 RT 01 RW 02', 84, 178, 10, 15, 'Dengan resiko bangunan berdekatan.', '<b>Tidak</b> Menggunakan Tepol', '8.00', '7.00', '4.00', '1666', '155', '29', 'MPKP', 'yes'),
(108, '2013-10-27 15:56:18', '2013-10-27 17:56:59', 'Aura', '7317089', 'Jalan Asri NO.23 RT 08 RW 01', 44, 173, 10, 5, 'Tanpa resiko bangunan berdekatan.', '<b>Tidak</b> Menggunakan Tepol', '70.00', '50.00', '1.00', '22632', '2258', '31', 'MPKL', 'yes'),
(109, '2013-12-19 15:58:17', '2013-12-19 17:58:06', 'Soleh', '0811089011', 'Jalan Semanggi No. 38 RT 01 RW 02', 44, 176, 10, 4, 'Tanpa resiko bangunan berdekatan.', '<b>Tidak</b> Menggunakan Tepol', '90.00', '50.00', '1.00', '29028', '2908', '30', 'MPKL', 'yes'),
(110, '2013-04-27 16:00:34', '2013-04-27 18:06:56', 'Syauqi', '7317089', 'Jalan Jenaka No.30 RT 01 RW 09', 45, 212, 12, 15, 'Dengan resiko bangunan berdekatan.', '<b>Tidak</b> Menggunakan Tepol', '60.00', '45.00', '4.00', '170563', '7581', '28', 'MPKP', 'yes'),
(111, '2013-08-03 16:02:51', '2013-08-03 18:06:04', 'Juwita', '8933445', 'Jalan Pregolan No.88 RT 01 RW 03', 79, 216, 12, 15, 'Dengan resiko bangunan berdekatan.', '<b>Tidak</b> Menggunakan Tepol', '70.00', '40.00', '5.00', '180780', '9621', '30', 'MPKP', 'yes'),
(112, '2013-10-15 16:05:22', '2013-10-15 18:07:13', 'Hanifa', '8918476', 'Jalan Sungkono No.45 RT 01 RW 08', 34, 212, 12, 15, 'Dengan resiko bangunan berdekatan.', '<b>Tidak</b> Menggunakan Tepol', '60.00', '40.00', '5.00', '61937', '8258', '28', 'MPKP', 'yes'),
(113, '2013-10-27 16:08:00', '2013-10-27 18:17:52', 'Sony Tulung', '0856389048', 'Jalan Sukoharjo NO,88 RT 08 RW 07', 63, 218, 12, 15, 'Dengan resiko bangunan berdekatan.', '<b>Menggunkan</b> Tepol (Cairan Basa)', '40.00', '20.00', '5.00', '51876', '2767', '31', 'MPKBG', 'yes'),
(114, '2013-11-24 16:10:29', '2013-11-24 18:10:34', 'Fatimah', '0813429098', 'Jalan Buntu No.45 RT 09 RW 01', 28, 220, 12, 15, 'Tanpa resiko bangunan berdekatan.', '<b>Tidak</b> Menggunakan Tepol', '30.00', '15.00', '4.00', '11705', '1255', '24', 'MPKP', 'yes'),
(115, '2014-10-10 06:20:06', '2014-10-10 06:38:10', 'Subaru', '08123456789', 'Jalan Ketintang 2', 47, 24, 2, 8, 'Dengan resiko bangunan berdekatan.', '<b>Tidak</b> Menggunakan Tepol', '5.00', '6.00', '7.00', '2208', '152', '28', 'MPKP', 'yes');

-- --------------------------------------------------------

--
-- Struktur dari tabel `sumber_air`
--

CREATE TABLE IF NOT EXISTS `sumber_air` (
  `ID_SUMBER` int(11) NOT NULL AUTO_INCREMENT,
  `NAMA_SUMBER` varchar(50) NOT NULL,
  `KET_SUMBER` varchar(100) NOT NULL,
  PRIMARY KEY (`ID_SUMBER`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=46 ;

--
-- Dumping data untuk tabel `sumber_air`
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
-- Struktur dari tabel `sumber_air_desa`
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
-- Dumping data untuk tabel `sumber_air_desa`
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
-- Struktur dari tabel `sumber_air_kecamatan`
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
-- Dumping data untuk tabel `sumber_air_kecamatan`
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
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `bangunan`
--
ALTER TABLE `bangunan`
  ADD CONSTRAINT `bangunan_ibfk_1` FOREIGN KEY (`ID_MASTER`) REFERENCES `master_bangunan` (`ID_MASTER`) ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `desa`
--
ALTER TABLE `desa`
  ADD CONSTRAINT `FK_kecamatan` FOREIGN KEY (`KECAMATAN_ID`) REFERENCES `kecamatan` (`KECAMATAN_ID`);

--
-- Ketidakleluasaan untuk tabel `pegawai`
--
ALTER TABLE `pegawai`
  ADD CONSTRAINT `FK_jabatan` FOREIGN KEY (`jabatan_id`) REFERENCES `jabatan` (`jabatan_id`),
  ADD CONSTRAINT `pegawai_ibfk_1` FOREIGN KEY (`id_level_user`) REFERENCES `level_user` (`ID_LEVEL_USER`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `sumber_air_desa`
--
ALTER TABLE `sumber_air_desa`
  ADD CONSTRAINT `sumber_air_desa_ibfk_1` FOREIGN KEY (`ID_SUMBER`) REFERENCES `sumber_air` (`ID_SUMBER`) ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `sumber_air_kecamatan`
--
ALTER TABLE `sumber_air_kecamatan`
  ADD CONSTRAINT `sumber_air_kecamatan_ibfk_1` FOREIGN KEY (`ID_SUMBER`) REFERENCES `sumber_air` (`ID_SUMBER`) ON UPDATE CASCADE,
  ADD CONSTRAINT `sumber_air_kecamatan_ibfk_2` FOREIGN KEY (`KECAMATAN_ID`) REFERENCES `kecamatan` (`KECAMATAN_ID`) ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
