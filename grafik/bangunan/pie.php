<?php
	$host="localhost"; 
	$user="root"; 
	$password=""; 
	$database="tugas_akhir"; 
	$koneksi=mysql_connect($host,$user,$password); 
	mysql_select_db($database,$koneksi); 
	//cek koneksi 
	if($koneksi){ 
		//echo "berhasil koneksi"; 
	}else{ 
		echo "Gagal koneksi"; 
	} 
?>
<script type="text/javascript">
$(function () {
 
		//create a variable so we can pass the values dynamically
		var chartype 		= 'column';
		var chartTitle		= 'Tahun 2009';
		var	chartCategories = ['Tipe Bangunan'];
		var chartData		= 
		<?php
			$sth = mysql_query("Select industri, perkantoran, udj, rumah, kb, ls FROM grafik_kebakaran WHERE tahun = 2009");
			$row1 = array();$row3 = array();$row5 = array();
			$row2 = array();$row4 = array();$row6 = array();
			$row1['name'] = 'Industri';$row3['name'] = 'Usaha Dagang dan Jasa';$row5['name'] = 'Rumah';
			$row2['name'] = 'Perkantoran';$row4['name'] = 'Kendaraan Bermotor';$row6['name'] = 'Lahan/Sawah';
			while($r = mysql_fetch_array($sth)) {
			    $row1['data'][] = $r['industri'];
			    $row2['data'][] = $r['perkantoran'];
			    $row3['data'][] = $r['udj'];
			    $row4['data'][] = $r['rumah'];
			    $row5['data'][] = $r['kb'];
			    $row6['data'][] = $r['ls'];
			}
			$result = array();
			array_push($result,$row1);
			array_push($result,$row2);
			array_push($result,$row3);
			array_push($result,$row4);
			array_push($result,$row5);
			array_push($result,$row6);
			print json_encode($result, JSON_NUMERIC_CHECK);
		?>
		;
 
		//On page load call the function setDynamicChart and pass the variables
		setDynamicChart(chartype, chartTitle, chartCategories, chartData);
 
		//jQuery part - On Click call the function setDynamicChart(dynval) and pass title, chart type, category, data
		$('.pie1').click(function(){
			//get the value from 'a' tag
			var chartype = $(this).attr('id');
 
			if(chartype == 'pie9'){
				var chartype 		= 'column';
				var chartTitle		= 'Tahun 2009';
				var	chartCategories = ['Tipe Bangunan'];
				var chartData		= 
				<?php
					$sth = mysql_query("Select industri, perkantoran, udj, rumah, kb, ls FROM grafik_kebakaran WHERE tahun = 2009");
					$row1 = array();$row3 = array();$row5 = array();
					$row2 = array();$row4 = array();$row6 = array();
					$row1['name'] = 'Industri';$row3['name'] = 'Usaha Dagang dan Jasa';$row5['name'] = 'Rumah';
					$row2['name'] = 'Perkantoran';$row4['name'] = 'Kendaraan Bermotor';$row6['name'] = 'Lahan/Sawah';
					while($r = mysql_fetch_array($sth)) {
					    $row1['data'][] = $r['industri'];
					    $row2['data'][] = $r['perkantoran'];
					    $row3['data'][] = $r['udj'];
					    $row4['data'][] = $r['rumah'];
					    $row5['data'][] = $r['kb'];
					    $row6['data'][] = $r['ls'];
					}
					$result = array();
					array_push($result,$row1);
					array_push($result,$row2);
					array_push($result,$row3);
					array_push($result,$row4);
					array_push($result,$row5);
					array_push($result,$row6);
					print json_encode($result, JSON_NUMERIC_CHECK);
				?>
				;
		 
				//On page load call the function setDynamicChart and pass the variables
				setDynamicChart(chartype, chartTitle, chartCategories, chartData);
			}
			else if(chartype == 'pie0'){
				var chartype 		= 'column';
				var chartTitle		= 'Tahun 2010';
				var	chartCategories = ['Tipe Bangunan'];
				var chartData		= 
				<?php
					$sth = mysql_query("Select industri, perkantoran, udj, rumah, kb, ls FROM grafik_kebakaran WHERE tahun = 2010");
					$row1 = array();$row3 = array();$row5 = array();
					$row2 = array();$row4 = array();$row6 = array();
					$row1['name'] = 'Industri';$row3['name'] = 'Usaha Dagang dan Jasa';$row5['name'] = 'Rumah';
					$row2['name'] = 'Perkantoran';$row4['name'] = 'Kendaraan Bermotor';$row6['name'] = 'Lahan/Sawah';
					while($r = mysql_fetch_array($sth)) {
					    $row1['data'][] = $r['industri'];
					    $row2['data'][] = $r['perkantoran'];
					    $row3['data'][] = $r['udj'];
					    $row4['data'][] = $r['rumah'];
					    $row5['data'][] = $r['kb'];
					    $row6['data'][] = $r['ls'];
					}
					$result = array();
					array_push($result,$row1);
					array_push($result,$row2);
					array_push($result,$row3);
					array_push($result,$row4);
					array_push($result,$row5);
					array_push($result,$row6);
					print json_encode($result, JSON_NUMERIC_CHECK);
				?>
				;
		 
				//On page load call the function setDynamicChart and pass the variables
				setDynamicChart(chartype, chartTitle, chartCategories, chartData);
			}
			else if(chartype == 'pie1'){
				chartype 		= 'line';
				chartTitle		= 'Tahun 2011';
				chartData		= [{type: 'pie',name: 'Nilai',
				data: [
				<?php
					$query = mysql_query("SELECT a.NAMA_MASTER, b.grafik_nilai
										FROM master_bangunan AS a INNER JOIN grafik_bangunan AS b
										ON (a.ID_MASTER = b.ID_MASTER) WHERE grafik_tahun = 2011");
		            $numrows = mysql_num_rows($query);
		            while ($row = mysql_fetch_array($query)) {
		                $data[0] = $row['NAMA_MASTER'];
		                $data[1] = $row['grafik_nilai'];
		                echo "['" . $data[0] . "', " . $data[1] . "],";
		            }
				?>
				]
				}];				
				setDynamicChart(chartype, chartTitle, chartCategories, chartData);
			}else if(chartype == 'pie2'){
				chartype 		= 'line';
				chartTitle		= 'Tahun 2012';
				chartData		= [{type: 'pie',name: 'Nilai',
				data: [
				<?php
					$query = mysql_query("SELECT a.NAMA_MASTER, b.grafik_nilai
										FROM master_bangunan AS a INNER JOIN grafik_bangunan AS b
										ON (a.ID_MASTER = b.ID_MASTER) WHERE grafik_tahun = 2012");
		            $numrows = mysql_num_rows($query);
		            while ($row = mysql_fetch_array($query)) {
		                $data[0] = $row['NAMA_MASTER'];
		                $data[1] = $row['grafik_nilai'];
		                echo "['" . $data[0] . "', " . $data[1] . "],";
		            }
				?>
				]
				}];				
				setDynamicChart(chartype, chartTitle, chartCategories, chartData);
			}else if(chartype == 'pie3'){
				chartype 		= 'line';
				chartTitle		= 'Tahun 2013';
				chartData		= [{type: 'pie',name: 'Nilai',
				data: [
				<?php
					$query = mysql_query("SELECT c.NAMA_MASTER, COUNT(c.NAMA_MASTER) AS Nilai
                                        FROM resiko AS a INNER JOIN bangunan AS b 
                                        ON (a.ID_BANGUNAN = b.ID_BANGUNAN) INNER JOIN master_bangunan AS c
                                        ON (b.ID_MASTER = c.ID_MASTER)
                                        WHERE a.resiko_tanggal_start BETWEEN '2013-01-01' AND '2013-12-31'
                                        GROUP BY c.NAMA_MASTER");
		            $numrows = mysql_num_rows($query);
		            while ($row = mysql_fetch_array($query)) {
		                $data[0] = $row['NAMA_MASTER'];
		                $data[1] = $row['Nilai'];
		                echo "['" . $data[0] . "', " . $data[1] . "],";
		            }
				?>
				]
				}];				
				setDynamicChart(chartype, chartTitle, chartCategories, chartData);
			}else if(chartype == 'pie4'){
				chartype 		= 'line';
				chartTitle		= 'Tahun 2014';
				chartData		= [{type: 'pie',name: 'Nilai',
				data: [
				<?php
					$query = mysql_query("SELECT c.NAMA_MASTER, COUNT(c.NAMA_MASTER) AS Nilai
                                        FROM resiko AS a INNER JOIN bangunan AS b 
                                        ON (a.ID_BANGUNAN = b.ID_BANGUNAN) INNER JOIN master_bangunan AS c
                                        ON (b.ID_MASTER = c.ID_MASTER)
                                        WHERE a.resiko_tanggal_start BETWEEN '2014-01-01' AND '2014-12-31'
                                        GROUP BY c.NAMA_MASTER");
		            $numrows = mysql_num_rows($query);
		            while ($row = mysql_fetch_array($query)) {
		                $data[0] = $row['NAMA_MASTER'];
		                $data[1] = $row['Nilai'];
		                echo "['" . $data[0] . "', " . $data[1] . "],";
		            }
				?>
				]
			}];				
				setDynamicChart(chartype, chartTitle, chartCategories, chartData);
			}else if(chartype == 'pie5'){
				chartype 		= 'line';
				chartTitle		= 'Tahun 2015';
				chartData		= [{type: 'pie',name: 'Nilai',
				data: [
				<?php
					$query = mysql_query("SELECT c.NAMA_MASTER, COUNT(c.NAMA_MASTER) AS Nilai
                                        FROM resiko AS a INNER JOIN bangunan AS b 
                                        ON (a.ID_BANGUNAN = b.ID_BANGUNAN) INNER JOIN master_bangunan AS c
                                        ON (b.ID_MASTER = c.ID_MASTER)
                                        WHERE a.resiko_tanggal_start BETWEEN '2015-01-01' AND '2015-12-31'
                                        GROUP BY c.NAMA_MASTER");
		            $numrows = mysql_num_rows($query);
		            while ($row = mysql_fetch_array($query)) {
		                $data[0] = $row['NAMA_MASTER'];
		                $data[1] = $row['Nilai'];
		                echo "['" . $data[0] . "', " . $data[1] . "],";
		            }
				?>
				]
			}];				
				setDynamicChart(chartype, chartTitle, chartCategories, chartData);
			}
		});
 		 //Radialize the colors
            Highcharts.getOptions().colors = Highcharts.map(Highcharts.getOptions().colors, function (color) {
             return {
             radialGradient: {cx: 0.5, cy: 0.3, r: 0.7},
             stops: [
             [0, color],
             [1, Highcharts.Color(color).brighten(-0.3).get('rgb')] // darken
             ]
             };
             });
             Highcharts.setOptions({
             colors: ['#ff0000', '#18F918', '#DDDF00', '#24CBE5', '#64E572', '#FF9655', '#FFF263', '#6AF9C4']
             });
             var chart;
		//function is created so we pass the value dynamically and be able to refresh the HighCharts on every click
 
		function setDynamicChart(chartype, chartTitle, chartCategories, chartData){
			$('#pie-chart2').highcharts({
				chart: {
					type: chartype
				},
				title: {
					text: chartTitle
				},
				xAxis: {
					categories: chartCategories
				},
				yAxis: {
					min: 0,
					title: {
						text: 'Value'
					}
				},
				plotOptions: {
					//this need only for pie chart
					pie: {
						allowPointSelect: true,
						cursor: 'pointer',
						dataLabels: {
                            enabled: true,
                            color: '#000000',
                            connectorColor: '#000000',
                            style: {
                                color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                            },
                            format: '<b>{point.name}</b>: {point.percentage:.1f} %'
                        }
					}
				},
				series: chartData
			});
		}
    });
</script>