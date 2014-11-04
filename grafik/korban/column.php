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
		var chartTitle		= 'Tahun 2014';
		var	chartCategories = ['Korban'];
		var chartData		= 
		<?php
			$sth1 = mysql_fetch_assoc(mysql_query("SELECT SUM(b.pasca_luka) AS luka, SUM(b.pasca_meninggal) AS meninggal
									FROM pasca AS b INNER JOIN resiko AS c
									ON (c.resiko_id = b.resiko_id)
									WHERE c.resiko_tanggal_start BETWEEN '2014-01-01' AND '2014-12-31'"));
			$row1 = array();$row2 = array();
			$row1['name'] = 'Luka';$row2['name'] = 'Meninggal';
			
			    $row1['data'][] = $sth1['luka'];
			    $row2['data'][] = $sth2['meninggal'];
			
			$result = array();
			array_push($result,$row1);
			array_push($result,$row2);
			print json_encode($result, JSON_NUMERIC_CHECK);
		?>
		;
		setDynamicChart(chartype, chartTitle, chartCategories, chartData);
 
		//jQuery part - On Click call the function setDynamicChart(dynval) and pass title, chart type, category, data
		$('.pie11').click(function(){
			//get the value from 'a' tag
			var chartype = $(this).attr('id');
 			
 			if(chartype == 'pie9'){
 				var chartype 		= 'column';
				var chartTitle		= 'Tahun 2009';
				var	chartCategories = ['Penyebab'];
				var chartData		= 
				<?php
					$sth = mysql_fetch_assoc(mysql_query("Select luka, meninggal FROM grafik_kebakaran WHERE tahun = 2009"));
					$row1 = array();$row2 = array();
					$row1['name'] = 'Luka';$row2['name'] = 'Meninggal';

						$row1['data'][] = $sth['luka'];
					    $row2['data'][] = $sth['meninggal'];
					
					$result = array();
					array_push($result,$row1);
					array_push($result,$row2);
					print json_encode($result, JSON_NUMERIC_CHECK);
				?>
				;
				setDynamicChart(chartype, chartTitle, chartCategories, chartData);
 			}else if(chartype == 'pie0'){
				var chartype 		= 'column';
				var chartTitle		= 'Tahun 2010';
				var	chartCategories = ['Penyebab'];
				var chartData		= 
				<?php
					$sth = mysql_fetch_assoc(mysql_query("Select luka, meninggal FROM grafik_kebakaran WHERE tahun = 2010"));
					$row1 = array();$row2 = array();
					$row1['name'] = 'Luka';$row2['name'] = 'Meninggal';

						$row1['data'][] = $sth['luka'];
					    $row2['data'][] = $sth['meninggal'];
					
					$result = array();
					array_push($result,$row1);
					array_push($result,$row2);
					print json_encode($result, JSON_NUMERIC_CHECK);
				?>
				;
				setDynamicChart(chartype, chartTitle, chartCategories, chartData);
			}else if(chartype == 'pie1'){
				var chartype 		= 'column';
				var chartTitle		= 'Tahun 2011';
				var	chartCategories = ['Penyebab'];
				var chartData		= 
				<?php
					$sth = mysql_fetch_assoc(mysql_query("Select SUM(luka) AS luka, SUM(meninggal) AS meninggal FROM grafik_bangunan_terbakar WHERE tahun = 2011"));
					$row1 = array();$row2 = array();
					$row1['name'] = 'Luka';$row2['name'] = 'Meninggal';

						$row1['data'][] = $sth['luka'];
					    $row2['data'][] = $sth['meninggal'];
					
					$result = array();
					array_push($result,$row1);
					array_push($result,$row2);
					print json_encode($result, JSON_NUMERIC_CHECK);
				?>
				;
				setDynamicChart(chartype, chartTitle, chartCategories, chartData);
			}else if(chartype == 'pie2'){
				var chartype 		= 'column';
				var chartTitle		= 'Tahun 2012';
				var	chartCategories = ['Penyebab'];
				var chartData		= 
				<?php
					$sth = mysql_fetch_assoc(mysql_query("Select SUM(luka) AS luka, SUM(meninggal) AS meninggal FROM grafik_bangunan_terbakar WHERE tahun = 2012"));
					$row1 = array();$row2 = array();
					$row1['name'] = 'Luka';$row2['name'] = 'Meninggal';

						$row1['data'][] = $sth['luka'];
					    $row2['data'][] = $sth['meninggal'];
					
					$result = array();
					array_push($result,$row1);
					array_push($result,$row2);
					print json_encode($result, JSON_NUMERIC_CHECK);
				?>
				;
				setDynamicChart(chartype, chartTitle, chartCategories, chartData);
			}else if(chartype == 'pie3'){
				var chartype 		= 'column';
				var chartTitle		= 'Tahun 2013';
				var	chartCategories = ['Penyebab'];
				var chartData		= 
				<?php
					$sth1 = mysql_fetch_assoc(mysql_query("SELECT SUM(b.pasca_luka) AS luka, SUM(b.pasca_meninggal) AS meninggal
											FROM pasca AS b INNER JOIN resiko AS c
											ON (c.resiko_id = b.resiko_id)
											WHERE c.resiko_tanggal_start BETWEEN '2013-01-01' AND '2013-12-31'"));
					$row1 = array();$row2 = array();
					$row1['name'] = 'Luka';$row2['name'] = 'Meninggal';
					
					    $row1['data'][] = $sth1['luka'];
					    $row2['data'][] = $sth1['meninggal'];
					
					$result = array();
					array_push($result,$row1);
					array_push($result,$row2);
					print json_encode($result, JSON_NUMERIC_CHECK);
				?>
				;
				setDynamicChart(chartype, chartTitle, chartCategories, chartData);
			}else if(chartype == 'pie4'){
				var chartype 		= 'column';
				var chartTitle		= 'Tahun 2014';
				var	chartCategories = ['Penyebab'];
				var chartData		= 
				<?php
					$sth1 = mysql_fetch_assoc(mysql_query("SELECT SUM(b.pasca_luka) AS luka, SUM(b.pasca_meninggal) AS meninggal
											FROM pasca AS b INNER JOIN resiko AS c
											ON (c.resiko_id = b.resiko_id)
											WHERE c.resiko_tanggal_start BETWEEN '2014-01-01' AND '2014-12-31'"));
					$row1 = array();$row2 = array();
					$row1['name'] = 'Luka';$row2['name'] = 'Meninggal';
					
					    $row1['data'][] = $sth1['luka'];
					    $row2['data'][] = $sth1['meninggal'];
					
					$result = array();
					array_push($result,$row1);
					array_push($result,$row2);
					print json_encode($result, JSON_NUMERIC_CHECK);
				?>
				;
				setDynamicChart(chartype, chartTitle, chartCategories, chartData);
			}else if(chartype == 'pie5'){
				var chartype 		= 'column';
				var chartTitle		= 'Tahun 2015';
				var	chartCategories = ['Penyebab'];
				var chartData		= 
				<?php
					$sth1 = mysql_fetch_assoc(mysql_query("SELECT SUM(b.pasca_luka) AS luka, SUM(b.pasca_meninggal) AS meninggal
											FROM pasca AS b INNER JOIN resiko AS c
											ON (c.resiko_id = b.resiko_id)
											WHERE c.resiko_tanggal_start BETWEEN '2015-01-01' AND '2015-12-31'"));
					$row1 = array();$row2 = array();
					$row1['name'] = 'Luka';$row2['name'] = 'Meninggal';
					
					    $row1['data'][] = $sth1['luka'];
					    $row2['data'][] = $sth1['meninggal'];
					
					$result = array();
					array_push($result,$row1);
					array_push($result,$row2);
					print json_encode($result, JSON_NUMERIC_CHECK);
				?>
				;
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
			$('#korban').highcharts({
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