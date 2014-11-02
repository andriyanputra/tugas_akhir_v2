-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Inang: 127.0.0.1
-- Waktu pembuatan: 02 Nov 2014 pada 20.57
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
  `grafik_id` int(11) NOT NULL AUTO_INCREMENT,
  `grafik_bln` varchar(20) NOT NULL,
  `grafik_thn` varchar(4) NOT NULL,
  `grafik_mpkp` varchar(20) NOT NULL,
  `grafik_mpkl` varchar(20) NOT NULL,
  `grafik_mpkbg` varchar(20) NOT NULL,
  `grafik_luka` varchar(20) NOT NULL,
  `grafik_meninggal` varchar(20) NOT NULL,
  `grafik_bbm` varchar(20) NOT NULL,
  `grafik_kpr` varchar(20) NOT NULL,
  `grafik_lst` varchar(20) NOT NULL,
  `grafik_rk` varchar(20) NOT NULL,
  `grafik_lain` varchar(20) NOT NULL,
  `grafik_perkantoran` varchar(20) NOT NULL,
  `grafik_udj` varchar(20) NOT NULL,
  `grafik_industri` varchar(20) NOT NULL,
  `grafik_kb` varchar(20) NOT NULL,
  `grafik_rmh` varchar(20) NOT NULL,
  `grafik_lahan` varchar(20) NOT NULL,
  PRIMARY KEY (`grafik_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

--
-- Dumping data untuk tabel `grafik`
--

INSERT INTO `grafik` (`grafik_id`, `grafik_bln`, `grafik_thn`, `grafik_mpkp`, `grafik_mpkl`, `grafik_mpkbg`, `grafik_luka`, `grafik_meninggal`, `grafik_bbm`, `grafik_kpr`, `grafik_lst`, `grafik_rk`, `grafik_lain`, `grafik_perkantoran`, `grafik_udj`, `grafik_industri`, `grafik_kb`, `grafik_rmh`, `grafik_lahan`) VALUES
(1, 'Jan', '2013', '9', '0', '1', '', '', '', '', '', '', '', '0', '0', '4', '0', '0', '0'),
(2, 'Feb', '2013', '6', '0', '0', '', '', '', '', '', '', '', '0', '1', '2', '0', '1', '0'),
(3, 'Mar', '2013', '3', '0', '0', '', '', '', '', '', '', '', '0', '0', '0', '2', '0', '0'),
(4, 'Apr', '2013', '3', '0', '0', '', '', '', '', '', '', '', '0', '1', '0', '0', '0', '0'),
(5, 'Mei', '2013', '4', '0', '0', '', '', '', '', '', '', '', '0', '0', '3', '0', '0', '0'),
(6, 'Jun', '2013', '2', '0', '0', '', '', '', '', '', '', '', '0', '0', '1', '0', '0', '0'),
(7, 'Jul', '2013', '4', '0', '0', '', '', '', '', '', '', '', '0', '1', '0', '1', '0', '0'),
(8, 'Agt', '2013', '9', '5', '0', '', '', '', '', '', '', '', '0', '1', '2', '0', '1', '5'),
(9, 'Sep', '2013', '9', '13', '0', '', '', '', '', '', '', '', '0', '2', '1', '0', '3', '12'),
(10, 'Okt', '2013', '13', '12', '1', '', '', '', '', '', '', '', '0', '1', '0', '0', '1', '12'),
(11, 'Nov', '2013', '2', '13', '0', '', '', '', '', '', '', '', '0', '0', '0', '1', '0', '13'),
(12, 'Des', '2013', '0', '3', '0', '', '', '', '', '', '', '', '0', '0', '0', '0', '0', '3'),
(15, 'Okt', '2014', '1', '0', '0', '2', '0', '', '', '', '1', '', '0', '0', '0', '0', '1', '0');

-- --------------------------------------------------------

--
-- Struktur dari tabel `jabatan`
--

CREATE TABLE IF NOT EXISTS `jabatan` (
  `jabatan_id` int(2) NOT NULL AUTO_INCREMENT,
  `jabatan_nama` varchar(30) NOT NULL,
  PRIMARY KEY (`jabatan_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data untuk tabel `jabatan`
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
(1, 'Admin (Staff Administrasi Umum)'),
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
(2, 115623003, '2014-11-02 17:11:17', '2014-11-01 19:58:09', '-'),
(3, 115623212, '2014-11-01 20:03:18', '2014-11-01 20:03:43', '-'),
(4, 115623333, '2014-10-31 21:31:43', '2014-10-31 21:30:56', '-');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data untuk tabel `pasca`
--

INSERT INTO `pasca` (`pasca_id`, `resiko_id`, `pasca_lama_perjalanan`, `pasca_penyelesaian`, `penyebab_id`, `ID_BANGUNAN_BARU`, `pasca_luas`, `pasca_luka`, `pasca_meninggal`, `pasca_biaya`) VALUES
(1, 115, '00:20:00', '00:15:00', 4, 0, '30', '2', '0', 500000),
(3, 55, '00:48:00', '00:45:00', 5, 7, '3000.00', '2', '0', 5000000),
(4, 56, '00:15:00', '00:25:00', 2, 0, '4500', '0', '0', 3000000);

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
(115623333, 1, 'Andriyan D. Putranto', 'Surabaya', '1992-05-29', 'Laki-laki', 'Surabaya', '085733964366', 4, 'abang_kuning@yahoo.co.id', '25631d5374f0ecc91cd7300fa6902d9b', '311014-editan_PP.jpg');

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
  KEY `FK_penyebab` (`penyebab_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data untuk tabel `penyebab_lain`
--

INSERT INTO `penyebab_lain` (`lain_ID`, `pasca_id`, `penyebab_id`, `lain_tgl`, `lain_nama`) VALUES
(3, 3, 5, '2014-10-27 02:00:00', 'wew');

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
(1, '2014-09-26 09:03:06', '2014-09-27 09:03:06', 'Putri Lestari', '085645339345', 'Jalan Gedangan No. 19', 31, 204, 11, 8, 'Tanpa resiko bangunan berdekatan.', '<b>Tidak</b> Menggunakan Tepol', '100.00', '30.00', '4.00', '104468', '8357', '28', 'MPKP', 'no'),
(2, '2014-09-26 10:00:28', '2014-09-26 10:15:00', 'Achmad', '089863476123', 'Sumorame', 83, 271, 14, 12, 'Tanpa resiko bangunan berdekatan.', '<b>Tidak</b> Menggunakan Tepol', '10.00', '5.00', '5.00', '1207', '169', '28', 'MPKP', 'no'),
(3, '2013-08-06 14:11:34', '0000-00-00 00:00:00', 'Wahyu Indah', '8918476', 'Jalan Kampung Masjid No 20 RT 07 RW 01', 44, 342, 18, 6, 'Tanpa resiko bangunan berdekatan.', '<b>Tidak</b> Menggunakan Tepol', '50.00', '70.00', '2.00', '52808', '5281', '29', 'MPKL', 'no'),
(4, '2013-08-23 14:22:02', '0000-00-00 00:00:00', 'Dika Lestari', '0811089011', 'Jalan Setiabudi No 16 RT 02 RW 04', 44, 333, 18, 6, 'Tanpa resiko bangunan berdekatan.', '<b>Tidak</b> Menggunakan Tepol', '50.00', '40.00', '2.00', '30078', '3008', '25', 'MPKL', 'no'),
(5, '2013-09-26 14:26:52', '0000-00-00 00:00:00', 'Sundari', '8853456', 'Jalan Mastrip No. 20 RT 01 RW 09', 44, 339, 18, 6, 'Tanpa resiko bangunan berdekatan.', '<b>Tidak</b> Menggunakan Tepol', '80.00', '49.00', '1.00', '25309', '2536', '26', 'MPKL', 'no'),
(6, '2013-10-19 14:33:57', '0000-00-00 00:00:00', 'Sukardi Sutono', '8090765', 'Jalan Sentana No. 300 RT 02 RW 05', 44, 336, 18, 6, 'Tanpa resiko bangunan berdekatan.', '<b>Tidak</b> Menggunakan Tepol', '86.00', '45.00', '2.00', '58430', '5843', '24', 'MPKL', 'no'),
(7, '2013-01-26 15:29:43', '0000-00-00 00:00:00', 'Linduaji', '88445578', 'Jalan Makmur No.24 RT 05 RW 09', 60, 231, 13, 4, 'Tanpa resiko bangunan berdekatan.', '<b>Tidak</b> Menggunakan Tepol', '50.00', '30.00', '3.00', '40180', '3214', '25', 'MPKP', 'no'),
(8, '2013-06-16 15:32:28', '0000-00-00 00:00:00', 'Hendro', '71123456', 'Jalan Bromo No.44 RT 07 RW 01', 62, 236, 13, 4, 'Tanpa resiko bangunan berdekatan.', '<b>Tidak</b> Menggunakan Tepol', '100.00', '70.00', '5.00', '150880', '24141', '24', 'MPKP', 'no'),
(9, '2013-08-12 15:35:38', '0000-00-00 00:00:00', 'Sari Nurul', '0887685477', 'Jalan Wetan No.55 RT 08 RW 03', 1, 240, 13, 16, 'Tanpa resiko bangunan berdekatan.', '<b>Tidak</b> Menggunakan Tepol', '68.00', '50.00', '4.00', '158479', '9509', '23', 'MPKP', 'no'),
(10, '2013-08-26 15:38:40', '0000-00-00 00:00:00', 'Yudha', '8955674', 'Jalan kamboja NO. 17 RT 03 RW 06', 90, 244, 13, 4, 'Tanpa resiko bangunan berdekatan.', '<b>Tidak</b> Menggunakan Tepol', '12.00', '7.00', '4.00', '1666', '236', '24', 'MPKP', 'no'),
(11, '2013-09-05 15:49:38', '0000-00-00 00:00:00', 'Totok', '8675344', 'Jalan Harum N.13 RT 05 RW 01', 44, 240, 13, 16, 'Tanpa resiko bangunan berdekatan.', '<b>Tidak</b> Menggunakan Tepol', '40.00', '25.00', '1.00', '6445', '645', '28', 'MPKL', 'no'),
(12, '2013-09-26 15:52:09', '0000-00-00 00:00:00', 'Aliyah', '0856389048', 'Jalan Slamet No.89 Rt 07 RW 01', 44, 251, 13, 4, 'Tanpa resiko bangunan berdekatan.', '<b>Tidak</b> Menggunakan Tepol', '45.00', '20.00', '1.00', '5861', '584', '29', 'MPKL', 'no'),
(13, '2013-11-16 15:54:27', '0000-00-00 00:00:00', 'Sutardji', '71123456', 'Jalan Madurasa NO.98 RT 01 RW 01', 44, 246, 13, 16, 'Tanpa resiko bangunan berdekatan.', '<b>Tidak</b> Menggunakan Tepol', '65.00', '30.00', '1.00', '12524', '1255', '29', 'MPKL', 'no'),
(14, '2013-01-26 15:57:55', '0000-00-00 00:00:00', 'Akbar Santoso', '08923785094', 'JAlan Pinang Indah NO.17 RT 03 RW 01', 34, 119, 7, 1, 'Tanpa resiko bangunan berdekatan.', '<b>Tidak</b> Menggunakan Tepol', '50.00', '20.00', '4.00', '21107', '2814', '28', 'MPKP', 'no'),
(15, '2013-04-20 16:00:45', '0000-00-00 00:00:00', 'Lazuardy', '7317089', 'Jalan Kebon Jeruk No.150 RT 05 RW 11', 89, 127, 7, 15, 'Tanpa resiko bangunan berdekatan.', '<b>Tidak</b> Menggunakan Tepol', '30.00', '15.00', '4.00', '6689', '1255', '31', 'MPKP', 'no'),
(16, '2013-07-05 16:03:16', '0000-00-00 00:00:00', 'Kemal', '0813429098', 'Jalan Mekar NO.123 RT 09 RW 01', 71, 112, 7, 1, 'Tanpa resiko bangunan berdekatan.', '<b>Tidak</b> Menggunakan Tepol', '25.00', '10.00', '3.00', '6765', '541', '29', 'MPKP', 'no'),
(17, '2013-08-22 16:05:58', '0000-00-00 00:00:00', 'Widya', '8999308', 'Jalan Sentosa NO.33 RT 07 RW 02', 44, 130, 7, 15, 'Tanpa resiko bangunan berdekatan.', '<b>Tidak</b> Menggunakan Tepol', '50.00', '30.00', '1.00', '9643', '964', '31', 'MPKL', 'no'),
(18, '2013-09-26 16:10:17', '0000-00-00 00:00:00', 'Fajrin', '0811089011', 'Jalan Kemuning NO. 19 RT 08 RW 07', 44, 127, 7, 1, 'Tanpa resiko bangunan berdekatan.', '<b>Tidak</b> Menggunakan Tepol', '40.00', '20.00', '1.00', '5188', '519', '25', 'MPKL', 'no'),
(19, '2013-09-28 16:12:16', '0000-00-00 00:00:00', 'Aslim', '8918476', 'Jalan Sugih Waras NO 300 RT 08 RW 01', 44, 119, 7, 15, 'Tanpa resiko bangunan berdekatan.', '<b>Tidak</b> Menggunakan Tepol', '60.00', '50.00', '2.00', '45231', '4523', '26', 'MPKL', 'no'),
(20, '2013-12-24 16:14:41', '0000-00-00 00:00:00', 'Zaeni', '7384758', 'Jalan Urip No.33 RT 08 RW 01', 44, 114, 7, 15, 'Tanpa resiko bangunan berdekatan.', '<b>Tidak</b> Menggunakan Tepol', '70.00', '55.00', '1.00', '24840', '2479', '28', 'MPKL', 'no'),
(21, '2013-05-26 16:17:49', '0000-00-00 00:00:00', 'Yunita Risky', '0813429098', 'Jalan Ampelsari No.39 RT 02 RW 04', 6, 105, 6, 11, 'Tanpa resiko bangunan berdekatan.', '<b>Tidak</b> Menggunakan Tepol', '30.00', '10.00', '3.00', '16170', '650', '28', 'MPKP', 'no'),
(22, '2013-10-15 16:20:16', '0000-00-00 00:00:00', 'Widhayanti', '7223980', 'Jalan Makmur No..23 RT 07 RW 03', 44, 97, 6, 19, 'Tanpa resiko bangunan berdekatan.', '<b>Tidak</b> Menggunakan Tepol', '100.00', '60.00', '1.00', '38770', '3877', '26', 'MPKL', 'no'),
(23, '2013-05-24 16:26:05', '0000-00-00 00:00:00', 'Laksmana Eka', '0887685477', 'Jalan Banjar No.44 RT 08 RW 01', 64, 78, 5, 2, 'Tanpa resiko bangunan berdekatan.', '<b>Tidak</b> Menggunakan Tepol', '40.00', '20.00', '4.00', '18733', '2248', '28', 'MPKP', 'no'),
(24, '2013-10-24 16:29:04', '0000-00-00 00:00:00', 'Johan Adi', '0813429098', 'Jalan Kebayoran No.80 RT 06 RW 01', 84, 80, 5, 10, 'Tanpa resiko bangunan berdekatan.', '<b>Tidak</b> Menggunakan Tepol', '10.00', '7.00', '3.00', '1084', '152', '28', 'MPKP', 'no'),
(25, '2013-12-20 16:31:12', '0000-00-00 00:00:00', 'Julita', '7223980', 'Jalan Sumber No.14 RT 08 RW 09', 44, 83, 5, 11, 'Tanpa resiko bangunan berdekatan.', '<b>Tidak</b> Menggunakan Tepol', '50.00', '30.00', '1.00', '9643', '964', '29', 'MPKL', 'no'),
(26, '2013-02-27 08:17:54', '0000-00-00 00:00:00', 'Fitri Kartika', '0811089011', 'Jalan Mundu No.13 RT 01 RW 08', 84, 148, 8, 9, 'Tanpa resiko bangunan berdekatan.', '<b>Tidak</b> Menggunakan Tepol', '10.00', '6.00', '3.00', '1414', '132', '31', 'MPKP', 'no'),
(27, '2013-07-12 08:20:52', '0000-00-00 00:00:00', 'Andriyan', '0887685477', 'Jalan Semeru No.300 RT 01 RW 07', 84, 149, 8, 9, 'Dengan resiko bangunan berdekatan.', '<b>Tidak</b> Menggunakan Tepol', '10.00', '9.00', '4.00', '2758', '257', '30', 'MPKP', 'no'),
(28, '2013-09-09 08:26:16', '0000-00-00 00:00:00', 'Muhammad', '7231098', 'Jalan Komplek NO.20 RT 01 RW 01', 44, 147, 8, 9, 'Tanpa resiko bangunan berdekatan.', '<b>Tidak</b> Menggunakan Tepol', '80.00', '80.00', '1.00', '41186', '4127', '29', 'MPKL', 'no'),
(29, '2013-09-25 08:30:10', '0000-00-00 00:00:00', 'Rahmad Hidayat', '8933445', 'Jalan Asem NO.14 RT 02 RW 08', 44, 140, 8, 11, 'Dengan resiko bangunan berdekatan.', '<b>Tidak</b> Menggunakan Tepol', '100.00', '50.00', '1.00', '48413', '3228', '30', 'MPKL', 'no'),
(30, '2013-11-28 08:33:37', '0000-00-00 00:00:00', 'Guntur', '7022345', 'Jalan Merdeka NO.17 RT 01 RW 02', 44, 142, 8, 9, 'Tanpa resiko bangunan berdekatan.', '<b>Tidak</b> Menggunakan Tepol', '70.00', '50.00', '1.00', '22632', '2258', '31', 'MPKL', 'no'),
(31, '2013-01-27 08:36:41', '0000-00-00 00:00:00', 'Jihan Fahira', '08653748278', 'Jalan Berkah No.400 RT 01 RW 05', 84, 312, 16, 13, 'Dengan resiko bangunan berdekatan.', '<b>Tidak</b> Menggunakan Tepol', '8.00', '6.00', '3.00', '1671', '104', '26', 'MPKP', 'no'),
(32, '2013-07-27 08:43:01', '0000-00-00 00:00:00', 'Joseph Santoso', '7317089', 'Jalan Ksatria No.300 RT 01 RW 02', 83, 277, 16, 19, 'Dengan resiko bangunan berdekatan.', '<b>Tidak</b> Menggunakan Tepol', '11.00', '9.00', '4.00', '4513', '281', '26', 'MPKP', 'no'),
(33, '2013-09-19 08:46:00', '0000-00-00 00:00:00', 'Winda Meliani', '08395874930', 'Jalan Urip Sumoharjo No.29 RT 01 RW 05', 44, 313, 16, 13, 'Tanpa resiko bangunan berdekatan.', '<b>Tidak</b> Menggunakan Tepol', '85.00', '50.00', '1.00', '27454', '2745', '31', 'MPKL', 'no'),
(34, '2013-11-22 08:48:24', '0000-00-00 00:00:00', 'Rizki Rahmad', '8955674', 'Jalan Harapan No.89 RT 01 RW 07', 44, 301, 16, 13, 'Tanpa resiko bangunan berdekatan.', '<b>Tidak</b> Menggunakan Tepol', '100.00', '40.00', '1.00', '25781', '2578', '29', 'MPKL', 'no'),
(35, '2013-01-27 08:51:35', '0000-00-00 00:00:00', 'Wulansuci', '8853456', 'Jalan Santri No.58 RT 01 RW 05', 77, 189, 11, 8, 'Dengan resiko bangunan berdekatan.', '<b>Menggunkan</b> Tepol (Cairan Basa)', '80.00', '65.00', '4.00', '181370', '14537', '30', 'MPKP', 'no'),
(36, '2013-02-21 08:54:02', '0000-00-00 00:00:00', 'Azizah', '7022345', 'Jalan Indah NO.78 RT 01 RW 09', 62, 196, 11, 8, 'Dengan resiko bangunan berdekatan.', '<b>Tidak</b> Menggunakan Tepol', '90.00', '60.00', '4.00', '141655', '15136', '28', 'MPKP', 'no'),
(37, '2013-03-10 08:56:42', '0000-00-00 00:00:00', 'Rania', '8999308', 'Jalan Raden Patah No.38 RT 01 RW 03', 49, 207, 11, 43, 'Dengan resiko bangunan berdekatan.', '<b>Menggunkan</b> Tepol (Cairan Basa)', '100.00', '100.00', '5.00', '258202', '34427', '30', 'MPKP', 'no'),
(38, '2013-03-27 08:59:56', '0000-00-00 00:00:00', 'Jojon', '8090765', 'Jalan Hidup No.12 RT 01 RW 07', 28, 194, 11, 8, 'Tanpa resiko bangunan berdekatan.', '<b>Tidak</b> Menggunakan Tepol', '80.00', '40.00', '5.00', '205932', '11004', '26', 'MPKP', 'no'),
(39, '2013-08-07 09:05:43', '0000-00-00 00:00:00', 'Fitarina', '8090765', 'Jalan Kembang Sepatu No.290 RT 01 RW 02', 37, 192, 11, 8, 'Dengan resiko bangunan berdekatan.', '<b>Tidak</b> Menggunakan Tepol', '9.00', '8.00', '5.00', '5616', '245', '25', 'MPKP', 'no'),
(40, '2013-08-17 09:08:11', '0000-00-00 00:00:00', 'Septiadi', '7317089', 'Jalan Sono No.45 Rt 01 RW 03', 67, 193, 11, 8, 'Dengan resiko bangunan berdekatan.', '<b>Tidak</b> Menggunakan Tepol', '6.00', '5.00', '3.00', '800', '62', '29', 'MPKP', 'no'),
(41, '2013-08-20 09:10:52', '0000-00-00 00:00:00', 'Azzahra', '0813429098', 'Jalan A Yani No.32 RT 05 RW 01', 53, 198, 11, 8, 'Tanpa resiko bangunan berdekatan.', '<b>Tidak</b> Menggunakan Tepol', '9.00', '6.00', '3.00', '1800', '118', '31', 'MPKP', 'no'),
(42, '2013-08-24 09:13:18', '0000-00-00 00:00:00', 'Stefanie', '08123857999', 'Jalan Kota No.66 Rt 01 RW 04', 84, 190, 11, 8, 'Dengan resiko bangunan berdekatan.', '<b>Tidak</b> Menggunakan Tepol', '11.00', '9.00', '5.00', '2777', '346', '23', 'MPKP', 'no'),
(43, '2013-09-07 09:15:30', '0000-00-00 00:00:00', 'Putri', '08123857999', 'Jalan Indah No.50 Rt 06 RW 01', 44, 189, 11, 8, 'Tanpa resiko bangunan berdekatan.', '<b>Tidak</b> Menggunakan Tepol', '90.00', '60.00', '1.00', '34869', '3493', '31', 'MPKL', 'no'),
(44, '2013-09-11 10:10:04', '0000-00-00 00:00:00', 'Sukarno', '0813429098', 'Jalan Surabaya NO.20 RT 01 RW 08', 44, 189, 11, 8, 'Tanpa resiko bangunan berdekatan.', '<b>Tidak</b> Menggunakan Tepol', '80.00', '40.00', '1.00', '20593', '2063', '28', 'MPKL', 'no'),
(45, '2013-09-17 10:12:40', '0000-00-00 00:00:00', 'Kartono', '71123456', 'Jalan Semanggi NO.55 RT 01 RW 07', 44, 199, 11, 43, 'Tanpa resiko bangunan berdekatan.', '<b>Tidak</b> Menggunakan Tepol', '70.00', '50.00', '1.00', '22632', '2258', '26', 'MPKL', 'no'),
(46, '2013-10-03 10:15:48', '0000-00-00 00:00:00', 'Rahmadi', '7384758', 'Jalan Sempu NO.400 RT 01 Rw 07', 44, 197, 11, 8, 'Tanpa resiko bangunan berdekatan.', '<b>Tidak</b> Menggunakan Tepol', '100.00', '50.00', '1.00', '32275', '3228', '31', 'MPKL', 'no'),
(47, '2013-10-09 10:18:59', '0000-00-00 00:00:00', 'Indah', '8955674', 'Jalan Ratu Ayu No. 90 RT 07 RW 09', 44, 204, 11, 8, 'Tanpa resiko bangunan berdekatan.', '<b>Tidak</b> Menggunakan Tepol', '80.00', '60.00', '1.00', '30968', '3103', '31', 'MPKL', 'no'),
(48, '2013-10-11 10:21:55', '0000-00-00 00:00:00', 'Zulfa', '7022345', 'Jalan Kamboja No.13 RT 09 RW 06', 44, 202, 11, 8, 'Tanpa resiko bangunan berdekatan.', '<b>Tidak</b> Menggunakan Tepol', '70.00', '55.00', '2.00', '57960', '5783', '31', 'MPKL', 'no'),
(49, '2013-10-18 10:25:06', '0000-00-00 00:00:00', 'Maimunah', '0811089011', 'Jalan Sentosa No.300 RT 01 RW 01', 44, 196, 11, 8, 'Tanpa resiko bangunan berdekatan.', '<b>Tidak</b> Menggunakan Tepol', '100.00', '30.00', '1.00', '19286', '1929', '28', 'MPKL', 'no'),
(50, '2013-10-23 10:29:05', '0000-00-00 00:00:00', 'Ekwien', '0856389048', 'Jalan Sederhana NO.45 RT 01 Rw 03', 44, 200, 11, 8, 'Tanpa resiko bangunan berdekatan.', '<b>Tidak</b> Menggunakan Tepol', '90.00', '50.00', '1.00', '29028', '2908', '31', 'MPKL', 'no'),
(51, '2013-10-27 10:31:26', '0000-00-00 00:00:00', 'Rumanah', '71123456', 'Jalan Urip Sumoharjo NO.39 RT 08 RW 03', 44, 193, 11, 8, 'Tanpa resiko bangunan berdekatan.', '<b>Tidak</b> Menggunakan Tepol', '60.00', '45.00', '1.00', '17494', '1749', '29', 'MPKL', 'no'),
(52, '2013-11-17 10:34:14', '0000-00-00 00:00:00', 'Dwi Ayu', '8933445', 'Jalan Kencana No.300 RT 01 RW 02', 44, 190, 11, 8, 'Tanpa resiko bangunan berdekatan.', '<b>Tidak</b> Menggunakan Tepol', '80.00', '40.00', '1.00', '20593', '2063', '31', 'MPKL', 'no'),
(53, '2013-11-25 10:36:12', '0000-00-00 00:00:00', 'Ratna', '7022345', 'Jalan Sentosa NO.39 RT 01 RW 05', 44, 198, 11, 8, 'Tanpa resiko bangunan berdekatan.', '<b>Tidak</b> Menggunakan Tepol', '50.00', '30.00', '1.00', '9643', '964', '29', 'MPKL', 'no'),
(54, '2013-01-01 10:39:04', '0000-00-00 00:00:00', 'Robby', '0811089011', 'Jalan Kauman NO.200 RT 08 RW 01', 30, 23, 2, 7, 'Dengan resiko bangunan berdekatan.', '<b>Tidak</b> Menggunakan Tepol', '70.00', '50.00', '4.00', '275828', '9786', '26', 'MPKP', 'no'),
(55, '2013-01-19 10:42:12', '2013-01-19 11:27:12', 'Iswatun', '7231098', 'Jalan Arjuno No.30 RT 01 RW 02', 60, 26, 2, 8, 'Tanpa resiko bangunan berdekatan.', '<b>Tidak</b> Menggunakan Tepol', '70.00', '40.00', '4.00', '97923', '7817', '31', 'MPKP', 'yes'),
(56, '2013-01-26 10:45:22', '2013-01-27 11:05:22', 'Suhartik', '08123857999', 'Jalan Pahlawan NO. 39 RT 01 RW 03', 6, 31, 2, 7, 'Tanpa resiko bangunan berdekatan.', '<b>Tidak</b> Menggunakan Tepol', '90.00', '50.00', '5.00', '258027', '15508', '31', 'MPKP', 'yes'),
(57, '2013-05-11 10:48:21', '0000-00-00 00:00:00', 'Roni', '8918476', 'Jalan Maju JAya NO.29 RT 03 RW 01', 36, 24, 2, 8, 'Dengan resiko bangunan berdekatan.', '<b>Tidak</b> Menggunakan Tepol', '90.00', '40.00', '5.00', '139122', '12387', '31', 'MPKP', 'no'),
(58, '2013-05-20 10:51:16', '0000-00-00 00:00:00', 'Totok', '7231098', 'Jalan Randu Agung NO.100 RT 01 RW 02', 31, 28, 2, 7, 'Tanpa resiko bangunan berdekatan.', '<b>Tidak</b> Menggunakan Tepol', '50.00', '30.00', '5.00', '64288', '5143', '28', 'MPKP', 'no'),
(59, '2013-08-27 10:53:56', '0000-00-00 00:00:00', 'Julita', '0811089011', 'Jalan Sigura-gura NO.39 RT 02 RW 01', 56, 22, 2, 8, 'Tanpa resiko bangunan berdekatan.', '<b>Tidak</b> Menggunakan Tepol', '80.00', '60.00', '4.00', '167746', '13445', '31', 'MPKP', 'no'),
(60, '2013-09-07 10:56:21', '0000-00-00 00:00:00', 'Sari', '7317089', 'Jalan HArum NO.400 RT 01 RW 02', 1, 27, 2, 7, 'Tanpa resiko bangunan berdekatan.', '<b>Tidak</b> Menggunakan Tepol', '60.00', '30.00', '4.00', '83659', '5020', '30', 'MPKP', 'no'),
(61, '2013-09-24 10:59:26', '0000-00-00 00:00:00', 'Suhardi', '0856389048', 'Jalan Kertajaya NO.20 RT 01 RW 02', 29, 26, 2, 15, 'Tanpa resiko bangunan berdekatan.', '<b>Tidak</b> Menggunakan Tepol', '20.00', '10.00', '5.00', '8712', '692', '31', 'MPKP', 'no'),
(62, '2013-09-27 11:02:16', '0000-00-00 00:00:00', 'Maliq', '8933445', 'JAlan Sumoharjo NO 400 RT 01 RW 09', 95, 35, 2, 15, 'Tanpa resiko bangunan berdekatan.', '<b>Tidak</b> Menggunakan Tepol', '15.00', '10.00', '6.00', '4620', '647', '29', 'MPKP', 'no'),
(63, '2013-10-01 11:04:39', '0000-00-00 00:00:00', 'Sariyah', '0887685477', 'Jalan Kenongo NO.40 RT 01 RW 02', 43, 35, 2, 7, 'Tanpa resiko bangunan berdekatan.', '<b>Tidak</b> Menggunakan Tepol', '20.00', '15.00', '4.00', '6306', '834', '29', 'MPKP', 'no'),
(64, '2013-10-11 11:48:04', '0000-00-00 00:00:00', 'Wahyuni', '71123456', 'Jalan Makmur NO.20 RT 01 RW 03', 83, 23, 2, 7, 'Dengan resiko bangunan berdekatan.', '<b>Tidak</b> Menggunakan Tepol', '10.00', '8.00', '3.00', '2758', '172', '31', 'MPKP', 'no'),
(65, '2013-10-13 11:52:18', '0000-00-00 00:00:00', 'Putri', '08123857999', 'Jalan Kartini NO.20 RT 01 RW 02', 84, 23, 2, 8, 'Dengan resiko bangunan berdekatan.', '<b>Tidak</b> Menggunakan Tepol', '8.00', '6.00', '3.00', '1114', '104', '30', 'MPKP', 'no'),
(66, '2013-10-17 11:55:06', '0000-00-00 00:00:00', 'Siskawati', '7223980', 'Jalan Ijen NO.24 Rt 01 RW 03', 84, 29, 2, 7, 'Dengan resiko bangunan berdekatan.', '<b>Tidak</b> Menggunakan Tepol', '9.00', '6.00', '3.00', '1929', '118', '31', 'MPKP', 'no'),
(67, '2013-10-19 11:57:20', '0000-00-00 00:00:00', 'Putra', '7022345', 'Jalan Sewu Candi NO.20 RT 01 RW 02', 84, 28, 2, 8, 'Tanpa resiko bangunan berdekatan.', '<b>Tidak</b> Menggunakan Tepol', '8.00', '5.00', '3.00', '891', '83', '30', 'MPKP', 'no'),
(68, '2013-10-22 11:59:13', '0000-00-00 00:00:00', 'Sulastri', '0813429098', 'JAlan Supratman NO.10 RT 09 RW 01', 84, 24, 2, 7, 'Tanpa resiko bangunan berdekatan.', '<b>Tidak</b> Menggunakan Tepol', '10.00', '6.00', '6.00', '1886', '264', '28', 'MPKP', 'no'),
(69, '2013-10-25 12:01:22', '0000-00-00 00:00:00', 'Fahmi', '08123857999', 'Jalan Manggis NO.14 RT 07 RW 01', 55, 30, 2, 8, 'Tanpa resiko bangunan berdekatan.', '<b>Tidak</b> Menggunakan Tepol', '8.00', '6.00', '3.00', '1300', '104', '31', 'MPKP', 'no'),
(70, '2013-10-27 12:03:36', '0000-00-00 00:00:00', 'Karunia', '08123857999', 'Jalan Sawo NO.30 RT 02 RW 06', 84, 28, 2, 7, 'Tanpa resiko bangunan berdekatan.', '<b>Tidak</b> Menggunakan Tepol', '9.00', '7.00', '3.00', '986', '136', '29', 'MPKP', 'no'),
(71, '2013-11-15 12:12:41', '0000-00-00 00:00:00', 'Rusliawan', '7384758', 'Jalan Jeruk NO.34 RT 01 RW 08', 44, 22, 2, 15, 'Tanpa resiko bangunan berdekatan.', '<b>Tidak</b> Menggunakan Tepol', '70.00', '60.00', '1.00', '27186', '2713', '29', 'MPKL', 'no'),
(72, '2013-11-26 12:14:50', '0000-00-00 00:00:00', 'Saritoga', '0811089011', 'Jalan Kebomas NO.33 RT 01 Rw 02', 44, 25, 2, 7, 'Tanpa resiko bangunan berdekatan.', '<b>Tidak</b> Menggunakan Tepol', '60.00', '55.00', '1.00', '21276', '2128', '28', 'MPKL', 'no'),
(73, '2013-01-21 12:18:10', '0000-00-00 00:00:00', 'Suryanto', '7223980', 'Jalan Merbabu NO.89 RT 01 RW 04', 28, 38, 3, 11, 'Dengan resiko bangunan berdekatan.', '<b>Menggunkan</b> Tepol (Cairan Basa)', '40.00', '15.00', '4.00', '23469', '1669', '29', 'MPKP', 'no'),
(74, '2013-08-17 12:21:59', '0000-00-00 00:00:00', 'Riniwati', '0811089011', 'Jalan Sumo Kali NO.39 RT 01 RW 02', 44, 40, 3, 19, 'Tanpa resiko bangunan berdekatan.', '<b>Tidak</b> Menggunakan Tepol', '100.00', '70.00', '1.00', '45264', '4526', '28', 'MPKL', 'no'),
(75, '2013-08-29 12:24:12', '0000-00-00 00:00:00', 'Rozaq', '7022345', 'Jalan Kemuning Raya NO.28 RT 01 RW 03', 44, 51, 3, 12, 'Tanpa resiko bangunan berdekatan.', '<b>Tidak</b> Menggunakan Tepol', '80.00', '70.00', '1.00', '36156', '3623', '30', 'MPKL', 'no'),
(76, '2013-09-03 12:26:34', '0000-00-00 00:00:00', 'Setya Uswatun', '08123857999', 'Jalan Cempaka NO.300 RT 01 RW 03', 44, 44, 3, 18, 'Tanpa resiko bangunan berdekatan.', '<b>Tidak</b> Menggunakan Tepol', '50.00', '35.00', '1.00', '11316', '1132', '24', 'MPKL', 'no'),
(77, '2013-09-15 12:29:25', '0000-00-00 00:00:00', 'Joko Samudro', '71123456', 'Jalan Rahayu Dalam NO.49 RT 01 RW 02', 44, 52, 3, 19, 'Tanpa resiko bangunan berdekatan.', '<b>Tidak</b> Menggunakan Tepol', '95.00', '48.00', '1.00', '29390', '2934', '28', 'MPKL', 'no'),
(78, '2013-10-12 12:38:28', '0000-00-00 00:00:00', 'Sumarjo', '0887685477', 'Jalan Setiabudi NO.23 RT 01 Rw 02', 44, 58, 3, 19, 'Tanpa resiko bangunan berdekatan.', '<b>Tidak</b> Menggunakan Tepol', '100.00', '70.00', '1.00', '45264', '4526', '28', 'MPKL', 'no'),
(79, '2013-10-18 12:40:36', '0000-00-00 00:00:00', 'Srihartini', '7317089', 'Jalan Palem No.30 RT 01 RW 02', 44, 54, 3, 37, 'Tanpa resiko bangunan berdekatan.', '<b>Tidak</b> Menggunakan Tepol', '40.00', '25.00', '1.00', '6445', '645', '28', 'MPKL', 'no'),
(80, '2013-10-26 12:43:16', '0000-00-00 00:00:00', 'Deni', '0813429098', 'Jalan Slamet NO.34 RT 02 Rw 04', 44, 37, 3, 12, 'Tanpa resiko bangunan berdekatan.', '<b>Tidak</b> Menggunakan Tepol', '70.00', '50.00', '1.00', '22632', '2258', '28', 'MPKL', 'no'),
(81, '2013-11-13 12:46:03', '0000-00-00 00:00:00', 'Rahmawati', '0813429098', 'Jalan Rukun Warga NO.50 RT 01 RW 04', 44, 46, 3, 12, 'Tanpa resiko bangunan berdekatan.', '<b>Tidak</b> Menggunakan Tepol', '70.00', '65.00', '1.00', '29394', '2933', '28', 'MPKL', 'no'),
(82, '2013-11-26 12:48:10', '0000-00-00 00:00:00', 'Fajar Budi', '7223980', 'Jalan jambu NO.400 RT 01 Rw 03', 44, 344, 3, 18, 'Tanpa resiko bangunan berdekatan.', '<b>Tidak</b> Menggunakan Tepol', '70.00', '60.00', '1.00', '27186', '2713', '31', 'MPKL', 'no'),
(83, '2013-06-19 12:55:33', '0000-00-00 00:00:00', 'Rahardjo', '0811089011', 'Jalan Sudimampir No.30 RT 01 Rw 02', 84, 256, 14, 12, 'Dengan resiko bangunan berdekatan.', '<b>Tidak</b> Menggunakan Tepol', '9.00', '7.00', '3.00', '2218', '136', '31', 'MPKP', 'no'),
(84, '2013-09-04 12:57:55', '0000-00-00 00:00:00', 'Rasita', '7223980', 'Jalan Rekoso No.34 RT 01 RW 08', 53, 267, 14, 19, 'Tanpa resiko bangunan berdekatan.', '<b>Tidak</b> Menggunakan Tepol', '8.00', '5.00', '3.00', '1248', '83', '29', 'MPKP', 'no'),
(85, '2013-01-21 13:00:34', '0000-00-00 00:00:00', 'Rahmi', '8955674', 'Jalan Kuning Mas NO.34 RT 02 RW 01', 29, 63, 4, 45, 'Dengan resiko bangunan berdekatan.', '<b>Menggunkan</b> Tepol (Cairan Basa)', '70.00', '40.00', '5.00', '135585', '9621', '28', 'MPKBG', 'no'),
(86, '2013-02-22 13:02:55', '0000-00-00 00:00:00', 'Yanto', '7223980', 'Jalan Kanjeng Jimat', 20, 64, 4, 45, 'Tanpa resiko bangunan berdekatan.', '<b>Tidak</b> Menggunakan Tepol', '50.00', '30.00', '4.00', '78351', '4179', '29', 'MPKP', 'no'),
(87, '2013-09-19 13:05:47', '0000-00-00 00:00:00', 'Mustika', '0856389048', 'Jalan Sedap Malam NO.35 RT 01 Rw 03', 78, 73, 4, 45, 'Dengan resiko bangunan berdekatan.', '<b>Tidak</b> Menggunakan Tepol', '30.00', '15.00', '3.00', '12005', '965', '29', 'MPKP', 'no'),
(88, '2013-10-18 13:08:16', '0000-00-00 00:00:00', 'Lilik', '7317089', 'Jalan Sekar BUmi No.33 RT 01 RW 03', 53, 62, 4, 45, 'Tanpa resiko bangunan berdekatan.', '<b>Tidak</b> Menggunakan Tepol', '12.00', '7.00', '3.00', '2691', '182', '31', 'MPKP', 'no'),
(89, '2013-10-27 13:10:22', '0000-00-00 00:00:00', 'Hartatik', '8918476', 'Jalan Sono NO 55 Rt 02 RW 03', 84, 66, 4, 45, 'Dengan resiko bangunan berdekatan.', '<b>Tidak</b> Menggunakan Tepol', '8.00', '5.00', '3.00', '1337', '83', '29', 'MPKP', 'no'),
(90, '2013-11-11 13:12:29', '0000-00-00 00:00:00', 'Pujiono', '88445578', 'Jalan Bambu Asri NO.32 RT 01 RW 01', 84, 69, 4, 45, 'Dengan resiko bangunan berdekatan.', '<b>Tidak</b> Menggunakan Tepol', '7.00', '5.00', '3.00', '789', '74', '31', 'MPKP', 'no'),
(91, '2013-11-27 13:14:30', '0000-00-00 00:00:00', 'Dhani', '71123456', 'Jalan Untung No.26 RT 01 RW 02', 44, 75, 4, 45, 'Tanpa resiko bangunan berdekatan.', '<b>Tidak</b> Menggunakan Tepol', '75.00', '65.00', '1.00', '31439', '3144', '28', 'MPKL', 'no'),
(92, '2013-01-10 13:38:52', '0000-00-00 00:00:00', 'Dinda', '0813429098', 'Jalan Kartini No.30 RT 01 RW 03', 60, 316, 17, 3, 'Dengan resiko bangunan berdekatan.', '<b>Tidak</b> Menggunakan Tepol', '50.00', '30.00', '4.00', '39176', '4179', '29', 'MPKP', 'no'),
(93, '2013-02-20 13:41:19', '0000-00-00 00:00:00', 'Salma', '7022345', 'Jalan Jati NO.45 RT 01 RW 02', 49, 320, 17, 4, 'Tanpa resiko bangunan berdekatan.', '<b>Tidak</b> Menggunakan Tepol', '50.00', '45.00', '7.00', '111651', '11165', '29', 'MPKP', 'no'),
(94, '2013-02-28 13:43:30', '0000-00-00 00:00:00', 'Ningrum', '0856389048', 'Jalan Lembayung NO.20 RT 01 RW 02', 29, 329, 17, 3, 'Tanpa resiko bangunan berdekatan.', '<b>Tidak</b> Menggunakan Tepol', '15.00', '6.00', '4.00', '3185', '255', '31', 'MPKP', 'no'),
(95, '2013-03-27 13:45:39', '0000-00-00 00:00:00', 'Rendy', '08123857999', 'Jalan Jemursari NO 30 RT 03 Rw 01', 28, 321, 17, 4, 'Tanpa resiko bangunan berdekatan.', '<b>Tidak</b> Menggunakan Tepol', '20.00', '15.00', '5.00', '9702', '1027', '31', 'MPKP', 'no'),
(96, '2013-08-22 13:56:30', '0000-00-00 00:00:00', 'Fahmia', '0813429098', 'Jalan Asem NO 32 RT 01 RW 02', 83, 277, 17, 4, 'Dengan resiko bangunan berdekatan.', '<b>Tidak</b> Menggunakan Tepol', '9.00', '7.00', '3.00', '2218', '136', '31', 'MPKP', 'no'),
(97, '2013-09-07 13:58:18', '0000-00-00 00:00:00', 'Galang', '74564738', 'Jalan Jati NO.35 RT 07 RW 02', 53, 331, 17, 4, 'Tanpa resiko bangunan berdekatan.', '<b>Tidak</b> Menggunakan Tepol', '8.00', '7.00', '3.00', '1794', '120', '27', 'MPKP', 'no'),
(98, '2013-09-18 14:00:22', '0000-00-00 00:00:00', 'Fadli', '08123857999', 'Jalan erdeka NO.45 RT 01 RW 07', 83, 331, 17, 4, 'Dengan resiko bangunan berdekatan.', '<b>Tidak</b> Menggunakan Tepol', '10.00', '7.00', '3.00', '2440', '152', '31', 'MPKP', 'no'),
(99, '2013-09-25 14:02:05', '0000-00-00 00:00:00', 'Dimas', '7317089', 'Jalan Sawojajar NO.34 RT 01 RW 03', 55, 320, 17, 3, 'Tanpa resiko bangunan berdekatan.', '<b>Tidak</b> Menggunakan Tepol', '8.00', '5.00', '3.00', '693', '83', '31', 'MPKP', 'no'),
(100, '2013-11-12 14:03:53', '0000-00-00 00:00:00', 'Zahra', '0813429098', 'Jalan Semangka No.23 RT 01 RW 02', 44, 130, 17, 4, 'Tanpa resiko bangunan berdekatan.', '<b>Tidak</b> Menggunakan Tepol', '50.00', '25.00', '1.00', '8069', '807', '29', 'MPKL', 'no'),
(101, '2013-11-24 14:05:47', '0000-00-00 00:00:00', 'Rona', '8955674', 'Jalan Mujur NO.13 RT 01 RW 02', 44, 323, 17, 3, 'Tanpa resiko bangunan berdekatan.', '<b>Tidak</b> Menggunakan Tepol', '50.00', '50.00', '1.00', '16138', '1614', '27', 'MPKL', 'no'),
(102, '2013-11-27 14:07:50', '0000-00-00 00:00:00', 'khusnul Khotimah', '8933445', 'Jalan Sepatu NO.30 RT 01 RW 03', 44, 322, 17, 4, 'Tanpa resiko bangunan berdekatan.', '<b>Tidak</b> Menggunakan Tepol', '70.00', '40.00', '1.00', '18078', '1804', '31', 'MPKL', 'no'),
(103, '2013-02-23 15:43:01', '0000-00-00 00:00:00', 'Ninis', '7022345', 'Jalan Mayjend Sungkono NO.36 RT 02 RW 04', 52, 172, 10, 5, 'Dengan resiko bangunan berdekatan.', '<b>Tidak</b> Menggunakan Tepol', '70.00', '50.00', '5.00', '169740', '12044', '30', 'MPKP', 'no'),
(104, '2013-04-20 15:47:11', '0000-00-00 00:00:00', 'Prima', '7317089', 'JAlan Sekar NO.30 RT 02 RW 01', 68, 181, 10, 14, 'Dengan resiko bangunan berdekatan.', '<b>Tidak</b> Menggunakan Tepol', '50.00', '30.00', '4.00', '78351', '4179', '31', 'MPKP', 'no'),
(105, '2013-07-27 15:49:52', '0000-00-00 00:00:00', 'Joseph', '8933445', 'Jalan Boyolali NO.88 RT 02 RW 01', 28, 179, 10, 5, 'Tanpa resiko bangunan berdekatan.', '<b>Tidak</b> Menggunakan Tepol', '50.00', '20.00', '5.00', '43296', '3464', '28', 'MPKP', 'no'),
(106, '2013-09-20 15:52:04', '0000-00-00 00:00:00', 'Raden Aji', '71123456', 'Jalan Raden Patah NO.300 RT 01 RW 02', 83, 177, 10, 5, 'Dengan resiko bangunan berdekatan.', '<b>Tidak</b> Menggunakan Tepol', '10.00', '9.00', '6.00', '6364', '396', '31', 'MPKP', 'no'),
(107, '2013-10-17 15:54:07', '0000-00-00 00:00:00', 'Muhklis', '0811089011', 'Jalan Banjar NO.14 RT 01 RW 02', 84, 178, 10, 15, 'Dengan resiko bangunan berdekatan.', '<b>Tidak</b> Menggunakan Tepol', '8.00', '7.00', '4.00', '1666', '155', '29', 'MPKP', 'no'),
(108, '2013-10-27 15:56:18', '0000-00-00 00:00:00', 'Aura', '7317089', 'Jalan Asri NO.23 RT 08 RW 01', 44, 173, 10, 5, 'Tanpa resiko bangunan berdekatan.', '<b>Tidak</b> Menggunakan Tepol', '70.00', '50.00', '1.00', '22632', '2258', '31', 'MPKL', 'no'),
(109, '2013-12-19 15:58:17', '0000-00-00 00:00:00', 'Soleh', '0811089011', 'Jalan Semanggi No. 38 RT 01 RW 02', 44, 176, 10, 4, 'Tanpa resiko bangunan berdekatan.', '<b>Tidak</b> Menggunakan Tepol', '90.00', '50.00', '1.00', '29028', '2908', '30', 'MPKL', 'no'),
(110, '2013-04-27 16:00:34', '0000-00-00 00:00:00', 'Syauqi', '7317089', 'Jalan Jenaka No.30 RT 01 RW 09', 45, 212, 12, 15, 'Dengan resiko bangunan berdekatan.', '<b>Tidak</b> Menggunakan Tepol', '60.00', '45.00', '4.00', '170563', '7581', '28', 'MPKP', 'no'),
(111, '2013-08-03 16:02:51', '0000-00-00 00:00:00', 'Juwita', '8933445', 'Jalan Pregolan No.88 RT 01 RW 03', 79, 216, 12, 15, 'Dengan resiko bangunan berdekatan.', '<b>Tidak</b> Menggunakan Tepol', '70.00', '40.00', '5.00', '180780', '9621', '30', 'MPKP', 'no'),
(112, '2013-10-15 16:05:22', '0000-00-00 00:00:00', 'Hanifa', '8918476', 'Jalan Sungkono No.45 RT 01 RW 08', 34, 198, 12, 15, 'Dengan resiko bangunan berdekatan.', '<b>Tidak</b> Menggunakan Tepol', '60.00', '40.00', '5.00', '61937', '8258', '28', 'MPKP', 'no'),
(113, '2013-10-27 16:08:00', '0000-00-00 00:00:00', 'Sony Tulung', '0856389048', 'Jalan Sukoharjo NO,88 RT 08 RW 07', 63, 218, 12, 15, 'Dengan resiko bangunan berdekatan.', '<b>Menggunkan</b> Tepol (Cairan Basa)', '40.00', '20.00', '5.00', '51876', '2767', '31', 'MPKBG', 'no'),
(114, '2013-11-24 16:10:29', '0000-00-00 00:00:00', 'Fatimah', '0813429098', 'Jalan Buntu No.45 RT 09 RW 01', 28, 220, 12, 15, 'Tanpa resiko bangunan berdekatan.', '<b>Tidak</b> Menggunakan Tepol', '30.00', '15.00', '4.00', '11705', '1255', '24', 'MPKP', 'no'),
(115, '2014-10-10 06:20:06', '0000-00-00 00:00:00', 'Subaru', '08123456789', 'Jalan Ketintang 2', 47, 24, 2, 8, 'Dengan resiko bangunan berdekatan.', '<b>Tidak</b> Menggunakan Tepol', '5.00', '6.00', '7.00', '2208', '152', '28', 'MPKP', 'yes'),
(116, '2014-10-28 09:21:02', '2014-10-28 09:21:02', 'andriyan', '6174235', 'wow', 80, 71, 4, 45, 'Tanpa resiko bangunan berdekatan.', '<b>Tidak</b> Menggunakan Tepol', '20.00', '30.00', '100.00', '303072', '42109', '28', 'MPKP', 'no');

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
