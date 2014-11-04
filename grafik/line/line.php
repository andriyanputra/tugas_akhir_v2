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
		var chartype 		= 'line';
		var chartTitle		= 'Tahun 2011';
		var	chartCategories = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun','Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
		var chartData		= 
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
		;
 
		//On page load call the function setDynamicChart and pass the variables
		setDynamicChart(chartype, chartTitle, chartCategories, chartData);
 
		//jQuery part - On Click call the function setDynamicChart(dynval) and pass title, chart type, category, data
		$('.space1').click(function(){
			//get the value from 'a' tag
			var chartype = $(this).attr('id');
 
			if(chartype == 'data1'){
				chartype 		= 'line';
				chartTitle		= 'Tahun 2011';
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
				;
				setDynamicChart(chartype, chartTitle, chartCategories, chartData);
			}else if(chartype == 'data2'){
				chartype 		= 'line';
				chartTitle		= 'Tahun 2012';
				chartCategories = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun','Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
				chartData		= 
				<?php
					$sth = mysql_query("SELECT grafik_mpkp, grafik_mpkl, grafik_mpkbg FROM grafik WHERE grafik_thn = 2012");
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
				;
				setDynamicChart(chartype, chartTitle, chartCategories, chartData);
			}else if(chartype == 'data3'){
				chartype 		= 'line';
				chartTitle		= 'Tahun 2013';
				chartData		= [{type: 'pie',name: 'Jumlah Kejadian Kebakaran pada Bangunan',
				data: [
				<?php
					$sth = mysql_query("SELECT tipe_proteksi, COUNT(tipe_proteksi) AS nilai
                            FROM resiko
                            WHERE resiko_tanggal_start BETWEEN '2013-01-01' AND '2013-12-31'
                            GROUP BY tipe_proteksi");
					$numrows = mysql_num_rows($sth);
					while ($row = mysql_fetch_array($sth)) {
					    $data[0] = $row['tipe_proteksi'];
					    $data[1] = $row['nilai'];
					    echo "['" . $data[0] . "', " . $data[1] . "],";
					}
					?> ]}];
				setDynamicChart(chartype, chartTitle, chartCategories, chartData);
			}else if(chartype == 'data4'){
				chartype 		= 'line';
				chartTitle		= 'Tahun 2014';
				chartData		= [{type: 'pie',name: 'Jumlah Kejadian Kebakaran pada Bangunan',
				data: [
				<?php
$query = mysql_query("SELECT tipe_proteksi, COUNT(tipe_proteksi) AS nilai
                            FROM resiko
                            WHERE resiko_tanggal_start BETWEEN '2014-01-01' AND '2014-12-31'
                            GROUP BY tipe_proteksi");
$numrows = mysql_num_rows($query);
while ($row = mysql_fetch_array($query)) {
    $data[0] = $row['tipe_proteksi'];
    $data[1] = $row['nilai'];
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