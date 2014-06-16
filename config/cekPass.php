<?php
include 'functions.php';

if ($_POST['submit']) {
    $pass_lama = md5($_POST['pass_lama']);
    $pass_baru = md5($_POST['pass_baru']);

    $qry = mysql_query("SELECT * FROM pegawai WHERE pegawai_nip ='" . $_COOKIE['rePass'] . "'");
    if (mysql_num_rows($qry) == 1) {
        while ($r = mysql_fetch_assoc($qry)) {
            $db_pass_lama = $r['pegawai_password'];
        }
        if ($pass_lama == $db_pass_lama) {
            $rePass = TRUE;
        }
    } else {
        ?><script language="JavaScript">alert('Maaf password yang Anda masukkan tidak sesuai database!!');
                document.location = '../login/login.php'</script><?php
        //header("Location: ../login/login.php");
        exit();
    }

    if ($rePass == TRUE) {
        $update = mysql_query("UPDATE pegawai set pegawai_password ='" . $pass_baru . "' WHERE pegawai_nip = '" . $_COOKIE['rePass'] . "'");
        if ($update) {
            ?><script language="JavaScript">alert('Password Anda berhasil diupdate!!');
                        document.location = '../login/login.php'</script><?php
            exit();
        } else {
            ?><script language="JavaScript">alert('Maaf, password Anda gagal diupdate!!');
                        document.location = '../login/login.php'</script><?php
            exit();
        }
    }
}
?>
