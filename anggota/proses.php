<?php

include "../config/koneksi.php";
if (isset($_POST['submit'])) {

    $nip = $_POST['nomor'];
    $nama = addslashes(htmlentities(ucwords($_POST['nama'])));
    $tempat = addslashes(htmlentities(ucwords($_POST['tempat'])));
    $ttl = $_POST['tanggal'];
    $tgl_format = date("Y-m-d", strtotime($ttl));
    $alamat = addslashes(htmlentities(ucwords($_POST['alamat'])));
    $phone = $_POST['phone'];
    $jabatan = $_POST['jabatan'];
    $gender = $_POST['gender'];
    $email = addslashes(htmlentities($_POST['email']));
    $level = $_POST['level'];
    $pass1 = md5($_POST['password']);

    $nama_gambar = $_FILES['foto'] ['name']; // Mendapatkan nama gambar
    $type = $_FILES['foto']['type'];
    $ukuran = $_FILES['foto']['size'];
    //Cek NIP//
    $sql_nip = mysql_query("SELECT pegawai_nip FROM pegawai WHERE pegawai_nip ='" . $nip . "'") or die(mysql_error());
    $check_nip = mysql_num_rows($sql_nip);
    $sql_email = mysql_query("SELECT pegawai_email FROM pegawai WHERE pegawai_email ='" . $email . "'") or die(mysql_error());
    $check_email = mysql_num_rows($sql_email);
    if ($check_nip > 0) {
        header('location:tambah.php?msg=error_nip');
        exit();
    } else if ($check_email > 0) {
        header('location:tambah.php?msg=error_email');
        exit();
    } else {
        //cek type foto
        if ($type != "image/gif" && $type != "image/jpg" && $type != "image/jpeg" && $type != "image/png") {
            header('location:tambah.php?msg=error_foto1');
        } else {
            if ($ukuran > 1100000) {
                header('location:tambah.php?msg=error_foto2');
            } else {
                $lokasi = "../assets/img/img-anggota";
                $lokasi_foto = $_FILES['foto']['tmp_name'];
                $tgl = date("dmy");
                $nama_file_upload = $tgl . '-' . $nama_gambar;
                $alamatfile = $lokasi . $nama_file_upload;

                if (move_uploaded_file($lokasi_foto, $lokasi . "/" . $nama_file_upload)) {
                    $query = "INSERT INTO pegawai 
                                            (pegawai_nip, 
                                            id_level_user, 
                                            pegawai_nama, 
                                            pegawai_tempat, 
                                            pegawai_tanggal, 
                                            pegawai_kelamin, 
                                            pegawai_alamat, 
                                            pegawai_no_telp, 
                                            jabatan_id, 
                                            pegawai_email, 
                                            pegawai_password, 
                                            pegawai_foto
                                            )
                                            VALUES
                                            ('$nip', 
                                            '$level', 
                                            '$nama', 
                                            '$tempat', 
                                            '$tgl_format', 
                                            '$gender', 
                                            '$alamat', 
                                            '$phone', 
                                            '$jabatan', 
                                            '$email', 
                                            '$pass1', 
                                            '$nama_file_upload'
                                            )";
                    $result = mysql_query($query);
                    if ($result) {
                        header('Location:list.php?msg=success1');
                    } else {
                        header('Location:tambah.php?msg=error');
                    }
                } else {
                    header('Location:tambah.php?msg=error_foto4');
                }
            }
        }
    }
}
?>
