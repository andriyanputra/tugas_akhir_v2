<?php
	include '../config/koneksi.php';
	if(!empty($_POST["bulan"]) && !empty($_POST["tahun"])){
		$bulan=$_POST["bulan"];
		$tahun=$_POST["tahun"];
		 
		//echo $bulan.'-'.$tahun.'<br>'.$bulan_;
		if($bulan == 'Jan'){$bulan_ = '01';}else if($bulan == 'Feb'){$bulan_ = '02';}else if($bulan == 'Mar'){$bulan_ = '03';}
		else if($bulan == 'Apr'){$bulan_ = '04';}else if($bulan == 'Mei'){$bulan_ = '05';}else if($bulan == 'Jun'){$bulan_ = '06';}
		else if($bulan == 'Jul'){$bulan_ = '07';}else if($bulan == 'Agt'){$bulan_ = '08';}else if($bulan == 'Sep'){$bulan_ = '09';}
		else if($bulan = 'Okt'){$bulan_ = '10';}else if($bulan == 'Nov'){$bulan_ = '11';}else if($bulan == 'Des'){$bulan_ = '12';}
		
		 
		 $cek=mysql_query("SELECT * FROM resiko AS a INNER JOIN pasca AS b 
									ON (a.resiko_id = b.resiko_id)
									WHERE a.resiko_tanggal_start BETWEEN '$tahun-$bulan_-01' AND '$tahun-$bulan_-31'") or die("Query : ".mysql_error());
		 $result=mysql_query("SELECT COUNT(a.resiko_id) AS id, COUNT(a.ID_BANGUNAN) AS bangunan, SUM(b.pasca_luka) AS luka,
									SUM(b.pasca_meninggal) AS meninggal, SUM(b.pasca_biaya) AS biaya
									FROM resiko AS a INNER JOIN pasca AS b 
									ON (a.resiko_id = b.resiko_id)
									WHERE a.resiko_tanggal_start BETWEEN '$tahun-$bulan_-01' AND '$tahun-$bulan_-31'") or die("Query : ".mysql_error());
		 $found=mysql_num_rows($cek);
		 //echo $found;
		 if($found > 0){
		 	$no = 1;
		    while($row=mysql_fetch_array($result)){
		    	echo "<tr>";
			    	echo "<td>".$no++."</td>";
			    	echo "<td>".$bulan." ".$tahun."</td>";
			    	echo "<td>".$row['id']."</td>";
			    	echo "<td>".$row['bangunan']."</td>";
			    	echo "<td>".$row['luka']."</td>";
			    	echo "<td>".$row['meninggal']."</td>";
			    	echo "<td>Rp. ".number_format($row['biaya'],2,',','.')."</td>";
			    	echo "<td class='center'>
			    			<a href='#' title='Unduh File' data-rel='tooltip'>
			    				<i class='icon-file-text bigger-125'></i>	
							</a>
						</td>";
		    	echo "</tr>";
		    
		    }   
		 }else{
		 	echo "<tr><td colspan='8' class='center'>Tidak ada data yang ditemukan </td></tr>";
		 }
	}else if(!empty($_POST["bulan"])){
		$bulan=$_POST["bulan"];
		//echo $bulan.'-'.$tahun.'<br>'.$bulan_;
		if($bulan == 'Jan'){$bulan_ = '01';}else if($bulan == 'Feb'){$bulan_ = '02';}else if($bulan == 'Mar'){$bulan_ = '03';}
		else if($bulan == 'Apr'){$bulan_ = '04';}else if($bulan == 'Mei'){$bulan_ = '05';}else if($bulan == 'Jun'){$bulan_ = '06';}
		else if($bulan == 'Jul'){$bulan_ = '07';}else if($bulan == 'Agt'){$bulan_ = '08';}else if($bulan == 'Sep'){$bulan_ = '09';}
		else if($bulan = 'Okt'){$bulan_ = '10';}else if($bulan == 'Nov'){$bulan_ = '11';}else if($bulan == 'Des'){$bulan_ = '12';}


	}else if(!empty($_POST["tahun"])){
		$tahun=$_POST["tahun"];
		
		
	}
	

	 
	?>
	