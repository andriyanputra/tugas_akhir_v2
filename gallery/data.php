<?php
	include '../config/koneksi.php';
	$bulan=$_POST["bulan"];
	$tahun=$_POST["tahun"];
	 
	//echo $bulan.'-'.$tahun.'<br>'.$bulan_;
	if($bulan == 'Jan'){$bulan_ = '01';}else if($bulan == 'Feb'){$bulan_ = '02';}else if($bulan == 'Mar'){$bulan_ = '03';}
	else if($bulan == 'Apr'){$bulan_ = '04';}else if($bulan == 'Mei'){$bulan_ = '05';}else if($bulan == 'Jun'){$bulan_ = '06';}
	else if($bulan == 'Jul'){$bulan_ = '07';}else if($bulan == 'Agt'){$bulan_ = '08';}else if($bulan == 'Sep'){$bulan_ = '09';}
	else if($bulan = 'Okt'){$bulan_ = '10';}else if($bulan == 'Nov'){$bulan_ = '11';}else if($bulan == 'Des'){$bulan_ = '12';}
	
	 
	 $cek=mysql_query("SELECT a.resiko_id AS id, b.foto_nama, b.foto_dir FROM resiko AS a 
						INNER JOIN foto_resiko AS b ON (a.resiko_id = b.resiko_id)
						WHERE a.resiko_tanggal_start BETWEEN '$tahun-$bulan_-01' AND '$tahun-$bulan_-31'") or die("Query : ".mysql_error());
	 $result=mysql_query("SELECT a.resiko_id AS id, b.foto_nama, b.foto_dir FROM resiko AS a 
						INNER JOIN foto_resiko AS b ON (a.resiko_id = b.resiko_id)
						WHERE a.resiko_tanggal_start BETWEEN '$tahun-$bulan_-01' AND '$tahun-$bulan_-31'") or die("Query : ".mysql_error());
	 $found=mysql_num_rows($cek);
	 //echo $found;
	 if($found > 0){
	    while($row=mysql_fetch_array($result)){
	    	echo "<li>";
	    	echo "<a data-rel='colorbox' title='$row[foto_nama]' href='../assets/img/foto-kejadian/$row[foto_dir]'>";
	    	echo "<img src='../assets/img/foto-kejadian/$row[foto_dir]' width='150' height='150'/>";
			echo "</li>";
	    } 
	 }else{
	 	echo "<li>Tidak ada data yang ditemukan </li>";
	 }

	 
	?>