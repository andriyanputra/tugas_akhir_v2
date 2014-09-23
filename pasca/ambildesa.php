<?php
include ("../config/koneksi.php");
$kecamatan = $_GET['kec'];
$query_desa = mysql_query("SELECT * FROM desa WHERE KECAMATAN_ID = '$kecamatan' order by DESA_NAMA") or die(mysql_error());
echo "<option>-- Pilih Desa --</option>";
while ($k = mysql_fetch_array($query_desa)) {
    echo "<option value=\"" . $k['DESA_ID'] . "\">" . $k['DESA_NAMA'] . "</option>\n";
}

/*$kecamatan = $_GET['kec'];


$hasil = mysql_query("SELECT * FROM desa WHERE KECAMATAN_ID = '$kecamatan' order by DESA_NAMA") or die(mysql_error());

while($w = mysql_fetch_array($hasil)) {
    echo "<option value=$w[DESA_ID]>$w[DESA_NAMA]</option>";
}*/
?>