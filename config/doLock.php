<?php
include 'functions.php';

$nomor = $_SESSION['pegawai_nomor'];

$q = mysql_query("SELECT * FROM pegawai WHERE pegawai_nip= '" . $nomor . "'");
    if (mysql_num_rows($q) == 1) {
        while ($row = mysql_fetch_assoc($q)) {
            $db_nip = $row['pegawai_nip'];
            if ($nomor == $db_nip) {
                $loginok = TRUE;
            }
        }
    } else {
        header("Location: ../login/login.php");
        exit();
    }

    if ($loginok == TRUE) { //if it is the same password, script will continue.
        setcookie("reLock", $nomor, time() + 450, "/", ""); //Set cookie selama 3 jam

        header("Location: ../login/lock.php");
        exit();
    }

?>
