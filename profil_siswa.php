<?php
// Valdasi Login User
include_once "library/inc.sessiswa.php";
include_once "library/inc.connection.php";
include_once "library/inc.library.php";


if(isset($_SESSION['SES_SISWA'])) {
	# Baca variabel Session
	$kodeSiswa	= $_SESSION['SES_SISWA'];
	
	// Skrip membaca data Siswa
	$mySql	= "SELECT * FROM siswa WHERE kd_siswa='$kodeSiswa'";
	$myQry	= mysql_query($mySql, $koneksidb)  or die ("Query salah : ".mysql_error());
	$myData = mysql_fetch_array($myQry);
	
		// Menampilkan gambar
		if($myData['foto']=="") { $fileFoto = "noimage.jpg"; }
		else { $fileFoto = $myData['foto']; }
		// Membaca kelas aktif yang dimiliki oleh siswa
		$infoSql	= "SELECT kelas_siswa.*, kelas.nm_kelas FROM kelas_siswa 
						LEFT JOIN kelas ON kelas_siswa.kd_kelas = kelas.kd_kelas 
						WHERE kelas_siswa.kd_siswa='$kodeSiswa' ORDER BY id DESC LIMIT 1";
		$infoQry	= mysql_query($infoSql, $koneksidb)  or die ("Query info salah : ".mysql_error());
		$infoData 	= mysql_fetch_array($infoQry);
		
}
else {
	echo "Kode data tidak terbaca";
	exit;
}
?>
<html>
<head>
<title>:: Profil Siswa</title>
</head>
<body>
<h2> PROFIL SISWA  </h2>
<table width="100%" cellpadding="4" cellspacing="2" class="table-list">
	<tr>
		<td width="16%"><strong>Kode</strong></td>
		<td width="1%"><strong>:</strong></td>
		<td width="84%"><?php echo $myData['kd_siswa']; ?></td>
	</tr>
	<tr>
			<td><strong>NIS</strong></td>
		<td><strong>:</strong></td>
		<td><?php echo $myData['nis']; ?></td>
  </tr>
	<tr>
	  <td><strong>Nama Siswa </strong></td>
      <td><strong>:</strong></td>
	  <td><?php echo $myData['nm_siswa']; ?></td>
  </tr>
	<tr>
	  <td><strong>Kelamin</strong></td>
      <td><b>:</b></td>
	  <td><?php echo $myData['kelamin']; ?></td>
    </tr>
	<tr>
	  <td><b>Agama</b></td>
      <td><b>:</b></td>
	  <td><?php echo $myData['agama']; ?></td>
    </tr>
	<tr>
	  <td><strong>Tempat &amp; Tgl. Lahir </strong></td>
      <td><b>:</b></td>
	  <td><?php echo $myData['tempat_lahir'].", ".IndonesiaTgl($myData['tanggal_lahir']); ?></td>
    </tr>
	<tr>
	  <td><strong>Alamat</strong></td>
      <td><strong>:</strong></td>
	  <td><?php echo $myData['alamat'];  ?> </td>
    </tr>
	<tr>
	  <td><strong>No. Telepon</strong></td>
      <td><strong>:</strong></td>
	  <td><?php echo $myData['no_telepon']; ?></td>
	</tr>
	<tr>
	  <td><b>Foto</b></td>
      <td><strong>:</strong></td>
	  <td> <img src="foto/<?php echo $fileFoto; ?>" height="150"> </td>
    </tr>
	<tr>
      <td><strong>Kelas Aktif </strong></td>
	  <td><strong>:</strong></td>
	  <td><?php echo $infoData['nm_kelas']; ?></td>
  </tr>
	<tr>
	  <td bgcolor="#CCCCCC"><strong>LOGIN</strong></td>
	  <td>&nbsp;</td>
	  <td>&nbsp;</td>
  </tr>
	<tr>
	  <td><strong>Username</strong></td>
	  <td><strong>:</strong></td>
	  <td><?php echo $myData['username']; ?></td>
  </tr>
	<tr>
	  <td><strong>Password</strong></td>
	  <td><strong>:</strong></td>
	  <td><a href="?open=Password-Ubah" target="_self">Ubah Password </a></td>
  </tr>
</table>
</body>
</html>
