<?php
if(isset($_SESSION['SES_GURU'])) {
	echo "<h3>Selamat datang di Aplikasi E-Learning SMP !</h3>";
	echo "<b> Anda login sebagai Guru";
	exit;
}
else {
	echo "<h3>Selamat datang di Aplikasi E-Learning SMP !</h3>";
	echo "<b>Anda belum login, silahkan <a href='?open=Login' alt='Login'>login </a> sebagai Guru untuk mengakses sitem ini ";	
}
?>