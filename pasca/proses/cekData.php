<?php

include ("../../config/koneksi.php");
	
    if ($_GET) {
    	$cek = "SELECT * FROM resiko WHERE resiko_id = '".$_GET['cek']."'";
    	$query = mysql_query($cek);
        $row = mysql_fetch_array($query);
        $status = $row['resiko_status'];
	    if($status == 'no'){
	    	echo 0;
	    }else{
	    	echo 1;
	    }
    } else {
        die("FAILED to Delete : ".  mysql_error());
    }


