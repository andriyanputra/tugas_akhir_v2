<?php
include '../template/header.php';
session_start();
include '../config/functions.php'; //include function.php - very important
include '../config/koneksi.php'; //include function.php - very important

if (!loggedin()) { // check if the user is logged in, but if it isn't, it will redirect to the Login Form page. Noticed the difference?
    header("Location: ../login/login.php");
    exit();
}

if (isset($_SESSION['pegawai_nomor']) || isset($_COOKIE['pegawai_nomor'])) {
    $sql = mysql_query("SELECT * FROM pegawai WHERE pegawai_nip='" . $_SESSION['pegawai_nomor'] . "' OR pegawai_nip='" . $_COOKIE['pegawai_nomor'] . "'");
    if ($sql == false) {
        die(mysql_error());
        header('Location: ../login/login.php');
        exit();
    } else if (mysql_num_rows($sql)) {
        while ($row = mysql_fetch_assoc($sql)) {
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
                            <li class="active">Laporan Kejadian</li>
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
                                Laporan Kejadian
                                <small>
                                    <i class="icon-double-angle-right"></i>
                                    Overview
                                </small>
                            </h1>
                        </div><!--/.page-header-->

                        <div class="row-fluid">
                            <div class="span12">
                                <!--PAGE CONTENT BEGINS-->
                                <div class = "space-6"></div>
                                <form class="form-inline center" method="post" />
                                    Tampilkan Berdasarkan :&nbsp;&nbsp;
                                    <select class="span2" id="bulan">
                                        <option value=""/>Pilih Bulan...
                                        <option value="Jan"/>Jan
                                        <option value="Feb"/>Feb
                                        <option value="Mar"/>Mar
                                        <option value="Apr"/>Apr
                                        <option value="Mei"/>Mei
                                        <option value="Jun"/>Jun
                                        <option value="Jul"/>Jul
                                        <option value="Agt"/>Agt
                                        <option value="Sep"/>Sep
                                        <option value="Okt"/>Okt
                                        <option value="Nov"/>Nov
                                        <option value="Des"/>Des
                                    </select>
                                    <select class="span2" id="tahun">
                                        <option value="" />Pilih Tahun...
                                        <option value="2013" />2013
                                        <option value="2014" />2014
                                    </select>

                                    <!--<input type="button" id="button" value="Cari" />-->
                                    <button id="button" onclick="return false;" class="btn btn-danger btn-small">
                                        Cari
                                        <i class="icon-search bigger-110"></i>
                                    </button>
                                </form>
                                <div class = "table-header center">
                                    Laporan Kejadian Kebakaran Bulanan di Kab. Sidoarjo
                                </div>
                                <table id = "result" class = "table table-striped table-bordered table-hover">
                                    <thead>
                                        <tr>
                                           <th rowspan="2" class="center">No.</th>
                                           <th rowspan="2" class="center">Bulan Kejadian</th>
                                           <th rowspan="2" class="center">Jumlah Kejadian</th>
                                           <th rowspan="2" class="center">Jumlah Bangunan Terbakar</th>
                                           <th colspan="2" class="center">Jumlah Korban</th>
                                           <th rowspan="2" class="center">Jumlah Nominal Kerugian</th>
                                           <th rowspan="2" class="center">Action</th>
                                         </tr>
                                         <tr>
                                           <th class="center">Korban Luka</th>
                                           <th class="center">Korban Meninggal</th>
                                         </tr>
                                    </thead>

                                    <tbody></tbody>
                                </table>
                                <!--<div id="error_msg_box"      ></div>-->
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

<script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>

<script type="text/javascript">
    window.jQuery || document.write("<script src='../assets/js-ace/jquery-2.0.3.min.js'>" + "<" + "/script>");
</script>

<script type="text/javascript">
    if ("ontouchend" in document)
        document.write("<script src='../assets/js-ace/jquery.mobile.custom.min.js'>" + "<" + "/script>");
</script>
<script src="../assets/js-ace/bootstrap.min.js"></script>

<!--page specific plugin scripts-->
<script src="../assets/js-ace/jquery-ui-1.10.3.custom.min.js"></script>
<script src="../assets/js-ace/jquery.ui.touch-punch.min.js"></script>
<!--<script src="../assets/js-ace/jquery.dataTables.min.js"></script>
<script src="../assets/js-ace/jquery.dataTables.bootstrap.js"></script>-->
<script src="../assets/js-ace/sweet-alert.js"></script>
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
    $(document).ready(function(){
        function search(){

          var bulan=$("#bulan").val();
          var tahun=$("#tahun").val();

          if(bulan!="" && tahun!=""){
            //$("#result").html("<img src='img/ajax-loader.gif'/>");
             $.ajax({
                type:"post",
                url:"get_report.php",
                data:{bulan:bulan, tahun:tahun},
                success:function(data){
                    $("table#result tbody").html(data);
                    //$("#result").html(data);
                    $("#search").val("");
                }
            });
        }else if(bulan==""||tahun==""){
            setTimeout(function() {
                swal("Oops...", "Mohon untuk memilih bulan dan tahun !", "error");
            }, 200);
        } 
    }

    $("#button").click(function(){
        search();
    });

    $('#search').keyup(function(e) {
        if(e.keyCode == 13) {
            search();
        }
    });
});
</script>
</body>
</html>