<?php
mysql_pconnect("localhost", "root", "") or die("Could not connect");
mysql_select_db("calendar") or die("Could not select database");


$rs = mysql_query("SELECT * FROM versi2 ORDER BY start ASC");
$arr = array();

while($obj = mysql_fetch_object($rs)) {
$arr[] = $obj;
}
echo json_encode($arr);
?>