<?php
// Valdasi Login  
include_once "../library/inc.seslogin.php";
// Koneksi ke database MySQL
include_once "../library/inc.connection.php";

// Untuk pembagian halaman data (Paging)
$baris	= 50;
$hal 	= isset($_GET['hal']) ? $_GET['hal'] : 1;
$infoSql= "SELECT * FROM siswa";
$infoQry= mysql_query($infoSql, $koneksidb) or die ("error paging: ".mysql_error());
$jumlah	= mysql_num_rows($infoQry);
$maks	= ceil($jumlah/$baris); 
$mulai	= $baris * ($hal-1); 
?>
<h2> LAPORAN DATA SISWA </h2>
<table class="table-list" width="700" border="0" cellspacing="1" cellpadding="3">
  <tr>
    <td width="4%" bgcolor="#CCCCCC"><strong>No</strong></td>
    <td width="7%" bgcolor="#CCCCCC"><strong>Kode</strong></td>
    <td width="26%" bgcolor="#CCCCCC"><strong>Nama Siswa </strong></td>
    <td width="6%" bgcolor="#CCCCCC"><strong>L/P</strong></td>
    <td width="40%" bgcolor="#CCCCCC"><strong>Alamat</strong></td>
    <td width="17%" bgcolor="#CCCCCC"><strong>No. Telepon </strong></td>
  </tr>
<?php
// Skrip menampilkan data Siswa
$mySql 	= "SELECT * FROM siswa ORDER BY kd_siswa ASC LIMIT $mulai, $baris";
$myQry 	= mysql_query($mySql, $koneksidb) or die ("Query  salah : ".mysql_error());
$nomor  = 0; 
while ($myData = mysql_fetch_array($myQry)) {
	$nomor++;
?>
  <tr>
    <td><?php echo $nomor; ?> </td>
    <td><?php echo $myData['kd_siswa']; ?> </td>
    <td><?php echo $myData['nm_siswa']; ?> </td>
    <td><?php echo $myData['kelamin']; ?> </td>
    <td><?php echo $myData['alamat']; ?> </td>
    <td><?php echo $myData['no_telepon']; ?></td>
  </tr>
<?php } ?>
  <tr>
    <td colspan="3"><strong>Jumlah Data:</strong></td>
    <td colspan="3" align="right"><strong>Halaman Ke: </strong></td>
  </tr>
</table>
