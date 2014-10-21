<?php
include '../template/header.php';
session_start();
include '../config/functions.php'; //include function.php - very important
include '../config/koneksi.php'; //include function.php - very important

if (!loggedin()) { // check if the user is logged in, but if it isn't, it will redirect to the Login Form page. Noticed the difference?
    header("Location: ../login/login.php");
    exit();
}

if (isset($_SESSION['pegawai_nomor']) || isset($_COOKIE['pegawai_nomor'])) {
    $sql = mysql_query("SELECT * FROM pegawai WHERE pegawai_nip='" . $_SESSION['pegawai_nomor'] . "' OR pegawai_nip='" . $_COOKIE['pegawai_nomor'] . "'");
    $query = mysql_query("SELECT * FROM pegawai,jabatan
                          WHERE jabatan.jabatan_id = pegawai.jabatan_id
                          ORDER BY pegawai_nip") or die("Query failed: " . mysql_error());
    if ($sql == false) {
        die(mysql_error());
        header('Location: ../login/login.php');
        exit();
    } else if (mysql_num_rows($sql)) {
        while ($row = mysql_fetch_assoc($sql)) {
            ?>
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

                            <li>
                                <a href="list">Anggota Pemadam</a>

                                <span class="divider">
                                    <i class="icon-angle-right arrow-icon"></i>
                                </span>
                            </li>
                            <li class="active">Tambah Data</li>
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
                                Anggota Pemadam
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
                                        <h4 class="lighter">Form Anggota Pemadam Kebakaran</h4>
                                    </div>

                                    <div class="widget-body">
                                        <div class="widget-main">
                                            <div class="row-fluid">
                                                <form class="form-horizontal" id="validation-form" method="post" action="prosesEdit.php" enctype="multipart/form-data">
                                                    <div id="user-profile-3" class="user-profile">
                                                        <?php
                                                        $q = mysql_query("SELECT *
                                                                          FROM pegawai,jabatan
                                                                          WHERE jabatan.jabatan_id = pegawai.jabatan_id AND pegawai_nip = '" . $_GET['nip'] . "'");
                                                        $d = mysql_fetch_assoc($q);
                                                        ?>
                                                        <div class="row-fluid">
                                                            <?php
                                                            if (isset($_GET['msg'])) {
                                                                if ($_GET['msg'] == 'error_foto1') {
                                                                    ?>
                                                                    <div class="alert alert-block alert-error">
                                                                        <button type="button" class="close" data-dismiss="alert">
                                                                            <i class="icon-remove"></i>
                                                                        </button>

                                                                        <i class="icon-remove"></i>
                                                                        File <strong>Foto</strong> yang diizinkan hanya berformat jpg, jpeg, png, gif!! Silahkan diulangi. 
                                                                    </div>
                                                                    <?php
                                                                } else if ($_GET['msg'] == 'error_foto2') {
                                                                    ?>
                                                                    <div class="alert alert-block alert-error">
                                                                        <button type="button" class="close" data-dismiss="alert">
                                                                            <i class="icon-remove"></i>
                                                                        </button>

                                                                        <i class="icon-remove"></i>
                                                                        File yang diizinkan hanya berukuran kurang dari 1Mb!! Silahkan diulangi. 
                                                                    </div>
                                                                    <?php
                                                                } else if ($_GET['msg'] == 'error_foto4') {
                                                                    ?>
                                                                    <div class="alert alert-block alert-error">
                                                                        <button type="button" class="close" data-dismiss="alert">
                                                                            <i class="icon-remove"></i>
                                                                        </button>

                                                                        <i class="icon-remove"></i>
                                                                        Proses upload foto gagal!! Silahkan diulangi. 
                                                                    </div>
                                                                    <?php
                                                                    echo "<p>Proses upload gagal, kode error = " . $_FILES['location']['error'] . "</p>";
                                                                } else if ($_GET['msg'] == 'error') {
                                                                    ?>
                                                                    <div class="alert alert-block alert-error">
                                                                        <button type="button" class="close" data-dismiss="alert">
                                                                            <i class="icon-remove"></i>
                                                                        </button>

                                                                        <i class="icon-remove"></i>
                                                                        Proses tambah data gagal!! Silahkan diulangi. 
                                                                    </div>
                                                                    <?php
                                                                } else if ($_GET['msg'] == 'error_foto3') {
                                                                    ?>
                                                                    <div class="alert alert-block alert-error">
                                                                        <button type="button" class="close" data-dismiss="alert">
                                                                            <i class="icon-remove"></i>
                                                                        </button>

                                                                        <i class="icon-remove"></i>
                                                                        Foto sudah digunakan! Silahkan diulangi.
                                                                    </div>
                                                                    <?php
                                                                } else if ($_GET['msg'] == 'error_email') {
                                                                    ?>
                                                                    <div class="alert alert-block alert-error">
                                                                        <button type="button" class="close" data-dismiss="alert">
                                                                            <i class="icon-remove"></i>
                                                                        </button>

                                                                        <i class="icon-remove"></i>
                                                                        Maaf, <strong>Email</strong> sudah dipakai! Silahkan ulangi.
                                                                    </div>
                                                                    <?php
                                                                } else if ($_GET['msg'] == 'error_nip') {
                                                                    ?>
                                                                    <div class="alert alert-block alert-error">
                                                                        <button type="button" class="close" data-dismiss="alert">
                                                                            <i class="icon-remove"></i>
                                                                        </button>

                                                                        <i class="icon-remove"></i>
                                                                        Maaf, <strong>Nomor Induk</strong> sudah digunakan! Silahkan ulangi.
                                                                    </div>
                                                                    <?php
                                                                }
                                                            }
                                                            ?>
                                                            <div class="span4 center">
                                                                <div class="control-group">
                                                                    <img width="200" height="200" alt="<?= $d['pegawai_nama']; ?>" src="../assets/img/img-anggota/<?= $d['pegawai_foto']; ?>" />
                                                                    <div class="space-6"></div>
                                                                    <input type="file" name="foto"/>
                                                                    <input type="hidden" name="foto_lama" value="<?php echo $d['pegawai_foto']; ?>" />
                                                                    <p align="center" class="red">*&nbsp;&nbsp;Ukuran foto tidak boleh melebihi 1Mb.</p>
                                                                </div>
                                                            </div>

                                                            <div class="vspace"></div>

                                                            <div class="span8">
                                                                <div class="control-group">
                                                                    <label class="control-label" for="nomor">Nomor Induk:</label>

                                                                    <div class="controls">
                                                                        <input type="text" name="nomor" id="nomor" placeholder="Nomor Induk Pegawai" value="<?= $d['pegawai_nip'] ?>"/>
                                                                    </div>
                                                                </div>

                                                                <div class="control-group">
                                                                    <label class="control-label" for="nama">Nama:</label>

                                                                    <div class="controls">
                                                                        <input class="span8" type="text" name="nama" id="nama" placeholder="Nama Lengkap" value="<?= $d['pegawai_nama'] ?>" />
                                                                    </div>
                                                                </div>

                                                                <div class='space-6'></div>

                                                                <div class="control-group">
                                                                    <label class="control-label">Jenis Kelamin:</label>

                                                                    <div class="controls">
                                                                        <?php $gender = $d['pegawai_kelamin']; ?> 
                                                                        <label class="inline">
                                                                            <input name="gender" type="radio" value="Laki-laki" <?php echo ($gender == 'Laki-laki') ? "checked" : ""; ?>/>
                                                                            <!--<input name="gender" value="Laki-laki" type="radio" />-->
                                                                            <span class="lbl"> Laki-laki</span>
                                                                        </label>

                                                                        <label class="inline">
                                                                            <input name="gender" type="radio" value="Perempuan" <?php echo ($gender == 'Perempuan') ? "checked" : ""; ?>/>
                                                                            <!--<input name="gender" value="Perempuan" type="radio" />-->
                                                                            <span class="lbl"> Perempuan</span>
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="control-group">
                                                            <label class="control-label" for="tempat">Tempat Lahir:</label>

                                                            <div class="controls">
                                                                <input type="text" name="tempat" id="tempat" placeholder="Tempat Lahir" value="<?= $d['pegawai_tempat'] ?>" />
                                                            </div>
                                                        </div>

                                                        <div class="control-group">
                                                            <label class="control-label" for="tanggal">Tanggal Lahir:</label>

                                                            <div class="controls">
                                                                <div class="input-prepend">
                                                                    <span class="add-on">
                                                                        <i class="icon-calendar"></i>
                                                                    </span>
                                                                    <?php $ttl = date("d-m-Y", strtotime($d['pegawai_tanggal'])); ?>
                                                                    <input class="input-small date-picker" name="tanggal" id="tanggal" type="text" data-date-format="dd-mm-yyyy" placeholder="dd-mm-yyyy" value="<?= $ttl ?>"/>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="control-group">
                                                            <label class="control-label" for="alamat">Alamat:</label>

                                                            <div class="controls">
                                                                <textarea class="span6" id="alamat" name="alamat"><?= $d['pegawai_alamat'] ?></textarea>
                                                            </div>
                                                        </div>

                                                        <div class="space"></div>

                                                        <h4 class="header blue bolder smaller">Kontak</h4>

                                                        <div class = "control-group">
                                                            <label class = "control-label" for = "email">Email:</label>

                                                            <div class = "controls">
                                                                <div class = "span4 input-prepend">
                                                                    <span class = "add-on">
                                                                        <i class = "icon-envelope"></i>
                                                                    </span>
                                                                    <input class = "span12" type = "email" name = "email" id = "email" class = "span6" value="<?= $d['pegawai_email'] ?>"/>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class = "control-group">
                                                            <label class = "control-label" for = "phone">No. Handphone:</label>

                                                            <div class = "controls">
                                                                <div class = "span3 input-prepend">
                                                                    <span class = "add-on">
                                                                        <i class = "icon-phone"></i>
                                                                    </span>
                                                                    <input class = "span12" type = "tel" id = "phone" name = "phone" value="<?= $d['pegawai_no_telp'] ?>"/>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class = "space"></div>

                                                        <h4 class = "header blue bolder smaller">Level User</h4>

                                                        <div class = "control-group">
                                                            <label class = "control-label" for = "state">Jabatan:</label>

                                                            <div class = "controls">
                                                                <span class = "span10">
                                                                    <select id = "jabatan" name = "jabatan">
                                                                        <?php
                                                                        $selected = $d['jabatan_nama'];
                                                                        $jabatans = array('Kepala Bidang PMK', 'Kepala Seksi Oprasional', 'Kepala Seksi Sarana', 'Staff Administrasi Umum', 'Komandan Pleton', 'Komandan Regu', 'Operator', 'Anggota');
                                                                        foreach ($jabatans as $jabatan) {
                                                                            if ($selected == $jabatan) {
                                                                                echo "<option selected='selected' value='$jabatan'>$jabatan</option>";
                                                                            } else {
                                                                                echo "<option value='$jabatan'>$jabatan</option>";
                                                                            }
                                                                        }
                                                                        ?>
                                                                    </select>
                                                                </span>
                                                            </div>
                                                        </div>

                                                        <div id="level">
                                                            <div class = "control-group">
                                                                <label class = "control-label">Level:</label>

                                                                <div class = "controls">
                                                                    <?php $level = $d['id_level_user']; ?>
                                                                    <div id="1">
                                                                        <label class="inline">
                                                                            <input name="level" value="1" type = "checkbox" <?php echo ($level == '1') ? "checked" : ""; ?>/>
                                                                            <span class="lbl"> Admin (Staff Administrasi Umum)</span>
                                                                        </label>
                                                                    </div>

                                                                    <div id="2">
                                                                        <label class="inline">
                                                                            <input name="level" value="2" type = "checkbox" <?php echo ($level == '2') ? "checked" : ""; ?>/>
                                                                            <span class="lbl"> Kepala Bidang</span>
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class = "space"></div>
                                                        <div id = "pass">
                                                            <h4 class = "header blue bolder smaller">Password</h4>

                                                            <div class = "control-group">
                                                                <label class = "control-label" for = "password_lama">Password Lama:</label>

                                                                <div class = "controls">
                                                                    <div class = "span12">
                                                                        <input type = "password" id="password_lama" name="password_lama" class = "span4" readonly value="<?= $d['pegawai_password']; ?>"/>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class = "control-group">
                                                                <label class = "control-label">Ganti Password :</label>

                                                                <div class = "controls">
                                                                    <label class="inline">
                                                                        <input name="check" type = "checkbox" onclick="showMe('ganti_password')" class="ace-switch ace-switch-4"/>
                                                                        <span class="lbl"></span>
                                                                    </label>
                                                                </div>
                                                            </div>

                                                            <div id="ganti_password" style="display:none">
                                                                <div class = "control-group">
                                                                    <label class = "control-label" for = "password_baru">Password Baru:</label>

                                                                    <div class = "controls">
                                                                        <div class = "span12">
                                                                            <input type = "password" id="password_baru" name = "password_baru" class = "span4" />
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class = "control-group">
                                                                    <label class= "control-label" for = "password_confirm">Confirm Password:</label>

                                                                    <div class = "controls">
                                                                        <div class = "span12">
                                                                            <input type = "password" id="password_confirm" name = "password_confirm" class = "span4" />
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class = "row-fluid wizard-actions">
                                                            <button class = "btn  btn-primary" onClick = "document.location.reload(true)">
                                                                <i class = "icon-refresh"></i>
                                                                Reset
                                                            </button>
                                                            <input type = "submit" name = "submit" class = "btn btn-success" value = "Simpan" />

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

<script type="text/javascript">
    window.jQuery || document.write("<script src='../assets/js-ace/jquery-2.0.3.min.js'>" + "<" + "/script>");
</script>

<!--<![endif]-->

<script type="text/javascript">
    if ("ontouchend" in document)
        document.write("<script src='../assets/js-ace/jquery.mobile.custom.min.js'>" + "<" + "/script>");
</script>
<script src="../assets/js-ace/bootstrap.min.js"></script>

<script src="../assets/js-ace/jquery-ui-1.10.3.custom.min.js"></script>
<script src="../assets/js-ace/jquery.ui.touch-punch.min.js"></script>
<script src="../assets/js-ace/bootbox.min.js"></script>
<script src="../assets/js-ace/select2.min.js"></script>
<script src="../assets/js-ace/date-time/bootstrap-datepicker.min.js"></script>
<script src="../assets/js-ace/jquery.maskedinput.min.js"></script>
<script src="../assets/js-ace/jquery.validate.min.js"></script>

<!--ace scripts-->

<script src="../assets/js-ace/ace-elements.min.js"></script>
<script src="../assets/js-ace/ace.min.js"></script>

<!--inline scripts related to this page-->

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

    var option = document.getElementsByName("jabatan");
    var l_admin = document.getElementById("1");
    var l_kepala = document.getElementById("2");
    var level = document.getElementById("level");
    pass.style.display = "none";  // hide
    level.style.display = "none";  // hide
    l_admin.style.display = "none";  // hide
    l_kepala.style.display = "none";  // hide
    for (var i = 0; i < option.length; i++) {
        option[i].onclick = function() {
            var val = this.value;
            if (val == 'Kepala Bidang PMK') {
                level.style.display = 'block';
                pass.style.display = 'block';
                l_admin.style.display = 'none';
                l_kepala.style.display = 'block';
            } else if (val == 'Staff Administrasi Umum') {
                level.style.display = 'block';
                pass.style.display = 'block';
                l_kepala.style.display = 'none';
                l_admin.style.display = 'block';
            } else {
                level.style.display = 'none';
                pass.style.display = 'none';
                l_admin.style.display = 'none';
                l_kepala.style.display = 'none';
            }
        }
    }

    function showMe(box) {

        var chboxs = document.getElementsByName("check");
        var vis = "none";
        for (var i = 0; i < chboxs.length; i++) {
            if (chboxs[i].checked) {
                vis = "block";
                break;
            }
        }
        document.getElementById(box).style.display = vis;
    }

    $(function() {

        $('[data-rel=tooltip]').tooltip();


        var $validation = true;


        $('#validation-form').show();
        $('#skip-validation').removeAttr('checked').on('click', function() {
            $validation = this.checked;
            if (this.checked) {
                $('#sample-form').hide();
                $('#validation-form').show();
            }
            else {
                $('#validation-form').show();
                $('#sample-form').hide();
            }
        });



        //documentation : http://docs.jquery.com/Plugins/Validation/validate


        $.mask.definitions['~'] = '[+-]';
        $('#phone').mask('999999999999');
        /*jQuery.validator.addMethod("phone", function(value, element) {
         return this.optional(element) || /^\(\d{3}\) \d{3}\-\d{4}( x\d{1,6})?$/.test(value);
         }, "Enter a valid phone number.");*/

        $.mask.definitions['~'] = '[+-]';
        $('#nomor').mask('999999999');
        /*jQuery.validator.addMethod("nomor", function(value, element) {
         return this.optional(element) || /^\(\d{3}\) \d{3}\-\d{4}( x\d{1,6})?$/.test(value);
         }, "Enter a valid number.");*/

        $('#validation-form').validate({
            errorElement: 'span',
            errorClass: 'help-inline',
            focusInvalid: false,
            rules: {
                email: {
                    required: true,
                    email: true
                },
                password_baru: {
                    required: true,
                    minlength: 5
                },
                password_confirm: {
                    required: true,
                    minlength: 5,
                    equalTo: "#password_baru"
                },
                name: {
                    required: true
                },
                level: {
                    required: true
                },
                phone: {
                    required: true
                },
                tanggal: {
                    required: true
                },
                alamat: {
                    required: true
                },
                tempat: {
                    required: true
                },
                nomor: {
                    required: true
                },
                nama: {
                    required: true
                },
                gender: 'required',
                jabatan: 'required'
            },
            messages: {
                email: {
                    required: "Mohon untuk memasukkan alamat email.",
                    email: "Mohon untuk memasukkan alamat email."
                },
                password: {
                    required: "Please specify a password.",
                    minlength: "Please specify a secure password."
                },
                level: "Mohon untuk dichecklist",
                gender: "Mohon untuk memilih",
                jabatan: "Mohon untuk memilih"
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
                var url = "prosesEdit.php";

                // mengambil nilai dari inputbox, textbox dan select
                var v_no = $('input:text[name=nomor]').val();
                var v_nama = $('input:text[name=nama]').val();
                var v_tempat = $('input:text[name=tempat]').val();
                var v_ttl = $('input:text[name=tanggal]').val();
                var v_alamat = $('textarea[name=alamat]').val();
                var v_phone = $('input:text[name=phone]').val();
                var v_gender = $('input:radio[name=gender]').val();
                var v_email = $('input:email[name=email]').val();
                var v_pass1 = $('input:password[name=password]').val();
                var v_jabatan = $('select[name=jabatan]').val();

                $.post(url, {nomor: v_no, nama: v_nama, tempat: v_tempat, ttl: v_ttl, alamat: v_alamat, phone: v_phone, gender: v_gender, email: v_email, password: v_pass1, jabatan: v_jabatan}, function() {

                })

            },
            invalidHandler: function(form) {
            }
        });




        $('#modal-wizard .modal-header').ace_wizard();
        $('#modal-wizard .wizard-actions .btn[data-dismiss=modal]').removeAttr('disabled');
    });


    $(function() {
        ///////////////////////////////////////////
        $('#user-profile-3')
                .find('button[type=reset]').on(ace.click_event, function() {
            $('#user-profile-3 input[type=file]').ace_file_input('reset_input');
        })
                .end().find('.date-picker').datepicker().next().on(ace.click_event, function() {
            $(this).prev().focus();
        })
        $('.input-mask-phone').mask('999999999999');



        ////////////////////
        //change profile
        $('[data-toggle="buttons-radio"]').on('click', function(e) {
            var target = $(e.target);
            var which = parseInt($.trim(target.text()));
            $('.user-profile').parent().hide();
            $('#user-profile-' + which).parent().show();
        });
    });
</script>
</body>
</html>
