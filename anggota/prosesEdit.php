<?php

include "../config/koneksi.php";

if (isset($_POST['submit'])) {

    $nip = $_POST['nomor'];
    $nama = addslashes(htmlentities(ucwords($_POST['nama'])));
    $tempat = addslashes(htmlentities(ucwords($_POST['tempat'])));
    $gender = addslashes(htmlentities(ucwords($_POST['gender'])));

    $photo_lama = $_POST['foto_lama'];
    $photo_baru = $_FILES['foto']['name']; // Mendapatkan nama gambar
    $type = $_FILES['foto']['type'];
    $ukuran = $_FILES['foto']['size'];

    $ttl = $_POST['tanggal'];
    $tgl_format = date("Y-m-d", strtotime($ttl));
    $alamat = addslashes(htmlentities(ucwords($_POST['alamat'])));
    $phone = $_POST['phone'];
    $level = $_POST['level'];

    if (empty($_POST['password_baru'])) {
        $password = $_POST['password_lama'];
    } else {
        $password = md5($_POST['password_baru']);
    }

    $q = mysql_query("SELECT *
                        FROM pegawai
                            INNER JOIN jabatan 
                                ON (pegawai.jabatan_id = jabatan.jabatan_id)
                        WHERE jabatan_nama = '" . $_POST['jabatan'] . "' AND pegawai_email = '" . $email . "'");
    $row = mysql_num_rows($q);
    if ($_POST['jabatan'] == $row['jabatan_nama'] && addslashes(htmlentities($_POST['email'])) == $row['pegawai_email']) {
        $jabatan = $row['jabatan_id'];
        $email = $row['pegawai_email'];
    } else if ($_POST['jabatan'] != $row['jabatan_nama']) {
        $jabatans = $_POST['jabatan'];
        $q_ = mysql_fetch_array(mysql_query("select * from jabatan where jabatan_nama = '" . $jabatans . "'"));
        $temp = $q_['jabatan_id'];
        $jabatans = $temp;
        $jabatan = $jabatans;
        $email = addslashes(htmlentities($_POST['email']));
    }

    //echo 'Tanggal : '.$tgl_format;

    if (empty($photo_baru)) {
        $nama_file_upload = $photo_lama;
        $update = mysql_query("UPDATE pegawai SET
                          pegawai_nip = '$nip',
                          id_level_user = '$level',
                          pegawai_nama = '$nama',
                          pegawai_tempat = '$tempat',
                          pegawai_tanggal = '$tgl_format',
                          pegawai_kelamin = '$gender',
                          pegawai_alamat = '$alamat',
                          pegawai_no_telp = '$phone',
                          jabatan_id = '$jabatan',
                          pegawai_email = '$email',
                          pegawai_password = '$password',
                          pegawai_foto = '$nama_file_upload'
                          WHERE pegawai_nip = '$nip'");
    } else {
        $lokasi = "../assets/img/img-anggota";
        $lokasi_foto = $_FILES['foto']['tmp_name'];
        $tgl = date("dmy");
        $nama_file_upload = $tgl . '-' . $photo_baru;
        $alamatfile = $lokasi . $nama_file_upload;

        if ($type != "image/gif" && $type != "image/jpg" && $type != "image/jpeg" && $type != "image/png") {
            header('location:edit.php?nip=' . $nip . '&msg=error_foto1');
        } else {
            if ($ukuran > 1100000) {
                header('location:edit.php?nip=' . $nip . '&msg=error_foto2');
            } else {
                unlink($lokasi . "/" . $photo_lama);
                move_uploaded_file($lokasi_foto, $lokasi . "/" . $nama_file_upload);
                $update = mysql_query("UPDATE pegawai SET
                  pegawai_nip = '$nip',
                  id_level_user = '$level',
                  pegawai_nama = '$nama',
                  pegawai_tempat = '$tempat',
                  pegawai_tanggal = '$tgl_format',
                  pegawai_kelamin = '$gender',
                  pegawai_alamat = '$alamat',
                  pegawai_no_telp = '$phone',
                  jabatan_id = '$jabatan',
                  pegawai_email = '$email',
                  pegawai_password = '$password',
                  pegawai_foto = '$nama_file_upload'
                  WHERE pegawai_nip = '$nip'");
            }
        }
    }
    if ($update) {
        header('Location:list.php?msg=success2');
    } else {
        header('Location:list.php?msg=error1');
    }
}
?>
