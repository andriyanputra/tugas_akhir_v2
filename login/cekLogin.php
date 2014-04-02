<?php
session_start();
include ("koneksi.php");
if (!$_SESSION['pegawai_nip'] && !$_SESSION['pegawai_password'] && !$_SESSION['pegawai_nama']){

$nip = $_POST['nip'];
$password = md5($_POST['pass']);


        $sql = mysql_query("SELECT * FROM pegawai WHERE pegawai_nip= '".$nip."' AND pegawai_password= '".$password."'");
        $tes = mysql_num_rows($sql);
            if ($tes == 1){
                $hasil = mysql_fetch_assoc($sql);
                $_SESSION['pegawai_nip'] = $hasil['pegawai_nip'];
                $_SESSION['pegawai_nama'] = $hasil['pegawai_nama'];
                $_SESSION['pegawai_password'] = $hasil['pegawai_password'];
                header("location:../index");
            }else{
                ?><script language="JavaScript">alert('Kombinasi Username dan Password salah..!!');
document.location='login'</script><?php 
            }

}else{
    header("location:login");
}
?>