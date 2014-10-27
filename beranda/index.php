<?php
//
include '../template/header.php';
include '../config/functions.php'; //include function.php - very important
include '../config/koneksi.php';

if (!loggedin()) { // check if the user is logged in, but if it isn't, it will redirect to the Login Form page. Noticed the difference?
    header("Location: ../login/login.php");
    exit();
}

if (isset($_SESSION['pegawai_nomor']) || isset($_COOKIE['pegawai_nomor'])) {
    $sql = mysql_query("SELECT * FROM pegawai WHERE pegawai_nip='" . $_SESSION['pegawai_nomor'] . "'");
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
                            <a href="index" class="brand">
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
                                        $cek_pesan = mysql_query("SELECT * FROM pesan WHERE pesan_status = 0 AND pesan_untuk='Administrator'") or die("Query : ".mysql_error());
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
                                            $q_pesan = mysql_query("SELECT b.id, b.pesan_dari, b.pesan_isi, a.resiko_tanggal_start
                                                                    FROM resiko AS a INNER JOIN pesan AS b ON (a.resiko_id = b.resiko_id)
                                                                    WHERE b.pesan_status = 0 AND b.pesan_untuk='Administrator'
                                                                    GROUP BY b.id ORDER BY b.id ASC
                                                                    LIMIT 3") or die("Query : ".mysql_error());
                                            while($pesan = mysql_fetch_array($q_pesan)){
                                        ?>
                                        <li>
                                            <a href="../pesan/detail?id=<?php echo $pesan['id'];?>">
                                                <span class="msg-body">
                                                    <span class="msg-title">
                                                        <span class="blue"><?php echo $pesan['pesan_dari'].': ' ?></span>
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

                    <?php
                    include '../template/sidebar.php';
                    ?>

                    <div class="main-content">
                        <div class="breadcrumbs" id="breadcrumbs">
                            <ul class="breadcrumb">
                                <li>
                                    <i class="icon-home home-icon"></i>
                                    <a href="index">Home</a>

                                    <span class="divider">
                                        <i class="icon-angle-right arrow-icon"></i>
                                    </span>
                                </li>
                                <li class="active">Dashboard</li>
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
                                    Dashboard
                                    <small>
                                        <i class="icon-double-angle-right"></i>
                                        Overview
                                    </small>
                                </h1>
                            </div><!--/.page-header-->

                            <div class="row-fluid">
                                <div class="span12">
                                    <!--PAGE CONTENT BEGINS-->
                                     <?php
                                    if (isset($_GET['msg'])) {
                                        if ($_GET['msg'] == 'success') {
                                            ?>
                                    <div class="alert alert-block alert-success">
                                        <button type="button" class="close" data-dismiss="alert">
                                            <i class="icon-remove"></i>
                                        </button>

                                        <i class="icon-ok green"></i>

                                    </div>
                                    <?php
                                }else if($_GET['msg'] == 'log_in'){
                                    ?>
                                    <div class="alert alert-block alert-success">
                                        <button type="button" class="close" data-dismiss="alert">
                                            <i class="icon-remove"></i>
                                        </button>

                                        <i class="icon-ok green"></i>

                                        Selamat Datang
                                        <strong class="green">
                                            <?php
                                            echo $row['pegawai_nama'];
                                        }
                                    }
                                    ?>,
                                </strong>
                            </div>

                                    <?php 
                                }
                            }
                                    
                                $query_id = mysql_fetch_assoc(mysql_query("SELECT resiko_id FROM resiko ORDER BY resiko_id DESC LIMIT 1")) or die ('Query Id terakhir : '.mysql_error());
                                $resiko_id = $query_id['resiko_id'];
                                $query = mysql_query("SELECT * FROM kecamatan AS a
                                                        INNER JOIN resiko AS b ON (a.KECAMATAN_ID = b.KECAMATAN_ID)
                                                        INNER JOIN desa  AS c ON (c.KECAMATAN_ID = a.KECAMATAN_ID)
                                                        INNER JOIN bangunan AS d ON (d.ID_BANGUNAN = b.ID_BANGUNAN)
                                                        INNER JOIN master_bangunan AS e ON (d.ID_MASTER = e.ID_MASTER)
                                                        WHERE b.resiko_id = '$resiko_id' ORDER BY b.resiko_id LIMIT 1");
                                $r = mysql_fetch_assoc($query);
                                $hari = date('l',strtotime($r['resiko_tanggal_start']));
                                if($hari == 'Monday')$hari = 'Senin';
                                else if($hari == 'Tuesday')$hari = 'Selasa';
                                else if($hari == 'Wednesday')$hari = 'Rabu';
                                else if($hari == 'Thursday')$hari = 'Kamis';
                                else if($hari == 'Friday')$hari = 'Jumat';
                                else if($hari == 'Saturday')$hari = 'Sabtu';
                                else if($hari == 'Sunday')$hari = 'Minggu';
                                $bln = date('F', strtotime($r['resiko_tanggal_start']));
                                if($bln == 'January')$bln = 'Januari';else if($bln == 'February')$bln = 'Februari';
                                else if($bln == 'March')$bln = 'Maret';else if($bln == 'April')$bln = 'April';
                                else if($bln == 'May')$bln = 'Mei';else if($bln == 'June')$bln = 'Juni';
                                else if($bln == 'July')$bln = 'Juli';else if($bln == 'August')$bln = 'Agustus';
                                else if($bln == 'September')$bln = 'September';else if($bln == 'October')$bln = 'Oktober';
                                else if($bln == 'November')$bln = 'November';else if($bln == 'December')$bln = 'Desember';
                                $tgl = date('d', strtotime($r['resiko_tanggal_start']));
                                $thn = date('Y', strtotime($r['resiko_tanggal_start']));
                                $jam = date('H:i:s', strtotime($r['resiko_tanggal_start']));
                            ?>
                                        <!--===================KEJADIAN KEBAKARAN=================-->
                                        <div class="row-fluid">
                                            <div class="span12">
                                                <h4 class="header smaller lighter red">
                                                    <span>
                                                        <i class="icon-fire-extinguisher"></i>
                                                        Kejadian Kebakaran Terakhir Kali
                                                    </span><!--/span-->
                                                </h4>
                                                <div class="row-fluid">
                                                    <div class="span12">
                                                        <div class="span4">
                                                            <div class="widget-box light-border">
                                                                <div class="widget-header widget-header-flat widget-header-small header-color-red">
                                                                    <h5 class="smaller">Kecamatan <?=$r['KECAMATAN_NAMA']?></h5>
                                                                </div>

                                                                <div class="widget-body">
                                                                    <div class="widget-main">
                                                                        <img src="../assets/img/sda/small/<?= $r['KECAMATAN_DIR']; ?>"></p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div><!--/.span4-->
                                                        <div class="span8">
                                                            <dl class="dl-horizontal">
                                                                <dt>Tanggal</dt>
                                                                <dd><?php echo $hari.', '.$tgl.' '.$bln.' '.$thn.'. Pukul '.$jam.'.'; ?></dd>
                                                                <dt>Nama Pelapor</dt>
                                                                <dd><?php echo $r['nama_pelapor']; ?></dd>
                                                                <dt>Lokasi</dt>
                                                                <dd><?php echo $r['alamat_pelapor'].' Ds. '.$r['DESA_NAMA'].', Kec. '.$r['KECAMATAN_NAMA'].', Kab. Sidoarjo.';?></dd>
                                                                <dt>Bangunan</dt>
                                                                <dd><?php echo $r['NAMA_BANGUNAN'].' ('.$r['NAMA_MASTER'].').' ?></dd>
                                                                <dt>Luas Bangunan</dt>
                                                                <dd><?php echo $r['panjang'].' x '.$r['lebar'].' m<sup>2</sup>' ?></dd>
                                                                <dt></dt><dd><a href="../pasca/view?id=<?php echo $r['resiko_id']; ?>">Selanjutnya . . .</a></dd>
                                                            </dl>
                                                        </div><!--/.span8-->
                                                    </div><!--/.span12-->
                                                </div><!--/.row-fluid-->
                                                <div class="space-6"></div>
                                                <div class="pull-right">
                                                    <a href="../pasca/pasca" class="btn btn-small btn-danger">
                                                        <i class="icon-rss bigger-150 middle"></i>

                                                        Lihat lebih banyak kejadian
                                                        <i class="icon-on-right icon-arrow-right"></i>
                                                    </a>
                                                </div><!--/.pull-right-->
                                            </div><!--/.span12-->
                                        </div><!--/.row-fluid-->
                                        <!--===================END KEJADIAN KEBAKARAN=================-->

                                        <!--===================GRAFIK=================-->
                                        <div class="row-fluid">
                                            <div class="span12">
                                                <h4 class="header smaller lighter green">
                                                    <span>
                                                        <i class="icon-bar-chart"></i>
                                                         Grafik Kejadian Kebakaran
                                                    </span><!--/span-->
                                                </h4>
                                                <div class="row-fluid">
                                                    <div class="span12">    
                                                        <div class="span6">
                                                            <div class="widget-box">
                                                                <div class="widget-header widget-header-flat widget-header-small header-color-green">
                                                                    <h5>
                                                                        <!--<i class="icon-bar-chart"></i>-->
                                                                        Bencana Kebakaran Berdasarkan pada Tipe Bangunan Th. 2013.
                                                                    </h5>
                                                                </div>

                                                                <div class="widget-body">
                                                                    <div class="widget-main">
                                                                        <div id="pie-chart" style="min-width: 300px; height: 300px; margin: 0 auto"></div>
                                                                    </div><!--/widget-main-->
                                                                </div><!--/widget-body-->
                                                            </div><!--/widget-box-->
                                                        </div><!--/.span6-->
                                                        <div class="span6">
                                                            <div class="widget-box">
                                                                <div class="widget-header widget-header-flat widget-header-small header-color-green">
                                                                    <h5>
                                                                        <!--<i class="icon-bar-chart"></i>-->
                                                                        Bencana Kebakaran Berdasarkan pada Tipe Proteksi Th. 2013.
                                                                    </h5>
                                                                </div>

                                                                <div class="widget-body">
                                                                    <div class="widget-main">
                                                                        <div id="line-chart" style="min-width: 300px; height: 300px; margin: 0 auto"></div>
                                                                    </div><!--/widget-main-->
                                                                </div><!--/widget-body-->
                                                            </div><!--/widget-box-->
                                                        </div><!--/.span6-->
                                                    </div><!--/.span12-->
                                                </div><!--/.row-fluid-->
                                                <div class="space-6"></div>
                                                <div class="pull-right">
                                                    <a href="../grafik/" class="btn btn-small btn-success">
                                                        <i class="icon-rss bigger-150 middle"></i>

                                                        Lihat lebih banyak grafik
                                                        <i class="icon-on-right icon-arrow-right"></i>
                                                    </a>
                                                </div><!--/.pull-right-->
                                            </div><!--/.span12-->
                                        </div><!--/.row-fluid-->
                                        <!--===================END GRAFIK=================-->
                                    <!--PAGE CONTENT ENDS-->
                                </div><!--/.span-->
                            </div><!--/.row-fluid-->
                        </div><!--/.page-content-->



                <?php
                //include '../template/footer.php';
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
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
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
    <script src="../assets/plugins/highcharts.js"></script>
    <script src="../assets/plugins/exporting.js"></script>
    <!--<script src="http://code.highcharts.com/highcharts.js"></script>
    <script src="http://code.highcharts.com/modules/exporting.js"></script>-->
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
    <script type="text/javascript">
        $(function () {
            var chart;
            $(document).ready(function () {
                $.getJSON("proses/data.php", function (json) {

                    chart = new Highcharts.Chart({
                        chart: {
                            renderTo: 'line-chart',
                            type: 'line',
                            marginRight: 130,
                            marginBottom: 25
                        },
                        title: {
                            text: '',
                            x: -20 //center
                        },
                        subtitle: {
                            text: '',
                            x: -20
                        },
                        xAxis: {
                            categories: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agt', 'Sep', 'Okt', 'Nov', 'Des']
                        },
                        yAxis: {
                            title: {
                                text: 'Jumlah'
                            },
                            plotLines: [{
                                    value: 0,
                                    width: 1,
                                    color: '#808080'
                                }]
                        },
                        tooltip: {
                            formatter: function () {
                                return '<b>' + this.series.name + '</b><br/>' +
                                        this.x + ': ' + this.y;
                            }
                        },
                        legend: {
                            layout: 'vertical',
                            align: 'right',
                            verticalAlign: 'top',
                            x: -10,
                            y: 100,
                            borderWidth: 0
                        },
                        series: json
                    });
                });

            });
        });
    </script>
    <script type="text/javascript">
        $(function () {
            //Radialize the colors
            /*Highcharts.getOptions().colors = Highcharts.map(Highcharts.getOptions().colors, function (color) {
             return {
             radialGradient: {cx: 0.5, cy: 0.3, r: 0.7},
             stops: [
             [0, color],
             [1, Highcharts.Color(color).brighten(-0.3).get('rgb')] // darken
             ]
             };
             });
             Highcharts.setOptions({
             colors: ['#ff0000', '#18F918', '#DDDF00', '#24CBE5', '#64E572', '#FF9655', '#FFF263', '#6AF9C4']
             });
             var chart;*/

            $('#pie-chart').highcharts({
                chart: {
                    plotBackgroundColor: null,
                    plotBorderWidth: null,
                    plotShadow: false
                },
                title: {
                    text: '',
                },
                tooltip: {
                    pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
                },
                plotOptions: {
                    pie: {
                        allowPointSelect: true,
                        cursor: 'pointer',
                        dataLabels: {
                            enabled: true,
                            color: '#000000',
                            connectorColor: '#000000',
                            style: {
                                color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                            },
                            format: '<b>{point.name}</b>: {point.percentage:.1f} %'
                        }
                    }
                },
                series: [{
                        type: 'pie',
                        name: 'Jumlah Kejadian Kebakaran pada Bangunan',
                        data: [
<?php
$query = mysql_query("SELECT c.NAMA_MASTER, COUNT(c.NAMA_MASTER) AS Nilai
                                            FROM resiko AS a
                                                INNER JOIN bangunan AS b 
                                                    ON (a.ID_BANGUNAN = b.ID_BANGUNAN)
                                                INNER JOIN master_bangunan AS c
                                                    ON (b.ID_MASTER = c.ID_MASTER)
                                            WHERE a.resiko_tanggal_start BETWEEN '2013-01-01' AND '2013-12-31'
                                            GROUP BY c.NAMA_MASTER");
$numrows = mysql_num_rows($query);
while ($row = mysql_fetch_array($query)) {
    $data[0] = $row['NAMA_MASTER'];
    $data[1] = $row['Nilai'];
    echo "['" . $data[0] . "', " . $data[1] . "],";
}
?>
                        ]
                    }]
            });
        });
    </script>

</body>
</html>