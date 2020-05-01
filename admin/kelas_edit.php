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
	$txtNama	= $_POST['txtNama'];
	$cmbGuru	= $_POST['cmbGuru'];
	
	// Validasi Form Inputs
	$pesanError = array();
	if (trim($txtNama)=="") {
		$pesanError[] = "Data <b>Nama Kelas</b> tidak boleh kosong !";		
	}
	if (trim($cmbGuru)=="Kosong") {
		$pesanError[] = "Data <b>Guru Wali</b> belum ada yang dipilih !";		
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
		$txtKode= $_POST['txtKode'];
		$mySql  = "UPDATE kelas SET nm_kelas='$txtNama', kd_guru='$cmbGuru' 
					WHERE kd_kelas ='$txtKode'";
		
		$myQry	= mysql_query($mySql, $koneksidb) or die ("Gagal query".mysql_error());
		if($myQry){
			echo "<meta http-equiv='refresh' content='0; url=?open=Kelas-Data'>";
		}
		exit;	
	}	
}

# MEMBACA DATA DARI DATABASE UNTUK DIEDIT
$Kode	 = $_GET['Kode']; 
$mySql	 = "SELECT * FROM kelas WHERE kd_kelas='$Kode'";
$myQry	 = mysql_query($mySql, $koneksidb)  or die ("Query salah : ".mysql_error());
$myData	 = mysql_fetch_array($myQry);

	// Membuat variabel isi ke form 
	$dataKode	= $myData['kd_kelas'];
	$dataNama	= isset($_POST['txtNama']) ? $_POST['txtNama'] : $myData['nm_kelas'];
	$dataGuru 	= isset($_POST['cmbGuru']) ? $_POST['cmbGuru'] : $myData['kd_guru'];

?>
<form action="<?php $_SERVER['PHP_SELF']; ?>" method="post" name="form1" target="_self" id="form1">
  <table class="table-list" width="650" border="0" cellspacing="1" cellpadding="3">
    
    <tr>
      <td bgcolor="#CCCCCC"><strong>UBAH DATA KELAS </strong></td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td width="182"><strong>Kode</strong></td>
      <td width="6">:</td>
      <td width="440"><input name="textfield" type="text" value="<?php echo $dataKode; ?>" size="10" maxlength="4" />
      <input name="txtKode" type="hidden" id="txtKode" value="<?php echo $dataKode; ?>" /></td>
    </tr>
    <tr>
      <td><strong>Nama Kelas </strong></td>
      <td>:</td>
      <td><input name="txtNama" type="text" id="txtNama" value="<?php echo $dataNama; ?>" size="60" maxlength="100" /></td>
    </tr>
    <tr>
      <td><strong>Guru Wali </strong></td>
      <td>:</td>
      <td><select name="cmbGuru">
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
      <td><input name="btnSimpan" type="submit" id="btnSimpan" value="Simpan" /></td>
    </tr>
  </table>
  <table class="table-list" width="650" border="0" cellspacing="1" cellpadding="3">
    <tr>
      <td width="4%" bgcolor="#CCCCCC"><strong>No</strong></td>
      <td width="10%" bgcolor="#CCCCCC"><strong>Kode</strong></td>
      <td width="11%" bgcolor="#CCCCCC"><strong>NIS</strong></td>
      <td width="47%" bgcolor="#CCCCCC"><strong>Nama Siswa </strong></td>
      <td width="7%" bgcolor="#CCCCCC"><strong>L/P</strong></td>
      <td width="21%" bgcolor="#CCCCCC"><strong>Username</strong></td>
    </tr>
    <?php
// Skrip menampilkan data Siswa yang dimiili oleh Kelas
$tmpSql 	= "SELECT kelas_siswa.*, siswa.nis, siswa.nm_siswa, siswa.kelamin, siswa.username 
				FROM kelas_siswa LEFT JOIN  siswa ON kelas_siswa.kd_siswa = siswa.kd_siswa 
				WHERE kelas_siswa.kd_kelas='$Kode' ORDER BY  siswa.kd_siswa ASC";
$tmpQry 	= mysql_query($tmpSql, $koneksidb)  or die ("Query  salah: ".mysql_error());
$nomor  = 0; 
while ($tmpData = mysql_fetch_array($tmpQry)) {
	$nomor++;
	$Kode = $tmpData['kd_siswa'];
?>
    <tr>
      <td><?php echo $nomor; ?> </td>
      <td><?php echo $tmpData['kd_siswa']; ?> </td>
      <td><?php echo $tmpData['nis']; ?> </td>
      <td><?php echo $tmpData['nm_siswa']; ?> </td>
      <td><?php echo $tmpData['kelamin']; ?> </td>
      <td><?php echo $tmpData['username']; ?> </td>
    </tr>
    <?php } ?>
  </table>
</form>
