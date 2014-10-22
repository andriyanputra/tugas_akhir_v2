<?php
include 'config/koneksi.php';
for($i=3; $i<=4; $i++){
$log = mysql_query("SELECT * FROM resiko
                    WHERE resiko_tanggal BETWEEN '2013-$i-01' AND '2013-$i-31'
                    ORDER BY resiko_tanggal ASC") or die("Query : ".mysql_error());
//if (mysql_num_rows($log)) {
        while ($row = mysql_fetch_assoc($log)) { // this method will prevent SQL Injections. This will gather the password on the same row as the username.
            //$db_password = $row[1]; //this will store that password on a variable
            //if ($pass == $db_password) {   //this will check if the password inputted by the user is the same as the one stored on the database.
                //$loginok = TRUE;
                echo '<br><br>'.$i.'<br>';
                echo $row['resiko_id'].'<br>';
                echo $row['resiko_tanggal'].'<br>';
                echo $row['nama_pelapor'].'<br>';
                echo $row['nomor_telp'].'<br>';
                echo $row['alamat_pelapor'].'<br>';
                echo $row['ID_BANGUNAN'].'<br>';
                echo $row['DESA_ID'].'<br>';
                echo $row['KECAMATAN_ID'].'<br>';
                echo $row['ID_SUMBER'].'<br>';
                echo $row['exposure'].'<br>';
                echo $row['tepol'].'<br>';
                echo $row['panjang'].'<br>';echo $row['lebar'].'<br>';echo $row['tinggi'].'<br>';
                echo $row['penerapan_air'].'<br>';echo $row['pengangkutan_air'].'<br>';echo $row['tipe_proteksi'].'<br>';
                echo $row['resiko_status'];
            //} else {
                 //header('location:../login/login.php?msg=log_error01');
                //exit();
            }
        //}
    }

?>
