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
                                <?php
                                    $level = $row['id_level_user'];
                                    $jabatan = $row['jabatan_id'];
                                    if($level == 1 || $level == 3){
                                ?>
                                <li class="green">
                                    <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                                        <i class="icon-envelope icon-animated-vertical"></i>
                                        <?php
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
                                <?php }else{ ?>
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
                                <?php } ?>
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
                                    <a href="../beranda/index.php">Home</a>

                                    <span class="divider">
                                        <i class="icon-angle-right arrow-icon"></i>
                                    </span>
                                </li>
                                <li class="active">Kalendar</li>
                            </ul><!--.breadcrumb-->
                        </div>

                        <div class="page-content">
                            <div class="page-header position-relative">
                                <h1>
                                    Kalendar
                                    <small>
                                        <i class="icon-double-angle-right"></i>
                                        Jadwal Jaga Regu Pemadam Kebakaran
                                    </small>
                                </h1>
                            </div><!--/.page-header-->

                            <div class="row-fluid">
                                <div class="span12">
                                    <!--PAGE CONTENT BEGINS-->

                                    <div class="row-fluid">
                                        <div class="span2"></div>
                                        <div class="span8">
                                            <div class="space"></div>

                                            <div id="calendar"></div>
                                        </div>

                                        <div class="span2"></div>
                                    </div>

                                    <!--PAGE CONTENT ENDS-->
                                </div><!--/.span-->
                            </div><!--/.row-fluid-->
                        </div><!--/.page-content-->

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
                <script src="../assets/js-ace/fullcalendar.min.js"></script>
                <script src="../assets/js-ace/bootbox.min.js"></script>

                <!--ace scripts-->

                <script src="../assets/js-ace/ace-elements.min.js"></script>
                <script src="../assets/js-ace/ace.min.js"></script>

                <!--inline scripts related to this page-->

                <script type="text/javascript">
                    $(function() {
                        /* initialize the calendar
                        -----------------------------------------------------------------*/

                        var date = new Date();
                        var d = date.getDate();
                        var m = date.getMonth();
                        var y = date.getFullYear();

                        
                        var calendar = $('#calendar').fullCalendar({
                             buttonText: {
                                prev: '<i class="icon-chevron-left"></i>',
                                next: '<i class="icon-chevron-right"></i>'
                            },
                        
                            header: {
                                left: 'prev,next today',
                                center: 'title',
                                right: 'month,agendaWeek,agendaDay'
                            },
                            events: "json.php",
                            eventColor: '#d15b47',
                            editable: true,
                            droppable: true, // this allows things to be dropped onto the calendar !!!
                            drop: function(date, allDay) { // this function is called when something is dropped
                            
                                // retrieve the dropped element's stored Event Object
                                var originalEventObject = $(this).data('eventObject');
                                var $extraEventClass = $(this).attr('data-class');
                                
                                
                                // we need to copy it, so that multiple events don't have a reference to the same object
                                var copiedEventObject = $.extend({}, originalEventObject);
                                
                                // assign it the date that was reported
                                copiedEventObject.start = date;
                                copiedEventObject.allDay = allDay;
                                if($extraEventClass) copiedEventObject['className'] = [$extraEventClass];
                                
                                // render the event on the calendar
                                // the last `true` argument determines if the event "sticks" (http://arshaw.com/fullcalendar/docs/event_rendering/renderEvent/)
                                $('#calendar').fullCalendar('renderEvent', copiedEventObject, true);
                                
                                // is the "remove after drop" checkbox checked?
                                if ($('#drop-remove').is(':checked')) {
                                    // if so, remove the element from the "Draggable Events" list
                                    $(this).remove();
                                }
                                
                            }
                            ,
                            selectable: false,
                            selectHelper: true,
                            select: function(start, end, allDay) {
                                
                                bootbox.prompt("New Event Title:", function(title) {
                                    if (title !== null) {
                                        calendar.fullCalendar('renderEvent',
                                            {
                                                id: id,
                                                title: title,
                                                start: start,
                                                end: end,
                                                alamat: alamat,
                                                kecamatan: kecamatan,
                                                desa: desa,
                                                korban: korban,
                                                allDay: allDay
                                            },
                                            true // make the event "stick"
                                        );
                                    }
                                });
                                

                                calendar.fullCalendar('unselect');
                                
                            }
                            ,
                            eventClick: function(calEvent, jsEvent, view) {

                                var form = $("<form class='form-inline'><p>Nama korban : </form>");
                                form.append("<input type=text readonly value="+calEvent.korban+" /><p>Bangunan : </p><input readonly type=text value="+calEvent.title+"><p>Lokasi kejadian : </p><textarea class='span4' disabled>"+calEvent.alamat+
                                    " Ds. "+calEvent.desa+", Kec. "+calEvent.kecamatan+", Kab. Sidoarjo.</textarea></p><a href=../pasca/view?id="+calEvent.id+">Selengkapnya...</a>");
                                //
                                var div = bootbox.dialog(form,
                                    [
                                    {
                                        "label" : "<i class='icon-remove'></i> Close",
                                        "class" : "btn-small"
                                    }
                                    ]
                                    ,
                                    {
                                        // prompts need a few extra options
                                        "onEscape": function(){div.modal("hide");}
                                    }
                                );
                                
                                form.on('submit', function(){
                                    calEvent.title = form.find("input[type=text]").val();
                                    calendar.fullCalendar('updateEvent', calEvent);
                                    div.modal("hide");
                                    return false;
                                });
                                
                            
                                //console.log(calEvent.id);
                                //console.log(jsEvent);
                                //console.log(view);

                                // change the border color just for fun
                                //$(this).css('border-color', 'red');

                            }
                            
                        });
                    })
                </script>
                <?php
            }
        }
    }
    ?> 
</body>
</html>
