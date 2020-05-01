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
	$txtNama		= $_POST['txtNama'];
	$txtNis			= $_POST['txtNis'];
	$cmbKelamin		= $_POST['cmbKelamin'];
	$cmbAgama		= $_POST['cmbAgama'];
	$txtAlamat		= $_POST['txtAlamat'];
	$txtNoTelepon	= $_POST['txtNoTelepon'];
	$txtUsername	= $_POST['txtUsername'];
	$txtPassword	= $_POST['txtPassword'];
	
	$txtTempatLhr	= $_POST['txtTempatLhr'];
	$cmbTanggalLhr	= $_POST['cmbTanggalLhr'];
	$cmbBulanLhr	= $_POST['cmbBulanLhr'];
	$cmbTahunLhr	= $_POST['cmbTahunLhr'];
	
	// Validasi Form Input
	$pesanError = array();
	if (trim($txtNis)=="") {
		$pesanError[] = "Data <b>NIS</b> tidak boleh kosong !";		
	}
	if (trim($txtNama)=="") {
		$pesanError[] = "Data <b>Nama Siswa</b> tidak boleh kosong !";		
	}
	if (trim($cmbKelamin)=="Kosong") {
		$pesanError[] = "Data <b>Kelamin</b> belum ada yang dipilih !";		
	}
	if (trim($cmbAgama)=="Kosong") {
		$pesanError[] = "Data <b>Agama</b> belum ada yang dipilih !";		
	}
	if (trim($txtTempatLhr)=="") {
		$pesanError[] = "Data <b>Tempat Lahir</b> tidak boleh kosong !";		
	}
	if (trim($cmbTanggalLhr)=="Kosong") {
		$pesanError[] = "Data <b>Tanggal. Lahir</b> belum ada yang dipilih !";		
	}
	if (trim($cmbBulanLhr)=="Kosong") {
		$pesanError[] = "Data <b>Bulan. Lahir</b> belum ada yang dipilih !";		
	}
	if (trim($cmbTahunLhr)=="Kosong") {
		$pesanError[] = "Data <b>Tahun. Lahir</b> belum ada yang dipilih !";		
	}
	if (trim($txtAlamat)=="") {
		$pesanError[] = "Data <b>Alamat</b> tidak boleh kosong !";	
	}
	if (trim($txtNoTelepon)=="") {
		$pesanError[] = "Data <b>No. Telepon</b> tidak boleh kosong!";
	}
	if (trim($txtUsername)=="") {
		$pesanError[] = "Data <b>Username</b> tidak boleh kosong!";
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
		$kodeSiswa	= $_POST['txtKode'];
		
		// Menyusun Tanggal (Y-m-d)
		$tanggalLahir	= $cmbTahunLhr."-".$cmbBulanLhr."-".$cmbTanggalLhr;
		
		# Skrip Upload file gambar
		if (empty($_FILES['txtNamaFile']['tmp_name'])) {
			// jika tidak ada file foto baru, maka baca foto lama
			$nama_file = $_POST['txtFotoLama'];
		}
		else  {
			// Jika file foto lama ada, akan dihapus
			$txtFotoLama = $_POST['txtFotoLama'];
			if(file_exists("../foto/$txtFotoLama")) {
				unlink("../foto/$txtFotoLama");	
			}
			
			// Membaca file foto baru
			$nama_file = $_FILES['txtNamaFile']['name'];
			$nama_file = stripslashes($nama_file);
			$nama_file = str_replace("'","",$nama_file);
			
			// Mengkopi file foto baru ke folder
			$nama_file = $kodeSiswa.".".$nama_file;
			copy($_FILES['txtNamaFile']['tmp_name'],"../foto/".$nama_file);					
		}


		// Memperbarui Password Jika ada Perubahan
		if (trim($txtPassword)=="") {
			$txtPassLama= $_POST['txtPassLama'];
			$passwordSQL = ", password='$txtPassLama'";
		}
		else {
			$passwordSQL = ",  password =MD5('$txtPassword')";
		}

		// Skrip simpan data ke database		 
		$mySql 	= "UPDATE siswa SET nm_siswa='$txtNama', nis='$txtNis', kelamin='$cmbKelamin', agama='$cmbAgama', 
						tempat_lahir= '$txtTempatLhr', tanggal_lahir= '$tanggalLahir', alamat='$txtAlamat', 
						no_telepon='$txtNoTelepon', foto = '$nama_file', username='$txtUsername' $passwordSQL 
					WHERE kd_siswa='$kodeSiswa'";

		$myQry	= mysql_query($mySql, $koneksidb) or die ("Gagal query".mysql_error());
		if($myQry){
			echo "<meta http-equiv='refresh' content='0; url=?open=Siswa-Data'>";
		}
		exit;	
	}	
}

