<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8" />
		<title>SIM Proteksi Kebakaran Perkotaan</title>

		<meta name="description" content="User login page" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />

		<!--basic styles-->
                
<!--                <script type='text/javascript' src="../assets/js-boot/jquery.js"></script>
                <script type="text/javascript" src="../assets/js-boot/bootstrap-progressbar.js"></script>
                <link rel="stylesheet" type="text/css" href="../assets/css-boot/bootstrap-progressbar.css">
                <link rel="stylesheet" type="text/css" href="../assets/css-boot/bootstrap.css">-->

		<link href="../assets/css-ace/bootstrap.min.css" rel="stylesheet" />
		<link href="../assets/css-ace/bootstrap-responsive.min.css" rel="stylesheet" />
		<link rel="stylesheet" href="../assets/css-ace/font-awesome.min.css" />

<!--		<style type="text/css">
                    .progress .bar.six-sec-ease-in-out {
                        -webkit-transition: width 6s ease-in-out;
                        -moz-transition: width 6s ease-in-out;
                        -ms-transition: width 6s ease-in-out;
                        -o-transition: width 6s ease-in-out;
                        transition: width 6s ease-in-out;
                    }
                    .progress.vertical .bar.six-sec-ease-in-out {
                        -webkit-transition: height 6s ease-in-out;
                        -moz-transition: height 6s ease-in-out;
                        -ms-transition: height 6s ease-in-out;
                        -o-transition: height 6s ease-in-out;
                        transition: height 6s ease-in-out;
                    }
                    .progress.wide {
                        width: 60px;
                    }
                    .vertical-progressbar-span {
                        height: 100px;
                    }
                </style>-->

<!--                <script>
                    $(document).ready(function() {


                            $('.progress .bar.text-filled-1').progressbar({
                                display_text: 1,
                                refresh_speed: 200,
                               transition_delay: 500,

                        });

                        });

                </script>-->

		<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Open+Sans:400,300" />

		<!--ace styles-->

		<link rel="stylesheet" href="../assets/css-ace/ace.min.css" />
		<link rel="stylesheet" href="../assets/css-ace/ace-responsive.min.css" />
		<link rel="stylesheet" href="../assets/css-ace/ace-skins.min.css" />
                <link rel="shortcut icon" href="../assets/img/favicon.ico">
		<!--[if lte IE 8]>
		  <link rel="stylesheet" href="assets/css/ace-ie.min.css" />
		<![endif]-->

		<!--inline styles related to this page-->
                
                <meta http-equiv="Content-Type" content="text/html; charset=utf-8" /></head>

	<body class="login-layout">
		<div class="main-container container-fluid">
			<div class="main-content">
				<div class="row-fluid">
					<div class="span12">
						<div class="login-container">
							<div class="row">
								<div class="center">
									<h3>
										<i class="icon-fire-extinguisher red"></i>
										<span class="white">SIM Proteksi Kebakaran Perkotaan</span>
									</h3>
									<h4 class="blue">&copy; Instansi Pemadam Kebakaran</h4>
								</div>
							</div>

							<div class="space-6"></div>

							<div class="row-fluid">
								<div class="position-relative">
									<div id="login-box" class="login-box visible widget-box no-border">
										<div class="widget-body">
											<div class="widget-main">
												<h4 class="header blue lighter bigger">
													<i class="icon-coffee green"></i>
													Silahkan Login
												</h4>

												<div class="space-6"></div>

												<form method="post" action="cekLogin.php">
													<fieldset>
														<label>
															<span class="block input-icon input-icon-right">
																<input type="text" class="span12" placeholder="Nomor Induk Pegawai" name="nip" required oninvalid="this.setCustomValidity('Enter NIP Here')" oninput="setCustomValidity('')" />
																<i class="icon-user"></i>
															</span>
														</label>

														<label>
															<span class="block input-icon input-icon-right">
																<input type="password" class="span12" placeholder="Password" name="pass" required oninvalid="this.setCustomValidity('Enter Password Here')" oninput="setCustomValidity('')" />
																<i class="icon-lock"></i>
															</span>
														</label>

														<div class="space"></div>

														<div class="clearfix">
