<?php

include ("../../config/koneksi.php");
	
    echo $_GET['hapusId'];
    mysql_query("DELETE FROM bangunan WHERE ID_BANGUNAN = '".$_GET['hapusId']."'") or die("FAILED to Delete : ".  mysql_error());
	

