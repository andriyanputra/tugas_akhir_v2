<?php
//include '../template/header.php';

session_start();
include ("../config/koneksi.php");
include '../config/functions.php'; //include function.php - very important

if (!loggedin()) { // check if the user is logged in, but if it isn't, it will redirect to the Login Form page. Noticed the difference?
    header("Location: ../login/login.php");
    exit();
}

if (isset($_SESSION['pegawai_nomor']) || isset($_COOKIE['pegawai_nomor'])) {
    $sql = mysql_query("SELECT * FROM pegawai WHERE pegawai_nip='" . $_SESSION['pegawai_nomor'] . "' OR pegawai_nip='" . $_COOKIE['pegawai_nomor'] . "'");
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
                    <link rel="shortcut icon" href="../assets/img/favicon.ico">
                    <!--fonts-->

                    <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Open+Sans:400,300" />

                    <!--ace styles-->

                    <link rel="stylesheet" href="../assets/css-ace/ace.min.css" />
                    <link rel="stylesheet" href="../assets/css-ace/ace-responsive.min.css" />
                    <link rel="stylesheet" href="../assets/css-ace/ace-skins.min.css" />

                    <!--inline styles related to this page-->
                    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
                </head>
                <body tracingsrc="../assets/img/sda/Kec.jpg" tracingopacity="100">

                    <div class="navbar">
                        <div class="navbar-inner">
                            <div class="container-fluid">
                                <a href="../beranda/index" class="brand">
                                    <small> <i class="icon-fire-extinguisher"></i>
                                        SIM Proteksi Kebakaran Perkotaan Kab. Sidoarjo
                                    </small>
                                </a>
                                <!--/.brand-->

                                <ul class="nav ace-nav pull-right">

                                    <li class="grey">
                                        <a data-toggle="dropdown" class="dropdown-toggle" href="#"> <i class="icon-bell-alt icon-animated-bell"></i>
                                            <span class="badge badge-important">8</span>
                                        </a>

                                        <ul class="pull-right dropdown-navbar navbar-pink dropdown-menu dropdown-caret dropdown-closer">
                                            <li class="nav-header">
                                                <i class="icon-warning-sign"></i>
                                                8 Notifications
                                            </li>

                                            <li>
                                                <a href="#">
                                                    <div class="clearfix">
                                                        <span class="pull-left">
                                                            <i class="btn btn-mini no-hover btn-pink icon-comment"></i>
                                                            Comment Regu Pemadam
                                                        </span>
                                                        <span class="pull-right badge badge-info">+5</span>
                                                    </div>
                                                </a>
                                            </li>

                                            <li>
                                                <a href="#">
                                                    <i class="btn btn-mini btn-primary icon-user"></i>
                                                    Ricky just signed up as an admin ...
                                                </a>
                                            </li>

                                            <li>
                                                <a href="#">
                                                    <div class="clearfix">
                                                        <span class="pull-left">
                                                            <i class="btn btn-mini no-hover btn-success icon-shopping-cart"></i>
                                                            Inventaris Barang
                                                        </span>
                                                        <span class="pull-right badge badge-success">+2</span>
                                                    </div>
                                                </a>
                                            </li>

                                            <li>
                                                <a href="#">
                                                    See all notifications
                                                    <i class="icon-arrow-right"></i>
                                                </a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li class="light-blue">
                                        <a data-toggle="dropdown" href="#" class="dropdown-toggle">
                                            <img class="nav-user-photo" src="../assets/img/img-anggota/<?= $row['pegawai_foto']; ?>" alt="<?= $row['pegawai_nama']; ?>" />
                                            <span class="user-info">
                                                <small>Welcome,</small>
                                                <?= $row['pegawai_nama']; ?>
                                            </span>

                                            <i class="icon-caret-down"></i>
                                        </a>

                                        <ul class="user-menu pull-right dropdown-menu dropdown-yellow dropdown-caret dropdown-closer">

                                            <li>
                                                <a href="../anggota/profile">
                                                    <i class="icon-user"></i>
                                                    Profile
                                                </a>
                                            </li>

                                            <li class="divider"></li>

                                            <li>
                                                <a href="../login/logout">
                                                    <i class="icon-off"></i>
                                                    Logout
                                                </a>
                                            </li>
                                        </ul>
                                    </li>
                                </ul>
                                <!--/.ace-nav--> </div>
                            <!--/.container-fluid--> </div>
                        <!--/.navbar-inner--> </div>

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
                                </ul>
                                <!--.breadcrumb--> </div>

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
                                                    <div class="widget-header widget-hea1der-small header-color-blue2">
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
                                            </div>
                                            <!-- end row fliud --> </div>
                                        <!-- end span12 -->

                                        <div class="space-6"></div>

                                        <form class="form-horizontal" id="validation-form" method="POST" action="Fanalisis/kebProses.php">
                                            <div class="row-fluid">
                                                <div class="span12">
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
                                                                                                <img src="../assets/img/potensi.JPG" width="400" height="500" ></div>
                                                                                            <div class="span6 form-horizontal">
                                                                                                <div class="space-6"></div>
                                                                                                <div class="control-group">
                                                                                                    <label class="control-label" for="volume">Kapasitas Air Kendaraan Damkar (V):</label>
                                                                                                    <div class="controls">
                                                                                                        <input name="v_potensi" id="volume" type="text" placeholder="liter . . ." />
                                                                                                    </div>
                                                                                                </div>

                                                                                                <div class="control-group">
                                                                                                    <label class="control-label" for="a">Waktu Pengisian Kendaraan Pemasok Air (A) :</label>
                                                                                                    <div class="controls">
                                                                                                        <input name="a_potensi" id="a" type="text" placeholder="menit . . ." />
                                                                                                    </div>
                                                                                                </div>

                                                                                                <div class="control-group">
                                                                                                    <label class="control-label" for="kecepatan">Kecepatan Konstan Kendaraan :</label>
                                                                                                    <div class="controls">
                                                                                                        <input name="kecepatan" id="kecepatan" type="text" placeholder="km/jam . . ." />
                                                                                                    </div>
                                                                                                </div>

                                                                                                <div class="control-group">
                                                                                                    <label class="control-label" for="jarak1">Jarak Lokasi ke Sumber Air (D1) :</label>
                                                                                                    <div class="controls">
                                                                                                        <input name="jarak1" id="jarak1" type="text" placeholder="kilometer . . ." />
                                                                                                    </div>
                                                                                                </div>

                                                                                                <div class="control-group">
                                                                                                    <label class="control-label" for="jarak2">Jarak Lokasi Kembali dari Sumber Air (D2):</label>
                                                                                                    <div class="controls">
                                                                                                        <input name="jarak2" id="jarak2" type="text" placeholder="kilometer . . ." />
                                                                                                    </div>
                                                                                                </div>

                                                                                                <div class="control-group">
                                                                                                    <label class="control-label" for="t1">T1 :&nbsp;&nbsp;&nbsp;&nbsp;</label>
                                                                                                    <div class="controls">
                                                                                                        <input name="t1_potensi" id="t1" type="text" placeholder="menit . . ." />
                                                                                                    </div>
                                                                                                </div>

                                                                                                <div class="control-group">
                                                                                                    <label class="control-label" for="t2">T2 :&nbsp;&nbsp;&nbsp;&nbsp;</label>
                                                                                                    <div class="controls">
                                                                                                        <input name="t2_potensi" id="t2" type="text" placeholder="menit . . ." />
                                                                                                    </div>
                                                                                                </div>

                                                                                                <div class="control-group">
                                                                                                    <label class="control-label" for="b">Waktu Pengisian ke Tangki Portable (B) :</label>
                                                                                                    <div class="controls">
                                                                                                        <input name="b_potensi" id="b" type="text" placeholder="menit . . ." />
                                                                                                    </div>
                                                                                                </div>

                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <!-- end widget-body --> </div>
                                                                        </div>
                                                                        <!-- end span12 --> </div>
                                                                </div>
                                                                <!--END POTENSI-->
                                                                <!--RESULT-->
                                                                <div id="result" class="tab-pane">
                                                                    <form class="form-horizontal" id="" method="POST" action="Fanalisis/analisisProses.php">

                                                                        <div class="form-actions">
                                                                            <div class="pull-right">
                                                                                <button class="btn">
                                                                                    <i class="icon-arrow-left bigger-110"></i>
                                                                                    Kembali
                                                                                </button>
                                                                                &nbsp; &nbsp; &nbsp;
                                                                                <button class="btn btn-info" type="submit">
                                                                                    <i class="icon-ok"></i>
                                                                                    Submit
                                                                                </button>
                                                                            </div>
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                                <!--END RESULT--> </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- end span12 --> </div>
                                            <!-- end row-fluid --> </form>

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
            window.jQuery || document.write("<script src='../assets/js-ace/jquery-2.0.3.min.js'>" + "<" + "/script>");</script>

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
        <script src="../assets/js-ace/bootstrap-tag.min.js"></script>
        <script src="../assets/js-ace/jquery.validate.min.js"></script>
        <!--ace scripts-->

        <script src="../assets/js-ace/ace-elements.min.js"></script>
        <script src="../assets/js-ace/ace.min.js"></script>

        <script>
            // scrollables
            $('.slim-scroll').each(function() {
                var $this = $(this);
                $this.slimScroll({
                    height: $this.data('height') || 100,
                    railVisible: true
                });
            });
            $(document).ready(function()
            {
                function rumusTanpa()
                {
                    var p1 = parseFloat($("#panjang_tanpa").val());
                    var l1 = parseFloat($("#lebar_tanpa").val());
                    var t1 = parseFloat($("#tinggi_tanpa").val());
                    var angka1 = parseFloat($("#angka_tanpa").val());
                    var faktor1 = parseFloat($("#faktor-konstruksi_tanpa").val());
                    var total1 = (p1 * 3.2808399) * (l1 * 3.2808399) * (t1 * 3.2808399) / angka1 * faktor1;
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
                function rumusDengan()
                {
                    var p = parseFloat($("#panjang_dengan").val());
                    var l = parseFloat($("#lebar_dengan").val());
                    var t = parseFloat($("#tinggi_dengan").val());
                    var angka = parseFloat($("#angka_dengan").val());
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
        <script type="text/javascript">
            function changeImage(url) {
                var img = document.getElementById('gambar2');
                img.src = url;
            }
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
                        kecamatan: {
                            required: true
                        },
                        desa: {
                            required: true
                        },
                        sumber_air: {
                            required: true
                        },
                        exposure: {
                            required: true
                        },
                        bangunan: {
                            required: true
                        },
                        angka_kostruksi: {
                            required: true
                        },
                        volume1: {
                            required: true
                        },
                        tepol: {
                            required: true
                        }
                    },
                    messages: {
                        kecamatan: "Mohon untuk memilih lokasi kecamatan.",
                        desa: "Mohon untuk memilih lokasi desa.",
                        sumber_air: "Mohon untuk memilih sumber air.",
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
                        var v_bangunan = $('input:text[name=bangunan]').val();
                        var v_akons = $('input:text[name=angka_konstruksi]').val();
                        var v_volume1 = $('input:text[name=volume1]').val();
                        var v_exposure = $('input:radio[name=exposure]').val();
                        var v_tepol = $('input:radio[name=tepol]').val();
                        var v_pass1 = $('input:password[name=pass1]').val();
                        var v_jabatan = $('select[name=jabatan]').val();

                        $.post(url, {kecamatan: v_kec, sumber_air: v_air, bangunan: v_bangunan, angka_konstruksi: v_akons, volume1: v_volume1, exposure: v_exposure, tepol: v_tepol, pass1: v_pass1, jabatan: v_jabatan}, function() {

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
