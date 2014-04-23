<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8" />
		<title>SIM Proteksi Kebakaran Perkotaan</title>

		<meta name="description" content="overview &amp; stats" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />

		<!--basic styles-->

		<link href="assets/css-ace/bootstrap.min.css" rel="stylesheet" />
		<link href="assets/css-ace/bootstrap-responsive.min.css" rel="stylesheet" />
		<link rel="stylesheet" href="assets/css-ace/font-awesome.min.css" />
                
                <link rel="shortcut icon" href="assets/img/favicon.ico">

		<!--fonts-->

		<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Open+Sans:400,300" />

		<!--ace styles-->

		<link rel="stylesheet" href="assets/css-ace/ace.min.css" />
		<link rel="stylesheet" href="assets/css-ace/ace-responsive.min.css" />
		<link rel="stylesheet" href="assets/css-ace/ace-skins.min.css" />
		<style type="text/css">
		body,td,th {
                    font-family: "Open Sans";
                }
                </style>

		<!--inline styles related to this page-->
                <meta http-equiv="Content-Type" content="text/html; charset=utf-8" /></head>

        <?php
            session_start();
            include ("login/koneksi.php");
            if ($_SESSION['pegawai_nip'] && $_SESSION['pegawai_password']){
                $sql = mysql_query("SELECT * FROM pegawai WHERE pegawai_nip='".$_SESSION['pegawai_nip']."' AND pegawai_password='".$_SESSION['pegawai_password']."'");
                if($sql){
                    $hasil = mysql_fetch_assoc($sql);
        ?>
        
	<body onload="setInterval('displayServerTime()', 1000);">
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
                                            <img class="nav-user-photo" src="assets/img/a.jpg" alt="<?php echo $hasil['pegawai_nama'];?>" />
                                            <span class="user-info">
                                                    <small>Welcome,</small>
                <?php echo $hasil['pegawai_nama'];  } ?>    
                                            </span>

                                            <i class="icon-caret-down"></i>
                                    </a>

                                    <ul class="user-menu pull-right dropdown-menu dropdown-yellow dropdown-caret dropdown-closer">
                                            
                                            <li>
                                                    <a href="anggota/profile">
                                                            <i class="icon-user"></i>
                                                            Profile
                                                    </a>
                                            </li>
                                            
                                            <li class="divider"></li>

                                            <li>
                                                    <a href="login/logout">
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

    <div class="sidebar" id="sidebar">
            <div class="sidebar-shortcuts" id="sidebar-shortcuts">

                    <div class="sidebar-shortcuts-mini" id="sidebar-shortcuts-mini">
                            <span class="btn btn-success"></span>

                            <span class="btn btn-info"></span>

                            <span class="btn btn-warning"></span>

                            <span class="btn btn-danger"></span>
                    </div>
            </div><!--#sidebar-shortcuts-->

            <ul class="nav nav-list">
                    <li class="active">
                            <a href="index">
                                    <i class="icon-dashboard"></i>
                                    <span class="menu-text"> Dashboard </span>
                            </a>
                    </li>


                    <li>
                            <a href="resiko/analisis" class="dropdown-toggle">
                                    <i class="icon-edit"></i>
                                    <span class="menu-text"> Analisis Resiko </span>

                                    <b class="arrow icon-angle-down"></b>
                            </a>

                            <ul class="submenu">
                                
                                <li>
                                    <a href="resiko/peta">
                                        <i class="icon-double-angle-right"></i>
                                        Peta Kab. Sidoarjo
                                    </a>
                                </li>
                                
                                <li>
                                    <a href="resiko/analisis">
                                        <i class="icon-double-angle-right"></i>
                                        Analisis Resiko Kebakaran
                                    </a>
                                </li>
                                    
                                <li>
                                    <a href="resiko/bangunan">
                                        <i class="icon-double-angle-right"></i>
                                        Daftar Bangunan
                                    </a>
                                </li>
                            </ul>
                    </li>
                    
                    <li>
                        <a href="pasca/pasca" class="dropdown-toggle">
                                <i class="icon-desktop"></i>
                                <span class="menu-text"> Pasca Kebakaran </span>
                        </a>
                    </li>

                       
                    
                    <li>
                        <a href="anggota/list">
                            <i class="icon-group"></i>
                            <span class="menu-text"> Anggota Pemadam </span>
                        </a>
                    </li>

                    <li>
                            <a href="kalendar">
                                    <i class="icon-calendar"></i>

                                    <span class="menu-text">
                                            Kalendar
                                            <span class="badge badge-transparent tooltip-error" title="2&nbsp;Important&nbsp;Events">
                                                    <i class="icon-info-sign red bigger-130"></i>
                                            </span>
                                    </span>
                            </a>
                    </li>

                    <li>
                            <a href="gallery">
                                    <i class="icon-picture"></i>
                                    <span class="menu-text"> Gallery </span>
                            </a>
                    </li>

                    <li>
                            <a href="#" class="dropdown-toggle">
                                    <i class="icon-file-alt"></i>

                                    <span class="menu-text">
                                            Laporan Kejadian
                                    </span>

                                    <b class="arrow icon-angle-down"></b>
                            </a>

                           <ul class="submenu">
                                    <li>
                                            <a href="gallery">
                                                    <i class="icon-double-angle-right"></i>
                                                    Manajemen Proteksi Kebakaran Kota
                                            </a>
                                    </li>

                                    <li>
                                            <a href="gallery">
                                                    <i class="icon-double-angle-right"></i>
                                                    Manajemen Proteksi Kebakaran Lingkungan
                                            </a>
                                    </li>

                                    <li>
                                            <a href="gallery">
                                                    <i class="icon-double-angle-right"></i>
                                                    Manajemen Proteksi Kebakaran Bangunan Gedung
                                            </a>
                                    </li>
                            </ul>
                    </li>
            </ul><!--/.nav-list-->

            <div class="sidebar-collapse" id="sidebar-collapse">
                    <i class="icon-double-angle-left"></i>
            </div>
    </div>

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
                            <li class="active">Gallery</li>
                    </ul><!--.breadcrumb-->
            </div>

            <div class="page-content">
                    <div class="page-header position-relative">
                            <h1>
                                    Gallery
                                    <small>
                                            <i class="icon-double-angle-right"></i>
                                            Overview
                                    </small>
                            </h1>
                    </div><!--/.page-header-->

                    <div class="row-fluid">
                            <div class="span12">
                                <!--PAGE CONTENT BEGINS-->
                                
                                <div class="error-container">
        <div class="well">
                <h1 class="grey lighter smaller">
                        <span class="blue bigger-125">
                                <i class="icon-sitemap"></i>
                                404
                        </span>
                        Page Not Found
                </h1>

                <hr />
                <h3 class="lighter smaller">We looked everywhere but we couldn't find it!</h3>

                <div>
                        <form class="form-search" />
                                <span class="input-icon">
                                        <i class="icon-search"></i>

                                        <input type="text" class="input-medium search-query" placeholder="Give it a search..." />
                                </span>
                                <button class="btn btn-small" onclick="return false;">Go!</button>
                        </form>

                        <div class="space"></div>
                        <h4 class="smaller">Try one of the following:</h4>

                        <ul class="unstyled spaced inline bigger-110">
                                <li>
                                        <i class="icon-hand-right blue"></i>
                                        Re-check the url for typos
                                </li>

                                <li>
                                        <i class="icon-hand-right blue"></i>
                                        Read the faq
                                </li>

                                <li>
                                        <i class="icon-hand-right blue"></i>
                                        Tell us about it
                                </li>
                        </ul>
                </div>

                <hr />
                <div class="space"></div>

                <div class="row-fluid">
                        <div class="center">
                                <a href="javascript:history.back()" class="btn btn-grey">
                                        <i class="icon-arrow-left"></i>
                                        Go Back
                                </a>

                                <a href="index" class="btn btn-primary">
                                        <i class="icon-dashboard"></i>
                                        Dashboard
                                </a>
                        </div>
                </div>
        </div>
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

<script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>

<script type="text/javascript">
    window.jQuery || document.write("<script src='assets/js-ace/jquery-2.0.3.min.js'>"+"<"+"/script>");
</script>

<script type="text/javascript">
    if("ontouchend" in document) document.write("<script src='assets/js-ace/jquery.mobile.custom.min.js'>"+"<"+"/script>");
</script>

<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
<script type="text/javascript" src="assets/js-map/jquery.maphilight.min.js"></script>
<script type="text/javascript">$(function() {
		$('.map').maphilight();
	});
</script>

<script src="assets/js-ace/bootstrap.min.js"></script>

<script src="assets/js-ace/jquery-ui-1.10.3.custom.min.js"></script>
<script src="assets/js-ace/jquery.ui.touch-punch.min.js"></script>
<script src="assets/js-ace/jquery.slimscroll.min.js"></script>
<script src="assets/js-ace/jquery.easy-pie-chart.min.js"></script>
<script src="assets/js-ace/jquery.sparkline.min.js"></script>
<script src="assets/js-ace/flot/jquery.flot.min.js"></script>
<script src="assets/js-ace/flot/jquery.flot.pie.min.js"></script>
<script src="assets/js-ace/flot/jquery.flot.resize.min.js"></script>

<script src="assets/js-ace/ace-elements.min.js"></script>
<script src="assets/js-ace/ace.min.js"></script>

<script type="text/javascript">
    $(function() {
				$('.easy-pie-chart.percentage').each(function(){
					var $box = $(this).closest('.infobox');
					var barColor = $(this).data('color') || (!$box.hasClass('infobox-dark') ? $box.css('color') : 'rgba(255,255,255,0.95)');
					var trackColor = barColor == 'rgba(255,255,255,0.95)' ? 'rgba(255,255,255,0.25)' : '#E2E2E2';
					var size = parseInt($(this).data('size')) || 50;
					$(this).easyPieChart({
						barColor: barColor,
						trackColor: trackColor,
						scaleColor: false,
						lineCap: 'butt',
						lineWidth: parseInt(size/10),
						animate: /msie\s*(8|7|6)/.test(navigator.userAgent.toLowerCase()) ? false : 1000,
						size: size
					});
				})
			
				$('.sparkline').each(function(){
					var $box = $(this).closest('.infobox');
					var barColor = !$box.hasClass('infobox-dark') ? $box.css('color') : '#FFF';
					$(this).sparkline('html', {tagValuesAttribute:'data-values', type: 'bar', barColor: barColor , chartRangeMin:$(this).data('min') || 0} );
				});
			
			
			
			
			  var placeholder = $('#piechart-placeholder').css({'width':'90%' , 'min-height':'150px'});
			  var data = [
				{ label: "social networks",  data: 38.7, color: "#68BC31"},
				{ label: "search engines",  data: 24.5, color: "#2091CF"},
				{ label: "ad campaings",  data: 8.2, color: "#AF4E96"},
				{ label: "direct traffic",  data: 18.6, color: "#DA5430"},
				{ label: "other",  data: 10, color: "#FEE074"}
			  ]
			  function drawPieChart(placeholder, data, position) {
			 	  $.plot(placeholder, data, {
					series: {
						pie: {
							show: true,
							tilt:0.8,
							highlight: {
								opacity: 0.25
							},
							stroke: {
								color: '#fff',
								width: 2
							},
							startAngle: 2
						}
					},
					legend: {
						show: true,
						position: position || "ne", 
						labelBoxBorderColor: null,
						margin:[-30,15]
					}
					,
					grid: {
						hoverable: true,
						clickable: true
					}
				 })
			 }
			 drawPieChart(placeholder, data);
			
			 /**
			 we saved the drawing function and the data to redraw with different position later when switching to RTL mode dynamically
			 so that's not needed actually.
			 */
			 placeholder.data('chart', data);
			 placeholder.data('draw', drawPieChart);
			
			
			
			  var $tooltip = $("<div class='tooltip top in hide'><div class='tooltip-inner'></div></div>").appendTo('body');
			  var previousPoint = null;
			
			  placeholder.on('plothover', function (event, pos, item) {
				if(item) {
					if (previousPoint != item.seriesIndex) {
						previousPoint = item.seriesIndex;
						var tip = item.series['label'] + " : " + item.series['percent']+'%';
						$tooltip.show().children(0).text(tip);
					}
					$tooltip.css({top:pos.pageY + 10, left:pos.pageX + 10});
				} else {
					$tooltip.hide();
					previousPoint = null;
				}
				
			 });
			
			
			
			
			
			
				var d1 = [];
				for (var i = 0; i < Math.PI * 2; i += 0.5) {
					d1.push([i, Math.sin(i)]);
				}
			
				var d2 = [];
				for (var i = 0; i < Math.PI * 2; i += 0.5) {
					d2.push([i, Math.cos(i)]);
				}
			
				var d3 = [];
				for (var i = 0; i < Math.PI * 2; i += 0.2) {
					d3.push([i, Math.tan(i)]);
				}
				
			
				var sales_charts = $('#sales-charts').css({'width':'100%' , 'height':'220px'});
				$.plot("#sales-charts", [
					{ label: "Domains", data: d1 },
					{ label: "Hosting", data: d2 },
					{ label: "Services", data: d3 }
				], {
					hoverable: true,
					shadowSize: 0,
					series: {
						lines: { show: true },
						points: { show: true }
					},
					xaxis: {
						tickLength: 0
					},
					yaxis: {
						ticks: 10,
						min: -2,
						max: 2,
						tickDecimals: 3
					},
					grid: {
						backgroundColor: { colors: [ "#fff", "#fff" ] },
						borderWidth: 1,
						borderColor:'#555'
					}
				});
			
			
				$('#recent-box [data-rel="tooltip"]').tooltip({placement: tooltip_placement});
				function tooltip_placement(context, source) {
					var $source = $(source);
					var $parent = $source.closest('.tab-content')
					var off1 = $parent.offset();
					var w1 = $parent.width();
			
					var off2 = $source.offset();
					var w2 = $source.width();
			
					if( parseInt(off2.left) < parseInt(off1.left) + parseInt(w1 / 2) ) return 'right';
					return 'left';
				}
			
			
				$('.dialogs,.comments').slimScroll({
					height: '300px'
			    });
				
				
				//Android's default browser somehow is confused when tapping on label which will lead to dragging the task
				//so disable dragging when clicking on label
				var agent = navigator.userAgent.toLowerCase();
				if("ontouchstart" in document && /applewebkit/.test(agent) && /android/.test(agent))
				  $('#tasks').on('touchstart', function(e){
					var li = $(e.target).closest('#tasks li');
					if(li.length == 0)return;
					var label = li.find('label.inline').get(0);
					if(label == e.target || $.contains(label, e.target)) e.stopImmediatePropagation() ;
				});
			
				$('#tasks').sortable({
					opacity:0.8,
					revert:true,
					forceHelperSize:true,
					placeholder: 'draggable-placeholder',
					forcePlaceholderSize:true,
					tolerance:'pointer',
					stop: function( event, ui ) {//just for Chrome!!!! so that dropdowns on items don't appear below other items after being moved
						$(ui.item).css('z-index', 'auto');
					}
					}
				);
				$('#tasks').disableSelection();
				$('#tasks input:checkbox').removeAttr('checked').on('click', function(){
					if(this.checked) $(this).closest('li').addClass('selected');
					else $(this).closest('li').removeClass('selected');
				});
				
			
			})
		</script>
                
                <script type="text/javascript">
                    //set timezone
                    <?php date_default_timezone_set('Asia/Jakarta'); ?>
                    //buat object date berdasarkan waktu di server
                    var serverTime = new Date(<?php print date('Y, m, d, H, i, s, 0'); ?>);
                    //buat object date berdasarkan waktu di client
                    var clientTime = new Date();
                    //hitung selisih
                    var Diff = serverTime.getTime() - clientTime.getTime();    
                    //fungsi displayTime yang dipanggil di bodyOnLoad dieksekusi tiap 1000ms = 1detik
                    function displayServerTime(){
                        //buat object date berdasarkan waktu di client
                        var clientTime = new Date();
                        //buat object date dengan menghitung selisih waktu client dan server
                        var time = new Date(clientTime.getTime() + Diff);
                        //ambil nilai jam
                        var sh = time.getHours().toString();
                        //ambil nilai menit
                        var sm = time.getMinutes().toString();
                        //ambil nilai detik
                        var ss = time.getSeconds().toString();
                        //tampilkan jam:menit:detik dengan menambahkan angka 0 jika angkanya cuma satu digit (0-9)
                        document.getElementById("clock").innerHTML = (sh.length==1?"0"+sh:sh) + ":" + (sm.length==1?"0"+sm:sm) + ":" + (ss.length==1?"0"+ss:ss);
                    }
                </script>
                <script>
                    function goBack()
                      {
                      window.history.back()
                      }
                </script>
<?php
                }else{
        header("location:login/login");
    }
?>
	</body>
</html>