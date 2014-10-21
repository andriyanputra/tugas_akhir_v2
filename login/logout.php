<?php
include ("../config/koneksi.php");

session_start(); //start session
//destroy session
session_destroy();

//unset cookies
setcookie("pegawai_nomor", $nip, time() - 7600, "/", "");
$out = date("Y-m-d h:m:s");
$nip = $_GET['nip'];
$update_log = mysql_query("UPDATE log_user SET logout_date = '$out' WHERE pegawai_nip = '$nip'") or die("Query : ".mysql_error());
header("Location: ../beranda/index.php");
?>