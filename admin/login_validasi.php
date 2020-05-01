<?php
// Koneksi ke database MySQL
include_once "../library/inc.connection.php";

# SKRIP TOMBOL LOGIN DIKLIK
if(isset($_POST['btnLogin'])){
	// Baca Data dari Form Input
	$txtUsername	= $_POST['txtUsername'];
	$txtPassword	= $_POST['txtPassword'];
	
	// Validasi Form Inputs
	$pesanError = array();
	if (trim($txtUsername)=="") {
		$pesanError[] = "Data <b>Username</b> tidak boleh kosong !";		
	}
	if (trim($txtPassword)=="") {
		$pesanError[] = "Data <b>Password</b> tidak boleh kosong !";		
	}
	
	// Menampilkan Pesan Error dari Form
	if (count($pesanError)>=1 ){
		echo "<div class='mssgBox'>";
		echo "<img src='../images/attention.png'> <br><hr>";
			$noPesan=0;
			foreach ($pesanError as $indeks=>$pesan_tampil) { 
			$noPesan++;
				echo "&nbsp; $noPesan. $pesan_tampil<br>";	
			} 
		echo "</div> <br>"; 
		
		// Tampilkan lagi form login
		include "login.php";
	}
	else {
		# LOGIN CEK KE TABEL USER LOGIN
		$mySql = "SELECT * FROM user WHERE username='$txtUsername' AND password='".md5($txtPassword)."' ";
		$myQry = mysql_query($mySql, $koneksidb) or die ("Query Salah : ".mysql_error()); 
		$myData= mysql_fetch_array($myQry); 
		
		# JIKA LOGIN SUKSES
		if(mysql_num_rows($myQry) >=1) {
			$_SESSION['SES_LOGIN'] 	= $myData['kd_user']; 
			$_SESSION['SES_SKEY'] 	= "43423232323";  // Untuk kode Unik, kode aplikasi
						
			// Refresh
			echo "<meta http-equiv='refresh' content='0; url=?open=Halaman-Utama'>";
		}
		else {
			 echo "Login Anda tidak diterima";
		}	
	}
}
else {
	// Refresh
	echo "<meta http-equiv='refresh' content='0; url=?open=Login'>";
}// End POST
?>
