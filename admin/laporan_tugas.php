<?php
// Valdasi Login  
include_once "../library/inc.seslogin.php";
// Koneksi ke database MySQL
include_once "../library/inc.connection.php";

# MEMBUAT SQL FILTER DATA
// Baca variabel URL browser
$kodeKelas = isset($_GET['kodeKelas']) ? $_GET['kodeKelas'] : 'Semua'; 
// Baca variabel dari Form setelah di Post
$kodeKelas = isset($_POST['cmbKelas']) ? $_POST['cmbKelas'] : $kodeKelas;

// Membuat filter SQL
if ($kodeKelas=="Semua") {
	//Query #1 (semua data)
	$filterSQL 	= "";
}
else {
	//Query #2 (filter)
	$filterSQL 	= " WHERE tb.kd_kelas ='$kodeKelas'";
}

// Untuk pembagian halaman data (Paging)
$baris	= 50;
$hal 	= isset($_GET['hal']) ? $_GET['hal'] : 1;
$infoSql= "SELECT * FROM tugas_belajar As tb $filterSQL";
$infoQry= mysql_query($infoSql, $koneksidb) or die ("error paging: ".mysql_error());
$jumlah	= mysql_num_rows($infoQry);
$maks	= ceil($jumlah/$baris);
$mulai	= $baris * ($hal-1);

?>
<h2> LAPORAN DATA TUGAS BELAJAR </h2>
<form action="<?php $_SERVER['PHP_SELF']; ?>" method="post" name="form1" target="_self" id="form1">
  <table class="table-list" width="400" border="0" cellspacing="1" cellpadding="3">
    <tr>
      <td width="109" bgcolor="#CCCCCC"><strong>FILTER DATA</strong> </td>
      <td colspan="2">&nbsp;</td>
    </tr>
    <tr>
      <td><strong>Kelas</strong></td>
      <td width="7">:        </td>
      <td width="262"><select name="cmbKelas">
        <option value="Semua">....</option>
        <?php
	// Skrip menampilkan data Kelas ke dalam List/Menu 
	$bacaSql = "SELECT * FROM kelas ORDER BY kd_kelas";
	$bacaQry = mysql_query($bacaSql, $koneksidb) or die ("Gagal Query".mysql_error());
	while ($bacaData = mysql_fetch_array($bacaQry)) {
	if ($bacaData['kd_kelas'] == $kodeKelas) {
		$cek = " selected";
	} else { $cek=""; }
	
	echo "<option value='$bacaData[kd_kelas]' $cek> $bacaData[nm_kelas] </option>";
	}
	?>
      </select>
      <input name="btnTampil" type="submit" id="btnTampil" value="Tampil" /></td>
    </tr>
  </table>
</form>

<table class="table-list" width="700" border="0" cellspacing="1" cellpadding="3">
  <tr>
    <td width="4%" bgcolor="#CCCCCC"><strong>No</strong></td>
    <td width="6%" bgcolor="#CCCCCC"><strong>Kode</strong></td>
    <td width="34%" bgcolor="#CCCCCC"><strong>Nama Tugas </strong></td>
    <td width="22%" bgcolor="#CCCCCC"><strong>Pelajaran</strong></td>
    <td width="12%" bgcolor="#CCCCCC"><strong>Kelas</strong></td>
    <td width="22%" bgcolor="#CCCCCC"><strong>Guru</strong></td>
  </tr>

<?php
// Skrip menampilkan data Tugas Belajar
$mySql 	= "SELECT tb.*, pelajaran.nm_pelajaran, guru.nm_guru, kelas.nm_kelas 
			FROM tugas_belajar AS tb
			LEFT JOIN pelajaran ON tb.kd_pelajaran = pelajaran.kd_pelajaran 
			LEFT JOIN guru ON tb.kd_guru = guru.kd_guru
			LEFT JOIN kelas ON tb.kd_kelas = kelas.kd_kelas
			$filterSQL ORDER BY tb.kd_tugas ASC LIMIT $mulai, $baris";
$myQry 	= mysql_query($mySql, $koneksidb)  or die ("Query  salah : ".mysql_error());
$nomor  = 0; 
while ($myData = mysql_fetch_array($myQry)) {
	$nomor++;
?>

  <tr>
    <td><?php echo $nomor; ?> </td>
    <td><?php echo $myData['kd_tugas']; ?> </td>
    <td><?php echo $myData['nm_tugas']; ?> </td>
    <td><?php echo $myData['nm_pelajaran']; ?> </td>
    <td><?php echo $myData['nm_kelas']; ?></td>
    <td><?php echo $myData['nm_guru']; ?></td>
  </tr>
<?php } ?>
  <tr>
    <td colspan="3"><strong>Jumlah Data :</strong> <?php echo $jumlah; ?></td>
    <td colspan="3" align="right"><strong>Halaman Ke :</strong>
      <?php
	for ($h = 1; $h <= $maks; $h++) {
		echo " <a href='?open=Laporan-Tugas&hal=$h&kodeKelas=$kodeKelas'>$h</a> ";
	}
	?></td>
  </tr>
</table>
