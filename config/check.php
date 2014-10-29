<?php

include 'functions.php';  //include the functions.php - very important

$nip = $_POST['nomor'];
$pass = md5($_POST['password']);
$remember = $_POST['remember'];


    $log = mysql_query("SELECT id_level_user, pegawai_password FROM pegawai WHERE pegawai_nip= '" . $nip . "'"); //select from the table users on the database, where the username is equal to the username on the table users
    if (mysql_num_rows($log)) {
        while ($row = mysql_fetch_assoc($log)) { // this method will prevent SQL Injections. This will gather the password on the same row as the username.
            $db_password = $row['pegawai_password']; //this will store that password on a variable
            $db_level = $row['id_level_user'];
            if ($pass == $db_password) {   //this will check if the password inputted by the user is the same as the one stored on the database.
                $loginok = TRUE;
            } else {
                 header('location:../login/login.php?msg=log_error01');
                exit();
            }
        }
        
    if ($loginok == TRUE) { //if it is the same password, script will continue.
        $update_log = mysql_query("UPDATE log_user SET login_date = NOW() WHERE pegawai_nip = '$nip'") or die("Query : ".mysql_error());
        if ($remember == "1") { //if the Remember me is checked, it will create a cookie.
            if($db_level == 2){
                setcookie("level", $db_level, time() + 7600, "/", "");
                setcookie("pegawai_nomor", $nip, time() + 7600, "/", ""); //here we are setting a cookie named username, with the Username on the database that will last 48 hours and will be set on the understandesign.com domain. This is an optional parameter.
                header("Location: ../beranda/index?msg=log_in&level=$db_level");
                exit();
            }else if($db_level == 3){
                setcookie("level", $db_level, time() + 7600, "/", "");
                setcookie("pegawai_nomor", $nip, time() + 7600, "/", "");
                header("Location: ../beranda/index?msg=log_in&level=$db_level");
                exit();
            }else if($db_level == 1){
                setcookie("level", $db_level, time() + 7600, "/", "");
                setcookie("pegawai_nomor", $nip, time() + 7600, "/", "");
                header("Location: ../beranda/index?msg=log_in&level=$db_level");
                exit();
            }
        } else if ($remember == "") { //if the Remember me isn't checked, it will create a session.
            if($db_level == 2){
                $_SESSION['pegawai_nomor'] = $nip;
                $_SESSION['level'] = $db_level;
                header("Location: ../beranda/index?msg=log_in&level=$db_level");
                exit();
            }else if($db_level == 3){
                $_SESSION['pegawai_nomor'] = $nip;
                $_SESSION['level'] = $db_level;
                header("Location: ../beranda/index?msg=log_in&level=$db_level");
                exit();
            }else if($db_level == 1){
                $_SESSION['pegawai_nomor'] = $nip;
                $_SESSION['level'] = $db_level;
                header("Location: ../beranda/index?msg=log_in&level=$db_level");
                exit();
            }
        }
    }

    } else {
        header('location:../login/login.php?msg=log_error01');
  } 
?>