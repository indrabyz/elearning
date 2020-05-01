<?php
// Valdasi Login User
include_once "../library/inc.seslogin.php";

// Koneksi ke database MySQL
include_once "../library/inc.connection.php";
?> 
<table width="650" border="0" cellpadding="2" cellspacing="1" class="table-border">
  <tr>
    <td width="789" colspan="2"><h1><b>DATA KELAS  </b></h1></td>
  </tr>
  <tr>
    <td colspan="2" align="right"><a href="?open=Kelas-Add" target="_self"><img src="../images/btn_add_data.png" height="30" border="0"  /></a></td>
  </tr>
  <tr>
    <td colspan="2"><table class="table-list" width="100%" border="0" cellspacing="1" cellpadding="3">
      <tr>
        <td width="4%" bgcolor="#CCCCCC"><strong>No</strong></td>
        <td width="8%" bgcolor="#CCCCCC"><strong>Kode</strong></td>
        <td width="36%" bgcolor="#CCCCCC"><strong>Nama Kelas </strong></td>
        <td width="37%" bgcolor="#CCCCCC"><strong>Guru Wali </strong></td>
        <td colspan="2" align="center" bgcolor="#CCCCCC"><strong>Tools</strong></td>
        </tr>
	  
<?php
// Skrip menampilkan data Kelas
$mySql 	= "SELECT kelas.*, guru.nm_guru FROM kelas 
			LEFT JOIN guru ON kelas.kd_guru = guru.kd_guru ORDER BY kelas.kd_kelas ASC";
$myQry 	= mysql_query($mySql, $koneksidb)  or die ("Query  salah : ".mysql_error());
$nomor  = 0; 
while ($myData = mysql_fetch_array($myQry)) {
	$nomor++;
	$Kode = $myData['kd_kelas'];
?>

      <tr>
        <td> <?php echo $nomor; ?>  </td>
        <td> <?php echo $myData['kd_kelas']; ?> </td>
        <td> <?php echo $myData['nm_kelas']; ?> </td>
        <td> <?php echo $myData['nm_guru']; ?> </td>
        <td width="8%"><a href="?open=Kelas-Delete&Kode=<?php echo $Kode; ?>" target="_self" onclick="return confirm('YAKIN INGIN MENGHAPUS DATA KELAS INI ... ?')">Delete</a></td>
        <td width="7%"><a href="?open=Kelas-Edit&Kode=<?php echo $Kode; ?>" target="_self">Edit</a></td>
      </tr>
	  
<?php } ?>

    </table></td>
  </tr>
  <tr>
    <td colspan="2">&nbsp;</td>
  </tr>
</table>

