<?php
// Valdasi Login  
include_once "../library/inc.seslogin.php";
// Koneksi ke database MySQL
include_once "../library/inc.connection.php";
?>
<h2> LAPORAN DATA MENGAJAR </h2>
<table class="table-list" width="700" border="0" cellspacing="1" cellpadding="3">
  <tr>
    <td width="5%" bgcolor="#CCCCCC"><strong>No</strong></td>
    <td width="7%" bgcolor="#CCCCCC"><strong>Kode</strong></td>
    <td width="18%" bgcolor="#CCCCCC"><strong>Kelas</strong></td>
    <td width="20%" bgcolor="#CCCCCC"><strong>Pelajaran</strong></td>
    <td width="20%" bgcolor="#CCCCCC"><strong>Guru</strong></td>
    <td width="30%" bgcolor="#CCCCCC"><strong>Jadwal</strong></td>
  </tr>
  <?php
// Skrip menampilkan data Mengajar
$mySql 	= "SELECT mengajar.*, kelas.nm_kelas, pelajaran.nm_pelajaran, guru.nm_guru 
			FROM mengajar 
			LEFT JOIN pelajaran ON mengajar.kd_pelajaran = pelajaran.kd_pelajaran 
			LEFT JOIN kelas ON mengajar.kd_kelas = kelas.kd_kelas
			LEFT JOIN guru ON mengajar.kd_guru = guru.kd_guru
			ORDER BY mengajar.kd_mengajar ASC";
$myQry 	= mysql_query($mySql, $koneksidb)  or die ("Query  salah : ".mysql_error());
$nomor  = 0; 
while ($myData = mysql_fetch_array($myQry)) {
	$nomor++;
?>
  <tr>
    <td><?php echo $nomor; ?> </td>
    <td><?php echo $myData['kd_mengajar']; ?> </td>
    <td><?php echo $myData['nm_kelas']; ?> </td>
    <td><?php echo $myData['nm_pelajaran']; ?> </td>
    <td><?php echo $myData['nm_guru']; ?> </td>
    <td><?php echo $myData['hari'].", Ruang: ".$myData['ruang'].", Jam: ".$myData['jam']; ?> </td>
  </tr>
  <?php } ?>
</table>
