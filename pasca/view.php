<?php
include '../template/header.php';

session_start();
include ("../config/koneksi.php");
include '../config/functions.php'; //include function.php - very important

if (!loggedin()) { // check if the user is logged in, but if it isn't, it will redirect to the Login Form page. Noticed the difference?
    header("Location: ../login/login.php");
    exit();
}

if ((isset($_SESSION['pegawai_nomor']) && isset($_SESSION['level'])) || (isset($_COOKIE['level']) && isset($_COOKIE['pegawai_nomor']))) {
    $sql = mysql_query("SELECT * FROM pegawai WHERE (pegawai_nip='" . $_SESSION['pegawai_nomor'] . "' AND id_level_user='".$_SESSION['level']."') 
                        OR (pegawai_nip='" . $_COOKIE['pegawai_nomor'] . "' AND id_level_user='".$_COOKIE['level']."')") or die("Query : ".mysql_error());
    $query = mysql_query("SELECT * FROM resiko AS a INNER JOIN pasca AS b ON (a.resiko_id = b.resiko_id) 
        INNER JOIN kecamatan AS c ON (c.KECAMATAN_ID = a.KECAMATAN_ID)
        INNER JOIN desa AS d ON (d.KECAMATAN_ID = c.KECAMATAN_ID)
        INNER JOIN bangunan AS e ON (e.ID_BANGUNAN = a.ID_BANGUNAN)
        INNER JOIN master_bangunan AS f ON (e.ID_MASTER = f.ID_MASTER)
        INNER JOIN penyebab AS g ON (b.penyebab_id = g.penyebab_id)
        WHERE a.resiko_id = '".$_GET['id']."' AND a.resiko_status = 'yes' LIMIT 1") or die(mysql_error());
if ($sql == false) {
        die(mysql_error());
        header('Location: ../login/login.php');
        exit();
    } else if (mysql_num_rows($sql) && mysql_num_rows($query)) {
        while ($row = mysql_fetch_assoc($sql)) {
            ?>
<style type="text/css">
        /*** set the width and height to match your images **/
        #slideshow {
            position:relative;
            height:400px;
        }
        #slideshow DIV {
            position:absolute;
            top:0;
            left:0;
            z-index:8;
            opacity:0.0;
            height: 400px;
            background-color: #FFF;
        }
        #slideshow DIV.active {
            z-index:10;
            opacity:1.0;
        }
        #slideshow DIV.last-active {
            z-index:9;
        }
        #slideshow DIV IMG {
            height: 350px;
            display: block;
            border: 0;
            margin-bottom: 10px;
        }
        </style>
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
                                        <?php
                                        $level = $row['id_level_user'];
                                        $jabatan = $row['jabatan_id'];
                                        $cek_pesan = mysql_query("SELECT * FROM pesan WHERE pesan_status = 0 AND pesan_untuk='$jabatan'") or die("Query : ".mysql_error());
                                        $jml_pesan = mysql_num_rows($cek_pesan);
                                        if($jml_pesan > 0){
                                            echo "<span class='badge badge-success'>$jml_pesan</span>";
                                        }else{
                                            echo "<span class='badge badge-success'>0</span>";
                                        }
                                        ?>
                                    </a>

                                    <ul class="pull-right dropdown-navbar dropdown-menu dropdown-caret dropdown-closer">
                                        <li class="nav-header">
                                            <i class="icon-envelope-alt"></i>
                                            <?php 
                                            if($jml_pesan > 0){
                                                echo "$jml_pesan Pesan";
                                            }else{
                                                echo "0 Pesan";
                                            }
                                            ?>
                                        </li>
                                        
                                        <?php
                                            $q_pesan = mysql_query("SELECT b.id, b.pesan_id, b.pesan_dari, b.pesan_isi, a.resiko_tanggal_start, c.pegawai_nama
                                                                    FROM resiko AS a INNER JOIN pesan AS b ON (a.resiko_id = b.resiko_id)
                                                                    INNER JOIN pegawai AS c ON (c.pegawai_nip = b.pegawai_nip)
                                                                    WHERE b.pesan_status = 0 AND b.pesan_untuk='$jabatan'
                                                                    GROUP BY b.id ORDER BY b.id ASC
                                                                    LIMIT 3") or die("Query : ".mysql_error());
                                            while($pesan = mysql_fetch_array($q_pesan)){
                                                $nama = $pesan['pegawai_nama'];
                                                $first_nama = explode(' ',trim($nama));
                                                //echo $first_nama[0];
                                        ?>
                                        <li>
                                            <a href="../pesan/detail?id=<?php echo $pesan['pesan_id'].'&no='.$pesan['id'];?>">
                                                <span class="msg-body">
                                                    <span class="msg-title">
                                                        <span class="blue"><?php echo $first_nama[0].': ' ?></span>
                                                        <?php
                                                            $isi = $pesan['pesan_isi'];
                                                            $potong_isi = substr($isi,0,50);
                                                            echo $potong_isi.'...';
                                                        ?>
                                                    </span>

                                                    <span class="msg-time">
                                                        <i class="icon-time"></i>
                                                        <span>
                                                            <?php
                                                                $p_tgl = date('H:i:s A', strtotime($pesan['resiko_tanggal_start']));
                                                                echo $p_tgl;
                                                            ?>
                                                        </span>
                                                    </span>
                                                </span>
                                            </a>
                                        </li>
                                        <?php
                                            }
                                        ?>
                                        <li>
                                            <a href="../pesan/">
                                                Lihat Semua Pemberitahuan
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
                        </div><!--/.cont
                        ainer-fluid-->
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
                                <li class="active">Lihat Kejadian Kebakaran</li>
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
                                    Lihat Kejadian Kebakaran
                                    <small>
                                        <i class="icon-double-angle-right"></i>
                                        Overview
                                    </small>
                                </h1>
                            </div><!--/.page-header-->

                            <div class="row-fluid">
                                <div class="span12">
                                    <!--PAGE CONTENT BEGINS-->
                                    <div class="row-fluid">
                                        <div class="span6">
                                            <?php $r = mysql_fetch_array($query); ?>
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
                                                        <div class="slim-scroll" data-height="300">
                                                            <div class="content">
                                                                <p align="center">
                                                                    <img src="../assets/img/sda/large/<?= $r['KECAMATAN_DIR']; ?>" width="829" height="441" id="gambar2"></p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div><!--/.span6-->
                                        <div class="span6">
                                            <div class="control-group">
                                                <label class="control-label" for="nama"><b>Nama Pelapor :</b></label>
                                                <?php $tlp = substr($r['nomor_telp'],0,-3); ?>
                                                <div class="controls">
                                                    <?php echo $r['nama_pelapor'].' ('.$tlp.'***)';?>
                                                </div>
                                            </div>

                                            <div class="control-group">
                                                <label class="control-label" for="alamat"><b>Alamat :</b></label>

                                                <div class="controls">
                                                    <?php echo $r['alamat_pelapor'].' Ds. '.$r['DESA_NAMA'].', Kec. '.$r['KECAMATAN_NAMA'].', Kab. Sidoarjo.' ?>
                                                </div>
                                            </div>
                                            <?php
                                                $tgl = $r['resiko_tanggal_start'];
                                                $tanggal = date('d M Y', strtotime($tgl));
                                                $hari = date('l', strtotime($tgl));
                                                if($hari == 'Sunday')$hari = 'Minggu';else if($hari == 'Monday')$hari = 'Senin';
                                                else if($hari == 'Tuesday')$hari = 'Selasa';else if($hari == 'Wednesday')$hari = 'Rabu';
                                                else if($hari == 'Thursday')$hari = 'Kamis';else if($hari == 'Friday')$hari = 'Jumat';
                                                else if($hari == 'Saturday')$hari = 'Sabtu';
                                                $pukul = date('H:i', strtotime($tgl));
                                            ?>
                                            <div class="control-group">
                                                <label class="control-label" for="tanggal"><b>Tanggal :</b></label>

                                                <div class="controls">
                                                    <?php echo $hari.', '.$tanggal.'. Pukul: '.$pukul.' WIB'; ?>
                                                </div>
                                            </div>

                                            <div class="control-group">
                                                <label class="control-label" for="tanggal"><b>Tipe Proteksi :</b></label>
                                                <?php if($r['tipe_proteksi'] == 'MPKP') $tipe_proteksi = 'MPKP (Manajemen Proteksi Kebakaran Perkotaan)'; ?>
                                                <?php if($r['tipe_proteksi'] == 'MPKL') $tipe_proteksi = 'MPKL (Manajemen Proteksi Kebakaran Lingkungan)'; ?>
                                                <?php if($r['tipe_proteksi'] == 'MPKBG') $tipe_proteksi = 'MPKBG (Manajemen Proteksi Kebakaran Bangunan)'; ?>
                                                <div class="controls">
                                                    <?php echo $tipe_proteksi; ?>
                                                </div>
                                            </div>

                                            <div class="control-group">
                                                <label class="control-label" for="tanggal"><b>Keterangan Kejadian :</b></label>

                                                <div class="controls">
                                                    <?php echo $r['exposure']; ?>
                                                </div>
                                            </div>

                                            <div class="control-group">
                                                <label class="control-label" for="tanggal"><b>Bangunan Terbakar :</b></label>

                                                <div class="controls">
                                                    <?php echo $r['NAMA_BANGUNAN'].' ('.$r['NAMA_MASTER'].')'; ?>
                                                </div>
                                            </div>
                                        </div><!--/.span6-->
                                    </div><!--/.row-fluid-->
                                    <div class="space-6"></div>
                                        <div class="row-fluid">
                                            <div class="span6">
                                                <div class="control-group">
                                                    <label class="control-label" for="tanggal"><b>Deskripsi Bangunan & Proses Pemadaman :</b></label>

                                                    <div class="controls">
                                                    <?php $pasokan = round($r['pasokan_air_minimum']/264.172052, 1); ?>
                                                    <?php $laju = round($r['penerapan_air']/3.7854118, 1); ?>
                                                        <ul>
                                                            <li>Penanganan Kebakaran : <?php echo $r['tepol']; ?></li>
                                                            <li>Volume Bangunan : <?php echo $r['panjang'].' x '.$r['lebar'].' x '.$r['tinggi'].' m<sup>3</sup>' ?></li>
                                                            <li>Pasokan Air Total : <?php echo $r['pasokan_air_minimum'].' US galon atau '.$pasokan.' m<sup>3</sup>'; ?></li>
                                                            <li>Laju Penerapan Air : <?php echo $r['penerapan_air'].' galon/menit atau '.$laju.' liter/menit'; ?></li>
                                                            <li>Kemampuan Aliran Maksimum : <?php echo $r['pengangkutan_air'].' gpm.' ?></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="control-group">
                                                    <label class="control-label" for="tanggal"><b>Lama Perjalanan dan Pemadaman :</b></label>
                                                    <?php $waktu = mysql_fetch_assoc(mysql_query("SELECT HOUR(pasca_lama_perjalanan) AS jam, HOUR(pasca_penyelesaian) AS jam_selesai,
                                                                                                MINUTE(pasca_lama_perjalanan) AS menit, MINUTE(pasca_penyelesaian) AS menit_selesai 
                                                                                                FROM pasca WHERE resiko_id='".$_GET['id']."'")) or die("Query : ".mysql_error()); ?>
                                                    <div class="controls">
                                                        <?php 
                                                            echo $waktu['jam'].' jam '.$waktu['menit'].' menit dan '.$waktu['jam_selesai'].' jam '.$waktu['menit_selesai'].' menit.'
                                                        ?>
                                                    </div>
                                                </div>
                                                <div class="control-group">
                                                    <label class="control-label" for="penyebab"><b>Penyebab Kebakaran :</b></label>
                                                    <?php 
                                                        if($r['penyebab_id'] == '5'){
                                                            $last_id = mysql_fetch_assoc(mysql_query("SELECT pasca_id FROM pasca WHERE resiko_id = '".$_GET['id']."'"));
                                                            $sebab = mysql_fetch_assoc(mysql_query("SELECT * FROM penyebab AS a
                                                                                                INNER JOIN penyebab_lain AS b ON (a.penyebab_id = b.penyebab_id)
                                                                                                INNER JOIN pasca AS c ON (a.penyebab_id = c.penyebab_id)
                                                                                                WHERE c.resiko_id = '".$_GET['id']."' AND b.pasca_id = '".$last_id['pasca_id']."'")) or die("Query : ".mysql_error());
                                                    ?>
                                                    <div class="controls">
                                                        <?php echo 'Lain-lain : '.$sebab['lain_nama']; ?>
                                                    </div>
                                                    <?php
                                                        }else{
                                                    ?>
                                                    <div class="controls">
                                                        <?php echo $r['penyebab_nama']; ?>
                                                    </div>
                                                    <?php
                                                        } 
                                                    ?>
                                                </div>  

                                                <div class="control-group">
                                                    <label class="control-label" for=""><b>Luas Kebakaran Total :</b></label>
                                                    
                                                    <div class="controls">
                                                        <?php echo $r['pasca_luas'].' m<sup>2</sup>'; ?>
                                                    </div>
                                                </div>
                                                <div class="control-group">
                                                    <label class="control-label" for=""><b>Korban Kebakaran :</b></label>
                                                    
                                                    <div class="controls">
                                                        <?php echo 'Luka = '.$r['pasca_luka'].' jiwa. <br>Meninggal = '.$r['pasca_meninggal'].' jiwa.'; ?>
                                                    </div>
                                                </div>
                                                <div class="control-group">
                                                    <label class="control-label" for=""><b>Biaya Kerugian :</b></label>
                                                    
                                                    <div class="controls">
                                                        <?php echo 'Rp. '. number_format($r['pasca_biaya'], 2, ',', '.'); ?>
                                                    </div>
                                                </div>           
                                            </div><!--/.span-->
                                            <div class="span6">
                                                <div class="widget-box">
                                                    <div class="widget-header widget-header-small header-color-red">
                                                        <h6>
                                                            Foto Lokasi Kejadian
                                                        </h6>

                                                        <div class="widget-toolbar">
                                                            <?php if($row['id_level_user'] == 1){ ?>
                                                            <span data-rel="tooltip" data-placement="right" title="Tambahkan Foto Lokasi Kejadian.">
                                                                <a href="#foto" role="button" data-toggle="modal">
                                                                    <i class="icon-plus white"></i>
                                                                </a>
                                                            </span>
                                                            <?php } ?>
                                                            <a href="#" data-action="reload">
                                                                <i class="icon-refresh"></i>
                                                            </a>

                                                            <a href="#" data-action="collapse">
                                                                <i class="icon-chevron-up"></i>
                                                            </a>
                                                        </div>
                                                    </div>

                                                    <div class="widget-body">
                                                        <div class="widget-main">
                                                            
                                                                <?php
                                                                    $foto_ = mysql_query("SELECT * FROM resiko AS a INNER JOIN foto_resiko AS b 
                                                                        ON (a.resiko_id = b.resiko_id) WHERE a.resiko_id = '".$_GET['id']."'") or die("Query : ".mysql_error());
                                                                    $cek_ = mysql_num_rows($foto_);
                                                                    if($cek_ > 1){
                                                                ?>
                                                                <div id="slideshow">
                                                                    <?php while($foto = mysql_fetch_array($foto_)) { ?>
                                                                        <div class="active">
                                                                            <img src="../assets/img/foto-kejadian/<?= $foto['foto_dir']; ?>" alt="<?php echo $foto['foto_nama'];?>" width="520" height="350"/>
                                                                            <?php echo $foto['foto_nama'];?>
                                                                        </div>
                                                                <?php } ?>
                                                                </div>
                                                                <?php }else if($cek_ == 1){ $foto1 = mysql_fetch_array($foto_)?>
                                                                    <a href="../assets/img/foto-kejadian/<?= $foto1['foto_dir']; ?>" title="<?php echo $foto1['foto_nama'];?>" data-rel="colorbox">
                                                                        <img src="../assets/img/foto-kejadian/<?= $foto1['foto_dir']; ?>" width="829" height="441"/>
                                                                    </a>
                                                                <?php
                                                                    }else{
                                                                ?>
                                                                <p class='alert alert-info center'>Tidak terdapat foto lokasi kejadian.</p>
                                                                <?php } ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div><!--/.span-->
                                        </div><!--/.row-fluid-->
                                        
                                        <?php
                                            if($_POST['simpan']=='Simpan'){
                                                $foto = $_FILES['foto'] ['name']; // Mendapatkan nama gambar
                                                $type = $_FILES['foto']['type'];
                                                $ukuran = $_FILES['foto']['size'];
                                                $nama_foto = $_POST['nama_foto'];
                                                $id = $_GET['id'];

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
                                                                    <input readonly type="text" class="span2" name="foto_id" value="<?php echo $_GET['id']; ?>">
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
                                    <!--PAGE CONTENT ENDS-->
                                </div><!--/.span-->
                            </div><!--/.row-fluid-->
                        </div><!--/.page-content-->
        

                <?php
                //include '../template/footer.php';
            }
        }else{
            ?>
            <script language="JavaScript">
                setTimeout(function() {
                    sweetAlert({
                      title: "Gagal lihat kejadian!", 
                      text: "Maaf, kejadian kebakaran belum selesai ditangani !!", 
                      type: "error"
                    }, function(){
                        document.location = 'pasca.php';
                    })
                }, 200);
            </script>
            <?php
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
<script src="../assets/js-ace/jquery.colorbox-min.js"></script>
<script src="../assets/js-ace/jquery.slimscroll.min.js"></script>
<script src="../assets/js-ace/autoNumeric.js"></script>
<script src="../assets/js-ace/sweet-alert.js"></script>
<!--ace scripts-->

<script src="../assets/js-ace/ace-elements.min.js"></script>
<script src="../assets/js-ace/ace.min.js"></script>
<script type="text/javascript">
</script>
<script type="text/javascript">
    // scrollables
    $('.slim-scroll').each(function() {
        var $this = $(this);
        $this.slimScroll({
            height: $this.data('height') || 100,
            railVisible: true
        });
    });

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
</script>
<script type="text/javascript">
    $(function() {
        var colorbox_params = {
            reposition:true,
            scalePhotos:true,
            scrolling:false,
            previous:'<i class="icon-arrow-left"></i>',
            next:'<i class="icon-arrow-right"></i>',
            close:'&times;',
            current:'{current} of {total}',
            maxWidth:'100%',
            maxHeight:'100%',
            onOpen:function(){
                document.body.style.overflow = 'hidden';
            },
            onClosed:function(){
                document.body.style.overflow = 'auto';
            },
            onComplete:function(){
                $.colorbox.resize();
            }
        };

        $('.widget-main [data-rel="colorbox"]').colorbox(colorbox_params);
        $("#cboxLoadingGraphic").append("<i class='icon-spinner orange'></i>");//let's add a custom loading icon

        /**$(window).on('resize.colorbox', function() {
            try {
                //this function has been changed in recent versions of colorbox, so it won't work
                $.fn.colorbox.load();//to redraw the current frame
            } catch(e){}
        });*/
    })
</script>
<script type="text/javascript">
    
</script>
<script type="text/javascript">
$(function() {
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
<script type="text/javascript">
    /*** 
    Simple jQuery Slideshow Script
    Released by Jon Raasch (jonraasch.com) under FreeBSD license: free to use or modify, not responsible for anything, etc.  Please link out to me if you like it :)
***/

function slideSwitch() {
    var $active = $('#slideshow DIV.active');

    if ( $active.length == 0 ) $active = $('#slideshow DIV:last');

    // use this to pull the divs in the order they appear in the markup
    var $next =  $active.next().length ? $active.next()
        : $('#slideshow DIV:first');

    // uncomment below to pull the divs randomly
    // var $sibs  = $active.siblings();
    // var rndNum = Math.floor(Math.random() * $sibs.length );
    // var $next  = $( $sibs[ rndNum ] );


    $active.addClass('last-active');

    $next.css({opacity: 0.0})
        .addClass('active')
        .animate({opacity: 1.0}, 1000, function() {
            $active.removeClass('active last-active');
        });
}

$(function() {
    setInterval( "slideSwitch()", 5000 );
});
</script>
</body>
</html>
