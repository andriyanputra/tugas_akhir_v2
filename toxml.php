<?php
require("config/koneksi.php");

function parseToXML($htmlStr)
{
$xmlStr=str_replace('<','&lt;',$htmlStr);
$xmlStr=str_replace('>','&gt;',$xmlStr);
$xmlStr=str_replace('"','&quot;',$xmlStr);
$xmlStr=str_replace("'",'&#39;',$xmlStr);
$xmlStr=str_replace("&",'&amp;',$xmlStr);
return $xmlStr;
}

// Select all the rows in the markers table
$query = "SELECT a.Lat, a.Long, b.NAMA_SUMBER, c.KECAMATAN_NAMA, d.DESA_NAMA
                        FROM sumber_air_kecamatan AS a
                        INNER JOIN sumber_air AS b ON (a.ID_SUMBER = b.ID_SUMBER)
                        INNER JOIN kecamatan AS c ON (a.KECAMATAN_ID = c.KECAMATAN_ID)
                        INNER JOIN desa AS d ON (d.KECAMATAN_ID = c.KECAMATAN_ID)
                        ORDER BY b.ID_SUMBER";
$result = mysql_query($query);
if (!$result) {
  die('Invalid query: ' . mysql_error());
}

header("Content-type: text/xml");

// Start XML file, echo parent node
echo '<markers>';

// Iterate through the rows, printing XML nodes for each
while ($row = @mysql_fetch_assoc($result)){
  // ADD TO XML DOCUMENT NODE
  echo '<marker ';
  echo 'name="' . parseToXML($row['NAMA_SUMBER']) . '" ';
  echo 'address="' . parseToXML($row['DESA_NAMA']) . '" ';
  echo 'lat="' . $row['Lat'] . '" ';
  echo 'lng="' . $row['Long'] . '" ';
  echo 'category="' . $row['KECAMATAN_NAMA'] . '" ';
  echo '/>';
}

// End XML file
echo '</markers>';

?>
