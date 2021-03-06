<?php 
    if($level == '1'){
?>
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
        <li>
            <a href="../beranda/index">
                <i class="icon-dashboard"></i>
                <span class="menu-text"> Dashboard </span>
            </a>
        </li>

        <li>
            <a href="" class="dropdown-toggle">
                <i class="icon-edit"></i>
                <span class="menu-text"> Analisis Resiko </span>

                <b class="arrow icon-angle-down"></b>
            </a>

            <ul class="submenu">

                <li>
                    <a href="../resiko/peta">
                        <i class="icon-double-angle-right"></i>
                        Peta Kab. Sidoarjo
                    </a>
                </li>

                <li>
                    <a href="../resiko/analisis">
                        <i class="icon-double-angle-right"></i>
                        Analisis Resiko Kebakaran
                    </a>
                </li>

                <li>
                    <a href="../resiko/bangunan">
                        <i class="icon-double-angle-right"></i>
                        Daftar Bangunan
                    </a>
                </li>

                <li>
                    <a href="../resiko/sumber.php">
                        <i class="icon-double-angle-right"></i>
                        Daftar Sumber Air
                    </a>
                </li>
            </ul>
        </li>

        <li>
            <a href="../pasca/pasca" class="dropdown-toggle">
                <i class="icon-desktop"></i>
                <span class="menu-text"> Pasca Kebakaran </span>
            </a>
        </li>

        <li>
            <a href="../anggota/list">
                <i class="icon-group"></i>
                <span class="menu-text"> Anggota Pemadam </span>
            </a>
        </li>

        <li>
            <a href="../kalendar/kalendar">
                <i class="icon-calendar"></i>
                <?php
                    $thn = date('Y');
                    $bln = date('m');
                    $cek = mysql_query("SELECT * FROM resiko WHERE resiko_tanggal_start BETWEEN '$thn-$bln-01' AND '$thn-$bln-31'") or die("Query : ".mysql_error());
                    $jml = mysql_num_rows($cek);
                ?>
                <span class="menu-text">
                    Kalendar
                    <?php if($jml>0){ ?>
                    <span class="badge badge-transparent tooltip-error" title="<?php echo $jml; ?>&nbsp;Important&nbsp;Events">
                        <i class="icon-info-sign red bigger-130"></i>
                    </span>
                    <?php }else{ ?>
                    <span class="badge badge-transparent tooltip-error" title="0&nbsp;Important&nbsp;Events">
                        <i class="icon-info-sign red bigger-130"></i>
                    </span>
                    <?php } ?>
                </span>
            </a>
        </li>

        <li>
            <a href="../gallery/">
                <i class="icon-picture"></i>
                <span class="menu-text"> Foto Kejadian </span>
            </a>
        </li>

        <li>
            <a href="#" class="dropdown-toggle">
                <i class="icon-file"></i>

                <span class="menu-text">
                    Laporan Kebakaran
                </span>
                <b class="arrow icon-angle-down"></b>
            </a>

            <ul class="submenu">

                <li>
                    <a href="../laporan/">
                        <i class="icon-double-angle-right"></i>
                        Laporan Kebakaran
                    </a>
                </li>

                <li>
                    <a href="../grafik/">
                        <i class="icon-double-angle-right"></i>
                        Grafik Kebakaran
                    </a>
                </li>
            </ul>
        </li>
    </ul><!--/.nav-list-->

    <div class="sidebar-collapse" id="sidebar-collapse">
        <i class="icon-double-angle-left"></i>
    </div>
</div>
<?php
}else if($level == '2' || $level = '3'){
?>
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
        <li>
            <a href="../beranda/index">
                <i class="icon-dashboard"></i>
                <span class="menu-text"> Dashboard </span>
            </a>
        </li>

        <li>
            <a href="../pasca/pasca" class="dropdown-toggle">
                <i class="icon-desktop"></i>
                <span class="menu-text"> Pasca Kebakaran </span>
            </a>
        </li>

        <li>
            <a href="../anggota/list">
                <i class="icon-group"></i>
                <span class="menu-text"> Anggota Pemadam </span>
            </a>
        </li>

        <li>
            <a href="../kalendar/kalendar">
                <i class="icon-calendar"></i>
                <?php
                    $thn = date('Y');
                    $bln = date('m');
                    $cek = mysql_query("SELECT * FROM resiko WHERE resiko_tanggal_start BETWEEN '$thn-$bln-01' AND '$thn-$bln-31'") or die("Query : ".mysql_error());
                    $jml = mysql_num_rows($cek);
                ?>
                <span class="menu-text">
                    Kalendar
                    <?php if($jml>0){ ?>
                    <span class="badge badge-transparent tooltip-error" title="<?php echo $jml; ?>&nbsp;Important&nbsp;Events">
                        <i class="icon-info-sign red bigger-130"></i>
                    </span>
                    <?php }else{ ?>
                    <span class="badge badge-transparent tooltip-error" title="0&nbsp;Important&nbsp;Events">
                        <i class="icon-info-sign red bigger-130"></i>
                    </span>
                    <?php } ?>
                </span>
            </a>
        </li>

        <li>
            <a href="../gallery/">
                <i class="icon-picture"></i>
                <span class="menu-text"> Foto Kejadian </span>
            </a>
        </li>

        <li>
            <a href="#" class="dropdown-toggle">
                <i class="icon-file"></i>

                <span class="menu-text">
                    Laporan Kebakaran
                </span>
                <b class="arrow icon-angle-down"></b>
            </a>

            <ul class="submenu">

                <li>
                    <a href="../laporan/">
                        <i class="icon-double-angle-right"></i>
                        Laporan Kebakaran
                    </a>
                </li>

                <li>
                    <a href="../grafik/">
                        <i class="icon-double-angle-right"></i>
                        Grafik Kebakaran
                    </a>
                </li>
            </ul>
        </li>
    </ul><!--/.nav-list-->

    <div class="sidebar-collapse" id="sidebar-collapse">
        <i class="icon-double-angle-left"></i>
    </div>
</div>
<?php
}
?>
