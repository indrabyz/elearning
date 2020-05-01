<?php
// Valdasi Login Guru
include_once "../library/inc.sesguru.php";
// Koneksi ke database MySQL
include_once "../library/inc.connection.php"; 

if(isset($_SESSION['SES_GURU'])) {
	// Membaca Kode Guru yang login
	$kodeGuru	= $_SESSION['SES_GURU'];
}
else {
	echo "Kode data tidak terbaca";
	exit;
}

// Skrip menampilkan data Kelas
$mySql 	= "SELECT * FROM kelas WHERE kd_guru='$kodeGuru'";
$myQry 	= mysql_query($mySql, $koneksidb)  or die ("Query  salah : ".mysql_error());
$nomor  = 0; 
while ($myData = mysql_fetch_array($myQry)) {
	$nomor++;
	$kodeKelas = $myData['kd_kelas'];
?>
<h1><b>DATA SISWA </b></h1>
<table class="table-list" width="400" border="0" cellspacing="1" cellpadding="3">
  <tr>
    <td width="109" bgcolor="#CCCCCC"><strong>Kelas</strong></td>
    <td width="7">: </td>
    <td width="262"><?php echo $myData['nm_kelas']; ?></td>
  </tr>
</table>
<br />

<table class="table-list" width="750" border="0" cellspacing="1" cellpadding="3">
  <tr>
    <td width="4%" bgcolor="#CCCCCC"><strong>No</strong></td>
    <td width="7%" bgcolor="#CCCCCC"><strong>Kode</strong></td>
    <td width="9%" bgcolor="#CCCCCC"><strong>Nis</strong></td>
    <td width="47%" bgcolor="#CCCCCC"><strong>Nama Siswa </strong></td>
    <td width="6%" bgcolor="#CCCCCC"><strong>L/P</strong></td>
    <td width="21%" bgcolor="#CCCCCC"><strong>Username</strong></td>
    <td align="center" bgcolor="#CCCCCC"><strong>Tools</strong></td>
  </tr>
  <?php
// Skrip menampilkan data Siswa yang Guru Walinya adalah Saya (yang login)
$my2Sql 	= "SELECT kelas_siswa.kd_kelas, siswa.* FROM kelas_siswa 
			LEFT JOIN siswa ON kelas_siswa.kd_siswa = siswa.kd_siswa
			WHERE kelas_siswa.kd_kelas='$kodeKelas' ORDER BY siswa.kd_siswa ASC";
$my2Qry 	= mysql_query($my2Sql, $koneksidb)  or die ("Query  salah: ".mysql_error());
$nomor  = 0; 
while ($my2Data = mysql_fetch_array($my2Qry)) {
	$nomor++;
	$Kode = $my2Data['kd_siswa'];
?>
  <tr>
    <td><?php echo $nomor; ?> </td>
    <td><?php echo $my2Data['kd_siswa']; ?> </td>
    <td><?php echo $my2Data['nis']; ?> </td>
    <td><?php echo $my2Data['nm_siswa']; ?> </td>
    <td><?php echo $my2Data['kelamin']; ?> </td>
    <td><?php echo $my2Data['username']; ?> </td>
    <td width="6%" align="center"><a href="siswa_cetak.php?Kode=<?php echo $Kode; ?>" target="_blank">Cetak</a></td>
  </tr>
  <?php } ?>
</table>
<?php } ?>