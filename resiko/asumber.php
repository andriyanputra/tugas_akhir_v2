<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

include('../config/config.php');

$kec_sumber = $_GET['sumber'];

$q = "SELECT
    KECAMATAN_ID
    , NAMA_SUMBER
FROM
    sumber_air AS a
    INNER JOIN sumber_air_kecamatan AS b
        ON (a.ID_SUMBER = b.ID_SUMBER)
        WHERE KECAMATAN_ID =$kec_sumber";
$jadi =  mysql_query($q) or die("Query failed: " . mysql_error());

while($w = mysql_fetch_array($jadi)) {
    echo "<option value=$w[KECAMATAN_ID]>$w[NAMA_SUMBER]</option>";
}

?>