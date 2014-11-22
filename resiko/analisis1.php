<?php
//include '../template/header.php';
session_start();
//error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
include ("../config/koneksi.php");
include '../config/functions.php'; //include function.php - very important

if (!loggedin()) { // check if the user is logged in, but if it isn't, it will redirect to the Login Form page. Noticed the difference?
    header("Location: ../login/login.php");
    exit();
}

if($_SESSION['level']!=1 && $_COOKIE['level'] != 1){
    //alert('Maaf Anda tidak diperkenankan mengakses halaman tersebut');
    echo "<script> window.history.back(); </script>";
    exit();//jika bukan admin jangan lanjut
}

if ((isset($_SESSION['pegawai_nomor']) && isset($_SESSION['level'])) || (isset($_COOKIE['level']) && isset($_COOKIE['pegawai_nomor']))) {
    $sql = mysql_query("SELECT * FROM pegawai WHERE (pegawai_nip='" . $_SESSION['pegawai_nomor'] . "' AND id_level_user='".$_SESSION['level']."') 
                        OR (pegawai_nip='" . $_COOKIE['pegawai_nomor'] . "' AND id_level_user='".$_COOKIE['level']."')") or die("Query : ".mysql_error());
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
                    <style>
                       #map_canvas {
                            position:absolute;                           
                            margin-top:-10px;
                        }
                    </style>
                    <script src="https://maps.googleapis.com/maps/api/js?v=3.exp"></script>
                    <script type="text/javascript">
                        var geocoder = new google.maps.Geocoder();

                        function geocodePosition(pos) {
                            geocoder.geocode({
                                latLng: pos
                            }, function (responses) {
                                if (responses && responses.length > 0) {
                                    updateMarkerAddress(responses[0].formatted_address);
                                } else {
                                    updateMarkerAddress('Cannot determine address at this location.');
                                }
                            });
                        }

                        function updateMarkerStatus(str) {
                            document.getElementById('markerStatus').innerHTML = str;
                        }

                        function updateMarkerPosition(latLng) {
                            document.getElementById('info').innerHTML = [
                                latLng.lat(),
                                latLng.lng()
                            ].join(', ');
                        }

                        function updateMarkerAddress(str) {
                            document.getElementById('address').innerHTML = str;
                        }

                        function initialize() {
                            var latLng = new google.maps.LatLng(-7.413861041296166, 112.73011093392938);
                            var map = new google.maps.Map(document.getElementById('map_canvas'), {
                                zoom: 10,
                                center: latLng,
                                mapTypeId: google.maps.MapTypeId.ROADMAP
                            });
                            var marker = new google.maps.Marker({
                                position: latLng,
                                title: 'Dinas Pemadam Kebakaran Kab. Sidoarjo.',
                                map: map,
                                draggable: true
                            });

                            // Update current position info.
                            updateMarkerPosition(latLng);
                            geocodePosition(latLng);

                            // Add dragging event listeners.
                            google.maps.event.addListener(marker, 'dragstart', function () {
                                updateMarkerAddress('Dragging...');
                            });

                            google.maps.event.addListener(marker, 'drag', function () {
                                updateMarkerStatus('Dragging...');
                                updateMarkerPosition(marker.getPosition());
                            });

                            google.maps.event.addListener(marker, 'dragend', function () {
                                updateMarkerStatus('Drag ended');
                                geocodePosition(marker.getPosition());
                            });
                        }

            // Onload handler to fire off the app.
                        google.maps.event.addDomListener(window, 'load', initialize);
                    </script>
                </head>
                <body tracingsrc="../assets/img/sda/potensi.jpg" tracingopacity="100">

                    <div class="navbar">
                        <div class="navbar-inner">
                            <div class="container-fluid">
                                <a href="../beranda/index" class="brand">
                                    <small>
                                        <i class="icon-fire-extinguisher"></i>
                                        SIM Proteksi Kebakaran Perkotaan Kab. Sidoarjo 
                                    </small>
                                </a><!--/.brand-->

                                <ul class="nav ace-nav pull-right">
                                <?php
                                    $level = $row['id_level_user'];
                                    $jabatan = $row['jabatan_id'];
                                    if($level == 1 || $level == 3){
                                ?>
                                <li class="green">
                                    <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                                        <i class="icon-envelope icon-animated-vertical"></i>
                                        <?php
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
                                            $q_pesan = mysql_query("SELECT b.id, b.pesan_id, b.pesan_dari, b.pesan_isi, a.resiko_tanggal_start, c.pegawai_nama
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
                                            <a href="../pesan/detail?id=<?php echo $pesan['pesan_id'].'&no='.$pesan['id'];?>">
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
                                <?php }else{ ?>
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
                                <?php } ?>
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
                                    <li class="active">Analisis Resiko Kebakaran</li>
                                </ul>
                                <!--.breadcrumb-->
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
                                            Analisis Resiko Kebakaran
                                        </small>
                                    </h1>
                                </div>
                                <!--/.page-header-->

                                <div class="row-fluid">
                                    <div class="span12">
                                        <!--PAGE CONTENT BEGINS-->
                                        <div class="row-fluid">
                                            <div class="span12">
                                                <div class="widget-box">
                                                    <div class="widget-header widget-hea1der-small header-color-red">
                                                        <h6>
                                                            Peta Kabupaten Sidoarjo
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
                                                                    <div id="map_canvas" style="width:100%;height:100%;"></div>
                                                                        <!--<img src="../assets/img/sda/large/" width="829" height="441" id="gambar2"></p>-->
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>


                                                <!--<p align="center">
                                                    <div id="map-canvas"></div>
                                                </p>
                                                <div class="space-32"></div>
                                                <div class="space-32"></div><div class="space-32"></div>
                                                <div class="space-32"></div><div class="space-32"></div>
                                                <div class="space-32"></div><div class="space-32"></div>
                                                <div class="space-32"></div><div class="space-32"></div>
                                                <div class="space-32"></div><div class="space-32"></div>
                                                <div class="space-32"></div><div class="space-32"></div>-->
                                            </div><!-- end span 12 --> 
                                        </div><!-- end row fluid -->
                                        <div class="space-6"></div>
                                        <?php
                                        if (isset($_GET['msg'])) {
                                            if ($_GET['msg'] == 'error1') {
                                                ?>
                                                <div class="alert alert-block alert-error">
                                                    <button type="button" class="close" data-dismiss="alert">
                                                        <i class="icon-remove"></i>
                                                    </button>

                                                    <i class="icon-remove"></i>
                                                    Maaf, terjadi kesalahan kalkulasi analisa resiko. Mohon untuk diulangi sekali lagi.
                                                </div>
                                                <?php
                                            } else if ($_GET['msg'] == 'error2') {
                                                ?>
                                                <div class="alert alert-block alert-error">
                                                    <button type="button" class="close" data-dismiss="alert">
                                                        <i class="icon-remove"></i>
                                                    </button>

                                                    <i class="icon-remove"></i>
                                                    Maaf, nama bangunan baru kembar. Silahkan ulangi !
                                                </div>
                                                <?php
                                            } else if ($_GET['msg'] == 'error3') {
                                                ?>
                                                <div class="alert alert-block alert-error">
                                                    <button type="button" class="close" data-dismiss="alert">
                                                        <i class="icon-remove"></i>
                                                    </button>

                                                    <i class="icon-remove"></i>
                                                    Mohon untuk menggunakan <strong class="red">angka</strong> dalam field No. Telp/Handphone, panjang, lebar, dan tinggi. Silahkan ulangi !
                                                </div>
                                                <?php
                                            }
                                        }
                                        ?>
                                        <div class="space-6"></div>
                                        <form class="form-horizontal" id="validation-form" method="POST" action="Fanalisis/analisisProses.php">
                                            <div class="row-fluid">
                                                <div class="span12">
                                                    <div class="span6">
                                                        <div class="widget-box transparent">
                                                            <div class="widget-header header-color-blue2">
                                                                <h3>Lokasi Kejadian Kebakaran</h3>
                                                            </div>

                                                            <div class="widget-body">
                                                                <div class="widget-main padding-4">
                                                                    <div class="content">
                                                                        <div class="space-6"></div>
                                                                        <div id="frm-lokasi">
                                                                            <div class="control-group">
                                                                                <label class="control-label">Nama Pelapor :</label>
                                                                                <div class="controls">
                                                                                    <input type="text" autocomplete="off" name="pelapor" id="pelapor" placeholder="Nama Pelapor..." value="">
                                                                                </div>
                                                                            </div>

                                                                            <div class="control-group">
                                                                                <label class="control-label">No Telp/Handphone :</label>
                                                                                <div class="controls">
                                                                                    <input type="text" autocomplete="off" name="telp" id="telp" placeholder="Nomor Telepon..." class="input-mask-phone">
                                                                                </div>
                                                                            </div>

                                                                            <div class="control-group">
                                                                                <label class="control-label" for="nama_sumber">Koordinat : </label>

                                                                                <div class="controls">
                                                                                    <b>Marker status:</b>
                                                                                    <div id="markerStatus"><i>Click and drag the marker.</i></div>
                                                                                    <b>Current position:</b>
                                                                                    <div id="info"></div>
                                                                                    <b>Closest matching address:</b>
                                                                                    <div id="address"></div>
                                                                                </div>
                                                                            </div>

                                                                            <div class="control-group">
                                                                                <label class="control-label" for=""> </label>

                                                                                <div class="controls">
                                                                                    <input type="text" class="span5" name="lat" id="lat" placeholder="Latitude...">
                                                                                    <input type="text" class="span5" name="long_" id="long_" placeholder="Longitude...">
                                                                                    <span class="lbl">
                                                                                        <a href="#help" role="button" class="green" data-toggle="modal">
                                                                                            <span class="help-button" data-rel="tooltip" data-placement="top" title="Help">?</span>
                                                                                        </a>
                                                                                    </span>
                                                                                </div>
                                                                            </div>

                                                                            <div class="control-group">
                                                                                <label class="control-label">Jalan :</label>
                                                                                <div class="controls">
                                                                                    <textarea name="jalan" id="jalan" placeholder="Jalan..."></textarea>
                                                                                    <!--<input type="text" name="jalan" id="Jalan" placeholder="Jalan..." value="">-->
                                                                                </div>
                                                                            </div>

                                                                            <div class="control-group">
                                                                                <label class="control-label" for="kecamatan">Pilih Kecamatan :</label>
                                                                                <?php
                                                                                $query_parent = mysql_query("SELECT * FROM kecamatan") or die("Query failed: " . mysql_error());
                                                                                ?>
                                                                                <div class="controls">
                                                                                    <span>
                                                                                        <select name="kecamatan" id="kecamatan" data-placeholder="Pilih Kecamatan...">
                                                                                            <option value="" />
                                                                                            Pilih Kecamatan...
                                                                                            <?php while ($row = mysql_fetch_array($query_parent)): ?>
                                                                                                <option value="<?= $row['KECAMATAN_ID']; ?>"><?php echo $row['KECAMATAN_NAMA']; ?></option>
                                                                                            <?php endwhile; ?>
                                                                                        </select>
                                                                                    </span>
                                                                                </div>
                                                                            </div>

                                                                            <div class="control-group">
                                                                                <label class="control-label" for="desa">Pilih Desa :</label>
                                                                                <div class="controls">
                                                                                    <span>
                                                                                        <select name="desa" id="desa">
                                                                                            <option value=""  />
                                                                                            PIlih Desa...
                                                                                        </select>
                                                                                    </span>
                                                                                </div>
                                                                            </div>

                                                                            <div class="control-group">
                                                                                <label class="control-label" for="sumber_air">Sumber Air :</label>
                                                                                <div class="controls">
                                                                                    <span>
                                                                                        <input type="hidden" name="sumber_air" id="text_content" value="" />
                                                                                        <select id="sumber_air" name="sumber_air_" onclick ="document.getElementById('text_content').value = this.options[this.selectedIndex].text">
                                                                                            <option value="" />
                                                                                            Sumber Air...
                                                                                        </select>
                                                                                    </span>
                                                                                </div>
                                                                            </div>

                                                                            <div class="control-group">
                                                                                <label class="control-label" for="sumber_air">Tipe Proteksi Kebakaran :</label>
                                                                                <div class="controls">
                                                                                    <span>
                                                                                        <select id="tipe_proteksi" name="tipe_proteksi">
                                                                                            <option value="" />Tipe Proteksi...
                                                                                            <option value="MPKP" />MPKP (Kota)
                                                                                            <option value="MPKL" />MPKL (Lingkungan)
                                                                                            <option value="MPKBG" />MPKBG (Bangunan Gedung)
                                                                                        </select>
                                                                                    </span>
                                                                                </div>
                                                                            </div>

                                                                            <div class="control-group">
                                                                                <label class="control-label">Jumlah Kebutuhan Air :</label>

                                                                                <div class="controls">
                                                                                    <span class="span12">
                                                                                        <label>
                                                                                            <input onchange='check_value();' name="exposure" value="1" type="radio"/>
                                                                                            <span class="lbl"> <b class="text-error">Tanpa</b> resiko bangunan berdekatan.
                                                                                                <a href="#tanpa" role="button" class="green" data-toggle="modal">
                                                                                                    <span class="help-button" data-rel="tooltip" data-placement="top" title="More details.">?</span>
                                                                                                </a>
                                                                                            </span>
                                                                                        </label>

                                                                                        <label>
                                                                                            <input onchange='check_value();' name="exposure" value="2" type="radio"/>
                                                                                            <span class="lbl"> <b class="text-error">Dengan</b> resiko bangunan berdekatan.
                                                                                                <a href="#dengan" role="button" class="green" data-toggle="modal">
                                                                                                    <span class="help-button" data-rel="tooltip" data-placement="bottom" title="More details.">?</span>
                                                                                                </a>
                                                                                            </span>
                                                                                        </label>
                                                                                    </span>
                                                                                </div>
                                                                            </div>

                                                                            <div class="control-group">
                                                                                <label class="control-label red">Penggunaan Bahan Khusus Pemadam Api:</label>

                                                                                <div class="controls">
                                                                                    <span class="span12">
                                                                                        <label>
                                                                                            <input name="tepol" value="<b>Menggunkan</b> Tepol (Cairan Basa)" type="radio"/>
                                                                                            <span class="lbl">Ya</span>
                                                                                        </label>
                                                                                        <label>
                                                                                            <input name="tepol" value="<b>Tidak</b> Menggunakan Tepol" type="radio"/>
                                                                                            <span class="lbl">Tidak</span>
                                                                                        </label>
                                                                                    </span>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!-- Tanpa Faktor Bahaya -->
                                                    <div class="span6" id="widget_tanpa">
                                                        <div class="widget-box transparent">
                                                            <div class="widget-body">
                                                                <div class="widget-main padding-4">
                                                                    <div class="content">
                                                                        <div class="space-6"></div>
                                                                        <p align="center" class="text-error">
                                                                            Pasokan Air Minimum Tanpa Resiko Bangunan Berdekatan.<hr>
                                                                        </p>

                                                                        <div class="control-group">
                                                                            Rumus Pasokan Air Minimum :
                                                                            <p align="center"><img src="../assets/img/pam1.jpg"></p>
                                                                        </div>

                                                                        <div class="control-group">
                                                                            <label class="control-label" for="tipe-bangunan">
                                                                                Tipe Bangunan :
                                                                                <br />
                                                                                <small>(Angka Klasifikasi Resiko Kebakaran)</small>
                                                                            </label>
                                                                            <?php
                                                                            $bangunan1 = mysql_query("SELECT b.NAMA_MASTER, a.NAMA_BANGUNAN, a.TINGKAT_BANGUNAN FROM bangunan AS a
                                                                                                        INNER JOIN master_bangunan AS b ON (a.ID_MASTER = b.ID_MASTER)
                                                                                                        ORDER BY a.NAMA_BANGUNAN ASC")or die("Query failed: " . mysql_error());
                                                                            $group1 = array();
                                                                            //$bangunan1 = mysql_query("SELECT * FROM bangunan ORDER BY NAMA_BANGUNAN ASC") or die("Query failed: " . mysql_error());
                                                                            ?>
                                                                            <div class="controls">
                                                                                <select id="bangunan_tanpa" onchange="run();
                                                                                        document.getElementById('nama_tipe1').value = this.options[this.selectedIndex].text" data-placeholder="Pilih Bangunan...">
                                                                                    <option value="">Pilih Bangunan...</option>
                                                                                    <?php 
                                                                                        while ($r = mysql_fetch_assoc($bangunan1)){
                                                                                            $group1[$r['NAMA_MASTER']][] = $r;
                                                                                        }
                                                                                        foreach ($group1 as $key => $value) {
                                                                                             echo '<optgroup label="'.$key.'">';
                                                                                             foreach ($value as $values) {
                                                                                                 echo "<option value=".$values['TINGKAT_BANGUNAN'].">".$values['NAMA_BANGUNAN']."";
                                                                                             }
                                                                                             echo '</optgroup>';
                                                                                         } 
                                                                                    ?>
                                                                                        <!--<option value="<?php //echo $r['TINGKAT_BANGUNAN']; ?>"><?php //echo $r['NAMA_BANGUNAN']; ?></option>-->
                                                                                    <?php //} ?>
                                                                                </select>
                                                                                <input type="hidden" name="nama_tipe1" id="nama_tipe1" value="" />
                                                                                <input name="nilai_bangunan1" class="span2" id="angka_tanpa" type="number" value="" readonly="readonly"/>
                                                                                <input name="check" class="ace-switch ace-switch-5" type="checkbox" onclick="showMe('tipe_baru', 'hasil_tanpa_', 'hasil_tanpa_1')" data-rel="tooltip" title="Tipe bangunan tidak terdapat dalam list ?!" data-placement="bottom"/>
                                                                                <span class="lbl"><strong class="red">*</strong></span>
                                                                            </div>
                                                                        </div>

                                                                        <div id="tipe_baru" style="display:none">
                                                                            <div class = "control-group">
                                                                                <label class = "control-label" for = "nama_tipe_baru">Tipe bangunan baru:</label>

                                                                                <div class = "controls">
                                                                                    <select name = "master" id="master">
                                                                                        <option value=""/>Pilih Tipe Bangunan . . .
                                                                                        <option value="1">Perkantoran
                                                                                        <option value="2">Usaha Dagang dan Jasa
                                                                                        <option value="3">Industri
                                                                                        <option value="4">Kendaraan Bermotor
                                                                                        <option value="5">Rumah
                                                                                        <option value="6">Lahan / Sawah
                                                                                    </select>
                                                                                </div>
                                                                                <div class="space-6"></div>
                                                                                <div class = "controls">
                                                                                    <input type = "text" id="nama_tipe_baru1" name = "nama_tipe_baru1" />
                                                                                    <select name = "nilai_tipe_baru1" id="nilai_tipe_baru1" class="span2">
                                                                                        <option value=""/>---
                                                                                        <option value="3">3
                                                                                        <option value="4">4
                                                                                        <option value="5">5
                                                                                        <option value="6">6
                                                                                        <option value="7">7
                                                                                    </select>
                                                                                    &nbsp; <strong class="red">*</strong>
                                                                                </div>
                                                                            </div>
                                                                        </div>

                                                                        <div class="control-group">
                                                                            <label class="control-label" for="angka-kostruksi">Angka Klasifikasi Konstruksi  :</label>
                                                                            <div class="controls">
                                                                                <select name="angka_konstruksi1" id="angka-kostruksi_tanpa" onchange="go();">
                                                                                    <option value="" />Pilih Faktor Bahaya...
                                                                                    <option value="0.5">Konstruksi tahan api
                                                                                    <option value="0.75">Konstruksi kayu berat (tidak mudah terbakar)
                                                                                    <option value="1.0">Konstruksi biasa
                                                                                    <option value="1.5">Konstruksi kerangka kayu (mudah terbakar)
                                                                                </select>

                                                                                <input class="span2" name="angka_kostruksi1" value="" id="faktor-konstruksi_tanpa" type="text" readonly="readonly"/>
                                                                            </div>
                                                                        </div>

                                                                        <div class="control-group">
                                                                            <label class="control-label" for="volume">Volume Bangunan :</label>
                                                                            <div class="controls">
                                                                                <input name="panjang1"class="span2 auto" id="panjang_tanpa" type="text" placeholder="Panjang" data-a-sep=""/>x
                                                                                <input name="lebar1" class="span2 auto" id="lebar_tanpa" type="text" placeholder="Lebar" data-a-sep=""/>x
                                                                                <input name="tinggi1" class="span2 auto" id="tinggi_tanpa" type="text" placeholder="Tinggi" data-a-sep=""/>(Satuan meter)&nbsp;<strong class="red">**</strong>
                                                                            </div>
                                                                        </div>

                                                                        <div id="hasil_tanpa_1">
                                                                            <div class="control-group">
                                                                                <label class="control-label" for="volume">Pasokan Air Minimum :</label>
                                                                                <div class="controls">
                                                                                    <input class="span3" id="hasil_tanpa" name="hasil1" type="text" value="" readonly/>
                                                                                    &nbsp;US Galon atau
                                                                                    <input class="span2" id="hasil_tanpa1" type="text" value="" readonly/>
                                                                                    &nbsp;m <sup>3</sup>
                                                                                </div>
                                                                            </div>
                                                                        </div>

                                                                        <div id="hasil_tanpa_" style="display:none">
                                                                            <div class="control-group">
                                                                                <label class="control-label" for="volume">Pasokan Air Minimum :</label>
                                                                                <div class="controls">
                                                                                    <input class="span3" id="hTanpa" name="hasil1_" type="text" value="" readonly/>
                                                                                    &nbsp;US Galon atau
                                                                                    <input class="span2" id="hTanpa1" type="text" value="" readonly/>
                                                                                    &nbsp;m <sup>3</sup>
                                                                                </div>
                                                                            </div>
                                                                        </div>

                                                                        <div class="control-group">
                                                                            <label for="volume">
                                                                                <small> <u><strong>Note :</strong></u> 
                                                                                </small>
                                                                            </label>
                                                                            <label for="note">
                                                                                &nbsp;&nbsp;
                                                                                <strong class="red">*</strong>
                                                                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                                                <small>
                                                                                    Semaikin kecil nilai tipe bangunan semakin berbahaya kebakaran yang terjadi.
                                                                                </small>
                                                                            </label>
                                                                            <label for="note">
                                                                                &nbsp;&nbsp;
                                                                                <strong class="red">**</strong>
                                                                                &nbsp;&nbsp;
                                                                                <small>Gunakan . (titik) untuk koma.</small>
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- Dengan Faktor Bahaya -->
                                                    <div class="span6" id="widget_dengan">
                                                        <div class="widget-box transparent">
                                                            <div class="widget-body">
                                                                <div class="widget-main padding-4">
                                                                    <div class="content">
                                                                        <div class="space-6"></div>
                                                                        <p align="center" class="text-error">
                                                                            Pasokan Air Minimum Dengan Resiko Bangunan Berdekatan.<hr>
                                                                        </p>

                                                                        <div class="control-group">
                                                                            Rumus Pasokan Air Minimum :
                                                                            <p align="center"><img src="../assets/img/pam2.jpg"></p>
                                                                        </div>

                                                                        <div class="control-group">
                                                                            <label class="control-label" for="tipe-bangunan">
                                                                                Tipe Bangunan :
                                                                                <br />
                                                                                <small>(Angka Klasifikasi Resiko Kebakaran)</small>
                                                                            </label>
                                                                            <?php
                                                                                $bangunan2 = mysql_query("SELECT b.NAMA_MASTER, a.NAMA_BANGUNAN, a.TINGKAT_BANGUNAN FROM bangunan AS a
                                                                                                        INNER JOIN master_bangunan AS b ON (a.ID_MASTER = b.ID_MASTER)
                                                                                                        ORDER BY a.NAMA_BANGUNAN ASC")or die("Query failed: " . mysql_error());
                                                                                $group2 = array();
                                                                            //$bangunan2 = mysql_query("SELECT * FROM bangunan ORDER BY NAMA_BANGUNAN ASC") or die("Query failed: " . mysql_error());
                                                                            ?>
                                                                            <div class="controls">
                                                                                <select id="bangunan_dengan" onchange="run();
                                                                                        document.getElementById('nama_tipe2').value = this.options[this.selectedIndex].text">
                                                                                    <option value="">Pilih Bangunan...</option>
                                                                                    <?php 
                                                                                        while ($r = mysql_fetch_assoc($bangunan2)){
                                                                                            $group2[$r['NAMA_MASTER']][] = $r;
                                                                                        }
                                                                                        foreach ($group2 as $key => $value) {
                                                                                             echo '<optgroup label="'.$key.'">';
                                                                                             foreach ($value as $values) {
                                                                                                 echo "<option value=".$values['TINGKAT_BANGUNAN'].">".$values['NAMA_BANGUNAN']."";
                                                                                             }
                                                                                             echo '</optgroup>';
                                                                                         } 
                                                                                    ?>
                                                                                    <!--<option value="" />Pilih Bangunan...
                                                                                    <?php //while ($r = mysql_fetch_array($bangunan2)): ?>
                                                                                        <option value="<?php //echo $r['TINGKAT_BANGUNAN']; ?>"><?php //echo $r['NAMA_BANGUNAN']; ?></option>-->
                                                                                    <?php //endwhile; ?>
                                                                                </select>
                                                                                <input type="hidden" name="nama_tipe2" id="nama_tipe2" value="" />
                                                                                <input class="span2" id="angka_dengan" name="nilai_bangunan2" type="text" value="" readonly="readonly"/>
                                                                                <input name="check2" class="ace-switch ace-switch-5" type="checkbox" onclick="showMe_('tipe_baru2', 'hasil_dengan_', 'hasil_dengan_1')" data-rel="tooltip" title="Tipe bangunan tidak terdapat dalam list ?!" data-placement="bottom"/>
                                                                                <span class="lbl"><strong class="red">*</strong></span>
                                                                            </div>
                                                                        </div>

                                                                        <div id="tipe_baru2" style="display:none">
                                                                            <div class = "control-group">
                                                                                <label class = "control-label" for = "nama_tipe_baru2">Tipe bangunan baru:</label>

                                                                                <div class = "controls">
                                                                                    <select name = "master1" id="master1">
                                                                                        <option value=""/>Pilih Tipe Bangunan . . .
                                                                                        <option value="1">Perkantoran
                                                                                        <option value="2">Usaha Dagang dan Jasa
                                                                                        <option value="3">Industri
                                                                                        <option value="4">Kendaraan Bermotor
                                                                                        <option value="5">Rumah
                                                                                        <option value="6">Lahan / Sawah
                                                                                    </select>
                                                                                </div>
                                                                                <div class="space-6"></div>
                                                                                <div class = "controls">
                                                                                    <input type = "text" id="nama_tipe_baru2" name = "nama_tipe_baru2" />
                                                                                    <select name = "nilai_tipe_baru2" id="nilai_tipe_baru2" class="span2">
                                                                                        <option value="">---
                                                                                        <option value="3">3
                                                                                        <option value="4">4
                                                                                        <option value="5">5
                                                                                        <option value="6">6
                                                                                        <option value="7">7
                                                                                    </select>
                                                                                    &nbsp;
                                                                                    <strong class="red">*</strong>
                                                                                </div>
                                                                            </div>
                                                                        </div>

                                                                        <div class="control-group">
                                                                            <label class="control-label" for="angka-kostruksi">Angka Klasifikasi Konstruksi  :</label>
                                                                            <div class="controls">
                                                                                <select name="angka_konstruksi2" id="angka-kostruksi_dengan" onchange="go();">
                                                                                    <option value="" />Pilih Faktor Bahaya...
                                                                                    <option value="0.5">Konstruksi tahan api
                                                                                    <option value="0.75">Konstruksi kayu berat (tidak mudah terbakar)
                                                                                    <option value="1.0">Konstruksi biasa
                                                                                    <option value="1.5">Konstruksi kerangka kayu (mudah terbakar)</select>

                                                                                <input name="angka_kostruksi2" class="span2" value="" id="faktor-konstruksi_dengan" type="text" readonly="readonly"/>
                                                                            </div>
                                                                        </div>

                                                                        <div class="control-group">
                                                                            <label for="faktor-bahaya">Faktor bahaya dari bangunan berdekatan bernilai : 1.5 kali</label>
                                                                            <input class="span3" type="hidden" name="faktor-bahaya" id="faktor-bahaya_dengan" value="1.5" />
                                                                        </div>

                                                                        <div class="control-group">
                                                                            <label class="control-label" for="volume">Volume Bangunan :</label>
                                                                            <div class="controls">
                                                                                <input data-a-sep="" name="panjang2" class="auto span2" id="panjang_dengan" type="text" placeholder="Panjang" />x
                                                                                <input data-a-sep="" name="lebar2" class="auto span2" id="lebar_dengan" type="text" placeholder="Lebar" />x
                                                                                <input data-a-sep="" class="auto span2" name="tinggi2" id="tinggi_dengan" type="text" placeholder="Tinggi" />(Satuan meter)&nbsp;
                                                                                <strong class="red">**</strong>
                                                                            </div>
                                                                        </div>

                                                                        <div id="hasil_dengan_1">
                                                                            <div class="control-group">
                                                                                <label class="control-label" for="volume">Pasokan Air Minimum :</label>
                                                                                <div class="controls">
                                                                                    <input class="span3" id="hasil_dengan" name="hasil2" type="text" value="" readonly/>&nbsp;US Galon atau
                                                                                    <input class="span2" id="hasil_dkubik"  type="text" value="" readonly/>&nbsp;m<sup>3</sup>
                                                                                </div>
                                                                            </div>
                                                                        </div>

                                                                        <div id="hasil_dengan_" style="display: none">
                                                                            <div class="control-group">
                                                                                <label class="control-label" for="volume">Pasokan Air Minimum :</label>
                                                                                <div class="controls">
                                                                                    <input class="span3" id="hDengan" name="hasil2_" type="text" value="" readonly/>&nbsp;US Galon atau
                                                                                    <input class="span2" id="h_dKubik"  type="text" value="" readonly/>&nbsp;m<sup>3</sup>
                                                                                </div>
                                                                            </div>
                                                                        </div>

                                                                        <div class="control-group">
                                                                            <label for="volume">
                                                                                <small> <u><strong>Note :</strong></u> 
                                                                                </small>
                                                                            </label>
                                                                            <label for="note">
                                                                                &nbsp;&nbsp;
                                                                                <strong class="red">*</strong>
                                                                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                                                <small>
                                                                                    Semaikin kecil nilai tipe banguanan semakin berbahaya kebakaran yang terjadi.
                                                                                </small>
                                                                            </label>
                                                                            <label for="note">
                                                                                &nbsp;&nbsp;
                                                                                <strong class="red">**</strong>
                                                                                &nbsp;&nbsp;
                                                                                <small>Gunakan . (titik) untuk koma.</small>
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- end row fliud --> </div>
                                            <div class="form-actions">
                                                <div class="pull-right">
                                                    <button class="btn" onclick="location.reload();">
                                                        <i class="icon-repeat bigger-110"></i>
                                                        Reset
                                                    </button>
                                                    &nbsp; &nbsp; &nbsp;
                                                    <button class="btn btn-info" type="submit">
                                                        Submit
                                                        <i class="icon-ok"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </form>

                                        <!--Modal-->
                                        <div id="tanpa" class="modal hide fade" tabindex="-1">
                                            <div class="modal-header no-padding">
                                                <div class="table-header">
                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>

                                                    <dd align="center">Rumus Perhitungan Pasokan Air Minimum</dd>
                                                    <dd align="center">(Tanpa Resiko Bangunan Berdekatan)</dd>
                                                </div>
                                            </div>

                                            <div class="modal-body no-padding">
                                                <div class="row-fluid">
                                                    <p>
                                                    <dd>
                                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Jumlah kebutuhan air minimum tersebut
                                                        <b>tanpa</b>
                                                        faktor resiko bangunan gedung berdekatan (
                                                        <i>exposure</i>
                                                        ) dinyatakan dengan rumus :
                                                    </dd>
                                                    </p>
                                                    <p align="center">
                                                        <img src="../assets/img/pam1.jpg"></p>
                                                    <br/>
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
                                        </div>
                                        <div id="dengan" class="modal hide fade" tabindex="-1">
                                            <div class="modal-header no-padding">
                                                <div class="table-header">
                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>

                                                    <dd align="center">Rumus Perhitungan Pasokan Air Minimum</dd>
                                                    <dd align="center">(Dengan Resiko Bangunan Berdekatan)</dd>
                                                </div>
                                            </div>

                                            <div class="modal-body no-padding">
                                                <div class="row-fluid">
                                                    <p>
                                                    <dd>
                                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Jumlah kebutuhan air minimum tersebut
                                                        <b>dengan</b>
                                                        faktor resiko bangunan gedung berdekatan (
                                                        <i>exposure</i>
                                                        ) dinyatakan dengan rumus :
                                                    </dd>
                                                    </p>
                                                    <p align="center">
                                                        <img src="../assets/img/pam2.jpg"></p>
                                                    <br/>
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
                                        </div>
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
                                        </div>
                                        <div id="help" class="modal hide fade" tabindex="-1">
                                            <div class="modal-header no-padding">
                                                <div class="table-header">
                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                    <dd>&nbsp;</dd>
                                                    <dd align="center">Latitude dan Longitude</dd>
                                                    <dd>&nbsp;</dd>
                                                </div>
                                            </div>

                                            <div class="modal-body no-padding">
                                                <div class="row-fluid">
                                                    <p>
                                                        <dd><b>Contoh : </b></dd>
                                                    </p>
                                                    <p align="center">
                                                        Koordinat:&nbsp;-7.413861041296166, 112.73011093392938
                                                    </p>
                                                    <p>
                                                        <dd>Latitude : &nbsp;-7.413861041296166</dd>
                                                        <dd>Longitude : &nbsp;112.73011093392938 </dd>
                                                    </p>
                                                    <br/>
                                                    <p align="left">
                                                    <blockquote>
                                                        <small>
                                                            Google Maps Api v3
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
                                        </div>
                                        <!--END Modal-->
                                        <!--PAGE CONTENT ENDS--> </div>
                                    <!--/.span--> </div>
                                <!--/.row-fluid--> </div>
                            <!--/.page-content-->
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
                                    <option data-class="default" value="#438EB9" />
                                    #438EB9
                                    <option data-class="skin-1" value="#222A2D" />
                                    #222A2D
                                    <option data-class="skin-2" value="#C6487E" />
                                    #C6487E
                                    <option data-class="skin-3" value="#D0D0D0" />
                                    #D0D0D0
                                </select>
                            </div>
                            <span>&nbsp; Choose Skin</span>
                        </div>

                        <div>
                            <input type="checkbox" class="ace-checkbox-2" id="ace-settings-rtl" />
                            <label class="lbl" for="ace-settings-rtl">Right To Left (rtl)</label>
                        </div>
                    </div>
                </div><!--/#ace-settings-container--> 
            </div><!--/.main-content--> 
        </div><!--/.main-container-->

        <a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-small btn-inverse">
            <i class="icon-double-angle-up icon-only bigger-110"></i>
        </a>

        <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
        <script type="text/javascript">
                                            window.jQuery || document.write("<script src='../assets/js-ace/jquery-2.0.3.min.js'>" + "<" + "/script>");</script>
        <script type="text/javascript">
            if ("ontouchend" in document)
                document.write("<script src='../assets/js-ace/jquery.mobile.custom.min.js'>" + "<" + "/script>");</script>
        <script src="../assets/js-ace/bootstrap.min.js"></script>

        <!--page specific plugin scripts-->
        <script src="../assets/js-ace/jquery-ui-1.10.3.custom.min.js"></script>
        <script src="../assets/js-ace/jquery.ui.touch-punch.min.js"></script>
        <script src="../assets/js-ace/chosen.jquery.min.js"></script>
        <script src="../assets/js-ace/jquery.slimscroll.min.js"></script>
        <script src="../assets/js-ace/bootstrap-tag.min.js"></script>
        <script src="../assets/js-ace/jquery.validate.min.js"></script>
        <script src="../assets/js-ace/autoNumeric.js"></script>
        <!--ace scripts-->

        <script src="../assets/js-ace/ace-elements.min.js"></script>
        <script src="../assets/js-ace/ace.min.js"></script>

        <script type="text/javascript">
            jQuery(function($) {
                $('.auto').autoNumeric('init');
            });
        </script>
        <script type="text/javascript">
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

            function showMe(box1, box2, box3) {

                var chboxs = document.getElementsByName("check");
                var vis1 = "none";
                var vis2 = "none";
                var vis3 = "block";
                for (var i = 0; i < chboxs.length; i++) {
                    if (chboxs[i].checked) {
                        vis1 = "block";
                        vis2 = "block";
                        vis3 = "none";
                        break;
                    }
                }
                document.getElementById(box1).style.display = vis1;
                document.getElementById(box2).style.display = vis2;
                document.getElementById(box3).style.display = vis3;
            }

            function showMe_(box1, box2, box3) {

                var chboxs = document.getElementsByName("check2");
                var vis1 = "none";
                var vis2 = "none";
                var vis3 = "block";
                for (var i = 0; i < chboxs.length; i++) {
                    if (chboxs[i].checked) {
                        vis1 = "block";
                        vis2 = "block";
                        vis3 = "none";
                        break;
                    }
                }
                document.getElementById(box1).style.display = vis1;
                document.getElementById(box2).style.display = vis2;
                document.getElementById(box3).style.display = vis3;
            }

            $(document).ready(function() {

                $("#desa").change(function() {
                    $(this).after('<span class="help-inline pull-right"><i class="icon-spinner icon-spin blue bigger-300" id="loader"></i></span>');
                    $.get('asumber.php?sumber=' + $(this).val(), function(data) {
                        $("#sumber_air").html(data);
                        $('#loader').slideUp(200, function() {
                            $(this).remove();
                        });
                    });
                });
            });
        </script>
        <script type="text/javascript">
            $(document).ready(function() {

                $("#kecamatan").change(function() {
                    $(this).after('<span class="help-inline pull-right"><i class="icon-spinner icon-spin blue bigger-300" id="loader"></i></span>');
                    $.get('akec.php?kecamatan=' + $(this).val(), function(data) {
                        $("#desa").html(data);
                        $('#loader').slideUp(200, function() {
                            $(this).remove();
                        });
                    });
                });
            });

            function run() {
                document.getElementById("angka_tanpa").value = document.getElementById("bangunan_tanpa").value;
                document.getElementById("angka_dengan").value = document.getElementById("bangunan_dengan").value;
            }

            function go() {
                document.getElementById("faktor-konstruksi_tanpa").value = document.getElementById("angka-kostruksi_tanpa").value;
                document.getElementById("faktor-konstruksi_dengan").value = document.getElementById("angka-kostruksi_dengan").value;
            }

            $(function() {
                $(".chzn-select").chosen();
            });
            // scrollables
            $('.slim-scroll').each(function() {
                var $this = $(this);
                $this.slimScroll({
                    height: $this.data('height') || 100,
                    railVisible: true
                });
            });
            function myFunction()
            {
                window.location.reload();
            }

            var radio = document.getElementsByName("exposure");
            var widgetTanpa = document.getElementById("widget_tanpa");
            var widgetDengan = document.getElementById("widget_dengan");
            widgetTanpa.style.display = "none";  // hide
            widgetDengan.style.display = "none";  // hide
            for (var i = 0; i < radio.length; i++) {
                radio[i].onclick = function() {
                    var val = this.value;
                    if (val == '1') {
                        widgetTanpa.style.display = 'block';
                        widgetDengan.style.display = 'none';
                        //angka.style.visibility = "hidden";
                    }
                    else if (val == '2') {
                        widgetTanpa.style.display = 'none';
                        widgetDengan.style.display = 'block';
                        //angka.style.visibility = "visible";
                    }

                }
            }
        </script>
        <script>
            $(document).ready(function()
            {
                function rumusTanpa()
                {
                    var p1 = parseFloat($("#panjang_tanpa").val());
                    var l1 = parseFloat($("#lebar_tanpa").val());
                    var t1 = parseFloat($("#tinggi_tanpa").val());
                    var angka1 = parseFloat($("#angka_tanpa").val());
                    var faktor1 = parseFloat($("#faktor-konstruksi_tanpa").val());
                    var total1 = (Math.round(p1 * 3.2808399) * Math.round(l1 * 3.2808399) * Math.round(t1 * 3.2808399)) / (angka1 * faktor1);
                    $("#hasil_tanpa").val(Math.round(total1));
                    var total1_fixed = Math.round(total1) / 264.172052;
                    var hasil = total1_fixed.toFixed(1);
                    $("#hasil_tanpa1").val(hasil);

                }
                $(document).on("change, keyup", "#faktor-konstruksi_tanpa,#angka_tanpa,#panjang_tanpa, #tinggi_tanpa, #lebar_tanpa", rumusTanpa);
            });
        </script>
        <script>
            $(document).ready(function()
            {
                function rumusTanpa1()
                {
                    var p1 = parseFloat($("#panjang_tanpa").val());
                    var l1 = parseFloat($("#lebar_tanpa").val());
                    var t1 = parseFloat($("#tinggi_tanpa").val());
                    var angka_baru = parseFloat($("#nilai_tipe_baru1").val());
                    var faktor1 = parseFloat($("#faktor-konstruksi_tanpa").val());
                    var total1 = Math.round(p1 * 3.2808399) * Math.round(l1 * 3.2808399) * Math.round(t1 * 3.2808399) / angka_baru * faktor1;
                    $("#hTanpa").val(Math.round(total1));
                    var total1_fixed = Math.round(total1) / 264.172052;
                    var hasil = total1_fixed.toFixed(1);
                    $("#hTanpa1").val(hasil);

                }
                $(document).on("change, keyup", "#faktor-konstruksi_tanpa,#nilai_tipe_baru1,#panjang_tanpa, #tinggi_tanpa, #lebar_tanpa", rumusTanpa1);
            });
        </script>
        <script>
            $(document).ready(function()
            {
                function rumusDengan()
                {
                    var p = parseFloat($("#panjang_dengan").val());
                    var l = parseFloat($("#lebar_dengan").val());
                    var t = parseFloat($("#tinggi_dengan").val());
                    var angka = parseFloat($("#angka_dengan").val());
                    var angka_baru2 = parseFloat($("#nilai_tipe_baru2").val());
                    var faktor = parseFloat($("#faktor-konstruksi_dengan").val());
                    var bahaya = parseFloat($("#faktor-bahaya_dengan").val());
                    var total = Math.round(p * 3.2808399) * Math.round(l * 3.2808399) * Math.round(t * 3.2808399) / angka * faktor * bahaya;
                    $("#hasil_dengan").val(Math.round(total));
                    var total_fixed = Math.round(total) / 264.172052;
                    var hasil = total_fixed.toFixed(1);
                    $("#hasil_dkubik").val(hasil);
                }
                $(document).on("change, keyup", "#faktor-bahaya_dengan,#faktor-konstruksi_dengan,#angka_dengan,#panjang_dengan, #tinggi_dengan, #lebar_dengan", rumusDengan);
            });
        </script>
        <script>
            $(document).ready(function()
            {
                function rumusDengan1()
                {
                    var p = parseFloat($("#panjang_dengan").val());
                    var l = parseFloat($("#lebar_dengan").val());
                    var t = parseFloat($("#tinggi_dengan").val());
                    var angka_baru2 = parseFloat($("#nilai_tipe_baru2").val());
                    var faktor = parseFloat($("#faktor-konstruksi_dengan").val());
                    var bahaya = parseFloat($("#faktor-bahaya_dengan").val());
                    var total = Math.round(p * 3.2808399) * Math.round(l * 3.2808399) * Math.round(t * 3.2808399) / angka_baru2 * faktor * bahaya;
                    $("#hDengan").val(Math.round(total));
                    var total_fixed = Math.round(total) / 264.172052;
                    var hasil = total_fixed.toFixed(1);
                    $("#h_dKubik").val(hasil);
                }
                $(document).on("change, keyup", "#faktor-bahaya_dengan,#faktor-konstruksi_dengan,#nilai_tipe_baru2,#panjang_dengan, #tinggi_dengan, #lebar_dengan", rumusDengan1);
            });

        </script>
        <script type="text/javascript">
            $(function() {
                $('#validation-form').show();
                //documentation : http://docs.jquery.com/Plugins/Validation/validate
                $('#validation-form').validate({
                    errorElement: 'span',
                    errorClass: 'help-block',
                    focusInvalid: false,
                    rules: {
                        master1: {
                            required: true
                        },
                        master: {
                            required: true
                        },
                        pelapor: {
                            required: true
                        },
                        jalan: {
                            required: true
                        },
                        telp: {
                            required: true
                        },
                        kecamatan: {
                            required: true
                        },
                        nama_tipe_baru1: {
                            required: true
                        },
                        nilai_tipe_baru1: {
                            required: true
                        },
                        nama_tipe_baru2: {
                            required: true
                        },
                        nilai_tipe_baru2: {
                            required: true
                        },
                        desa: {
                            required: true
                        },
                        sumber_air_: {
                            required: true
                        },
                        exposure: {
                            required: true
                        },
                        tipe_proteksi: {
                            required: true
                        },
                        angka_kostruksi1: {
                            required: true
                        },
                        angka_kostruksi2: {
                            required: true
                        },
                        tinggi1: {
                            required: true
                        },
                        tinggi2: {
                            required: true
                        },
                        tepol: {
                            required: true
                        }
                    },
                    messages: {
                        master: "Mohon untuk memilih tipe bangunan.",
                        master1: "Mohon untuk memilih tipe bangunan.",
                        pelapor: "Mohon untuk mengisi field nama pelapor.",
                        jalan: "Mohon untuk mengisi nama jalan lokasi kejadian.",
                        telp: "Mohon untuk mengisi field nomor telepon.",
                        kecamatan: "Mohon untuk memilih lokasi kecamatan.",
                        desa: "Mohon untuk memilih lokasi desa.",
                        sumber_air_: "Mohon untuk memilih sumber air.",
                        tipe_proteksi: "Mohon untuk memilih tipe proteksi kebakaran.",
                        exposure: "Mohon untuk memilih.",
                        tepol: "Mohon untuk memilih."
                    },
                    invalidHandler: function(event, validator) { //display error alert on form submit   
                        $('.alert-error', $('.login-form')).show();
                    },
                    highlight: function(e) {
                        $(e).closest('.control-group').removeClass('info').addClass('error');
                    },
                    success: function(e) {
                        $(e).closest('.control-group').removeClass('error').addClass('info');
                        $(e).remove();
                    },
                    errorPlacement: function(error, element) {
                        if (element.is(':checkbox') || element.is(':radio')) {
                            var controls = element.closest('.controls');
                            if (controls.find(':checkbox,:radio').length > 1)
                                controls.append(error);
                            else
                                error.insertAfter(element.nextAll('.lbl:eq(0)').eq(0));
                        }
                        else if (element.is('.select2')) {
                            error.insertAfter(element.siblings('[class*="select2-container"]:eq(0)'));
                        }
                        else if (element.is('.chzn-select')) {
                            error.insertAfter(element.siblings('[class*="chzn-container"]:eq(0)'));
                        }
                        else
                            error.insertAfter(element);
                    },
                    submitHandler: function(form) {
                        var url = "Fanalisis/analisisProses.php";

                        // mengambil nilai dari inputbox, textbox dan select
                        var v_kec = $('select[name=kecamatan]').val();
                        var v_air = $('select[name=sumber_air]').val();
                        var v_desa = $('select[name=desa]').val();
                        var v_akons1 = $('select[name=angka_konstruksi1]').val();
                        var v_akons2 = $('select[name=angka_konstruksi2]').val();
                        var v_tinggi1 = $('input:text[name=tinggi1]').val();
                        var v_tinggi2 = $('input:text[name=tinggi2]').val();
                        var v_exposure = $('input:radio[name=exposure]').val();
                        var v_tepol = $('input:radio[name=tepol]').val();
                        //var v_hasil1 = $('input:text[name=hasil1]').val();
                        //var v_hasil2 = $('input:text[name=hasil2]').val();

                        $.post(url, {tinggi2: v_tinggi2, desa: v_desa, kecamatan: v_kec, sumber_air: v_air, angka_konstruksi1: v_akons1, angka_konstruksi2: v_akons2, tinggi1: v_tinggi1, exposure: v_exposure, tepol: v_tepol, hasil1: v_hasil1, hasil2: v_hasil2}, function() {

                        })
                    },
                    invalidHandler: function(form) {
                    }
                });
            });

            $(function() {
                $(".chzn-select").chosen();
            });

            $(function() {
                ///////////////////////////////////////////
                $('#user-profile-3').end().find('button[type=reset]').on(ace.click_event, function() {
                    $('#user-profile-3 input[type=file]').ace_file_input('reset_input');
                })
            });
        </script>
    </body>
</html>
