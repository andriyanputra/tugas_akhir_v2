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
        //===Jika query dari cek, menghasilkan NULL record===
        if($cek['jml_mpkp'] == NULL && $cek['jml_mpkl'] == NULL && $cek['jml_mpkbg'] == NULL && $cek['jml_perkantoran'] == NULL && $cek['jml_udj'] == NULL && $cek['jml_industri'] == NULL && $cek['jml_kb'] == NULL && $cek['jml_rmh'] == NULL && $cek['jml_lahan'] == NULL){
            $cek['jml_perkantoran'] = '0'; $cek['jml_mpkp'] = '0'; $cek['jml_mpkl'] = '0'; $cek['jml_mpkbg'] = '0';
            $cek['jml_udj'] = '0'; $cek['jml_industri'] = '0'; $cek['jml_kb'] = '0'; $cek['jml_rmh'] = '0'; $cek['jml_lahan'] = '0';        
        }
        /*
        $jml_perkantoran = $cek['jml_perkantoran']; $jml_mpkp = $cek['jml_mpkp'];  
        $jml_udj = $cek['jml_udj'];                 $jml_mpkl = $cek['jml_mpkl'];
        $jml_industri = $cek['jml_industri'];       $jml_mpkbg = $cek['jml_mpkbg'];
        $jml_kb = $cek['jml_kb'];
        $jml_rmh = $cek['jml_rmh'];
        $jml_lahan = $cek['jml_lahan'];
        
        1 = perkantoran     4 = kb
        2 = udj             5 = rumah
        3 = industri        6 = lahan/sawah
        */
        $master_id = $row['ID_MASTER'];
        if($master_id == '1'){
            //echo "master id = 1 dan tipe proteksi = ".$tipe_proteksi;
            $jml_perkantoran = $cek['jml_perkantoran'] + 1;    
        }else if($master_id == '2'){
            //echo "master id = 2 dan tipe proteksi = ".$tipe_proteksi;
            $jml_udj = $cek['jml_udj'] + 1;
        }else if($master_id == '3'){
            //echo "master id = 3 dan tipe proteksi = ".$tipe_proteksi;
            $jml_industri = $cek['jml_industri'] + 1;
        }else if($master_id == '4'){
            //echo "master id = 4 dan tipe proteksi = ".$tipe_proteksi;
            $jml_kb = $cek['jml_kb'] + 1;
        }else if($master_id == '5'){
            //echo "master id = 5 dan tipe proteksi = ".$tipe_proteksi;
            $jml_rmh = $cek['jml_rmh'] + 1;
        }else if($master_id == '6'){
            $jml_lahan = $cek['jml_lahan'];
        }

        if($proteksi == 'MPKP'){
            $jml_mpkp = $cek['jml_mpkp']+1;    
        }else if($proteksi == 'MPKL'){
            $jml_mpkl = $cek['jml_mpkl']+1;
        }else if($proteksi == 'MPKBG'){
            $jml_mpkbg = $cek['jml_mpkbg']+1;
        }
        
        

    //=========GRAFIK========//
    $grafik = mysql_query("INSERT INTO `grafik`
                        (`grafik_id`, `grafik_bln`, `grafik_thn`, 
                        `grafik_mpkp`, `grafik_mpkl`, `grafik_mpkbg`, 
                        `grafik_luka`, `grafik_meninggal`, 
                        `grafik_bbm`, `grafik_kpr`, `grafik_lst`, `grafik_rk`, `grafik_lain`, 
                        `grafik_perkantoran`, `grafik_udj`, `grafik_industri`, `grafik_kb`, `grafik_rmh`, `grafik_lahan`) 
                        VALUES (
                        NULL,'$bln','$thn',
                        '$jml_mpkp','','',
                        '','',
                        '','','','','',
                        '','','','','','')") or die("Query : ".mysql_error());


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
        /*echo '1 <br/>';
        echo $cek['jml_mpkp'].' '.$cek['jml_mpkl'].' '.$cek['jml_mpkbg'].'<br/>';
        echo $cek['jml_perkantoran'].' '.$cek['jml_udj'].' '.$cek['jml_industri'].' '.$cek['jml_kb'].' '.$cek['jml_rmh'].' '.$cek['jml_lahan'];*/
        /*echo "2 <br/>";
        echo $cek['jml_mpkp'].' '.$cek['jml_mpkl'].' '.$cek['jml_mpkbg'].'<br/>';
        echo $cek['jml_perkantoran'].' '.$cek['jml_udj'].' '.$cek['jml_industri'].' '.$cek['jml_kb'].' '.$cek['jml_rmh'].' '.$cek['jml_lahan'];*/
        /*if(($master_id == '1' && $tipe_proteksi == 'MPKP') || ($master_id == '1' && $tipe_proteksi == 'MPKL') || ($master_id == '1' && $tipe_proteksi == 'MPKBG')){
            //echo "master id = 1 dan tipe proteksi = ".$tipe_proteksi;
            
        }else if(($master_id == '2' && $tipe_proteksi == 'MPKP') || ($master_id == '2' && $tipe_proteksi == 'MPKL') || ($master_id == '2' && $tipe_proteksi == 'MPKBG')){
            //echo "master id = 2 dan tipe proteksi = ".$tipe_proteksi;

        }else if(($master_id == '3' && $tipe_proteksi == 'MPKP') || ($master_id == '3' && $tipe_proteksi == 'MPKL') || ($master_id == '3' && $tipe_proteksi == 'MPKBG')){
            //echo "master id = 3 dan tipe proteksi = ".$tipe_proteksi;

        }else if(($master_id == '4' && $tipe_proteksi == 'MPKP') || ($master_id == '4' && $tipe_proteksi == 'MPKL') || ($master_id == '4' && $tipe_proteksi == 'MPKBG')){
            //echo "master id = 4 dan tipe proteksi = ".$tipe_proteksi;

        }else if(($master_id == '5' && $tipe_proteksi == 'MPKP') || ($master_id == '5' && $tipe_proteksi == 'MPKL') || ($master_id == '5' && $tipe_proteksi == 'MPKBG')){
            //echo "master id = 5 dan tipe proteksi = ".$tipe_proteksi;
            
        }*/

?>