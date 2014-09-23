<?php

include('../../config/config.php');


if ($_POST) {
    $kriteria = $_POST['kriteria'];
    $nama = $_POST['nama'];
    $tingkat = $_POST['tingkat'];
    $keterangan = $_POST['keterangan'];

    $check = mysql_query("SELECT NAMA_BANGUNAN FROM bangunan WHERE NAMA_BANGUNAN = '" . $nama . "'") or die('Error Query check: ' . mysql_error());
    $row = mysql_fetch_assoc($check);
    if ($row['NAMA_BANGUNAN'] == $nama) {
        header('location:../bangunanAdd.php?msg=error1');
    }else{
        $Query = mysql_query("INSERT INTO bangunan VALUES (NULL, '$kriteria', '$nama', '$tingkat', '$keterangan')");
        if($Query){
            header('location:../bangunan.php?msg=success');
        }else{
            die('<META HTTP-EQUIV="Refresh" CONTENT="0;URL=../bangunanAdd.php?msg=error1">');
        }
    }
}


?>