<?php
// Valdasi Login User
include_once "../library/inc.seslogin.php";
// Koneksi ke database MySQL
include_once "../library/inc.connection.php";

// Untuk pembagian halaman data (Paging)
$baris	= 50;
$hal 	= isset($_GET['hal']) ? $_GET['hal'] : 1;
$infoSql= "SELECT * FROM tugas_belajar";
$infoQry= mysql_query($infoSql, $koneksidb) or die ("error paging: ".mysql_error());
$jumlah	= mysql_num_rows($infoQry);
$maks	= ceil($jumlah/$baris);
$mulai	= $baris * ($hal-1);
?> 
<table width="700" border="0" cellpadding="2" cellspacing="1" class="table-border">
  <tr>
    <td colspan="2"><h1><b>DATA TUGAS  </b></h1></td>
  </tr>
  <tr>
    <td colspan="2" align="right"><a href="?open=Tugas-Add" target="_self"><img src="../images/btn_add_data.png" height="30" border="0"  /></a></td>
  </tr>
  <tr>
    <td colspan="2">
	<table class="table-list" width="100%" border="0" cellspacing="1" cellpadding="3">
      <tr>
        <td width="4%" bgcolor="#CCCCCC"><strong>No</strong></td>
        <td width="8%" bgcolor="#CCCCCC"><strong>Kode</strong></td>
        <td width="34%" bgcolor="#CCCCCC"><strong>Nama Tugas </strong></td>
        <td width="21%" bgcolor="#CCCCCC"><strong>Pelajaran</strong></td>
        <td width="17%" bgcolor="#CCCCCC"><strong>Kelas</strong></td>
        <td colspan="2" align="center" bgcolor="#CCCCCC"><strong>Tools</strong></td>
        </tr>
<?php
// Skrip menampilkan data Tugas
$mySql 	= "SELECT tb.*, pelajaran.nm_pelajaran, kelas.nm_kelas FROM tugas_belajar AS tb
			LEFT JOIN pelajaran ON tb.kd_pelajaran = pelajaran.kd_pelajaran
			LEFT JOIN kelas ON tb.kd_kelas = kelas.kd_kelas ORDER BY tb.kd_tugas ASC LIMIT $mulai, $baris";
$myQry 	= mysql_query($mySql, $koneksidb)  or die ("Query  salah : ".mysql_error());
$nomor  = $mulai; 
while ($myData = mysql_fetch_array($myQry)) {
	$nomor++;
	$Kode = $myData['kd_tugas'];
?>

      <tr>
        <td> <?php echo $nomor; ?> </td>
        <td> <?php echo $myData['kd_tugas']; ?> </td>
        <td> <?php echo $myData['nm_tugas']; ?> </td>
        <td> <?php echo $myData['nm_pelajaran']; ?> </td>
        <td> <?php echo $myData['nm_kelas']; ?>  </td>
        <td width="8%"><a href="?open=Tugas-Edit&Kode=<?php echo $Kode; ?>" target="_self">Delete</a></td>
        <td width="8%"><a href="?open=Tugas-Edit&Kode=<?php echo $Kode; ?>" target="_self">Edit</a></td>
      </tr>
	  
<?php } ?>
    </table></td>
  </tr>
  <tr>
    <td width="560"><strong>Jumlah Data : </strong> <?php echo $jumlah; ?></td>
    <td width="129"><strong>Halaman Ke : </strong> 
	<?php
	for ($h = 1; $h <= $maks; $h++) {
		echo " <a href='?open=Tugas-Data&hal=$h'>$h</a> ";
	}
	?> </td>
  </tr>
</table>

 