<?php

include ("../../config/koneksi.php");
	
    echo $_GET['hapusId'];
    mysql_query("DELETE FROM sumber_air WHERE ID_SUMBER = '".$_GET['hapusId']."'") or die("FAILED to Delete : ".  mysql_error());
	mysql_query("DELETE FROM sumber_air_kecamatan WHERE ID_SUMBER = '".$_GET['hapusId']."'") or die("FAILED to Delete : ".  mysql_error());
	mysql_query("DELETE FROM sumber_air_desa WHERE ID_SUMBER = '".$_GET['hapusId']."'") or die("FAILED to Delete : ".  mysql_error());
        

