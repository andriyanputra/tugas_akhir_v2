<?php
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
                                            $q_pesan = mysql_query("SELECT b.pesan_id, b.pesan_dari, b.pesan_isi, a.resiko_tanggal_start, c.pegawai_nama
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
                                            <a href="../pesan/detail?id=<?php echo $pesan['pesan_id'];?>">
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
                                        <a href="">Pasca</a>

                                        <span class="divider">
                                            <i class="icon-angle-right arrow-icon"></i>
                                        </span>
                                    </li>
                                    <li class="active">Selesai</li>
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
                                <div class="row-fluid">
                                    <div class="span12">
                                        <!--PAGE CONTENT BEGINS-->

                                        <div class="error-container">
                                            <div class="well">
                                                <h1 class="grey lighter smaller center">
                                                    <p align="center">
                                                        <img src='../assets/img/tulisan.png' width="568" height="150" />
                                                    </p>
                                                </h1>

                                                <hr />
                                                <h1 class="lighter smaller center">
                                                    <span class="bigger-240">
                                                        <i class="icon-thumbs-up"></i>
                                                    </span>
                                                    Well Done, Keep Fire In Your Life.
                                                </h1>

                                                <div class="space"></div>

                                                <div>
                                                    <ul class="unstyled spaced inline bigger-110">
                                                        <li>
                                                            <a href="#read" role="button" data-toggle="modal">
                                                                <i class="icon-hand-right blue"></i>
                                                                Read the error
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>

                                                <hr />
                                                <div class="space"></div>

                                                <div class="row-fluid">
                                                    <div class="center">
                                                        <a href="#null" onclick="javascript:history.back();" class="btn btn-grey">
                                                            <i class="icon-arrow-left"></i>
                                                            Kembali
                                                        </a>

                                                        <a href="../beranda/index" class="btn btn-primary">
                                                            <i class="icon-dashboard"></i>
                                                            Dashboard
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!--PAGE CONTENT ENDS-->
                                    </div><!--/.span-->
                                </div><!--/.row-fluid-->
                            </div><!--/.page-content-->

                            <div id="read" class="modal hide fade" tabindex="-1">
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

                            <?php
                            include '../template/footer.php';
                        }
                    }
                }
                ?>  
                </body>
                </html>