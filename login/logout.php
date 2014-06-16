<?php

session_start(); //start session
//destroy session
session_destroy();

//unset cookies
setcookie("pegawai_nomor", $nip, time() - 7600, "/", "");

header("Location: ../beranda/index.php");
?>