<?php

session_start(); //start session

include 'config.php'; //include the config.php file

//login chech function
function loggedin() {
    if (isset($_SESSION['pegawai_nomor']) || isset($_COOKIE['pegawai_nomor'])) {
        $loggedin = TRUE;
        return $loggedin;
    }
}

//ganti password chech function
function repass() {
    if (isset($_COOKIE['rePass'])) {
        $repass = TRUE;
        return $repass;
    }
}

?>