<?php

include('../../config/config.php');

$nSumber = $_POST['nama_sumber'];
$lSumber1 = $_POST['lokasi_sumber1'];
$lSumber2 = $_POST['lokasi_sumber2'];
$lSumber3 = $_POST['lSumber'];
$ketSumber = $_POST['keterangan'];
$id_sumber = $_POST['id_sumber'];

$qnama = mysql_query("SELECT NAMA_SUMBER, KET_SUMBER FROM sumber_air WHERE NAMA_SUMBER = '" . $nSumber . "'") or die("Query failed: " . mysql_error());
$qlokasi = mysql_query("SELECT GROUP_CONCAT(kecamatan.KECAMATAN_ID SEPARATOR ', ') AS id, GROUP_CONCAT(kecamatan.KECAMATAN_NAMA SEPARATOR ', ') AS Kecamatan
                    FROM sumber_air a 
                    JOIN sumber_air_kecamatan ON a.ID_SUMBER=sumber_air_kecamatan.ID_SUMBER
                    JOIN kecamatan ON sumber_air_kecamatan.KECAMATAN_ID=kecamatan.KECAMATAN_ID
                    WHERE a.ID_SUMBER = '" . $id_sumber . "' ") or die("Query failed: " . mysql_error());
$a = mysql_fetch_array($qlokasi);
$b = mysql_fetch_assoc($qnama);
if ($b['NAMA_SUMBER'] == $nSumber) {
    if (empty($lSumber3)) {
        if ($b['KET_SUMBER'] == $ketSumber) {
            if (!empty($lSumber1)) {
                foreach ($lSumber1 as $v1) {
                    if ($a['id'] == $v1) {
                        header('location:../sumber.php?msg=notif1');
                    } else {
                        mysql_query("DELETE FROM sumber_air_kecamatan WHERE KECAMATAN_ID = '" . $v1 . "'") or die("Query delete failed: " . mysql_error());
                    }
                }
            }
            if (!empty($lSumber2)) {
                foreach ($lSumber2 as $v2) {
                    if ($a['id'] == $v2) {
                        header('location:../sumber.php?msg=notif1');
                    }
                }
            }
        }
    } else {
        if (is_array($lSumber3)) {
            foreach ($lSumber3 as $v3) {
                if ($a['id'] == $v3) {
                    header('location:../sumber.php?msg=notif2');
                } else {
                    mysql_query("INSERT INTO sumber_air_kecamatan VALUES ('" . $id_sumber . "', '" . $v3 . "')") or die("Query insert lokasi baru failed: " . mysql_error());
                }
            }
            header('Location: ../sumber.php?msg=success_edit');
        }
    }
} else {
    $qupdate = mysql_query("UPDATE tugas_akhir.sumber_air SET NAMA_SUMBER = '" . $nSumber . "', KET_SUMBER = '" . $ketSumber . "'
                WHERE ID_SUMBER = '" . $id_sumber . "' AND ID_SUMBER = LAST_INSERT_ID('" . $id_sumber . "')") or die("Query update data failed: " . mysql_error());
    header('Location: ../sumber.php?msg=success_edit');
    /* if(is_array($lSumber2)){
      foreach ($lSumber2 AS $v2) {
      mysql_query("UPDATE sumber_air_kecamatan SET ID_SUMBER = '" . $ganti_id . "', '" . $v2 . "')");
      }
      }
      if(is_array($lSumber3)){
      foreach ($lSumber3 AS $v3) {
      mysql_query("UPDATE sumber_air_kecamatan SET ID_SUMBER = '" . $ganti_id . "', '" . $v3 . "')");
      }
      }
      //header('Location: ../sumber.php?msg=success_edit'); */
}

/* if (is_array($lSumber1)) {
  foreach ($lSumber1 as $v1) {
  echo 'lokasi sumber eksis (edit):' . $v1 . ', <br/>';
  }
  }
  if (is_array($lSumber2)) {
  foreach ($lSumber2 as $v2) {
  echo 'lokasi sumber eksis (disable) :' . $v2 . ', <br/>';
  }
  }
  if (is_array($lSumber3)) {
  foreach ($lSumber3 as $v3) {
  echo 'lokasi sumber baru :' . $v3 . ', <br/>';
  }
  }

  echo $nSumber . '<br/>';
  echo $ketSumber . '<br/>';
  echo $id_sumber;

  if ($id_sumber) {
  echo $nSumber;
  if (empty($lSumber1) || empty($lSumber2)) {
  if ($nSumber == $_POST['nama_sumber'] && $lSumber3 = $_POST['lSumber'] && $ketSumber = $_POST['keterangan']) {
  header('location:../sumber.php?msg=notif');
  }
  }
  } */
?>