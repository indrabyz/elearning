<?php
// Valdasi Login User
include_once "../library/inc.seslogin.php";
// Koneksi ke database MySQL
include_once "../library/inc.connection.php";

// Membaca variabel Kode pada URL (alamat browser)
if(isset($_GET['Kode'])){
	$Kode	= $_GET['Kode'];
	
	// Membaca data Gambar/ Foto
	$mySql	 = "SELECT foto FROM siswa WHERE kd_siswa='$Kode'";
	$myQry	 = mysql_query($mySql, $koneksidb)  or die ("Query 1 salah : ".mysql_error());
	$myData	 = mysql_fetch_array($myQry);
	
	// Jika file foto lama ada, akan dihapus
	$fileFoto = $myData['foto'];
	if(file_exists("../foto/".$fileFoto)) {
		unlink("../foto/".$fileFoto);	
	} 
	
	// Hapus data sesuai Kode yang terbaca
	$my2Sql = "DELETE FROM siswa WHERE kd_siswa='$Kode'";
	$my2Qry = mysql_query($my2Sql, $koneksidb) or die ("Error hapus data".mysql_error());
	if($my2Qry){
		// Refresh halaman
		echo "<meta http-equiv='refresh' content='0; url=?open=Siswa-Data'>";
	}
}
else {
	// Jika tidak ada data Kode ditemukan di URL
	echo "<b>Data yang dihapus tidak ada</b>";
}
?> 


