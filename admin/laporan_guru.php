<?php
// Valdasi Login  
include_once "../library/inc.seslogin.php";
// Koneksi ke database MySQL
include_once "../library/inc.connection.php";
?>
<h2> LAPORAN DATA GURU </h2>
<table class="table-list" width="700" border="0" cellspacing="1" cellpadding="3">
  <tr>
    <td width="4%" bgcolor="#CCCCCC"><strong>No</strong></td>
    <td width="7%" bgcolor="#CCCCCC"><strong>Kode</strong></td>
    <td width="26%" bgcolor="#CCCCCC"><strong>Nama Guru </strong></td>
    <td width="6%" bgcolor="#CCCCCC"><strong>L/P</strong></td>
    <td width="40%" bgcolor="#CCCCCC"><strong>Alamat</strong></td>
    <td width="17%" bgcolor="#CCCCCC"><strong>No. Telepon </strong></td>
  </tr>
<?php
// Skrip menampilkan data Guru
$mySql 	= "SELECT * FROM guru ORDER BY kd_guru ASC";
$myQry 	= mysql_query($mySql, $koneksidb) or die ("Query  salah : ".mysql_error());
$nomor  = 0; 
while ($myData = mysql_fetch_array($myQry)) {
	$nomor++;
?>
  <tr>
    <td><?php echo $nomor; ?> </td>
    <td><?php echo $myData['kd_guru']; ?> </td>
    <td><?php echo $myData['nm_guru']; ?> </td>
    <td><?php echo $myData['kelamin']; ?> </td>
    <td><?php echo $myData['alamat']; ?> </td>
    <td><?php echo $myData['no_telepon']; ?></td>
  </tr>
  <?php } ?>
</table>
