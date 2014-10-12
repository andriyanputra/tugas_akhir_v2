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

        //=======================G R A F I K=============================
        $tgl = $row['resiko_tanggal'];
        $bln = date('F', strtotime($row['resiko_tanggal']));
        if($bln == 'January')$bln = 'Jan';else if($bln == 'February')$bln = 'Feb';
        else if($bln == 'March')$bln = 'Mar';else if($bln == 'April')$bln = 'Apr';
        else if($bln == 'May')$bln = 'Mei';else if($bln == 'June')$bln = 'Jun';
        else if($bln == 'July')$bln = 'Jul';else if($bln == 'August')$bln = 'Agt';
        else if($bln == 'September')$bln = 'Sep';else if($bln == 'October')$bln = 'Okt';
        else if($bln == 'November')$bln = 'Nov';else if($bln == 'December')$bln = 'Des';
        $thn = date('Y', strtotime($row['resiko_tanggal']));

        $cek = mysql_fetch_assoc(mysql_query("SELECT SUM(grafik_perkantoran) AS jml_perkantoran,
            SUM(grafik_udj) AS jml_udj, SUM(grafik_industri) AS jml_industri,
            SUM(grafik_kb) AS jml_kb, SUM(grafik_rmh) AS jml_rmh,
            SUM(grafik_lahan) AS jml_lahan,
            SUM(grafik_mpkp) AS jml_mpkp, SUM(grafik_mpkl) AS jml_mpkl, SUM(grafik_mpkbg) AS jml_mpkbg 
            FROM grafik 
            WHERE grafik_bln = '$bln' AND grafik_thn = '$thn'")) or die("Query : ".mysql_error());
        $jml_perkantoran = $cek['jml_perkantoran']; $jml_mpkp = $cek['jml_mpkp'];  
        $jml_udj = $cek['jml_udj'];                 $jml_mpkl = $cek['jml_mpkl'];
        $jml_industri = $cek['jml_industri'];       $jml_mpkbg = $cek['jml_mpkbg'];
        $jml_kb = $cek['jml_kb'];
        $jml_rmh = $cek['jml_rmh'];
        $jml_lahan = $cek['jml_lahan'];

        //===Jika query dari cek, menghasilkan NULL record===
        if($jml_mpkp == NULL && $jml_mpkl == NULL && $jml_mpkbg == NULL && $jml_perkantoran == NULL && $jml_udj == NULL && $jml_industri == NULL && $jml_kb == NULL && $jml_rmh == NULL && $jml_lahan == NULL){
            $jml_perkantoran = '0'; $jml_mpkp = '0';  
            $jml_udj = '0';         $jml_mpkl = '0';
            $jml_industri = '0';    $jml_mpkbg = '0';
            $jml_kb = '0';
            $jml_rmh = '0';
            $jml_lahan = '0';        
        }
        /*
        1 = perkantoran     4 = kb
        2 = udj             5 = rumah
        3 = industri        6 = lahan/sawah
        */
        $master_id = $row['ID_MASTER'];
        if($master_id == '1' && $proteksi == 'MPKP'){
            $add_perkantoran = $jml_perkantoran + 1; $add_mpkp = $jml_mpkp + 1;
            $grafik = mysql_query("INSERT INTO grafik
                    VALUES (NULL,'$bln','$thn',
                    '$add_mpkp','$jml_mpkl','$jml_mpkbg',
                    '','',
                    '','','','','',
                    '$add_perkantoran','$jml_udj','$jml_industri','$jml_kb','$jml_rmh','$jml_lahan')") or die("Query : ".mysql_error());
        }else if($master_id == '1' && $proteksi == 'MPKL'){
            $add_perkantoran = $jml_perkantoran + 1; $add_mpkl = $jml_mpkl + 1;
            $grafik = mysql_query("INSERT INTO grafik
                    VALUES (NULL,'$bln','$thn',
                    '$jml_mpkp','$add_mpkl','$jml_mpkbg',
                    '','',
                    '','','','','',
                    '$add_perkantoran','$jml_udj','$jml_industri','$jml_kb','$jml_rmh','$jml_lahan')") or die("Query : ".mysql_error());
        }else if($master_id == '1' && $proteksi == 'MPKBG'){
            $add_perkantoran = $jml_perkantoran + 1; $add_mpkbg = $jml_mpkbg + 1;
            $grafik = mysql_query("INSERT INTO grafik
                    VALUES (NULL,'$bln','$thn',
                    '$jml_mpkp','$jml_mpkl','$add_mpkbg',
                    '','',
                    '','','','','',
                    '$add_perkantoran','$jml_udj','$jml_industri','$jml_kb','$jml_rmh','$jml_lahan')") or die("Query : ".mysql_error());
        }else if($master_id == '2' && $proteksi == 'MPKP'){
            $add_udj = $jml_udj + 1; $add_mpkp = $jml_mpkp + 1;
            $grafik = mysql_query("INSERT INTO grafik
                    VALUES (NULL,'$bln','$thn',
                    '$add_mpkp','$jml_mpkl','$jml_mpkbg',
                    '','',
                    '','','','','',
                    '$jml_perkantoran','$add_udj','$jml_industri','$jml_kb','$jml_rmh','$jml_lahan')") or die("Query : ".mysql_error());
        }else if($master_id == '2' && $proteksi == 'MPKL'){
            $add_udj = $jml_udj + 1; $add_mpkl = $jml_mpkl + 1;
            $grafik = mysql_query("INSERT INTO grafik
                    VALUES (NULL,'$bln','$thn',
                    '$jml_mpkp','$add_mpkl','$jml_mpkbg',
                    '','',
                    '','','','','',
                    '$jml_perkantoran','$add_udj','$jml_industri','$jml_kb','$jml_rmh','$jml_lahan')") or die("Query : ".mysql_error());
        }else if($master_id == '2' && $proteksi == 'MPKBG'){
            $add_udj = $jml_udj + 1; $add_mpkbg = $jml_mpkbg + 1;
            $grafik = mysql_query("INSERT INTO grafik
                    VALUES (NULL,'$bln','$thn',
                    '$jml_mpkp','$jml_mpkl','$add_mpkbg',
                    '','',
                    '','','','','',
                    '$jml_perkantoran','$add_udj','$jml_industri','$jml_kb','$jml_rmh','$jml_lahan')") or die("Query : ".mysql_error());
        }else if($master_id == '3' && $proteksi == 'MPKP'){
            $add_industri = $jml_industri + 1; $add_mpkp = $jml_mpkp + 1;
            $grafik = mysql_query("INSERT INTO grafik
                    VALUES (NULL,'$bln','$thn',
                    '$add_mpkp','$jml_mpkl','$jml_mpkbg',
                    '','',
                    '','','','','',
                    '$jml_perkantoran','$jml_udj','$add_industri','$jml_kb','$jml_rmh','$jml_lahan')") or die("Query : ".mysql_error());    
        }else if($master_id == '3' && $proteksi == 'MPKL'){
            $add_industri = $jml_industri + 1; $add_mpkl = $jml_mpkl + 1;
            $grafik = mysql_query("INSERT INTO grafik
                    VALUES (NULL,'$bln','$thn',
                    '$jml_mpkp','$add_mpkl','$jml_mpkbg',
                    '','',
                    '','','','','',
                    '$jml_perkantoran','$jml_udj','$add_industri','$jml_kb','$jml_rmh','$jml_lahan')") or die("Query : ".mysql_error());   
        }else if($master_id == '3' && $proteksi == 'MPKBG'){
            $add_industri = $jml_industri + 1; $add_mpkbg = $jml_mpkbg + 1;
            $grafik = mysql_query("INSERT INTO grafik
                    VALUES (NULL,'$bln','$thn',
                    '$jml_mpkp','$jml_mpkl','$add_mpkbg',
                    '','',
                    '','','','','',
                    '$jml_perkantoran','$jml_udj','$add_industri','$jml_kb','$jml_rmh','$jml_lahan')") or die("Query : ".mysql_error());   
        }else if($master_id == '4' && $proteksi == 'MPKP'){
            $add_kb = $jml_kb + 1; $add_mpkp = $jml_mpkp + 1;
            $grafik = mysql_query("INSERT INTO grafik
                    VALUES (NULL,'$bln','$thn',
                    '$add_mpkp','$jml_mpkl','$jml_mpkbg',
                    '','',
                    '','','','','',
                    '$jml_perkantoran','$jml_udj','$jml_industri','$add_kb','$jml_rmh','$jml_lahan')") or die("Query : ".mysql_error());
        }else if($master_id == '4' && $proteksi == 'MPKL'){
            $add_kb = $jml_kb + 1; $add_mpkl = $jml_mpkl + 1;
            $grafik = mysql_query("INSERT INTO grafik
                    VALUES (NULL,'$bln','$thn',
                    '$jml_mpkp','$add_mpkl','$jml_mpkbg',
                    '','',
                    '','','','','',
                    '$jml_perkantoran','$jml_udj','$jml_industri','$add_kb','$jml_rmh','$jml_lahan')") or die("Query : ".mysql_error());
        }else if($master_id == '4' && $proteksi == 'MPKBG'){
            $add_kb = $jml_kb + 1; $add_mpkbg = $jml_mpkbg + 1;
            $grafik = mysql_query("INSERT INTO grafik
                    VALUES (NULL,'$bln','$thn',
                    '$jml_mpkp','$jml_mpkl','$add_mpkbg',
                    '','',
                    '','','','','',
                    '$jml_perkantoran','$jml_udj','$jml_industri','$add_kb','$jml_rmh','$jml_lahan')") or die("Query : ".mysql_error());
        }else if($master_id == '5' && $proteksi == 'MPKP'){
            $add_rmh = $jml_rmh + 1; $add_mpkp = $jml_mpkp + 1;
            $grafik = mysql_query("INSERT INTO grafik
                    VALUES (NULL,'$bln','$thn',
                    '$add_mpkp','$jml_mpkl','$jml_mpkbg',
                    '','',
                    '','','','','',
                    '$jml_perkantoran','$jml_udj','$jml_industri','$jml_kb','$add_rmh','$jml_lahan')") or die("Query : ".mysql_error());
        }else if($master_id == '5' && $proteksi == 'MPKL'){
            $add_rmh = $jml_rmh + 1; $add_mpkl = $jml_mpkl + 1;
            $grafik = mysql_query("INSERT INTO grafik
                    VALUES (NULL,'$bln','$thn',
                    '$jml_mpkp','$add_mpkl','$jml_mpkbg',
                    '','',
                    '','','','','',
                    '$jml_perkantoran','$jml_udj','$jml_industri','$jml_kb','$add_rmh','$jml_lahan')") or die("Query : ".mysql_error());
        }else if($master_id == '5' && $proteksi == 'MPKBG'){
            $add_rmh = $jml_rmh + 1; $add_mpkbg = $jml_mpkbg + 1;
            $grafik = mysql_query("INSERT INTO grafik
                    VALUES (NULL,'$bln','$thn',
                    '$jml_mpkp','$jml_mpkl','$add_mpkbg',
                    '','',
                    '','','','','',
                    '$jml_perkantoran','$jml_udj','$jml_industri','$jml_kb','$add_rmh','$jml_lahan')") or die("Query : ".mysql_error());
        }else if($master_id == '6' && $proteksi == 'MPKP'){
            $add_lahan = $jml_lahan + 1; $add_mpkp = $jml_mpkp + 1;
            $grafik = mysql_query("INSERT INTO grafik
                    VALUES (NULL,'$bln','$thn',
                    '$add_mpkp','$jml_mpkl','$jml_mpkbg',
                    '','',
                    '','','','','',
                    '$jml_perkantoran','$jml_udj','$jml_industri','$jml_kb','$jml_rmh','$add_lahan')") or die("Query : ".mysql_error());
        }else if($master_id == '6' && $proteksi == 'MPKL'){
            $add_lahan = $jml_lahan + 1; $add_mpkl = $jml_mpkl + 1;
            $grafik = mysql_query("INSERT INTO grafik
                    VALUES (NULL,'$bln','$thn',
                    '$jml_mpkp','$add_mpkl','$jml_mpkbg',
                    '','',
                    '','','','','',
                    '$jml_perkantoran','$jml_udj','$jml_industri','$jml_kb','$jml_rmh','$add_lahan')") or die("Query : ".mysql_error());
        }else if($master_id == '6' && $proteksi == 'MPKBG'){
            $add_lahan = $jml_lahan + 1; $add_mpkbg = $jml_mpkbg + 1;
            $grafik = mysql_query("INSERT INTO grafik
                    VALUES (NULL,'$bln','$thn',
                    '$jml_mpkp','$jml_mpkl','$add_mpkbg',
                    '','',
                    '','','','','',
                    '$jml_perkantoran','$jml_udj','$jml_industri','$jml_kb','$jml_rmh','$add_lahan')") or die("Query : ".mysql_error());
        }


        $luas = $p * $l;
        $update = mysql_query("UPDATE resiko SET
                                resiko_id = '$id',
                                resiko_tanggal = '$tgl',
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
		if($update && $grafik){
			header("Location: ../../pasca/pasca?msg=notif&nama=$nama&id=$id");
		}
    }
}
?>