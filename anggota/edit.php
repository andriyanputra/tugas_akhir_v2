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
    $query = mysql_query("SELECT * FROM pegawai,jabatan
                          WHERE jabatan.jabatan_id = pegawai.jabatan_id
                          ORDER BY pegawai_nip") or die("Query failed: " . mysql_error());
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
                                    <img class="nav-user-photo" src="../assets/img/img-anggota/<?= $row['pegawai_foto']; ?>" alt="<?php echo $hasil['pegawai_nama']; ?>" />
                                    <span class="user-info">
                                        <small>Welcome,</small>
                                        <?php echo $row['pegawai_nama']; ?>    
                                    </span>

                                    <i class="icon-caret-down"></i>
                                </a>

                                <ul class="user-menu pull-right dropdown-menu dropdown-yellow dropdown-caret dropdown-closer">

                                    <li>
                                        <a href="profile?nip=<?= $row['pegawai_nip']; ?>">
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
                                <a href="../beranda/index">Home</a>

                                <span class="divider">
                                    <i class="icon-angle-right arrow-icon"></i>
                                </span>
                            </li>
                            <li>
                                <a href="list">Anggota Pemadam</a>

                                <span class="divider">
                                    <i class="icon-angle-right arrow-icon"></i>
                                </span>
                            </li>
                            <li class="active">Edit Data</li>
                        </ul><!--.breadcrumb-->
                    </div>

                    <div class="page-content">
                        <div class="page-header position-relative">
                            <h1>
                                Anggota Pemadam
                                <small>
                                    <i class="icon-double-angle-right"></i>
                                    Edit Data
                                </small>
                            </h1>
                        </div><!--/.page-header-->

                        <div class="row-fluid">
                            <div class="span12">
                                <!--PAGE CONTENT BEGINS-->

                                <div class="widget-box">
                                    <div class="widget-header widget-header-blue widget-header-flat">
                                        <h4 class="lighter">Form Anggota Pemadam Kebakaran</h4>
                                    </div>

                                    <div class="widget-body">
                                        <div class="widget-main">
                                            <div class="row-fluid">
                                                <form class="form-horizontal" id="validation-form" method="post" action="prosesEdit.php" enctype="multipart/form-data">
                                                    <div id="user-profile-3" class="user-profile">
                                                        <h3 class="lighter block green">Mohon untuk mengisi form berikut</h3>

                                                        <?php
                                                        $q = mysql_query("SELECT pegawai_nip, pegawai_nama, pegawai_tempat, pegawai_tanggal, pegawai_kelamin, pegawai_alamat, pegawai_no_telp,jabatan_nama, pegawai_email, pegawai_foto  
                                                                          FROM pegawai,jabatan
                                                                          WHERE jabatan.jabatan_id = pegawai.jabatan_id AND pegawai_nip = '" . $_GET['nip'] . "'");
                                                        $d = mysql_fetch_assoc($q);
                                                        ?>

                                                        <div class="row-fluid">

                                                            <div class="span4">
                                                                <input type="file" name="foto" required/>
                                                            </div>

                                                            <div class="vspace"></div>

                                                            <div class="span8">
                                                                <div class="control-group">
                                                                    <label class="control-label" for="nomor">Nomor Induk:</label>

                                                                    <div class="controls">
                                                                        <input type="text" name="nomor" id="nomor" placeholder="Nomor Induk Pegawai" value="<?= $d['pegawai_nip']; ?>"/>
                                                                    </div>
                                                                </div>

                                                                <div class="control-group">
                                                                    <label class="control-label" for="nama">Nama:</label>

                                                                    <div class="controls">
                                                                        <input class="span8" type="text" name="nama" id="nama" placeholder="Nama Lengkap" value="<?= $d['pegawai_nama']; ?>" />
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class='space-6'></div>

                                                        <div class="control-group">
                                                            <label class="control-label">Jenis Kelamin:</label>

                                                            <div class="controls">
                                                                <label class="inline">
                                                                    <input name="gender" value="Laki-laki" type="radio" />
                                                                    <span class="lbl"> Laki-laki</span>
                                                                </label>

                                                                <label class="inline">
                                                                    <input name="gender" value="Perempuan" type="radio" />
                                                                    <span class="lbl"> Perempuan</span>
                                                                </label>
                                                            </div>
                                                        </div>

                                                        <div class="control-group">
                                                            <label class="control-label" for="tempat">Tempat Lahir:</label>

                                                            <div class="controls">
                                                                <input type="text" name="tempat" id="tempat" placeholder="Tempat Lahir" value="<?= $d['pegawai_tempat']; ?>" />
                                                            </div>
                                                        </div>

                                                        <div class="control-group">
                                                            <label class="control-label" for="tanggal">Tanggal Lahir:</label>

                                                            <div class="controls">
                                                                <div class="input-prepend">
                                                                    <span class="add-on">
                                                                        <i class="icon-calendar"></i>
                                                                    </span>
                                                                    <?php $ttl = date("d-m-Y", strtotime($d['pegawai_tanggal'])); ?>
                                                                    <input class="input-small date-picker" name="tanggal" id="tanggal" type="text" data-date-format="dd-mm-yyyy" placeholder="dd-mm-yyyy" value="<?= $ttl; ?>" />
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="control-group">
                                                            <label class="control-label" for="alamat">Alamat:</label>

                                                            <div class="controls">
                                                                <textarea class="span6" id="alamat" name="alamat"><?= $d['pegawai_alamat']; ?></textarea>
                                                            </div>
                                                        </div>

                                                        <div class="space"></div>

                                                        <h4 class="header blue bolder smaller">Password</h4>

                                                        <div class="control-group">
                                                            <label class="control-label" for="password">Password:</label>

                                                            <div class="controls">
                                                                <div class="span12">
                                                                    <input type="password" name="password" id="password" class="span4" />
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="control-group">
                                                            <label class="control-label" for="password2">Confirm Password:</label>

                                                            <div class="controls">
                                                                <div class="span12">
                                                                    <input type="password" name="password2" id="password2" class="span4" />
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="space"></div>

                                                        <h4 class="header blue bolder smaller">Kontak</h4>

                                                        <div class="control-group">
                                                            <label class="control-label" for="email">Email:</label>

                                                            <div class="controls">
                                                                <div class="span4 input-prepend">
                                                                    <span class="add-on">
                                                                        <i class="icon-envelope"></i>
                                                                    </span>
                                                                    <input class="span12" type="email" name="email" id="email" class="span6" value="<?= $d['pegawai_email']; ?>"/>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="control-group">
                                                            <label class="control-label" for="phone">No. Handphone:</label>

                                                            <div class="controls">
                                                                <div class="span3 input-prepend">
                                                                    <span class="add-on">
                                                                        <i class="icon-phone"></i>
                                                                    </span>
                                                                    <input class="span12" type="tel" id="phone" name="phone" value="<?= $d['pegawai_no_telp']; ?>"/>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="space"></div>

                                                        <h4 class="header blue bolder smaller">Level User</h4>

                                                        <div class="control-group">
                                                            <label class="control-label" for="state">Jabatan:</label>

                                                            <div class="controls">
                                                                <span class="span10">
                                                                    <select id="jabatan" name="jabatan">
                                                                        <option value="" />------------------------------------
                                                                        <?php
                                                                        $qry = "SELECT * FROM jabatan";
                                                                        $hasil = mysql_query($qry);
                                                                        while ($data = mysql_fetch_array($hasil)) {
                                                                            echo "<option value='" . $data['jabatan_id'] . "'>" . $data['jabatan_nama'] . "</option>";
                                                                        }
                                                                        ?>
                                                                    </select>
                                                                </span>
                                                            </div>
                                                        </div>

                                                        <div class="control-group">
                                                            <label class="control-label">Level:</label>

                                                            <div class="controls">
                                                                <label>
                                                                    <input name="level" value="1" type="radio" />
                                                                    <span class="lbl"> Admin (Staff Administrasi Umum)</span>
                                                                </label>

                                                                <label>
                                                                    <input name="level" value="2" type="radio" />
                                                                    <span class="lbl"> Kepala Bidang</span>
                                                                </label>

                                                                <label>
                                                                    <input name="level" value="3" type="radio" />
                                                                    <span class="lbl"> Kepala Seksi Oprasional</span>
                                                                </label>

                                                                <label>
                                                                    <input name="level" value="4" type="radio" />
                                                                    <span class="lbl"> Kepala Seksi Sarana</span>
                                                                </label>
                                                            </div>
                                                        </div>

                                                        <div class="row-fluid wizard-actions">
                                                            <button class="btn  btn-primary" onClick="document.location.reload(true)">
                                                                <i class="icon-refresh"></i>
                                                                Reset
                                                            </button>

                                                            <input type="submit" name="submit" class="btn btn-success" value="Update" />

                                                            <!--<button class="btn btn-success btn-next" data-last="Finish">
                                                                Next
                                                                <i class="icon-arrow-right icon-on-right"></i>
                                                            </button>-->
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div><!--/widget-main-->
                                    </div><!--/widget-body-->
                                </div><!--/widget-box-->

                                <!--PAGE CONTENT ENDS-->
                            </div><!--/.span-->
                        </div><!--/.row-fluid-->
                    </div><!--/.page-content-->

                    <?php
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

                                                <!--<script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>-->

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

<!--[if lte IE 8]>
  <script src="assets/js/excanvas.min.js"></script>
<![endif]-->

                                                                    <!--<script src="../assets/js-ace/additional-methods.min.js"></script>-->
<script src="../assets/js-ace/jquery-ui-1.10.3.custom.min.js"></script>
<script src="../assets/js-ace/jquery.ui.touch-punch.min.js"></script>
<script src="../assets/js-ace/jquery.gritter.min.js"></script>
<script src="../assets/js-ace/bootbox.min.js"></script>
<script src="../assets/js-ace/jquery.slimscroll.min.js"></script>
<script src="../assets/js-ace/jquery.easy-pie-chart.min.js"></script>
<script src="../assets/js-ace/jquery.hotkeys.min.js"></script>
<script src="../assets/js-ace/bootstrap-wysiwyg.min.js"></script>
<script src="../assets/js-ace/select2.min.js"></script>
<script src="../assets/js-ace/date-time/bootstrap-datepicker.min.js"></script>
<script src="../assets/js-ace/fuelux/fuelux.spinner.min.js"></script>
<script src="../assets/js-ace/fuelux/fuelux.wizard.min.js"></script>
<script src="../assets/js-ace/x-editable/bootstrap-editable.min.js"></script>
<script src="../assets/js-ace/x-editable/ace-editable.min.js"></script>
<script src="../assets/js-ace/jquery.maskedinput.min.js"></script>
<script src="../assets/js-ace/jquery.validate.min.js"></script>

<!--ace scripts-->

<script src="../assets/js-ace/ace-elements.min.js"></script>
<script src="../assets/js-ace/ace.min.js"></script>

<!--inline scripts related to this page-->

<script type="text/javascript">
    $(function() {

        $('[data-rel=tooltip]').tooltip();

        $(".select2").css('width', '150px').select2({allowClear: true})
                .on('change', function() {
                    $(this).closest('form').validate().element($(this));
                });

        var $validation = true;
        $('#fuelux-wizard').ace_wizard().on('change', function(e, info) {
            if (info.step == 1 && $validation) {
                if (!$('#validation-form').valid())
                    return false;
            }
        }).on('finished', function(e) {
            bootbox.dialog("Terima kasih! Informasi Anda berhasil disimpan!", [{
                    "label": "OK",
                    "class": "btn-small btn-primary",
                    "href": "list.php",
                }]
                    );

        }).on('stepclick', function(e) {
            //return false;//prevent clicking on steps
        });


        $('#validation-form').show();
        $('#skip-validation').removeAttr('checked').on('click', function() {
            $validation = this.checked;
            if (this.checked) {
                $('#sample-form').hide();
                $('#validation-form').show();
            }
            else {
                $('#validation-form').show();
                $('#sample-form').hide();
            }
        });



        //documentation : http://docs.jquery.com/Plugins/Validation/validate


        $.mask.definitions['~'] = '[+-]';
        $('#phone').mask('999999999999');
        /*jQuery.validator.addMethod("phone", function(value, element) {
         return this.optional(element) || /^\(\d{3}\) \d{3}\-\d{4}( x\d{1,6})?$/.test(value);
         }, "Enter a valid phone number.");*/

        $.mask.definitions['~'] = '[+-]';
        $('#nomor').mask('999999999');
        /*jQuery.validator.addMethod("nomor", function(value, element) {
         return this.optional(element) || /^\(\d{3}\) \d{3}\-\d{4}( x\d{1,6})?$/.test(value);
         }, "Enter a valid number.");*/

        $('#validation-form').validate({
            errorElement: 'span',
            errorClass: 'help-inline',
            focusInvalid: false,
            rules: {
                email: {
                    required: true,
                    email: true
                },
                password: {
                    required: true,
                    minlength: 5
                },
                password2: {
                    required: true,
                    minlength: 5,
                    equalTo: "#password"
                },
                name: {
                    required: true
                },
                phone: {
                    required: true
                },
                tanggal: {
                    required: true
                },
                alamat: {
                    required: true
                },
                tempat: {
                    required: true
                },
                nomor: {
                    required: true
                },
                nama: {
                    required: true
                },
                gender: 'required',
                level: 'required',
                jabatan: 'required',
                foto: 'required'
            },
            messages: {
                email: {
                    required: "Mohon untuk memasukkan alamat email.",
                    email: "Mohon untuk memasukkan alamat email."
                },
                password: {
                    required: "Please specify a password.",
                    minlength: "Please specify a secure password."
                },
                subscription: "Please choose at least one option",
                gender: "Mohon untuk memilih",
                jabatan: "Mohon untuk memilih"
            },
            invalidHandler: function(event, validator) { //display error alert on form submit   
                $('.alert-error', $('.login-form')).show();
            },
            highlight: function(e) {
                $(e).closest('.control-group').removeClass('info').addClass('error');
            },
            success: function(e) {
                $(e).closest('.control-group').removeClass('error').addClass('info');
                $(e).remove();
            },
            errorPlacement: function(error, element) {
                if (element.is(':checkbox') || element.is(':radio')) {
                    var controls = element.closest('.controls');
                    if (controls.find(':checkbox,:radio').length > 1)
                        controls.append(error);
                    else
                        error.insertAfter(element.nextAll('.lbl:eq(0)').eq(0));
                }
                else if (element.is('.select2')) {
                    error.insertAfter(element.siblings('[class*="select2-container"]:eq(0)'));
                }
                else if (element.is('.chzn-select')) {
                    error.insertAfter(element.siblings('[class*="chzn-container"]:eq(0)'));
                }
                else
                    error.insertAfter(element);
            },
            submitHandler: function(form) {
                var url = "proses.php";

                // mengambil nilai dari inputbox, textbox dan select
                var v_no = $('input:text[name=nomor]').val();
                var v_nama = $('input:text[name=nama]').val();
                var v_tempat = $('input:text[name=tempat]').val();
                var v_ttl = $('input:text[name=tanggal]').val();
                var v_alamat = $('textarea[name=alamat]').val();
                var v_phone = $('input:text[name=alamat]').val();
                var v_gender = $('input:radio[name=gender]').val();
                var v_email = $('input:email[name=email]').val();
                var v_pass1 = $('input:password[name=pass1]').val();
                var v_jabatan = $('select[name=jabatan]').val();

                $.post(url, {nomor: v_no, nama: v_nama, tempat: v_tempat, ttl: v_ttl, alamat: v_alamat, phone: v_phone, gender: v_gender, email: v_email, pass1: v_pass1, jabatan: v_jabatan}, function() {

                })

            },
            invalidHandler: function(form) {
            }
        });




        $('#modal-wizard .modal-header').ace_wizard();
        $('#modal-wizard .wizard-actions .btn[data-dismiss=modal]').removeAttr('disabled');
    })


    $(function() {

        //editables on first profile page
        $.fn.editable.defaults.mode = 'inline';
        $.fn.editableform.loading = "<div class='editableform-loading'><i class='light-blue icon-2x icon-spinner icon-spin'></i></div>";
        $.fn.editableform.buttons = '<button type="submit" class="btn btn-info editable-submit"><i class="icon-ok icon-white"></i></button>' +
                '<button type="button" class="btn editable-cancel"><i class="icon-remove"></i></button>';

        //editables 
        $('#username').editable({
            type: 'text',
            name: 'username'
        });

        var countries = [];
        $.each({"CA": "Canada", "IN": "India", "NL": "Netherlands", "TR": "Turkey", "US": "United States"}, function(k, v) {
            countries.push({id: k, text: v});
        });

        var cities = [];
        cities["CA"] = [];
        $.each(["Toronto", "Ottawa", "Calgary", "Vancouver"], function(k, v) {
            cities["CA"].push({id: v, text: v});
        });
        cities["IN"] = [];
        $.each(["Delhi", "Mumbai", "Bangalore"], function(k, v) {
            cities["IN"].push({id: v, text: v});
        });
        cities["NL"] = [];
        $.each(["Amsterdam", "Rotterdam", "The Hague"], function(k, v) {
            cities["NL"].push({id: v, text: v});
        });
        cities["TR"] = [];
        $.each(["Ankara", "Istanbul", "Izmir"], function(k, v) {
            cities["TR"].push({id: v, text: v});
        });
        cities["US"] = [];
        $.each(["New York", "Miami", "Los Angeles", "Chicago", "Wysconsin"], function(k, v) {
            cities["US"].push({id: v, text: v});
        });

        var currentValue = "NL";
        $('#country').editable({
            type: 'select2',
            value: 'NL',
            source: countries,
            success: function(response, newValue) {
                if (currentValue == newValue)
                    return;
                currentValue = newValue;
                var source = (!newValue || newValue == "") ? [] : cities[newValue];
                $('#city').editable('destroy').editable({
                    type: 'select2',
                    source: source
                }).editable('setValue', null);
            }
        });

        $('#city').editable({
            type: 'select2',
            value: 'Amsterdam',
            source: cities[currentValue]
        });



        $('#signup').editable({
            type: 'date',
            format: 'yyyy-mm-dd',
            viewformat: 'dd/mm/yyyy',
            datepicker: {
                weekStart: 1
            }
        });

        $('#age').editable({
            type: 'spinner',
            name: 'age', spinner: {
                min: 16, max: 99, step: 1
            }
        });

        //var $range = document.createElement("INPUT");
        //$range.type = 'range';
        $('#login').editable({
            type: 'slider', //$range.type == 'range' ? 'range' : 'slider',
            name: 'login',
            slider: {
                min: 1, max: 50, width: 100
            },
            success: function(response, newValue) {
                if (parseInt(newValue) == 1)
                    $(this).html(newValue + " hour ago");
                else
                    $(this).html(newValue + " hours ago");
            }
        });

        $('#about').editable({
            mode: 'inline',
            type: 'wysiwyg',
            name: 'about',
            wysiwyg: {
                //css : {'max-width':'300px'}
            },
            success: function(response, newValue) {
            }
        });



        // *** editable avatar *** //
        try {//ie8 throws some harmless exception, so let's catch it

            //it seems that editable plugin calls appendChild, and as Image doesn't have it, it causes errors on IE at unpredicted points
            //so let's have a fake appendChild for it!
            if (/msie\s*(8|7|6)/.test(navigator.userAgent.toLowerCase()))
                Image.prototype.appendChild = function(el) {
                }

            var last_gritter
            $('#avatar').editable({
                type: 'image',
                name: 'avatar',
                value: null,
                image: {
                    //specify ace file input plugin's options here
                    btn_choose: 'Pilih Foto',
                    droppable: true,
                    /**
                     //this will override the default before_change that only accepts image files
                     before_change: function(files, dropped) {
                     return true;
                     },
                     */

                    //and a few extra ones here
                    name: 'avatar', //put the field name here as well, will be used inside the custom plugin
                    max_size: 110000, //~100Kb
                    on_error: function(code) {//on_error function will be called when the selected file has a problem
                        if (last_gritter)
                            $.gritter.remove(last_gritter);
                        if (code == 1) {//file format error
                            last_gritter = $.gritter.add({
                                title: 'File is not an image!',
                                text: 'Please choose a jpg|gif|png image!',
                                class_name: 'gritter-error gritter-center'
                            });
                        } else if (code == 2) {//file size rror
                            last_gritter = $.gritter.add({
                                title: 'File too big!',
                                text: 'Image size should not exceed 100Kb!',
                                class_name: 'gritter-error gritter-center'
                            });
                        }
                        else {//other error
                        }
                    },
                    on_success: function() {
                        $.gritter.removeAll();
                    }},
                url: function(params) {
                    // ***UPDATE AVATAR HERE*** //
                    //You can replace the contents of this function with examples/profile-avatar-update.js for actual upload


                    var deferred = new $.Deferred

                    //if value is empty, means no valid files were selected
                    //but it may still be submitted by the plugin, because "" (empty string) is different from previous non-empty value whatever it was
                    //so we return just here to prevent problems
                    var value = $('#avatar').next().find('input[type=hidden]:eq(0)').val();
                    if (!value || value.length == 0) {
                        deferred.resolve();
                        return deferred.promise();
                    }


                    //dummy upload
                    setTimeout(function() {
                        if ("FileReader" in window) {
                            //for browsers that have a thumbnail of selected image
                            var thumb = $('#avatar').next().find('img').data('thumb');
                            if (thumb)
                                $('#avatar').get(0).src = thumb;
                        }

                        deferred.resolve({'status': 'OK'});

                        if (last_gritter)
                            $.gritter.remove(last_gritter);
                        last_gritter = $.gritter.add({
                            title: 'Avatar Updated!',
                            text: 'Uploading to server can be easily implemented. A working example is included with the template.',
                            class_name: 'gritter-info gritter-center'
                        });

                    }, parseInt(Math.random() * 800 + 800))

                    return deferred.promise();
                },
                success: function(response, newValue) {
                }
            })
        } catch (e) {
        }



        //another option is using modals
        $('#avatar2').on('click', function() {
            var modal =
                    '<div class="modal hide fade">\
         <div class="modal-header">\
         <button type="button" class="close" data-dismiss="modal">&times;</button>\
         <h4 class="blue">Pilih Foto</h4>\
         </div>\
         \
         <form class="no-margin">\
         <div class="modal-body">\
         <div class="space-4"></div>\
         <div style="width:75%;margin-left:12%;"><input type="file" name="file-input" /></div>\
         </div>\
         \
         <div class="modal-footer center">\
         <button type="submit" class="btn btn-small btn-success"><i class="icon-ok"></i> Submit</button>\
         <button type="button" class="btn btn-small" data-dismiss="modal"><i class="icon-remove"></i> Cancel</button>\
         </div>\
         </form>\                             </div>';


            var modal = $(modal);
            modal.modal("show").on("hidden", function() {
                modal.remove();
            });
            var working = false;

            var form = modal.find('form:eq(0)');
            var file = form.find('input[type=file]').eq(0);
            file.ace_file_input({
                style: 'well',
                btn_choose: 'Click to choose new avatar',
                btn_change: null,
                no_icon: 'icon-picture',
                thumbnail: 'small',
                before_remove: function() {
                    //don't remove/reset files while being uploaded
                    return !working;
                },
                before_change: function(files, dropped) {
                    var file = files[0];
                    if (typeof file === "string") {
                        //file is just a file name here (in browsers that don't support FileReader API)
                        if (!(/\.(jpe?g|png|gif)$/i).test(file))
                            return false;
                    }
                    else {//file is a File object
                        var type = $.trim(file.type);
                        if ((type.length > 0 && !(/^image\/(jpe?g|png|gif)$/i).test(type))
                                || (type.length == 0 && !(/\.(jpe?g|png|gif)$/i).test(file.name))//for android default browser!
                                )
                            return false;

                        if (file.size > 110000) {//~100Kb
                            return false;
                        }
                    }

                    return true;
                }
            });

            form.on('submit', function() {
                if (!file.data('ace_input_files'))
                    return false;

                file.ace_file_input('disable');
                form.find('button').attr('disabled', 'disabled');
                form.find('.modal-body').append("<div class='center'><i class='icon-spinner icon-spin bigger-150 orange'></i></div>");

                var deferred = new $.Deferred;
                working = true;
                deferred.done(function() {
                    form.find('button').removeAttr('disabled');
                    form.find('input[type=file]').ace_file_input('enable');
                    form.find('.modal-body > :last-child').remove();

                    modal.modal("hide");

                    var thumb = file.next().find('img').data('thumb');
                    if (thumb)
                        $('#avatar2').get(0).src = thumb;

                    working = false;
                });


                setTimeout(function() {
                    deferred.resolve();
                }, parseInt(Math.random() * 800 + 800));

                return false;
            });

        });



        //////////////////////////////
        /*$('#profile-feed-1').slimScroll({
         height: '250px',
         alwaysVisible: true
         });
         
         $('.profile-social-links > a').tooltip();
         
         $('.easy-pie-chart.percentage').each(function() {
         var barColor = $(this).data('color') || '#555';
         var trackColor = '#E2E2E2';
         var size = parseInt($(this).data('size')) || 72;
         $(this).easyPieChart({
         barColor: barColor,
         trackColor: trackColor,
         scaleColor: false,
         lineCap: 'butt',
         lineWidth: parseInt(size / 10),
         animate: false,
         size: size
         }).css('color', barColor);
         });*/

        ///////////////////////////////////////////

        //show the user info on right or left depending on its position
        /*$('#user-profile-2 .memberdiv').on('mouseenter', function() {
         var $this = $(this);
         var $parent = $this.closest('.tab-pane');
         var off1 = $parent.offset();
         var w1 = $parent.width();
         
         var off2 = $this.offset();
         var w2 = $this.width();
         
         var place = 'left';
         if (parseInt(off2.left) < parseInt(off1.left) + parseInt(w1 / 2))
         place = 'right';
         
         $this.find('.popover').removeClass('right left').addClass(place);
         }).on('click', function() {
         return false;
         });*/


        ///////////////////////////////////////////
        $('#user-profile-3')
                .find('input[type=file]').ace_file_input({
            style: 'well',
            btn_choose: 'Pilih Foto',
            btn_change: null,
            no_icon: 'icon-picture',
            thumbnail: 'large',
            droppable: true,
            before_change: function(files, dropped) {
                var file = files[0];
                if (typeof file === "string") {//files is just a file name here (in browsers that don't support FileReader API)
                    if (!(/\.(jpe?g|png|gif)$/i).test(file))
                        return false;
                }
                else {//file is a File object
                    var type = $.trim(file.type);
                    if ((type.length > 0 && !(/^image\/(jpe?g|png|gif)$/i).test(type))
                            || (type.length == 0 && !(/\.(jpe?g|png|gif)$/i).test(file.name))//for android default browser!
                            )
                        return false;

                    if (file.size > 5500000) {//~5Mb
                        return false;
                    }
                }

                return true;
            }
        })
                .end().find('button[type=reset]').on(ace.click_event, function() {
            $('#user-profile-3 input[type=file]').ace_file_input('reset_input');
        })
                .end().find('.date-picker').datepicker().next().on(ace.click_event, function() {
            $(this).prev().focus();
        })
        $('.input-mask-phone').mask('999999999999');



        ////////////////////
        //change profile
        $('[data-toggle="buttons-radio"]').on('click', function(e) {
            var target = $(e.target);
            var which = parseInt($.trim(target.text()));
            $('.user-profile').parent().hide();
            $('#user-profile-' + which).parent().show();
        });
    });
</script>
</body>
</html>

