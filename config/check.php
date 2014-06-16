<?php

include 'functions.php';  //include the functions.php - very important
include 'koneksi.php';  //include the functions.php - very important

if ($_POST['login']) { //check if the submit button is pressed
//get data
    $nip = $_POST['nomor'];
    $pass = md5($_POST['password']);
    $remember = $_POST['remember'];
    
    /*echo '"'.$nip.'"<br />';
    echo '"'.$pass.'"<br />';
    echo $remember;*/
    
    if ($nip && $pass) { //check if the field username and password have values
        $login = mysql_query("SELECT * FROM pegawai WHERE pegawai_nip= '" . $nip . "'"); //select from the table users on the database, where the username is equal to the username on the table users.

        if (mysql_num_rows($login)) {
            while ($row = mysql_fetch_assoc($login)) { // this method will prevent SQL Injections. This will gather the password on the same row as the username.
                $db_password = $row['pegawai_password']; //this will store that password on a variable
                if ($pass == $db_password) {   //this will check if the password inputted by the user is the same as the one stored on the database.
                    $loginok = TRUE;
                } else {
                    ?><script language="JavaScript">alert('Kombinasi Username dan Password salah..!!');
document.location='../login/login.php'</script><?php 
                    //header("Location: ../login/login.php");
                    exit();
                }

                if ($loginok == TRUE) { //if it is the same password, script will continue.
                    if ($remember == "1") { //if the Remember me is checked, it will create a cookie.
                        setcookie("pegawai_nomor", $nip, time() + 7600, "/", ""); //here we are setting a cookie named username, with the Username on the database that will last 48 hours and will be set on the understandesign.com domain. This is an optional parameter.

                        header("Location: ../beranda/index.php");
                        exit();
                    } else if ($remember == "") { //if the Remember me isn't checked, it will create a session.
                        $_SESSION['pegawai_nomor'] = $nip;

                        header("Location: ../beranda/index.php");
                        exit();
                    }
                }
            }
        } else {
            ?><script language="JavaScript">alert('Kombinasi Username dan Password salah..!!');
document.location='../login/login.php'</script><?php 
            //header("Location: ../login/login.php");
        }
    }
}
?>