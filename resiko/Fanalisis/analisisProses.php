<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$kec = $_POST['kecamatan'];
$desa = $_POST['desa'];
$exposure = $_POST['exposure'];
$sumber_air = $_POST['sumber_air'];

$hasil1 = $_POST['hasil1'] ;
$hasil2 = $_POST['hasil2'];

//$english_hasil1 = number_format($hasil1, 2, '.', '');
//$english_hasil2 = number_format($hasil2, 2, '.', '');

echo 'Kecamatan:'.$kec;
echo '<br />';
echo 'Desa:'.$desa;
echo '<br />';
echo 'faktor exposure:'.$exposure;
echo '<br />';
echo 'sumber air:'.$sumber_air;
echo '<br />';
echo 'Hasil 1 :'.$hasil1;
echo '<br />';
echo 'Hasil 2:'.$hasil2;

?>
