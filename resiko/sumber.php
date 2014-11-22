<?php
session_start();
include '../template/header.php';
include ("../config/koneksi.php");
include '../config/functions.php'; //include function.php - very important


if (!loggedin()) { // check if the user is logged in, but if it isn't, it will redirect to the Login Form page. Noticed the difference?
    header("Location: ../login/login.php");
    exit();
}

if ($_SESSION['level'] != 1 && $_COOKIE['level'] != 1) {
    //alert('Maaf Anda tidak diperkenankan mengakses halaman tersebut');
    echo "<script> window.history.back(); </script>";
    exit(); //jika bukan admin jangan lanjut
}

if ((isset($_SESSION['pegawai_nomor']) && isset($_SESSION['level'])) || (isset($_COOKIE['level']) && isset($_COOKIE['pegawai_nomor']))) {
    $sql = mysql_query("SELECT * FROM pegawai WHERE (pegawai_nip='" . $_SESSION['pegawai_nomor'] . "' AND id_level_user='" . $_SESSION['level'] . "') 
                        OR (pegawai_nip='" . $_COOKIE['pegawai_nomor'] . "' AND id_level_user='" . $_COOKIE['level'] . "')") or die("Query : " . mysql_error());
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

            <body onload="load()">
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
                                        }else if ($_GET['msg'] == 'success_delete') {
                                            ?>
                                            <div class="widget-box transparent">
                                                <div class="widget-body">
                                                    <div class="widget-main padding-6">
                                                        <div class="alert alert-block alert-success">
                                                            <button type="button" class="close" data-dismiss="alert">
                                                                <i class="icon-remove"></i>
                                                            </button>

                                                            <i class="icon-ok green"></i>&nbsp;
                                                            <strong>Selamat</strong>, data berhasil dihapus.
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php
                                        }
                                    }
                                    ?>

                                    <div class="row-fluid">
                                        <div class="span12">
                                            <div>
                                                <div id="map"></div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row-fluid">
                                        <div class="span12">
                                            <div class="space-32"></div><div class="space-32"></div>
                                            <div class="space-32"></div><div class="space-32"></div>
                                            <div class="space-32"></div>
                                            <div class="space-32"></div>
                                            <div class="space-32"></div>
                                            <div class="space-32"></div>
                                            <div class="space-32"></div>
                                            <div class="pull-right">
                                                <a href="sumberTambah">
                                                    <button class="btn btn-mini btn-primary btn-block" data-rel="tooltip" title="Tambah Sumber Air">
                                                        <i class="icon-plus bigger-130"></i>
                                                        <strong>Tambah Data</strong>
                                                    </button>
                                                </a>
                                            </div>
                                            <div class="space-30"></div>
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
                                                            <!--<td><?php //echo $data['DESA_NAMA'];         ?></td>-->
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
                                        </div>
                                    </div>
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
    <script src="../assets/js-ace/sweet-alert.js"></script>
    <script src="../assets/js-ace/ace-elements.min.js"></script>
    <script src="../assets/js-ace/ace.min.js"></script>
    <script src='../assets/ext/appframework.js'></script>
    <script src='../assets/ext/af.actionsheet.js'></script>
    <script src='intelxdk.js'></script>

    <script type="text/javascript">
        /* This code is used to run as soon as Intel activates */
        var onDeviceReady = function () {
            //hide splash screen
            intel.xdk.device.hideSplashScreen();
        };
        document.addEventListener("intel.xdk.device.ready", onDeviceReady, false);
    </script>
    <!--inline scripts related to this page-->

    <script type="text/javascript">
        $(document).ready(function () {
            var sumber = $('#sumber').DataTable();
            //var konstruksi = $('#konstruksi').DataTable();
        });
    </script>
    <script type="text/javascript">
    //document.querySelector('a.red').onclick = function(){
    //    swal("Here's a message!");
    //};
        $(function () {
            $(document).on(ace.click_event, ".order-delete", function (e) {
                var id = $(this).attr('id');
                e.preventDefault();
                bootbox.confirm("Apakah Anda yakin ?", function (result) {
                    if (result) {
                        //sent request to delete order with given id
                        $.ajax({
                            type: 'get',
                            url: 'Fsumber/prosesHapus.php',
                            data: 'id=' + id,
                            success: function (data) {
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
    <script type="text/javascript">

        function load() {
            var map = new google.maps.Map(document.getElementById("map"), {
                center: new google.maps.LatLng(-7.4576628,112.7300144),
                zoom: 10,
                mapTypeId: 'roadmap'
            });
            var infoWindow = new google.maps.InfoWindow;

            // Bagian ini digunakan untuk mendapatkan data format XML yang dibentuk dalam dataLokasi.php
            downloadUrl("toxml.php", function (data) {
                var xml = data.responseXML;
                var markers = xml.documentElement.getElementsByTagName("marker");
                for (var i = 0; i < markers.length; i++) {
                    var name = markers[i].getAttribute("name");
                    var address = markers[i].getAttribute("address");
                    var type = markers[i].getAttribute("category");
                    var point = new google.maps.LatLng(
                            parseFloat(markers[i].getAttribute("lat")),
                            parseFloat(markers[i].getAttribute("lng")));
                    var html = "<b>" + name + "</b><br/>" + address;
                    //var icon = customIcons[type] || {};
                    var marker = new google.maps.Marker({
                        map: map,
                        position: point,
                        icon: 'http://maps.google.com/mapfiles/ms/micons/blue.png'

                    });
                    bindInfoWindow(marker, map, infoWindow, html);
                }
            });
        }

        function bindInfoWindow(marker, map, infoWindow, html) {
            google.maps.event.addListener(marker, 'click', function () {
                infoWindow.setContent(html);
                infoWindow.open(map, marker);
            });
        }

        function downloadUrl(url, callback) {
            var request = window.ActiveXObject ?
                    new ActiveXObject('Microsoft.XMLHTTP') :
                    new XMLHttpRequest;

            request.onreadystatechange = function () {
                if (request.readyState == 4) {
                    request.onreadystatechange = doNothing;
                    callback(request, request.status);
                }
            };

            request.open('GET', url, true);
            request.send(null);
        }

        function doNothing() {
        }
    </script>
</body>
</html>