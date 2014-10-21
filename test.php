<?php
include 'config/koneksi.php';
$cek_log = mysql_query("SELECT a.pegawai_nama, b.login_date
                        FROM pegawai AS a INNER JOIN log_user AS b
                        ON (a.pegawai_nip = b.pegawai_nip)
                        WHERE a.pegawai_nip = '115623003'") or die("Query : ".mysql_error());
$cek = mysql_fetch_assoc($cek_log);
$cek_nama = $cek['pegawai_nama'];
$cek_log_date = $cek['login_date'];



function datediff($tgl1, $tgl2){
    $tgl1 = (is_string($tgl1) ? strtotime($tgl1) : $tgl1);
    $tgl2 = (is_string($tgl2) ? strtotime($tgl2) : $tgl2);
    $diff_secs = abs($tgl1 - $tgl2);
    $base_year = min(date("Y", $tgl1), date("Y", $tgl2));
    $diff = mktime(0, 0, $diff_secs, 1, 1, $base_year);
    return array( "years" => date("Y", $diff) - $base_year,
    "months_total" => (date("Y", $diff) - $base_year) * 12 + date("n", $diff) - 1,
    "months" => date("n", $diff) - 1,
    "days_total" => floor($diff_secs / (3600 * 24)),
    "days" => date("j", $diff) - 1,
    "hours_total" => floor($diff_secs / 3600),
    "hours" => date("G", $diff),
    "minutes_total" => floor($diff_secs / 60),
    "minutes" => (int) date("i", $diff),
    "seconds_total" => $diff_secs,
    "seconds" => (int) date("s", $diff)  );
 }

$a = datediff($cek_log_date, date("Y/m/d/ h:m:s"));
 
echo ''.$a[years].'tahun, '.$a[months].'bulan, '.$a[days].'hari, '.$a[hours].' jam, '.$a[minutes].' menit, '.$a[seconds].' detik';


$hari = date('l', strtotime($cek_log_date));
                                                            if($hari == 'Sunday')$hari = 'Minggu';else if($hari == 'Monday')$hari = 'Senin';
                                                            else if($hari == 'Tuesday')$hari = 'Selasa';else if($hari == 'Wednesday')$hari = 'Rabu';
                                                            else if($hari == 'Thursday')$hari = 'Kamis';else if($hari == 'Friday')$hari = 'Jumat';
                                                            else if($hari == 'Saturday')$hari = 'Sabtu';
                                                            $bln = date('F', strtotime($cek_log_date));
                                                            if($bln == 'January')$bln = 'Jan';else if($bln == 'February')$bln = 'Feb';
                                                            else if($bln == 'March')$bln = 'Mar';else if($bln == 'April')$bln = 'Apr';
                                                            else if($bln == 'May')$bln = 'Mei';else if($bln == 'June')$bln = 'Jun';
                                                            else if($bln == 'July')$bln = 'Jul';else if($bln == 'August')$bln = 'Agt';
                                                            else if($bln == 'September')$bln = 'Sep';else if($bln == 'October')$bln = 'Okt';
                                                            else if($bln == 'November')$bln = 'Nov';else if($bln == 'December')$bln = 'Des';
                                                            $thn = date('Y', strtotime($cek_log_date));
?>

