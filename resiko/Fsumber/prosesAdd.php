<?php

include('../../config/config.php');

$nSumber = $_POST['nama_sumber'];
$lSumber = $_POST['lokasi_sumber'];
$desa = explode('|', $_POST['desa']);
$desaID = mysql_query("SELECT DESA_ID FROM desa WHERE DESA_NAMA = '$desa[1]'");
$c = mysql_fetch_array($desaID); $id_desa = $c['DESA_ID'];
$ketSumber = $_POST['keterangan'];
$lat = $_POST['lat'];
$long = $_POST['long_'];

if (empty($lSumber)) {
    header('location:../sumberTambah.php?msg=error0');
} else {
    $check = mysql_query("SELECT NAMA_SUMBER FROM sumber_air WHERE NAMA_SUMBER = '" . $nSumber . "'") or die('Error Query tambah: ' . mysql_error());
    $row = mysql_fetch_assoc($check);
    if ($row['NAMA_SUMBER'] == $nSumber) {
        header('location:../sumberTambah.php?msg=error1');
    } else {
        $query = mysql_query("INSERT INTO sumber_air (NAMA_SUMBER, KET_SUMBER) VALUES ('" . $nSumber . "','" . $ketSumber . "')")or die('Error Query : ' . mysql_error());
        $sumber_id = mysql_insert_id();
        mysql_query("INSERT INTO sumber_air_kecamatan VALUES (NULL,'$sumber_id', '$lSumber', '$lat', '$long')") or die('Error Query : ' . mysql_error());;
        mysql_query("INSERT INTO sumber_air_desa VALUES (NULL,'$sumber_id', '$id_desa')") or die('Error Query : ' . mysql_error());;
        header('Location: ../sumber.php?msg=success');
    }
}
?>
