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
        $query = mysql_query("SELECT * FROM resiko WHERE resiko_id = '$id'");
        if ($query) {
            $row = mysql_fetch_array($query);
        } else {
            die(mysql_error());
        }
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

        /*echo 'ID resiko = '.$id."<br/>";
        echo 'tgl resiko = '.NOW()."<br/>";
        echo 'nama pelapor = '.$nama."<br/>";
        echo 'nomor_telp = '.$no."<br/>";
        echo 'alamat_pelapor = '.$alamat."<br/>";
        echo 'ID BANGUNAN = '.$bangunan."<br/>";
        echo 'DESA_ID = '.$desa."<br/>";
        echo 'KECAMATAN_ID = '.$kecamatan."<br/>";
        echo 'ID sumber = '.$sumber."<br/>";
        echo 'exposure = '.$exposure."<br/>";
        echo 'tepol = '.$tepol."<br/>";
        echo 'p x l x t = '.$p.'x'.$l.'x'.$t."<br/>";
        echo 'pasokan_air_minimum = '.$minim."<br/>";
        echo 'penerapan_air = '.$laju."<br/>";
        echo 'pengangkutan_air = '.$hasil."<br/>";
        echo 'tipe_proteksi = '.$proteksi."<br/>";*/
        $luas = $p * $l;
        $update = mysql_query("UPDATE resiko SET
                                resiko_id = '$id',
                                resiko_tanggal = NOW(),
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
                                tipe_proteksi = '$proteksi'
                                WHERE resiko_id = '$id'") or die(mysql_error());
		if($update){
			header("Location: ../../pasca/pasca?msg=notif&nama=$nama&id=$id");
		}
    }
}
?>