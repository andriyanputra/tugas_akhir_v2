<?php
include '../template/header.php';
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
            <body>
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

                                <li class="green">
                                <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                                    <i class="icon-envelope icon-animated-vertical"></i>
                                    <span class="badge badge-success">5</span>
                                </a>

                                <ul class="pull-right dropdown-navbar dropdown-menu dropdown-caret dropdown-closer">
                                    <li class="nav-header">
                                        <i class="icon-envelope-alt"></i>
                                        5 Messages
                                    </li>

                                    <li>
                                        <a href="#">
                                            <img src="assets/avatars/avatar.png" class="msg-photo" alt="Alex's Avatar" />
                                            <span class="msg-body">
                                                <span class="msg-title">
                                                    <span class="blue">Alex:</span>
                                                    Ciao sociis natoque penatibus et auctor ...
                                                </span>

                                                <span class="msg-time">
                                                    <i class="icon-time"></i>
                                                    <span>a moment ago</span>
                                                </span>
                                            </span>
                                        </a>
                                    </li>

                                    <li>
                                        <a href="#">
                                            <img src="assets/avatars/avatar3.png" class="msg-photo" alt="Susan's Avatar" />
                                            <span class="msg-body">
                                                <span class="msg-title">
                                                    <span class="blue">Susan:</span>
                                                    Vestibulum id ligula porta felis euismod ...
                                                </span>

                                                <span class="msg-time">
                                                    <i class="icon-time"></i>
                                                    <span>20 minutes ago</span>
                                                </span>
                                            </span>
                                        </a>
                                    </li>

                                    <li>
                                        <a href="#">
                                            <img src="assets/avatars/avatar4.png" class="msg-photo" alt="Bob's Avatar" />
                                            <span class="msg-body">
                                                <span class="msg-title">
                                                    <span class="blue">Bob:</span>
                                                    Nullam quis risus eget urna mollis ornare ...
                                                </span>

                                                <span class="msg-time">
                                                    <i class="icon-time"></i>
                                                    <span>3:15 pm</span>
                                                </span>
                                            </span>
                                        </a>
                                    </li>

                                    <li>
                                        <a href="#">
                                            See all messages
                                            <i class="icon-arrow-right"></i>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                                <li class="light-blue">
                                    <a data-toggle="dropdown" href="#" class="dropdown-toggle">
                                        <?php ?>
                                        <img class="nav-user-photo" src="../assets/img/img-anggota/<?= $row['pegawai_foto']; ?>" alt="<?php echo $hasil['pegawai_nama']; ?>" />
                                        <span class="user-info">
                                            <small>Welcome,</small>
                                            <?php
                                            echo $row['pegawai_nama'];
                                        }
                                        ?>    
                                    </span>

                                    <i class="icon-caret-down"></i>
                                </a>

                                <ul class="user-menu pull-right dropdown-menu dropdown-yellow dropdown-caret dropdown-closer">

                                    <li>
                                        <a href="profile?nip=<?= $row['pegawai_nip']; ?>">
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

                <?php include '../template/sidebar.php'; ?>

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
                                <a href="list">Anggota Pemadam</a>

                                <span class="divider">
                                    <i class="icon-angle-right arrow-icon"></i>
                                </span>
                            </li>
                            <li class="active">Profil Anggota</li>
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
                            , Pukul <span id="clock1"></span>
                        </div>
                    </div>

                    <div class="page-content">
                        <div class="page-header position-relative">
                            <h1>
                                Halaman Profil
                                <small>
                                    <i class="icon-double-angle-right"></i>
                                    Overview
                                </small>
                            </h1>
                        </div><!--/.page-header-->

                        <div class="row-fluid">
                            <div class="span12">
                                <!--PAGE CONTENT BEGINS-->

                                <?php
                                if ($_GET['nip']) {
                                    $qry = mysql_query("SELECT * FROM pegawai,jabatan
                                                    WHERE jabatan.jabatan_id = pegawai.jabatan_id AND pegawai_nip = '" . $_GET['nip'] . "'");
                                    $d = mysql_fetch_assoc($qry);
                                    ?>

                                    <div>
                                        <div id="user-profile-1" class="user-profile row-fluid">
                                            <div class="span3 center">
                                                <div>
                                                    <span class="profile-picture">
                                                        <img id="avatar" src="../assets/img/img-anggota/<?= $d['pegawai_foto']; ?>" />
                                                    </span>

                                                    <div class="space-4"></div>

                                                    <div class="width-80 label label-info label-large arrowed-in arrowed-in-right">
                                                        <div class="inline position-relative">
                                                            <a href="#">
                                                                <span class="white middle bigger-120"><?= $d['pegawai_nama']; ?></span>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="space-6"></div>

                                                <div class="profile-contact-info">
                                                    <div class="profile-contact-links align-left">

                                                        <a class="btn btn-link" href="#">
                                                            <i class="icon-user bigger-120 blue"></i>
                                                            <?= $d['jabatan_nama']; ?>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="span9">

                                                <div class="space-12"></div>
                                                <div class="center">
                                                    <span class="hidden btn btn-app btn-small btn-light no-hover">
                                                        <span class="bigger-150 blue"></span>
                                                        <span class="smaller-90"></span>
                                                    </span>

                                                    <span class="hidden btn btn-app btn-small btn-light no-hover">
                                                        <span class="bigger-150 blue"></span>
                                                        <span class="smaller-90"></span>
                                                    </span>

                                                    <span class="hidden btn btn-app btn-small btn-light no-hover">
                                                        <span class="bigger-150 blue"></span>
                                                        <span class="smaller-90"></span>
                                                    </span>

                                                    <span class="hidden btn btn-app btn-small btn-light no-hover">
                                                        <span class="bigger-150 blue"></span>
                                                        <span class="smaller-90"></span>
                                                    </span>

                                                    <span class="hidden btn btn-app btn-small btn-yellow no-hover">
                                                        <span class="bigger-175"></span>
                                                        <span class="smaller-90"></span>
                                                    </span>

                                                    <span class="hidden btn btn-app btn-small btn-pink no-hover">
                                                        <span class="bigger-175"></span>
                                                        <span class="smaller-90"></span>
                                                    </span>

                                                    <span class="hidden btn btn-app btn-small btn-grey no-hover">
                                                        <span class="bigger-175"></span>
                                                        <span class="smaller-90"></span>
                                                    </span>

                                                    <span class="hidden btn btn-app btn-small btn-success no-hover">
                                                        <span class="bigger-175"></span>
                                                        <span class="smaller-90"></span>
                                                    </span>

                                                    <a href="edit?nip=<?= $d['pegawai_nip']; ?>">
                                                        <button class="btn btn-small btn-primary" data-rel="tooltip" title="Edit Pegawai">
                                                            <i class="icon-edit"></i>
                                                            <strong>Edit Data</strong>
                                                        </button>
                                                    </a>
                                                </div>

                                                <div class="space-6"></div>

                                                <div class="profile-user-info profile-user-info-striped">
                                                    <div class="profile-info-row">
                                                        <div class="profile-info-name"> Nomor Induk </div>

                                                        <div class="profile-info-value">
                                                            <span id="nomor"><?= $d['pegawai_nip']; ?></span>
                                                        </div>
                                                    </div>

                                                    <div class="profile-info-row">
                                                        <div class="profile-info-name"> Nama Lengkap </div>

                                                        <div class="profile-info-value">
                                                            <span id="username"><?= $d['pegawai_nama']; ?></span>
                                                        </div>
                                                    </div>

                                                    <div class="profile-info-row">
                                                        <div class="profile-info-name"> Jenis Kelamin </div>

                                                        <div class="profile-info-value">
                                                            <span id="gender"><?= $d['pegawai_kelamin']; ?></span>
                                                        </div>
                                                    </div>

                                                    <div class="profile-info-row">
                                                        <div class="profile-info-name"> TTL </div>

                                                        <div class="profile-info-value">
                                                            <i class="icon-map-marker light-orange bigger-110"></i>
                                                            <span id="age"><?= $d['pegawai_tempat']; ?></span>
                                                            <?php $tgl_format = date("d-m-Y", strtotime($d['pegawai_tanggal'])); ?>
                                                            <span id="age"><?= $tgl_format; ?></span>
                                                        </div>
                                                    </div>

                                                    <div class="profile-info-row">
                                                        <div class="profile-info-name"> Alamat </div>

                                                        <div class="profile-info-value">
                                                            <i class="icon-map-marker light-orange bigger-110"></i>
                                                            <span id="country"><?= $d['pegawai_alamat']; ?></span>
                                                        </div>
                                                    </div>

                                                    <div class="profile-info-row">
                                                        <div class="profile-info-name"> Kontak </div>

                                                        <div class="profile-info-value">
                                                            <span id="age"><?= $d['pegawai_no_telp']; ?></span>
                                                        </div>
                                                    </div>
                                                <?php } ?>

                                            </div>

                                            <div class="space-20"></div>

                                            <div class="widget-box transparent">
                                                <div class="widget-header widget-header-small">
                                                    <h4 class="blue smaller">
                                                        <i class="icon-rss orange"></i>
                                                        Recent Activities
                                                    </h4>

                                                    <div class="widget-toolbar action-buttons">
                                                        <a href="#" data-action="reload">
                                                            <i class="icon-refresh blue"></i>
                                                        </a>

                                                        &nbsp;
                                                        <a href="#" class="pink">
                                                            <i class="icon-trash"></i>
                                                        </a>
                                                    </div>
                                                </div>

                                                <div class="widget-body">
                                                    <div class="widget-main padding-8">
                                                        <div id="profile-feed-1" class="profile-feed">
                                                            <div class="profile-activity clearfix">
                                                                <div>
                                                                    <img class="pull-left" alt="Andri's avatar" src="../assets/img/a.jpg" />
                                                                    <a class="user" href="#"> Andriyan </a>
                                                                    changed his profile photo.
                                                                    <a href="#">Take a look</a>

                                                                    <div class="time">
                                                                        <i class="icon-time bigger-110"></i>
                                                                        an hour ago
                                                                    </div>
                                                                </div>

                                                                <div class="tools action-buttons">
                                                                    <a href="#" class="blue">
                                                                        <i class="icon-pencil bigger-125"></i>
                                                                    </a>

                                                                    <a href="#" class="red">
                                                                        <i class="icon-remove bigger-125"></i>
                                                                    </a>
                                                                </div>
                                                            </div>

                                                            <div class="profile-activity clearfix">
                                                                <div>
                                                                    <img class="pull-left" alt="Susan Smith's avatar" src="../assets/img/avatar1.png" />
                                                                    <a class="user" href="#"> Susan Smith </a>

                                                                    is now friends with Alex Doe.
                                                                    <div class="time">
                                                                        <i class="icon-time bigger-110"></i>
                                                                        2 hours ago
                                                                    </div>
                                                                </div>

                                                                <div class="tools action-buttons">
                                                                    <a href="#" class="blue">
                                                                        <i class="icon-pencil bigger-125"></i>
                                                                    </a>

                                                                    <a href="#" class="red">
                                                                        <i class="icon-remove bigger-125"></i>
                                                                    </a>
                                                                </div>
                                                            </div>

                                                            <div class="profile-activity clearfix">
                                                                <div>
                                                                    <img class="pull-left" alt="David Palms's avatar" src="../assets/img/avatar4.png" />
                                                                    <a class="user" href="#"> David Palms </a>

                                                                    left a comment on Alex's wall.
                                                                    <div class="time">
                                                                        <i class="icon-time bigger-110"></i>
                                                                        8 hours ago
                                                                    </div>
                                                                </div>

                                                                <div class="tools action-buttons">
                                                                    <a href="#" class="blue">
                                                                        <i class="icon-pencil bigger-125"></i>
                                                                    </a>

                                                                    <a href="#" class="red">
                                                                        <i class="icon-remove bigger-125"></i>
                                                                    </a>
                                                                </div>
                                                            </div>

                                                            <div class="profile-activity clearfix">
                                                                <div>
                                                                    <i class="pull-left thumbicon icon-key btn-info no-hover"></i>
                                                                    <a class="user" href="#"> Andriyan </a>

                                                                    logged in.
                                                                    <div class="time">
                                                                        <i class="icon-time bigger-110"></i>
                                                                        12 hours ago
                                                                    </div>
                                                                </div>

                                                                <div class="tools action-buttons">
                                                                    <a href="#" class="blue">
                                                                        <i class="icon-pencil bigger-125"></i>
                                                                    </a>

                                                                    <a href="#" class="red">
                                                                        <i class="icon-remove bigger-125"></i>
                                                                    </a>
                                                                </div>
                                                            </div>

                                                            <div class="profile-activity clearfix">
                                                                <div>
                                                                    <i class="pull-left thumbicon icon-off btn-inverse no-hover"></i>
                                                                    <a class="user" href="#"> Andriyan </a>

                                                                    logged out.
                                                                    <div class="time">
                                                                        <i class="icon-time bigger-110"></i>
                                                                        16 hours ago
                                                                    </div>
                                                                </div>

                                                                <div class="tools action-buttons">
                                                                    <a href="#" class="blue">
                                                                        <i class="icon-pencil bigger-125"></i>
                                                                    </a>

                                                                    <a href="#" class="red">
                                                                        <i class="icon-remove bigger-125"></i>
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="hr hr2 hr-double"></div>

                                            <div class="space-6"></div>

                                            <div class="center">
                                                <a href="#" class="btn btn-small btn-primary">
                                                    <i class="icon-rss bigger-150 middle"></i>

                                                    View more activities
                                                    <i class="icon-on-right icon-arrow-right"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!--PAGE CONTENT ENDS-->
                            </div><!--/.span-->
                        </div><!--/.row-fluid-->
                    </div><!--/.page-content-->


                    <?php
                    include '../template/footer.php';
                }
            }
            ?>
            </body>
            </html>

