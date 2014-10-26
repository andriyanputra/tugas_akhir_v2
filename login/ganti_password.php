<?php
//
include '../template/header.php';

include '../config/functions.php'; //include function.php - very important
include '../config/koneksi.php';

if (!repass()) {
    header("Location: login.php");
    exit();
}

if (isset($_COOKIE['rePass'])) {
    $sql = mysql_query("SELECT * FROM pegawai WHERE pegawai_nip='" . $_COOKIE['rePass'] . "'");
    if ($sql == false) {
        die(mysql_error());
        header('Location: login.php');
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

                        </div><!--/.container-fluid-->
                    </div><!--/.navbar-inner-->
                </div>

                <div class="main-container container-fluid">
                    <a class="menu-toggler" id="menu-toggler" href="#">
                        <span class="menu-text"></span>
                    </a>

                    <div class="sidebar" id="sidebar">
                        <div class="sidebar-shortcuts" id="sidebar-shortcuts">

                            <div class="sidebar-shortcuts-mini" id="sidebar-shortcuts-mini">
                                <span class="btn btn-success"></span>

                                <span class="btn btn-info"></span>

                                <span class="btn btn-warning"></span>

                                <span class="btn btn-danger"></span>
                            </div>
                        </div><!--#sidebar-shortcuts-->

                        <ul class="nav nav-list">
                            <li class="disabled">
                                <a href="../beranda/index">
                                    <i class="icon-dashboard"></i>
                                    <span class="menu-text"> Dashboard </span>
                                </a>
                            </li>


                            <li class="disabled">
                                <a href="" class="dropdown-toggle">
                                    <i class="icon-edit"></i>
                                    <span class="menu-text"> Analisis Resiko </span>

                                    <b class="arrow icon-angle-down"></b>
                                </a>

                                <ul class="submenu">

                                    <li class="disabled">
                                        <a href="">
                                            <i class="icon-double-angle-right"></i>
                                            Peta Kab. Sidoarjo
                                        </a>
                                    </li>

                                    <li class="disabled">
                                        <a href="">
                                            <i class="icon-double-angle-right"></i>
                                            Analisis Resiko Kebakaran
                                        </a>
                                    </li>

                                    <li class="disabled">
                                        <a href="">
                                            <i class="icon-double-angle-right"></i>
                                            Daftar Bangunan
                                        </a>
                                    </li>
                                </ul>
                            </li>

                            <li class="disabled">
                                <a href="" class="dropdown-toggle">
                                    <i class="icon-desktop"></i>
                                    <span class="menu-text"> Pasca Kebakaran </span>
                                </a>
                            </li>



                            <li class="disabled">
                                <a href="">
                                    <i class="icon-group"></i>
                                    <span class="menu-text"> Anggota Pemadam </span>
                                </a>
                            </li>

                            <li class="disabled">
                                <a href="">
                                    <i class="icon-calendar"></i>

                                    <span class="menu-text">
                                        Kalendar
                                        <!--<span class="badge badge-transparent tooltip-error" title="2&nbsp;Important&nbsp;Events">
                                            <i class="icon-info-sign red bigger-130"></i>
                                        </span>-->
                                    </span>
                                </a>
                            </li>

                            <li class="disabled">
                                <a href="">
                                    <i class="icon-picture"></i>
                                    <span class="menu-text"> Gallery </span>
                                </a>
                            </li>

                            <li class="disabled">
                                <a href="" class="dropdown-toggle">
                                    <i class="icon-file-alt"></i>

                                    <span class="menu-text">
                                        Laporan Kejadian
                                    </span>
                                </a>
                            </li>
                        </ul><!--/.nav-list-->

                        <div class="sidebar-collapse" id="sidebar-collapse">
                            <i class="icon-double-angle-left"></i>
                        </div>
                    </div>
                    <div class="main-content">
                        <div class="breadcrumbs" id="breadcrumbs">
                            <ul class="breadcrumb">
                                <li class="disabled">
                                    <i class="icon-home home-icon"></i>
                                    <a href="login">Home</a>

                                    <span class="divider">
                                        <i class="icon-angle-right arrow-icon"></i>
                                    </span>
                                </li>
                                <li class="active">Ganti Password</li>
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
                                    Ganti Password
                                    <small>
                                        <i class="icon-double-angle-right"></i>
                                        Overview
                                    </small>
                                </h1>
                            </div><!--/.page-header-->

                            <div class="row-fluid">
                                <div class="span12">
                                    <!--PAGE CONTENT BEGINS-->

                                    <div class="error-container">
                                        <div class="well">
                                            <div class="widget-box transparent invoice-box">
                                                <div class="widget-header widget-header-large">
                                                    <h3 class="grey lighter pull-left position-relative">
                                                        <i class="icon-user"></i>
                                                        <?= $row['pegawai_nama']; ?>
                                                    </h3>

                                                    <div class="widget-toolbar no-border invoice-info">
                                                        
                                                    </div>
                                                </div>
                                                <?php 
                                                    if($_POST['submit']){
                                                        $pass_baru = md5($_POST['pass_baru']);
                                                        $update = mysql_query("UPDATE pegawai set pegawai_password ='" . $pass_baru . "' WHERE pegawai_nip = '" . $_COOKIE['rePass'] . "'") or die("Query : ".mysql_error());
                                                        if ($update){
                                                ?>
                                                    <script language="JavaScript">
                                                        setTimeout(function() {
                                                            swal("Password Berhasil Diganti!", "", "success");
                                                            document.location = 'login.php'
                                                        }, 1000);
                                                    </script>
                                                <?php

                                                        }
                                                    }
                                                ?>
                                                <div class="widget-body">
                                                    <div class="widget-main">
                                                        <div class="row-fluid">
                                                            <form class="form-horizontal" id="forget-password" method="post" action="">

                                                                <div class="control-group">
                                                                    <label class="control-label" for="password">New Password:</label>

                                                                    <div class="controls">
                                                                        <span class="input-icon input-icon-right">
                                                                            <input type="password" name="pass_baru" id="pass_baru" />
                                                                            <i class="icon-key"></i>
                                                                        </span>
                                                                    </div>
                                                                </div>

                                                                <div class="control-group">
                                                                    <label class="control-label" for="password2">Confirm Password:</label>

                                                                    <div class="controls">
                                                                        <span class="input-icon input-icon-right">
                                                                            <input type="password" name="pass_baru2" id="pass_baru2" />
                                                                            <i class="icon-key"></i>
                                                                        </span>
                                                                    </div>
                                                                </div>

                                                                <div class="row-fluid wizard-actions">
                                                                    <button class="btn  btn-primary" onClick="document.location.reload(true)">
                                                                        <i class="icon-refresh"></i>
                                                                        Reset
                                                                    </button>

                                                                    <input type="submit" name="submit" class="btn btn-success" value="Simpan" />

                                                                    <!--<button class="btn btn-success btn-next" data-last="Finish">
                                                                        Next
                                                                        <i class="icon-arrow-right icon-on-right"></i>
                                                                    </button>-->
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div><!--/widget-main-->
                                                </div><!--/widget-body-->
                                            </div>
                                        </div>
                                    </div>

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

                                                                        <!--<script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>-->

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

                <!--[if lte IE 8]>
                  <script src="assets/js/excanvas.min.js"></script>
                <![endif]-->

                <!--<script src="../assets/js-ace/additional-methods.min.js"></script>-->
                <script src="../assets/js-ace/jquery-ui-1.10.3.custom.min.js"></script>
                <script src="../assets/js-ace/jquery.ui.touch-punch.min.js"></script>
                <script src="../assets/js-ace/jquery.validate.min.js"></script>
                <script src="../assets/js-ace/sweet-alert.js"></script>

                <!--ace scripts-->

                <script src="../assets/js-ace/ace-elements.min.js"></script>
                <script src="../assets/js-ace/ace.min.js"></script>


                <?php
            }
        }
    }
    ?>
    <script type="text/javascript">
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
            //$('#forget-password').show();

            $('#forget-password').validate({
                errorElement: 'span', //default input error message container
                errorClass: 'help-inline', // default input error message class
                focusInvalid: false, // do not focus the last invalid input
                rules: {
                    pass_lama: {
                        required: true
                    },
                    pass_baru: {
                        required: true,
                        minlength: 10
                    },
                    pass_baru2: {
                        required: true,
                        equalTo: "#pass_baru"
                    }
                },
                messages: {
                    pass_lama: {
                        required: "Password tidak boleh kosong."
                    },
                    pass_baru2: {
                        required: "Password tidak boleh kosong."
                    },
                    pass_baru: {
                        required: "Password tidak boleh kosong.",
                        minlength: "Panjang password min 10 karakter."
                    }
                },
                invalidHandler: function(event, validator) { //display error alert on form submit   
                    $('.alert-error', $('#forget-password')).show();
                },
                highlight: function(element) { // hightlight error inputs
                    $(element)
                            .closest('.control-group').addClass('error'); // set error class to the control group
                },
                success: function(label) {
                    label.closest('.control-group').removeClass('error');
                    label.remove();
                },
                errorPlacement: function(error, element) {
                    error.insertAfter(element.closest('.input-icon'));
                },
                submitHandler: function(form) {
                    form.submit();
                }
            });

            $('#forget-password input').keypress(function(e) {
                if (e.which == 13) {
                    if ($('#forget-password').validate().form()) {
                        $('#forget-password').submit();
                    }
                    return false;
                }
            });
        });
    </script>
</body>
</html>