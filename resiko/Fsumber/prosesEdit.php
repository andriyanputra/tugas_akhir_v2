<?php

include('../../config/config.php');

$nSumber = $_POST['nama_sumber'];
$lSumber1 = $_POST['lokasi_sumber1'];
$lSumber2 = $_POST['lokasi_sumber2'];
$lSumber3 = $_POST['lSumber'];
$ketSumber = $_POST['keterangan'];
$id = $_GET['id'];

if (empty($lSumber1) || empty($lSumber2)) {
    header('location:../sumberEdit.php?id='.$id.'&msg=error0');
}

