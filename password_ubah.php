<?php
// Valdasi Login User
include_once "library/inc.sessiswa.php";
// Koneksi ke database MySQL
include_once "library/inc.connection.php";
// Membaca file library
include_once "library/inc.library.php";

// Membaca data Login
if(isset($_SESSION['SES_SISWA'])) {
	# Baca variabel Session
	$kodeSiswa	= $_SESSION['SES_SISWA'];
}
else {
	$kodeSiswa	= "";
	exit;
}

# SKRIP TOMBOL SIMPAN DIKLIK
if(isset($_POST['btnSimpan'])){
	// Baca Data dari Form Input
	$txtPasswordBaru1	= $_POST['txtPasswordBaru1'];
	$txtPasswordBaru2	= $_POST['txtPasswordBaru2'];
	$txtPasswordLama	= $_POST['txtPasswordLama'];

	// Validasi Form Inputs
	$pesanError = array();
	if (trim($txtPasswordBaru1)=="") {
		$pesanError[] = "Data <b>Password Baru (1)</b> tidak boleh kosong !";		
	}
	if (trim($txtPasswordBaru2)=="") {
		$pesanError[] = "Data <b>Password Baru (2)</b> tidak boleh kosong !";		
	}
	else if (trim($txtPasswordBaru1) != trim($txtPasswordBaru2)) {
		$pesanError[] = "Data <b>Password Baru (1) dan (2)</b> harus sama !";
	}
	if (trim($txtPasswordLama)=="") {
		$pesanError[] = "Data <b>Password Lama</b> tidak boleh kosong !";		
	}
	
	// Validasi Login Password
	$cekSql = "SELECT * FROM siswa WHERE kd_siswa='$kodeSiswa' AND password='".md5($txtPasswordLama)."' ";
	$cekQry = mysql_query($cekSql, $koneksidb) or die ("Query Salah cek : ".mysql_error()); 
	if(mysql_num_rows($cekQry) < 1) {
		$pesanError[] = "Data <b>Password Lama</b> masih salah, ingat-ingat kembali !";	
	}
			
	// Menampilkan Pesan Error dari Form
	if (count($pesanError)>=1 ){
		echo "<div class='mssgBox'>";
		echo "<img src='images/attention.png'> <br><hr>";
			$noPesan=0;
			foreach ($pesanError as $indeks=>$pesan_tampil) { 
			$noPesan++;
				echo "&nbsp; $noPesan. $pesan_tampil<br>";	
			} 
		echo "</div> <br>"; 
	}
	else {
		// Skrip Simpan data ke Database
		$mySql 	= "UPDATE siswa SET password=MD5('$txtPasswordLama') WHERE kd_siswa='$kodeSiswa'";
		$myQry	= mysql_query($mySql, $koneksidb) or die ("Gagal query".mysql_error());
		if($myQry){
			echo "<meta http-equiv='refresh' content='0; url=?open=Logout'>";
		}
		exit;	
	}
}
?>

<form action="<?php $_SERVER['PHP_SELF']; ?>" method="post" name="form1" target="_self" id="form1">
  <table class="table-list" width="500" border="0" cellspacing="2" cellpadding="3">
    <tr>
      <td bgcolor="#CCCCCC"><strong>UBAH PASSWORD </strong></td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td width="154"><strong>Password Baru </strong></td>
      <td width="6"><strong>:</strong></td>
      <td width="315"><input name="txtPasswordBaru1" type="text" id="txtPasswordBaru1" size="30" maxlength="20" /></td>
    </tr>
    <tr>
      <td><strong>Ulang Password Baru</strong> </td>
      <td><strong>:</strong></td>
      <td><input name="txtPasswordBaru2" type="password" id="txtPasswordBaru2" size="30" maxlength="20" /></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td><strong>Password Lama </strong></td>
      <td><strong>:</strong></td>
      <td><input name="txtPasswordLama" type="password" id="txtPasswordLama" size="30" maxlength="20" /></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td><input name="btnSimpan" type="submit" id="btnSimpan" value="Simpan" /></td>
    </tr>
  </table>
</form>
