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
    $query = mysql_query("SELECT * FROM master_bangunan AS a
                        INNER JOIN bangunan AS b
                        ON (a.ID_MASTER = b.ID_MASTER);") or die("Query failed: " . mysql_error());
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
                                <li class="active">Daftar Bangunan</li>
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
                                    Daftar Bangunan
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
                                                            Selamat data berhasil ditambahkan.
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
                                                            Selamat data berhasil diperbaharui.
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php
                                        }
                                    }
                                    ?>

                                    <div class="pull-right">
                                        <a href="bangunanAdd">
                                            <button class="btn btn-mini btn-primary btn-block" data-rel="tooltip" title="Tambah Data Bangunan">
                                                <i class="icon-plus bigger-130"></i>
                                                <strong>Tambah Data</strong>
                                            </button>
                                        </a>
                                    </div>
                                    <div class="space-18"></div>

                                    <div class="table-header">
                                        Angka Klasifikasi Resiko Kebakaran.
                                    </div>

                                    <table id="bangunan" class="table table-striped table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th>No.</th>
                                                <th>Peruntukan Bangunan</th>
                                                <th>Tingkat Bahaya</th>
                                                <th>Golongan</th>
                                                <th>Keterangan</th>
                                                <th></th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            <?php
                                            $no = 1;
                                            while ($row = mysql_fetch_array($query)) {
                                                ?>
                                                <tr>
                                                    <td><?php echo $no . '.'; ?></td>
                                                    <td><?= $row['NAMA_BANGUNAN'] ?></td>
                                                    <td><?= $row['TINGKAT_BANGUNAN'] ?></td>
                                                    <td><?= $row['NAMA_MASTER']; ?></td>
                                                    <td><?= $row['KET_BANGUNAN'] ?></td>
                                                    <td class="td-actions">
                                                        <div class="hidden-phone visible-desktop action-buttons">
                                                            <a class="green" href="bangunanEdit?id=<?php echo $row['ID_BANGUNAN']; ?>" class="tooltip-success" data-rel="tooltip" title="Edit">
                                                                <i class="icon-pencil bigger-130"></i>
                                                            </a>

                                                            <a class="red order-delete" id="<?= $row['ID_BANGUNAN']; ?>" href="" class="tooltip-error" data-rel="tooltip" title="Delete">
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
                                    <dl>
                                        <dt class="light-red">Note :</dt>
                                        <dd><i class="icon-warning-sign red"></i>&nbsp;&nbsp;<b>Semakin rendah</b> Tingkat Bahaya <b>semakin berbahaya</b> bahaya kebakaran yang terjadi.</dd>
                                    </dl>

                                    <div class="space-24"></div>

                                    <div class="table-header">
                                        Angka Klasifikasi Konstruksi Bangunan Gedung.
                                    </div>

                                    <table id="konstruksi" class="table table-striped table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th>No.</th>
                                                <th>Nama</th>
                                                <th>Tipe Konstruksi</th>
                                                <th>Angka Klasifikasi</th>
                                                <th></th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            <tr>
                                                <td>1.</td>
                                                <td>Konstruksi tahan api</td>
                                                <td>Tipe 1</td>
                                                <td>0.5</td>
                                                <td>
                                                    <a href="#detail-1" role="button" class="blue" data-toggle="modal">
                                                        More details...
                                                    </a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>2.</td>
                                                <td>Konstruksi kayu berat (tidak mudah terbakar)</td>
                                                <td>Tipe 2</td>
                                                <td>0.75</td>
                                                <td>
                                                    <a href="#detail-2" role="button" class="blue" data-toggle="modal">
                                                        More details...
                                                    </a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>3.</td>
                                                <td>Konstruksi biasa</td>
                                                <td>Tipe 3</td>
                                                <td>1.0</td>
                                                <td>
                                                    <a href="#detail-3" role="button" class="blue" data-toggle="modal">
                                                        More details...
                                                    </a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>4.</td>
                                                <td>Konstruksi kerangka kayu</td>
                                                <td>Tipe 4</td>
                                                <td>1.5</td>
                                                <td>
                                                    <a href="#detail-4" role="button" class="blue" data-toggle="modal">
                                                        More details...
                                                    </a>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>

                                    <h5 class="header smaller">Berdasarkan PERMEN PU No. 20 Tahun 2009 Tentang Pedoman Teknis Manajemen Proteksi Kebakaran di Perkotaan.</h5>

                                    <div id="detail-1" class="modal hide fade" tabindex="-1">
                                        <div class="modal-header no-padding">
                                            <div class="table-header">
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>

                                                <dd align="center">Klasifikasi Konstruksi Bangunan Gedung Tipe I</dd>
                                                <dd align="center">(Konstruksi Tahan Api)</dd>
                                            </div>
                                        </div>

                                        <div class="modal-body no-padding">
                                            <div class="row-fluid">
                                                <div class="space-4"></div>
                                                <p style="text-align:justify;text-justify:inter-word;">
                                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                    Bangunan gedung yang dibuat dengan bahan tahan api (beton, batadan lain-lain dengan bahan logam yang dilindungi) dengan struktur yang dibuat sedemikian, sehingga tahan terhadap peruntukan dan perambatan api.
                                                </p>
                                                <p>&nbsp;&nbsp;&nbsp;&nbsp;
                                                    <i class="icon-warning-sign red"></i>&nbsp;&nbsp;
                                                    Angka klasifikasi konstruksi : 0.5
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

                                    <div id="detail-2" class="modal hide fade" tabindex="-1">
                                        <div class="modal-header no-padding">
                                            <div class="table-header">
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>

                                                <dd align="center">Klasifikasi Konstruksi Bangunan Gedung Tipe II</dd>
                                                <dd align="center">(Konstruksi Kayu Berat - Tidak Mudah Terbakar)</dd>
                                            </div>
                                        </div>

                                        <div class="modal-body no-padding">
                                            <div class="row-fluid">
                                                <div class="space-4"></div>
                                                <p style="text-align:justify;text-justify:inter-word;">
                                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                    Bangunan gedung yang seluruh bagian konstruksinya (termasuk dinding, lantai, dan atap) terdiri dari bahan yang tidak mudah terbakar yang tidak termasuk sebagai bahan tahan api, termasuk bangunan gedung konstruksi kayu dengan dinding bata, tiang kayu 20.3 cm, lantai kayu 76 mm, atap kayu 51 mm, balok kayu 15.2 x 25.4 cm.
                                                </p>
                                                <p>&nbsp;&nbsp;&nbsp;&nbsp;
                                                    <i class="icon-warning-sign red"></i>&nbsp;&nbsp;
                                                    Angka klasifikasi konstruksi : 0.75
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

                                    <div id="detail-3" class="modal hide fade" tabindex="-1">
                                        <div class="modal-header no-padding">
                                            <div class="table-header">
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>

                                                <dd align="center">Klasifikasi Konstruksi Bangunan Gedung Tipe III</dd>
                                                <dd align="center">(Konstruksi Biasa)</dd>
                                            </div>
                                        </div>

                                        <div class="modal-body no-padding">
                                            <div class="row-fluid">
                                                <p style="text-align:justify;text-justify:inter-word;">
                                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                    Bangunan gedung dengan dinding luar bata atau bahan tidak mudah terbakar lainnya sedangkan bagian bangunan gedung lainnya terdiri dari kayu atau bahan yang mudah terbakar.
                                                </p>
                                                <p>&nbsp;&nbsp;&nbsp;&nbsp;
                                                    <i class="icon-warning-sign red"></i>&nbsp;&nbsp;
                                                    Angka klasifikasi konstruksi : 1.0
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

                                    <div id="detail-4" class="modal hide fade" tabindex="-1">
                                        <div class="modal-header no-padding">
                                            <div class="table-header">
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>

                                                <dd align="center">Klasifikasi Konstruksi Bangunan Gedung Tipe IV</dd>
                                                <dd align="center">(Konstruksi Kerangka Kayu)</dd>
                                            </div>
                                        </div>

                                        <div class="modal-body no-padding">
                                            <div class="row-fluid">
                                                <p style="text-align:justify;text-justify:inter-word;">
                                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                    Bangunan gedung (kecuali bangunan gedung rumah tinggal) yang strukturnya sebagian atau seluruhnya terdiri dari kayu atau bahan mudah terbakar yang tidak tergolong dalam konstruksi bangunan gedung biasa (tipe III).
                                                </p>
                                                <p>&nbsp;&nbsp;&nbsp;&nbsp;
                                                    <i class="icon-warning-sign red"></i>&nbsp;&nbsp;
                                                    Angka klasifikasi konstruksi : 1.5
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

    <!--basic scripts-->

    <!--[if !IE]>-->

    <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>

    <!--<![endif]-->

    <!--[if IE]>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <![endif]-->

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
    <script src="../assets/js-ace/jquery.dataTables.min.js"></script>
    <script src="../assets/js-ace/jquery.dataTables.bootstrap.js"></script>
    <script src="../assets/js-ace/bootbox.min.js"></script>
    <script src="../assets/js-ace/ace-elements.min.js"></script>
    <script src="../assets/js-ace/ace.min.js"></script>

    <!--inline scripts related to this page-->

    <script type="text/javascript">
        $(document).ready(function() {
            var bangunan = $('#bangunan').DataTable();
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
                            url: 'Fbangunan/prosesHapus.php',
                            data: 'hapusId=' + id,
                            success: function(data) {
                                if (data) {
                                    bootbox.alert("Data berhasil dihapus!");
                                    window.location.replace("bangunan.php");
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