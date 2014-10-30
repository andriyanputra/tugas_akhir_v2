<?php
include '../template/header.php';
session_start();
include '../config/functions.php'; //include function.php - very important
include '../config/koneksi.php'; //include function.php - very important

if (!loggedin()) { // check if the user is logged in, but if it isn't, it will redirect to the Login Form page. Noticed the difference?
    header("Location: ../login/login.php");
    exit();
}

if ((isset($_SESSION['pegawai_nomor']) && isset($_SESSION['level'])) || (isset($_COOKIE['level']) && isset($_COOKIE['pegawai_nomor']))) {
    $sql = mysql_query("SELECT * FROM pegawai WHERE (pegawai_nip='" . $_SESSION['pegawai_nomor'] . "' AND id_level_user='".$_SESSION['level']."') 
                        OR (pegawai_nip='" . $_COOKIE['pegawai_nomor'] . "' AND id_level_user='".$_COOKIE['level']."')") or die("Query : ".mysql_error());
   
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
                                            <a href="../pesan/detail?id=<?php echo $pesan['pesan_id'];?>">
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
                            <li class="active">Pesan</li>
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
                                Pesan
                                <small>
                                    <i class="icon-double-angle-right"></i>
                                    Detail Pesan
                                </small>
                            </h1>
                        </div><!--/.page-header-->

                        <div class="row-fluid">
                            <div class="span12">
                                <!--PAGE CONTENT BEGINS-->
                                <?php
                                    $query = mysql_query("SELECT * FROM  pegawai AS a INNER JOIN pesan AS b ON (a.pegawai_nip = b.pegawai_nip)
                                                            INNER JOIN resiko AS c ON (c.resiko_id = b.resiko_id)
                                                            INNER JOIN jabatan AS d ON (a.jabatan_id = d.jabatan_id)
                                                            WHERE b.pesan_id = '".$_GET['id']."' AND b.pesan_untuk = '$jabatan'") or die("Query : ".mysql_error());
                                    $data = mysql_fetch_array($query);
                                    $nama_jabatan = mysql_query("SELECT * FROM jabatan") or die("Query : ".mysql_error());
                                    while($j = mysql_fetch_array($nama_jabatan)) {
                                        if($j['jabatan_id'] == $data['pesan_untuk']){$pesan_untuk = $j['jabatan_nama'];}
                                        if($j['jabatan_id'] == $data['pesan_dari']){$pesan_dari = $j['jabatan_nama'];}
                                        //else if($data['pesan_dari'] == 2 || $data['pesan_untuk'] == 2){$pesan_dari = 'Kepala Seksi Oprasional';$pesan_untuk = 'Kepala Seksi Oprasional';}
                                    }
                                    $nama1 = $row['pegawai_nama'];
                                    $first_nama1 = explode(' ',trim($nama1));
                                    $tgl = $data['resiko_tanggal_start'];
                                    $tanggal = date('d M Y', strtotime($tgl));
                                    $hari = date('l', strtotime($tgl));
                                    if($hari == 'Sunday')$hari = 'Minggu';else if($hari == 'Monday')$hari = 'Senin';
                                    else if($hari == 'Tuesday')$hari = 'Selasa';else if($hari == 'Wednesday')$hari = 'Rabu';
                                    else if($hari == 'Thursday')$hari = 'Kamis';else if($hari == 'Friday')$hari = 'Jumat';
                                    else if($hari == 'Saturday')$hari = 'Sabtu';
                                    $pukul = date('H:i', strtotime($tgl));
                                    //$no_barang = date('mdy-s');
                                ?>
                                <div class="row-fluid">
                                    <div class="span6 form-horizontal">
                                        <div class="control-group">
                                            <label class="control-label" for="nomor">Nomor Pesan : </label>
                                            <div class="controls">
                                            <?php //echo $jabatan; ?>
                                                <input type="text" class="span4" readonly value="<?php echo $data['pesan_id']; ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="span6 form-horizontal">
                                        <div class="control-group">
                                            Tanggal : <?php echo $hari.', '.$tanggal.'. Pukul: '.$pukul.' WIB'; ?>
                                            
                                        </div>
                                    </div>
                                </div>
                                <div class="row-fluid form-horizontal">
                                    <div class="control-group">
                                        <label class="control-label" for="id">Id Kebakaran : </label>
                                        <div class="controls">
                                            <input type="text" class="span1" readonly value="<?php echo '#'.$data['resiko_id']; ?>">
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label" for="dari">Pesan Dari : </label>
                                        <div class="controls">
                                            <input type="text" class="span4" readonly value="<?php echo $pesan_dari.' ('.$first_nama1[0].')'; ?>">
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label" for="untuk">Pesan Untuk : </label>
                                        <div class="controls">
                                            <input type="text" class="span4" readonly value="<?php echo $pesan_untuk.' ('.$first_nama[0].')'; ?>">
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label" for="untuk">Peralatan/barang habis : </label>
                                        <div class="controls">
                                            <input type="text" class="span3" readonly value="<?php echo $data['pesan_nama']; ?>">&nbsp;&nbsp; Jumlah : 
                                            <input type="text" class="span1" readonly value="<?php echo $data['pesan_jml']; ?>">
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label" for="untuk">Isi Pesan : </label>
                                        <div class="controls">
                                            <textarea class="span6" readonly><?php echo $data['pesan_isi']; ?></textarea>
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <div class="controls">
                                            <span class="tooltip-error span3" data-rel="tooltip" data-placement="right" title="Balas">
                                                <a href="#pesan" role="button" class="btn btn-info btn-block" data-toggle="modal">
                                                    <i class="icon-mail-reply icon-only bigger-150"></i>
                                                </a>
                                            </span>
                                        </div>
                                    </div>

                                <form action="" method="post">
                                    <!--Modal-->
                                    <div id="pesan" class="modal hide fade" tabindex="-1">
                                        <div class="modal-header no-padding">
                                            <div class="table-header">
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                <dd>&nbsp;</dd>
                                                <dd align="center"><i class="icon-envelope icon-only bigger-150"></i>&nbsp;&nbsp;Balas Pesan</dd>
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
                                                            <input readonly type="text" class="span4" name="no_barang" id="" value="<?php echo $data['pesan_id']; ?>">
                                                            &nbsp;&nbsp;&nbsp;<b>ID Kebakaran :</b> <input readonly type="text" class="span2" id="" value="<?php echo '#'.$data['resiko_id']; ?>">
                                                        </dd>
                                                        <div class="space-6"></div>
                                                        <dt>Tanggal Kejadian :</dt>
                                                        <dd><input readonly type="text" class="" name="tgl_bls" id="" value="<?php echo date('Y-m-d H:i:s'); ?>"></dd>
                                                        <dt>Tujuan :</dt>
                                                        <dd>
                                                            <label>
                                                                <input name="kepala_seksi" class="ace-checkbox-2" type="checkbox" required value="Kepala Seksi Oprasional" />
                                                                <span class="lbl"> Kepala Seksi Oprasional</span>
                                                            </label>
                                                            <label>
                                                                <input name="admin" class="ace-checkbox-2" type="checkbox" value="Staff Administrasi Umum" />
                                                                <span class="lbl"> Administrator (Lain)</span>
                                                            </label>
                                                        </dd>
                                                        <dt>Nama Barang : </dt>
                                                        <dd>
                                                            <input type="text" autocomplete="off" required id="nama_barang" name="nama_barang" placeholder="Nama Barang..." value="">
                                                            <input type="text" autocomplete="off" required id="jml_barang" class="span2 korban" name="jml_barang" placeholder="Jml..." value="">
                                                        </dd>
                                                        <div class="space-6"></div>
                                                        <dt>Isi Pesan :</dt>
                                                        <dd><textarea class="" required name="isi_pesan" id="isi_pesan" placeholder="Deskripsi Pesan..."></textarea></dd>
                                                    </dl>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="modal-footer">
                                            <input type="submit" class="span3 btn-success pull-right done" name="add_pesan" value="Kirim">
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
                    <input type="checkbox" class="ace-checkbox-2" id="ace-settings-header" />
                    <label class="lbl" for="ace-settings-header"> Fixed Header</label>
                </div>

                <div>
                    <input type="checkbox" class="ace-checkbox-2" id="ace-settings-sidebar" />
                    <label class="lbl" for="ace-settings-sidebar"> Fixed Sidebar</label>
                </div>

                <div>
                    <input type="checkbox" class="ace-checkbox-2" id="ace-settings-breadcrumbs" />
                    <label class="lbl" for="ace-settings-breadcrumbs"> Fixed Breadcrumbs</label>
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

<script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>

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
<script src="../assets/js-ace/jquery-ui-1.10.3.custom.min.js"></script>
<script src="../assets/js-ace/jquery.ui.touch-punch.min.js"></script>
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
</script>
</body>
</html>