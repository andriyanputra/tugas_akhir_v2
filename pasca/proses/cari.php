<?php
include ("../../config/koneksi.php");
$desa = intval($_GET['cari']);

$query = "SELECT a.nama_pelapor, a.resiko_tanggal, b.DESA_NAMA, c.NAMA_BANGUNAN, d.KECAMATAN_NAMA, a.alamat_pelapor
        FROM resiko AS a INNER JOIN desa AS b
            ON (a.DESA_ID = b.DESA_ID)
        INNER JOIN bangunan AS c
            ON (a.ID_BANGUNAN = c.ID_BANGUNAN)
        INNER JOIN kecamatan AS d
            ON (a.KECAMATAN_ID = d.KECAMATAN_ID) AND (b.KECAMATAN_ID = d.KECAMATAN_ID)
        WHERE b.DESA_ID = '$desa' ";
$q_=mysql_query($query);

echo "<div class='table-header'>Daftar Kejadian Kebakaran di Kabupaten Sidoarjo</div>

                                                    <table class='table table-striped table-bordered table-hover'>
                                                        <thead>
                                                            <tr>
                                                                <th>No.</th>
                                                                <th>Nama Pelapor</th>
                                                                <th>Lokasi Kejadian</th>
                                                                <th>Tanggal Kejadian</th>
                                                                <th></th>
                                                            </tr>
                                                        </thead>

                                                        <tbody>";
$no = 1;
while($res = mysql_fetch_array($q_)) {
	$result_tgl = date_create($res['resiko_tanggal']);
	  echo "<tr>";
	  echo "<td>" . $no . "</td>";
	  echo "<td>" . $res['nama_pelapor'] . "</td>";
	  echo "<td>" . $res['alamat_pelapor']." Ds. ".$res['DESA_NAMA']." Kec. ".$res['KECAMATAN_NAMA']." Kab. Sidoarjo.</td>";
	  echo "<td>" . date_format($result_tgl, 'd-m-Y H:i:s') . "</td>";
	  echo "<td>wew</td>";
	  echo "</tr>";
	  $no++; 
}
echo " </tbody></table>";
?>