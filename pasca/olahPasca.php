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
    $query = mysql_query("SELECT * FROM resiko AS a INNER JOIN desa AS b
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
                                        Olah Kejadian
                                    </small>
                                </h1>
                            </div><!--/.page-header-->

                            <div class="row-fluid">
                                <div class="span12">
                                    <!--PAGE CONTENT BEGINS-->
                                    <div class="row-fluid">
                                        <div class="span12">
                                            <?php 
                                                $r = mysql_fetch_assoc($query); 
                                                $luas = $r['panjang'] * $r['lebar'];
                                                $tgl = $r['resiko_tanggal_start'];
                                                $id = $r['resiko_id'];
                                                $tanggal = date('j F Y', strtotime($tgl));
                                                $hari = date('l', strtotime($tgl));
                                                if($hari == 'Sunday')$hari = 'Minggu';else if($hari == 'Monday')$hari = 'Senin';
                                                else if($hari == 'Tuesday')$hari = 'Selasa';else if($hari == 'Wednesday')$hari = 'Rabu';
                                                else if($hari == 'Thursday')$hari = 'Kamis';else if($hari == 'Friday')$hari = 'Jumat';
                                                else if($hari == 'Saturday')$hari = 'Sabtu';
                                                $pukul = date('H:i', strtotime($tgl));
                                                $no_barang = date('mdy-s');
                                            ?>
                                            <div class="widget-box">
                                                <div class="widget-header widget-hea1der-small header-color-red">
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
                                            </div><!--widget box-->
                                        </div>
                                    </div>
                                    <div class="space-6"></div>
                                    <div class="row-fluid">
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
                                            }else if($_GET['msg'] == 'error'){
                                                ?>
                                                <div class="alert alert-block alert-warning">
                                                    <button type="button" class="close" data-dismiss="alert">
                                                        <i class="icon-remove"></i>
                                                    </button>

                                                    <i class="icon-exclamation-sign red"></i>

                                                    &nbsp;&nbsp; 
                                                    Mohon untuk mengisi lama perjalanan atau lama pemadaman !!
                                                </div>
                                                <?php
                                            }
                                        }
                                        //while($r = mysql_fetch_array($query)){
                                        ?>

                                             <form class="form-horizontal" id="validation-form" method="POST" action="proses/submit.php">
                                                <input type="hidden" name="pasca_id" value="<?=$_GET['id']?>"/>
                                                <div class="row-fluid">
                                                    <div class="row-fluid">
                                                        <div class="control-group">
                                                            <span class="tooltip-error" data-rel="tooltip" data-placement="right" title="Barang Habis Pakai.">
                                                                <a href="#pesan" role="button" class="btn btn-danger btn-large" data-toggle="modal">
                                                                    <i class="icon-envelope icon-only bigger-150"></i>
                                                                </a>
                                                            </span>
                                                            <span class="tooltip-error" data-rel="tooltip" data-placement="right" title="Foto Pasca Kejadian Kebakaran.">
                                                                <a href="#foto" role="button" class="btn btn-large btn-info" data-toggle="modal">
                                                                    <i class="icon-picture icon-only bigger-150"></i>
                                                                </a>
                                                            </span>
                                                        </div>
                                                    </div><!-- end row-fluid -->

                                                    <div class="row-fluid">
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
                                                                <label class="control-label" ></label>
                                                                <div class="controls">
                                                                    <select id="bangunan_tbaru" name="bangunan_tbaru" class="">
                                                                        <option value=""/>Pilih Bangunan...
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
                                                            <label class="control-label" for="perjalanan">Lama Perjalanan :</label>
                                                            <div class="controls">
                                                                <div class="input-append bootstrap-timepicker">
                                                                    <input disabled type="text" id="start" class="input-small" name="awal_perjalanan" value="<?=$pukul;?>"/>
                                                                    <span class="add-on">
                                                                        <i class="icon-time"></i>
                                                                    </span>
                                                                </div>
                                                                -
                                                                <div class="input-append bootstrap-timepicker">
                                                                    <input id="timepicker1" type="text" class="input-small" name="akhir_perjalanan" value=""/>
                                                                    <span class="add-on">
                                                                        <i class="icon-time"></i>
                                                                    </span>
                                                                </div>
                                                                &nbsp;=&nbsp;
                                                                <div class="input-append bootstrap-timepicker">
                                                                    <input disabled type="text" id="hasil" class="input-small" name="hasil_perjalanan" value=""/>
                                                                    <span class="add-on">
                                                                        <i class="icon-time"></i>
                                                                    </span>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="control-group">
                                                            <label class="control-label" for="perjalanan">Lama Pemadaman :</label>
                                                            <div class="controls">
                                                                <div class="input-append bootstrap-timepicker">
                                                                    <input id="timepicker2" type="text" class="input-small" name="pemadaman" value=""/>
                                                                    <span class="add-on">
                                                                        <i class="icon-time"></i>
                                                                    </span>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="control-group">
                                                            <label class="control-label" for="penyebab">Penyebab Kebakaran :</label>
                                                            <?php
                                                                    $q = mysql_query("SELECT * FROM penyebab") or die("Query failed: " . mysql_error());
                                                                    ?>
                                                            <div class="controls">
                                                             <select id="penyebab" name="penyebab">
                                                                            <option value="" />Pilih Penyebab
                                                                            <?php while ($p = mysql_fetch_array($q)): ?>
                                                                                <option value="<?php echo $p['penyebab_id']; ?>"><?php echo $p['penyebab_nama']; ?></option>
                                                                            <?php endwhile; ?>
                                                                </select>
                                                                <!--<select id="penyebab" name="penyebab">
                                                                    <option value="" />Pilih Penyebab...
                                                                    <option value="BBM" />Bahan Bakar Minyak
                                                                    <option value="KPR/LPG" />Kompor Gas
                                                                    <option value="LST" />Listrik
                                                                    <option value="RK" />Rokok
                                                                    <option value="LAIN" />Lain-lain
                                                                </select>
                                                                <input name="check2" class="ace-switch ace-switch-2" type="checkbox" onclick="showMe_('penyebab_baru')" data-rel="tooltip" title="Penyebab kebakaran tidak terdapat dalam list ?" data-placement="bottom" />
                                                                <span class="lbl"></span>-->
                                                            </div>
                                                        </div>

                                                        <div id="penyebab_baru" style="display:none">
                                                            <div class="control-group">
                                                                <div class="controls">
                                                                    <input type="text" name="penyebab_baru" value="" placeholder="Nama Penyebab...">
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
                                                                    <input type="text" class="biaya" name="luas_total" value="" placeholder="Luas Keseluruhan Bangunan..." data-a-sep="">&nbsp;m<sup>2</sup>
                                                                </div>
                                                            </div>
                                                        </div>                                                

                                                        <div class="control-group">
                                                            <label class="control-label" for="korban">Jumlah Korban :</label>

                                                            <div class="controls">
                                                                <input type="text" class="korban" data-m-dec="0" id="korban_luka" name="korban_luka" placeholder="Korban Luka..." value="">
                                                                <input type="text" class="korban" data-m-dec="0" id="korban_meninggal" name="korban_meninggal" placeholder="Korban Meninggal..." value="">
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
                                                    </div><!-- end row-fluid -->
                                                </div><!-- end row-fluid -->
                                            </form>

                                            <?php
                                                if($_POST['add_pesan'] == 'Kirim'){
                                                    $no_ = $_POST['no_barang'];
                                                    $kepala_seksi = $_POST['kepala_seksi'];
                                                    $admin = $_POST['admin'];
                                                    $nama_barang = $_POST['nama_barang'];
                                                    $jml_barang = $_POST['jml_barang'];
                                                    $isi_pesan = $_POST['isi_pesan'];
                                                    //$id = $_POST['id'];

                                                    $jabatan = mysql_fetch_assoc(mysql_query("SELECT a.pegawai_nip, b.jabatan_nama FROM pegawai AS a 
                                                                                            INNER JOIN jabatan AS b ON (a.jabatan_id = b.jabatan_id)
                                                                                            WHERE a.pegawai_nip ='" . $_SESSION['pegawai_nomor'] . "' OR a.pegawai_nip='" . $_COOKIE['pegawai_nomor'] . "'")) or die("Query : ".mysql_error());
                                                    $nama_jabatan = $jabatan['jabatan_nama'];
                                                    $nip_pegawai = $jabatan['pegawai_nip'];
                                                    //echo $kepala_seksi.' - '.$admin.' - '.$id[0];
                                                    if(!empty($kepala_seksi) && !empty($admin)){
                                                        $addPesan_kep = mysql_query("INSERT INTO pesan VALUES 
                                                                        (NULL,'$no_','$id','$nama_barang','$jml_barang','$isi_pesan','0','$nip_pegawai','$nama_jabatan','$kepala_seksi')");
                                                        $addPesan_ad = mysql_query("INSERT INTO pesan VALUES 
                                                                        (NULL,'$no_','$id','$nama_barang','$jml_barang','$isi_pesan','0','$nip_pegawai','$nama_jabatan','$admin')");
                                                        if($addPesan_kep && $addPesan_ad){
                                            ?>
                                                    <script language="JavaScript">
                                                        setTimeout(function() {
                                                            swal("Pesan Terkirim!", "Pesan Anda telah terkirim ke Kepala Seksi Oprasional dan Administrator (Lain)", "success")
                                                        }, 200);
                                                    </script>
                                            <?php
                                                        }else{die("Query : ".mysql_error());}
                                                    }else{
                                                        $addPesan_kep = mysql_query("INSERT INTO pesan VALUES 
                                                                        (NULL,'$no_','$id','$nama_barang','$jml_barang','$isi_pesan','0','$nip_pegawai','$nama_jabatan','$kepala_seksi')");
                                                        if($addPesan_kep){
                                            ?>
                                                    <script language="JavaScript">
                                                        setTimeout(function() {
                                                            swal("Pesan Terkirim!", "Pesan Anda telah terkirim ke Kepala Seksi Oprasional", "success")
                                                        }, 200);
                                                    </script>
                                            <?php
                                                        }else{die("Query : ".mysql_error());}
                                                    }
                                                }
                                            ?>

                                            <form action="" method="post">
                                                <!--Modal-->
                                                <div id="pesan" class="modal hide fade" tabindex="-1">
                                                    <div class="modal-header no-padding">
                                                        <div class="table-header">
                                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                            <dd>&nbsp;</dd>
                                                            <dd align="center"><i class="icon-envelope icon-only bigger-150"></i>&nbsp;&nbsp;Pesan Barang Habis Pakai</dd>
                                                            <dd>&nbsp;</dd>
                                                        </div>
                                                    </div>

                                                    <div class="modal-body no-padding">
                                                        <div class="row-fluid">
                                                            <div class="span12">
                                                                <div class="space-6"></div>

                                                                <dl class="dl-horizontal">
                                                                    <dt>No :</dt>
                                                                    <dd>
                                                                        <input readonly type="text" class="span4" name="no_barang" id="" value="<?php echo 'SK-'.$no_barang; ?>">
                                                                        &nbsp;&nbsp;&nbsp;<b>ID Kebakaran :</b> <input readonly type="text" class="span2" id="" value="<?php echo '#'.$id; ?>">
                                                                        <input type="hidden" class="span2" name="id" id="" value="<?php echo $id; ?>">
                                                                    </dd>
                                                                    <dt>Tanggal Kejadian :</dt>
                                                                    <dd><?php echo $hari.', '.$tanggal; ?></dd>
                                                                    <dt>Tujuan :</dt>
                                                                    <dd>
                                                                        <label>
                                                                            <input name="kepala_seksi" class="ace-checkbox-2" type="checkbox" required value="Kepala Seksi Oprasional" />
                                                                            <span class="lbl"> Kepala Seksi Oprasional</span>
                                                                        </label>
                                                                        <label>
                                                                            <input name="admin" class="ace-checkbox-2" type="checkbox" value="Administrator" />
                                                                            <span class="lbl"> Administrator (Lain)</span>
                                                                        </label>
                                                                    </dd>
                                                                    <dt>Nama Barang : </dt>
                                                                    <dd>
                                                                        <input type="text" autocomplete="off" required id="nama_barang" name="nama_barang" placeholder="Nama Barang..." value="">
                                                                        <input type="text" autocomplete="off" required id="jml_barang" class="span2 korban" name="jml_barang" placeholder="Jml..." value="">
                                                                    </dd>
                                                                    <!--<div class="space-6"></div>-->
                                                                    <dt>Isi Pesan :</dt>
                                                                    <dd><textarea class="" required name="isi_pesan" id="isi_pesan" placeholder="Deskripsi Pesan..."></textarea></dd>
                                                                </dl>

                                                                
                                                                <p align="left">
                                                                <blockquote>
                                                                    <small>
                                                                        Berdasarkan PERMEN PU No. 20 Tahun 2009 Tentang Pedoman Teknis Manajemen Proteksi Kebakaran di Perkotaan.
                                                                    </small>
                                                                </blockquote>
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="modal-footer">
                                                        <input type="submit" class="span3 btn-success pull-right done" name="add_pesan" value="Kirim">
                                                        <!--<button class="btn btn-small btn-success pull-right" data-dismiss="modal">
                                                            <i class="icon-ok"></i>
                                                            Ok
                                                        </button>-->
                                                    </div>
                                                </div>
                                            </form>
                                            
                                            <?php
                                                if($_POST['simpan']=='Simpan'){
                                                    $foto = $_FILES['foto'] ['name']; // Mendapatkan nama gambar
                                                    $type = $_FILES['foto']['type'];
                                                    $ukuran = $_FILES['foto']['size'];
                                                    $nama_foto = $_POST['nama_foto'];

                                                    if ($ukuran > 1100000) {
                                            ?>
                                            <script language="JavaScript">
                                                setTimeout(function() {
                                                    swal("Terjadi Kesalahan", "Ukuran foto terlalu besar! Max: 1Mb", "error")
                                                }, 200);
                                            </script>
                                            <?php
                                                    }else{
                                                        $lokasi = "../assets/img/foto-kejadian";
                                                        $lokasi_foto = $_FILES['foto']['tmp_name'];
                                                        $tgl = date("dmy");
                                                        $nama_file_upload = $tgl . '-' . $foto;
                                                        $alamatfile = $lokasi . $nama_file_upload;

                                                        if (move_uploaded_file($lokasi_foto, $lokasi . "/" . $nama_file_upload)){
                                                            $addFoto = mysql_query("INSERT INTO foto_resiko VALUES (NULL, '$id', '$nama_foto', '$nama_file_upload')") or die("Query : ".mysql_error());
                                                            if($addFoto){
                                            ?>
                                            <script language="JavaScript">
                                                setTimeout(function() {
                                                    swal("Foto Disimpan!", "Selamat foto kejadian telah berhasil disimpan.", "success")
                                                }, 200);
                                            </script>
                                            <?php
                                                            }
                                                        }else{
                                            ?>
                                            <script language="JavaScript">
                                                setTimeout(function() {
                                                    swal("Terjadi Kesalahan", "Maaf, terjadi kesalahan unggah foto.", "error")
                                                }, 200);
                                            </script>
                                            <?php
                                                        }       
                                                    }
                                                }
                                            ?>
                                            <form action="" method="post" enctype="multipart/form-data">
                                                <div id="foto" class="modal hide" tabindex="-1">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                        <h4 class="blue bigger center">Foto Pasca Kejadian Kebakaran</h4>
                                                    </div>

                                                    <div class="modal-body overflow-visible">
                                                        <div class="row-fluid">
                                                            <div class="span5">
                                                                <div class="space"></div>
                                                                <input type="file" name="foto" id="file_foto"/>
                                                            </div>

                                                            <div class="vspace"></div>

                                                            <div class="span7">
                                                                <div class="control-group">
                                                                    <label class="control-label" for="id-foto">ID Foto</label>

                                                                    <div class="controls">
                                                                        <input readonly type="text" class="span2" name="foto_id" value="<?php echo $id; ?>">
                                                                    </div>
                                                                </div>

                                                                <div class="control-group">
                                                                    <label class="control-label" for="nama_foto">Nama Foto</label>

                                                                    <div class="controls">
                                                                        <input type="text" id="nama_foto" name="nama_foto" required placeholder="Judul Foto..." value="" />
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="modal-footer">
                                                        <input type="submit" class="btn-success" name="simpan" value="Simpan">
                                                        <!--<button class="btn btn-small" data-dismiss="modal">
                                                            <i class="icon-remove"></i>
                                                            Cancel
                                                        </button>

                                                        <button class="btn btn-small btn-primary">
                                                            <i class="icon-ok"></i>
                                                            Simpan
                                                        </button>-->
                                                    </div>
                                                </div>
                                            </form>
                                    </div><!--/.row-fluid-->
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
<script src="../assets/js-ace/jquery.slimscroll.min.js"></script>
<script src="../assets/js-ace/date-time/bootstrap-timepicker.min.js"></script>
<script src="../assets/js-ace/autoNumeric.js"></script>
<script src="../assets/js-ace/jquery.validate.min.js"></script>
<script src="../assets/js-ace/sweet-alert.js"></script>
<!--ace scripts-->

<script src="../assets/js-ace/ace-elements.min.js"></script>
<script src="../assets/js-ace/ace.min.js"></script>

<script type="text/javascript">

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
</script>
<script type="text/javascript">
    $(document).ready(function () {
        var intputElements = document.getElementsByTagName("input");
        var txtareaElements = document.getElementsByTagName("textarea");
        for (var i = 0; i < intputElements.length; i++) {
            intputElements[i].oninvalid = function (e) {
                e.target.setCustomValidity("");
                if (!e.target.validity.valid) {
                    if (e.target.name == "nama_barang") {
                        e.target.setCustomValidity("Mohon untuk mengisi field nama barang.");
                    }
                    else if(e.target.name == "jml_barang"){
                        e.target.setCustomValidity("Mohon untuk mengisi field jumlah barang.");
                    }
                    else if(e.target.name == "nama_foto"){
                        e.target.setCustomValidity("Mohon untuk mengisi field nama foto.");
                    }
                }
            };
        }
        for (var i = 0; i < txtareaElements.length; i++) {
            txtareaElements[i].oninvalid = function (e) {
                e.target.setCustomValidity("");
                if (!e.target.validity.valid) {
                    if (e.target.name == "isi_pesan") {
                        e.target.setCustomValidity("Mohon untuk mengisi kolom isi pesan.");
                    }
                }
            };
        }
    })
</script>
<script type="text/javascript">
$(function(){
    jQuery(function($) {
        $('.biaya').autoNumeric('init');
    });
    jQuery(function($) {
        $('.korban').autoNumeric('init',{mDec:'0'});
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

$(document).ready(function(){
        $("#penyebab").change(function(){
            $( "select option:selected").each(function(){
                if($(this).attr("value")=="5"){
                    //$(".box").hide();
                    $("#penyebab_baru").show();
                }
                if($(this).attr("value")=="1" || $(this).attr("value")=="2"){
                    $("#penyebab_baru").hide();
                }
                if($(this).attr("value")=="3" || $(this).attr("value")=="4"){
                    $("#penyebab_baru").hide();
                }
                if($(this).attr("value")==""){
                    $("#penyebab_baru").hide();
                }
            });
        }).change();
    });

    $('#timepicker1').timepicker({
        minuteStep: 1,
        showSeconds: false,
        showMeridian: false
    })
    $('#timepicker2').timepicker({
        minuteStep: 1,
        showSeconds: false,
        showMeridian: false
    })

    

    
        var timespent = function(){
            var valuestart = $("#start").val(),
                  valuestop = $("#timepicker1").val();

            valuestart = valuestart.split(":");
            valuestop = valuestop.split(":");

            var timeStart = new Date(0, 0, 0, valuestart[0], valuestart[1], 0);
            var timeEnd =  new Date(0, 0, 0, valuestop[0], valuestop[1], 0);

            var diff = timeEnd.getTime() - timeStart.getTime(), hours = Math.floor(diff / 1000 / 60 / 60);
            diff -= hours * 1000 * 60 * 60;
            var minutes = Math.floor(diff / 1000 / 60);
            console.log("start: "+timeStart+", end: "+timeEnd+", diff: "+diff);
                
            return (hours < 9 ? "0" : "") + hours + ":" + (minutes < 9 ? "0" : "") + minutes;
        };

        //var hourDiff = timeEnd - timeStart;

        $('#timepicker1').change(function(){
            $('#hasil').val( timespent() );
            
        });

    // scrollables
    $('.slim-scroll').each(function() {
        var $this = $(this);
        $this.slimScroll({
            height: $this.data('height') || 100,
            railVisible: true
        });
    });

    $(function() {
        $('#validation-form').show();
        //documentation : http://docs.jquery.com/Plugins/Validation/validate
        $('#validation-form').validate({
            errorElement: 'span',
            errorClass: 'help-inline',
            focusInvalid: false,
            rules: {
                perjalanan: {
                    required: true
                },
                pemadaman:{
                    required: true
                },
                bangunan_tbaru: {
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
                bangunan_tbaru: "Mohon untuk mengisi field bangunan.",
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
        ///////////////////////////////////////////
        $('#user-profile-3').end().find('button[type=reset]').on(ace.click_event, function() {
            $('#user-profile-3 input[type=file]').ace_file_input('reset_input');
        })
    });

   $('#file_foto').ace_file_input({
        style:'well',
        btn_choose : "Drop images here or click to choose",
        no_icon : "icon-picture",
        btn_change:null,
        droppable:true,
        thumbnail:'small',
        before_change : function(files, dropped) {
            var allowed_files = [];
            for(var i = 0 ; i < files.length; i++) {
                var file = files[i];
                if(typeof file === "string") {
                    //IE8 and browsers that don't support File Object
                    if(! (/\.(jpe?g|png|gif|bmp)$/i).test(file) ) return false;
                }
                else {
                    var type = $.trim(file.type);
                    if( ( type.length > 0 && ! (/^image\/(jpe?g|png|gif|bmp)$/i).test(type) )
                            || ( type.length == 0 && ! (/\.(jpe?g|png|gif|bmp)$/i).test(file.name) )//for android's default browser which gives an empty string for file.type
                        ) continue;//not an image so don't keep this file
                }
                
                allowed_files.push(file);
            }
            if(allowed_files.length == 0) return false;

            return allowed_files;
        }
    });
    
    //chosen plugin inside a modal will have a zero width because the select element is originally hidden
    //and its width cannot be determined.
    //so we set the width after modal is show
    $('#foto').on('show', function () {
        $(this).find('.chzn-container').each(function(){
            $(this).find('a:first-child').css('width' , '200px');
            $(this).find('.chzn-drop').css('width' , '210px');
            $(this).find('.chzn-search input').css('width' , '200px');
        });
    });

});
</script>
</body>
</html>
