<?php
// Valdasi Login User
include_once "../library/inc.seslogin.php";
// Koneksi ke database MySQL
include_once "../library/inc.connection.php";
?> 
<table width="650" border="0" cellpadding="2" cellspacing="1" class="table-border">
  <tr>
    <td width="789" colspan="2"><h1><b>DATA USER  </b></h1></td>
  </tr>
  <tr>
    <td colspan="2" align="right"><a href="?open=User-Add" target="_self"><img src="../images/btn_add_data.png" height="30" border="0"  /></a></td>
  </tr>
  
  <tr>
    <td colspan="2">
	<table class="table-list" width="100%" border="0" cellspacing="1" cellpadding="3">
      <tr>
        <td width="5%" bgcolor="#CCCCCC"><strong>No</strong></td>
        <td width="9%" bgcolor="#CCCCCC"><strong>Kode</strong></td>
        <td width="47%" bgcolor="#CCCCCC"><strong>Nama User </strong></td>
        <td width="21%" bgcolor="#CCCCCC"><strong>Username</strong></td>
        <td colspan="2" align="center" bgcolor="#CCCCCC"><strong>Tools</strong></td>
        </tr>
<?php
// Skrip menampilkan data User
$mySql 	= "SELECT * FROM user ORDER BY kd_user ASC";
$myQry 	= mysql_query($mySql, $koneksidb)  or die ("Query  salah: ".mysql_error());
$nomor  = 0; 
while ($myData = mysql_fetch_array($myQry)) {
	$nomor++;
	$Kode = $myData['kd_user'];
?>

  <tr>
	<td> <?php echo $nomor; ?> </td>
	<td> <?php echo $myData['kd_user']; ?> </td>
	<td> <?php echo $myData['nm_user']; ?> </td>
	<td> <?php echo $myData['username']; ?> </td>
	<td width="9%" align="center"><a href="?open=User-Delete&Kode=<?php echo $Kode; ?>" target="_self" onclick="return confirm('YAKIN INGIN MENGHAPUS DATA USER INI ... ?')"> Delete</a></td>
	<td width="9%" align="center"><a href="?open=User-Edit&Kode=<?php echo $Kode; ?>" target="_self">Edit</a></td>
  </tr>
	  
<?php } ?>
    </table></td>
  </tr>
</table>

