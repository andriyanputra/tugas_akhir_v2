<?php
include '../template/header.php';

session_start();
include ("../config/koneksi.php");
include '../config/functions.php'; //include function.php - very important

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
?><body tracingsrc="../assets/img/sda/Kec.jpg" tracingopacity="0" tracingx="241" tracingy="724">
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
                                <img class="nav-user-photo" src="../assets/img/img-anggota/<?= $row['pegawai_foto']; ?>" alt="<?= $row['pegawai_nama']; ?>" />
                                            <span class="user-info">
                                                <small>Welcome,</small>
                                                <?= $row['pegawai_nama']; ?>    
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

        <?php
            include '../template/sidebar.php';
        ?>

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
                        <a href="">Analisis Resiko</a>

                        <span class="divider">
                            <i class="icon-angle-right arrow-icon"></i>
                        </span>
                    </li>
                    <li class="active">Peta</li>
                </ul><!--.breadcrumb-->
            </div>

            <div class="page-content">
                <div class="page-header position-relative">
                    <h1>
                        Peta
                        <small>
                            <i class="icon-double-angle-right"></i>
                            Kabupaten Sidoarjo
                        </small>
                    </h1>
                </div><!--/.page-header-->

                <div class="row-fluid">
                    <div class="span12">
                        <p align="center"><img src="../assets/img/sda/Kec.jpg" width="828" height="300" usemap="#Map">
                          <map name="Map" id="Map">
                            <area shape="poly" coords="34,216,44,209,53,207,51,200,62,198,79,199,86,195,103,197,112,190,128,185,141,194,152,195,166,194,183,191,192,195,203,198,215,197,221,197,220,204,215,211,206,216,197,219,187,216,170,210,157,211,146,212,124,207,103,209,93,212,96,217,69,216" href="#" alt="balongbendo" title="BALONGBENDO" data-rel="tooltip"/>
                            <area shape="poly" coords="42,263,27,262,10,259,10,253,24,252,38,253,54,255,65,258,76,259,91,261,105,261,107,250,119,246,131,249,146,253,164,254,182,255,185,263,189,268,199,270,187,278,179,283,170,283,155,279,152,285,112,281,68,275,55,272" href="#" alt="tarik" title="TARIK" data-rel="tooltip"/>
                            <area shape="poly" coords="233,184,239,177,253,171,266,165,277,158,292,155,317,151,327,154,341,160,345,166,340,175,337,181,314,181,317,189,306,201,289,207,265,208,256,215,248,214,254,208,250,194" href="#" alt="krian" title="KRIAN" data-rel="tooltip"/>
                            <area shape="poly" coords="187,314,198,306,206,300,211,292,205,287,194,287,201,281,215,279,228,284,239,285,249,286,260,292,271,296,284,295,293,296,302,302,306,310,302,318,288,319,280,322,283,333,278,340,258,338,239,330,230,323,208,317" href="#" alt="prambon" title="PRAMBON" data-rel="tooltip"/>
                            <area shape="poly" coords="344,109,359,107,373,106,391,104,406,103,417,93,442,92,467,86,502,76,514,77,510,87,506,95,514,103,514,115,510,107,501,102,488,105,465,109,447,113,421,113,391,121,364,122" href="#" alt="taman" title="TAMAN" data-rel="tooltip"/>
                            <area shape="poly" coords="360,162,374,159,397,156,415,156,442,151,461,150,486,143,493,140,487,150,487,158,487,168,486,183,475,191,443,187,424,187,421,178,393,171,376,169" href="#" alt="sukodono" title="SUKODONO" data-rel="tooltip"/>
                            <area shape="poly" coords="251,244,258,257,275,258,289,259,313,256,333,256,350,260,375,262,387,266,394,260,380,256,376,244,384,244,377,236,380,226,356,222,337,216,321,216,301,220,296,232,291,240,269,244" href="#" alt="wonoayu" title="WONOAYU" data-rel="tooltip"/>
                            <area shape="poly" coords="316,291,333,288,360,293,378,297,393,300,399,310,430,318,399,315,389,321,397,332,410,334,409,343,392,346,364,336,349,327,333,328,318,321,326,312,330,301" href="#" alt="tulangan" title="TULANGAN" data-rel="tooltip"/>
                            <area shape="poly" coords="341,413,334,407,305,279,345,392,368,384,383,385,401,386,403,392,394,390,398,390,400,388,404,390,407,398,409,400,407,403,402,410,397,419,391,420,378,419,371,415,351,419,351,416,346,416" href="#" alt="krembung" title="KREMBUNG" data-rel="tooltip"/>
                            <area shape="poly" coords="529,70,544,73,561,76,577,71,602,71,623,70,647,72,671,75,700,76,723,76,742,74,741,84,724,88,712,92,701,97,684,96,638,96,615,93,581,96,555,96,535,91,524,82" href="#" alt="waru" title="WARU" data-rel="tooltip"/>
                            <area shape="poly" coords="523,135,539,136,565,131,575,138,584,151,588,162,575,167,564,175,552,169,538,171,522,171,507,171,494,169,495,155,510,153,525,152,531,145" href="#" alt="gedangan" title="GEDANGAN" data-rel="tooltip"/>
                            <area shape="poly" coords="429,379,430,370,405,284,414,305,434,371,456,371,476,378,498,383,519,387,532,382,559,382,576,381,599,382,627,383,616,391,602,395,581,399,568,405,565,404,556,401,543,401,525,403,508,401,473,399,443,389" href="#" alt="tanggulangin" title="TANGGULANGIN" data-rel="tooltip"/>
                            <area shape="poly" coords="478,243,467,238,470,229,480,219,497,221,514,220,527,216,550,212,567,205,604,215,615,226,621,232,631,244,645,250,644,257,657,259,668,264,682,257,691,260,696,270,695,279,682,283,675,279,666,272,645,266,632,259,618,255,611,249,592,246,568,240,541,234,521,233,508,237,493,238" href="#" alt="buduran" title="BUDURAN" data-rel="tooltip"/>
                            <area shape="poly" coords="431,259,441,251,455,250,466,255,472,265,486,270,493,275,507,277,508,268,525,266,542,264,559,263,584,267,658,306,672,309,679,315,690,323,702,326,720,324,725,330,727,343,729,369,715,376,684,374,683,356,688,353,688,353,687,337,663,321,635,311,608,305,576,300,553,298,523,295,499,284,478,278,462,278,442,278,430,280,435,272" href="#" alt="sidoarjo" title="SIDOARJO" data-rel="tooltip"/>
                            <area shape="poly" coords="408,282,456,318,485,316,512,319,538,323,565,325,585,332,607,333,618,334,633,335,638,340,639,341,654,349,645,361,630,362,623,362,591,362,580,361,563,356,549,358,526,353,480,344,456,335" href="#" alt="candi" title="CANDI" data-rel="tooltip"/>
                            <area shape="poly" coords="412,329,396,290,401,293,411,320,443,431,454,416,471,410,501,422,550,422,548,425,547,427,554,427,550,425,544,424,552,425,544,426,553,427,554,427,554,426,557,430,543,428,506,437,510,436,500,447,482,450,464,453,450,453,438,449,440,431" href="#" alt="porong" title="PORONG" data-rel="tooltip"/>
                            <area shape="poly" coords="503,453,519,448,541,448,562,449,584,448,595,439,631,439,657,438,679,434,701,436,725,428,730,419,776,412,805,435,811,293,809,267,813,260,814,439,804,456,803,472,799,485,778,486,760,473,755,459,743,452,723,455,715,459,692,457,680,464,654,469,633,473,604,481,565,478,531,473,514,464" href="#" alt="jabon" title="JABON" data-rel="tooltip"/>
                            <area shape="poly" coords="603,145,602,133,593,123,582,111,603,110,627,113,657,114,682,114,692,112,712,113,724,109,739,101,743,84,754,62,770,58,765,74,755,92,744,102,742,112,747,118,744,128,746,134,743,153,749,191,749,249,717,253,705,247,691,239,703,221,696,212,666,206,638,198,647,184,636,174,626,167,612,160" href="#" alt="sedati" title="SEDATI" data-rel="tooltip"/>
                          </map>
                      </p>
                        <!--PAGE CONTENT ENDS-->
                    </div><!--/.span-->
                </div><!--/.row-fluid-->
            </div><!--/.page-content-->

    
    <?php
     include '../template/footer.php';
}}}
?>  
</body>
</html>