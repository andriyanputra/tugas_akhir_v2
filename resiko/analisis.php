<?php
include '../template/header.php';

session_start();
include ("../config/koneksi.php");
if ($_SESSION['pegawai_nip'] && $_SESSION['pegawai_password']) {
    $sql = mysql_query("SELECT * FROM pegawai WHERE pegawai_nip='" . $_SESSION['pegawai_nip'] . "' AND pegawai_password='" . $_SESSION['pegawai_password'] . "'");
    if ($sql) {
        $hasil = mysql_fetch_assoc($sql);
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
                                <img class="nav-user-photo" src="../assets/img/b.jpg" alt="<?php echo $hasil['pegawai_nama']; ?>" />
                                <span class="user-info">
                                    <small>Welcome,</small>
                                    <?php echo $hasil['pegawai_nama'];
                                }
                                ?>    
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
                    <li class="active">Analisis Resiko Kebakaran</li>
                </ul><!--.breadcrumb-->
            </div>

            <div class="page-content">
                <div class="page-header position-relative">
                    <h1>
                        Analisis Resiko
                        <small>
                            <i class="icon-double-angle-right"></i>
                            Analisis Resiko Kebakaran
                        </small>
                    </h1>
                </div><!--/.page-header-->

                <div class="row-fluid">
                    <div class="span12">
                        <!--PAGE CONTENT BEGINS-->
                        <div class="tabbable">
                            <ul class="nav nav-tabs" id="myTab">
                                <li class="active">
                                    <a data-toggle="tab" href="#fire3">
                                        <i class="icon-warning-sign red"></i>
                                        Pasokan Air Total
                                    </a>
                                </li>

                                <li>
                                    <a data-toggle="tab" href="#fire4">
                                        <i class="icon-warning-sign red"></i>
                                        Laju Penerapan Air
                                    </a>
                                </li>

                                <li>
                                    <a data-toggle="tab" href="#fire5">
                                        <i class="icon-warning-sign red"></i>
                                        Potensi Pengangkutan Air
                                    </a>
                                </li>
                            </ul>

                            <div class="tab-content">
                                <div id="fire3" class="tab-pane in active">
                                    Form2 untuk perhitungaan Analisa Resiko
                                </div>

                                <div id="fire4" class="tab-pane">
                                    <table class="table table-striped table-bordered table-hover" id="sample-table-1">
                                        <thead>
                                            <tr>
                                                <th>No.</th>
                                                <th class="center">Peruntukan Bangunan</th>
                                                <th class="center">Status</th>
                                                <th class="center">Keterangan</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            <tr>
                                                <td>1</td>
                                                <td>Pabrik tepung</td>
                                                <td>
                                                    <span class="label label-important">Sangat Tinggi</span>
                                                </td>
                                                <td> - </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>

                                <div id="fire5" class="tab-pane"><table class="table table-striped table-bordered table-hover" id="sample-table-1">
                                        <thead>
                                            <tr>
                                                <th>No.</th>
                                                <th class="center">Peruntukan Bangunan</th>
                                                <th class="center">Status</th>
                                                <th class="center">Keterangan</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            <tr>
                                                <td>1</td>
                                                <td>Pabrik tepung</td>
                                                <td>
                                                    <span class="label label-important">Sangat Tinggi</span>
                                                </td>
                                                <td> - </td>
                                            </tr>
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
            include '../template/footer.php';
        } else {
            header("location:../login/login");
        }
        ?>  
        </body>
        </html>