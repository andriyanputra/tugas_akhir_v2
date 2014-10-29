<?php
include '../template/header.php';
session_start();
include ("../config/koneksi.php");
include '../config/functions.php'; //include function.php - very important

if (!loggedin()) { // check if the user is logged in, but if it isn't, it will redirect to the Login Form page. Noticed the difference?
    header("Location: ../login/login.php");
    exit();
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
                                                <?php if($row['id_level_user'] == 1 || $row['pegawai_nip'] == $d['pegawai_nip']) { ?>
                                                <div class="pull-right">
                                                    <a href="edit?nip=<?= $d['pegawai_nip']; ?>">
                                                        <button class="btn btn-small btn-primary" data-rel="tooltip" title="Edit Pegawai">
                                                            <i class="icon-edit"></i>
                                                            <strong>Edit Data</strong>
                                                        </button>
                                                    </a>
                                                </div>
                                                <?php } ?>
                                                <br>
                                                <br>
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
                                                    </div>
                                                </div>

                                                <div class="widget-body">
                                                    <div class="widget-main padding-8">
                                                        <div id="profile-feed-1" class="profile-feed">
                                                            <?php
                                                            $cek_log = mysql_query("SELECT a.pegawai_nama, b.login_date, b.logout_date
                                                                                    FROM pegawai AS a INNER JOIN log_user AS b
                                                                                    ON (a.pegawai_nip = b.pegawai_nip)
                                                                                    WHERE a.pegawai_nip = '".$_GET['nip']."'") or die("Query : ".mysql_error());
                                                            $cek = mysql_fetch_assoc($cek_log);
                                                            $cek_nama = $cek['pegawai_nama'];
                                                            $cek_login_date = strtotime($cek['login_date']);
                                                            $cek_logout_date = strtotime($cek['logout_date']);

                                                            /*function datediff($tgl1, $tgl2){
                                                                $tgl1 = (is_string($tgl1) ? strtotime($tgl1) : $tgl1);
                                                                $tgl2 = (is_string($tgl2) ? strtotime($tgl2) : $tgl2);
                                                                $diff_secs = abs($tgl1 - $tgl2);
                                                                $base_year = min(date("Y", $tgl1), date("Y", $tgl2));
                                                                $diff = mktime(0, 0, $diff_secs, 1, 1, $base_year);
                                                                return array( "years" => date("Y", $diff) - $base_year,
                                                                "months_total" => (date("Y", $diff) - $base_year) * 12 + date("n", $diff) - 1,
                                                                "months" => date("n", $diff) - 1,
                                                                "days_total" => floor($diff_secs / (3600 * 24)),
                                                                "days" => date("j", $diff) - 1,
                                                                "hours_total" => floor($diff_secs / 3600),
                                                                "hours" => date("G", $diff),
                                                                "minutes_total" => floor($diff_secs / 60),
                                                                "minutes" => (int) date("i", $diff),
                                                                "seconds_total" => $diff_secs,
                                                                "seconds" => (int) date("s", $diff)  );
                                                            }

                                                            $a = datediff($cek_login_date, date("Y/m/d/ H:i:s"));
                                                            $b = datediff($cek_logout_date, date("Y/m/d/ H:i:s"));*/
                                                            function timeAgo($time_ago){
                                                                $cur_time   = time();
                                                                $time_elapsed   = $cur_time - $time_ago;
                                                                $seconds    = $time_elapsed ;
                                                                $minutes    = round($time_elapsed / 60 );
                                                                $hours      = round($time_elapsed / 3600);
                                                                $days       = round($time_elapsed / 86400 );
                                                                $weeks      = round($time_elapsed / 604800);
                                                                $months     = round($time_elapsed / 2600640 );
                                                                $years      = round($time_elapsed / 31207680 );
                                                                // Seconds
                                                                if($seconds <= 60){
                                                                    echo "$seconds detik yang lalu.";
                                                                }
                                                                //Minutes
                                                                else if($minutes <=60){
                                                                    if($minutes==1){
                                                                        echo "1 menit yang lalu.";
                                                                    }
                                                                    else{
                                                                        echo "$minutes menit yang lalu.";
                                                                    }
                                                                }
                                                                //Hours
                                                                else if($hours <=24){
                                                                    if($hours==1){
                                                                        echo "1 jam yang lalu.";
                                                                    }else{
                                                                        echo "$hours jam yang lalu.";
                                                                    }
                                                                }
                                                                //Days
                                                                else if($days <= 7){
                                                                    if($days==1){
                                                                        echo "1 hari yang lalu.";
                                                                    }else{
                                                                        echo "$days hari yang lalu.";
                                                                    }
                                                                }
                                                                //Weeks
                                                                else if($weeks <= 4.3){
                                                                    if($weeks==1){
                                                                        echo "1 minggu yang lalu.";
                                                                    }else{
                                                                        echo "$weeks minggu yang lalu.";
                                                                    }
                                                                }
                                                                //Months
                                                                else if($months <=12){
                                                                    if($months==1){
                                                                        echo "1 bulan yang lalu.";
                                                                    }else{
                                                                        echo "$months bulan yang lalu.";
                                                                    }
                                                                }
                                                                //Years
                                                                else{
                                                                    if($years==1){
                                                                        echo "1 tahun yang lalu.";
                                                                    }else{
                                                                        echo "$years tahun yang lalu.";
                                                                    }
                                                                }
                                                            }
                                                            //$a = timeAgo($cek_login_date);
                                                            //$b = timeAgo($cek_logout_date);
                                                            ?>
                                                            <div class="profile-activity clearfix">
                                                                <div>
                                                                    <i class="pull-left thumbicon icon-key btn-info no-hover"></i>
                                                                    <a class="user" href="#"> <?php echo $cek_nama; ?> </a>

                                                                    logged in.
                                                                    <div class="time">
                                                                        <i class="icon-time bigger-110"></i>
                                                                        <?php echo timeAgo($cek_login_date); ?>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="profile-activity clearfix">
                                                                <div>
                                                                    <i class="pull-left thumbicon icon-off btn-inverse no-hover"></i>
                                                                    <a class="user" href="#"> <?php echo $cek_nama; ?> </a>

                                                                    logged out.
                                                                    <div class="time">
                                                                        <i class="icon-time bigger-110"></i>
                                                                        <?php echo timeAgo($cek_logout_date); ?>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
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
        }
            ?>
            </body>
            </html>

