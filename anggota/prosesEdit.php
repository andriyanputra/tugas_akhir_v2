<?php
include "../config/koneksi.php";

$nama_gambar = $_FILES['foto'] ['name']; // Mendapatkan nama gambar
$lokasi = $_FILES['foto'] ['tmp_name'];

// Menyiapkan tempat nemapung gambar yang diupload
$lokasitujuan = "../assets/img/img-anggota";


move_uploaded_file($lokasi, $lokasitujuan . "/" . $nama_gambar);


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


$query = "UPDATE pegawai SET
                pegawai_nip = $nip, 
                id_level_user = $level, 
                pegawai_nama = $nama,
                pegawai_tempat = $tempat, 
                pegawai_tanggal = $tgl_format, 
                pegawai_kelamin = $gender, 
                pegawai_alamat = $alamat, 
                pegawai_no_telp = $phone, 
                jabatan_id = $jabatan, 
                pegawai_email = $email, 
                pegawai_password = $pass1, 
                pegawai_foto = $nama_gambar
          WHERE pegawai_nip = $nip
               ";

$result = mysql_query($query);
if ($result) {
	?><script language="JavaScript">alert('Data Pegawai Berhasil Di-Update..!!');
document.location='list.php'</script><?php
}else{
	?><script language="JavaScript">alert('Terjadi Kesalahan Update Data Pegawai..!!');
document.location='edit.php?nip=<?=$nip; ?>'</script><?php
}

?>
