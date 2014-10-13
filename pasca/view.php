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
    $query = mysql_query("SELECT a.nama_pelapor, a.resiko_tanggal, b.DESA_NAMA, c.NAMA_BANGUNAN, d.KECAMATAN_NAMA, d.KECAMATAN_DIR, a.alamat_pelapor
                        FROM resiko AS a INNER JOIN desa AS b
                            ON (a.DESA_ID = b.DESA_ID)
                        INNER JOIN bangunan AS c
                            ON (a.ID_BANGUNAN = c.ID_BANGUNAN)
                        INNER JOIN kecamatan AS d
                            ON (a.KECAMATAN_ID = d.KECAMATAN_ID) AND (b.KECAMATAN_ID = d.KECAMATAN_ID)
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
                        </div>

                        <div class="page-content">
                            <div class="page-header position-relative">
                                <h1>
                                    Pasca Kebakaran
                                    <small>
                                        <i class="icon-double-angle-right"></i>
                                        Lihat Kejadian
                                    </small>
                                </h1>
                            </div><!--/.page-header-->
                            <div class="row-fluid">
                                <div class="span12">
                                    <!--PAGE CONTENT BEGINS-->
                                    <div class="row-fluid">
                                        <div class="span10 offset1">
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
                                        </div>
                                    </div>
                                    <div class="space-6"></div>
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
                                            //while($r = mysql_fetch_array($query)){
                                            ?>

                                                 <form class="form-horizontal" id="validation-form" method="POST" action="proses/submit.php">
                                                    <div class="row-fluid">
                                                        <div class="span12">
                                                            
                                                            <div class="control-group">
                                                                <label class="control-label" for="nama">Nama Pelapor :</label>

                                                                <div class="controls">
                                                                    <input type="text" name="nama" id="nama" readonly value="<?=$r['nama_pelapor']?>"/>
                                                                </div>
                                                            </div>

                                                            <div class="control-group">
                                                                <label class="control-label" for="alamat">Alamat :</label>

                                                                <div class="controls">
                                                                    <textarea class="span6" name="alamat" id="alamat" readonly><?php echo $r['alamat_pelapor'].' Ds. '.$r['DESA_NAMA'].', Kec. '.$r['KECAMATAN_NAMA'].', Kab. Sidoarjo.' ?></textarea>
                                                                </div>
                                                            </div>

                                                            <div class="control-group">
                                                                <label class="control-label" for="bangunan">Bangunan Terbakar :</label>
                                                                
                                                                <div class="controls">
                                                                    <input type="text" class="span6" name="bangunan" id="bangunan" readonly value="<?=$r['NAMA_BANGUNAN']?>">
                                                                    <input name="check" class="ace-switch ace-switch-2" type="checkbox" onclick="showMe('bangunan_baru', 'luas_baru')" data-rel="tooltip" title="Apakah terdapat bangunan terbakar selain bangunan di samping ?" data-placement="bottom" />
                                                                    <span class="lbl"></span>
                                                                </div>
                                                            </div>

                                                            <div id="bangunan_baru" style="display:none">
                                                                <div class="control-group">
                                                                    <div class="controls">
                                                                        <select id="bangunan_baru" name="bangunan_baru" class="select2" data-placeholder="Pilih Bangunan...">
                                                                            <option value=""/>
                                                                            <?php 
                                                                            $bangunan1 = mysql_query("SELECT b.NAMA_MASTER, a.NAMA_BANGUNAN, a.TINGKAT_BANGUNAN FROM bangunan AS a
                                                                                                        INNER JOIN master_bangunan AS b ON (a.ID_MASTER = b.ID_MASTER)
                                                                                                        ORDER BY a.NAMA_BANGUNAN ASC")or die("Query failed: " . mysql_error());
                                                                            $group = array();
                                                                                while ($r = mysql_fetch_assoc($bangunan1)){
                                                                                    $group[$r['NAMA_MASTER']][] = $r;
                                                                                }
                                                                                foreach ($group as $key => $value) {
                                                                                    echo '<optgroup label="'.$key.'">';
                                                                                    foreach ($value as $values) {
                                                                                        echo "<option value=".$values['TINGKAT_BANGUNAN'].">".$values['NAMA_BANGUNAN']."";
                                                                                    }
                                                                                    echo '</optgroup>';
                                                                                } 
                                                                            ?>
                                                                            <!--<option value="<?php //echo $r['TINGKAT_BANGUNAN']; ?>"><?php //echo $r['NAMA_BANGUNAN']; ?></option>-->
                                                                        </select>
                                                                        <!--<input type="text" name="bangunan_baru" value="" placeholder="Bangunan Terbakar...">-->
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="control-group">
                                                                <label class="control-label" for="penyebab">Penyebab Kebakaran :</label>

                                                                <div class="controls">
                                                                    <select id="penyebab" name="penyebab">
                                                                        <option value="" />Pilih Penyebab...
                                                                        <option value="BBM" />Bahan Bakar Minyak
                                                                        <option value="KPR/LPG" />Kompor Gas
                                                                        <option value="LST" />Listrik
                                                                        <option value="RK" />Rokok
                                                                    </select>
                                                                    <input name="check2" class="ace-switch ace-switch-2" type="checkbox" onclick="showMe_('penyebab_baru')" data-rel="tooltip" title="Penyebab kebakaran tidak terdapat dalam list ?" data-placement="bottom" />
                                                                    <span class="lbl"></span>
                                                                </div>
                                                            </div>

                                                            <div id="penyebab_baru" style="display:none">
                                                                <div class="control-group">
                                                                    <div class="controls">
                                                                        <input type="text" name="penyebab_baru" value="" placeholder="Penyebab Baru...">
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="control-group">
                                                                <label class="control-label" for="luas">Luas Area Terbakar :</label>
                                                                
                                                                <div class="controls">
                                                                    <input type="text" name="luas" id="luas" readonly value="<?=$luas?>">&nbsp;m<sup>2</sup>
                                                                </div>
                                                            </div>

                                                            <div id="luas_baru" style="display:none">
                                                                <div class="control-group">
                                                                    <div class="controls">
                                                                        <input type="text" name="luas_total" value="" placeholder="Luas Keseluruhan Bangunan...">&nbsp;m<sup>2</sup>
                                                                    </div>
                                                                </div>
                                                            </div>                                                

                                                            <div class="control-group">
                                                                <label class="control-label" for="korban">Jumlah Korban :</label>

                                                                <div class="controls">
                                                                    <input type="text" id="korban_luka" name="korban_luka" placeholder="Korban Luka..." value="">
                                                                    <input type="text" id="korban_meninggal" name="korban_meninggal" placeholder="Korban Meninggal..." value="">
                                                                </div>
                                                            </div>

                                                            <div class="control-group">
                                                                <label class="control-label" for="biaya">Estimasi Biaya Kerugian:</label>

                                                                <div class="controls">
                                                                    <div class="span3 input-prepend">
                                                                        <span class="add-on">
                                                                            <i class="icon-money"></i>
                                                                        </span>

                                                                        <input type="text" id="biaya" name="biaya" placeholder="Biaya Kerugian..." value="" class="biaya" data-a-sep="." data-a-dec="," data-a-sign="Rp. "/>
                                                                    </div>

                                                                    <!--<span class="input-icon input-icon-right">
                                                                        <input type="text" id="biaya" name="biaya" placeholder="Biaya Kerugian..." value="" class="biaya" data-a-sep="." data-a-dec="," data-a-sign="Rp. "/>
                                                                        <i class="icon-money"></i>
                                                                    </span>-->

                                                                    <!--<input type="text" id="biaya" name="biaya" placeholder="Biaya Kerugian..." value="">-->
                                                                </div>
                                                            </div>

                                                            <div class="form-actions">
                                                                <div class="pull-right">
                                                                    <button class="btn" onclick="location.reload();">
                                                                        <i class="icon-repeat bigger-110"></i>
                                                                        Reset
                                                                    </button>
                                                                &nbsp; &nbsp; &nbsp;
                                                                    <button class="btn btn-info" type="submit">
                                                                        Submit
                                                                        <i class="icon-ok"></i>
                                                                    </button>
                                                                </div>
                                                            </div>


                                                        </div><!-- end span12 --> 
                                                    </div><!-- end row-fluid --> 
                                                </form>
                                            </div>

                                    <!--PAGE CONTENT ENDS-->
                                </div><!--/.span-->
                            </div><!--/.row-fluid-->
                        </div><!--/.page-content-->
                    </div>
                </div>

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
<script src="../assets/js-ace/autoNumeric.js"></script>
<script src="../assets/js-ace/jquery.validate.min.js"></script>
<script src="../assets/js-ace/select2.min.js"></script>
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
<script type="text/javascript">
    $(function() {
        $('#validation-form').show();
        //documentation : http://docs.jquery.com/Plugins/Validation/validate
        $('#validation-form').validate({
            errorElement: 'span',
            errorClass: 'help-inline',
            focusInvalid: false,
            rules: {
                bangunan_baru: {
                    required: true
                },
                penyebab: {
                    required: true
                },
                penyebab_baru: {
                    required: true
                },
                luas_total: {
                    required: true
                },
                korban_luka: {
                    required: true
                },
                korban_meninggal: {
                    required: true
                },
                biaya: {
                    required: true
                }
            },
            messages: {
                bangunan_baru: "Mohon untuk mengisi field bangunan.",
                penyebab: "Mohon untuk memilih penyebab kebakaran.",
                penyebab_baru: "Mohon untuk mengisi field penyebab.",
                luas_total: "Mohon untuk memilih lokasi kecamatan.",
                biaya: "Mohon untuk mengisi field biaya."
            },
            invalidHandler: function(event, validator) { //display error alert on form submit   
                $('.alert-error', $('.login-form')).show();
            },
            highlight: function(e) {
                $(e).closest('.control-group').removeClass('info').addClass('error');
            },
            success: function(e) {
                $(e).closest('.control-group').removeClass('error').addClass('info');
                $(e).remove();
            },
            errorPlacement: function(error, element) {
                if (element.is(':checkbox') || element.is(':radio')) {
                    var controls = element.closest('.controls');
                    if (controls.find(':checkbox,:radio').length > 1)
                        controls.append(error);
                    else
                        error.insertAfter(element.nextAll('.lbl:eq(0)').eq(0));
                }
                else if (element.is('.select2')) {
                    error.insertAfter(element.siblings('[class*="select2-container"]:eq(0)'));
                }
                else if (element.is('.chzn-select')) {
                    error.insertAfter(element.siblings('[class*="chzn-container"]:eq(0)'));
                }
                else
                    error.insertAfter(element);
            },
            submitHandler: function(form) {
                var url = "proses/submit.php";

                // mengambil nilai dari inputbox, textbox dan select
                var v_kec = $('select[name=kecamatan]').val();
                var v_air = $('select[name=sumber_air]').val();
                var v_desa = $('select[name=desa]').val();
                var v_akons1 = $('select[name=angka_konstruksi1]').val();
                var v_akons2 = $('select[name=angka_konstruksi2]').val();
                var v_tinggi1 = $('input:text[name=tinggi1]').val();
                var v_tinggi2 = $('input:text[name=tinggi2]').val();
                var v_exposure = $('input:radio[name=exposure]').val();
                var v_tepol = $('input:radio[name=tepol]').val();
                //var v_hasil1 = $('input:text[name=hasil1]').val();
                //var v_hasil2 = $('input:text[name=hasil2]').val();

                $.post(url, {tinggi2: v_tinggi2, desa: v_desa, kecamatan: v_kec, sumber_air: v_air, angka_konstruksi1: v_akons1, angka_konstruksi2: v_akons2, tinggi1: v_tinggi1, exposure: v_exposure, tepol: v_tepol, hasil1: v_hasil1, hasil2: v_hasil2}, function() {

                })
            },
            invalidHandler: function(form) {
            }
        });
    });

    $(function() {
        $(".chzn-select").chosen();
    });

    $(function() {
        ///////////////////////////////////////////
        $('#user-profile-3').end().find('button[type=reset]').on(ace.click_event, function() {
            $('#user-profile-3 input[type=file]').ace_file_input('reset_input');
        })
    });
</script>
</body>
</html>