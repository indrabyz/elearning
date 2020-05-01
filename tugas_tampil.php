<?php
// Valdasi Login User
include_once "library/inc.sessiswa.php";
// Koneksi ke database MySQL
include_once "library/inc.connection.php";

if(isset($_SESSION['SES_SISWA'])) {
	# Baca variabel URL
	$kodeSiswa	= $_SESSION['SES_SISWA'];
	
	# MEMBACA KELAS AKTIF YANG DIMILIKI SISWA
	$infoSql	= "SELECT * FROM kelas_siswa WHERE kd_siswa='$kodeSiswa' ORDER BY id DESC LIMIT 1";
	$infoQry	= mysql_query($infoSql, $koneksidb)  or die ("Query info salah : ".mysql_error());
	$infoData 	= mysql_fetch_array($infoQry);
	
	$kodeKelas	= $infoData['kd_kelas'];
	
	//Query  filter 
	$filterSQL 	= " WHERE tb.kd_kelas ='$kodeKelas'";
}
else {
	$filterSQL 	= "";
}	
?>
<h2> TUGAS BELAJAR </h2>

<table class="table-list" width="750" border="0" cellspacing="1" cellpadding="3">
  <tr>
    <td width="4%" bgcolor="#CCCCCC"><strong>No</strong></td>
    <td width="35%" bgcolor="#CCCCCC"><strong>Nama Tugas </strong></td>
    <td width="17%" bgcolor="#CCCCCC"><strong>Pelajaran</strong></td>
    <td width="9%" bgcolor="#CCCCCC"><strong>Kelas</strong></td>
    <td width="17%" bgcolor="#CCCCCC"><strong>Guru</strong></td>
    <td width="12%" align="center" bgcolor="#CCCCCC"><strong>File</strong></td>
  </tr>

<?php
// Skrip menampilkan data Tugas Belajar
$mySql 	= "SELECT tb.*, pelajaran.nm_pelajaran, guru.nm_guru, kelas.nm_kelas 
			FROM tugas_belajar AS tb
			LEFT JOIN pelajaran ON tb.kd_pelajaran = pelajaran.kd_pelajaran 
			LEFT JOIN guru ON tb.kd_guru = guru.kd_guru
			LEFT JOIN kelas ON tb.kd_kelas = kelas.kd_kelas
			$filterSQL ORDER BY tb.kd_tugas ASC";
$myQry 	= mysql_query($mySql, $koneksidb)  or die ("Query  salah : ".mysql_error());
$nomor  = 0; 
while ($myData = mysql_fetch_array($myQry)) {
	$nomor++;
?>

  <tr>
    <td><?php echo $nomor; ?> </td>
    <td><?php echo $myData['nm_tugas']; ?> </td>
    <td><?php echo $myData['nm_pelajaran']; ?> </td>
    <td><?php echo $myData['nm_kelas']; ?></td>
    <td><?php echo $myData['nm_guru']; ?></td>
    <td align="center"> 
		<?php 
		$fileTugas	= $myData['file_tugas'];
		if($fileTugas == "") { echo "Download"; }
		else {
			if(file_exists ("tugas/".$fileTugas)) {
				echo "<a href='tugas/$fileTugas' target='_blank'> Download </a>"; } 
			else { echo "Download"; }  
		} ?></td>
  </tr>
<?php } ?>
</table>
