<?php

require("../../config/koneksi.php");

function parseToXML($htmlStr) {
    $xmlStr = str_replace('<', '&lt;', $htmlStr);
    $xmlStr = str_replace('>', '&gt;', $xmlStr);
    $xmlStr = str_replace('"', '&quot;', $xmlStr);
    $xmlStr = str_replace("'", '&#39;', $xmlStr);
    $xmlStr = str_replace("&", '&amp;', $xmlStr);
    return $xmlStr;
}

// Opens a connection to a MySQL server
// Select all the rows in the markers table
$query = mysql_query("SELECT a.Lat, a.Long, b.NAMA_SUMBER, c.KECAMATAN_NAMA, d.DESA_NAMA
                        FROM sumber_air_kecamatan AS a
                        INNER JOIN sumber_air AS b ON (a.ID_SUMBER = b.ID_SUMBER)
                        INNER JOIN kecamatan AS c ON (a.KECAMATAN_ID = c.KECAMATAN_ID)
                        INNER JOIN desa AS d ON (d.KECAMATAN_ID = c.KECAMATAN_ID)
                        ORDER BY b.ID_SUMBER");

if (!$query) {
    die('Invalid query: ' . mysql_error());
}
header("Content-type: text/xml");
// Start XML file, echo parent node
echo '<markers>';
// Iterate through the rows, printing XML nodes for each
while ($row = @mysql_fetch_assoc($query)) {
    // ADD TO XML DOCUMENT NODE
    echo '<marker ';
    echo 'nama="' . parseToXML($row['NAMA_SUMBER']) . '" ';
    echo 'alamat= Ds. "' . parseToXML($row['DESA_NAMA']) . '", Kec. "' . parseToXML($row['KECAMATAN_NAMA']) . '" ';
    echo 'lat="' . $row['Lat'] . '" ';
    echo 'lng="' . $row['Long'] . '" ';
    echo '/>';
}
echo 'category=water';
// End XML file
echo '</markers>';
?>