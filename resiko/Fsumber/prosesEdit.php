<?php

include('../../config/config.php');
if ($_POST) {
    $sumber_id = $_POST['id_sumber'];
    $nSumber = $_POST['nama_sumber'];
    $lokasi1 = $_POST['kec_nama1'];
    $lokasi2 = $_POST['kec_nama2'];
    $desa = $_POST['desa'];
    $lokasi_id = $_POST['kec_id'];
    $ketSumber = $_POST['keterangan'];
    
    $query_desa = mysql_query("SELECT DESA_ID FROM desa WHERE DESA_NAMA = '" . $desa . "'") or die("Query failed: " . mysql_error());
    $r = mysql_fetch_assoc($query_desa);
    $query_kec = mysql_query("SELECT KECAMATAN_ID FROM kecamatan WHERE KECAMATAN_NAMA = '" . $lokasi1 . "'") or die("Query failed: " . mysql_error());
    $d = mysql_fetch_assoc($query_kec);
    $query_sumber_kec = mysql_query("SELECT ID_SAK, Lat, Long_ FROM sumber_air_kecamatan WHERE ID_SUMBER = '$sumber_id'") or die("Query failed: " . mysql_error());
    $a = mysql_fetch_assoc($query_sumber_kec);
    $query_sumber_desa = mysql_query("SELECT ID_SAD FROM sumber_air_desa WHERE ID_SUMBER = '$sumber_id'") or die("Query failed: " . mysql_error());
    $b = mysql_fetch_assoc($query_sumber_desa);
    $desa_id = $r['DESA_ID'];
    $kec_id = $d['KECAMATAN_ID'];
    $sumber_kec_id = $a['ID_SAK'];
    $lat = $a['Lat'];$long = $a['Long_'];
    if($_POST['lat'] != $lat && $_POST['long_'] != $long){
        header('Location: ../sumberEdit?id=$sumber_id&msg=error_edit');
    }

    $sumber_desa_id = $b['ID_SAD'];
    /*echo 'ID Sumber: '.$sumber_id.'<br/>';
    echo 'Nama Sumber: '.$nSumber.'<br/>';
    echo 'Lokasi Sumber: '.$lokasi1.' '. $d['KECAMATAN_ID'].'<br/>';
    echo 'Lokasi Sumber Baru: '.$lBaru.'<br/>';
    echo 'Lokasi desa: '.$r['DESA_ID'].'<br/>';
    echo 'Keterangan Sumber: '.$ketSumber.'<br/>';*/

    if($sumber_id > 19){
            $update_sumber = mysql_query("UPDATE sumber_air SET
                                    ID_SUMBER = '$sumber_id',
                                    NAMA_SUMBER = '$nSumber',
                                    KET_SUMBER = '$ketSumber'
                                    WHERE ID_SUMBER = '$sumber_id'") or die(mysql_error());
            $update_air_kec = mysql_query("UPDATE sumber_air_kecamatan SET 
                                    ID_SAK = '$sumber_kec_id',
                                    ID_SUMBER = '$sumber_id',
                                    KECAMATAN_ID = '$kec_id',
                                    Lat = '$lat', Long_ = '$long'
                                    WHERE ID_SAK = '$sumber_kec_id'") or die(mysql_error());
            $update_air_desa = mysql_query("UPDATE sumber_air_desa SET 
                                    ID_SAD = '$sumber_desa_id',
                                    ID_SUMBER = '$sumber_id',
                                    DESA_ID = '$desa_id'
                                    WHERE ID_SAD = '$sumber_desa_id'") or die(mysql_error());
            if($update_sumber && $update_air_kec && $update_air_desa){
                header('Location: ../sumber.php?msg=success_edit');
            }
            //header("Location: ../sumber.php?msg=notif1");
        
    }else{
            $update_sumber = mysql_query("UPDATE sumber_air SET
                                    ID_SUMBER = '$sumber_id',
                                    NAMA_SUMBER = '$nSumber',
                                    KET_SUMBER = '$ketSumber'
                                    WHERE ID_SUMBER = '$sumber_id'") or die(mysql_error());
            /*$update_air_kec = mysql_query("UPDATE sumber_air_kecamatan SET 
                                    ID_SAK = '$sumber_kec_id',
                                    ID_SUMBER = '$sumber_id ',
                                    KECAMATAN_ID = '$kec_id'
                                    WHERE ID_SAK = '$sumber_kec_id'") or die(mysql_error());
            $update_air_desa = mysql_query("UPDATE sumber_air_desa SET 
                                    ID_SAD = '$sumber_kec_id',
                                    ID_SUMBER = '$sumber_id',
                                    DESA_ID = '$desa_id'
                                    WHERE ID_SAK = '$sumber_desa_id'") or die(mysql_error());*/
            if($update_sumber){
                header('Location: ../sumber.php?msg=success_edit');
            }  //else {
                //echo "Tidak berhasil";
                //die('<META HTTP-EQUIV="Refresh" CONTENT="0;URL=../analisis.php?msg=error1">');
            //}
            //header("Location: ../sumber.php?msg=notif1");
        
    }
}



//$lokasi_string = implode(', ', $_POST['lBaru']);
//$sql = '
//            INSERT INTO
//                `my_table` (
//                    `shopID`,
//                    `cars`
//                )
//            VALUES (
//                ' . $_POST['shopID'] . ',
//                "' . $cars_string . '"
//            )
//        ';
//mysql_query($sql) OR die(mysql_error());


//$qnama = mysql_query("SELECT NAMA_SUMBER, KET_SUMBER FROM sumber_air WHERE NAMA_SUMBER = '" . $nSumber . "'") or die("Query failed: " . mysql_error());
/* $qlokasi = mysql_query("SELECT GROUP_CONCAT(kecamatan.KECAMATAN_ID SEPARATOR ', ') AS id, GROUP_CONCAT(kecamatan.KECAMATAN_NAMA SEPARATOR ', ') AS Kecamatan
  FROM sumber_air a
  JOIN sumber_air_kecamatan ON a.ID_SUMBER=sumber_air_kecamatan.ID_SUMBER
  JOIN kecamatan ON sumber_air_kecamatan.KECAMATAN_ID=kecamatan.KECAMATAN_ID
  WHERE a.ID_SUMBER = '" . $id_sumber . "' ") or die("Query failed: " . mysql_error()); */
//$a = mysql_fetch_array($qlokasi);
?>