<?php
if(empty($_SESSION['SES_GURU'])) {
	echo "<center>";
	echo "<br> <br> <b>Maaf Akses Guru Ditolak!</b> <br>
		  Silahkan Anda login sebagai Guru untuk bisa mengakses halaman ini.";
	echo "</center>";
	
	// Refresh
	echo "<meta http-equiv='refresh' content='3; url=../index.php'>";
	exit;
}
?>