<?php
// Valdasi Login Guru
include_once "../library/inc.sesguru.php";
// Koneksi ke database MySQL
include_once "../library/inc.connection.php";

if(isset($_SESSION['SES_GURU'])) {
	// Membaca Kode Guru yang login
	$kodeGuru	= $_SESSION['SES_GURU'];
}
else {
	echo "Kode data tidak terbaca";
	exit;
}
?>
<h2>  JADWAL MENGAJAR </h2>

<?php
// Skrip menampilkan data Kelas
$mySql 	= "SELECT kelas.* FROM mengajar LEFT JOIN kelas ON mengajar.kd_kelas = kelas.kd_kelas 
			WHERE mengajar.kd_guru='$kodeGuru' GROUP BY mengajar.kd_kelas";
$myQry 	= mysql_query($mySql, $koneksidb)  or die ("Query  salah : ".mysql_error());  
$nomor  = 0; 
while ($myData = mysql_fetch_array($myQry)) {
	$nomor++;
	$kodeKelas = $myData['kd_kelas'];
?>

<table class="table-list" width="400" border="0" cellspacing="1" cellpadding="3">
  <tr>
    <td width="109" bgcolor="#CCCCCC"><strong>Kelas</strong></td>
    <td width="7">: </td>
    <td width="262"><?php echo $myData['nm_kelas']; ?></td>
  </tr>
</table>
<br /> 

<table class="table-list" width="700" border="0" cellspacing="1" cellpadding="3">
  <tr>
    <td width="5%" bgcolor="#CCCCCC"><strong>No</strong></td>
    <td width="7%" bgcolor="#CCCCCC"><strong>Kode</strong></td>
    <td width="18%" bgcolor="#CCCCCC"><strong>Kelas</strong></td>
    <td width="20%" bgcolor="#CCCCCC"><strong>Pelajaran</strong></td>
    <td width="30%" bgcolor="#CCCCCC"><strong>Jadwal</strong></td>
  </tr>
  <?php
// Skrip menampilkan data Mengajar
$my2Sql 	= "SELECT mengajar.*, kelas.nm_kelas, pelajaran.nm_pelajaran, guru.nm_guru 
			FROM mengajar 
			LEFT JOIN pelajaran ON mengajar.kd_pelajaran = pelajaran.kd_pelajaran 
			LEFT JOIN kelas ON mengajar.kd_kelas = kelas.kd_kelas
			LEFT JOIN guru ON mengajar.kd_guru = guru.kd_guru
			WHERE mengajar.kd_kelas='$kodeKelas' AND mengajar.kd_guru='$kodeGuru' ORDER BY mengajar.kd_mengajar ASC";
$my2Qry 	= mysql_query($my2Sql, $koneksidb)  or die ("Query  salah : ".mysql_error());
$nomor  = 0; 
while ($my2Data = mysql_fetch_array($my2Qry)) {
	$nomor++;
?>
  <tr>
    <td><?php echo $nomor; ?> </td>
    <td><?php echo $my2Data['kd_mengajar']; ?> </td>
    <td><?php echo $my2Data['nm_kelas']; ?> </td>
    <td><?php echo $my2Data['nm_pelajaran']; ?> </td>
    <td><?php echo $my2Data['hari'].", Ruang: ".$my2Data['ruang'].", Jam: ".$my2Data['jam']; ?> </td>
  </tr>
  <?php } ?>
</table> <hr />
<?php } ?>