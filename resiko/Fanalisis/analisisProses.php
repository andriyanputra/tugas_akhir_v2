<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$kec = $_POST['kecamatan'];
$desa = $_POST['desa'];
$exposure = $_POST['exposure'];

$panjang = $_POST['panjang'];
$lebar = $_POST['lebar'];
$tinggi = $_POST['tinggi'];

$angka_klasifikasi = $_POST['angka'];
$faktor_konstruksi = $_POST['faktor-konstruksi'];
$faktor_bahaya = $_POST['faktor-bahaya'];

$hasil = $panjang * $lebar * $tinggi / $angka_klasifikasi * $faktor_konstruksi;
$english_format_number = number_format($hasil, 2, '.', '');
echo $kec;
echo '<br />';
echo $desa;
echo '<br />';
echo $exposure;
echo '<br />';
echo $panjang;
echo $lebar;
echo $tinggi;
echo '<br />';
echo $angka_klasifikasi;
echo '<br />';
echo $faktor_konstruksi;
echo '<br />';
echo $faktor_bahaya;
echo '<br />';
echo $hasil;
echo '<br />';
echo $english_format_number;

?>
