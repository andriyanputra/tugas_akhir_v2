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
                                    <small>
                                        <i class="icon-fire-extinguisher"></i>
                                        SIM Proteksi Kebakaran Perkotaan Kab. Sidoarjo
                                    </small>
                                </a><!--/.brand-->

                                <ul class="nav ace-nav pull-right">

                                    <li class="grey">
                                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                                            <i class="icon-bell-alt icon-animated-bell"></i>
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
                                </ul><!--/.ace-nav-->
                            </div><!--/.container-fluid-->
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
                                </ul><!--.breadcrumb-->
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
                                </div><!--/.page-header-->

                                <div class="row-fluid">
                                    <div class="span12">
                                        <!--PAGE CONTENT BEGINS-->
                                        <div class="row-fluid">
                                            <div class="span12">
                                                <div class="span6">
                                                    <div class="widget-box">
                                                        <div class="widget-header widget-hea1der-small header-color-blue2">
                                                            <h6>Peta Kabupaten Sidoarjo</h6>


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
                                                                            <img src="../assets/img/sda/Kec.jpg" width="829" height="441" usemap="#Map">
                                                                            <map name="Map">
                                                                                <area shape="poly" onClick="changeImage('../assets/img/sda/large/krembung.png')" coords="191,252,194,241,203,235,200,227,212,230,222,240,238,244,248,243,258,251,267,259,267,257,267,266,263,273,276,283,285,293,285,296,283,305,282,299,281,306,271,309,267,304,251,302,240,298,226,279,207,268" href="#" alt="Krembung" title="KREMBUNG" data-rel="tooltip">
                                                                                <area shape="poly" onClick="changeImage('../assets/img/sda/large/porong.png')" coords="292,330,284,330,282,325,289,318,293,306,286,297,295,294,292,288,289,279,279,277,270,271,279,266,290,262,289,255,295,256,302,264,316,266,330,271,340,278,355,282,351,283,363,285,362,285,366,287,366,287,373,287,388,288,395,278,402,277,394,280,411,277,418,275,430,266,439,261,437,276,448,266,443,262,439,266,438,278,429,275,435,277,405,277,398,283,398,283,392,290,389,291,379,290,373,290,367,291,367,290,367,291,338,291,339,293,338,296,330,300,335,302,328,305,316,308,316,312,313,310,303,311,304,308,305,314,298,313,292,315,287,319,291,324" href="#" alt="Porong" title="PORONG" data-rel="tooltip">
                                                                                <area shape="poly" onClick="changeImage('../assets/img/sda/large/sukodono.png')" coords="226,117,231,109,242,103,257,102,274,99,285,91,305,89,315,92,313,100,317,97,310,98,309,101,319,105,320,112,319,120,319,123,318,128,307,137,294,145,282,144,277,140,275,130,268,127,254,127,244,117" href="#" alt="Sukodono" title="SUKODONO" data-rel="tooltip">
                                                                                <area shape="poly" onClick="changeImage('../assets/img/sda/large/balongbendo.png')" coords="109,124,92,118,85,123,73,121,43,128,29,136,27,142,18,142,16,145,13,150,16,149,21,152,15,160,35,154,29,162,36,157,25,161,29,164,36,161,40,165,50,161,69,151,90,156,119,158,139,160,143,150,140,139,142,136,136,130,134,127,129,127,126,125,119,128,123,122" href="#" alt="Balongbendo" title="BALONGBENDO" data-rel="tooltip">
                                                                                <area shape="poly" onClick="changeImage('../assets/img/sda/large/tarik.png')" coords="70,203,89,205,104,210,110,206,112,202,113,195,132,183,123,172,99,171,73,161,64,174,58,169,48,175,19,167,1,168,-6,163,-12,167,-22,186,-1,185,15,187,35,194,49,202" href="#" alt="Tarik" title="TARIK" data-rel="tooltip">
                                                                                <area shape="poly" onClick="changeImage('../assets/img/sda/large/gedangan.png')" coords="352,90,346,88,335,87,324,96,325,103,329,117,345,116,353,119,358,110,375,118,376,118,381,112,387,116,387,118,394,115,393,111,394,108,394,103,395,99,396,96,395,88,396,81,395,74,385,76,378,70,346,73,355,80,346,81" href="#" alt="Bangah" title="GEDANGAN" data-rel="tooltip">
                                                                                <area shape="poly" onClick="changeImage('../assets/img/sda/large/jabon.png')" coords="333,308,341,299,359,297,379,299,397,300,404,301,408,292,407,286,439,284,454,279,465,280,479,275,495,271,499,264,498,252,500,245,503,241,496,232,504,225,514,233,516,243,517,251,514,262,529,258,546,264,543,265,542,263,550,273,556,292,557,308,561,323,558,343,551,350,538,350,533,344,528,336,519,319,508,309,507,305,510,308,498,309,509,307,510,310,511,310,510,309,494,312,492,314,492,319,474,321,465,330,448,329,434,334,415,343,402,346,390,344,375,343,367,341,359,330,347,328,337,316" href="#" alt="Jabon" title="JABON" data-rel="tooltip">
                                                                                <area shape="poly" onClick="changeImage('../assets/img/sda/large/prambon.png')" coords="173,234,173,238,183,233,190,224,200,218,209,214,209,208,214,202,212,202,205,198,179,178,159,180,146,173,140,172,132,170,141,186,145,192,142,203,141,214,159,225" href="#" alt="Prambon" title="PRAMBON" data-rel="tooltip">
                                                                                <area shape="poly" onClick="changeImage('../assets/img/sda/large/sidoarjo.png')" coords="287,175,280,183,277,174,270,174,271,164,266,153,278,148,292,152,303,162,307,170,317,169,320,178,332,183,332,177,349,168,362,171,378,180,384,169,406,172,418,179,430,187,432,189,437,198,445,205,456,211,460,223,476,230,474,235,475,242,476,243,474,262,461,260,463,265,462,257,462,256,458,260,452,258,455,254,454,254,460,247,459,239,455,230,449,230,433,222,439,225,425,219,424,219,409,214,400,211,389,209,368,207,350,201,336,195,318,187,306,187,297,178" href="#" alt="Sidoarjo" title="SIDOARJO" data-rel="tooltip">
                                                                                <area shape="poly" onClick="changeImage('../assets/img/sda/large/buduran.png')" coords="320,130,318,138,310,145,307,150,307,158,313,162,321,169,329,164,338,166,348,160,358,156,362,162,368,156,387,157,411,171,424,179,436,181,451,190,470,211,475,213,481,209,486,202,470,188,465,187,460,187,457,181,457,179,441,173,427,162,429,161,424,157,419,157,422,157,426,139,410,134,412,138,412,132,406,129,402,125,397,125,395,135,370,134,352,132,334,131" href="#" alt="Buduran" title="BUDURAN" data-rel="tooltip">
                                                                                <area shape="poly" onClick="changeImage('../assets/img/sda/large/sedati.png')" coords="392,63,405,83,408,104,417,118,429,131,444,143,444,162,455,177,472,161,486,161,482,169,498,167,487,176,494,181,497,186,490,210,500,199,499,192,501,192,499,194,503,186,501,191,500,198,487,222,519,226,518,199,519,189,520,166,520,141,518,120,520,116,519,113,519,112,518,105,521,103,509,99,515,94,510,92,509,87,506,79,510,64,514,53,524,43,523,35,528,20,528,7,514,9,506,25,507,35,505,58,481,68,451,64" href="#" alt="Sedati" title="SEDATI" data-rel="tooltip">
                                                                                <area shape="poly" onClick="changeImage('../assets/img/sda/large/tulangan.png')" coords="218,198,216,191,209,183,228,178,244,179,258,186,261,190,265,196,265,197,271,202,282,208,270,213,266,216,267,224,276,232,278,240,277,241,275,250,267,251,257,242,255,238,241,234,226,233,218,225,219,213,224,208" href="#" alt="Tulangan" title="TULANGAN" data-rel="tooltip">
                                                                                <area shape="poly" onClick="changeImage('../assets/img/sda/large/krian.png')" coords="155,107,151,112,156,110,139,121,149,124,155,132,156,140,161,137,162,138,161,139,170,135,166,142,168,138,173,140,175,138,182,136,191,134,203,132,217,123,208,123,212,118,221,111,228,102,231,95,223,93,225,87,222,83,213,77,194,80,187,84,178,93,163,98" href="#" alt="Krian" title="KRIAN" data-rel="tooltip">
                                                                                <area shape="poly" onClick="changeImage('../assets/img/sda/large/tanggulangin.png')" coords="276,218,276,210,301,226,318,235,334,238,351,245,377,248,379,248,377,249,391,252,395,254,397,250,403,249,405,249,409,250,410,247,408,250,414,251,415,259,416,265,411,265,400,271,397,273,382,277,381,278,376,277,390,277,375,277,363,271,354,269,345,277,332,271,317,258,284,248,285,239,286,232" href="#" alt="Tanggulangin" title="TANGGULANGIN" data-rel="tooltip">
                                                                                <area shape="poly" onClick="changeImage('../assets/img/sda/large/taman.png')" coords="212,71,232,74,255,64,278,59,293,51,326,45,325,48,328,50,326,54,327,54,335,58,334,68,331,71,306,74,275,86,247,92,229,82" href="#" alt="Taman" title="TAMAN" data-rel="tooltip">
                                                                                <area shape="poly" onClick="changeImage('../assets/img/sda/large/wonoayu.png')" coords="187,175,178,171,168,169,174,162,183,163,195,157,194,150,194,144,209,142,217,135,228,123,244,129,257,130,263,135,247,141,271,142,266,150,261,151,259,154,259,162,256,162,254,168,245,170,238,171,247,167,235,173,233,170,225,173,227,167,228,173,233,172,236,172,226,170,224,170,218,173,209,175,203,175,190,173" href="#" alt="Wonoayu" title="WONOAYU" data-rel="tooltip">
                                                                                <area shape="poly" onClick="changeImage('../assets/img/sda/large/waru.png')" coords="371,48,362,34,341,33,345,51,353,65,369,63,393,62,399,56,411,56,411,51,431,58,451,55,467,61,477,55,489,54,502,56,495,43,489,48,489,40,482,34,481,45,468,43,469,34,477,34,479,30,464,29,478,29,460,27,452,31,439,32,433,34,423,37,409,29,405,35,398,42,383,43,376,49" href="#" alt="Waru" title="WARU" data-rel="tooltip">
                                                                                <area shape="poly" onClick="changeImage('../assets/img/sda/large/candi.png')" coords="281,203,277,193,287,196,297,193,308,192,317,195,331,202,345,213,359,215,383,227,399,225,419,230,434,231,448,239,446,238,449,242,442,244,436,244,432,247,434,249,431,245,432,253,433,251,435,251,439,248,439,248,438,250,430,250,432,251,431,250,417,246,415,246,403,246,383,246,374,244,363,246,343,239,331,233,319,230,312,223,301,218,292,208" href="#" alt="Candi" title="CANDI" data-rel="tooltip">
                                                                            </map>
                                                                        </p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="span6">
                                                    <div class="widget-box">
                                                        <div class="widget-header widget-hea1der-small header-color-blue2">
                                                            <h6>Peta Desa Kabupaten Sidoarjo</h6>


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
                                                                            <img src="" width="829" height="441" id="gambar2">
                                                                        </p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div><!-- end row fliud -->
                                        </div><!-- end span12 -->

                                        <form class="form-horizontal" id="validation-form" method="POST" action="Fanalisis/kebProses.php">
                                            <div class="row-fluid">
                                                <div class="span12">
                                                    <div class="span6">
                                                        <div class="widget-box transparent">
                                                            <div class="widget-header header-color-blue2">
                                                                <h3>Lokasi Kejadian Kebakaran</h3>
                                                                <div class="widget-toolbar">
                                                                </div>
                                                            </div>

                                                            <div class="widget-body">
                                                                <div class="widget-main padding-4">
                                                                    <div class="content">
                                                                        <div class="space-6"></div>
                                                                        <div id="frm-lokasi">

                                                                            <div class="control-group">
                                                                                <label class="control-label" for="kecamatan">Pilih Kecamatan : </label>
                                                                                <?php
                                                                                $query_parent = mysql_query("SELECT * FROM kecamatan") or die("Query failed: " . mysql_error());
                                                                                ?>
                                                                                <div class="controls">
                                                                                    <span>
                                                                                        <select name="kecamatan" id="kecamatan" class="chzn-select" data-placeholder="Pilih Kecamatan...">
                                                                                            <option value="" />Pilih Kecamatan...
                                                                                            <?php while ($row = mysql_fetch_array($query_parent)): ?>
                                                                                                <option value="<?php echo $row['KECAMATAN_ID']; ?>"><?php echo $row['KECAMATAN_NAMA']; ?></option>
                                                                                            <?php endwhile; ?>
                                                                                        </select>
                                                                                    </span>
                                                                                </div>
                                                                            </div>

                                                                            <div class="control-group">
                                                                                <label class="control-label" for="desa">Pilih Desa : </label>
                                                                                <div class="controls">
                                                                                    <span>
                                                                                        <select name="desa" id="desa">
                                                                                            <option value=""  />PIlih Desa...
                                                                                        </select>
                                                                                    </span>
                                                                                </div>
                                                                            </div>

                                                                            <div class="control-group">
                                                                                <label class="control-label" for="sumber_air">Sumber air : </label>
                                                                                <div class="controls">
                                                                                    <span>
                                                                                        <select name="sumber_air" id="sumber_air">
                                                                                            <option value="" />Sumber Air...
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
                                                                                            <span class="lbl"> 
                                                                                                <b class="text-error">Tanpa</b> resiko bangunan berdekatan. 
                                                                                                <a href="#tanpa" role="button" class="green" data-toggle="modal"> <span class="help-button" data-rel="tooltip" data-placement="top" title="More details.">?</span></a>
                                                                                            </span>
                                                                                        </label>

                                                                                        <label>
                                                                                            <input onchange='check_value();' name="exposure" value="2" type="radio"/>
                                                                                            <span class="lbl"> 
                                                                                                <b class="text-error">Dengan</b> resiko bangunan berdekatan. 
                                                                                                <a href="#dengan" role="button" class="green" data-toggle="modal"> <span class="help-button" data-rel="tooltip" data-placement="bottom" title="More details.">?</span></a>
                                                                                            </span>
                                                                                        </label>
                                                                                    </span>
                                                                                </div>

                                                                                <div class="control-group">
                                                                                    <label class="control-label">Penggunaan Bahan Khusus Pemadam Api: </label>

                                                                                    <div class="controls">
                                                                                        <span class="span12">
                                                                                            <label>
                                                                                                <input name="tepol" value="1" type="radio"/>
                                                                                                <span class="lbl">
                                                                                                    Ya
                                                                                                </span>
                                                                                            </label>
                                                                                            <label>
                                                                                                <input name="tepol" value="2" type="radio"/>
                                                                                                <span class="lbl">
                                                                                                    Tidak
                                                                                                </span>
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
                                                    </div>
                                                    <!-- Denga Faktor Bahaya -->
                                                    <div class="span6" id="widget_tanpa">
                                                        <div class="widget-box transparent">
                                                            <div class="widget-body">
                                                                <div class="widget-main padding-4">
                                                                    <div class="content">
                                                                        <div class="space-6"></div>
                                                                        <p align="center" class="text-error">
                                                                            Pasokan Air Minuman Tanpa Resiko Bangunan Berdekatan.
                                                                        <hr>
                                                                        </p>

                                                                        <div class="control-group">
                                                                            Rumus Pasokan Air Minimum :
                                                                            <p align="center">
                                                                                <img src="../assets/img/pam1.jpg">
                                                                            </p>
                                                                        </div>

                                                                        <div class="control-group">
                                                                            <label class="control-label" for="tipe-bangunan">Tipe Bangunan :<br /> <small>(Angka Klasifikasi Resiko Kebakaran)</small></label>
                                                                            <?php
                                                                            $bangunan1 = mysql_query("SELECT * FROM bangunan ORDER BY NAMA_BANGUNAN ASC") or die("Query failed: " . mysql_error());
                                                                            ?>
                                                                            <div class="controls">
                                                                                <select id="bangunan_tanpa" onchange="run();">
                                                                                    <option value="" />Pilih Bangunan...
                                                                                    <?php while ($r = mysql_fetch_array($bangunan1)): ?>
                                                                                        <option value="<?php echo $r['TINGKAT_BANGUNAN']; ?>"><?php echo $r['NAMA_BANGUNAN']; ?></option>
                                                                                    <?php endwhile; ?>
                                                                                </select>

                                                                                <input name="bangunan" class="span2" id="angka_tanpa" type="text" value="" readonly="readonly"/>
                                                                            </div>
                                                                        </div>

                                                                        <div class="control-group">
                                                                            <label class="control-label" for="angka-kostruksi">Angka Klasifikasi Konstruksi  :</label>
                                                                            <div class="controls">
                                                                                <select id="angka-kostruksi_tanpa" onchange="go();">
                                                                                    <option value="" />Pilih Faktor Bahaya...
                                                                                    <option value="0.5"> Konstruksi tahan api
                                                                                    <option value="0.75"> Konstruksi kayu berat (tidak mudah terbakar)
                                                                                    <option value="1.0"> Konstruksi biasa
                                                                                    <option value="1.5"> Konstruksi kerangka kayu (mudah terbakar)
                                                                                </select>

                                                                                <input class="span2" name="angka_kostruksi" value="" id="faktor-konstruksi_tanpa" type="text" readonly="readonly"/>
                                                                            </div>
                                                                        </div>

                                                                        <div class="control-group">
                                                                            <label class="control-label" for="volume">Volume Bangunan :</label>
                                                                            <div class="controls">
                                                                                <input class="span2" id="panjang_tanpa" type="text" placeholder="Panjang" value=""/> x
                                                                                <input class="span2" id="lebar_tanpa" type="text" placeholder="Lebar" value=""/> x
                                                                                <input name="volume1" class="span2" id="tinggi_tanpa" type="text" placeholder="Tinggi" value=""/> (Satuan meter)&nbsp;<strong class="red">*</strong>
                                                                            </div>
                                                                        </div>
                                                                        <div class="control-group">
                                                                            <label class="control-label" for="volume">Pasokan Air Minimum :</label>
                                                                            <div class="controls">
                                                                                <input class="span3" id="hasil_tanpa" name="hasil1" type="text" value="" readonly/> &nbsp;US Galon atau
                                                                                <input class="span2" id="hasil_tanpa1" type="text" value="" readonly/> &nbsp;m<sup>3</sup>
                                                                            </div>
                                                                        </div>
                                                                        <div class="control-group">
                                                                            <label for="note"><strong class="red">*</strong>&nbsp;&nbsp; <small>Gunakan . (titik) untuk koma.</small></label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- Denga Faktor Bahaya -->
                                                    <div class="span6" id="widget_dengan">
                                                        <div class="widget-box transparent">
                                                            <div class="widget-body">
                                                                <div class="widget-main padding-4">
                                                                    <div class="content">
                                                                        <div class="space-6"></div>
                                                                        <p align="center" class="text-error">
                                                                            Pasokan Air Minuman Dengan Resiko Bangunan Berdekatan.
                                                                        <hr>
                                                                        </p>

                                                                        <div class="control-group">
                                                                            Rumus Pasokan Air Minimum :
                                                                            <p align="center">
                                                                                <img src="../assets/img/pam2.jpg">
                                                                            </p>
                                                                        </div>

                                                                        <div class="control-group">
                                                                            <label class="control-label" for="tipe-bangunan">Tipe Bangunan :<br /> <small>(Angka Klasifikasi Resiko Kebakaran)</small></label>
                                                                            <?php
                                                                            $bangunan2 = mysql_query("SELECT * FROM bangunan ORDER BY NAMA_BANGUNAN ASC") or die("Query failed: " . mysql_error());
                                                                            ?>
                                                                            <div class="controls">
                                                                                <select id="bangunan_dengan" onchange="run();">
                                                                                    <option value="" />Pilih Bangunan...
                                                                                    <?php while ($r = mysql_fetch_array($bangunan2)): ?>
                                                                                        <option value="<?php echo $r['TINGKAT_BANGUNAN']; ?>"><?php echo $r['NAMA_BANGUNAN']; ?></option>
                                                                                    <?php endwhile; ?>
                                                                                </select>

                                                                                <input class="span2" id="angka_dengan" name="bangunan" type="text" value="" readonly="readonly"/>
                                                                            </div>
                                                                        </div>

                                                                        <div class="control-group">
                                                                            <label class="control-label" for="angka-kostruksi">Angka Klasifikasi Konstruksi  :</label>
                                                                            <div class="controls">
                                                                                <select id="angka-kostruksi_dengan" onchange="go();">
                                                                                    <option value="" />Pilih Faktor Bahaya...
                                                                                    <option value="0.5"> Konstruksi tahan api
                                                                                    <option value="0.75"> Konstruksi kayu berat (tidak mudah terbakar)
                                                                                    <option value="1.0"> Konstruksi biasa
                                                                                    <option value="1.5"> Konstruksi kerangka kayu (mudah terbakar)
                                                                                </select>

                                                                                <input class="span2" name="angka_kostruksi" value="" id="faktor-konstruksi_dengan" type="text" readonly="readonly"/>
                                                                            </div>
                                                                        </div>

                                                                        <div class="control-group">
                                                                            <label for="faktor-bahaya">Faktor bahaya dari bangunan berdekatan bernilai : 1.5 kali </label>
                                                                            <input class="span3" type="hidden" name="faktor-bahaya" id="faktor-bahaya_dengan" value="1.5" />
                                                                        </div>

                                                                        <div class="control-group">
                                                                            <label class="control-label" for="volume">Volume Bangunan :</label>
                                                                            <div class="controls">
                                                                                <input class="span2" id="panjang_dengan" type="text" placeholder="Panjang" /> x
                                                                                <input class="span2" id="lebar_dengan" type="text" placeholder="Lebar" /> x
                                                                                <input class="span2" name="volume1" id="tinggi_dengan" type="text" placeholder="Tinggi" /> (Satuan meter)&nbsp;<strong class="red">*</strong>
                                                                            </div>
                                                                        </div>
                                                                        <div class="control-group">
                                                                            <label class="control-label" for="volume">Pasokan Air Minimum :</label>
                                                                            <div class="controls">
                                                                                <input class="span3" id="hasil_dengan" name="hasil2" type="text" value="" readonly/> &nbsp;US Galon atau
                                                                                <input class="span2" id="hasil_dkubik"  type="text" value="" readonly/> &nbsp;m<sup>3</sup>
                                                                            </div>
                                                                        </div>
                                                                        <div class="control-group">
                                                                            <label for="note"><strong class="red">*</strong>&nbsp;&nbsp; <small>Gunakan . (titik) untuk koma.</small></label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div><!-- end row fliud -->
                                            </div><!-- end span12 -->

                                            <div class="form-actions">
                                                <button class="btn btn-info" type="submit">
                                                    <i class="icon-ok bigger-110"></i>
                                                    Submit
                                                </button>

                                                &nbsp; &nbsp; &nbsp;
                                                <button class="btn" type="reset" id="reset" onclick="myFunction();">
                                                    <i class="icon-undo bigger-110"></i>
                                                    Reset
                                                </button>
                                            </div>
                                        </form>

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
                                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Jumlah kebutuhan air minimum tersebut <b>tanpa</b> faktor resiko bangunan gedung berdekatan (<i>exposure</i>) dinyatakan dengan rumus :
                                                    </dd>
                                                    </p>
                                                    <p align="center">
                                                        <img src="../assets/img/pam1.jpg">
                                                    </p>
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
                                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Jumlah kebutuhan air minimum tersebut <b>dengan</b> faktor resiko bangunan gedung berdekatan (<i>exposure</i>) dinyatakan dengan rumus :
                                                    </dd>
                                                    </p>
                                                    <p align="center">
                                                        <img src="../assets/img/pam2.jpg">
                                                    </p>
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
                            <label class="lbl" for="ace-settings-rtl"> Right To Left (rtl)</label>
                        </div>
                    </div>
                </div><!--/#ace-settings-container-->
            </div><!--/.main-content-->
        </div><!--/.main-container-->

        <a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-small btn-inverse">
            <i class="icon-double-angle-up icon-only bigger-110"></i>
        </a>

        <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>

        <!--<![endif]-->

        <!--[if !IE]>-->

        <script type="text/javascript">
                                                    window.jQuery || document.write("<script src='../assets/js-ace/jquery-2.0.3.min.js'>" + "<" + "/script>");
        </script>

        <!--<![endif]-->


        <script type="text/javascript">
            if ("ontouchend" in document)
                document.write("<script src='../assets/js-ace/jquery.mobile.custom.min.js'>" + "<" + "/script>");
        </script>
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
        <script type="text/javascript">
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

