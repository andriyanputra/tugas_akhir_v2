<?php
session_start();
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
include ("../config/koneksi.php");
include '../config/functions.php'; //include function.php - very important

if (!loggedin()) { // check if the user is logged in, but if it isn't, it will redirect to the Login Form page. Noticed the difference?
    header("Location: ../login/login.php");
    exit();
}


if ((isset($_SESSION['pegawai_nomor']) && isset($_SESSION['level'])) || (isset($_COOKIE['level']) && isset($_COOKIE['pegawai_nomor']))) {
    $sql = mysql_query("SELECT * FROM pegawai WHERE (pegawai_nip='" . $_SESSION['pegawai_nomor'] . "' AND id_level_user='".$_SESSION['level']."') 
                        OR (pegawai_nip='" . $_COOKIE['pegawai_nomor'] . "' AND id_level_user='".$_COOKIE['level']."')") or die("Query : ".mysql_error());
    $query = mysql_query("SELECT * FROM kecamatan WHERE KECAMATAN_ID = '" . $_GET['kec'] . "'");
    if ($sql == false) {
        die(mysql_error());
        header('Location: ../login/login.php');
        exit();
    } else if (mysql_num_rows($sql)) {
        while ($row = mysql_fetch_assoc($sql)) {
            ?>
            <!DOCTYPE html>
            <html lang="en">
                <head>
                    <meta charset="utf-8" />
                    <title>SIM Proteksi Kebakaran Perkotaan</title>

                    <meta name="description" content="Common form elements and layouts" />
                    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

                    <!--basic styles-->

                    <link href="../assets/css-ace/bootstrap.min.css" rel="stylesheet" />
                    <link href="../assets/css-ace/bootstrap-responsive.min.css" rel="stylesheet" />
                    <link rel="stylesheet" href="../assets/css-ace/font-awesome.min.css" />

                    <!--page specific plugin styles-->
                    <link rel="stylesheet" href="../assets/css-ace/jquery-ui-1.10.3.custom.min.css" />
                    <link rel="stylesheet" href="../assets/css-ace/chosen.css" />
                    <link rel="shortcut icon" href="../assets/img/favicon.png">
                    <!--fonts-->

                    <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Open+Sans:400,300" />

                    <!--ace styles-->

                    <link rel="stylesheet" href="../assets/css-ace/ace.min.css" />
                    <link rel="stylesheet" href="../assets/css-ace/ace-responsive.min.css" />
                    <link rel="stylesheet" href="../assets/css-ace/ace-skins.min.css" />

                    <!--inline styles related to this page-->
                    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
                </head>
                <body>

                    <div class="navbar">
                        <div class="navbar-inner">
                            <div class="container-fluid">
                                <a href="index" class="brand">
                                    <small>
                                        <i class="icon-fire-extinguisher"></i>
                                        SIM Proteksi Kebakaran Perkotaan Kab. Sidoarjo 
                                    </small>
                                </a><!--/.brand-->

                                <ul class="nav ace-nav pull-right">
                                    <li class="green">
                                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                                            <i class="icon-envelope icon-animated-vertical"></i>
                                            <?php
                                            $level = $row['id_level_user'];
                                            $jabatan = $row['jabatan_id'];
                                            $cek_pesan = mysql_query("SELECT * FROM pesan WHERE pesan_status = 0 AND pesan_untuk='$jabatan'") or die("Query : ".mysql_error());
                                            $jml_pesan = mysql_num_rows($cek_pesan);
                                            if($jml_pesan > 0){
                                                echo "<span class='badge badge-success'>$jml_pesan</span>";
                                            }else{
                                                echo "<span class='badge badge-success'>0</span>";
                                            }
                                            ?>
                                        </a>

                                        <ul class="pull-right dropdown-navbar dropdown-menu dropdown-caret dropdown-closer">
                                            <li class="nav-header">
                                                <i class="icon-envelope-alt"></i>
                                                <?php 
                                                if($jml_pesan > 0){
                                                    echo "$jml_pesan Pesan";
                                                }else{
                                                    echo "0 Pesan";
                                                }
                                                ?>
                                            </li>
                                            
                                            <?php
                                                $q_pesan = mysql_query("SELECT b.id, b.pesan_dari, b.pesan_isi, a.resiko_tanggal_start, c.pegawai_nama
                                                                        FROM resiko AS a INNER JOIN pesan AS b ON (a.resiko_id = b.resiko_id)
                                                                        INNER JOIN pegawai AS c ON (c.pegawai_nip = b.pegawai_nip)
                                                                        WHERE b.pesan_status = 0 AND b.pesan_untuk='$jabatan'
                                                                        GROUP BY b.id ORDER BY b.id ASC
                                                                        LIMIT 3") or die("Query : ".mysql_error());
                                                while($pesan = mysql_fetch_array($q_pesan)){
                                                    $nama = $pesan['pegawai_nama'];
                                                    $first_nama = explode(' ',trim($nama));
                                                    //echo $first_nama[0];
                                            ?>
                                            <li>
                                                <a href="../pesan/detail?id=<?php echo $pesan['id'];?>">
                                                    <span class="msg-body">
                                                        <span class="msg-title">
                                                            <span class="blue"><?php echo $first_nama[0].': ' ?></span>
                                                            <?php
                                                                $isi = $pesan['pesan_isi'];
                                                                $potong_isi = substr($isi,0,50);
                                                                echo $potong_isi.'...';
                                                            ?>
                                                        </span>

                                                        <span class="msg-time">
                                                            <i class="icon-time"></i>
                                                            <span>
                                                                <?php
                                                                    $p_tgl = date('H:i:s A', strtotime($pesan['resiko_tanggal_start']));
                                                                    echo $p_tgl;
                                                                ?>
                                                            </span>
                                                        </span>
                                                    </span>
                                                </a>
                                            </li>
                                            <?php
                                                }
                                            ?>
                                            <li>
                                                <a href="../pesan/">
                                                    Lihat Semua Pemberitahuan
                                                    <i class="icon-arrow-right"></i>
                                                </a>
                                            </li>
                                        </ul>
                                    </li>

                                    <li class="light-blue">
                                        <a data-toggle="dropdown" href="#" class="dropdown-toggle">
                                            <img class="nav-user-photo" src="../assets/img/img-anggota/<?= $row['pegawai_foto']; ?>" alt="<?php echo $hasil['pegawai_nama']; ?>" />
                                            <span class="user-info">
                                                <small>Welcome,</small>
                                                <?php echo $row['pegawai_nama']; ?>    
                                            </span>

                                            <i class="icon-caret-down"></i>
                                        </a>

                                        <ul class="user-menu pull-right dropdown-menu dropdown-yellow dropdown-caret dropdown-closer">

                                            <li>
                                                <a href="../anggota/profile?nip=<?= $row['pegawai_nip']; ?>">
                                                    <i class="icon-user"></i>
                                                    Profile
                                                </a>
                                            </li>
                                            <li>
                                                <a href="../log_user/index?nip=<?= $row['pegawai_nip']; ?>">
                                                    <i class="icon-cog"></i>
                                                    Log User
                                                </a>
                                            </li>

                                            <li class="divider"></li>

                                            <li>
                                                <a href="../login/logout?nip=<?= $row['pegawai_nip']; ?>">
                                                    <i class="icon-off"></i>
                                                    Logout
                                                </a>
                                            </li>
                                        </ul>
                                    </li>
                                </ul><!--/.ace-nav-->
                            </div><!--/.cont
                            ainer-fluid-->
                        </div><!--/.navbar-inner-->
                    </div>

                    <div class="main-container container-fluid">
                        <a class="menu-toggler" id="menu-toggler" href="#">
                            <span class="menu-text"></span>
                        </a>

                        <?php
                        include '../template/sidebar.php';
                        ?>

                        <div class="main-content">
                            <div class="breadcrumbs" id="breadcrumbs">
                                <ul class="breadcrumb">
                                    <li>
                                        <i class="icon-home home-icon"></i>
                                        <a href="../beranda/index">Home</a>

                                        <span class="divider">
                                            <i class="icon-angle-right arrow-icon"></i>
                                        </span>
                                    </li>
                                    <li>
                                        <a href="">Analisis Resiko</a>

                                        <span class="divider">
                                            <i class="icon-angle-right arrow-icon"></i>
                                        </span>
                                    </li>
                                    <li class="active">Laju Penerapan Air</li>
                                </ul><!--.breadcrumb-->

                                <div class="pull-right">
                                    <script>
                                        var months = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
                                        var myDays = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jum&#39;at', 'Sabtu'];
                                        var date = new Date();
                                        var day = date.getDate();
                                        var month = date.getMonth();
                                        var thisDay = date.getDay(),
                                                thisDay = myDays[thisDay];
                                        var yy = date.getYear();
                                        var year = (yy < 1000) ? yy + 1900 : yy;
                                        document.write(thisDay + ', ' + day + ' ' + months[month] + ' ' + year);
                                    </script>
                                    , Pukul
                                    <span id="clock"></span>
                                </div> 
                            </div>

                            <div class="page-content">
                                <div class="page-header position-relative">
                                    <h1>
                                        Analisis Resiko
                                        <small>
                                            <i class="icon-double-angle-right"></i>
                                            Laju Penerapan Air
                                        </small>
                                    </h1>
                                </div>
                                <!--/.page-header-->

                                <div class="row-fluid">
                                    <div class="span12">
                                        <!--PAGE CONTENT BEGINS-->
                                        <div class="row-fluid">
                                            <div class="span12">
                                                <?php $r = mysql_fetch_assoc($query); ?>
                                                <div class="widget-box">
                                                    <div class="widget-header widget-hea1der-small header-color-red">
                                                        <h6>
                                                            Peta Desa Kecamatan <?= $r['KECAMATAN_NAMA']; ?>
                                                        </h6>

                                                        <div class="widget-toolbar">
                                                            <a href="#" data-action="reload">
                                                                <i class="icon-refresh"></i>
                                                            </a>

                                                            <a href="#" data-action="collapse">
                                                                <i class="icon-chevron-up"></i>
                                                            </a>
                                                        </div>
                                                    </div>

                                                    <div class="widget-body">
                                                        <div class="widget-main padding-4">
                                                            <div class="slim-scroll" data-height="200">
                                                                <div class="content">
                                                                    <p align="center">
                                                                        <img src="../assets/img/sda/large/<?= $r['KECAMATAN_DIR']; ?>" width="829" height="441" id="gambar2"></p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div><!-- end row fliud --> 
                                        </div><!-- end span12 -->

                                        <div class="space-6"></div>

                                        <form class="form-horizontal" id="validation-form" method="POST" action="Fanalisis/kebProses.php">
                                            <div class="row-fluid">
                                                <div class="span12">
                                                    <?php
                                                    if (isset($_GET['msg'])) {
                                                        if ($_GET['msg'] == 'error') {
                                                            ?>
                                                            <div class="alert alert-block alert-error">
                                                                <button type="button" class="close" data-dismiss="alert">
                                                                    <i class="icon-remove"></i>
                                                                </button>

                                                                <i class="icon-remove"></i>
                                                                Mohon untuk mengisi seluruh field dalam tab <strong>Potensi Pengangkutan Air</strong>.
                                                            </div>
                                                            <?php
                                                        }
                                                    }
                                                    ?>
                                                    <div class="tabbable">
                                                        <div id="tabs">
                                                            <ul class="nav nav-tabs padding-18" >
                                                                <li class="active">
                                                                    <a data-toggle="tab" href="#laju">
                                                                        <i class="orange icon-bolt bigger-120"></i>
                                                                        Laju Penerapan Air
                                                                    </a>
                                                                </li>

                                                                <li>
                                                                    <a data-toggle="tab" href="#potensi">
                                                                        <i class="blue icon-anchor bigger-120"></i>
                                                                        Potensi Pengangkutan Air
                                                                    </a>
                                                                </li>

                                                                <li>
                                                                    <a data-toggle="tab" href="#result">
                                                                        <i class="pink icon-fire-extinguisher bigger-120"></i>
                                                                        Result
                                                                    </a>
                                                                </li>
                                                            </ul>
                                                            <div class="tab-content no-border padding-24">
                                                                <!--LAJU-->
                                                                <div id="laju" class="tab-pane in active">
                                                                    <div class="row-fluid">
                                                                        <div class="span12">
                                                                            <div class="widget-box transparent">
                                                                                <div class="widget-header header-color-blue2">
                                                                                    <h3>
                                                                                        Perhitungan Laju Penerapan Air
                                                                                        <a href="#penerapan" role="button" class="green" data-toggle="modal">
                                                                                            <span class="help-button" data-rel="tooltip" data-placement="bottom" title="More details.">?</span>
                                                                                        </a>
                                                                                    </h3>
                                                                                    <div class="widget-toolbar"></div>
                                                                                </div>

                                                                                <div class="widget-body">
                                                                                    <div class="widget-main padding-4">
                                                                                        <div class="content">
                                                                                            <div class="span6 center">
                                                                                                <div class="space-6"></div>
                                                                                                <img src="../assets/img/pengirimanAir.JPG" width="" height="" ></div>
                                                                                            <div class="span6 form-horizontal">
                                                                                                <div class="space-6"></div>
                                                                                                <div class="control-group">
                                                                                                    <label class="control-label" for="volume">Volume Bangunan :</label>
                                                                                                    <div class="controls">
                                                                                                        <input readonly name="panjang_volume" class="span2" id="panjang_volume" type="text" value="<?= $_GET['p']; ?>"/> x
                                                                                                        <input readonly name="lebar_volume" class="span2" id="lebar_volume" type="text" value="<?= $_GET['l']; ?>"/> x
                                                                                                        <input readonly name="tinggi_volume" class="span2" id="tinggi_volume" type="text" value="<?= $_GET['t']; ?>"/> (Satuan meter)
                                                                                                    </div>
                                                                                                </div>

                                                                                                <?php
                                                                                                $p = $_GET['p'];
                                                                                                $p2 = $_GET['p'] * 2;
                                                                                                $p_ft = round($p * 3.2808399);
                                                                                                $p_ft2 = round($p2 * 3.2808399);
                                                                                                $l = $_GET['l'];
                                                                                                $l_ft = round($l * 3.2808399);
                                                                                                $t = $_GET['t'];
                                                                                                $t_ft = round($t * 3.2808399);
                                                                                                $laju = round($p * $l * $t / 0.7483);
                                                                                                $laju2 = round($p2 * $l * $t / 0.7483);
                                                                                                $laju_galon = round($p_ft * $l_ft * $t_ft / 100);
                                                                                                $laju_galon2 = round($p_ft2 * $l_ft * $t_ft / 100);
                                                                                                $luas_bangunan = round($p * $l);
                                                                                                //p=3.048&l=15.24&t=15.24
                                                                                                $q = mysql_query("SELECT galonMenit FROM pengiriman_air WHERE galonMenit = '$laju_galon' OR galonMenit = '$laju_galon2'") or die(mysql_error());
                                                                                                if ($q) {
                                                                                                    $a = mysql_fetch_array($q);
                                                                                                    if ($a['galonMenit'] == $laju_galon || $a['galonMenit'] == $laju_galon2) {
                                                                                                        $sama = 'sama';
                                                                                                    } else {
                                                                                                        $sama = 'tidak sama';
                                                                                                    }
                                                                                                }
                                                                                                if ($sama == 'sama') {
                                                                                                    ?>
                                                                                                    <div class="control-group">
                                                                                                        <label class="control-label" for="desa">Laju Penerapan Air :</label>
                                                                                                        <div class="controls">
                                                                                                            <input class="span3" id="hasil_laju"  type="text" value="<?= $laju; ?>" readonly/>
                                                                                                            &nbsp;liter/menit
                                                                                                            atau <br /><div class="space-2"></div>
                                                                                                            <input class="span3" name="hasil_laju"  type="text" value="<?= $laju_galon; ?>" readonly/>
                                                                                                            &nbsp;US Galon/menit
                                                                                                        </div>
                                                                                                    </div>
                                                                                                    <?php
                                                                                                } else if ($sama == 'tidak sama') {
                                                                                                    ?>
                                                                                                    <div class="control-group">
                                                                                                        <label class="control-label" for="desa">Laju Penerapan Air :</label>
                                                                                                        <div class="controls">
                                                                                                            <input class="span3" id="hasil_laju"  type="text" value="<?= $laju2; ?>" readonly/>
                                                                                                            &nbsp;liter/menit
                                                                                                            atau <br /><div class="space-2"></div>
                                                                                                            <input class="span3" name="hasil_laju2"  type="text" value="<?= $laju_galon2; ?>" readonly/>
                                                                                                            &nbsp;US Galon/menit
                                                                                                        </div>
                                                                                                    </div>
                                                                                                    <?php
                                                                                                }
                                                                                                ?>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <!-- end widget-body --> </div>
                                                                        </div>
                                                                        <!-- end span12 --> </div>
                                                                </div>
                                                                <!--END LAJU-->
                                                                <?php
                                                                //$q_ = mysql_fetch_assoc(mysql_query("SELECT MAX( resiko_id )FROM resiko"));
                                                                $q_ = mysql_fetch_assoc(mysql_query("SELECT resiko_id FROM resiko ORDER BY resiko_id DESC LIMIT 1")) or die ('Query Id terakhir : '.mysql_error());
                                                                $resiko_id = $q_['resiko_id'];
                                                                $query_result = mysql_query("SELECT *
                                                                                            FROM
                                                                                                kecamatan AS a
                                                                                                INNER JOIN resiko AS b
                                                                                                    ON (a.KECAMATAN_ID = b.KECAMATAN_ID)
                                                                                                INNER JOIN desa AS c
                                                                                                    ON (c.DESA_ID = b.DESA_ID) AND (c.KECAMATAN_ID = a.KECAMATAN_ID)
                                                                                                INNER JOIN bangunan AS d
                                                                                                    ON (d.ID_BANGUNAN = b.ID_BANGUNAN)
                                                                                                INNER JOIN sumber_air AS e
                                                                                                    ON (e.ID_SUMBER = b.ID_SUMBER)
                                                                                             WHERE b.resiko_id = '$resiko_id'");
                                                                if ($query_result) {
                                                                    $result = mysql_fetch_array($query_result);
                                                                } else {
                                                                    die(mysql_error());
                                                                }
                                                                $result_tgl = date_create($result['resiko_tanggal_start']);
                                                                ?>
                                                                <!--POTENSI-->
                                                                <div id="potensi" class="tab-pane">
                                                                    <div class="row-fluid">
                                                                        <div class="span12">
                                                                            <div class="widget-box transparent">
                                                                                <div class="widget-header header-color-blue2">
                                                                                    <h3>Perhitungan Potensi Pengangkutan Air</h3>
                                                                                    <div class="widget-toolbar"></div>
                                                                                </div>

                                                                                <div class="widget-body">
                                                                                    <div class="widget-main padding-4">
                                                                                        <div class="content">
                                                                                            <div class="span6">
                                                                                                <div class="space-6"></div>
                                                                                                <img src="../assets/img/potensi.jpg" width="400" height="500" >
                                                                                            </div>
                                                                                            <div class="span6" id="validation-form">
                                                                                                <div class="space-6"></div>

                                                                                                <div class="control-group">
                                                                                                    <label  for="sumber_air">
                                                                                                        Sumber Air : <?php echo $result['NAMA_SUMBER'] . '.'; ?><br/>
                                                                                                        Lokasi Kejadian : <?php echo $result['alamat_pelapor'] . ' Ds. ' . $result['DESA_NAMA'] . ', Kec. ' . $result['KECAMATAN_NAMA'] . ', Kab. Sidoarjo.'; ?>
                                                                                                    </label>
                                                                                                    <input type="hidden" name="id" value="<?php echo $resiko_id; ?>" />
                                                                                                </div>
                                                                                                <div class="control-group">
                                                                                                    <label class="control-label" for="kecepatan_air">Kecepatan Konstan Kendaraan Menuju Sumber Air:</label>
                                                                                                    <div class="controls">
                                                                                                        <input class="auto" onkeyup="hitung()" onchange="run()" name="kecepatan_air" id="kecepatan_air" type="text" placeholder="km/jam . . ." data-a-sep="" />
                                                                                                        <strong class="red">*</strong>
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div class="control-group">
                                                                                                    <label class="control-label" for="jarak1">Jarak Lokasi ke Sumber Air (D1) :</label>
                                                                                                    <div class="controls">
                                                                                                        <input class="auto" onkeyup="hitung()" onchange="run()" name="jarak1" id="jarak1" type="text" placeholder="kilometer . . ." data-a-sep="" />
                                                                                                        <strong class="red">*</strong>
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div class="control-group">
                                                                                                    <label class="control-label" for="kecepatan_back">Kecepatan Konstan Kendaraan Kembali ke Lokasi:</label>
                                                                                                    <div class="controls">
                                                                                                        <input class="auto" onkeyup="hitung()" onchange="run()" name="kecepatan_back" id="kecepatan_back" type="text" placeholder="km/jam . . ." data-a-sep=""/>
                                                                                                        <strong class="red">*</strong>
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div class="control-group">
                                                                                                    <label class="control-label" for="jarak2">Jarak Lokasi Kembali dari Sumber Air (D2):</label>
                                                                                                    <div class="controls">
                                                                                                        <input class="auto" onkeyup="hitung()" onchange="run()" name="jarak2" id="jarak2" type="text" placeholder="kilometer . . ." data-a-sep="" />
                                                                                                        <strong class="red">*</strong>
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div class="control-group">
                                                                                                    <label class="control-label" for="v_potensi">Kapasitas Air Kendaraan Damkar (V):</label>
                                                                                                    <div class="controls">
                                                                                                        <input class="auto" onkeyup="hitung_()" onchange="run()" name="v_potensi" id="v_potensi" type="text" placeholder="liter . . ." data-a-sep="" />
                                                                                                        <strong class="red">*</strong>
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div class="control-group">
                                                                                                    <label class="control-label" for="a_potensi">Waktu Pengisian Tangki Kendaraan Pemasok Air (A) :</label>
                                                                                                    <div class="controls">
                                                                                                        <input class="auto" onkeyup="hitung_()" name="a_potensi" id="a_potensi" type="text" placeholder="menit . . ." data-a-sep="" />
                                                                                                        <strong class="red">*</strong>
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div class="control-group">
                                                                                                    <label class="control-label" for="b_potensi">Waktu Persiapan Pengisian Tangki Kendaraan Pemasok Air  (B) :</label>
                                                                                                    <div class="controls">
                                                                                                        <input class="auto" onkeyup="hitung_()" name="b_potensi" id="b_potensi" type="text" placeholder="menit . . ." data-a-sep="" />
                                                                                                        <strong class="red">*</strong>
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div class="control-group">
                                                                                                    <label class="control-label" for="t_potensi">T1 :&nbsp;&nbsp;&nbsp;&nbsp;</label>
                                                                                                    <div class="controls">
                                                                                                        <input class="span3" readonly="readonly" name="t1_potensi" id="t1_potensi" type="text" placeholder="menit . . ." value="" />&nbsp;&nbsp;&nbsp;
                                                                                                        T2 : <input class="span3" readonly="readonly" name="t2_potensi" id="t2_potensi" type="text" placeholder="menit . . ." value="" />
                                                                                                    </div>
                                                                                                </div>
                                                                                                <!--<div class="control-group">
                                                                                                    <label class="control-label red" for="t_potensi_ulang"><b>(Ketik ulang)</b> T1 :&nbsp;&nbsp;&nbsp;&nbsp;</label>
                                                                                                    <div class="controls red">
                                                                                                        <input class="auto span3" data-a-sep="" onkeyup="hitung_()" name="t1_potensi_ulang" id="t1_potensi_ulang" type="text" placeholder="menit . . ." />&nbsp;&nbsp;&nbsp;
                                                                                                        T2 : <input class="auto span3" data-a-sep="" onkeyup="hitung_()" name="t2_potensi_ulang" id="t2_potensi_ulang" type="text" placeholder="menit . . ." />
                                                                                                    </div>
                                                                                                </div>-->
                                                                                                <div class="control-group">
                                                                                                    <label class="control-label" for="aliran">Kemampuan Aliran Maksimum (Q):</label>
                                                                                                    <div class="controls">
                                                                                                        <input readonly="readonly" name="aliran" id="aliran" type="text" placeholder="liter/menit . . ." />
                                                                                                    </div>
                                                                                                </div>

                                                                                                <div class="control-group">
                                                                                                    <label for="">
                                                                                                        <small> <u><strong>Note :</strong></u> 
                                                                                                        </small>
                                                                                                    </label>
                                                                                                    <label for="note">
                                                                                                        &nbsp;&nbsp;<strong class="red">*</strong>
                                                                                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                                                                        <small>Gunakan . (titik) untuk koma.</small>
                                                                                                    </label>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div><!-- end widget-body --> 
                                                                            </div>
                                                                        </div><!-- end span12 --> 
                                                                    </div>
                                                                </div>
                                                                <!--END POTENSI-->

                                                                <!--RESULT-->
                                                                <div id="result" class="tab-pane">
                                                                    <div class="space-6"></div>

                                                                    <div class="row-fluid">
                                                                        <div class="span10 offset1">
                                                                            <div class="widget-box transparent invoice-box">
                                                                                <div class="widget-header widget-header-large">
                                                                                    <h3 class="grey lighter pull-left position-relative">
                                                                                        <i class="icon-fire-extinguisher red"></i>
                                                                                        Hasil Analisis Resiko Kebakaran
                                                                                    </h3>

                                                                                    <div class="widget-toolbar no-border invoice-info">
                                                                                        <span class="invoice-info-label">No. Analisa:</span>
                                                                                        <span class="red">#<?= $resiko_id ?></span>

                                                                                        <br />
                                                                                        <span class="invoice-info-label">Tanggal:</span>
                                                                                        <span class="blue"><?php echo date_format($result_tgl, 'd/m/Y'); ?></span>
                                                                                    </div>

                                                                                    <div class="widget-toolbar hidden-480">
                                                                                        <a href="#">
                                                                                            <i class="icon-print"></i>
                                                                                        </a>
                                                                                    </div>
                                                                                </div>

                                                                                <div class="widget-body">
                                                                                    <div class="widget-main padding-24">
                                                                                        <div class="row-fluid">
                                                                                            <div class="row-fluid">
                                                                                                <div class="span10 offset1">
                                                                                                    <form class="form-horizontal" id="" method="POST" action="Fanalisis/kebProses.php">
                                                                                                        <div class="span12">
                                                                                                            <div class="span6">
                                                                                                                <div class="control-group">
                                                                                                                    <label for="lokasi">
                                                                                                                        Nama Pelapor : <?php echo $result['nama_pelapor']; ?>
                                                                                                                    </label>
                                                                                                                </div>
                                                                                                            </div>
                                                                                                            <div class="span6">
                                                                                                                <div class="control-group">
                                                                                                                    <label for="lokasi">
                                                                                                                        No. Telp/Handphone : <?php echo $result['nomor_telp']; ?>
                                                                                                                    </label>
                                                                                                                </div>
                                                                                                            </div>
                                                                                                        </div>

                                                                                                        <div class="control-group">
                                                                                                            <label for="lokasi">
                                                                                                                Lokasi : 
                                                                                                                <?php echo $result['alamat_pelapor'] . ' Ds. ' . $result['DESA_NAMA'] . ', Kec. ' . $result['KECAMATAN_NAMA'] . ', Kab. Sidoarjo'; ?>
                                                                                                            </label>
                                                                                                        </div>

                                                                                                        <div class="control-group">
                                                                                                            <label for="bangunan">
                                                                                                                Bangunan Terbakar : <?php echo $result['NAMA_BANGUNAN']; ?>
                                                                                                            </label>
                                                                                                        </div>

                                                                                                        <div class="control-group">
                                                                                                            <label for="ket_bangunan">Keterangan Bangunan : </label>
                                                                                                            <ol>
                                                                                                            <li>Panjang dan Lebar Bangunan : <strong><?php echo $p . ' x ' . $l; ?> m<sup>2</sup></strong></li>
                                                                                                                <li><?php echo $result['exposure']; ?></li>
                                                                                                                <li><?php echo $result['tepol']; ?></li>
                                                                                                                <?php if ($result['KET_BANGUNAN'] == '') { ?>
                                                                                                                    <li>Deskripsi Bangunan : - </li>
                                                                                                                <?php } else { ?>
                                                                                                                    <li>Deskripsi Bangunan : <?php echo $result['KET_BANGUNAN']; ?> </li>
                                                                                                                <?php } ?>        
                                                                                                            </ol>
                                                                                                        </div>

                                                                                                        <div class="control-group">
                                                                                                            <label for="sumber_air">
                                                                                                                Sumber Air Terdekat : <b><?php echo $result['NAMA_SUMBER']; ?></b><br/>
                                                                                                                Jarak Lokasi ke Sumber Air (D1) : <b><span id="jarak_1"></span> Km</b><br/>
                                                                                                                Kecepatan Konstan Kendaraan Menuju Sumber Air : <b><span id="kec1"></span> Km/jam</b><br/>
                                                                                                                Jarak Lokasi Kembali dari Sumber Air (D2) : <b><span id="jarak_2"></span> Km</b><br/>
                                                                                                                Kecepatan Konstan Kendaraan Kembali dari Sumber Air : <b><span id="kec2"></span> Km/jam</b>
                                                                                                            </label>
                                                                                                        </div>

                                                                                                        <div class="control-group">
                                                                                                            <label class="control-label" for="jarak1">Pasokan Air Minimum :</label>
                                                                                                            <div class="controls">
                                                                                                                <input class="span3" type="text" value="<?php echo round($result['pasokan_air_minimum'] / 264.172052, 1, PHP_ROUND_HALF_DOWN); ?>" readonly/> m<sup>3</sup> atau
                                                                                                                <input class="span3" type="text" value="<?php echo $result['pasokan_air_minimum']; ?>" readonly/> US Galon
                                                                                                            </div>
                                                                                                        </div>

                                                                                                        <div class="control-group">
                                                                                                            <label class="control-label" for="jarak1">Laju Penerapan Air :</label>
                                                                                                            <div class="controls">
                                                                                                                <?php if ($sama == 'sama') { ?>
                                                                                                                    <input class="span3" type="text" value="<?php echo $laju; ?>" readonly/> liter/menit atau
                                                                                                                    <input class="span3" type="text" value="<?php echo $laju_galon; ?>" readonly/> US Galon/menit
                                                                                                                <?php } else if ($sama == 'tidak sama') { ?>
                                                                                                                    <input class="span3" type="text" value="<?php echo $laju2; ?>" readonly/> liter/menit atau
                                                                                                                    <input class="span3" type="text" value="<?php echo $laju_galon2; ?>" readonly/> US Galon/menit
                                                                                                                <?php } ?>
                                                                                                            </div>
                                                                                                        </div>

                                                                                                        <div class="control-group">
                                                                                                            <label for="jarak1">Potensi Pengangkutan Air :
                                                                                                                <input class="span1" id="hasil" name="hasil" type="text" value="" readonly/> gpm</b>, kemampuan aliran maksimum 
                                                                                                                yang terus menerus yang tersedia dari kendaraan pemasok air berkapasitas <span id="liter"></span> liter.
                                                                                                            </label>
                                                                                                        </div>

                                                                                                        <div class="">
                                                                                                            <div class="pull-right">
                                                                                                                <!--<button class="btn">
                                                                                                                    <i class="icon-arrow-left bigger-110"></i>
                                                                                                                    Kembali
                                                                                                                </button>-->
                                                                                                                &nbsp; &nbsp; &nbsp;
                                                                                                                <button class="btn btn-info" type="submit">
                                                                                                                    <i class="icon-ok"></i>
                                                                                                                    Submit
                                                                                                                </button>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                    </form>
                                                                                                </div><!--/span-->
                                                                                            </div><!--row-->

                                                                                            <div class="space-6"></div>

                                                                                            <div class="row-fluid">
                                                                                                <div class="span12 well center">
                                                                                                    Analisa Resiko Bencana Kebakaran Berdasarkan PERMEN PU No. 20 Tahun 2009 
                                                                                                    Tentang Pedoman Teknis Manajemen Proteksi Kebakaran di Perkotaan.
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div><!--END RESULT--> 
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div><!-- end span12 --> 
                                            </div><!-- end row-fluid --> 
                                        </form>

                                        <div id="penerapan" class="modal hide fade" tabindex="-1">
                                            <div class="modal-header no-padding">
                                                <div class="table-header">
                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>

                                                    <dd align="center">Laju Penerapan Air</dd>
                                                    <dd align="center">
                                                        (&nbsp;
                                                        <i>Application rate</i>
                                                        &nbsp;)
                                                    </dd>
                                                </div>
                                            </div>

                                            <div class="modal-body no-padding">
                                                <div class="row-fluid">
                                                    <dd>
                                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Kebutuhan pasokan air total bersama dengan laju pengiriman didasarkan kepada jumlah maksimum air yang akan diperlukan untuk mengendalikan sebuah kebakaran struktur/bangunan.
                                                    </dd>
                                                    <ol>
                                                        <li>
                                                            Laju penerapan air (dalam satuan liter) ditentukan berdasarkan rumus sebagai berikut :
                                                        </li>
                                                        <p align="center">
                                                            <img src="../assets/img/penerapanAir(l).JPG"></p>
                                                        <li>
                                                            Laju penerapan air (dalam satuan US galon) ditentukan berdasarkan rumus sebagai berikut :
                                                        </li>
                                                        <p align="center">
                                                            <img src="../assets/img/penerapanAir(galon).JPG"></p>
                                                    </ol>
                                                    <p align="left">
                                                    <blockquote>
                                                        <small>
                                                            Berdasarkan PERMEN PU No. 20 Tahun 2009 Tentang Pedoman Teknis Manajemen Proteksi Kebakaran di Perkotaan.
                                                        </small>
                                                    </blockquote>
                                                    </p>
                                                </div>
                                            </div>

                                            <div class="modal-footer">
                                                <button class="btn btn-small btn-success pull-right" data-dismiss="modal">
                                                    <i class="icon-ok"></i>
                                                    Ok
                                                </button>
                                            </div>
                                        </div><!--PAGE CONTENT ENDS--> 
                                    </div><!--/.span--> 
                                </div><!--/.row-fluid--> 
                            </div><!--/.page-content-->
                            <?php
                            //include '../template/footer.php';
                        }
                    }
                }
                ?>
                <div class="ace-settings-container" id="ace-settings-container">
                    <div class="btn btn-app btn-mini btn-warning ace-settings-btn" id="ace-settings-btn">
                        <i class="icon-cog bigger-150"></i>
                    </div>

                    <div class="ace-settings-box" id="ace-settings-box">
                        <div>
                            <div class="pull-left">
                                <select id="skin-colorpicker" class="hide">
                                    <option data-class="default" value="#438EB9" />#438EB9
                                    <option data-class="skin-1" value="#222A2D" />#222A2D
                                    <option data-class="skin-2" value="#C6487E" />#C6487E
                                    <option data-class="skin-3" value="#D0D0D0" />#D0D0D0
                                </select>
                            </div>
                            <span>&nbsp; Choose Skin</span>
                        </div>

                        <div>
                            <input type="checkbox" class="ace-checkbox-2" id="ace-settings-rtl" />
                            <label class="lbl" for="ace-settings-rtl">Right To Left (rtl)</label>
                        </div>
                    </div>
                </div>
                <!--/#ace-settings-container--> </div>
            <!--/.main-content--> </div>
        <!--/.main-container-->

        <a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-small btn-inverse">
            <i class="icon-double-angle-up icon-only bigger-110"></i>
        </a>

        <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>

        <!--<![endif]-->

        <!--[if !IE]>
        -->
        <script type="text/javascript">
                                                                                                window.jQuery || document.write("<script src='../assets/js-ace/jquery-2.0.3.min.js'>" + "<" + "/script>");
        </script>

        <!--<![endif]-->

        <script type="text/javascript">
            if ("ontouchend" in document)
                document.write("<script src='../assets/js-ace/jquery.mobile.custom.min.js'>" + "<" + "/script>");</script>
        <script src="../assets/js-ace/bootstrap.min.js"></script>

        <!--page specific plugin scripts-->
        <script src="../assets/js-ace/jquery-ui-1.10.3.custom.min.js"></script>
        <script src="../assets/js-ace/jquery.ui.touch-punch.min.js"></script>
        <script src="../assets/js-ace/chosen.jquery.min.js"></script>
        <script src="../assets/js-ace/jquery.slimscroll.min.js"></script>
        <script src="../assets/js-ace/jquery.validate.min.js"></script>
        <script src="../assets/js-ace/autoNumeric.js"></script>
        <!--ace scripts-->

        <script src="../assets/js-ace/ace-elements.min.js"></script>
        <script src="../assets/js-ace/ace.min.js"></script>

        <script>
            // ========================Jam========================================== //
            function showTime() {
                var a_p = "";
                var today = new Date();
                var curr_hour = today.getHours();
                var curr_minute = today.getMinutes();
                var curr_second = today.getSeconds();
                if (curr_hour < 12) {
                    a_p = "AM";
                } else {
                    a_p = "PM";
                }
                if (curr_hour == 0) {
                    curr_hour = 12;
                }
                if (curr_hour > 12) {
                    curr_hour = curr_hour - 12;
                }
                curr_hour = checkTime(curr_hour);
                curr_minute = checkTime(curr_minute);
                curr_second = checkTime(curr_second);
                document.getElementById('clock').innerHTML = curr_hour + ":" + curr_minute + ":" + curr_second + " " + a_p;
            }

            function checkTime(i) {
                if (i < 10) {
                    i = "0" + i;
                }
                return i;
            }
            setInterval(showTime, 500);
// ========================Akhir Jam========================================== //
            jQuery(function($) {
                $('.auto').autoNumeric('init');
            });

            // scrollables
            $('.slim-scroll').each(function() {
                var $this = $(this);
                $this.slimScroll({
                    height: $this.data('height') || 100,
                    railVisible: true
                });
            });

            function run() {
                document.getElementById("kec1").innerHTML = document.getElementById('kecepatan_air').value;
                document.getElementById("jarak_1").innerHTML = document.getElementById('jarak1').value;
                document.getElementById("kec2").innerHTML = document.getElementById('kecepatan_back').value;
                document.getElementById("jarak_2").innerHTML = document.getElementById('jarak2').value;
                document.getElementById("liter").innerHTML = document.getElementById('v_potensi').value;
            }


            function hitung() {
                //var vol = document.getElementById('v_potensi').value;
                //var a = document.getElementById('a_potensi').value;
                //var b = document.getElementById('b_potensi').value;
                var kecKm1 = document.getElementById('kecepatan_air').value;
                var kecKm2 = document.getElementById('kecepatan_back').value;
                var d1 = document.getElementById('jarak1').value;
                var d2 = document.getElementById('jarak2').value;
                //var t1Ulang = document.getElementById('t1-potensi-ulang').value;
                //var t2Ulang = document.getElementById('t2-potensi-ulang').value;
                var t1 = document.getElementById('t1_potensi');
                var t2 = document.getElementById('t2_potensi');
                //var hasil = document.getElementById('aliran');
                //convert liter to galon
                //var galon = Math.round(vol * 0.264172051);
                //convert Km/jam to mph 
                var kecMph1 = Math.round(kecKm1 * 0.621371192);
                var kecMph2 = Math.round(kecKm2 * 0.621371192);
                //convert liter to miles
                var d1Miles1 = d1 * 0.621371192;
                var d1Miles2 = d2 * 0.621371192;
                var x1 = 60 / kecMph1;
                var x2 = 60 / kecMph2;
                var kali1 = x1.toFixed(1) * d1Miles1.toFixed(2);
                var kali2 = x2.toFixed(1) * d1Miles2.toFixed(2);
                var hasil1 = 0.65 + kali1;
                var hasil2 = 0.65 + kali2;
                var tmp1 = hasil1.toFixed(2);
                var tmp2 = hasil2.toFixed(2);
                //var sum = a + t1Ulang + t2Ulang + b;
                //var dev = galon / sum;
                //var result = Math.round(dev - 0.1);
                t1.value = tmp1;
                t2.value = tmp2;
                //hasil.value = result;
            }

        </script>
        <script type="text/javascript">
            $(document).ready(function()
            {
                function hitung_()
                {
                    var kec1 = parseFloat($('#kecepatan_air').val());
                    var kec2 = parseFloat($('#kecepatan_back').val());
                    var jarak1 = parseFloat($('#jarak1').val());
                    var jarak2 = parseFloat($('#jarak2').val());
                    var vol = parseFloat($('#v_potensi').val());
                    var a = parseFloat($('#a_potensi').val());
                    var b = parseFloat($('#b_potensi').val());
                    var t1 = parseFloat($('#t1_potensi').val());
                    var t2 = parseFloat($('#t2_potensi').val());
                    //convert liter to galon
                    var galon = Math.round(vol * 0.264172051);
                    //total
                    var sum = a + t1 + t2 + b;
                    var dev = galon / sum;
                    var result = Math.round(dev - 0.1);
                    $("#aliran").val(result);
                    $("#hasil").val(result);
                    $("#liter").val(vol);
                    $("#jarak_2").val(jarak2);
                    $("#jarak_1").val(jarak1);
                    $("#kec1").val(kec1);
                    $("#kec2").val(kec2);
                }
                $(document).on("change, keyup", "#v_potensi,#a_potensi,#b_potensi, #t1_potensi_ulang, #t2_potensi_ulang", hitung_);
            });
        </script>
        <script type="text/javascript">
            function changeImage(url) {
                var img = document.getElementById('gambar2');
                img.src = url;
            }
        </script>
    </body>
</html>
