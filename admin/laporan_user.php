<?php
// Valdasi Login  
include_once "../library/inc.seslogin.php";
// Koneksi ke database MySQL
include_once "../library/inc.connection.php";
?>
<h2> LAPORAN DATA USER </h2>
<table class="table-list" width="600" border="0" cellspacing="1" cellpadding="3">
  <tr>
    <td width="5%" bgcolor="#CCCCCC"><strong>No</strong></td>
    <td width="9%" bgcolor="#CCCCCC"><strong>Kode</strong></td>
    <td width="46%" bgcolor="#CCCCCC"><strong>Nama User </strong></td>
    <td width="40%" bgcolor="#CCCCCC"><strong>Username</strong> </td>
  </tr>
  <?php
// Skrip menampilkan data User
$mySql 	= "SELECT * FROM user ORDER BY kd_user ASC";
$myQry 	= mysql_query($mySql, $koneksidb) or die ("Query  salah : ".mysql_error());
$nomor  = 0; 
while ($myData = mysql_fetch_array($myQry)) {
	$nomor++;
?>
  <tr>
    <td><?php echo $nomor; ?> </td>
    <td><?php echo $myData['kd_user']; ?> </td>
    <td><?php echo $myData['nm_user']; ?> </td>
    <td><?php echo $myData['username']; ?></td>
  </tr>
  <?php } ?>
</table>
