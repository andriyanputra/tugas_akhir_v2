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
    $query = mysql_query("SELECT a.resiko_id, a.nama_pelapor, a.resiko_tanggal, b.DESA_NAMA, c.NAMA_BANGUNAN, d.KECAMATAN_NAMA, a.alamat_pelapor
                        FROM resiko AS a INNER JOIN desa AS b
                            ON (a.DESA_ID = b.DESA_ID)
                        INNER JOIN bangunan AS c
                            ON (a.ID_BANGUNAN = c.ID_BANGUNAN)
                        INNER JOIN kecamatan AS d
                            ON (a.KECAMATAN_ID = d.KECAMATAN_ID) AND (b.KECAMATAN_ID = d.KECAMATAN_ID)") or die(mysql_error());
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
                                <li class="active">Pasca Kebakaran</li>
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
                        </div><!--.breadcrumb-->

                        <div class="page-content">
                            <div class="page-header position-relative">
                                <h1>
                                    Pasca Kebakaran
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
                                        <div class="span12">
                                            <p align="center">
                                                <img src='../assets/img/tulisan.png' width="768" height="200" />
                                            </p>
                                        </div>
                                    </div>
                                        <div class="row-fluid">
                                            <div class="span12">
                                            <?php
                                            if (isset($_GET['msg'])) {
                                                if ($_GET['msg'] == 'notif') {
                                            ?>
                                            <div class="alert alert-block alert-warning">
                                                <button type="button" class="close" data-dismiss="alert">
                                                    <i class="icon-remove"></i>
                                                </button>

                                                <i class="icon-exclamation-sign red"></i>

                                                &nbsp;&nbsp; 
                                                <strong class="red">
                                                    <?php echo $_GET['nama'];?>
                                                </strong>
                                                melaporkan terjadinya kebakaran dan telah di padamkan oleh petugas. Mohon untuk ditindaklanjuti. 
                                            </div>
                                            <?php 
                                                }
                                            }
                                            ?>
                                                <div class="table-header center">Daftar Kejadian Kebakaran di Kabupaten Sidoarjo</div>

                                                <table id="kejadian" class="table table-striped table-bordered table-hover">
                                                    <thead>
                                                        <tr>
                                                            <th class="center">No.</th>
                                                            <th class="center">Nama Pelapor</th>
                                                            <th class="center">Lokasi Kejadian</th>
                                                            <th class="center">Tanggal Kejadian</th>
                                                            <th class="center">Action</th>
                                                        </tr>
                                                    </thead>

                                                    <tbody>
                                                        <?php
                                                            $no = 1;
                                                            while($res = mysql_fetch_array($query)){
                                                                $result_tgl = date_create($res['resiko_tanggal']);
                                                        ?>
                                                        <tr>
                                                            <td><?php echo $no.'.'; ?></td>
                                                            <td><?php echo $res['nama_pelapor']; ?></td>
                                                            <td><?php echo $res['alamat_pelapor'].' Ds. '.$res['DESA_NAMA'].' Kec. '.$res['KECAMATAN_NAMA'].'.' ?></td>
                                                            <td><?php echo date_format($result_tgl, 'd M Y H:i:s'); ?></td>
                                                            <td>
                                                                <div class="hidden-phone visible-desktop action-buttons">
                                                                    <a class="red cek" href="" id="<?php echo $res['resiko_id']; ?>" class="tooltip-success" data-rel="tooltip" title="Edit">
                                                                        <i class="icon-edit bigger-130"></i>
                                                                    </a>

                                                                    <a class="blue cek" href="" id="<?php echo $res['resiko_id']; ?>" class="tooltip-error" data-rel="tooltip" title="Selengkapnya">
                                                                        <i class="icon-zoom-in bigger-130"></i>
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
<script src="../assets/js-ace/chosen.jquery.min.js"></script>
<script src="../assets/js-ace/jquery.dataTables.min.js"></script>
<script src="../assets/js-ace/jquery.dataTables.bootstrap.js"></script>
<script src="../assets/js-ace/bootbox.min.js"></script>
<script src="../assets/js-ace/autoNumeric.js"></script>
<!--ace scripts-->

<script src="../assets/js-ace/ace-elements.min.js"></script>
<script src="../assets/js-ace/ace.min.js"></script>
<script type="text/javascript">
/*    $(document).ready(function() {

                $("#kecamatan").change(function() {
                    $(this).after('<span class="help-inline pull-right"><i class="icon-spinner icon-spin blue bigger-300" id="loader"></i></span>');
                    $.get('akec.php?kecamatan=' + $(this).val(), function(data) {
                        $("#desa").html(data);
                        $('#loader').slideUp(200, function() {
                            $(this).remove();
                        });
                    });
                });
            });*/
    $(function() {
        $(document).on(ace.click_event, ".cek", function(e) {
            var id = $(this).attr('id');
            e.preventDefault();
            bootbox.confirm("Mohon untuk menunggu . . .", function(result) {
                if (result) {
                    //sent request to delete order with given id
                    $.ajax({
                        type: 'get',
                        url: 'proses/cekData.php',
                        data: 'cek=' + id,
                        success: function(data) {
                            if (data == '1') {
                                bootbox.alert("Data berhasil diselesaikan !");
                                window.location.replace("view?id="+id);
                            } else {
                                bootbox.alert("Maaf data belum terselesaikan !");
                                window.location.replace("olahPasca?id="+id);
                            }
                        }
                    });
                }
            });
        });
    });
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

    function showMe(box1, box2) {

        var chboxs = document.getElementsByName("check");
        var vis1 = "none";
        var vis2 = "none";
        for (var i = 0; i < chboxs.length; i++) {
            if (chboxs[i].checked) {
                vis1 = "block";
                vis2 = "block";
                break;
            }
        }
        document.getElementById(box1).style.display = vis1;
        document.getElementById(box2).style.display = vis2;
    }

    function showMe_(box1) {

        var chboxs = document.getElementsByName("check2");
        var vis1 = "none";
        for (var i = 0; i < chboxs.length; i++) {
            if (chboxs[i].checked) {
                vis1 = "block";
                break;
            }
        }
        document.getElementById(box1).style.display = vis1;
    }
</script>

<script type="text/javascript">
        $(document).ready(function() {
            var kejadian = $('#kejadian').DataTable();
            //var konstruksi = $('#konstruksi').DataTable();
        });

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
</script>

</body>
</html>
