<?php
session_start();
include ("koneksi.php");
if (!$_SESSION['pegawai_nip'] && !$_SESSION['pegawai_password']){

$nip = $_POST['nip'];
$password = md5($_POST['pass']);
//untuk menentukan expire cookie, dihtung dri waktu server + waktu umur cookie
//$time = time();
//cek jika setcookie di cek set cookie jika tidak ''
//$check = isset($_POST['setcookie'])?$_POST['setcookie']:'';

        $sql = mysql_query("SELECT * FROM pegawai WHERE pegawai_nip= '".$nip."' AND pegawai_password= '".$password."'");
        $tes = mysql_num_rows($sql);
            if ($tes == 1){
                $hasil = mysql_fetch_assoc($sql);
                $_SESSION['pegawai_nip'] = $hasil['pegawai_nip'];
                $_SESSION['pegawai_password'] = $hasil['pegawai_password'];
                /*$_SESSION['logged'] = 1;
                if($check)
                {
                    setcookie("cookielogin[nip]",$nip, $time + 3600);
                    setcookie("cookielogin[pass]",$password, $time + 3600);
                }*/
                header("location:../beranda/index");
               
            }else{
                ?><script language="JavaScript">alert('Kombinasi Username dan Password salah..!!');
document.location='login'</script><?php 
            }

}else{
    header("location:login");
    
}
?>