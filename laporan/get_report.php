<?php

include '../config/koneksi.php';
if ($_POST) {
    $tahun = $_POST["tahun"];
    $bulan = $_POST["bulan"];
    //echo $tahun;
    if(!empty($bulan) && !empty($tahun)){
		//echo $bulan.'-'.$tahun.'<br>'.$bulan_;
		if($bulan == 'Jan'){$bulan_ = '01';}else if($bulan == 'Feb'){$bulan_ = '02';}else if($bulan == 'Mar'){$bulan_ = '03';}
		else if($bulan == 'Apr'){$bulan_ = '04';}else if($bulan == 'Mei'){$bulan_ = '05';}else if($bulan == 'Jun'){$bulan_ = '06';}
		else if($bulan == 'Jul'){$bulan_ = '07';}else if($bulan == 'Agt'){$bulan_ = '08';}else if($bulan == 'Sep'){$bulan_ = '09';}
		else if($bulan = 'Okt'){$bulan_ = '10';}else if($bulan == 'Nov'){$bulan_ = '11';}else if($bulan == 'Des'){$bulan_ = '12';}
    	
    	if($tahun == '2011' || $tahun == '2012'){
    		$hasil = mysql_query("SELECT SUM(grafik_industri)+SUM(grafik_perkantoran)+SUM(grafik_udj)+
						SUM(grafik_kb)+ SUM(grafik_rumah)+SUM(grafik_lahan) AS jumlah, 
						SUM(grafik_industri) AS Industri, SUM(grafik_perkantoran) AS Perkantoran,
						SUM(grafik_udj) AS UDJ, SUM(grafik_kb) AS Kendaraan, SUM(grafik_rumah) AS Rumah,
						SUM(grafik_lahan) AS lahan, SUM(grafik_luka) AS luka, SUM(grafik_meninggal) AS meninggal
						FROM grafik
						WHERE grafik_bln = $bulan_ AND grafik_thn = $tahun") or die("Query : ".mysql_error());
    		$cek = mysql_num_rows($hasil);
	        if($cek>0){
		        while ($row = mysql_fetch_array($hasil)) {
		            echo "<tr>";
		            echo "<td>1.</td>";
		            echo "<td>" . $bulan." ".$tahun . "</td>";
		            echo "<td>" . $row['jumlah'] . "</td>";
		            echo "<td>" . $row['Perkantoran'] . "</td>";
		            echo "<td>" . $row['UDJ'] . "</td>";
		            echo "<td>" . $row['Industri'] . "</td>";
		            echo "<td>" . $row['Kendaraan'] . "</td>";
		            echo "<td>" . $row['Rumah'] . "</td>";
		            echo "<td>" . $row['lahan'] . "</td>";
		            echo "<td>" . $row['luka'] . "</td>";
		            echo "<td>" . $row['meninggal'] . "</td>";
		            echo "<td class='center'>Tidak Diketahui</td>";
		            echo "<td class='center'>
						    			<a href='unduh_file?bln=$bulan&thn=$tahun' title='Unduh File' data-rel='tooltip'>
						    				<i class='icon-file-text bigger-125'></i>	
										</a>
									</td>";
		            echo "</tr>";
		        }
		    }else{
		    	echo "<tr><td colspan='13' class='center'>Tidak ada data yang ditemukan </td></tr>";
		    }

    	}else{
    		if($bulan == 'Jan'){$bulan_ = '01';}else if($bulan == 'Feb'){$bulan_ = '02';}else if($bulan == 'Mar'){$bulan_ = '03';}
			else if($bulan == 'Apr'){$bulan_ = '04';}else if($bulan == 'Mei'){$bulan_ = '05';}else if($bulan == 'Jun'){$bulan_ = '06';}
			else if($bulan == 'Jul'){$bulan_ = '07';}else if($bulan == 'Agt'){$bulan_ = '08';}else if($bulan == 'Sep'){$bulan_ = '09';}
			else if($bulan = 'Okt'){$bulan_ = '10';}else if($bulan == 'Nov'){$bulan_ = '11';}else if($bulan == 'Des'){$bulan_ = '12';}

			$cek = mysql_query("SELECT COUNT(a.resiko_id) AS jml
										FROM resiko AS a INNER JOIN bangunan AS c ON (c.ID_BANGUNAN = a.ID_BANGUNAN)
										INNER JOIN master_bangunan AS d ON (c.ID_MASTER = d.ID_MASTER)
										WHERE a.resiko_tanggal_start BETWEEN '$tahun-$bulan_-01' AND '$tahun-$bulan_-31'");
			$found = mysql_num_rows($cek);
			if($found>0){
				$jml = mysql_fetch_assoc(mysql_query("SELECT COUNT(a.resiko_id) AS jml
										FROM resiko AS a INNER JOIN bangunan AS c ON (c.ID_BANGUNAN = a.ID_BANGUNAN)
										INNER JOIN master_bangunan AS d ON (c.ID_MASTER = d.ID_MASTER)
										WHERE a.resiko_tanggal_start BETWEEN '$tahun-$bulan_-01' AND '$tahun-$bulan_-31'"));
		
				echo "<tr>";
		        echo "<td>1.</td>";
		        echo "<td>" .$bulan." ".$tahun . "</td>";
		        echo "<td>" . $jml['jml'] . "</td>";								
		    	for($i=1; $i<=6; $i++){
		    	$row = mysql_fetch_assoc(mysql_query("SELECT COUNT(d.NAMA_MASTER) AS jml
											FROM resiko AS a 
											INNER JOIN bangunan AS c ON (c.ID_BANGUNAN = a.ID_BANGUNAN)
											INNER JOIN master_bangunan AS d ON (c.ID_MASTER = d.ID_MASTER)
											WHERE d.ID_MASTER = $i AND
											a.resiko_tanggal_start BETWEEN '$tahun-$bulan_-01' AND '$tahun-$bulan_-31'"));
		    	echo "<td>" . $row['jml'] . "</td>";
		    	}
		    	$pasca = mysql_fetch_array(mysql_query("SELECT SUM(b.pasca_luka) AS luka, SUM(b.pasca_meninggal) AS meninggal,
											SUM(b.pasca_biaya) AS biaya
											FROM resiko AS a INNER JOIN pasca AS b ON (b.resiko_id=a.resiko_id)
											WHERE a.resiko_tanggal_start BETWEEN '$tahun-$bulan_-01' AND '$tahun-$bulan_-31'"));
		    	echo "<td>" . $pasca['luka'] . "</td>";
		    	echo "<td>" . $pasca['meninggal'] . "</td>";
		    	echo "<td>Rp. ".number_format($pasca['biaya'],2,',','.')."</td>";
		        echo "<td class='center'>
					    			<a href='unduh_file?bln=$bulan&thn=$tahun' title='Unduh File' data-rel='tooltip'>
					    				<i class='icon-file-text bigger-125'></i>	
									</a>
								</td>";
		        echo "</tr>";
			}else{
		    	echo "<tbody><tr><td colspan='13' class='center'>Tidak ada data yang ditemukan </td></tr></tbody>";
		    }
    	}

    }else{
    	if ($tahun == '2011' || $tahun == '2012') {
	        $hasil = mysql_query("SELECT SUM(grafik_industri)+SUM(grafik_perkantoran)+SUM(grafik_udj)+
										SUM(grafik_kb)+ SUM(grafik_rumah)+SUM(grafik_lahan) AS jumlah, 
										SUM(grafik_industri) AS Industri, SUM(grafik_perkantoran) AS Perkantoran,
										SUM(grafik_udj) AS UDJ, SUM(grafik_kb) AS Kendaraan, SUM(grafik_rumah) AS Rumah,
										SUM(grafik_lahan) AS lahan, SUM(grafik_luka) AS luka, SUM(grafik_meninggal) AS meninggal
										FROM grafik
										WHERE grafik_thn = $tahun") or die("Query : " . mysql_error());
	        //$no = 1;
	        $cek = mysql_num_rows($hasil);
	        if($cek>0){
		        while ($row = mysql_fetch_assoc($hasil)) {
		            echo "<tr>";
		            echo "<td>1.</td>";
		            echo "<td>" . $tahun . "</td>";
		            echo "<td>" . $row['jumlah'] . "</td>";
		            echo "<td>" . $row['Perkantoran'] . "</td>";
		            echo "<td>" . $row['UDJ'] . "</td>";
		            echo "<td>" . $row['Industri'] . "</td>";
		            echo "<td>" . $row['Kendaraan'] . "</td>";
		            echo "<td>" . $row['Rumah'] . "</td>";
		            echo "<td>" . $row['lahan'] . "</td>";
		            echo "<td>" . $row['luka'] . "</td>";
		            echo "<td>" . $row['meninggal'] . "</td>";
		            echo "<td class='center'>Tidak Diketahui</td>";
		            echo "<td class='center'>
						    			<a href='unduh_file?bln=$bulan&thn=$tahun' title='Unduh File' data-rel='tooltip'>
						    				<i class='icon-file-text bigger-125'></i>	
										</a>
									</td>";
		            echo "</tr>";
		        }
		    }else{
		    	echo "<tr><td colspan='13' class='center'>Tidak ada data yang ditemukan </td></tr>";
		    }
	    }else if($tahun == '2013'){
	    	$cek = mysql_query("SELECT COUNT(a.resiko_id) AS jml
										FROM resiko AS a INNER JOIN bangunan AS c ON (c.ID_BANGUNAN = a.ID_BANGUNAN)
										INNER JOIN master_bangunan AS d ON (c.ID_MASTER = d.ID_MASTER)
										WHERE a.resiko_tanggal_start BETWEEN '2013-01-01' AND '2013-12-31'");
			$found = mysql_num_rows($cek);
	    	if($found>0){
	    		$jml = mysql_fetch_assoc(mysql_query("SELECT COUNT(a.resiko_id) AS jml
										FROM resiko AS a INNER JOIN bangunan AS c ON (c.ID_BANGUNAN = a.ID_BANGUNAN)
										INNER JOIN master_bangunan AS d ON (c.ID_MASTER = d.ID_MASTER)
										WHERE a.resiko_tanggal_start BETWEEN '2013-01-01' AND '2013-12-31'"));
				echo "<tr>";
		        echo "<td>1.</td>";
		        echo "<td>" . $tahun . "</td>";
		        echo "<td>" . $jml['jml'] . "</td>";								
		    	for($i=1; $i<=6; $i++){
		    	$row = mysql_fetch_assoc(mysql_query("SELECT COUNT(d.NAMA_MASTER) AS jml
											FROM resiko AS a 
											INNER JOIN bangunan AS c ON (c.ID_BANGUNAN = a.ID_BANGUNAN)
											INNER JOIN master_bangunan AS d ON (c.ID_MASTER = d.ID_MASTER)
											WHERE d.ID_MASTER = $i AND
											a.resiko_tanggal_start BETWEEN '2013-01-01' AND '2013-12-31'"));
		    	echo "<td>" . $row['jml'] . "</td>";
		    	}
		    	$pasca = mysql_fetch_array(mysql_query("SELECT SUM(b.pasca_luka) AS luka, SUM(b.pasca_meninggal) AS meninggal,
											SUM(b.pasca_biaya) AS biaya
											FROM resiko AS a INNER JOIN pasca AS b ON (b.resiko_id=a.resiko_id)
											WHERE a.resiko_tanggal_start BETWEEN '2013-01-01' AND '2013-12-31'"));
		    	echo "<td>" . $pasca['luka'] . "</td>";
		    	echo "<td>" . $pasca['meninggal'] . "</td>";
		    	echo "<td>Rp. ".number_format($pasca['biaya'],2,',','.')."</td>";
		        echo "<td class='center'>
					    			<a href='unduh_file?bln=$bulan&thn=$tahun' title='Unduh File' data-rel='tooltip'>
					    				<i class='icon-file-text bigger-125'></i>	
									</a>
								</td>";
		        echo "</tr>";
	    	}else{
		    	echo "<tr><td colspan='13' class='center'>Tidak ada data yang ditemukan </td></tr>";
		    }
	    }else{
	    	$cek = mysql_query("SELECT COUNT(a.resiko_id) AS jml
										FROM resiko AS a INNER JOIN bangunan AS c ON (c.ID_BANGUNAN = a.ID_BANGUNAN)
										INNER JOIN master_bangunan AS d ON (c.ID_MASTER = d.ID_MASTER)
										WHERE a.resiko_tanggal_start BETWEEN '2013-01-01' AND '2013-12-31'");
			$found = mysql_num_rows($cek);
	    	if($found>0){
	    		$jml = mysql_fetch_assoc(mysql_query("SELECT COUNT(a.resiko_id) AS jml
										FROM resiko AS a INNER JOIN bangunan AS c ON (c.ID_BANGUNAN = a.ID_BANGUNAN)
										INNER JOIN master_bangunan AS d ON (c.ID_MASTER = d.ID_MASTER)
										WHERE a.resiko_tanggal_start BETWEEN '2014-01-01' AND '2014-12-31'"));
				echo "<tr>";
		        echo "<td>1.</td>";
		        echo "<td>" . $tahun . "</td>";
		        echo "<td>" . $jml['jml'] . "</td>";								
		    	for($i=1; $i<=6; $i++){
		    	$row = mysql_fetch_assoc(mysql_query("SELECT COUNT(d.NAMA_MASTER) AS jml
											FROM resiko AS a 
											INNER JOIN bangunan AS c ON (c.ID_BANGUNAN = a.ID_BANGUNAN)
											INNER JOIN master_bangunan AS d ON (c.ID_MASTER = d.ID_MASTER)
											WHERE d.ID_MASTER = $i AND
											a.resiko_tanggal_start BETWEEN '2014-01-01' AND '2014-12-31'"));
		    	echo "<td>" . $row['jml'] . "</td>";
		    	}
		    	$pasca = mysql_fetch_array(mysql_query("SELECT SUM(b.pasca_luka) AS luka, SUM(b.pasca_meninggal) AS meninggal,
											SUM(b.pasca_biaya) AS biaya
											FROM resiko AS a INNER JOIN pasca AS b ON (b.resiko_id=a.resiko_id)
											WHERE a.resiko_tanggal_start BETWEEN '2014-01-01' AND '2014-12-31'"));
		    	echo "<td>" . $pasca['luka'] . "</td>";
		    	echo "<td>" . $pasca['meninggal'] . "</td>";
		    	echo "<td>Rp. ".number_format($pasca['biaya'],2,',','.')."</td>";
		        echo "<td class='center'>
					    			<a href='#' title='Unduh File' data-rel='tooltip'>
					    				<i class='icon-file-text bigger-125'></i>	
									</a>
								</td>";
		        echo "</tr>";
	    	}else{
		    	echo "<tr><td colspan='13' class='center'>Tidak ada data yang ditemukan </td></tr>";
		    }
	    	
	    }
    }
} else {
    echo "error";
}
?>