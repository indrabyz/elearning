<?php
// Valdasi Login  
include_once "../library/inc.seslogin.php";
// Koneksi ke database MySQL
include_once "../library/inc.connection.php";
?>
<h2> LAPORAN DATA KELAS </h2>
<table class="table-list" width="600" border="0" cellspacing="1" cellpadding="3">
  <tr>
    <td width="5%" bgcolor="#CCCCCC"><strong>No</strong></td>
    <td width="9%" bgcolor="#CCCCCC"><strong>Kode</strong></td>
    <td width="46%" bgcolor="#CCCCCC"><strong>Nama Kelas </strong></td>
    <td width="40%" bgcolor="#CCCCCC"><strong>Guru Wali</strong> </td>
  </tr>
  <?php
// Skrip menampilkan data Kelas
$mySql 	= "SELECT kelas.*, guru.nm_guru FROM kelas 
			LEFT JOIN guru ON kelas.kd_guru = guru.kd_guru ORDER BY kelas.kd_kelas ASC";
$myQry 	= mysql_query($mySql, $koneksidb) or die ("Query  salah : ".mysql_error());
$nomor  = 0; 
while ($myData = mysql_fetch_array($myQry)) {
	$nomor++;
?>
  <tr>
    <td><?php echo $nomor; ?> </td>
    <td><?php echo $myData['kd_kelas']; ?> </td>
    <td><?php echo $myData['nm_kelas']; ?> </td>
    <td><?php echo $myData['nm_guru']; ?></td>
  </tr>
  <?php } ?>
</table>
