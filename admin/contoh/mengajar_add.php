<?php
// Valdasi Login User
include_once "../library/inc.seslogin.php";
// Koneksi ke database MySQL
include_once "../library/inc.connection.php";
// Membaca file library
include_once "../library/inc.library.php";

# SKRIP TOMBOL SIMPAN DIKLIK
if(isset($_POST['btnSimpan'])){
	// Baca Data dari Form Input
	$cmbKelas		= $_POST['cmbKelas'];
	$cmbPelajaran	= $_POST['cmbPelajaran'];
	$cmbGuru		= $_POST['cmbGuru'];
	$cmbHari		= $_POST['cmbHari'];
	$txtJam			= $_POST['txtJam'];
	$txtRuang		= $_POST['txtRuang'];

	// Validasi Form Inputs
	$pesanError = array();
	if (trim($cmbKelas)=="Kosong") {
		$pesanError[] = "Data <b>Kelas</b> belum dipilih !";		
	}
	if (trim($cmbPelajaran)=="Kosong") {
		$pesanError[] = "Data <b>Pelajaran</b> belum dipilih !";		
	}
	if (trim($cmbGuru)=="Kosong") {
		$pesanError[] = "Data <b>Guru</b> belum dipilih !";		
	}
	if (trim($cmbHari)=="Kosong") {
		$pesanError[] = "Data <b>Hari</b> belum dipilih !";		
	}
	if (trim($txtJam)=="") {
		$pesanError[] = "Data <b>Jam Belajar</b> tidak boleh kosong !";		
	}
	if (trim($txtRuang)=="") {
		$pesanError[] = "Data <b>Ruang</b> tidak boleh kosong !";		
	}
	
	// Menampilkan Pesan Error dari Form
	if (count($pesanError)>=1 ){
		echo "<div class='mssgBox'>";
		echo "<img src='../images/attention.png'> <br><hr>";
			$noPesan=0;
			foreach ($pesanError as $indeks=>$pesan_tampil) { 
			$noPesan++;
				echo "&nbsp; $noPesan. $pesan_tampil<br>";	
			} 
		echo "</div> <br>"; 
	}
	else {
		// Skrip Simpan data ke Database
		
		// Membuat kode Otomatis
		$kodeBaru	= buatKode("mengajar", "M");
		
		$mySql	= "INSERT INTO mengajar (kd_mengajar, kd_kelas, kd_pelajaran, kd_guru, hari, jam, ruang) 
					VALUES ('$kodeBaru', '$cmbKelas', '$cmbPelajaran', '$cmbGuru','$cmbHari', '$txtJam', '$txtRuang')";

		$myQry	= mysql_query($mySql, $koneksidb) or die ("Gagal query".mysql_error());
		if($myQry){
			echo "<meta http-equiv='refresh' content='0; url=?open=Mengajar-Add'>";
		}
		exit;			
	}		
}

// Membuat variabel isi ke form
$dataKode 		= buatKode("mengajar", "M");
$dataKelas 		= isset($_POST['cmbKelas']) ? $_POST['cmbKelas'] : '';
$dataPelajaran 	= isset($_POST['cmbPelajaran']) ? $_POST['cmbPelajaran'] : '';
$dataGuru 		= isset($_POST['cmbGuru']) ? $_POST['cmbGuru'] : ''; 
$dataHari 		= isset($_POST['cmbHari']) ? $_POST['cmbHari'] : '';
$dataJam 		= isset($_POST['txtJam']) ? $_POST['txtJam'] : '';
$dataRuang 		= isset($_POST['txtRuang']) ? $_POST['txtRuang'] : '';
?>
<form action="<?php $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data" name="form1" target="_self" id="form1">
  <table class="table-list" width="700" border="0" cellspacing="1" cellpadding="3">
    <tr>
      <td width="217" bgcolor="#CCCCCC"><strong>TAMBAH DATA MENGAJAR </strong></td>
      <td width="10">&nbsp;</td>
      <td width="451">&nbsp;</td>
    </tr>
    <tr>
      <td><strong>Kode</strong></td>
      <td>:</td>
      <td><input name="textfield" type="text" value="<?php echo $dataKode; ?>" size="10" maxlength="4" /></td>
    </tr>
    <tr>
      <td><strong>Kelas</strong></td>
      <td>:</td>
      <td><select name="cmbKelas">
          <option value="Kosong">....</option>
          <?php
