<?php
if( isset($_SESSION['SES_LOGIN'])){
# JIKA SUDAH LOGIN, menu di bawah yang dijalankan
?>	

<ul>
	<li><a href="?open" target="_self">Home</a></li>
	<li><a href="?open=Pelajaran-Data" target="_self">Data Pelajaran</a></li>
	<li><a href="?open=Kelas-Data" target="_self">Data Kelas</a> </li>
	<li><a href="?open=User-Data" target="_self">Data User</a></li>
	<li><a href="?open=Guru-Data" target="_self">Data Guru</a></li>
	<li><a href="?open=Siswa-Data" target="_self">Data Siswa</a></li>
	<li><a href="?open=Materi-Data" target="_self">Data Materi Belajar</a></li>
	<li><a href="?open=Tugas-Data" target="_self">Data Tugas Belajar  </a></li>
	<li><a href="?open=Mengajar-Data" target="_self">Data Mengajar</a></li>
	<li><a href="?open=Laporan" target="_self">Laporan</a></li>
	<li><a href="?open=Logout" target="_self">Logout</a></li>
</ul>

<?php
}
else {
# JIKA BELUM LOGIN (Tidak ada Session yang ditemukan)
?>
<ul>
	<li><a href="?open=Login" target="_self">Login </a></li>	
</ul>
<?php
}
?>
