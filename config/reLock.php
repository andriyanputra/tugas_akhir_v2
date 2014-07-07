<?php

include 'functions.php';  //include the functions.php - very important
include 'koneksi.php';
    $lock = md5($_POST['lock']);
    
    //echo '"'.$nip.'"<br />';
    //echo '"'.$pass.'"<br />';
    //echo $lock;
    
    if ($lock) { //check if the field username and password have values
        $login = mysql_query("SELECT * FROM pegawai WHERE pegawai_password= '" . $lock . "'"); //select from the table users on the database, where the username is equal to the username on the table users.

        if (mysql_num_rows($login)) {
            while ($row = mysql_fetch_assoc($login)) { // this method will prevent SQL Injections. This will gather the password on the same row as the username.
                $db_password = $row['pegawai_password']; //this will store that password on a variable
                if ($lock == $db_password) {   //this will check if the password inputted by the user is the same as the one stored on the database.
                    
                    header("Location: ../beranda/index.php");
                    exit();
                } else {
                    ?><script language="JavaScript">alert('Maaf Password Anda salah..!!');
document.location='../beranda/index.php'</script><?php 
                    //header("Location: ../login/login.php");
                    exit();
                }
            }
        } else {
            ?><script language="JavaScript">alert('Maaf password Anda salah..!!');
document.location='../login/login.php'</script><?php 
            //header("Location: ../login/login.php");
        }
    }

?>