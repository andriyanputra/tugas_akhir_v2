<?php

include "../../config/koneksi.php";
if ($_POST) {

    $nama = $_POST['nama'];
    $alamat = $_POST['alamat'];
    $bangunan = $_POST['bangunan'];
    $bangunanBaru = $_POST['bangunan_tbaru'];
    $penyebab = $_POST['penyebab'];
    $penyebabBaru = $_POST['penyebab_baru'];
    $luas = $_POST['luas'];
    $luas_total = $_POST['luas_total'];
    $korban_luka = $_POST['korban_luka'];
    $korban_meninggal = $_POST['korban_meninggal'];
    $biaya = $_POST['biaya'];
    $pasca_id = $_POST['pasca_id'];
    $pasca_status = 'yes';
    if($_POST['akhir_perjalanan'] == '00:00' || $_POST['pemadaman'] == '00:00'){
        header("Location: ../olahPasca?id=$pasca_id&msg=error");
    }else{
        //$awal = $_POST['awal_perjalanan'];
        $akhir = $_POST['akhir_perjalanan'];
        $pemadaman = $_POST['pemadaman'];
    }
    
    
    //============================== R E S I K O===================================
    $query = mysql_query("SELECT * FROM bangunan AS a
                    INNER JOIN resiko AS b ON (a.ID_BANGUNAN = b.ID_BANGUNAN)
                    INNER JOIN master_bangunan AS c ON (a.ID_MASTER = c.ID_MASTER)
                    WHERE b.resiko_id = '$pasca_id'");
    if ($query) {
        $row = mysql_fetch_array($query);
    } else {
        die(mysql_error());
    }
    $tgl = $row['resiko_tanggal'];
    $awal = date('H:i', strtotime($tgl));          
    $nama = $row['nama_pelapor'];
    $no = $row['nomor_telp'];
    $alamat = $row['alamat_pelapor'];
    $bangunan = $row['ID_BANGUNAN'];
    $desa = $row['DESA_ID'];
    $kecamatan = $row['KECAMATAN_ID'];
    $sumber = $row['ID_SUMBER'];
    $exposure = $row['exposure'];
    $tepol = $row['tepol'];
    $p = $row['panjang'];
    $l = $row['lebar'];
    $t = $row['tinggi'];        
    $minim = $row['pasokan_air_minimum'];
    $laju = $row['penerapan_air'];
    $angkut = $row['pengangkutan_air'];
    $proteksi = $row['tipe_proteksi'];

    //=======HiTUNG WAKTU==========
    function beda_waktu($time1, $time2) {
        $time1 = strtotime("1980-01-01 $time1");
        $time2 = strtotime("1980-01-01 $time2");
        
        if ($time2 < $time1) {
            $time2 += 86400;
        }
        
        return date("H:i", strtotime("1980-01-01 00:00:00") + ($time2 - $time1));
    } 
    $hasil = beda_waktu($awal,$akhir);
    $check = $_POST['check'];
    /*echo $check.'<br>';
    echo $nama.'<br>'.$alamat.'<br>'.$awal.'<br>'.$akhir.'<br>'.$hasil.'<br>'.$pemadaman.'<br>';
    echo $no_.'<br>'.$tujuan.'<br>'.$nama_barang.'<br>'.$jml_barang.'<br>'.$isi_pesan.'<br>';
    echo $bangunan.'<br>'.$bangunanBaru.'<br>'.$penyebab.'<br>'.$penyebabBaru.'<br>';
    echo $luas.'<br>'.$luas_total.'<br>'.$korban_luka.'<br>'.$korban_meninggal.'<br>'.$biaya.'<br>'.$pasca_id.'<br>'.$pasca_status;*/
?>
<!DOCTYPE html>
    <html lang="en">
        <head>
            <meta charset="utf-8" />
            <title>SIM Proteksi Kebakaran Perkotaan</title>

            <meta name="description" content="Common form elements and layouts" />
            <meta name="viewport" content="width=device-width, initial-scale=1.0" />
            <!--page specific plugin styles-->
            <link rel="shortcut icon" href="../../assets/img/favicon.png">
            <!--fonts-->

            <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Open+Sans:400,300" />

            <!--ace styles-->
            <script src="../../assets/js-ace/sweet-alert.js"></script>
            <link rel="stylesheet" type="text/css" href="../../assets/css-ace/sweet-alert.css">

            <!--inline styles related to this page-->
            <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        </head>
    <body>
<?php
    if ($check == 'on' && !empty($bangunanBaru) && !empty($luas_total) && !empty($penyebabBaru)) {
        $insert = mysql_query("INSERT INTO pasca
            (`pasca_id`, `resiko_id`, `pasca_lama_perjalanan`, `pasca_penyelesaian`, `pasca_penyebab`, `ID_BANGUNAN_BARU`, `pasca_luas`, `pasca_luka`, `pasca_meninggal`, `pasca_biaya`)
             VALUES 
            ( NULL,'$pasca_id', '$hasil', '$pemadaman','$penyebab', '$bangunanBaru', '$luas_total','$korban_luka',
            '$korban_meninggal','$biaya')") or die("Query : ".mysql_error());

        //=== PENYEBAB LAIN ===
        $id = mysql_fetch_assoc(mysql_query("SELECT pasca_id FROM pasca ORDER BY pasca_id DESC LIMIT 1")) or die ('Query Id terakhir : '.mysql_error());
        $id_pasca = $id['pasca_id'];
        $insert_pLain = mysql_query("INSERT INTO penyebab_lain (`lain_ID`, `pasca_id`, `penyebab_id`, `lain_tgl`, `lain_nama`) VALUES ('','$id_pasca','$penyebab','$tgl','$penyebabBaru')") or die("Query: ".mysql_error());

        //=== R E SI K O ===
        $update = mysql_query("UPDATE resiko SET
                                resiko_id = '$pasca_id',
                                resiko_tanggal = '$tgl',
                                nama_pelapor = '$nama',
                                nomor_telp ='$no',
                                alamat_pelapor = '$alamat',
                                ID_BANGUNAN = '$bangunan',
                                DESA_ID = '$desa',
                                KECAMATAN_ID = '$kecamatan',
                                ID_SUMBER = '$sumber',
                                exposure = '$exposure',
                                tepol = '$tepol',
                                panjang= '$p',
                                lebar = '$l',
                                tinggi = '$t',
                                pasokan_air_minimum = '$minim',
                                penerapan_air = '$laju',
                                pengangkutan_air = '$angkut',
                                tipe_proteksi = '$proteksi',
                                resiko_status = 'yes'
                                WHERE resiko_id = '$pasca_id'") or die("Query : ".mysql_error());

        if($insert && $insert_pLain && $update){
        ?>
        <script type="text/javascript">
            setTimeout(function() {
                swal({
                    title: "Great Work and Well Done!",
                    text: "Keep Fire in Your Life.",
                    imageUrl: '../../assets/img/thumbs-up.jpg'
                });
            }, 200);
            
            document.location = '../../beranda/index.php';
        </script>
        <?php
        }else{
            echo "Gagal Update";
        }

    }else if($check == 'on' && !empty($bangunanBaru) && !empty($luas_total)){
        $insert = mysql_query("INSERT INTO pasca
            (`pasca_id`, `resiko_id`, `pasca_lama_perjalanan`, `pasca_penyelesaian`, `pasca_penyebab`, `ID_BANGUNAN_BARU`, `pasca_luas`, `pasca_luka`, `pasca_meninggal`, `pasca_biaya`)
             VALUES 
            ( NULL,'$pasca_id', '$hasil', '$pemadaman','$penyebab', '$bangunanBaru', '$luas_total','$korban_luka',
            '$korban_meninggal','$biaya')") or die("Query : ".mysql_error());

        //=== R E SI K O ===
        $update = mysql_query("UPDATE resiko SET
                                resiko_id = '$pasca_id',
                                resiko_tanggal = '$tgl',
                                nama_pelapor = '$nama',
                                nomor_telp ='$no',
                                alamat_pelapor = '$alamat',
                                ID_BANGUNAN = '$bangunan',
                                DESA_ID = '$desa',
                                KECAMATAN_ID = '$kecamatan',
                                ID_SUMBER = '$sumber',
                                exposure = '$exposure',
                                tepol = '$tepol',
                                panjang= '$p',
                                lebar = '$l',
                                tinggi = '$t',
                                pasokan_air_minimum = '$minim',
                                penerapan_air = '$laju',
                                pengangkutan_air = '$angkut',
                                tipe_proteksi = '$proteksi',
                                resiko_status = 'yes'
                                WHERE resiko_id = '$pasca_id'") or die("Query : ".mysql_error());

        if($insert && $update){
        ?>
        <script type="text/javascript">
            setTimeout(function() {
                swal({
                    title: "Great Work and Well Done!",
                    text: "Keep Fire in Your Life.",
                    imageUrl: '../../assets/img/thumbs-up.jpg'
                });
            }, 200);
            
            document.location = '../../beranda/index.php';
        </script>
        <?php
        }else{
            echo "Gagal Update";
        }

    }else if(!empty($penyebabBaru)){
        $insert = mysql_query("INSERT INTO pasca
            (`pasca_id`, `resiko_id`, `pasca_lama_perjalanan`, `pasca_penyelesaian`, `pasca_penyebab`, `ID_BANGUNAN_BARU`, `pasca_luas`, `pasca_luka`, `pasca_meninggal`, `pasca_biaya`)
            VALUES 
            ( NULL,'$pasca_id', '$hasil', '$pemadaman','$penyebab', '$bangunanBaru', '$luas_total','$korban_luka',
            '$korban_meninggal','$biaya')") or die("Query : ".mysql_error());

        //=== PENYEBAB LAIN ===
        $id = mysql_fetch_assoc(mysql_query("SELECT pasca_id FROM pasca ORDER BY pasca_id DESC LIMIT 1")) or die ('Query Id terakhir : '.mysql_error());
        $id_pasca = $id['pasca_id'];
        $insert_pLain = mysql_query("INSERT INTO penyebab_lain (`lain_ID`, `pasca_id`, `penyebab_id`, `lain_tgl`, `lain_nama`) VALUES ('','$id_pasca','$penyebab','$tgl','$penyebabBaru')") or die("Query: ".mysql_error());

        //=== R E SI K O ===
        $update = mysql_query("UPDATE resiko SET
                                resiko_id = '$pasca_id',
                                resiko_tanggal = '$tgl',
                                nama_pelapor = '$nama',
                                nomor_telp ='$no',
                                alamat_pelapor = '$alamat',
                                ID_BANGUNAN = '$bangunan',
                                DESA_ID = '$desa',
                                KECAMATAN_ID = '$kecamatan',
                                ID_SUMBER = '$sumber',
                                exposure = '$exposure',
                                tepol = '$tepol',
                                panjang= '$p',
                                lebar = '$l',
                                tinggi = '$t',
                                pasokan_air_minimum = '$minim',
                                penerapan_air = '$laju',
                                pengangkutan_air = '$angkut',
                                tipe_proteksi = '$proteksi',
                                resiko_status = 'yes'
                                WHERE resiko_id = '$pasca_id'") or die("Query : ".mysql_error());

        if($insert && $insert_pLain && $update){
        ?>
            <script type="text/javascript">
                setTimeout(function() {
                    swal({
                        title: "Great Work and Well Done!",
                        text: "Keep Fire in Your Life.",
                        imageUrl: '../../assets/img/thumbs-up.jpg'
                    });
                }, 200);
                
                document.location = '../../beranda/index.php';
            </script>
        <?php
        }else{
            echo "Gagal Update";
        }

    }else{
        $insert = mysql_query("INSERT INTO pasca
            (`pasca_id`, `resiko_id`, `pasca_lama_perjalanan`, `pasca_penyelesaian`, `pasca_penyebab`, `ID_BANGUNAN_BARU`, `pasca_luas`, `pasca_luka`, `pasca_meninggal`, `pasca_biaya`)
            VALUES 
            ( NULL,'$pasca_id', '$hasil', '$pemadaman','$penyebab', '$bangunanBaru', '$luas_total','$korban_luka',
            '$korban_meninggal','$biaya')") or die("Query : ".mysql_error());

        //=== R E SI K O ===
        $update = mysql_query("UPDATE resiko SET
                                resiko_id = '$pasca_id',
                                resiko_tanggal = '$tgl',
                                nama_pelapor = '$nama',
                                nomor_telp ='$no',
                                alamat_pelapor = '$alamat',
                                ID_BANGUNAN = '$bangunan',
                                DESA_ID = '$desa',
                                KECAMATAN_ID = '$kecamatan',
                                ID_SUMBER = '$sumber',
                                exposure = '$exposure',
                                tepol = '$tepol',
                                panjang= '$p',
                                lebar = '$l',
                                tinggi = '$t',
                                pasokan_air_minimum = '$minim',
                                penerapan_air = '$laju',
                                pengangkutan_air = '$angkut',
                                tipe_proteksi = '$proteksi',
                                resiko_status = 'yes'
                                WHERE resiko_id = '$pasca_id'") or die("Query : ".mysql_error());

        if($insert && $update){
        ?>
            <script type="text/javascript">
                setTimeout(function() {
                    swal({
                        title: "Great Work and Well Done!",
                        text: "Keep Fire in Your Life.",
                        imageUrl: '../../assets/img/thumbs-up.jpg'
                    });
                }, 200);
                
                document.location = '../../beranda/index.php';
            </script>
        <?php
        }else{
            echo "Gagal Update";
        }
    }


}
?>
    </body>
</html>