# MEMBACA DATA DARI DATABASE UNTUK DIEDIT
$Kode	 = $_GET['Kode']; 
$mySql	 = "SELECT * FROM siswa WHERE kd_siswa='$Kode'";
$myQry	 = mysql_query($mySql, $koneksidb)  or die ("Query salah : ".mysql_error());
$myData	 = mysql_fetch_array($myQry);

// Membuat variabel isi ke form 
$dataKode		= $myData['kd_siswa'];
$dataNis 		= isset($_POST['txtNis']) ? $_POST['txtNis'] : $myData['nis'];
$dataNama 		= isset($_POST['txtNama']) ? $_POST['txtNama'] : $myData['nm_siswa'];
$dataKelamin	= isset($_POST['cmbKelamin']) ? $_POST['cmbKelamin'] : $myData['kelamin'];
$dataAgama		= isset($_POST['cmbAgama']) ? $_POST['cmbAgama'] : $myData['agama'];
$dataTempatLhr 	= isset($_POST['txtTempatLhr']) ? $_POST['txtTempatLhr'] : $myData['tempat_lahir'];

$tanggalLhr		= substr($myData['tanggal_lahir'], 9, 2);
$dataTanggalLhr	= isset($_POST['cmbTanggalLhr']) ? $_POST['cmbTanggalLhr'] : $tanggalLhr;

$bulanLhr		= substr($myData['tanggal_lahir'], 5, 2);
$dataBulanLhr	= isset($_POST['cmbBulanLhr']) ? $_POST['cmbBulanLhr'] : $bulanLhr;

$tahunLhr		= substr($myData['tanggal_lahir'], 0, 4);
$dataTahunLhr	= isset($_POST['cmbTahunLhr']) ? $_POST['cmbTahunLhr'] : $tahunLhr;

