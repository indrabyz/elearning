<?php
if(isset($_SESSION['SES_LOGIN'])) {
	echo "<h3>Selamat datang di Aplikasi E-Learning SMP </h3>";
	echo "<b> Anda login sebagai Admin";
	exit;
}
else {
	echo "<h3>Selamat datang di Aplikasi E-Learning SMP </h3>";
	echo "<b>Anda belum login, silahkan <a href='?open=Login' alt='Login'>login </a> sebagai Administrator untuk mengakses sitem ini ";	
}
?>