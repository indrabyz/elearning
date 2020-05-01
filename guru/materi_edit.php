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

	// Validasi Form Inputs
	$pesanError = array();
	if (trim($txtNama)=="") {
		$pesanError[] = "Data <b>Nama Materi</b> tidak boleh kosong !";		
	}
	if (trim($txtKeterangan)=="") {
		$pesanError[] = "Data <b>Keterangan</b> tidak boleh kosong !";		
	}
	if (trim($cmbPelajaran)=="Kosong") {
		$pesanError[] = "Data <b>Pelajaran</b> belum dipilih !";		
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
		
		// Membaca Kode data yang diedit
		$kodeMateri	= $_POST['txtKode'];

		# Skrip Upload file Materi
		if (empty($_FILES['txtNamaFile']['tmp_name'])) {
			// jika tidak ada file Materi baru, maka baca Materi lama
			$nama_file = $_POST['txtFileLama'];
		}
		else  {
			// Jika file Materi lama ada, akan dihapus
			$txtFileLama = $_POST['txtFileLama'];
			if(file_exists("../materi/".$txtFileLama)) {
				unlink("../materi/".$txtFileLama);	
			}
			
			// Membaca file Materi baru
			$nama_file = $_FILES['txtNamaFile']['name'];
			$nama_file = stripslashes($nama_file);
			$nama_file = str_replace("'","",$nama_file);
			
			// Mengkopi file Materi baru ke folder
			$nama_file = $kodeMateri.".".$nama_file;
			copy($_FILES['txtNamaFile']['tmp_name'],"../materi/".$nama_file);					
		}
		
		// Skrip simpan data ke database
		$kodeGuru	= $_SESSION['SES_GURU'];
		$mySql	= "UPDATE materi_belajar SET nm_materi='$txtNama', keterangan='$txtKeterangan', file_materi='$nama_file', 
					kd_pelajaran='$cmbPelajaran' WHERE kd_materi='$kodeMateri' AND kd_guru='$kodeGuru'";
					
		$myQry	= mysql_query($mySql, $koneksidb) or die ("Gagal query".mysql_error());
		if($myQry){
			echo "<meta http-equiv='refresh' content='0; url=?open=Materi-Data'>";
		}
		exit;			
	}		
}

// Membaca Kode Guru yang login
$kodeGuru= $_SESSION['SES_GURU'];

# MEMBACA DATA DARI DATABASE UNTUK DIEDIT
$Kode	 = $_GET['Kode']; 
$mySql	 = "SELECT * FROM materi_belajar WHERE kd_materi='$Kode' AND kd_guru='$kodeGuru'";
$myQry	 = mysql_query($mySql, $koneksidb)  or die ("Query salah : ".mysql_error());
$myData	 = mysql_fetch_array($myQry);

// Membuat variabel isi ke form
$dataKode	= $myData['kd_materi'];
$dataNama 	= isset($_POST['txtNama']) ? $_POST['txtNama'] : $myData['nm_materi'];
$dataKeterangan = isset($_POST['txtKeterangan']) ? $_POST['txtKeterangan'] : $myData['keterangan'];
$dataPelajaran 	= isset($_POST['cmbPelajaran']) ? $_POST['cmbPelajaran'] : $myData['kd_pelajaran'];
?>
<form action="<?php $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data" name="form1" target="_self" id="form1">
  <table class="table-list" width="700" border="0" cellspacing="1" cellpadding="3">
    <tr>
      <td width="209" bgcolor="#CCCCCC"><strong>UBAH  DATA MATERI </strong></td>
      <td width="6">&nbsp;</td>
      <td width="463">&nbsp;</td>
    </tr>
    <tr>
      <td><strong>Kode</strong></td>
      <td>:</td>
      <td><input name="textfield" type="text" value="<?php echo $dataKode; ?>" size="10" maxlength="4" />
      <input name="txtKode" type="hidden" id="txtKode" value="<?php echo $myData['kd_materi']; ?>" /></td>
    </tr>
    <tr>
      <td><strong>Nama Materi </strong></td>
      <td>:</td>
      <td><input name="txtNama" type="text" id="txtNama" value="<?php echo $dataNama; ?>" size="70" maxlength="100" /></td>
    </tr>
    <tr>
      <td><strong>Keterangan</strong></td>
      <td>:</td>
      <td><input name="txtKeterangan" type="text" id="txtKeterangan" value="<?php echo $dataKeterangan; ?>" size="70" maxlength="200" /></td>
    </tr>
    <tr>
      <td><strong>File Materi (Zip/ PDF/ Doc) </strong></td>
      <td>:</td>
      <td><input name="txtNamaFile" type="file" id="txtNamaFile" size="40" maxlength="200" />
      <input name="txtFileLama" type="hidden" id="txtFileLama" value="<?php echo $myData['file_materi']; ?>" /></td>
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
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td><input name="btnSimpan" type="submit" id="btnSimpan" value="Simpan" /></td>
    </tr>
  </table>
</form>
