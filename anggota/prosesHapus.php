<?php

include ("../config/koneksi.php");
if ($_GET['nip']) {
    $row = mysql_fetch_array(mysql_query("select * from pegawai where pegawai_nip='" . $_GET['nip'] . "'"));
    $photo = $row['pegawai_foto'];
    $query = mysql_query("DELETE FROM pegawai WHERE pegawai_nip = '" . $_GET['nip'] . "'");
      if($query){
      $nama_file = "../assets/img/img-anggota/".$photo;
      unlink($nama_file);
      header("location:list.php?msg=success3");
      }
} else {
    header("location:list.php?msg=error") or die('Waduh Terjadi Kesalahan nih.. !!');
}
?>