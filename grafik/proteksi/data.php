
<?php
include '../../config/koneksi.php';

$sth1 = mysql_fetch_assoc(mysql_query("SELECT jumlah_kejadian FROM grafik_kebakaran WHERE tahun = 2009"));
$sth1_ = mysql_fetch_assoc(mysql_query("SELECT jumlah_kejadian FROM grafik_kebakaran WHERE tahun = 2010"));
$sth2 = mysql_fetch_assoc(mysql_query("SELECT SUM(grafik_nilai) AS jumlah FROM grafik_bangunan WHERE grafik_tahun = 2011"));
$sth3 = mysql_fetch_assoc(mysql_query("SELECT SUM(grafik_nilai) AS jumlah FROM grafik_bangunan WHERE grafik_tahun = 2012"));
$sth4 = mysql_fetch_assoc(mysql_query("SELECT COUNT(resiko_id) AS jumlah FROM resiko
					WHERE resiko_tanggal_start BETWEEN '2013-01-01' AND '2013-12-31'"));
$sth5 = mysql_fetch_assoc(mysql_query("SELECT COUNT(resiko_id) AS jumlah FROM resiko
					WHERE resiko_tanggal_start BETWEEN '2014-01-01' AND '2014-12-31'"));
$sth6 = mysql_fetch_assoc(mysql_query("SELECT COUNT(resiko_id) AS jumlah FROM resiko
					WHERE resiko_tanggal_start BETWEEN '2015-01-01' AND '2015-12-31'"));
$row1 = array();$row3 = array();$row5 = array();$row7 = array();
$row2 = array();$row4 = array();$row6 = array();
$row1['name'] = '2009';$row3['name'] = '2011';$row5['name'] = '2013';$row7['name'] = '2015';
$row2['name'] = '2010';$row4['name'] = '2012';$row6['name'] = '2014';

    $row1['data'][] = $sth1['jumlah_kejadian'];
    $row2['data'][] = $sth1_['jumlah_kejadian'];
    $row3['data'][] = $sth2['jumlah'];
    $row4['data'][] = $sth3['jumlah'];
    $row5['data'][] = $sth4['jumlah'];
    $row6['data'][] = $sth5['jumlah'];
    $row7['data'][] = $sth6['jumlah'];

$result = array();
array_push($result,$row1);
array_push($result,$row2);
array_push($result,$row3);
array_push($result,$row4);
array_push($result,$row5);
array_push($result,$row6);
array_push($result,$row7);
//$arr = array(name=> 'Tokyo',data=> "49.9, 71.5, 106.4, 129.2, 144.0, 176.0, 135.6, 148.5, 216.4, 194.1, 95.6, 54.4");
print json_encode($result, JSON_NUMERIC_CHECK);
//print json_encode($arr, JSON_NUMERIC_CHECK);

?>