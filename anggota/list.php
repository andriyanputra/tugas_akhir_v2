<?php
include '../template/header.php';
session_start();
include ("../config/koneksi.php");
include_once ('../config/function.php');

//$page = (int) (!isset($_GET["page"]) ? 1 : $_GET["page"]);
//$limit = 5;
//$startpoint = ($page * $limit) - $limit;
//to make pagination
//$statement = "`pegawai`,`jabatan`";

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
                                <img class="nav-user-photo" src="../assets/img/img-anggota/<?=$hasil['pegawai_foto'];?>" alt="<?php echo $hasil['pegawai_nama']; ?>" />
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
                                <a href="profile?nip=<?=$hasil['pegawai_nip'];?>">
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
                        <div class="span10">
                            <?php
                            /* $query = mysql_query("SELECT pegawai.pegawai_nip, pegawai.pegawai_nama, pegawai.pegawai_alamat, pegawai.pegawai_no_telp, jabatan.jabatan_nama
                              FROM {$statement}
                              WHERE jabatan.jabatan_id = pegawai.jabatan_id
                              LIMIT {$startpoint} , {$limit}");
                              echo info_paging($statement, $limit, $page);
                              $query = mysql_query("SELECT * FROM pegawai"); */
                            ?>
                        </div>
                        <div class="span2">
                            <a href="tambah">
                                <button class="btn btn-mini btn-primary btn-block" data-rel="tooltip" title="Tambah Pegawai">
                                    <i class="icon-plus bigger-130"></i>
                                    <strong>Tambah Data</strong>
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
                                    <?php
                                    $no = 1;
                                    $dataPerPage = 5; //Tentukan data per halaman
                                    // apabila $_GET['page'] sudah didefinisikan, gunakan nomor halaman tersebut,
                                    // sedangkan apabila belum, nomor halamannya 1.
                                    if (isset($_GET['page'])) {
                                        $noPage = $_GET['page'];
                                    }
                                    else
                                        $noPage = 1;
                                    // perhitungan offset
                                    $offset = ($noPage - 1) * $dataPerPage;
                                    // query SQL untuk menampilkan data perhalaman sesuai offset
                                    $query = "SELECT * FROM pegawai,jabatan
                                                WHERE jabatan.jabatan_id = pegawai.jabatan_id
                                                ORDER BY pegawai_nip ASC
                                                LIMIT $offset, $dataPerPage";
                                    $r = mysql_query($query) or die('Error');

                                    //$jum = mysql_num_rows($a);
                                    while ($data = mysql_fetch_array($r)) {
                                        ?>
                                        <td><?php echo $no; ?></td>
                                        <td><?php echo $data['pegawai_nip']; ?></td>
                                        <td><?php echo $data['pegawai_nama']; ?></td>
                                        <td><?php echo $data['pegawai_alamat']; ?></td>
                                        <td><?php echo $data['pegawai_no_telp']; ?></td>
                                        <td><?php echo $data['jabatan_nama']; ?></td>
                                        <td>
                                            <div class="hidden-phone visible-desktop btn-group">
                                                <a href="profile?nip=<?php echo $data['pegawai_nip']; ?>"><button class="btn btn-mini btn-success tooltip-info" title="View">
                                                        <i class="icon-ok bigger-120"></i>
                                                    </button></a>

                                                <a href="edit?nip=<?php echo $data['pegawai_nip']; ?>"><button class="btn btn-mini btn-info tooltip-info" title="Edit">
                                                        <i class="icon-edit bigger-120"></i>
                                                    </button></a>
                                                 
                                                <a href="prosesHapus?nip=<?php echo $data['pegawai_nip']; ?>" onclick="return confirm('Are you sure you want to delete?')">
                                                    <button class="btn btn-mini btn-danger tooltip-info" title="Delete">
                                                        <i class="icon-trash bigger-120"></i>
                                                    </button></a>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                                <?php
                                $no++;
                            }
                            ?>
                        </table>
                        <?php
                        //echo pagination($statement, $limit, $page);
                        // mencari jumlah semua data dalam tabel guestbook

                        $q = "SELECT COUNT(*) AS jumData FROM pegawai";
                        $hasil = mysql_query($q);
                        $d = mysql_fetch_array($hasil);

                        $jumData = $d['jumData'];

                        // menentukan jumlah halaman yang muncul berdasarkan jumlah semua data
                        $jumPage = ceil($jumData / $dataPerPage);

                        // menampilkan link previous
                        if ($noPage > 1)
                            echo "<a href='" . $_SERVER['PHP_SELF'] . "?page=" . ($noPage - 1) . "'>&lt;&lt; Prev</a>";

                        // memunculkan nomor halaman dan linknya
                        for ($page = 1; $page <= $jumPage; $page++) {
                            if ((($page >= $noPage - 3) && ($page <= $noPage + 3)) || ($page == 1) || ($page == $jumPage)) {
                                if (($showPage == 1) && ($page != 2))
                                    echo "...";
                                if (($showPage != ($jumPage - 1)) && ($page == $jumPage))
                                    echo "...";
                                if ($page == $noPage)
                                    echo " <b>" . $page . "</b> ";
                                else
                                    echo " <a href='" . $_SERVER['PHP_SELF'] . "?page=" . $page . "'>" . $page . "</a> ";
                                $showPage = $page;
                            }
                        }

                        // menampilkan link next
                        if ($noPage < $jumPage)
                            echo "<a href='" . $_SERVER['PHP_SELF'] . "?page=" . ($noPage + 1) . "'>Next &gt;&gt;</a>";
                        ?>

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