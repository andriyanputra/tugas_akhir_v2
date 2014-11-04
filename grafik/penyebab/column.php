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
		var	chartCategories = ['Penyebab'];
		var chartData		= 
		<?php
			$sth1 = mysql_fetch_assoc(mysql_query("SELECT COUNT(a.penyebab_nama) AS bbm
								FROM penyebab AS a INNER JOIN pasca AS b
								ON (a.penyebab_id = b.penyebab_id) INNER JOIN resiko AS c
								ON (c.resiko_id = b.resiko_id)
								WHERE a.penyebab_id = 1 AND c.resiko_tanggal_start BETWEEN '2014-01-01' AND '2014-12-31'"));
			$sth2 = mysql_fetch_assoc(mysql_query("SELECT COUNT(a.penyebab_nama) AS kpr
								FROM penyebab AS a INNER JOIN pasca AS b
								ON (a.penyebab_id = b.penyebab_id) INNER JOIN resiko AS c
								ON (c.resiko_id = b.resiko_id)
								WHERE a.penyebab_id = 2 AND c.resiko_tanggal_start BETWEEN '2014-01-01' AND '2014-12-31'"));
			$sth3 = mysql_fetch_assoc(mysql_query("SELECT COUNT(a.penyebab_nama) AS lst
								FROM penyebab AS a INNER JOIN pasca AS b
								ON (a.penyebab_id = b.penyebab_id) INNER JOIN resiko AS c
								ON (c.resiko_id = b.resiko_id)
								WHERE a.penyebab_id = 3 AND c.resiko_tanggal_start BETWEEN '2014-01-01' AND '2014-12-31'"));
			$sth4 = mysql_fetch_assoc(mysql_query("SELECT COUNT(a.penyebab_nama) AS rk
								FROM penyebab AS a INNER JOIN pasca AS b
								ON (a.penyebab_id = b.penyebab_id) INNER JOIN resiko AS c
								ON (c.resiko_id = b.resiko_id)
								WHERE a.penyebab_id = 4 AND c.resiko_tanggal_start BETWEEN '2014-01-01' AND '2014-12-31'"));
			$sth5 = mysql_fetch_assoc(mysql_query("SELECT COUNT(a.penyebab_nama) AS lain
								FROM penyebab AS a INNER JOIN pasca AS b
								ON (a.penyebab_id = b.penyebab_id) INNER JOIN resiko AS c
								ON (c.resiko_id = b.resiko_id)
								WHERE a.penyebab_id = 5 AND c.resiko_tanggal_start BETWEEN '2014-01-01' AND '2014-12-31'"));
			$row1 = array();$row3 = array();$row5 = array();
			$row2 = array();$row4 = array();
			$row1['name'] = 'Bahan Bakar Minyak';$row3['name'] = 'Listrik';
			$row2['name'] = 'Kompor/LPG';$row4['name'] = 'Rokok';$row5['name'] = 'Lain-lain';
			
			    $row1['data'][] = $sth1['bbm'];
			    $row2['data'][] = $sth2['kpr'];
			    $row3['data'][] = $sth3['lst'];
			    $row4['data'][] = $sth4['rk'];
			    $row5['data'][] = $sth5['lain'];
			
			$result = array();
			array_push($result,$row1);
			array_push($result,$row2);
			array_push($result,$row3);
			array_push($result,$row4);
			array_push($result,$row5);
			print json_encode($result, JSON_NUMERIC_CHECK);
		?>
		;
		setDynamicChart(chartype, chartTitle, chartCategories, chartData);
 
		//jQuery part - On Click call the function setDynamicChart(dynval) and pass title, chart type, category, data
		$('.column1').click(function(){
			//get the value from 'a' tag
			var chartype = $(this).attr('id');
 			
 			if(chartype == 'column9'){
 				var chartype 		= 'column';
				var chartTitle		= 'Tahun 2009';
				var	chartCategories = ['Penyebab'];
				var chartData		= 
				<?php
					$sth = mysql_query("Select bbm,kpr,lst,rk,lain FROM grafik_kebakaran WHERE tahun = 2009");
					$row1 = array();$row3 = array();$row5 = array();
					$row2 = array();$row4 = array();
					$row1['name'] = 'Bahan Bakar Minyak';$row3['name'] = 'Listrik';
					$row2['name'] = 'Kompor/LPG';$row4['name'] = 'Rokok';$row5['name'] = 'Lain-lain';
					while($r = mysql_fetch_array($sth)) {
					    $row1['data'][] = $r['bbm'];
					    $row2['data'][] = $r['kpr'];
					    $row3['data'][] = $r['lst'];
					    $row4['data'][] = $r['rk'];
					    $row5['data'][] = $r['lain'];
					}
					$result = array();
					array_push($result,$row1);
					array_push($result,$row2);
					array_push($result,$row3);
					array_push($result,$row4);
					array_push($result,$row5);
					print json_encode($result, JSON_NUMERIC_CHECK);
				?>
				;
				setDynamicChart(chartype, chartTitle, chartCategories, chartData);
 			}else if(chartype == 'column0'){
				var chartype 		= 'column';
				var chartTitle		= 'Tahun 2010';
				var	chartCategories = ['Penyebab'];
				var chartData		= 
				<?php
					$sth = mysql_query("Select bbm,kpr,lst,rk,lain FROM grafik_kebakaran WHERE tahun = 2010");
					$row1 = array();$row3 = array();$row5 = array();
					$row2 = array();$row4 = array();
					$row1['name'] = 'Bahan Bakar Minyak';$row3['name'] = 'Listrik';
					$row2['name'] = 'Kompor/LPG';$row4['name'] = 'Rokok';$row5['name'] = 'Lain-lain';
					while($r = mysql_fetch_array($sth)) {
					    $row1['data'][] = $r['bbm'];
					    $row2['data'][] = $r['kpr'];
					    $row3['data'][] = $r['lst'];
					    $row4['data'][] = $r['rk'];
					    $row5['data'][] = $r['lain'];
					}
					$result = array();
					array_push($result,$row1);
					array_push($result,$row2);
					array_push($result,$row3);
					array_push($result,$row4);
					array_push($result,$row5);
					print json_encode($result, JSON_NUMERIC_CHECK);
				?>
				;
				setDynamicChart(chartype, chartTitle, chartCategories, chartData);
			}else if(chartype == 'column1'){
				var chartype 		= 'column';
				var chartTitle		= 'Tahun 2011';
				var	chartCategories = ['Penyebab'];
				var chartData		= 
				<?php
					$sth = mysql_query("Select bbm,kpr,lst,rk,lain FROM grafik_kebakaran WHERE tahun = 2011");
					$row1 = array();$row3 = array();$row5 = array();
					$row2 = array();$row4 = array();
					$row1['name'] = 'Bahan Bakar Minyak';$row3['name'] = 'Listrik';
					$row2['name'] = 'Kompor/LPG';$row4['name'] = 'Rokok';$row5['name'] = 'Lain-lain';
					while($r = mysql_fetch_array($sth)) {
					    $row1['data'][] = $r['bbm'];
					    $row2['data'][] = $r['kpr'];
					    $row3['data'][] = $r['lst'];
					    $row4['data'][] = $r['rk'];
					    $row5['data'][] = $r['lain'];
					}
					$result = array();
					array_push($result,$row1);
					array_push($result,$row2);
					array_push($result,$row3);
					array_push($result,$row4);
					array_push($result,$row5);
					print json_encode($result, JSON_NUMERIC_CHECK);
				?>
				;
				setDynamicChart(chartype, chartTitle, chartCategories, chartData);
			}else if(chartype == 'column2'){
				var chartype 		= 'column';
				var chartTitle		= 'Tahun 2012';
				var	chartCategories = ['Penyebab'];
				var chartData		= 
				<?php
					$sth = mysql_query("Select SUM(grafik_bbm) AS bbm, SUM(grafik_kpr) AS kpr, SUM(grafik_lst) AS lst,
										SUM(grafik_rk) AS rk, SUM(grafik_lain) AS lain 
										FROM grafik WHERE grafik_thn = 2012");
					$row1 = array();$row3 = array();$row5 = array();
					$row2 = array();$row4 = array();
					$row1['name'] = 'Bahan Bakar Minyak';$row3['name'] = 'Listrik';
					$row2['name'] = 'Kompor/LPG';$row4['name'] = 'Rokok';$row5['name'] = 'Lain-lain';
					while($r = mysql_fetch_array($sth)) {
					    $row1['data'][] = $r['bbm'];
					    $row2['data'][] = $r['kpr'];
					    $row3['data'][] = $r['lst'];
					    $row4['data'][] = $r['rk'];
					    $row5['data'][] = $r['lain'];
					}
					$result = array();
					array_push($result,$row1);
					array_push($result,$row2);
					array_push($result,$row3);
					array_push($result,$row4);
					array_push($result,$row5);
					print json_encode($result, JSON_NUMERIC_CHECK);
				?>
				;
				setDynamicChart(chartype, chartTitle, chartCategories, chartData);
			}else if(chartype == 'column3'){
				var chartype 		= 'column';
				var chartTitle		= 'Tahun 2013';
				var	chartCategories = ['Penyebab'];
				var chartData		= 
				<?php
					$sth1 = mysql_fetch_assoc(mysql_query("SELECT COUNT(a.penyebab_nama) AS bbm
										FROM penyebab AS a INNER JOIN pasca AS b
										ON (a.penyebab_id = b.penyebab_id) INNER JOIN resiko AS c
										ON (c.resiko_id = b.resiko_id)
										WHERE a.penyebab_id = 1 AND c.resiko_tanggal_start BETWEEN '2013-01-01' AND '2013-12-31'"));
					$sth2 = mysql_fetch_assoc(mysql_query("SELECT COUNT(a.penyebab_nama) AS kpr
										FROM penyebab AS a INNER JOIN pasca AS b
										ON (a.penyebab_id = b.penyebab_id) INNER JOIN resiko AS c
										ON (c.resiko_id = b.resiko_id)
										WHERE a.penyebab_id = 2 AND c.resiko_tanggal_start BETWEEN '2013-01-01' AND '2013-12-31'"));
					$sth3 = mysql_fetch_assoc(mysql_query("SELECT COUNT(a.penyebab_nama) AS lst
										FROM penyebab AS a INNER JOIN pasca AS b
										ON (a.penyebab_id = b.penyebab_id) INNER JOIN resiko AS c
										ON (c.resiko_id = b.resiko_id)
										WHERE a.penyebab_id = 3 AND c.resiko_tanggal_start BETWEEN '2013-01-01' AND '2013-12-31'"));
					$sth4 = mysql_fetch_assoc(mysql_query("SELECT COUNT(a.penyebab_nama) AS rk
										FROM penyebab AS a INNER JOIN pasca AS b
										ON (a.penyebab_id = b.penyebab_id) INNER JOIN resiko AS c
										ON (c.resiko_id = b.resiko_id)
										WHERE a.penyebab_id = 4 AND c.resiko_tanggal_start BETWEEN '2013-01-01' AND '2013-12-31'"));
					$sth5 = mysql_fetch_assoc(mysql_query("SELECT COUNT(a.penyebab_nama) AS lain
										FROM penyebab AS a INNER JOIN pasca AS b
										ON (a.penyebab_id = b.penyebab_id) INNER JOIN resiko AS c
										ON (c.resiko_id = b.resiko_id)
										WHERE a.penyebab_id = 5 AND c.resiko_tanggal_start BETWEEN '2013-01-01' AND '2013-12-31'"));
					$row1 = array();$row3 = array();$row5 = array();
					$row2 = array();$row4 = array();
					$row1['name'] = 'Bahan Bakar Minyak';$row3['name'] = 'Listrik';
					$row2['name'] = 'Kompor/LPG';$row4['name'] = 'Rokok';$row5['name'] = 'Lain-lain';
					
					    $row1['data'][] = $sth1['bbm'];
					    $row2['data'][] = $sth2['kpr'];
					    $row3['data'][] = $sth3['lst'];
					    $row4['data'][] = $sth4['rk'];
					    $row5['data'][] = $sth5['lain'];
					
					$result = array();
					array_push($result,$row1);
					array_push($result,$row2);
					array_push($result,$row3);
					array_push($result,$row4);
					array_push($result,$row5);
					print json_encode($result, JSON_NUMERIC_CHECK);
				?>
				;
				setDynamicChart(chartype, chartTitle, chartCategories, chartData);
			}else if(chartype == 'column4'){
				var chartype 		= 'column';
				var chartTitle		= 'Tahun 2014';
				var	chartCategories = ['Penyebab'];
				var chartData		= 
				<?php
					$sth1 = mysql_fetch_assoc(mysql_query("SELECT COUNT(a.penyebab_nama) AS bbm
										FROM penyebab AS a INNER JOIN pasca AS b
										ON (a.penyebab_id = b.penyebab_id) INNER JOIN resiko AS c
										ON (c.resiko_id = b.resiko_id)
										WHERE a.penyebab_id = 1 AND c.resiko_tanggal_start BETWEEN '2014-01-01' AND '2014-12-31'"));
					$sth2 = mysql_fetch_assoc(mysql_query("SELECT COUNT(a.penyebab_nama) AS kpr
										FROM penyebab AS a INNER JOIN pasca AS b
										ON (a.penyebab_id = b.penyebab_id) INNER JOIN resiko AS c
										ON (c.resiko_id = b.resiko_id)
										WHERE a.penyebab_id = 2 AND c.resiko_tanggal_start BETWEEN '2014-01-01' AND '2014-12-31'"));
					$sth3 = mysql_fetch_assoc(mysql_query("SELECT COUNT(a.penyebab_nama) AS lst
										FROM penyebab AS a INNER JOIN pasca AS b
										ON (a.penyebab_id = b.penyebab_id) INNER JOIN resiko AS c
										ON (c.resiko_id = b.resiko_id)
										WHERE a.penyebab_id = 3 AND c.resiko_tanggal_start BETWEEN '2014-01-01' AND '2014-12-31'"));
					$sth4 = mysql_fetch_assoc(mysql_query("SELECT COUNT(a.penyebab_nama) AS rk
										FROM penyebab AS a INNER JOIN pasca AS b
										ON (a.penyebab_id = b.penyebab_id) INNER JOIN resiko AS c
										ON (c.resiko_id = b.resiko_id)
										WHERE a.penyebab_id = 4 AND c.resiko_tanggal_start BETWEEN '2014-01-01' AND '2014-12-31'"));
					$sth5 = mysql_fetch_assoc(mysql_query("SELECT COUNT(a.penyebab_nama) AS lain
										FROM penyebab AS a INNER JOIN pasca AS b
										ON (a.penyebab_id = b.penyebab_id) INNER JOIN resiko AS c
										ON (c.resiko_id = b.resiko_id)
										WHERE a.penyebab_id = 5 AND c.resiko_tanggal_start BETWEEN '2014-01-01' AND '2014-12-31'"));
					$row1 = array();$row3 = array();$row5 = array();
					$row2 = array();$row4 = array();
					$row1['name'] = 'Bahan Bakar Minyak';$row3['name'] = 'Listrik';
					$row2['name'] = 'Kompor/LPG';$row4['name'] = 'Rokok';$row5['name'] = 'Lain-lain';
					
					    $row1['data'][] = $sth1['bbm'];
					    $row2['data'][] = $sth2['kpr'];
					    $row3['data'][] = $sth3['lst'];
					    $row4['data'][] = $sth4['rk'];
					    $row5['data'][] = $sth5['lain'];
					
					$result = array();
					array_push($result,$row1);
					array_push($result,$row2);
					array_push($result,$row3);
					array_push($result,$row4);
					array_push($result,$row5);
					print json_encode($result, JSON_NUMERIC_CHECK);
				?>
				;
				setDynamicChart(chartype, chartTitle, chartCategories, chartData);
			}else if(chartype == 'column5'){
				var chartype 		= 'column';
				var chartTitle		= 'Tahun 2015';
				var	chartCategories = ['Penyebab'];
				var chartData		= 
				<?php
					$sth1 = mysql_fetch_assoc(mysql_query("SELECT COUNT(a.penyebab_nama) AS bbm
										FROM penyebab AS a INNER JOIN pasca AS b
										ON (a.penyebab_id = b.penyebab_id) INNER JOIN resiko AS c
										ON (c.resiko_id = b.resiko_id)
										WHERE a.penyebab_id = 1 AND c.resiko_tanggal_start BETWEEN '2015-01-01' AND '2015-12-31'"));
					$sth2 = mysql_fetch_assoc(mysql_query("SELECT COUNT(a.penyebab_nama) AS kpr
										FROM penyebab AS a INNER JOIN pasca AS b
										ON (a.penyebab_id = b.penyebab_id) INNER JOIN resiko AS c
										ON (c.resiko_id = b.resiko_id)
										WHERE a.penyebab_id = 2 AND c.resiko_tanggal_start BETWEEN '2015-01-01' AND '2015-12-31'"));
					$sth3 = mysql_fetch_assoc(mysql_query("SELECT COUNT(a.penyebab_nama) AS lst
										FROM penyebab AS a INNER JOIN pasca AS b
										ON (a.penyebab_id = b.penyebab_id) INNER JOIN resiko AS c
										ON (c.resiko_id = b.resiko_id)
										WHERE a.penyebab_id = 3 AND c.resiko_tanggal_start BETWEEN '2015-01-01' AND '2015-12-31'"));
					$sth4 = mysql_fetch_assoc(mysql_query("SELECT COUNT(a.penyebab_nama) AS rk
										FROM penyebab AS a INNER JOIN pasca AS b
										ON (a.penyebab_id = b.penyebab_id) INNER JOIN resiko AS c
										ON (c.resiko_id = b.resiko_id)
										WHERE a.penyebab_id = 4 AND c.resiko_tanggal_start BETWEEN '2015-01-01' AND '2015-12-31'"));
					$sth5 = mysql_fetch_assoc(mysql_query("SELECT COUNT(a.penyebab_nama) AS lain
										FROM penyebab AS a INNER JOIN pasca AS b
										ON (a.penyebab_id = b.penyebab_id) INNER JOIN resiko AS c
										ON (c.resiko_id = b.resiko_id)
										WHERE a.penyebab_id = 5 AND c.resiko_tanggal_start BETWEEN '2015-01-01' AND '2015-12-31'"));
					$row1 = array();$row3 = array();$row5 = array();
					$row2 = array();$row4 = array();
					$row1['name'] = 'Bahan Bakar Minyak';$row3['name'] = 'Listrik';
					$row2['name'] = 'Kompor/LPG';$row4['name'] = 'Rokok';$row5['name'] = 'Lain-lain';
					
					    $row1['data'][] = $sth1['bbm'];
					    $row2['data'][] = $sth2['kpr'];
					    $row3['data'][] = $sth3['lst'];
					    $row4['data'][] = $sth4['rk'];
					    $row5['data'][] = $sth5['lain'];
					
					$result = array();
					array_push($result,$row1);
					array_push($result,$row2);
					array_push($result,$row3);
					array_push($result,$row4);
					array_push($result,$row5);
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
			$('#column').highcharts({
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