<?php
// Valdasi Login User
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
<table width="650" border="0" cellpadding="2" cellspacing="1" class="table-border">
  <tr>
    <td colspan="2"><h1><b>DATA SISWA  </b></h1></td>
  </tr>
  <tr>
    <td colspan="2" align="right"><a href="?open=Siswa-Add" target="_self"><img src="../images/btn_add_data.png" height="30" border="0"  /></a></td>
  </tr>
  <tr>
    <td colspan="2">
	<table class="table-list" width="100%" border="0" cellspacing="1" cellpadding="3">
      <tr>
        <td width="5%" bgcolor="#CCCCCC"><strong>No</strong></td>
        <td width="8%" bgcolor="#CCCCCC"><strong>Kode</strong></td>
        <td width="11%" bgcolor="#CCCCCC"><strong>Nis</strong></td>
        <td width="38%" bgcolor="#CCCCCC"><strong>Nama Siswa </strong></td>
        <td width="5%" bgcolor="#CCCCCC"><strong>L/P</strong></td>
        <td width="17%" bgcolor="#CCCCCC"><strong>Username</strong></td>
        <td colspan="2" align="center" bgcolor="#CCCCCC"><strong>Tools</strong></td>
        </tr>
<?php
// Skrip menampilkan data Siswa
$mySql 	= "SELECT * FROM siswa ORDER BY kd_siswa ASC LIMIT $mulai, $baris";
$myQry 	= mysql_query($mySql, $koneksidb)  or die ("Query  salah: ".mysql_error());
$nomor  = $mulai; 
while ($myData = mysql_fetch_array($myQry)) {
	$nomor++;
	$Kode = $myData['kd_siswa'];
?>
  <tr>
	<td> <?php echo $nomor; ?> </td>
	<td> <?php echo $myData['kd_siswa']; ?> </td>
	<td> <?php echo $myData['nis']; ?> </td>
	<td> <?php echo $myData['nm_siswa']; ?> </td>
	<td> <?php echo $myData['kelamin']; ?> </td>
	<td> <?php echo $myData['username']; ?> </td>
	<td width="8%"><a href="?open=Siswa-Delete&Kode=<?php echo $Kode; ?>" target="_self" onclick="return confirm('YAKIN INGIN MENGHAPUS DATA SISWA INI ... ?')">Delete</a></td>
	<td width="8%"><a href="?open=Siswa-Edit&Kode=<?php echo $Kode; ?>" target="_self">Edit</a></td>
  </tr>
<?php } ?>
    </table></td>
  </tr>
  <tr>
    <td width="394"><strong>Jumlah Data:</strong> <?php echo $jumlah; ?> </td>
    <td width="245" align="right"><strong>Halaman Ke: </strong>
	<?php
	for ($h = 1; $h <= $maks; $h++) {
		echo " <a href='?open=Siswa-Data&hal=$h'>$h</a> ";
	}
	?>	</td>
  </tr>
</table>

