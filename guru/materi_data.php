<?php
// Valdasi Login Guru
include_once "../library/inc.sesguru.php";
// Koneksi ke database MySQL
include_once "../library/inc.connection.php";

// Membaca Kode Guru yang login
$kodeGuru	= $_SESSION['SES_GURU'];

// Untuk pembagian halaman data (Paging)
$baris	= 50;
$hal 	= isset($_GET['hal']) ? $_GET['hal'] : 1;
$infoSql= "SELECT * FROM materi_belajar WHERE kd_guru='$kodeGuru'";
$infoQry= mysql_query($infoSql, $koneksidb) or die ("error paging: ".mysql_error());
$jumlah	= mysql_num_rows($infoQry);
$maks	= ceil($jumlah/$baris);
$mulai	= $baris * ($hal-1);
?> 
<table width="700" border="0" cellpadding="2" cellspacing="1" class="table-border">
  <tr>
    <td colspan="2"><h1><b>DATA MATERI  </b></h1></td>
  </tr>
  <tr>
    <td colspan="2" align="right"><a href="?open=Materi-Add" target="_self"><img src="../images/btn_add_data.png" height="30" border="0"  /></a></td>
  </tr>
  <tr>
    <td colspan="2">
	<table class="table-list" width="100%" border="0" cellspacing="1" cellpadding="3">
      <tr>
        <td width="4%" bgcolor="#CCCCCC"><strong>No</strong></td>
        <td width="8%" bgcolor="#CCCCCC"><strong>Kode</strong></td>
        <td width="44%" bgcolor="#CCCCCC"><strong>Nama Materi </strong></td>
        <td width="28%" bgcolor="#CCCCCC"><strong>Pelajaran</strong></td>
        <td colspan="2" align="center" bgcolor="#CCCCCC"><strong>Tools</strong></td>
        </tr>
<?php
// Skrip menampilkan data Materi
$mySql 	= "SELECT mb.*, pelajaran.nm_pelajaran FROM materi_belajar AS mb
			LEFT JOIN pelajaran ON mb.kd_pelajaran = pelajaran.kd_pelajaran 
			WHERE mb.kd_guru='$kodeGuru' ORDER BY mb.kd_materi ASC LIMIT $mulai, $baris";
$myQry 	= mysql_query($mySql, $koneksidb)  or die ("Query  salah : ".mysql_error());
$nomor  = $mulai; 
while ($myData = mysql_fetch_array($myQry)) {
	$nomor++;
	$Kode = $myData['kd_materi'];
?>

      <tr>
        <td> <?php echo $nomor; ?> </td>
        <td> <?php echo $myData['kd_materi']; ?> </td>
        <td> <?php echo $myData['nm_materi']; ?> </td>
        <td> <?php echo $myData['nm_pelajaran']; ?> </td>
        <td width="8%"><a href="?open=Materi-Delete&Kode=<?php echo $Kode; ?>" target="_self" onclick="return confirm('YAKIN INGIN MENGHAPUS DATA MATERI INI ... ?')">Delete</a></td>
        <td width="8%"><a href="?open=Materi-Edit&Kode=<?php echo $Kode; ?>" target="_self">Edit</a></td>
      </tr>
	  
<?php } ?>
    </table></td>
  </tr>
  <tr>
    <td width="495"><strong>Jumlah Data :</strong> <?php echo $jumlah; ?></td>
    <td width="194" align="right"><strong>Halaman Ke :</strong>
	<?php
	for ($h = 1; $h <= $maks; $h++) {
		echo " <a href='?open=Materi-Data&hal=$h'>$h</a> ";
	}
	?> </td>
  </tr>
</table>

 