<?php

include('../../config/config.php');

$nSumber = $_POST['nama_sumber'];
$lSumber = $_POST['lokasi_sumber'];
$ketSumber = $_POST['keterangan'];

if (empty($lSumber)) {
    header('location:../sumberTambah.php?msg=error0');
}else{
    $check = mysql_query("SELECT NAMA_SUMBER FROM sumber_air WHERE NAMA_SUMBER = '" . $nSumber . "'") or die('Error Query tambah: ' . mysql_error());
    $row = mysql_fetch_assoc($check);
    if ($row['NAMA_SUMBER'] == $nSumber) {
        header('location:../sumberTambah.php?msg=error1');
    } else {
        $query = mysql_query("INSERT INTO sumber_air (NAMA_SUMBER, KET_SUMBER) VALUES ('" . $nSumber . "','" . $ketSumber . "')")or die('Error Query : ' . mysql_error());
        $sumber_id = mysql_insert_id();
        if (!empty($lSumber)) {
            foreach ($lSumber AS $lokasi) {
                mysql_query("INSERT INTO sumber_air_kecamatan VALUES ('" . $sumber_id . "', '" . $lokasi . "')");
            }
            header('Location: ../sumber.php?msg=success');
        }
    }
}
?>
