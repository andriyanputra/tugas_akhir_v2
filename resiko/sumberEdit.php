<?php
//include '../template/header.php';

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
                    <link rel="stylesheet" href="../assets/css-ace/jquery-ui-1.10.3.custom.min.css" />
                    <link rel="stylesheet" href="../assets/css-ace/chosen.css" />
                    <link rel="shortcut icon" href="../assets/img/favicon.ico">
                    <script src='../assets/js-zoom/jquery-1.8.3.min.js'></script>
                    <script src='../assets/js-zoom/jquery.elevatezoom.js'></script>
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
                                                <a href="../anggota/profile">
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
                                        <a href="sumber">Sumber Air</a>

                                        <span class="divider">
                                            <i class="icon-angle-right arrow-icon"></i>
                                        </span>
                                    </li>
                                    <li class="active">Tambah Data</li>
                                </ul><!--.breadcrumb-->

                            </div>

                            <div class="page-content">
                                <div class="page-header position-relative">
                                    <h1>
                                        Sumber Air
                                        <small>
                                            <i class="icon-double-angle-right"></i>
                                            Tambah Data
                                        </small>
                                    </h1>
                                </div><!--/.page-header-->

                                <div class="row-fluid">
                                    <div class="span12">
                                        <!--PAGE CONTENT BEGINS-->

                                        <div class="widget-box">
                                            <div class="widget-header widget-header-blue widget-header-flat">
                                                <h4 class="lighter">Form Sumber Air di Kebupaten Sidoarjo</h4>
                                            </div>

                                            <div class="widget-body">
                                                <div class="widget-main">
                                                    <div class="row-fluid">
                                                        <form class="form-horizontal" id="validation-form" method="post" action="Fsumber/prosesEdit.php" enctype="multipart/form-data">
                                                            <div id="user-profile-3" class="user-profile">
                                                                <div class="row-fluid">

                                                                    <p align="center">
                                                                        <img id="zoom_01" src='../assets/img/sda/small/kec.png' data-zoom-image="../assets/img/sda/large/kec.png"/>
                                                                    </p>

                                                                    <?php
                                                                    if (isset($_GET['msg'])) {
                                                                        if ($_GET['msg'] == 'error1') {
                                                                            ?>
                                                                            <div class="alert alert-block alert-error">
                                                                                <button type="button" class="close" data-dismiss="alert">
                                                                                    <i class="icon-remove"></i>
                                                                                </button>

                                                                                <i class="icon-remove"></i>
                                                                                <strong>Maaf</strong>, nama sumber air sudah ada. Mohon untuk melakukan update data.
                                                                            </div>
                                                                            <?php
                                                                        } else
                                                                        if ($_GET['msg'] == 'error0') {
                                                                            ?>
                                                                            <div class="alert alert-block alert-error">
                                                                                <button type="button" class="close" data-dismiss="alert">
                                                                                    <i class="icon-remove"></i>
                                                                                </button>

                                                                                <i class="icon-remove"></i>
                                                                                <strong>Maaf</strong>, mohon untuk memilih pilihan lokasi pada baris lokasi sumber.
                                                                            </div>
                                                                            <?php
                                                                        } else if ($_GET['msg'] == 'notif2') {
                                                                            ?>
                                                                            <div class="alert alert-block alert-error">
                                                                                <button type="button" class="close" data-dismiss="alert">
                                                                                    <i class="icon-remove"></i>
                                                                                </button>

                                                                                <i class="icon-remove"></i>
                                                                                <strong>Maaf</strong>, lokasi sumber air baru sama.
                                                                            </div>
                                                                            <?php
                                                                        }
                                                                    }
                                                                    ?>

                                                                    <?php
                                                                    $edit = mysql_query("SELECT a.NAMA_SUMBER, a.KET_SUMBER, a.ID_SUMBER
                                                                        ,GROUP_CONCAT(kecamatan.KECAMATAN_ID SEPARATOR ', ') AS id
                                                                                    FROM sumber_air a 
                                                                                    JOIN sumber_air_kecamatan ON a.ID_SUMBER=sumber_air_kecamatan.ID_SUMBER
                                                                                    JOIN kecamatan ON sumber_air_kecamatan.KECAMATAN_ID=kecamatan.KECAMATAN_ID
                                                                                    WHERE a.ID_SUMBER = '" . $_GET['id'] . "'");

                                                                    $d = mysql_fetch_assoc($edit)
                                                                    ?>

                                                                    <div class="vspace"></div>
                                                                    <input type="hidden" id="id_sumber" name="id_sumber" value="<?= $_GET['id']; ?>" />
                                                                    <div class="control-group">
                                                                        <label class="control-label" for="nama_sumber">Nama Sumber:</label>
                                                                        <div class="controls">
                                                                            <input type="text" name="nama_sumber" id="nama_sumber" readonly="readonly" placeholder="Nama Sumber" value="<?= $d['NAMA_SUMBER'] ?>"/>
                                                                            &nbsp; &nbsp;
                                                                            <input type="checkbox" id="id-nSumber-check" />
                                                                            <label class="lbl" for="id-nSumber-check"> Editable !</label>
                                                                        </div>
                                                                    </div>

                                                                    <div class="control-group">
                                                                        <label class="control-label" for="lokasi_sumber">Lokasi Sumber:</label>
                                                                        <?php
                                                                        $id = $_GET['id'];
                                                                        $batas = 19;
                                                                        $query = mysql_query("SELECT GROUP_CONCAT(kecamatan.KECAMATAN_ID SEPARATOR ', ') AS id, GROUP_CONCAT(kecamatan.KECAMATAN_NAMA SEPARATOR ', ') AS Kecamatan
                                                                                    FROM sumber_air a 
                                                                                    JOIN sumber_air_kecamatan ON a.ID_SUMBER=sumber_air_kecamatan.ID_SUMBER
                                                                                    JOIN kecamatan ON sumber_air_kecamatan.KECAMATAN_ID=kecamatan.KECAMATAN_ID
                                                                                    WHERE a.ID_SUMBER = '" . $_GET['id'] . "'
                                                                                    GROUP BY kecamatan.KECAMATAN_ID ") or die("Query failed: " . mysql_error());

                                                                        if ($id > $batas) {
                                                                            echo '<div class=controls>';
                                                                            ?>
                                                                            <select style="display:block;" id="lokasi_sumber1" name="lokasi_sumber1[]" multiple="" class="chzn-select" data-placeholder="Pilih Lokasi...">
                                                                                <?php
                                                                                while ($row = mysql_fetch_array($query)) {
                                                                                    echo '<option value= ' . $row['id'] . '  selected>' . $row['Kecamatan'] . '</option>';
                                                                                }
                                                                                echo '</select></div>';
                                                                            } else {
                                                                                echo '<div class=controls>';
                                                                                ?>
                                                                                <select disabled style="display:block;" id="lokasi_sumber2" name="lokasi_sumber2[]" multiple="" class="chzn-select" data-placeholder="Pilih Lokasi...">
                                                                                    <?php
                                                                                    while ($r = mysql_fetch_array($query)) {
                                                                                        echo '<option value= ' . $r['id'] . '  selected>' . $r['Kecamatan'] . '</option>';
                                                                                    }
                                                                                    echo '</select></div>';
                                                                                }
                                                                                ?>
                                                                                </div>

                                                                                <div class="control-group">
                                                                                    <label class="control-label" for="lSumber">Tambah Lokasi Sumber :</label>
                                                                                    <?php
                                                                                    $kec = mysql_query("SELECT * FROM kecamatan") or die("Query failed: " . mysql_error());
                                                                                    ?>
                                                                                    <div class="controls">
                                                                                        <select multiple="" class="chzn-select" id="lSumber" name="lSumber[]" data-placeholder="Pilih Lokasi Baru...">
                                                                                            <option value="" />
                                                                                            <?php while ($k = mysql_fetch_array($kec)): ?>
                                                                                                <option value="<?php echo $k['KECAMATAN_ID']; ?>"><?php echo $k['KECAMATAN_NAMA']; ?></option>
            <?php endwhile; ?>
                                                                                        </select>
                                                                                    </div>
                                                                                </div>

                                                                                <div class="control-group">
                                                                                    <label class="control-label" for="keterangan">Keterangan :</label>

                                                                                    <div class="controls">
                                                                                        <textarea class="span6" id="keterangan" name="keterangan"><?= $d['KET_SUMBER']; ?></textarea>
                                                                                    </div>
                                                                                </div>
                                                                                </div>

                                                                                <div class="row-fluid wizard-actions">
                                                                                    <button class="btn btn-primary" onclick="window.history.go(-1)">
                                                                                        <i class="icon-arrow-left"></i>
                                                                                        Batal
                                                                                    </button>

                                                                                <!--<input type="submit" name="submit" class="btn btn-success" value="Simpan" />-->
                                                                                    <button class="btn btn-success" type="submit">
                                                                                        Simpan
                                                                                        <i class="icon-ok bigger-110"></i>
                                                                                    </button>
                                                                                </div>
                                                                                </div>
                                                                                </form>
                                                                                </div>
                                                                                </div><!--/widget-main-->
                                                                                </div><!--/widget-body-->
                                                                                </div><!--/widget-box-->

                                                                                <!--PAGE CONTENT ENDS-->
                                                                                </div><!--/.span-->
                                                                                </div><!--/.row-fluid-->
                                                                                </div><!--/.page-content-->

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

                                                                                <script type="text/javascript">
                                                                                    window.jQuery || document.write("<script src='../assets/js-ace/jquery-2.0.3.min.js'>" + "<" + "/script>");
                                                                                </script>
                                                                                <script type="text/javascript">
                                                                                    if ("ontouchend" in document)
                                                                                        document.write("<script src='../assets/js-ace/jquery.mobile.custom.min.js'>" + "<" + "/script>");
                                                                                </script>
                                                                                <script src="../assets/js-ace/bootstrap.min.js"></script>
                                                                                <script src="../assets/js-ace/jquery-ui-1.10.3.custom.min.js"></script>
                                                                                <script src="../assets/js-ace/jquery.ui.touch-punch.min.js"></script>
                                                                                <script src="../assets/js-ace/jquery.gritter.min.js"></script>
                                                                                <script src="../assets/js-ace/bootbox.min.js"></script>
                                                                                <script src="../assets/js-ace/select2.min.js"></script>
                                                                                <script src="../assets/js-ace/jquery.maskedinput.min.js"></script>
                                                                                <script src="../assets/js-ace/jquery.validate.min.js"></script>
                                                                                <script src="../assets/js-ace/chosen.jquery.min.js"></script>
                                                                                <script src="../assets/js-ace/jquery.slimscroll.min.js"></script>
                                                                                <script src="../assets/js-ace/bootstrap-tag.min.js"></script>

                                                                                <!--ace scripts-->

                                                                                <script src="../assets/js-ace/ace-elements.min.js"></script>
                                                                                <script src="../assets/js-ace/ace.min.js"></script>

                                                                                <script>
                                                                                    $('#zoom_01').elevateZoom({
                                                                                        scrollZoom: true,
                                                                                        zoomWindowWidth: 300,
                                                                                        zoomWindowHeight: 300
                                                                                    });
                                                                                </script>
                                                                                <script>

                                                                                </script>
                                                                                <script type="text/javascript">
                                                                                    $(function() {
                                                                                        $('#id-nSumber-check').on('click', function() {
                                                                                            var inp = $('#nama_sumber').get(0);
                                                                                            if (inp.hasAttribute('readonly')) {
                                                                                                inp.removeAttribute('readonly');
                                                                                            }
                                                                                            else {
                                                                                                inp.setAttribute('readonly', 'readonly');
                                                                                            }
                                                                                        });
                                                                                    });
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
                                                                                                keterangan: {
                                                                                                    required: true
                                                                                                },
                                                                                                nama_sumber: {
                                                                                                    required: true
                                                                                                },
                                                                                                lokasi_sumber1: {
                                                                                                    required: true
                                                                                                },
                                                                                                lokasi_sumber2: {
                                                                                                    required: true
                                                                                                }
                                                                                            },
                                                                                            messages: {
                                                                                                lokasi_sumber1: "Mohon untuk memilih lokasi.",
                                                                                                lokasi_sumber2: "Mohon untuk memilih lokasi."
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
                                                                                                var url = "Fsumber/prosesAdd.php";

                                                                                                // mengambil nilai dari inputbox, textbox dan select
                                                                                                var v_nSumber = $('input:text[name=nama_sumber]').val();
                                                                                                var v_lSumber = $('select[name=lokasi_sumber1]').val();
                                                                                                var v_lolSumber = $('select[name=lokasi_sumber2]').val();
                                                                                                var v_ttl = $('input:text[name=tanggal]').val();
                                                                                                var v_keterangan = $('textarea[name=keterangan]').val();
                                                                                                var v_phone = $('input:text[name=alamat]').val();
                                                                                                var v_gender = $('input:radio[name=gender]').val();
                                                                                                var v_email = $('input:email[name=email]').val();
                                                                                                var v_pass1 = $('input:password[name=pass1]').val();
                                                                                                var v_jabatan = $('select[name=jabatan]').val();

                                                                                                $.post(url, {nama_sumber: v_nSumber, lokasi_sumber1: v_lSumber, lokasi_sumber2: v_lolSumber, ttl: v_ttl, keterangan: v_keterangan, phone: v_phone, gender: v_gender, email: v_email, pass1: v_pass1, jabatan: v_jabatan}, function() {

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
                                                                                <?php
                                                                            }
                                                                        }
                                                                    }
                                                                    ?>
                                                                    </body>
                                                                    </html>