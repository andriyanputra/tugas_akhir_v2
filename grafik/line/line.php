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
		var chartype 		= 'bar';
		var chartTitle		= 'Browser Chart';
		var	chartCategories = ['Africa', 'America', 'Asia', 'Europe', 'Oceania'];
		var chartData		= [{name: 'Year 1800',data: [107, 31, 635, 203, 2]}, {name: 'Year 1900',data: [133, 156, 947, 408, 6]}, {name: 'Year 2008',data: [973, 914, 4054, 732, 34]}];
 
		//On page load call the function setDynamicChart and pass the variables
		setDynamicChart(chartype, chartTitle, chartCategories, chartData);
 
		//jQuery part - On Click call the function setDynamicChart(dynval) and pass title, chart type, category, data
		$('.space1').click(function(){
			//get the value from 'a' tag
			var chartype = $(this).attr('id');
 
			if(chartype == 'data1'){
				chartype 		= 'bar';
				chartTitle		= 'Browser Chart';
				chartCategories = ['Africa', 'America', 'Asia', 'Europe', 'Oceania'];
				chartData		= [{name: 'Year 1800',data: [107, 31, 635, 203, 2]}, {name: 'Year 1900',data: [133, 156, 947, 408, 6]}, {name: 'Year 2008',data: [973, 914, 4054, 732, 34]}];
				setDynamicChart(chartype, chartTitle, chartCategories, chartData);
			}else if(chartype == 'data2'){
				chartype 		= 'line';
				chartTitle		= 'Monthly Average Temperature';
				chartCategories = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun','Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
				chartData		= [{name: 'Tokyo', data: [7.0, 6.9, 9.5, 14.5, 18.2, 21.5, 25.2, 26.5, 23.3, 18.3, 13.9, 9.6]}, {name: 'New York', data: [-0.2, 0.8, 5.7, 11.3, 17.0, 22.0, 24.8, 24.1, 20.1, 14.1, 8.6, 2.5]}, {name: 'Berlin',data: [-0.9, 0.6, 3.5, 8.4, 13.5, 17.0, 18.6, 17.9, 14.3, 9.0, 3.9, 1.0]}, {name: 'London',data: [3.9, 4.2, 5.7, 8.5, 11.9, 15.2, 17.0, 16.6, 14.2, 10.3, 6.6, 4.8]}];
				setDynamicChart(chartype, chartTitle, chartCategories, chartData);
			}else if(chartype == 'data3'){
				chartype 		= 'line';
				chartTitle		= 'Monthly Average Rainfall';
				chartCategories = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun','Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
				chartData		= 
				<?php
					$sth = mysql_query("SELECT grafik_mpkp, grafik_mpkl, grafik_mpkbg FROM grafik WHERE grafik_thn = 2011");
					$row1 = array();$row3 = array();
					$row2 = array();
					$row1['name'] = 'MPKP';$row3['name'] = 'MPKBG';
					$row2['name'] = 'MPKL';
					while($r = mysql_fetch_array($sth)) {
					    $row1['data'][] = $r['grafik_mpkp'];
					    $row2['data'][] = $r['grafik_mpkl'];
					    $row3['data'][] = $r['grafik_mpkbg'];
					}
					$result = array();
					array_push($result,$row1);
					array_push($result,$row2);
					array_push($result,$row3);


					print json_encode($result, JSON_NUMERIC_CHECK);
				?>
				//{name: 'Tokyo',data: [49.9, 71.5, 106.4, 129.2, 144.0, 176.0, 135.6, 148.5, 216.4, 194.1, 95.6, 54.4]}, {name: 'New York',data: [83.6, 78.8, 98.5, 93.4, 106.0, 84.5, 105.0, 104.3, 91.2, 83.5, 106.6, 92.3]}, {name: 'London',data: [48.9, 38.8, 39.3, 41.4, 47.0, 48.3, 59.0, 59.6, 52.4, 65.2, 59.3, 51.2]}, {name: 'Berlin',data: [42.4, 33.2, 34.5, 39.7, 52.6, 75.5, 57.4, 60.4, 47.6, 39.1, 46.8, 51.1]}
				;
				setDynamicChart(chartype, chartTitle, chartCategories, chartData);
			}else if(chartype == 'data4'){
				chartype 		= 'line';
				chartTitle		= 'Monthly Average Temperature';
				chartData		= [{type: 'pie',name: 'Jumlah Kejadian Kebakaran pada Bangunan',
				data: [
				<?php
$query = mysql_query("SELECT c.NAMA_MASTER, COUNT(c.NAMA_MASTER) AS Nilai
                                            FROM resiko AS a
                                                INNER JOIN bangunan AS b 
                                                    ON (a.ID_BANGUNAN = b.ID_BANGUNAN)
                                                INNER JOIN master_bangunan AS c
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
			$('#line-chart2').highcharts({
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
						cursor: 'pointer'
					}
				},
				series: chartData
			});
		}
    });
</script>