<?php
// Valdasi Login User
include_once "../library/inc.seslogin.php";
// Koneksi ke database MySQL
include_once "../library/inc.connection.php";

// Membaca variabel Kode pada URL (alamat browser)
if(isset($_GET['Kode'])){
	$Kode	= $_GET['Kode'];
	
	// Membaca data File Tugas
	$mySql	 = "SELECT file_tugas FROM tugas_belajar WHERE kd_tugas='$Kode'";
	$myQry	 = mysql_query($mySql, $koneksidb)  or die ("Query 1 salah : ".mysql_error());
	$myData	 = mysql_fetch_array($myQry);
	
	// Jika file Tugas lama ada, akan dihapus
	$fileTugas = $myData['file_tugas'];
	if(file_exists("../tugas/".$fileTugas)) {
		unlink("../tugas/".$fileTugas);	
	} 
	 
	// Hapus data sesuai Kode yang terbaca
	$my2Sql = "DELETE FROM tugas_belajar WHERE kd_tugas='$Kode'";
	$my2Qry = mysql_query($my2Sql, $koneksidb) or die ("Error hapus data".mysql_error());
	if($my2Qry){
		// Refresh halaman
		echo "<meta http-equiv='refresh' content='0; url=?open=Tugas-Data'>";
	}
}
else {
	// Jika tidak ada data Kode ditemukan di URL
	echo "<b>Data yang dihapus tidak ada</b>";
}
?> 


