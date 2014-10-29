<?php
include ("../config/koneksi.php");
date_default_timezone_set('Asia/Jakarta');
session_start(); //start session
//destroy session
//session_destroy();
session_destroy();
$_SESSION = array();

//unset cookies
setcookie("pegawai_nomor", $nip, time() - 7600, "/", "");
setcookie("level", $db_level, time() - 7600, "/", "");
$out = date("Y-m-d H:i:s");
$nip = $_GET['nip'];
$update_log = mysql_query("UPDATE log_user SET logout_date = '$out' WHERE pegawai_nip = '$nip'") or die("Query : ".mysql_error());
header("Location: ../beranda/index.php");
?>