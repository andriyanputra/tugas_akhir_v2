<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

include('../config/config.php');

$kecamatan = $_GET['kecamatan'];


$b = "SELECT desa.DESA_NAMA, kecamatan.KECAMATAN_ID FROM desa 
INNER JOIN tugas_akhir.kecamatan 
ON (desa.KECAMATAN_ID = kecamatan.KECAMATAN_ID)WHERE kecamatan.KECAMATAN_ID = $kecamatan";
$hasil =  mysql_query($b) or die("Query failed: " . mysql_error());

while($w = mysql_fetch_array($hasil)) {
    echo "<option value=$w[KECAMATAN_ID] selected=selected>$w[DESA_NAMA]</option>";
}

?>
