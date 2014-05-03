<?php
include '../template/header.php';
session_start();
include ("../config/koneksi.php");
if ($_SESSION['pegawai_nip'] && $_SESSION['pegawai_password']) {
    $sql = mysql_query("SELECT * FROM pegawai WHERE pegawai_nip='" . $_SESSION['pegawai_nip'] . "' AND pegawai_password='" . $_SESSION['pegawai_password'] . "'");
    if ($sql) {
        $hasil = mysql_fetch_assoc($sql);
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
                                    <img class="nav-user-photo" src="../assets/img/b.jpg" alt="<?php echo $hasil['pegawai_nama']; ?>" />
                                    <span class="user-info">
                                        <small>Welcome,</small>
                                        <?php
                                        echo $hasil['pegawai_nama'];
                                    }
                                    ?>    
                                </span>

                                <i class="icon-caret-down"></i>
                            </a>

                            <ul class="user-menu pull-right dropdown-menu dropdown-yellow dropdown-caret dropdown-closer">

                                <li>
                                    <a href="profile">
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
                        <li class="active">Profil User</li>
                    </ul><!--.breadcrumb-->
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

                            <div>
                                <div id="user-profile-1" class="user-profile row-fluid">
                                    <div class="span3 center">
                                        <div>
                                            <span class="profile-picture">
                                                <img id="avatar" class="editable" alt="Andri's Avatar" src="../assets/img/a.jpg" />
                                            </span>

                                            <div class="space-4"></div>

                                            <div class="width-80 label label-info label-large arrowed-in arrowed-in-right">
                                                <div class="inline position-relative">
                                                    <a href="#">
                                                        <span class="white middle bigger-120">Andriyan D. Putranto</span>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="space-6"></div>

                                        <div class="profile-contact-info">
                                            <div class="profile-contact-links align-left">
                                                <a class="btn btn-link" href="#">
                                                    <i class="icon-circle bigger-120 green"></i>
                                                    Status : Aktif
                                                </a>

                                                <a class="btn btn-link" href="#">
                                                    <i class="icon-user bigger-120 blue"></i>
                                                    Administrator
                                                </a>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="span9">

                                        <div class="space-12"></div>

                                        <div class="profile-user-info profile-user-info-striped">
                                            <div class="profile-info-row">
                                                <div class="profile-info-name"> Nama </div>

                                                <div class="profile-info-value">
                                                    <span class="editable" id="username">Andriyan Dwi Putranto</span>
                                                </div>
                                            </div>

                                            <div class="profile-info-row">
                                                <div class="profile-info-name"> Alamat </div>

                                                <div class="profile-info-value">
                                                    <i class="icon-map-marker light-orange bigger-110"></i>
                                                    <span class="editable" id="country">Indonesia</span>
                                                    <span class="editable" id="city">Kab. Sidoarjo</span>
                                                </div>
                                            </div>

                                            <div class="profile-info-row">
                                                <div class="profile-info-name"> Umur </div>

                                                <div class="profile-info-value">
                                                    <span class="editable" id="age">21</span>
                                                </div>
                                            </div>

                                            <div class="profile-info-row">
                                                <div class="profile-info-name"> Joined </div>

                                                <div class="profile-info-value">
                                                    <span class="editable" id="signup">20/06/2010</span>
                                                </div>
                                            </div>

                                            <div class="profile-info-row">
                                                <div class="profile-info-name"> Last Online </div>

                                                <div class="profile-info-value">
                                                    <span class="editable" id="login">3 hours ago</span>
                                                </div>
                                            </div>

                                            <div class="profile-info-row">
                                                <div class="profile-info-name"> About Me </div>

                                                <div class="profile-info-value">
                                                    <span class="editable" id="about">Editable as WYSIWYG</span>
                                                </div>
                                            </div>
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
            } else {
                header("location:../login/login");
            }
            ?>
            </body>
            </html>

