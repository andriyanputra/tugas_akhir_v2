<?php

include('../../config/config.php');
if ($_POST) {
    $id= $_POST['id_bangunan'];
    $nama = $_POST['nama'];
    $kriteria = $_POST['kriteria'];
    $tingkat = $_POST['tingkat'];
    $keterangan = $_POST['keterangan'];
    
    $q = mysql_fetch_assoc(mysql_query("SELECT ID_MASTER FROM master_bangunan WHERE NAMA_MASTER = '$kriteria'"));
    $id_master = $q['ID_MASTER'];
    $update = mysql_query("UPDATE bangunan SET
                                    ID_BANGUNAN = '$id',
                                    ID_MASTER = '$id_master',
                                    NAMA_BANGUNAN = '$nama',
                                    TINGKAT_BANGUNAN = '$tingkat',
                                    KET_BANGUNAN = '$keterangan'
                                    WHERE ID_BANGUNAN= '$id'");
    if($update){
        header('Location: ../bangunan.php?msg=success_edit');
    }else{
         die('<META HTTP-EQUIV="Refresh" CONTENT="0;URL=../analisis.php?msg=error1">');
    }
}
?>