<?php
// Valdasi Login User
include_once "library/inc.sessiswa.php";
// Koneksi ke database MySQL
include_once "library/inc.connection.php";
?>
<h2> JADWAL PELAJARAN </h2>
<table class="table-list" width="700" border="0" cellspacing="1" cellpadding="3">
  <tr>
    <td width="5%" bgcolor="#CCCCCC"><strong>No</strong></td>
    <td width="31%" bgcolor="#CCCCCC"><strong>Pelajaran</strong></td>
    <td width="17%" bgcolor="#CCCCCC"><strong>Guru</strong></td>
    <td width="47%" bgcolor="#CCCCCC"><strong>Jadwal</strong></td>
  </tr>
<?php
// Menampilkan daftar Kelas
$mySql	= "SELECT * FROM kelas ORDER BY kd_kelas";
$myQry 	= mysql_query($mySql, $koneksidb)  or die ("Query  1 salah : ".mysql_error());
while ($myData = mysql_fetch_array($myQry)) {
	$kodeKelas	= $myData['kd_kelas'];
?>
  <tr>
    <td colspan="4"> <b> Kelas : <?php echo $myData['nm_kelas']; ?> </b> </td>
  </tr>
<?php 
// Skrip menampilkan data Jadwal Mengajar
$my2Sql 	= "SELECT mengajar.*, kelas.nm_kelas, pelajaran.nm_pelajaran, guru.nm_guru 
			FROM mengajar 
			LEFT JOIN pelajaran ON mengajar.kd_pelajaran = pelajaran.kd_pelajaran 
			LEFT JOIN kelas ON mengajar.kd_kelas = kelas.kd_kelas
			LEFT JOIN guru ON mengajar.kd_guru = guru.kd_guru
			WHERE mengajar.kd_kelas = '$kodeKelas'
			ORDER BY mengajar.kd_mengajar ASC";
$my2Qry 	= mysql_query($my2Sql, $koneksidb)  or die ("Query  2 salah : ".mysql_error());
$nomor  = 0; 
while ($my2Data = mysql_fetch_array($my2Qry)) {
	$nomor++;
?>
  <tr>
    <td><?php echo $nomor; ?> </td>
    <td><?php echo $my2Data['nm_pelajaran']; ?> </td>
    <td><?php echo $my2Data['nm_guru']; ?> </td>
    <td><?php echo $my2Data['hari'].", Ruang: ".$my2Data['ruang'].", Jam: ".$my2Data['jam']; ?> </td>
  </tr>
<?php } } ?>
</table>
