<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8" />
		<title>SIM Proteksi Kebakaran Perkotaan</title>

		<meta name="description" content="overview &amp; stats" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />

		<!--basic styles-->

		<link href="../assets/css-ace/bootstrap.min.css" rel="stylesheet" />
		<link href="../assets/css-ace/bootstrap-responsive.min.css" rel="stylesheet" />
		<link rel="stylesheet" href="../assets/css-ace/font-awesome.min.css" />
                <style type="text/css">
                .form-signin {
                        max-width: 768px;
                        padding: 19px 29px 29px;
                        margin: 2px auto 20px;
                        /*background-color: #fff;
                        border: 1px solid #e5e5e5;*/
                        -webkit-border-radius: 5px;
                           -moz-border-radius: 5px;
                                border-radius: 5px;
                        -webkit-box-shadow: 0 1px 2px rgba(0,0,0,.05);
                           -moz-box-shadow: 0 1px 2px rgba(0,0,0,.05);
                                box-shadow: 0 1px 2px rgba(0,0,0,.05);
                      }
                </style>
                
                <link rel="shortcut icon" href="../assets/img/favicon.ico">

		<!--fonts-->

		<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Open+Sans:400,300" />

		<!--ace styles-->

		<link rel="stylesheet" href="../assets/css-ace/ace.min.css" />
		<link rel="stylesheet" href="../assets/css-ace/ace-responsive.min.css" />
		<link rel="stylesheet" href="../assets/css-ace/ace-skins.min.css" />
		<style type="text/css">
		body,td,th {
	font-family: "Open Sans";
}
        </style>

		<!--[if lte IE 8]>
		  <link rel="stylesheet" href="assets/css/ace-ie.min.css" />
		<![endif]-->

		<!--inline styles related to this page-->
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /></head>

        <?php
            session_start();
            include ("../login/koneksi.php");
            if ($_SESSION['pegawai_nip'] && $_SESSION['pegawai_password']){
                $sql = mysql_query("SELECT * FROM pegawai WHERE pegawai_nip='".$_SESSION['pegawai_nip']."' AND pegawai_password='".$_SESSION['pegawai_password']."'");
                if($sql){
                    $hasil = mysql_fetch_assoc($sql);
        ?>

<div class="navbar">
    <div class="navbar-inner">
        <div class="container-fluid">
            <a href="../index.php" class="brand">
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
                                            <img class="nav-user-photo" src="assets/avatars/user.jpg" alt="<?php echo $hasil['pegawai_nama'];?>" />
                                            <span class="user-info">
                                                    <small>Welcome,</small>
                                                           <?php echo $hasil['pegawai_nama'];}   ?>    
                                            </span>

                                            <i class="icon-caret-down"></i>
                                    </a>

                                    <ul class="user-menu pull-right dropdown-menu dropdown-yellow dropdown-caret dropdown-closer">
                                            

                                            <li>
                                                    <a href="#">
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
                            <a href="../index.php">
                                    <i class="icon-dashboard"></i>
                                    <span class="menu-text"> Dashboard </span>
                            </a>
                    </li>


                    <li>
                            <a href="#" class="dropdown-toggle">
                                    <i class="icon-edit"></i>
                                    <span class="menu-text"> Analisis Resiko </span>

                                    <b class="arrow icon-angle-down"></b>
                            </a>

                            <ul class="submenu">
                                    <li>
                                            <a href="#">
                                                    <i class="icon-double-angle-right"></i>
                                                    Analisa Resiko Kebakaran
                                            </a>
                                    </li>

                                    <li>
                                            <a href="form-wizard.html">
                                                    <i class="icon-double-angle-right"></i>
                                                    Wizard &amp; Validation
                                            </a>
                                    </li>

                                    <li>
                                            <a href="wysiwyg.html">
                                                    <i class="icon-double-angle-right"></i>
                                                    Wysiwyg &amp; Markdown
                                            </a>
                                    </li>
                            </ul>
                    </li>

                    <li>
                            <a href="widgets.html">
                                    <i class="icon-list-alt"></i>
                                    <span class="menu-text"> Widgets </span>
                            </a>
                    </li>

                    <li>
                            <a href="calendar.html">
                                    <i class="icon-calendar"></i>

                                    <span class="menu-text">
                                            Calendar
                                            <span class="badge badge-transparent tooltip-error" title="2&nbsp;Important&nbsp;Events">
                                                    <i class="icon-warning-sign red bigger-130"></i>
                                            </span>
                                    </span>
                            </a>
                    </li>

                    <li>
                            <a href="gallery.html">
                                    <i class="icon-picture"></i>
                                    <span class="menu-text"> Documents </span>
                            </a>
                    </li>

                    <li>
                            <a href="#" class="dropdown-toggle">
                                    <i class="icon-tag"></i>
                                    <span class="menu-text"> More Pages </span>

                                    <b class="arrow icon-angle-down"></b>
                            </a>

                            <ul class="submenu">
                                    <li>
                                            <a href="profile.html">
                                                    <i class="icon-double-angle-right"></i>
                                                    User Profile
                                            </a>
                                    </li>

                                    <li>
                                            <a href="pricing.html">
                                                    <i class="icon-double-angle-right"></i>
                                                    Pricing Tables
                                            </a>
                                    </li>

                                    <li>
                                            <a href="invoice.html">
                                                    <i class="icon-double-angle-right"></i>
                                                    Invoice
                                            </a>
                                    </li>

                                    <li>
                                            <a href="login.html">
                                                    <i class="icon-double-angle-right"></i>
                                                    Login &amp; Register
                                            </a>
                                    </li>
                            </ul>
                    </li>

                    <li>
                            <a href="#" class="dropdown-toggle">
                                    <i class="icon-file-alt"></i>

                                    <span class="menu-text">
                                            Other Pages
                                            <span class="badge badge-primary ">4</span>
                                    </span>

                                    <b class="arrow icon-angle-down"></b>
                            </a>

                            <ul class="submenu">
                                    <li>
                                            <a href="error-404.html">
                                                    <i class="icon-double-angle-right"></i>
                                                    Error 404
                                            </a>
                                    </li>

                                    <li>
                                            <a href="error-500.html">
                                                    <i class="icon-double-angle-right"></i>
                                                    Error 500
                                            </a>
                                    </li>

                                    <li>
                                            <a href="grid.html">
                                                    <i class="icon-double-angle-right"></i>
                                                    Grid
                                            </a>
                                    </li>

                                    <li>
                                            <a href="blank.html">
                                                    <i class="icon-double-angle-right"></i>
                                                    Blank Page
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
                                    <a href="../index.php">Home</a>

                                    <span class="divider">
                                            <i class="icon-angle-right arrow-icon"></i>
                                    </span>
                            </li>
                            <li>
                                <a href="">Analisis Resiko</a>

				<span class="divider">
                                    <i class="icon-angle-right arrow-icon"></i>
				</span>
                            </li>
                            <li class="active">Analisis Resiko Kebakaran</li>
                    </ul><!--.breadcrumb-->

<!--                    <div class="nav-search" id="nav-search">
                            <form class="form-search" />
                                    <span class="input-icon">
                                            <input type="text" placeholder="Search ..." class="input-small nav-search-input" id="nav-search-input" autocomplete="off" />
                                            <i class="icon-search nav-search-icon"></i>
                                    </span>
                            </form>
                    </div>#nav-search-->
            </div>

            <div class="page-content">
                    <div class="page-header position-relative">
                            <h1>
                                    Analisis Resiko
                                    <small>
                                            <i class="icon-double-angle-right"></i>
                                            Analisis Resiko Kebakaran
                                    </small>
                            </h1>
                    </div><!--/.page-header-->

                    <div class="row-fluid">
                            <div class="span12">
                                <!--<div class="form-signin">-->
                           	  <p align="center"><img src="../assets/img/sda/kec.png" width="828" height="300"></p>
<!--                              <map name="kec">
                                <area shape="poly" coords="32,202,42,204,48,204,51,207,55,209,59,208,60,206,65,210,70,212,72,206,71,200,74,197,80,196,86,196,92,201,101,202,108,202,162,200,173,200,171,205,178,210,185,206,197,206,200,199,206,195,208,183,216,183,218,177,212,174,211,168,211,157,194,157,184,158,181,156,182,150,196,146,195,139,193,138,182,141,117,167,113,170,109,173,103,174,97,172,94,169,90,172,86,169,82,168,76,171,71,173,68,177,62,178,57,178,53,180,51,181,47,181,42,181,42,188,40,190,36,194,33,196,31,200" href="#">
                              </map>-->
                              <!--</div>-->
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

<!--                            <div>
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
                            </div>-->

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
    window.jQuery || document.write("<script src='../assets/js-ace/jquery-2.0.3.min.js'>"+"<"+"/script>");
</script>

<script type="text/javascript">
    if("ontouchend" in document) document.write("<script src='../assets/js-ace/jquery.mobile.custom.min.js'>"+"<"+"/script>");
</script>

<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
<script type="text/javascript" src="../assets/js-map/jquery.maphilight.min.js"></script>
<script type="text/javascript">$(function() {
		$('.map').maphilight();
	});
</script>

<script src="../assets/js-ace/bootstrap.min.js"></script>

<script src="../assets/js-ace/jquery-ui-1.10.3.custom.min.js"></script>
<script src="../assets/js-ace/jquery.ui.touch-punch.min.js"></script>
<script src="../assets/js-ace/jquery.slimscroll.min.js"></script>
<script src="../assets/js-ace/jquery.easy-pie-chart.min.js"></script>
<script src="../assets/js-ace/jquery.sparkline.min.js"></script>
<script src="../assets/js-ace/flot/jquery.flot.min.js"></script>
<script src="../assets/js-ace/flot/jquery.flot.pie.min.js"></script>
<script src="../assets/js-ace/flot/jquery.flot.resize.min.js"></script>

<script src="../assets/js-ace/ace-elements.min.js"></script>
<script src="../assets/js-ace/ace.min.js"></script>

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
<?php
                }else{
        header("location:../login/login");
    }
?>  
	</body>
</html>