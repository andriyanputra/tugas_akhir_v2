<?php

include "../../config/koneksi.php";
$kec = $_POST['kecamatan'];
$desa = explode('|', $_POST['desa']);
$nama_tipe1 = $_POST['nama_tipe1'];
$nama_tipe2 = $_POST['nama_tipe2'];

if (empty($_POST['sumber_air'])) {
    header("location: ../analisis.php?msg=error1");
} else {
    $sumber_air = $_POST['sumber_air'];
}

$bangunan = mysql_query("SELECT ID_BANGUNAN FROM bangunan WHERE NAMA_BANGUNAN = '$nama_tipe1' OR NAMA_BANGUNAN = '$nama_tipe2'");
$air = mysql_query("SELECT ID_SUMBER FROM sumber_air WHERE NAMA_SUMBER = '$sumber_air'");
$desaID = mysql_query("SELECT DESA_ID FROM desa WHERE DESA_NAMA = '$desa[1]'");
if ($bangunan || $air || $desa) {
    $a = mysql_fetch_array($bangunan);
    $b = mysql_fetch_array($air);
    $c = mysql_fetch_array($desaID);
    $bangunan_id = $a['ID_BANGUNAN'];
    $air_id = $b['ID_SUMBER'];
    $desa_id = $c['DESA_ID'];
} else {
    echo 'Invalid query: ' . mysql_error();
}

$tepol = $_POST['tepol'];
$tipe_proteksi = $_POST['tipe_proteksi'];

if ($_POST['hasil1'] == 'NaN' || $_POST['hasil2'] == 'NaN') {
    $hasil1 = $_POST['hasil1_'];
    $hasil2 = $_POST['hasil2_'];
} else {
    $hasil1 = $_POST['hasil1'];
    $hasil2 = $_POST['hasil2'];
}

if ($_POST['exposure'] == '1') {
    $exposure = 'Tanpa resiko bangunan berdekatan.';
    $panjang1 = $_POST['panjang1'];
    $lebar1 = $_POST['lebar1'];
    $tinggi1 = $_POST['tinggi1'];
    if (!empty($_POST['nama_tipe_baru1']) && empty($_POST['nama_tipe1'])) {
        $nama_tipe_baru1 = $_POST['nama_tipe_baru1'];
        $nilai_tipe_baru1 = $_POST['nilai_tipe_baru1'];
        $cek1 = mysql_query("SELECT NAMA_BANGUNAN FROM bangunan WHERE NAMA_BANGUNAN = '$nama_tipe_baru1'");
        if ($cek1) {
            $d = mysql_fetch_array($cek1);
            if ($nama_tipe_baru1 == $d['NAMA_BANGUNAN']) {
                header("location: ../analisis.php?msg=error2");
            } else {
                $baru1 = mysql_query("INSERT INTO bangunan VALUES ('','$nama_tipe_baru1','$nilai_tipe_baru1','-')") or die('<META HTTP-EQUIV="Refresh" CONTENT="0;URL=../analisis.php?msg=error1">');
                $q1 = mysql_query("INSERT INTO resiko
                            VALUES
                            ('',
                            NOW(),
                            last_insert_id(), 
                            '$desa_id', 
                            '$kec', 
                            '$air_id', 
                            '$exposure', 
                            '$tepol', 
                            '$panjang1', 
                            '$lebar1', 
                            '$tinggi1', 
                            '$hasil1',
                            '',
                            '',
                            '$tipe_proteksi'
                            )") or die('<META HTTP-EQUIV="Refresh" CONTENT="0;URL=../analisis.php?msg=error1">');
                if ($q1 && $baru1) {
                    header("location: ../kebAir.php?kec=$kec&p=$panjang1&l=$lebar1&t=$tinggi1");
                }
            }
        } else {
            echo 'Invalid query: ' . mysql_error();
        }
    } else {
        $q_ = mysql_query("INSERT INTO resiko
                            VALUES
                            ('',
                            NOW(),
                            '$bangunan_id', 
                            '$desa_id', 
                            '$kec', 
                            '$air_id', 
                            '$exposure', 
                            '$tepol', 
                            '$panjang1', 
                            '$lebar1', 
                            '$tinggi1', 
                            '$hasil1',
                            '',
                            '',
                            '$tipe_proteksi'
                            )") or die('<META HTTP-EQUIV="Refresh" CONTENT="0;URL=../analisis.php?msg=error1">');
        if ($q_) {
            header("location: ../kebAir.php?kec=$kec&p=$panjang1&l=$lebar1&t=$tinggi1");
        }
    }
} else {
    $exposure = 'Dengan resiko bangunan berdekatan.';
    $panjang2 = $_POST['panjang2'];
    $lebar2 = $_POST['lebar2'];
    $tinggi2 = $_POST['tinggi2'];
    if (!empty($_POST['nama_tipe_baru2']) && empty($_POST['nama_tipe2'])) {
        $nama_tipe_baru2 = $_POST['nama_tipe_baru2'];
        $nilai_tipe_baru2 = $_POST['nilai_tipe_baru2'];
        $cek2 = mysql_query("SELECT NAMA_BANGUNAN FROM bangunan WHERE NAMA_BANGUNAN = '$nama_tipe_baru2'");
        if ($cek2) {
            $e = mysql_fetch_array($cek2);
            if ($nama_tipe_baru2 == $e['NAMA_BANGUNAN']) {
                header("location: ../analisis.php?msg=error2");
            } else {
                $baru2 = mysql_query("INSERT INTO bangunan VALUES ('','$nama_tipe_baru2','$nilai_tipe_baru2','-')") or die('<META HTTP-EQUIV="Refresh" CONTENT="0;URL=../analisis.php?msg=error1">');
                $q2 = mysql_query("INSERT INTO resiko
                            VALUES
                            ('',
                            NOW(),
                            last_insert_id(), 
                            '$desa_id', 
                            '$kec', 
                            '$air_id', 
                            '$exposure', 
                            '$tepol', 
                            '$panjang2', 
                            '$lebar2', 
                            '$tinggi2', 
                            '$hasil2',
                            '',
                            '',
                            '$tipe_proteksi'
                            )") or die('<META HTTP-EQUIV="Refresh" CONTENT="0;URL=../analisis.php?msg=error1">');
                if ($q2 && $baru2) {
                    header("location: ../kebAir.php?kec=$kec&p=$panjang2&l=$lebar2&t=$tinggi2");
                }
            }
        } else {
            echo 'Invalid query: ' . mysql_error();
        }
    } else {
        $q_2 = mysql_query("INSERT INTO resiko
                            VALUES
                            ('',
                            NOW(),
                            '$bangunan_id', 
                            '$desa_id', 
                            '$kec', 
                            '$air_id', 
                            '$exposure', 
                            '$tepol', 
                            '$panjang2', 
                            '$lebar2', 
                            '$tinggi2', 
                            '$hasil2',
                            '',
                            '',
                            '$tipe_proteksi'
                            )") or die('<META HTTP-EQUIV="Refresh" CONTENT="0;URL=../analisis.php?msg=error1">');
        if ($q_2) {
            header("location: ../kebAir.php?kec=$kec&p=$panjang2&l=$lebar2&t=$tinggi2");
        }
    }
}
?>