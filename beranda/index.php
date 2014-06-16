<?php
//
include '../template/header.php';

//===================================
//Buat daftar nama bulan
$bulan = array("January", "Pebruary", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Okotober", "Nopember", "Desember");
//Buat daftar nama hari dalam bahasa indonesia
$hari = array("Minggu", "Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu");
$month = intval(date('m')) - 1;
$days = date('w');
$tgl_angka = date('d');
$year = date('Y');
?>
<?php
include '../config/functions.php'; //include function.php - very important
include '../config/koneksi.php';

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
            <body onload="setInterval('displayServerTime()', 1000);">
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
                                        <img class="nav-user-photo" src="../assets/img/img-anggota/<?= $row['pegawai_foto']; ?>" alt="<?php echo $hasil['pegawai_nama']; ?>" />
                                        <span class="user-info">
                                            <small>Welcome,</small>
                                            <?php echo $row['pegawai_nama']; ?>    
                                        </span>

                                        <i class="icon-caret-down"></i>
                                    </a>

                                    <ul class="user-menu pull-right dropdown-menu dropdown-yellow dropdown-caret dropdown-closer">

                                        <li>
                                            <a href="../anggota/profile?nip=<?php $row['pegawai_nip']; ?>">
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
                                    <a href="index">Home</a>

                                    <span class="divider">
                                        <i class="icon-angle-right arrow-icon"></i>
                                    </span>
                                </li>
                                <li class="active">Dashboard</li>
                            </ul><!--.breadcrumb-->
                        </div>

                        <div class="page-content">
                            <div class="page-header position-relative">
                                <h1>
                                    Dashboard
                                    <small>
                                        <i class="icon-double-angle-right"></i>
                                        Overview
                                    </small>
                                </h1>
                            </div><!--/.page-header-->

                            <div class="row-fluid">
                                <div class="span12">
                                    <!--PAGE CONTENT BEGINS-->

                                    <div class="alert alert-block alert-success">
                                        <button type="button" class="close" data-dismiss="alert">
                                            <i class="icon-remove"></i>
                                        </button>

                                        <i class="icon-ok green"></i>

                                        Selamat Datang
                                        <strong class="green">
                                            <?php
                                            echo $row['pegawai_nama'];
                                        }
                                    }
                                    ?>,
                                </strong>
                            </div>


                            <p>
                                <?php
                                echo 'Sekarang ini hari ' . $hari[$days] . ', tanggal ' . $tgl_angka . ' ' . $bulan[$month] . ' ' . $year . '.';
                                ?>
                                Pukul <span id="clock"> <?php print date('H:i:s'); ?></span>
                            </p>

                            <!--PAGE CONTENT ENDS-->
                        </div><!--/.span-->
                    </div><!--/.row-fluid-->
                </div><!--/.page-content-->



                <?php
                include '../template/footer.php';
            }
            ?>
            </body>
            </html>