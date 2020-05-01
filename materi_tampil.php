<?php
// Valdasi Login User
include_once "library/inc.sessiswa.php";
// Koneksi ke database MySQL
include_once "library/inc.connection.php";

# MEMBUAT SQL FILTER DATA
// Baca variabel URL browser
$kodePelajaran = isset($_GET['kodePelajaran']) ? $_GET['kodePelajaran'] : 'Semua'; 
// Baca variabel dari Form setelah di Post
$kodePelajaran = isset($_POST['cmbPelajaran']) ? $_POST['cmbPelajaran'] : $kodePelajaran;

// Membuat filter SQL
if ($kodePelajaran=="Semua") {
	//Query #1 (semua data)
	$filterSQL 	= "";
}
else {
	//Query #2 (filter)
	$filterSQL 	= " WHERE mb.kd_pelajaran ='$kodePelajaran'";
}

?>
<h2> MATERI BELAJAR</h2>
<form action="<?php $_SERVER['PHP_SELF']; ?>" method="post" name="form1" target="_self" id="form1">
  <table class="table-list" width="400" border="0" cellspacing="1" cellpadding="3">
    <tr>
      <td width="109" bgcolor="#CCCCCC"><strong>FILTER DATA</strong> </td>
      <td colspan="2">&nbsp;</td>
    </tr>
    <tr>
      <td><strong>Pelajaran</strong></td>
      <td width="7">:        </td>
      <td width="262"><select name="cmbPelajaran">
        <option value="Semua">....</option>
        <?php
		// Skrip menampilkan data Pelajaran ke dalam List/Menu 
		$bacaSql = "SELECT * FROM pelajaran ORDER BY kd_pelajaran";
		$bacaQry = mysql_query($bacaSql, $koneksidb) or die ("Gagal Query".mysql_error());
		while ($bacaData = mysql_fetch_array($bacaQry)) {
			if ($bacaData['kd_pelajaran'] == $kodePelajaran) {
				$cek = " selected";
			} else { $cek=""; }
			
			echo "<option value='$bacaData[kd_pelajaran]' $cek> $bacaData[nm_pelajaran] </option>";
		}
		?>
      </select></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td><input name="btnTampil" type="submit" id="btnTampil" value="Tampil" /></td>
    </tr>
  </table>
</form>

<table class="table-list" width="700" border="0" cellspacing="1" cellpadding="3">
  <tr>
    <td width="4%" bgcolor="#CCCCCC"><strong>No</strong></td>
    <td width="36%" bgcolor="#CCCCCC"><strong>Nama Materi </strong></td>
    <td width="21%" bgcolor="#CCCCCC"><strong>Pelajaran</strong></td>
    <td width="21%" bgcolor="#CCCCCC"><strong>Guru</strong></td>
    <td width="12%" align="center" bgcolor="#CCCCCC"><strong>File</strong></td>
  </tr>
<?php
// Skrip menampilkan data Materi
$mySql 	= "SELECT mb.*, pelajaran.nm_pelajaran, guru.nm_guru FROM materi_belajar AS mb
			LEFT JOIN pelajaran ON mb.kd_pelajaran = pelajaran.kd_pelajaran 
			LEFT JOIN guru ON mb.kd_guru = guru.kd_guru
			$filterSQL ORDER BY mb.kd_materi ASC";
$myQry 	= mysql_query($mySql, $koneksidb)  or die ("Query  salah : ".mysql_error());
$nomor  = 0; 
while ($myData = mysql_fetch_array($myQry)) {
	$nomor++;
?>

  <tr>
    <td><?php echo $nomor; ?> </td>
    <td><?php echo $myData['nm_materi']; ?> </td>
    <td><?php echo $myData['nm_pelajaran']; ?> </td>
    <td><?php echo $myData['nm_guru']; ?></td>
    <td align="center">
	<?php 
		$fileMateri	= $myData['file_materi'];
		
		if($fileMateri == "") { echo "Download"; }
		else {
			if(file_exists("materi/".$fileMateri)) {
				echo "<a href='materi/$fileMateri' target='_blank'> Download </a>"; } 
			else { echo "Download"; }
		}  ?></td>
  </tr>
<?php } ?>
</table>
