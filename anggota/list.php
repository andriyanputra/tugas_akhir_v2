<?php
include '../template/header.php';
session_start();
include ("../login/koneksi.php");
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
                                    <?php
                                    echo $hasil['pegawai_nama'];
                                }
                                ?>    
                            </span>

                            <i class="icon-caret-down"></i>
                        </a>

                        <ul class="user-menu pull-right dropdown-menu dropdown-yellow dropdown-caret dropdown-closer">

                            <li>
                                <a href="profile">
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
                    <li class="active">Anggota Pemadam</li>
                </ul><!--.breadcrumb-->

            </div>

            <div class="page-content">
                <div class="page-header position-relative">
                    <h1>
                        Anggota Pemadam
                        <small>
                            <i class="icon-double-angle-right"></i>
                            Overview
                        </small>
                    </h1>
                </div><!--/.page-header-->

                <div class="row-fluid">
                    <div class="span12">
                        <!--PAGE CONTENT BEGINS-->
                        <div class="span10"></div>
                        <div class="span2">
                            <a href="tambah">
                                <button class="btn btn-mini btn-primary btn-block" data-rel="tooltip" title="Tambah Pegawai">
                                    <i class="icon-plus bigger-130"></i>
                                    <strong>Tambah</strong>
                                </button>
                            </a>
                        </div>

                        <div class="space-6"></div>

                        <table id="sample-table-1" class="table table-striped table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th class="center">No.</th>
                                    <th>Nomor Induk</th>
                                    <th>Nama</th>
                                    <th>Alamat</th>
                                    <th>No. Telepon</th>
                                    <th>Jabatan</th>
                                    <th></th>
                                </tr>
                            </thead>

                            <tbody>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td>3,330</td>
                                    <td>Feb 12</td>
                                    <td></td>
                                    <td></td>
                                </tr>

                                <tr>
                                    <td class="center">

                                    </td>

                                    <td>
                                        <a href="#">pro.com</a>
                                    </td>
                                    <td>$55</td>
                                    <td class="hidden-480">4,250</td>
                                    <td class="hidden-phone">Jan 21</td>

                                    <td class="hidden-480">
                                        <span class="label label-success">Registered</span>
                                    </td>

                                    <td>
                                        <div class="hidden-phone visible-desktop btn-group">
                                            <button class="btn btn-mini btn-success">
                                                <i class="icon-ok bigger-120"></i>
                                            </button>

                                            <button class="btn btn-mini btn-info">
                                                <i class="icon-edit bigger-120"></i>
                                            </button>

                                            <button class="btn btn-mini btn-danger">
                                                <i class="icon-trash bigger-120"></i>
                                            </button>

                                            <button class="btn btn-mini btn-warning">
                                                <i class="icon-flag bigger-120"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>  
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