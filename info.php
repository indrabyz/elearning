<?php
if(isset($_SESSION['SES_LOGIN'])) {
	echo "<h3>Selamat datang di Aplikasi E-Learning SMP !</h3>";
	echo "<b> Anda sudah login ";
	exit;
}
elseif (isset($_SESSION['SES_SISWA'])) {
	echo "<h3>Selamat datang di Aplikasi E-Learning SMP !</h3>";
	echo "<b>Welcome Siswa ";
}
else {
	echo "<h3>Selamat datang di Aplikasi E-Learning SMP !</h3>";
	echo "<b>Welcome  ";	
}
?>