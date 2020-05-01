<?php
# KONTROL MENU PROGRAM
if(isset($_GET['open'])) {
	// Jika mendapatkan variabel URL ?open
	switch($_GET['open']){	

		case '' :
			if(!file_exists ("info.php")) die ("File tidak ada !"); 
			include "info.php";	break;
			
		case 'Halaman-Utama' :
			if(!file_exists ("info.php")) die ("File tidak ada !"); 
			include "info.php";	break;
		
		# KONTROL PROGRAM LOGIN
		case 'Login' :
			if(!file_exists ("login.php")) die ("File tidak ada !"); 
			include "login.php"; break;
			
		case 'Login-Validasi' :
			if(!file_exists ("login_validasi.php")) die ("File tidak ada !"); 
			include "login_validasi.php"; break;
			
		case 'Logout' :
			if(!file_exists ("logout.php")) die ("File tidak ada !"); 
			include "logout.php"; break;		
			
		case 'Password-Ubah' :
			if(!file_exists ("password_ubah.php")) die ("File tidak ada !"); 
			include "password_ubah.php"; break;		
		
		# REPORT INFORMASI 
		case 'Profil-Sekolah' :
				if(!file_exists ("profil_sekolah.html")) die ("File tidak ada !"); 
				include "profil_sekolah.html"; break;
		case 'Profil-Siswa' :
				if(!file_exists ("profil_siswa.php")) die ("File tidak ada !"); 
				include "profil_siswa.php"; break;
				
		case 'Jadwal-Tampil' :
				if(!file_exists ("jadwal_tampil.php")) die ("File tidak ada !"); 
				include "jadwal_tampil.php"; break;
				
		case 'Materi-Tampil' :
				if(!file_exists ("materi_tampil.php")) die ("File tidak ada !"); 
				include "materi_tampil.php"; break;
				
		case 'Tugas-Tampil' :
				if(!file_exists ("tugas_tampil.php")) die ("File tidak ada !"); 
				include "tugas_tampil.php"; break;
		default:
			if(!file_exists ("info.php")) die ("File tidak ada !"); 
			include "info.php";	 break;
	}
}
else {
	// Jika tidak mendapatkan variabel URL : ?open
	if(!file_exists ("info.php")) die ("File tidak ada !"); 
	include "info.php";	
}
?>