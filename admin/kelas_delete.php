<?php
// Valdasi Login User
include_once "../library/inc.seslogin.php";
// Koneksi ke database MySQL
include_once "../library/inc.connection.php";

// Membaca variabel Kode pada URL (alamat browser)
if(isset($_GET['Kode'])){
	$Kode	= $_GET['Kode'];

	// Hapus data sesuai Kode yang terbaca
	$mySql = "DELETE FROM kelas WHERE kd_kelas='$Kode'";
	$myQry = mysql_query($mySql, $koneksidb) or die ("Error hapus data".mysql_error());
	if($myQry){
		// Menghapus data Siswa  
		$hapusSql	= "DELETE FROM kelas_siswa WHERE kd_kelas='$Kode'";
		mysql_query($hapusSql, $koneksidb) or die ("Gagal hapus kelas siswa ".mysql_error());
			
		// Refresh halaman
		echo "<meta http-equiv='refresh' content='0; url=?open=Kelas-Data'>";
	}
}
else {
	// Jika tidak ada data Kode ditemukan di URL
	echo "<b>Data yang dihapus tidak ada</b>";
}
?> 


