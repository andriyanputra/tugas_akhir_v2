<?php
include '../../config/koneksi.php';

$sth = mysql_query("SELECT grafik_mpkp, grafik_mpkl, grafik_mpkbg FROM grafik");
$row1 = array();$row3 = array();
$row2 = array();
$row1['name'] = 'MPKP';$row3['name'] = 'MPKBG';
$row2['name'] = 'MPKL';
while($r = mysql_fetch_array($sth)) {
    $row1['data'][] = $r['grafik_mpkp'];
    $row2['data'][] = $r['grafik_mpkl'];
    $row3['data'][] = $r['grafik_mpkbg'];
}

/*$sth = mysql_query("SELECT overhead FROM projections_sample");
$rows1 = array();
$rows1['name'] = 'Overhead';
while($rr = mysql_fetch_assoc($sth)) {
    $rows1['data'][] = $rr['overhead'];
}*/

$result = array();
array_push($result,$row1);
array_push($result,$row2);
array_push($result,$row3);


print json_encode($result, JSON_NUMERIC_CHECK);
?>
