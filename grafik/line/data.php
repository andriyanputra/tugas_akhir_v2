
<?php
include '../../config/koneksi.php';

$sth = mysql_query("SELECT grafik_mpkp, grafik_mpkl, grafik_mpkbg FROM grafik WHERE grafik_thn = 2011");
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

//$arr = array(name=> 'Tokyo',data=> "49.9, 71.5, 106.4, 129.2, 144.0, 176.0, 135.6, 148.5, 216.4, 194.1, 95.6, 54.4");
print json_encode($result, JSON_NUMERIC_CHECK);
//print json_encode($arr, JSON_NUMERIC_CHECK);

?>