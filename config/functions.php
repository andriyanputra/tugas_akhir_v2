<?php
if(!isset($_SESSION)){
session_start(); //start session
}
include 'config.php'; //include the config.php file

//login check function
function loggedin() {
    if ((isset($_SESSION['pegawai_nomor']) && isset($_SESSION['level'])) || (isset($_COOKIE['level']) && isset($_COOKIE['pegawai_nomor']))){
        $loggedin = TRUE;
        return $loggedin;
    }
}

//ganti password check function
function repass() {
    if (isset($_COOKIE['rePass'])) {
        $repass = TRUE;
        return $repass;
    }
}

function relock() {
    if (isset($_COOKIE['reLock'])) {
        $relock = TRUE;
        return $relock;
    }
}

?>