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

		case 'Jadwal-Tampil' :
			if(!file_exists ("jadwal_tampil.php")) die ("File tidak ada !"); 
			include "jadwal_tampil.php";	 break;		
		
		# KONTROL MENU SISWA
		case 'Siswa-Tampil' :
			if(!file_exists ("siswa_tampil.php")) die ("File tidak ada !"); 
			include "siswa_tampil.php";	 break;		

		# KONTROL  DATA MATERI BELAJAR
		case 'Materi-Data' :
			if(!file_exists ("materi_data.php")) die ("File tidak ada !"); 
			include "materi_data.php";	 break;		
		case 'Materi-Add' :
			if(!file_exists ("materi_add.php")) die ("File tidak ada !"); 
			include "materi_add.php";	 break;		
		case 'Materi-Delete' :
			if(!file_exists ("materi_delete.php")) die ("File tidak ada !"); 
			include "materi_delete.php"; break;		
		case 'Materi-Edit' :
			if(!file_exists ("materi_edit.php")) die ("File tidak ada !"); 
			include "materi_edit.php"; break;	

		# KONTROL   MANAJEMEN DATA TUGAS
		case 'Tugas-Data' :
			if(!file_exists ("tugas_data.php")) die ("File tidak ada !"); 
			include "tugas_data.php";	 break;		
		case 'Tugas-Add' :
			if(!file_exists ("tugas_add.php")) die ("File tidak ada !"); 
			include "tugas_add.php";	 break;		
		case 'Tugas-Delete' :
			if(!file_exists ("tugas_delete.php")) die ("File tidak ada !"); 
			include "tugas_delete.php"; break;		
		case 'Tugas-Edit' :
			if(!file_exists ("tugas_edit.php")) die ("File tidak ada !"); 
			include "tugas_edit.php"; break;	

		
		# KONTROL MENU PROFIL GURU
		case 'Profil-Guru' :
			if(!file_exists ("profil_guru.php")) die ("File tidak ada !"); 
			include "profil_guru.php";	 break;		
			
		case 'Password-Ubah' :
			if(!file_exists ("password_ubah.php")) die ("File tidak ada !"); 
			include "password_ubah.php"; break;		
		
		# REPORT INFORMASI / LAPORAN DATA
		case 'Laporan' :
				if(!file_exists ("menu_laporan.php")) die ("File tidak ada !"); 
				include "menu_laporan.php"; break;

			# LAPORAN MASTER DATA
			case 'Laporan-Kelas' :
				if(!file_exists ("laporan_kelas.php")) die ("File tidak ada !"); 
				include "laporan_kelas.php"; break;

		default:
			if(!file_exists ("info.php")) die ("File tidak ada !"); 
			include "info.php";						
		break;
	}
}
else {
	// Jika tidak mendapatkan variabel URL : ?open
	if(!file_exists ("info.php")) die ("File tidak ada !"); 
	include "info.php";	
}
?>