<!--															<label class="inline">
																<input type="checkbox" name="setcookie" value="true" id="setcookie" />
																<span class="lbl"> Remember Me</span>
															</label>-->

															<button class="width-35 pull-right btn btn-small btn-primary" name="submit">
																<i class="icon-key"></i>
																Login
															</button>
														</div>
                                                                                                                
                                                                                                                <div class="space"></div>
                                                                                                                
                                                                                                                <!-- Progress bar holder
                                                                                                                <div id="prog" class="progress progress-info progress-striped"></div>
                                                                                                                <!-- Progress information 
                                                                                                                <div id="information" style="width"></div> -->
                                                                                                                
<!--                                                                                                                <div id="prog" class="progress progress-info progress-striped">
                                                                                                                    <div class="bar text-filled-1" data-amount-part="1337" data-amount-total="9000" data-percentage="100"></div>
                                                                                                                </div>-->
                                                                                                                
														<div class="space-4"></div>
													</fieldset>
												</form>

											</div><!--/widget-main-->

											<div class="toolbar clearfix">
												<div>
													<a href="#" onclick="show_box('forgot-box'); return false;" class="forgot-password-link">
														<i class="icon-arrow-left"></i>
														Lupa password ?
													</a>
												</div>
											</div>
										</div><!--/widget-body-->
									</div><!--/login-box-->

									<div id="forgot-box" class="forgot-box widget-box no-border">
										<div class="widget-body">
											<div class="widget-main">
												<h4 class="header red lighter bigger">
													<i class="icon-key"></i>
													Memulihkan Password
												</h4>

												<div class="space-6"></div>
												<p>
													Masukkan NIP Anda &amp; ikuti petunjuk selanjutnya
												</p>

												<form />
													<fieldset>
														<label>
															<span class="block input-icon input-icon-right">
																<input type="text" name="nip" class="span12" placeholder="Nomor Induk Pegawai" />
																<i class="icon-user"></i>
															</span>
														</label>

														<div class="clearfix">
															<button onclick="return false;" class="width-35 pull-right btn btn-small btn-danger">
																<i class="icon-lightbulb"></i>
																Next
															</button>
														</div>
													</fieldset>
												</form>
											</div><!--/widget-main-->

											<div class="toolbar center">
												<a href="#" onclick="show_box('login-box'); return false;" class="back-to-login-link">
                                                                                                    <i class="icon-arrow-left"></i>
                                                                                                    Kembali ke login
												</a>
											</div>
										</div><!--/widget-body-->
									</div><!--/forgot-box-->
								</div><!--/position-relative-->
							</div>
						</div>
					</div><!--/.span-->
				</div><!--/.row-fluid-->
			</div> 
		</div><!--/.main-container-->

		<!--basic scripts-->

		<!--[if !IE]>-->

		<script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>

		<!--<![endif]-->

		<!--[if IE]>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<![endif]-->

		<!--[if !IE]>-->

		<script type="text/javascript">
			window.jQuery || document.write("<script src='../assets/js-ace/jquery-2.0.3.min.js'>"+"<"+"/script>");
		</script>

		<!--<![endif]-->

		<!--[if IE]>
<script type="text/javascript">
 window.jQuery || document.write("<script src='assets/js/jquery-1.10.2.min.js'>"+"<"+"/script>");
</script>
<![endif]-->

		<script type="text/javascript">
			if("ontouchend" in document) document.write("<script src='../assets/js-ace/jquery.mobile.custom.min.js'>"+"<"+"/script>");
		</script>
		<script src="../assets/js-ace/bootstrap.min.js"></script>

		<!--page specific plugin scripts-->

		<!--ace scripts-->

		<script src="../assets/js-ace/ace-elements.min.js"></script>
		<script src="../assets/js-ace/ace.min.js"></script>

		<!--inline scripts related to this page-->

		<script type="text/javascript">
			function show_box(id) {
			 $('.widget-box.visible').removeClass('visible');
			 $('#'+id).addClass('visible');
			}
		</script>
<!--                <script type="text/javascript">
                        $(document).ready(function()
                                {
                                 var delay = 2000;
                                setTimeout(function(){ window.location = '../index';}, delay);  
                    });
                 </script>-->
	</body>
</html>