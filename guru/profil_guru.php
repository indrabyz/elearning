<?php
// Valdasi Login Guru
include_once "../library/inc.sesguru.php";
include_once "../library/inc.connection.php";
include_once "../library/inc.library.php";


if(isset($_SESSION['SES_GURU'])) {
	# Baca variabel Session
	$kodeGuru	= $_SESSION['SES_GURU'];
	
	// Skrip membaca data Guru
	$mySql	= "SELECT * FROM guru WHERE kd_guru='$kodeGuru'";
	$myQry	= mysql_query($mySql, $koneksidb)  or die ("Query salah : ".mysql_error());
	$myData = mysql_fetch_array($myQry);
}
else {
	echo "Kode data tidak terbaca";
	exit;
}
?>
<html>
<head>
<title>:: Profil Guru</title>
</head>
<body>
<h2> PROFIL GURU  </h2>
<table width="100%" cellpadding="4" cellspacing="2" class="table-list">
	<tr>
	  <td width="16%"><strong>Kode</strong></td>
	  <td width="1%"><strong>:</strong></td>
	  <td width="84%"><?php echo $myData['kd_guru']; ?></td>
	</tr>
	<tr>
	  <td><strong>Nama Guru </strong></td>
      <td><strong>:</strong></td>
	  <td><?php echo $myData['nm_guru']; ?></td>
  </tr>
	<tr>
	  <td><strong>Kelamin</strong></td>
      <td><b>:</b></td>
	  <td><?php echo $myData['kelamin']; ?></td>
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
