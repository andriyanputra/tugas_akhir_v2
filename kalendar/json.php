<?php
include ("../config/koneksi.php");


$rs = mysql_query(
	"SELECT b.resiko_id AS id, d.NAMA_BANGUNAN AS title, b.resiko_tanggal_start AS start, b.nama_pelapor AS korban,
		b.resiko_tanggal_end AS end, b.alamat_pelapor AS alamat, c.KECAMATAN_NAMA AS kecamatan, a.DESA_NAMA AS desa
		FROM desa AS a INNER JOIN resiko AS b ON (a.DESA_ID = b.DESA_ID)
		INNER JOIN kecamatan AS c ON (c.KECAMATAN_ID = b.KECAMATAN_ID) AND (a.KECAMATAN_ID = c.KECAMATAN_ID)
		INNER JOIN bangunan AS d ON (d.ID_BANGUNAN = b.ID_BANGUNAN) INNER JOIN master_bangunan AS e
		ON (d.ID_MASTER = e.ID_MASTER)
		ORDER BY b.resiko_tanggal_start ASC"
	);
//mysql_connect("localhost", "root", "") or die("Could not connect");
//mysql_select_db("calendar") or die("Could not select database");

//$rs = mysql_query("SELECT * FROM versi2 ORDER BY start ASC");
$arr = array();

while($obj = mysql_fetch_object($rs)) {
$arr[] = $obj;
}
echo json_encode($arr);
?>