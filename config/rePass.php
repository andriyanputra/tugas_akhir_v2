<?php
include 'functions.php';

if ($_POST['submit']) {

    $renomor = $_POST['renomor'];

    $q = mysql_query("SELECT * FROM pegawai WHERE pegawai_nip= '" . $renomor . "'");
    if (mysql_num_rows($q) == 1) {
        while ($row = mysql_fetch_assoc($q)) {
            $db_nip = $row['pegawai_nip'];
            if ($renomor == $db_nip) {
                $loginok = TRUE;
            }
        }
    } else {
        ?><script language="JavaScript">alert('Nomor Induk Tidak ada..!!');
                        document.location = '../login/login.php'</script><?php
        //header("Location: ../login/login.php");
        exit();
    }

    if ($loginok == TRUE) { //if it is the same password, script will continue.
        setcookie("rePass", $renomor, time() + 450, "/", ""); //Set cookie selama 3 jam

        header("Location: ../login/ganti_password.php");
        exit();
    }
}
?>
