<?php
include "../config/koneksi.php";

$nama_gambar = $_FILES['foto'] ['name']; // Mendapatkan nama gambar
$lokasi = $_FILES['foto'] ['tmp_name'];

// Menyiapkan tempat nemapung gambar yang diupload
$lokasitujuan = "../assets/img/img-anggota";

if (file_exists("../assets/img/img-anggota" . $_FILES["file"]["name"])) {
    echo $_FILES["foto"]["name"] . " already exists. ";
} else {
    move_uploaded_file($lokasi, $lokasitujuan . "/" . $nama_gambar);
}

//$query=mysql_query("insert into upload (nama_gambar) values ('".$nama_gambar."')");
//echo "Gambar berhasil diuplaod";
// Merefresh halaman
//echo "<meta http-equiv='refresh' content=3;url='./'>";



$nip = $_POST['nomor'];
$nama = $_POST['nama'];
$tempat = $_POST['tempat'];
$ttl = $_POST['tanggal'];
$tgl_format = date("Y-m-d", strtotime($ttl));
$alamat = $_POST['alamat'];
$phone = $_POST['phone'];
$jabatan = $_POST['jabatan'];
$gender = $_POST['gender'];
$email = $_POST['email'];
$level = $_POST['level'];
$pass1 = md5($_POST['password']);


$sql = mysql_query("SELECT pegawai_nip FROM pegawai WHERE pegawai_nip ='" . $nip . "'") or die(mysql_error());
$check = mysql_num_rows($sql);

if ($check != 0) {
    die("<script language=JavaScript>alert('Maaf Nomor Induk Pegawai : " . $nip . " sudah digunakan.!!');
document.location='tambah.php'</script>");
}

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
                '$nama_gambar'
                )";
$result = mysql_query($query);
if ($result) {
    ?><script language="JavaScript">alert('Data Berhasil Di Simpan..!!');
            document.location = 'list.php'</script><?php
} else {
    ?><script language="JavaScript">alert('Terjadi Kesalahan Entry Data Pegawai..!!');
            document.location = 'tambah.php'</script><?php
}
?>
