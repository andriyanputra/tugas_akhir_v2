<?php

include ("../../config/koneksi.php");
	
    echo $_GET['id'];
    $a = mysql_query("DELETE FROM sumber_air WHERE ID_SUMBER = '".$_GET['id']."'") or die("FAILED to Delete : ".  mysql_error());
	$b = mysql_query("DELETE FROM sumber_air_kecamatan WHERE ID_SUMBER = '".$_GET['id']."'") or die("FAILED to Delete : ".  mysql_error());
	$c = mysql_query("DELETE FROM sumber_air_desa WHERE ID_SUMBER = '".$_GET['id']."'") or die("FAILED to Delete : ".  mysql_error());
    if($a && $b && $c){
    	header('Location: ../sumber.php?msg=success_delete');  	
    }
    

