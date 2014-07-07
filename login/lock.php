<?php
include '../config/functions.php';
include '../config/koneksi.php';

if (!relock()) { // check if the user is logged in, but if it isn't, it will redirect to the Login Form page. Noticed the difference?
    header("Location: ../login/login.php");
    exit();
}

if (isset($_SESSION['pegawai_nomor']) || isset($_COOKIE['reLock'])) {
    $sql = mysql_query("SELECT * FROM pegawai WHERE pegawai_nip='" . $_SESSION['pegawai_nomor'] . "' OR pegawai_nip='" . $_COOKIE['reLock'] . "' ");
    if ($sql == false) {
        die(mysql_error());
        header('Location: ../login/login.php');
        exit();
    } else if (mysql_num_rows($sql)) {
        while ($row = mysql_fetch_assoc($sql)) {
?>
<!DOCTYPE html>

<!-- NEW CODE -->

<!-- END NEW CODE -->
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en" class="no-js">
    <!--<![endif]-->
    <!-- BEGIN HEAD -->
    <head>
        <meta charset="utf-8"/>
        <title>SIM Proteksi Kebakaran Perkotaan</title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
        <meta content="" name="description"/>
        <meta content="" name="author"/>

        <!-- BEGIN GLOBAL MANDATORY STYLES -->
        <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css"/>
        <link href="../assets/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
        <link href="../assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <link href="../assets/plugins/uniform/css/uniform.default.css" rel="stylesheet" type="text/css"/>
        <!-- END GLOBAL MANDATORY STYLES -->
        <!-- BEGIN PAGE LEVEL STYLES -->
        <link href="../assets/css/pages/lock.css" rel="stylesheet" type="text/css"/>
        <!-- END PAGE LEVEL SCRIPTS -->
        <!-- BEGIN THEME STYLES -->
        <link href="../assets/css/style-metronic.css" rel="stylesheet" type="text/css"/>
        <link href="../assets/css/style.css" rel="stylesheet" type="text/css"/>
        <link href="../assets/css/style-responsive.css" rel="stylesheet" type="text/css"/>
        <link href="../assets/css/plugins.css" rel="stylesheet" type="text/css"/>
        <link href="../assets/css/themes/default.css" rel="stylesheet" type="text/css" id="style_color"/>
        <link href="../assets/css/pages/login-soft.css" rel="stylesheet" type="text/css"/>
        <link href="../assets/css/custom.css" rel="stylesheet" type="text/css"/>
        <!-- END THEME STYLES -->
        <link rel="shortcut icon" href="../assets/img/favicon.ico"/>
    </head>
    <!-- END HEAD -->
    <!-- BEGIN BODY -->
    <body>
        <!-- BEGIN LOGO -->
        <div class="page-lock">
            <div class="page-logo">
                <a class="brand" href="">
                    <img src="../assets/img/logo-big.png" alt="logo"/>
                </a>
            </div>
            <div class="page-body">
                <img class="page-lock-img" src="../assets/img/img-anggota/<?=$row['pegawai_foto']; ?>" alt="">
                <div class="page-lock-info">
                    <h1> <?php echo $row['pegawai_nama']; ?></h1>
                    <span class="email">
                        <?php echo $row['pegawai_email'];?>
                    </span>
                    <span class="locked">
                        Terkunci
                    </span>
                    <form class="form-inline" method="post" action="../config/reLock.php">
                        <div class="input-group input-medium">
                            <input type="password" class="form-control" autocomplete="off" name="lock" placeholder="Password" required oninvalid="this.setCustomValidity('Masukkan password !!')" oninput="setCustomValidity('')" />
                            <span class="input-group-btn">
                                <button type="submit" class="btn blue icn-only"><i class="m-icon-swapright m-icon-white"></i></button>
                            </span>
                        </div>
                        <!-- /input-group -->
                        <div class="relogin">
                            <a href="login">
                                Bukan <?php echo $row['pegawai_nama']; }}}?> ?
                            </a>
                        </div>
                    </form>
                </div>
            </div>
            <div class="page-footer">
                2014 &copy; Instansi Pemadam Kebakaran, Kabupaten Sidoarjo.
            </div>
        </div>
        <!-- END COPYRIGHT -->
        <!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->
        <!-- BEGIN CORE PLUGINS -->
        <!--[if lt IE 9]>
                <script src="assets/plugins/respond.min.js"></script>
                <script src="assets/plugins/excanvas.min.js"></script> 
                <![endif]-->
        <script src="../assets/plugins/jquery-1.10.2.min.js" type="text/javascript"></script>
        <script src="../assets/plugins/jquery-migrate-1.2.1.min.js" type="text/javascript"></script>
        <script src="../assets/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="../assets/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js" type="text/javascript"></script>
        <script src="../assets/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
        <script src="../assets/plugins/jquery.blockui.min.js" type="text/javascript"></script>
        <script src="../assets/plugins/jquery.cokie.min.js" type="text/javascript"></script>
        <script src="../assets/plugins/uniform/jquery.uniform.min.js" type="text/javascript"></script>
        <!-- END CORE PLUGINS -->
        <!-- BEGIN PAGE LEVEL PLUGINS -->
        <script src="../assets/plugins/jquery-validation/dist/jquery.validate.min.js" type="text/javascript"></script>
        <script src="../assets/plugins/backstretch/jquery.backstretch.min.js" type="text/javascript"></script>
        <script type="text/javascript" src="../assets/plugins/select2/select2.min.js"></script>
        <!-- END PAGE LEVEL PLUGINS -->
        <!-- BEGIN PAGE LEVEL SCRIPTS -->
        <script src="../assets/scripts/core/app.js" type="text/javascript"></script>
        <script src="../assets/scripts/custom/lock.js"></script>
        <script>
            jQuery(document).ready(function() {
                App.init();
                Lock.init();
            });
        </script>
        <!-- END JAVASCRIPTS -->
    </body>
    <!-- END BODY -->
</html>