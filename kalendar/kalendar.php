<?php
include '../template/header.php';
session_start();
include ("../login/koneksi.php");
if ($_SESSION['pegawai_nip'] && $_SESSION['pegawai_password']) {
    $sql = mysql_query("SELECT * FROM pegawai WHERE pegawai_nip='" . $_SESSION['pegawai_nip'] . "' AND pegawai_password='" . $_SESSION['pegawai_password'] . "'");
    if ($sql) {
        $hasil = mysql_fetch_assoc($sql);
        ?>
        <body>
            <div class="navbar">
                <div class="navbar-inner">
                    <div class="container-fluid">
                        <a href="../beranda/index.php" class="brand">
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
        <script src="../assets/js-ace/fullcalendar.min.js"></script>
        <script src="../assets/js-ace/bootbox.min.js"></script>

        <!--ace scripts-->

        <script src="../assets/js-ace/ace-elements.min.js"></script>
        <script src="../assets/js-ace/ace.min.js"></script>

        <!--inline scripts related to this page-->

        <script type="text/javascript">
            $(function() {

                /* initialize the external events
                 -----------------------------------------------------------------*/

                $('#external-events div.external-event').each(function() {

                    // create an Event Object (http://arshaw.com/fullcalendar/docs/event_data/Event_Object/)
                    // it doesn't need to have a start or end
                    var eventObject = {
                        title: $.trim($(this).text()) // use the element's text as the event title
                    };

                    // store the Event Object in the DOM element so we can get to it later
                    $(this).data('eventObject', eventObject);

                    // make the event draggable using jQuery UI
                    $(this).draggable({
                        zIndex: 999,
                        revert: true, // will cause the event to go back to its
                        revertDuration: 0  //  original position after the drag
                    });

                });




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
                    events: [
                        {
                            title: 'All Day Event',
                            start: new Date(y, m, 1),
                            className: 'label-important'
                        },
                        {
                            title: 'Long Event',
                            start: new Date(y, m, d - 5),
                            end: new Date(y, m, d - 2),
                            className: 'label-success'
                        },
                        {
                            title: 'Some Event',
                            start: new Date(y, m, d - 3, 16, 0),
                            allDay: false
                        }]
                            ,
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
                        if ($extraEventClass)
                            copiedEventObject['className'] = [$extraEventClass];

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
                    selectable: true,
                    selectHelper: true,
                    select: function(start, end, allDay) {

                        bootbox.prompt("New Event Title:", function(title) {
                            if (title !== null) {
                                calendar.fullCalendar('renderEvent',
                                        {
                                            title: title,
                                            start: start,
                                            end: end,
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

                        var form = $("<form class='form-inline'><label>Change event name &nbsp;</label></form>");
                        form.append("<input autocomplete=off type=text value='" + calEvent.title + "' /> ");
                        form.append("<button type='submit' class='btn btn-small btn-success'><i class='icon-ok'></i> Save</button>");

                        var div = bootbox.dialog(form,
                                [
                                    {
                                        "label": "<i class='icon-trash'></i> Delete Event",
                                        "class": "btn-small btn-danger",
                                        "callback": function() {
                                            calendar.fullCalendar('removeEvents', function(ev) {
                                                return (ev._id == calEvent._id);
                                            })
                                        }
                                    }
                                    ,
                                    {
                                        "label": "<i class='icon-remove'></i> Close",
                                        "class": "btn-small"
                                    }
                                ]
                                ,
                                {
                                    // prompts need a few extra options
                                    "onEscape": function() {
                                        div.modal("hide");
                                    }
                                }
                        );

                        form.on('submit', function() {
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
    } else {
        header("location:../login/login");
    }
    ?> 
</body>
</html>
