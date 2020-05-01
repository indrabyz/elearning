<?php
// Valdasi Login User
include_once "../library/inc.sesguru.php";
// Koneksi ke database MySQL
include_once "../library/inc.connection.php";
// Membaca file library
include_once "../library/inc.library.php";

# SKRIP TOMBOL SIMPAN DIKLIK
if(isset($_POST['btnSimpan'])){
	// Baca Data dari Form Input
	$txtNama		= $_POST['txtNama'];
	$txtKeterangan	= $_POST['txtKeterangan'];
	$cmbPelajaran	= $_POST['cmbPelajaran'];
	$cmbKelas		= $_POST['cmbKelas'];

	// Validasi Form Inputs
	$pesanError = array();
	if (trim($txtNama)=="") {
		$pesanError[] = "Data <b>Nama Tugas</b> tidak boleh kosong !";		
	}
	if (trim($txtKeterangan)=="") {
		$pesanError[] = "Data <b>Keterangan</b> tidak boleh kosong !";		
	}
	if (trim($cmbPelajaran)=="Kosong") {
		$pesanError[] = "Data <b>Pelajaran</b> belum dipilih !";		
	}
	if (trim($cmbKelas)=="Kelas") {
		$pesanError[] = "Data <b>Kelas</b> belum dipilih !";		
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
		
		// Membaca Kode
		$kodeTugas	= $_POST['txtKode'];

		# Skrip Upload file Tugas
		if (empty($_FILES['txtNamaFile']['tmp_name'])) {
			// jika tidak ada file Tugas baru, maka baca Tugas lama
			$nama_file = $_POST['txtFileLama'];
		}
		else  {
			// Jika file Tugas lama ada, akan dihapus
			$txtFileLama = $_POST['txtFileLama'];
			if(file_exists("../tugas/".$txtFileLama)) {
				unlink("../tugas/".$txtFileLama);	
			}
			
			// Membaca file Tugas baru
			$nama_file = $_FILES['txtNamaFile']['name'];
			$nama_file = stripslashes($nama_file);
			$nama_file = str_replace("'","",$nama_file);
			
			// Mengkopi file Tugas baru ke folder
			$nama_file = $kodeTugas.".".$nama_file;
			copy($_FILES['txtNamaFile']['tmp_name'],"../tugas/".$nama_file);					
		}
		
		// Skrip simpan data ke database
		$kodeGuru= $_SESSION['SES_GURU'];
		$mySql	= "UPDATE tugas_belajar SET nm_tugas='$txtNama', keterangan='$txtKeterangan', file_tugas='$nama_file', 
					kd_pelajaran='$cmbPelajaran', kd_kelas='$cmbKelas', kd_guru='$kodeGuru' 
					WHERE kd_tugas='$kodeTugas'";

		$myQry	= mysql_query($mySql, $koneksidb) or die ("Gagal query".mysql_error());
		if($myQry){
			echo "<meta http-equiv='refresh' content='0; url=?open=Tugas-Data'>";
		}
		exit;			
	}		
}

# MEMBACA DATA DARI DATABASE UNTUK DIEDIT
$kodeGuru= $_SESSION['SES_GURU'];
$Kode	 = $_GET['Kode']; 
$mySql	 = "SELECT * FROM tugas_belajar WHERE kd_tugas='$Kode' AND kd_guru='$kodeGuru'";
$myQry	 = mysql_query($mySql, $koneksidb)  or die ("Query salah : ".mysql_error());
$myData	 = mysql_fetch_array($myQry);

// Membuat variabel isi ke form 
$dataKode		= $myData['kd_tugas'];
$dataNama 		= isset($_POST['txtNama']) ? $_POST['txtNama'] : $myData['nm_tugas'];
$dataKeterangan = isset($_POST['txtKeterangan']) ? $_POST['txtKeterangan'] : $myData['keterangan'];
$dataPelajaran 	= isset($_POST['cmbPelajaran']) ? $_POST['cmbPelajaran'] : $myData['kd_pelajaran'];
$dataKelas	 	= isset($_POST['cmbKelas']) ? $_POST['cmbKelas'] : $myData['kd_kelas'];
$dataGuru	 	= isset($_POST['cmbGuru']) ? $_POST['cmbGuru'] : $myData['kd_guru'];
?>
<form action="<?php $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data" name="form1" target="_self" id="form1">
  <table class="table-list" width="700" border="0" cellspacing="1" cellpadding="3">
    <tr>
      <td width="209" bgcolor="#CCCCCC"><strong>UBAH  DATA TUGAS </strong></td>
      <td width="6">&nbsp;</td>
      <td width="463">&nbsp;</td>
    </tr>
    <tr>
      <td><strong>Kode</strong></td>
      <td>:</td>
      <td><input name="textfield" type="text" value="<?php echo $dataKode; ?>" size="10" maxlength="4" />
      <input name="txtKode" type="hidden" id="txtKode" value="<?php echo $dataKode; ?>" /></td>
    </tr>
    <tr>
      <td><strong>Nama Tugas </strong></td>
      <td>:</td>
      <td><input name="txtNama" type="text" id="txtNama" value="<?php echo $dataNama; ?>" size="70" maxlength="100" /></td>
    </tr>
    <tr>
      <td><strong>Keterangan</strong></td>
      <td>:</td>
      <td><input name="txtKeterangan" type="text" id="txtKeterangan" value="<?php echo $dataKeterangan; ?>" size="70" maxlength="200" /></td>
    </tr>
    <tr>
      <td><strong>File Tugas (Zip/ PDF/ Doc) </strong></td>
      <td>:</td>
      <td><input name="txtNamaFile" type="file" id="txtNamaFile" size="40" maxlength="200" />
      <input name="txtFileLama" type="hidden" id="txtFileLama" value="<?php echo $myData['file_tugas']; ?>" /></td>
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
      <td><strong>Kelas</strong></td>
      <td>:</td>
      <td>
<select name="cmbKelas">
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
</select>
      </td>
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
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td><input type="submit" name="btnSimpan" value=" SIMPAN " style="cursor:pointer;" /></td>
    </tr>
  </table>
</form>
