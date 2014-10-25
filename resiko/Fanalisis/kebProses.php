<?php

include "../../config/koneksi.php";
if ($_POST) {
    $kec = $_POST['kecamatan'];
    $p = $_POST['panjang_volume'];
    $l = $_POST['lebar_volume'];
    $t = $_POST['tinggi_volume'];
    $laju = $_POST['hasil_laju2'];
    $hasil = $_POST['hasil'];
    
    $kec1 = $_POST['kecepatan_air'];
    $jarak1 = $_POST['jarak1'];
    $kec2 = $_POST['kecepatan_back'];
    $jarak2 = $_POST['jarak2'];
    $vol = $_POST['v_potensi'];
    $a = $_POST['a_potensi'];
    $b = $_POST['b_potensi'];
    /* if (empty($_POST['kecepatan_air'])){
      header("Location:../kebAir?kec=$kec&p=$p&l=$l&t=$t&$msg=");
      } */
    if ((empty($kec1) && empty($jarak1)) || (empty($kec1) || empty($jarak1))) {
        header("Location:../kebAir?kec=$kec&p=$p&l=$l&t=$t&msg=error");
    }elseif ((empty($kec2) && empty($jarak2)) || (empty($kec2) || empty($jarak2))) {
    	header("Location:../kebAir?kec=$kec&p=$p&l=$l&t=$t&msg=error");
    }elseif ((empty($vol) && empty($a) && empty($b)) || (empty($vol) || empty($a) || empty($b))) {
    	header("Location:../kebAir?kec=$kec&p=$p&l=$l&t=$t&msg=error");
    }else {
    	$id = $_POST['id'];
        $query = mysql_query("SELECT * FROM bangunan AS a
                    INNER JOIN resiko AS b ON (a.ID_BANGUNAN = b.ID_BANGUNAN)
                    INNER JOIN master_bangunan AS c ON (a.ID_MASTER = c.ID_MASTER)
                    WHERE b.resiko_id = '$id'");
        if ($query) {
            $row = mysql_fetch_array($query);
        } else {
            die(mysql_error());
        }
        $tgl_start = $row['resiko_tanggal_start'];
        $tgl_end = $row['resiko_tanggal_end'];
        $nama = $row['nama_pelapor'];
        $no = $row['nomor_telp'];
        $alamat = $row['alamat_pelapor'];
        $bangunan = $row['ID_BANGUNAN'];
        $desa = $row['DESA_ID'];
        $kecamatan = $row['KECAMATAN_ID'];
        $sumber = $row['ID_SUMBER'];
        $exposure = $row['exposure'];
        $tepol = $row['tepol'];
        $p = $row['panjang'];
        $l = $row['lebar'];
        $t = $row['tinggi'];
        $minim = $row['pasokan_air_minimum'];
        $proteksi = $row['tipe_proteksi'];
        $status = $row['resiko_status'];

        $luas = $p * $l;
        $update = mysql_query("UPDATE resiko SET
                                resiko_id = '$id',
                                resiko_tanggal_start = '$tgl_start',
                                resiko_tanggal_end = '$tgl_end',
                                nama_pelapor = '$nama',
                                nomor_telp ='$no',
                                alamat_pelapor = '$alamat',
                                ID_BANGUNAN = '$bangunan',
                                DESA_ID = '$desa',
                                KECAMATAN_ID = '$kecamatan',
                                ID_SUMBER = '$sumber',
                                exposure = '$exposure',
                                tepol = '$tepol',
                                panjang= '$p',
                                lebar = '$l',
                                tinggi = '$t',
                                pasokan_air_minimum = '$minim',
                                penerapan_air = '$laju',
                                pengangkutan_air = '$hasil',
                                tipe_proteksi = '$proteksi',
                                resiko_status = '$status'
                                WHERE resiko_id = '$id'") or die(mysql_error());
		if($update){
			header("Location: ../../pasca/pasca?msg=notif&nama=$nama&id=$id");
		}
    }
}
?>