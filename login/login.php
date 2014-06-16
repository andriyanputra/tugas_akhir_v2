<!DOCTYPE html>

<!-- NEW CODE -->
<?php
include '../config/functions.php'; //includes the functions.php - very important

if (loggedin()) { //check if the user is logged in, if it is, it will skip this page and jump to the 'user-loggedin.php' page.
    header("Location: ../beranda/index.php");
    exit();
}
?>
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
        <link rel="stylesheet" type="text/css" href="../assets/plugins/select2/select2.css"/>
        <link rel="stylesheet" type="text/css" href="../assets/plugins/select2/select2-metronic.css"/>
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
    <body class="login">
        <!-- BEGIN LOGO -->
        <div class="logo">
            <a href="index.html">
                <img src="../assets/img/logo-big.png" alt=""/>
            </a>
        </div>
        <!-- END LOGO -->
        <!-- BEGIN LOGIN -->
        <div class="content">
            <!-- BEGIN LOGIN FORM -->
            <form class="login-form" action="../config/check.php" method="post">
                <h3 class="form-title">Silahkan Login</h3>
                <div class="alert alert-danger display-hide">
                    <button class="close" data-close="alert"></button>
                    <span>
                        Masukkan Nomor Induk dan Password.
                    </span>
                </div>
                <?php
                //echo isset($_COOKIE['pesan']) ? '<p class="alert" id="alert" onclick="hide()">' . $_COOKIE['pesan'] . '</p>' : '';
                ?>
                <div class="form-group">
                    <!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
                    <label class="control-label visible-ie8 visible-ie9">Nomor Induk</label>
                    <div class="input-icon">
                        <i class="fa fa-user"></i>
                        <input class="form-control placeholder-no-fix" type="text" autocomplete="off" placeholder="Nomor Induk" name="nomor"/>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label visible-ie8 visible-ie9">Password</label>
                    <div class="input-icon">
                        <i class="fa fa-lock"></i>
                        <input class="form-control placeholder-no-fix" type="password" autocomplete="off" placeholder="Password" name="password"/>
                    </div>
                </div>

                <div class="form-actions">
                    <div class="input-icon right">
                        <i class="fa fa-arrow-right"></i>
                        <label class="checkbox">
                            <input type="checkbox" name="remember" value="1"/> Remember me
                        </label>
                        <input type="submit" class="btn blue pull-right" name="login" value="LOG IN"/>
                    </div>
                </div>
                <!--<div class="form-actions">
                    <!--<button type="submit" class="btn blue pull-right">
                        Login <i class="m-icon-swapright m-icon-white"></i>
                    </button>
                </div>-->
                <div class="forget-password">
                    <h4>Lupa password ?</h4>
                    <p>
                        no worries, klik
                        <a href="javascript:;" id="forget-password">
                            disini
                        </a>
                        untuk reset passwordmu.
                    </p>
                </div>
                <!--<div class="create-account">
                    <p>
                        Don't have an account yet ?&nbsp;
                        <a href="javascript:;" id="register-btn">
                            Create an account
                        </a>
                    </p>
                </div>-->
            </form>
            <!-- END LOGIN FORM -->
            <!-- BEGIN FORGOT PASSWORD FORM -->
            <form class="forget-form" method="post" action="../config/rePass.php">
                <h3>Lupa Password ?</h3>
                <p>
                    Masukkan Nomor Induk Anda di bawah untuk reset password.
                </p>
                <div class="form-group">
                    <div class="input-icon">
                        <i class="fa fa-envelope"></i>
                        <input class="form-control placeholder-no-fix" type="text" autocomplete="off" placeholder="Nomor Induk" name="renomor"/>
                    </div>
                </div>
                <div class="form-actions">
                    <button type="button" id="back-btn" class="btn">
                        <i class="m-icon-swapleft"></i> Kembali </button>
                    <!--<button type="submit" class="btn blue pull-right" name="submit">
                        Submit <i class="m-icon-swapright m-icon-white"></i>
                    </button>-->
                    <input type="submit" class="btn blue pull-right" name="submit" value="Submit"/>
                </div>
            </form>
            <!-- END FORGOT PASSWORD FORM -->

        </div>
        <!-- END LOGIN -->
        <!-- BEGIN COPYRIGHT -->
        <div class="copyright">
            2014 &copy; Instansi Pemadam Kebakaran, Kabupaten Sidoarjo.
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
        <script src="../assets/scripts/custom/login-soft.js" type="text/javascript"></script>
        <script>
            jQuery(document).ready(function() {
                App.init();
                Login.init();
            });
        </script>
        <!-- END JAVASCRIPTS -->
    </body>
    <!-- END BODY -->
</html>