<?php
	include ("../config/koneksi.php");
	if($_GET['nip']){

	mysql_query("DELETE FROM pegawai WHERE pegawai_nip = '".$_GET['nip']."'");

		header ("location:list.php");
	}else{
		die('Waduh Terjadi Kesalahan nih.. !!');
	}
?>