$dataAlamat 	= isset($_POST['txtAlamat']) ? $_POST['txtAlamat'] : $myData['alamat'];
$dataNoTelepon 	= isset($_POST['txtNoTelepon']) ? $_POST['txtNoTelepon'] : $myData['no_telepon'];
$dataUsername 	= isset($_POST['txtUsername']) ? $_POST['txtUsername'] : $myData['username'];
?>
<form action="<?php $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data" name="form1" target="_self" id="form1">
  <table class="table-list" width="700" border="0" cellspacing="1" cellpadding="3">
    <tr>
      <td bgcolor="#CCCCCC"><strong>UBAH DATA SISWA </strong></td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td width="182"><strong>Kode</strong></td>
      <td width="8"><strong>:</strong></td>
      <td width="488"><input name="textfield" type="text" value="<?php echo $dataKode; ?>" size="10" maxlength="4" />
      <input name="txtKode" type="hidden" id="txtKode" value="<?php echo $dataKode; ?>" /></td>
    </tr>
    <tr>
      <td><strong>Nis</strong></td>
      <td><strong>:</strong></td>
      <td><input name="txtNis" type="text" id="txtNis" value="<?php echo $dataNis; ?>" size="10" maxlength="10" /></td>
    </tr>
    <tr>
      <td><strong>Nama Siswa </strong></td>
      <td><strong>:</strong></td>
      <td><input name="txtNama" type="text" id="txtNama" value="<?php echo $dataNama; ?>" size="60" maxlength="100" /></td>
    </tr>
    <tr>
      <td><strong>Kelamin</strong></td>
      <td><strong>:</strong></td>
      <td><select name="cmbKelamin">
	  <option value="Kosong">....</option>
	  <?php
	  $pilihan = array("L"=> "Laki-laki(L)", "P" => "Perempuan(P)");
	  foreach ($pilihan as  $indeks => $nilai) {
		if ($dataKelamin==$indeks) {
			$cek=" selected";
		} else { $cek = ""; }
		echo "<option value='$indeks' $cek>$nilai</option>";
	  }
	  ?>
	</select>      </td>
    </tr>
    <tr>
      <td><strong>Agama</strong></td>
      <td><strong>:</strong></td>
      <td><select name="cmbAgama">
	<option value="Kosong">....</option>
	<?php
	  $pilihan = array("Islam", "Kristen", "Katolik", "Hindu", "Budha");
	  foreach ($pilihan as  $nilai) {
		if ($dataAgama==$nilai) {
			$cek=" selected";
		} else { $cek = ""; }
		echo "<option value='$nilai' $cek> $nilai</option>";
	  }
	  ?>
	</select>	</td>
    </tr>
    <tr>
      <td><strong>Tempat &amp; Tgl. Lahir </strong></td>
      <td><strong>:</strong></td>
      <td><input name="txtTempatLhr" type="text" id="txtTempatLhr" value="<?php echo $dataTempatLhr; ?>" size="30" maxlength="100" /> , 
	<select name="cmbTanggalLhr">
	  <option value="Kosong">....</option>
	  <?php
	  for($tanggal = 1; $tanggal <= 31; $tanggal++) {
		// Skrip membuat angka 2 digit (1-9)
		if($tanggal < 10) { $tggl = "0".$tanggal;} else { $tggl = $tanggal; }
		
		// Skrip tanggal terpilih
		if($tggl == $dataTanggalLhr) { $cek=" selected"; } else { $cek = ""; }
		
		echo "<option value='$tggl' $cek> $tggl </option>";
	  }
	  ?>
	</select> -
	<select name="cmbBulanLhr">
	<option value="Kosong">....</option>
	<?php
	for($bulan = 1; $bulan <= 12; $bulan++) {
		// Skrip membuat angka 2 digit (1-9)
		if($bulan < 10) { $bln = "0".$bulan; } else { $bln = $bulan; }
		
		if ($bln == $dataBulanLhr) { $cek=" selected"; } else { $cek = ""; }
		
		echo "<option value='$bln' $cek> $listBulan[$bln] </option>";
	}
	?>
	</select>
	- 
	<select name="cmbTahunLhr">
	  <option value="Kosong">....</option>
	  <?php
		$thmuda	= date('Y') - 25;
		$thtua	= date('Y') - 10;
	  for($tahun = $thmuda; $tahun <= $thtua; $tahun++) {
		// Skrip tahun terpilih
		if ($tahun == $dataTahunLhr) {  $cek=" selected"; } else { $cek = ""; }
		
		echo "<option value='$tahun' $cek> $tahun </option>";
	  }
	  ?>
	</select> </td>
    </tr>
    <tr>
      <td><strong>Alamat</strong></td>
      <td><strong>:</strong></td>
      <td><input name="txtAlamat" type="text" id="txtAlamat" value="<?php echo $dataAlamat; ?>" size="70" maxlength="100" /></td>
    </tr>
    <tr>
      <td><strong>No. Telepon </strong></td>
      <td><strong>:</strong></td>
      <td><input name="txtNoTelepon" type="text" id="txtNoTelepon" value="<?php echo $dataNoTelepon; ?>" size="25" maxlength="20" /></td>
    </tr>
    <tr>
      <td><strong>Foto</strong></td>
      <td><strong>:</strong></td>
      <td><input name="txtNamaFile" type="file" id="txtNamaFile" size="40" maxlength="200" />
      <input name="txtFotoLama" type="hidden" id="txtFotoLama" value="<?php echo $myData['foto']; ?>" /></td>
    </tr>
    <tr>
      <td><strong>Username</strong></td>
      <td><strong>:</strong></td>
      <td><input name="txtUsername" type="text" id="txtUsername" value="<?php echo $dataUsername; ?>" size="20" maxlength="20" /></td>
    </tr>
    <tr>
      <td><strong>Password</strong></td>
      <td><strong>:</strong></td>
      <td><input name="txtPassword" type="password" id="txtPassword" size="20" maxlength="20" />
      <input name="txtPassLama" type="hidden" id="txtPassLama" value="<?php echo $myData['password']; ?>" /></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td><input name="btnSimpan" type="submit" id="btnSimpan" value="Simpan" /></td>
    </tr>
  </table>
</form>
