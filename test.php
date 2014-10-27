<?php
$biaya_ = 'Rp. 5.000.000,00';
$biaya1 = str_replace('Rp.','',$biaya_);
$biaya2 = str_replace('.', '', $biaya1);
$biaya3 = str_replace(',', '', $biaya2);
$hasil = substr($biaya3,0,-2);
echo $biaya.'<br>';
echo $biaya1.'<br>';
echo $biaya2.'<br>';
echo $biaya3.'<br>';
echo $hasil;
?>
