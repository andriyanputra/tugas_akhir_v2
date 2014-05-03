<?php

include "../config/koneksi.php";

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
$pass1 = md5($_POST['password']);
$pass2 = $_POST['password2'];
 

$sql=mysql_query("SELECT pegawai_nip FROM pegawai WHERE pegawai_nip ='".$nip."'")or die(mysql_error());
$check=mysql_num_rows($sql);
    
if ($check !=0){
    die("<script language=JavaScript>alert('Maaf Nomor Induk Pegawai : ".$nip." sudah digunakan.!!');
document.location='tambah.php'</script>");
}

$fileName = $_FILES['foto']['name']; //get the file name
$fileSize = $_FILES['foto']['size']; //get the size
$fileError = $_FILES['foto']['error']; //get the error when upload
if($fileSize > 0 || $fileError == 0){ //check if the file is corrupt or error
$move = move_uploaded_file($_FILES['foto']['tmp_name'], 'D:/2. Program Files/xampp/htdocs/SIM_Proteksi/assets/img/img-anggota'.$fileName); //save image to the folder
if($move){
    echo "<h3>Success! </h3>";
    $add = "INSERT into pegawai VALUES('".$nip."','".$nama."','".$tempat."','".$tgl_format."','".$gender."','".$alamat."','".$phone."','".$jabatan."','".$email."','".$pass1."','img-anggota/$fileName')"; //insert image property to database
    $result = mysql_query($add);

    //$q1 = "SELECT location from tb_image where filename = '$fileName' limit 1 "; //get the image that have been uploaded
    //$result = mysql_query($q1);
    //while ($data = mysql_fetch_array($result)) {
    //$loc = $data['location']; 
    //<!--<br/>
    //<h2> This is the Image : </h2>
    //<img src="<?php //echo $loc;  />  show the image using img src -->

    if ($add) {
    }else{
	?><script language="JavaScript">alert('Terjadi Kesalahan Entry Data Pegawai..!!');
document.location='tambah.php'</script><?php
}


} else{
echo "<h3>Failed! </h3>";
}
} else {
echo "Failed to Upload : ".$fileError;
}


?>