// Skrip menampilkan data Kelas ke dalam List/Menu 
$bacaSql = "SELECT * FROM kelas ORDER BY kd_kelas";
$bacaQry = mysql_query($bacaSql, $koneksidb) or die ("Gagal Query".mysql_error());
while ($bacaData = mysql_fetch_array($bacaQry)) {
	if ($bacaData['kd_kelas'] == $dataKelas) {
		$cek = " selected";
	} else { $cek=""; }
	
	echo "<option value='$bacaData[kd_kelas]' $cek> $bacaData[nm_kelas] </option>";
}
?>
        </select>      </td>
    </tr>
    <tr>
      <td><strong>Pelajaran</strong></td>
      <td>:</td>
<td><select name="cmbPelajaran">
<option value="Kosong">....</option>
<?php
// Skrip menampilkan data Pelajaran ke dalam List/Menu 
$bacaSql = "SELECT * FROM pelajaran ORDER BY kd_pelajaran";
$bacaQry = mysql_query($bacaSql, $koneksidb) or die ("Gagal Query".mysql_error());
while ($bacaData = mysql_fetch_array($bacaQry)) {
	if ($bacaData['kd_pelajaran'] == $dataPelajaran) {
		$cek = " selected";
	} else { $cek=""; }
	
	echo "<option value='$bacaData[kd_pelajaran]' $cek> $bacaData[nm_pelajaran] </option>";
}
?>
</select>	</td>
    </tr>
    <tr>
      <td><strong>Guru</strong></td>
      <td>:</td>
      <td><select name="cmbGuru" id="cmbGuru">
        <option value="Kosong">....</option>
	<?php
	// Skrip menampilkan data Guru ke dalam List/Menu 
	$bacaSql = "SELECT * FROM guru ORDER BY kd_guru";
	$bacaQry = mysql_query($bacaSql, $koneksidb) or die ("Gagal Query".mysql_error());
	while ($bacaData = mysql_fetch_array($bacaQry)) {
	if ($bacaData['kd_guru'] == $dataGuru) {
		$cek = " selected";
	} else { $cek=""; }
	
	echo "<option value='$bacaData[kd_guru]' $cek> $bacaData[nm_guru] </option>";
	}
	?>
      </select></td>
    </tr>
    <tr>
      <td><strong>Hari</strong></td>
      <td>:</td>
      <td><select name="cmbHari">
          <option value="Kosong">....</option>
          <?php
	  $pilihan = array("Senin", "Selasa", "Rabu", "Kamis", "Jumat");
	  foreach ($pilihan as  $nilai) {
		if ($dataHari==$nilai) {
			$cek=" selected";
		} else { $cek = ""; }
		echo "<option value='$nilai' $cek> $nilai</option>";
	  }
	  ?>
      </select></td>
    </tr>
    <tr>
      <td><strong>Jam</strong></td>
      <td>:</td>
      <td><input name="txtJam" type="text" id="txtJam" value="<?php echo $dataJam; ?>" size="10" maxlength="5" /></td>
    </tr>
    <tr>
      <td><strong>Ruang</strong></td>
      <td>:</td>
      <td><input name="txtRuang" type="text" id="txtRuang" value="<?php echo $dataRuang; ?>" size="20" maxlength="20" /></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td><input type="submit" name="btnSimpan" value=" SIMPAN " style="cursor:pointer;" /></td>
    </tr>
  </table>
</form>
