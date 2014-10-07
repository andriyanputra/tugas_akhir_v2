<?php
include '../template/header.php';
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
session_start();
include ("../config/koneksi.php");
include '../config/functions.php'; //include function.php - very important

if (!loggedin()) { // check if the user is logged in, but if it isn't, it will redirect to the Login Form page. Noticed the difference?
    header("Location: ../login/login.php");
    exit();
}

if (isset($_SESSION['pegawai_nomor']) || isset($_COOKIE['pegawai_nomor'])) {
    $sql = mysql_query("SELECT * FROM pegawai WHERE pegawai_nip='" . $_SESSION['pegawai_nomor'] . "' OR pegawai_nip='" . $_COOKIE['pegawai_nomor'] . "'");
    $query_kec = mysql_query("SELECT a.NAMA_SUMBER,GROUP_CONCAT(KECAMATAN_NAMA SEPARATOR ', ') AS Kecamatan, a.KET_SUMBER, a.ID_SUMBER
                            FROM sumber_air a 
                            JOIN sumber_air_kecamatan ON a.ID_SUMBER=sumber_air_kecamatan.ID_SUMBER
                            JOIN kecamatan ON sumber_air_kecamatan.KECAMATAN_ID=kecamatan.KECAMATAN_ID
                            GROUP BY a.NAMA_SUMBER") or die("Query failed: " . mysql_error());
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
                                            <a href="../anggota/profile?nip=<?= $row['pegawai_nip']; ?>">
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
                                <li class="active">Sumber Air</li>
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
                                , Pukul <span id="clock"></span>
                            </div>
                        </div>

                        <div class="page-content">
                            <div class="page-header position-relative">
                                <h1>
                                    Daftar Sumber Air
                                    <small>
                                        <i class="icon-double-angle-right"></i>
                                        Daftar Sumber Air di Kabupaten Sidoarjo
                                    </small>
                                </h1>
                            </div><!--/.page-header-->

                            <div class="row-fluid">
                                <div class="span12">
                                    <!--PAGE CONTENT-->
                                    <?php
                                    if (isset($_GET['msg'])) {
                                        if ($_GET['msg'] == 'success') {
                                            ?>
                                            <div class="widget-box transparent">
                                                <div class="widget-body">
                                                    <div class="widget-main padding-6">
                                                        <div class="alert alert-block alert-success">
                                                            <button type="button" class="close" data-dismiss="alert">
                                                                <i class="icon-remove"></i>
                                                            </button>

                                                            <i class="icon-ok green"></i>&nbsp;
                                                            <strong>Selamat</strong>, data berhasil ditambahkan.
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php
                                        } else if ($_GET['msg'] == 'notif1') {
                                            ?>
                                            <div class="widget-box transparent">
                                                <div class="widget-body">
                                                    <div class="widget-main padding-6">
                                                        <div class="alert alert-block alert-warning">
                                                            <button type="button" class="close" data-dismiss="alert">
                                                                <i class="icon-remove"></i>
                                                            </button>

                                                            <i class="icon-bullhorn bigger-110"></i>&nbsp;
                                                            Tidak terjadi penambahan atau perubahan data.
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php
                                        } else if ($_GET['msg'] == 'success_edit') {
                                            ?>
                                            <div class="widget-box transparent">
                                                <div class="widget-body">
                                                    <div class="widget-main padding-6">
                                                        <div class="alert alert-block alert-success">
                                                            <button type="button" class="close" data-dismiss="alert">
                                                                <i class="icon-remove"></i>
                                                            </button>

                                                            <i class="icon-ok green"></i>&nbsp;
                                                            <strong>Selamat</strong>, data berhasil diperbaharui.
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php
                                        }
                                    }
                                    ?>

                                    <div class="pull-right">
                                        <a href="sumberTambah">
                                            <button class="btn btn-mini btn-primary btn-block" data-rel="tooltip" title="Tambah Sumber Air">
                                                <i class="icon-plus bigger-130"></i>
                                                <strong>Tambah Data</strong>
                                            </button>
                                        </a>
                                    </div>
                                    <div class="space-18"></div>
                                    <div class="table-header">
                                        Sumber Air yang Berada di Kabupaten Sidoarjo
                                    </div>

                                    <table id="sumber" class="table table-striped table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th class="center">No.</th>
                                                <th>Nama</th>
                                                <th>Kecamatan</th>
                                                <!--<th>Desa</th>-->
                                                <th>Keterangan</th>
                                                <th></th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            <?php
                                            $no = 1;
                                            while ($data = mysql_fetch_array($query_kec)) {
                                                ?>
                                                <tr>
                                                    <td><?php echo '' . $no . '.'; ?></td>
                                                    <td><?php echo $data['NAMA_SUMBER']; ?></td>
                                                    <td><?php echo $data['Kecamatan']; ?></td>
                                                    <!--<td><?php //echo $data['DESA_NAMA'];   ?></td>-->
                                                    <td><?php echo $data['KET_SUMBER']; ?></td>
                                                    <td class="td-actions">
                                                        <div class="hidden-phone visible-desktop action-buttons">
                                                            <a class="green" href="sumberEdit?id=<?php echo $data['ID_SUMBER']; ?>" class="tooltip-success" data-rel="tooltip" title="Edit">
                                                                <i class="icon-pencil bigger-130"></i>
                                                            </a>

                                                            <a class="red order-delete" id="<?php echo $data['ID_SUMBER']; ?>" href="" class="tooltip-error" data-rel="tooltip" title="Delete">
                                                                <i class="icon-trash bigger-130"></i>
                                                            </a>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <?php
                                                $no++;
                                            }
                                            ?>
                                        </tbody>
                                    </table>

                                    <!--PAGE CONTENT ENDS-->
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
                        <input type="checkbox" class="ace-checkbox-2" id="ace-settings-header" />
                        <label class="lbl" for="ace-settings-header"> Fixed Header</label>
                    </div>

                    <div>
                        <input type="checkbox" class="ace-checkbox-2" id="ace-settings-sidebar" />
                        <label class="lbl" for="ace-settings-sidebar"> Fixed Sidebar</label>
                    </div>

                    <div>
                        <input type="checkbox" class="ace-checkbox-2" id="ace-settings-breadcrumbs" />
                        <label class="lbl" for="ace-settings-breadcrumbs"> Fixed Breadcrumbs</label>
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
    <script src="../assets/js-ace/jquery.dataTables.min.js"></script>
    <script src="../assets/js-ace/jquery.dataTables.bootstrap.js"></script>
    <script src="../assets/js-ace/bootbox.min.js"></script>
    <script src="../assets/js-ace/ace-elements.min.js"></script>
    <script src="../assets/js-ace/ace.min.js"></script>

    <!--inline scripts related to this page-->

    <script type="text/javascript">
        $(document).ready(function() {
            var sumber = $('#sumber').DataTable();
            //var konstruksi = $('#konstruksi').DataTable();
        });
    </script>
    <script type="text/javascript">
        $(function() {
            $(document).on(ace.click_event, ".order-delete", function(e) {
                var id = $(this).attr('id');
                e.preventDefault();
                bootbox.confirm("Apakah Anda yakin ?", function(result) {
                    if (result) {
                        //sent request to delete order with given id
                        $.ajax({
                            type: 'get',
                            url: 'Fsumber/prosesHapus.php',
                            data: 'hapusId=' + id,
                            success: function(data) {
                                if (data) {
                                    bootbox.alert("Data berhasil dihapus!");
                                    window.location.replace("sumber.php");
                                } else {
                                    bootbox.alert("Maaf terjadi kesalahan proses penghapusan data!");
                                }
                            }
                        });
                    }
                });
            });
        });
    </script>
    <script type="text/javascript">
        <!--
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
//-->
    </script>
</body>
</html>