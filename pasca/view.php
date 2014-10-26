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
    $query = mysql_query("SELECT * FROM resiko AS a INNER JOIN pasca AS b ON (a.resiko_id = b.resiko_id)
                            INNER JOIN kecamatan AS c ON (c.KECAMATAN_ID = a.KECAMATAN_ID)
                            INNER JOIN desa AS d ON (d.KECAMATAN_ID = c.KECAMATAN_ID)
                            INNER JOIN bangunan AS e ON (e.ID_BANGUNAN = a.ID_BANGUNAN)
                            INNER JOIN master_bangunan AS f ON (e.ID_MASTER = f.ID_MASTER)
                            INNER JOIN foto_resiko AS g ON (a.resiko_id = g.resiko_id)
                            WHERE a.resiko_id = '".$_GET['id']."'") or die(mysql_error());
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
                                <li class="active">Lihat Kejadian Kebakaran</li>
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
                                    Lihat Kejadian Kebakaran
                                    <small>
                                        <i class="icon-double-angle-right"></i>
                                        Overview
                                    </small>
                                </h1>
                            </div><!--/.page-header-->

                            <div class="row-fluid">
                                <div class="span12">
                                    <!--PAGE CONTENT BEGINS-->
                                    <div class="row-fluid">
                                        <div class="span6">
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
                                        </div><!--/.span6-->
                                        <div class="span6">
                                            <div class="control-group">
                                                <label class="control-label" for="nama"><b>Nama Pelapor :</b></label>
                                                <?php $tlp = substr($r['nomor_telp'],0,-3); ?>
                                                <div class="controls">
                                                    <?php echo $r['nama_pelapor'].' ('.$tlp.'***)';?>
                                                </div>
                                            </div>

                                            <div class="control-group">
                                                <label class="control-label" for="alamat"><b>Alamat :</b></label>

                                                <div class="controls">
                                                    <?php echo $r['alamat_pelapor'].' Ds. '.$r['DESA_NAMA'].', Kec. '.$r['KECAMATAN_NAMA'].', Kab. Sidoarjo.' ?>
                                                </div>
                                            </div>
                                            <?php
                                                $tgl = $r['resiko_tanggal_start'];
                                                $tanggal = date('d M Y', strtotime($tgl));
                                                $hari = date('l', strtotime($tgl));
                                                if($hari == 'Sunday')$hari = 'Minggu';else if($hari == 'Monday')$hari = 'Senin';
                                                else if($hari == 'Tuesday')$hari = 'Selasa';else if($hari == 'Wednesday')$hari = 'Rabu';
                                                else if($hari == 'Thursday')$hari = 'Kamis';else if($hari == 'Friday')$hari = 'Jumat';
                                                else if($hari == 'Saturday')$hari = 'Sabtu';
                                                $pukul = date('H:i', strtotime($tgl));
                                            ?>
                                            <div class="control-group">
                                                <label class="control-label" for="tanggal"><b>Tanggal :</b></label>

                                                <div class="controls">
                                                    <?php echo $hari.', '.$tanggal.'. Pukul: '.$pukul.' WIB'; ?>
                                                </div>
                                            </div>

                                            <div class="control-group">
                                                <label class="control-label" for="tanggal"><b>Tipe Proteksi :</b></label>
                                                <?php if($r['tipe_proteksi'] == 'MPKP') $tipe_proteksi = 'MPKP (Manajemen Proteksi Kebakaran Perkotaan)'; ?>
                                                <?php if($r['tipe_proteksi'] == 'MPKL') $tipe_proteksi = 'MPKL (Manajemen Proteksi Kebakaran Lingkungan)'; ?>
                                                <?php if($r['tipe_proteksi'] == 'MPKBG') $tipe_proteksi = 'MPKBG (Manajemen Proteksi Kebakaran Bangunan)'; ?>
                                                <div class="controls">
                                                    <?php echo $tipe_proteksi; ?>
                                                </div>
                                            </div>

                                            <div class="control-group">
                                                <label class="control-label" for="tanggal"><b>Keterangan Kejadian :</b></label>

                                                <div class="controls">
                                                    <?php echo $r['exposure']; ?>
                                                </div>
                                            </div>

                                            <div class="control-group">
                                                <label class="control-label" for="tanggal"><b>Bangunan Terbakar :</b></label>

                                                <div class="controls">
                                                    <?php echo $r['NAMA_BANGUNAN'].' ('.$r['NAMA_MASTER'].')'; ?>
                                                </div>
                                            </div>
                                        </div><!--/.span6-->
                                    </div><!--/.row-fluid-->
                                    <div class="space-6"></div>
                                        <div class="row-fluid">
                                            <div class="span6">
                                                <div class="control-group">
                                                    <label class="control-label" for="tanggal"><b>Deskripsi Bangunan & Proses Pemadaman :</b></label>

                                                    <div class="controls">
                                                    <?php $pasokan = round($r['pasokan_air_minimum']/264.172052, 1); ?>
                                                    <?php $laju = round($r['penerapan_air']/3.7854118, 1); ?>
                                                        <ul>
                                                            <li>Penanganan Kebakaran : <?php echo $r['tepol']; ?></li>
                                                            <li>Volume Bangunan : <?php echo $r['panjang'].' x '.$r['lebar'].' x '.$r['tinggi'].' m<sup>3</sup>' ?></li>
                                                            <li>Pasokan Air Total : <?php echo $r['pasokan_air_minimum'].' US galon atau '.$pasokan.' m<sup>3</sup>'; ?></li>
                                                            <li>Laju Penerapan Air : <?php echo $r['penerapan_air'].' galon/menit atau '.$laju.' liter/menit'; ?></li>
                                                            <li>Kemampuan Aliran Maksimum : <?php echo $r['pengangkutan_air'].' gpm.' ?></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="control-group">
                                                    <label class="control-label" for="tanggal"><b>Lama Perjalanan :</b></label>

                                                    <div class="controls">
                                                        
                                                    </div>
                                                </div>        
                                            </div><!--/.span-->
                                            <div class="span6">
                                                <div class="widget-box">
                                                    <div class="widget-header widget-hea1der-small header-color-red">
                                                        <h6>
                                                            Foto Lokasi Kejadian
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
                                                                    <a href="../assets/img/foto-kejadian/<?= $r['foto_dir']; ?>" title="<?php echo $r['foto_nama'];?>" data-rel="colorbox">
                                                                        <img src="../assets/img/foto-kejadian/<?= $r['foto_dir']; ?>" width="829" height="441"/>
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div><!--/.span-->
                                        </div><!--/.row-fluid-->

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
<script type="text/javascript">
    if ("ontouchend" in document)
        document.write("<script src='../assets/js-ace/jquery.mobile.custom.min.js'>" + "<" + "/script>");</script>
<script src="../assets/js-ace/bootstrap.min.js"></script>

<!--page specific plugin scripts-->
<script src="../assets/js-ace/jquery-ui-1.10.3.custom.min.js"></script>
<script src="../assets/js-ace/jquery.ui.touch-punch.min.js"></script>
<script src="../assets/js-ace/jquery.colorbox-min.js"></script>
<script src="../assets/js-ace/autoNumeric.js"></script>
<!--ace scripts-->

<script src="../assets/js-ace/ace-elements.min.js"></script>
<script src="../assets/js-ace/ace.min.js"></script>
<script type="text/javascript">
</script>
<script type="text/javascript">
    jQuery(function($) {
        $('.biaya').autoNumeric('init');
    });
// ========================Jam========================================== //
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
// ========================Akhir Jam========================================== //
</script>
<script type="text/javascript">
    $(function() {
        var colorbox_params = {
            reposition:true,
            scalePhotos:true,
            scrolling:false,
            previous:'<i class="icon-arrow-left"></i>',
            next:'<i class="icon-arrow-right"></i>',
            close:'&times;',
            current:'{current} of {total}',
            maxWidth:'100%',
            maxHeight:'100%',
            onOpen:function(){
                document.body.style.overflow = 'hidden';
            },
            onClosed:function(){
                document.body.style.overflow = 'auto';
            },
            onComplete:function(){
                $.colorbox.resize();
            }
        }; 

        $('.content [data-rel="colorbox"]').colorbox(colorbox_params);
        $("#cboxLoadingGraphic").append("<i class='icon-spinner orange'></i>");//let's add a custom loading icon

        /**$(window).on('resize.colorbox', function() {
            try {
                //this function has been changed in recent versions of colorbox, so it won't work
                $.fn.colorbox.load();//to redraw the current frame
            } catch(e){}
        });*/
    })
</script>
<script type="text/javascript">
    
</script>
</body>
</html>
