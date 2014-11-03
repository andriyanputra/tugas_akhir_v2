<?php
//
include '../template/header.php';

include '../config/functions.php'; //include function.php - very important
include '../config/koneksi.php';

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
                                            $q_pesan = mysql_query("SELECT b.pesan_id, b.pesan_dari, b.pesan_isi, a.resiko_tanggal_start, c.pegawai_nama
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
                                <li class="active">Grafik Kejadian Kebakaran</li>
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
                                    Grafik Kejadian Kebakaran
                                    <small>
                                        <i class="icon-double-angle-right"></i>
                                        Overview
                                    </small>
                                </h1>
                            </div><!--/.page-header-->

                            <div class="row-fluid">
                                <div class="span12">
                                    <!--PAGE CONTENT BEGINS-->
                                     <?php }}?>

                                        <!--===================GRAFIK=================-->
                                        
                                        <div class="row-fluid">
                                            <div class="span12">
                                                <!--<h4 class="header smaller lighter red">
                                                    <span>
                                                        <i class="icon-bar-chart"></i>
                                                         Berdasarkan Benda Pokok yang Terbakar
                                                    </span><!--/span-->
                                                <!--</h4>-->

                                                <div class="row-fluid">
                                                    <div class="span6">
                                                        <div class="widget-box">
                                                            <div class="widget-header widget-header-flat widget-header-small header-color-red">
                                                                <h5>
                                                                    <!--<i class="icon-bar-chart"></i>-->
                                                                    Berdasarkan Benda Pokok yang Terbakar <?php $thn ?>
                                                                </h5>
                                                                
                                                                <div class="widget-toolbar no-border">
                                                                    <button class="btn btn-minier btn-inverse dropdown-toggle" data-toggle="dropdown">
                                                                        This Week
                                                                        <i class="icon-angle-down icon-on-right"></i>
                                                                    </button>

                                                                    <ul class="dropdown-menu dropdown-info pull-right dropdown-caret">
                                                                        <li class="active">
                                                                            <a href="#">This Week</a>
                                                                        </li>

                                                                        <li>
                                                                            <a href="#">Last Week</a>
                                                                        </li>

                                                                        <li>
                                                                            <a href="#">This Month</a>
                                                                        </li>

                                                                        <li>
                                                                            <a href="#">Last Month</a>
                                                                        </li>
                                                                    </ul>
                                                                </div>
                                                            </div>

                                                            <div class="widget-body">
                                                                <div class="widget-main">
                                                                    <div></div>
                                                                </div><!--/widget-main-->
                                                            </div><!--/widget-body-->
                                                        </div><!--/widget-box-->
                                                    </div><!--/span6-->
                                                    <div class="span6">
                                                        <div class="widget-box">
                                                            <div class="widget-header widget-header-flat widget-header-small header-color-red">
                                                                <h5>
                                                                    <!--<i class="icon-bar-chart"></i>-->
                                                                    Bencana Kebakaran Berdasarkan pada Tipe Bangunan Th. <?php $thn ?>
                                                                </h5>

                                                                <div class="widget-toolbar no-border">
                                                                    <button class="btn btn-minier btn-inverse dropdown-toggle" data-toggle="dropdown">
                                                                        This Week
                                                                        <i class="icon-angle-down icon-on-right"></i>
                                                                    </button>

                                                                    <ul class="dropdown-menu dropdown-info pull-right dropdown-caret">
                                                                        <li class="active">
                                                                            <a href="#">This Week</a>
                                                                        </li>

                                                                        <li>
                                                                            <a href="#">Last Week</a>
                                                                        </li>

                                                                        <li>
                                                                            <a href="#">This Month</a>
                                                                        </li>

                                                                        <li>
                                                                            <a href="#">Last Month</a>
                                                                        </li>
                                                                    </ul>
                                                                </div>
                                                            </div>

                                                            <div class="widget-body">
                                                                <div class="widget-main">
                                                                    <div></div>
                                                                </div><!--/widget-main-->
                                                            </div><!--/widget-body-->
                                                        </div><!--/widget-box-->
                                                    </div><!--/span6-->
                                                </div><!--/.row-fluid-->

                                                <div class="space-6"></div>
                                                <div class="row-fluid"> 
                                                    <!--<h4 class="header smaller lighter red">
                                                            <span>
                                                                <i class="icon-bar-chart"></i>
                                                                 Berdasarkan Benda Pokok yang Terbakar
                                                            </span><!--/span-->
                                                        <!--</h4>-->

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
                                                </div><!--/.row-fluid-->

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
            Highcharts.getOptions().colors = Highcharts.map(Highcharts.getOptions().colors, function (color) {
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
             var chart;

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