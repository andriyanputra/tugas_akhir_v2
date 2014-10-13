<?php

include "../../config/koneksi.php";
if ($_POST) {
    $nama = $_POST['nama'];
    $alamat = $_POST['alamat'];
    $bangunan = $_POST['bangunan'];
    $bangunanBaru = $_POST['bangunan_tbaru'];
    $penyebab = $_POST['penyebab'];
    $penyebabBaru = $_POST['penyebab_baru'];
    $luas = $_POST['luas'];
    $luas_total = $_POST['luas_total'];
    $korban_luka = $_POST['korban_luka'];
    $korban_meninggal = $_POST['korban_meninggal'];
    $biaya = $_POST['biaya'];
    $pasca_id = $_POST['pasca_id'];
    $pasca_status = 'yes';
    
    //============================== R E S I K O===================================
    $query = mysql_query("SELECT * FROM bangunan AS a
                    INNER JOIN resiko AS b ON (a.ID_BANGUNAN = b.ID_BANGUNAN)
                    INNER JOIN master_bangunan AS c ON (a.ID_MASTER = c.ID_MASTER)
                    WHERE b.resiko_id = '$pasca_id'");
    if ($query) {
        $row = mysql_fetch_array($query);
    } else {
        die(mysql_error());
    }
    $nama = $row['nama_pelapor'];
    $tgl = $row['resiko_tanggal'];
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

    //==============================G R A F I K======================================
    $bln = date('F', strtotime($tgl));
    if($bln == 'January')$bln = 'Jan';else if($bln == 'February')$bln = 'Feb';
    else if($bln == 'March')$bln = 'Mar';else if($bln == 'April')$bln = 'Apr';
    else if($bln == 'May')$bln = 'Mei';else if($bln == 'June')$bln = 'Jun';
    else if($bln == 'July')$bln = 'Jul';else if($bln == 'August')$bln = 'Agt';
    else if($bln == 'September')$bln = 'Sep';else if($bln == 'October')$bln = 'Okt';
    else if($bln == 'November')$bln = 'Nov';else if($bln == 'December')$bln = 'Des';
    $thn = date('Y', strtotime($row['resiko_tanggal']));
    $cek = mysql_fetch_assoc(mysql_query("SELECT grafik_id, SUM(grafik_luka) AS jml_luka, SUM(grafik_meninggal) AS jml_meninggal,
       SUM(grafik_bbm) AS jml_bbm, SUM(grafik_kpr) AS jml_kpr,
       SUM(grafik_lst) AS jml_lst, SUM(grafik_rk) AS jml_rk, SUM(grafik_lain) AS jml_lain,
       SUM(grafik_perkantoran) AS jml_perkantoran,
       SUM(grafik_udj) AS jml_udj, SUM(grafik_industri) AS jml_industri,
       SUM(grafik_kb) AS jml_kb, SUM(grafik_rmh) AS jml_rmh,
       SUM(grafik_lahan) AS jml_lahan,
       SUM(grafik_mpkp) AS jml_mpkp, SUM(grafik_mpkl) AS jml_mpkl, SUM(grafik_mpkbg) AS jml_mpkbg 
       FROM grafik 
       WHERE grafik_bln = '$bln' AND grafik_thn = '$thn'") or die("Query : ".mysql_error());
    $grafik_id = $cek['grafik_id'];
    $grafik_mpkp = $cek['jml_mpkp']; $grafik_mpkl = $cek['jml_mpkl']; $grafik_mpkbg = $cek['jml_mpkbg'];
    $grafik_luka = $cek['jml_luka']; $grafik_meninggal = $cek['jml_meninggal'];
    $grafik_bbm = $cek['jml_bbm'];   $grafik_kpr = $cek['jml_kpr'];   $grafik_lst = $cek['jml_lst'];
    $grafik_rk = $cek['jml_rk'];     $grafik_lain = $cek['jml_lain'];
    $grafik_perkantoran = $cek['jml_perkantoran'];
    $grafik_udj = $cek['jml_udj'];   $grafik_industri = $cek['jml_industri'];
    $grafik_kb = $cek['jml_kb']; $grafik_rmh = $cek['jml_rmh']; $grafik_lahan = $cek['jml_lahan'];

    if (!empty($bangunanBaru) && !empty($luas_total) && !empty($penyebabBaru) {
        $insert = mysql_query("INSERT INTO pasca
            (`pasca_id`, `resiko_id`, `pasca_penyebab`,
             `pasca_luas`, `pasca_bangunan_add`, `pasca_luka`,
             `pasca_meninggal`, `pasca_biaya`) VALUES 
            NULL,'$pasca_id','$penyebab',
            '$luas_total','$bangunanBaru','$korban_luka',
            '$korban_meninggal','$biaya')") or die("Query : ".mysql_error());
        //=== R E SI K O ===
        $update = mysql_query("UPDATE resiko SET
                                resiko_id = '$pasca_id',
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
                                tipe_proteksi = '$proteksi',
                                resiko_status = 'yes'
                                WHERE resiko_id = '$pasca_id'") or die("Query : ".mysql_error());
        //=== PENYEBAB LAIN ===
        $id = mysql_fetch_assoc(mysql_query("SELECT pasca_id FROM pasca ORDER BY pasca_id DESC LIMIT 1")) or die ('Query Id terakhir : '.mysql_error());
        $id_pasca = $id['pasca_id'];
        $insert_pLain = mysql_query("INSERT INTO penyebab_lain (`lain_ID`, `pasca_id`, `penyebab_id`, `lain_TGL`, `lain_NAMA`) VALUES ('','$id_pasca','$penyebab','$tgl','$penyebabBaru')") or die("Query: ".mysql_error());

        //=== G R A F I K ===
        if($penyebab == '1'){
            $update_grafik = mysql_query("UPDATE grafik SET 
                            grafik_id='$grafik_id', grafik_bln = '$bln', grafik_thn = '$thn',
                            grafik_mpkp = '$grafik_mpkp', grafik_mpkl = '$grafik_mpkl', grafik_mpkbg = '$grafik_mpkbg',
                            grafik_luka = '$korban_luka', grafik_meninggal = '$korban_meninggal', 
                            grafik_bbm = '', grafik_kpr = '', grafik_lst = '', grafik_rk = '', grafik_lain = '',
                            grafik_perkantoran = '$grafik_perkantoran', grafik_udj = '$grafik_udj', 
                            grafik_industri = '$grafik_industri', grafik_kb = '$grafik_kb', 
                            grafik_rmh = '$grafik_rmh', grafik_lahan = '$grafik_lahan'
                            WHERE grafik_id='$grafik_id'") or die("Query: ".mysql_error());
        }
        $update_grafik = mysql_query("UPDATE grafik SET 
            grafik_id='$grafik_id', grafik_bln = '$bln', grafik_thn = '$thn',
            grafik_mpkp = '$grafik_mpkp', grafik_mpkl = '$grafik_mpkl', grafik_mpkbg = '$grafik_mpkbg',
            grafik_luka = '$korban_luka', grafik_meninggal = '$korban_meninggal', 
            grafik_bbm = '', grafik_kpr = '', grafik_lst = '', grafik_rk = '', grafik_lain = '',
            grafik_perkantoran = '$grafik_perkantoran', grafik_udj = '$grafik_udj', grafik_industri = '$grafik_industri', grafik_kb = '$grafik_kb', grafik_rmh = '$grafik_rmh', grafik_lahan = '$grafik_lahan'
            WHERE grafik_id='$grafik_id'") or die("Query: ".mysql_error());

        if($insert && $update){
            echo "Berhasil Update";
        }else{
            echo "Gagal Update";
        }

    }else {
        

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