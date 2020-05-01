<?php
if(isset($_SESSION['SES_GURU'])){
# JIKA SUDAH LOGIN, menu di bawah yang dijalankan
?>	

<ul>
	<li><a href="?open" target="_self">Home</a></li>
	<li><a href="?open=Profil-Guru" target="_self">Profil Guru</a></li>
	<li><a href="?open=Jadwal-Tampil" target="_self">Jadwal Mengajar</a></li>
	<li><a href="?open=Siswa-Tampil" target="_self">Siswa Kelas</a></li>
	<li><a href="?open=Materi-Data" target="_self">Data Materi Belajar</a></li>
	<li><a href="?open=Tugas-Data" target="_self">Data Tugas Belajar  </a></li>
	<li> <a href="?open=Logout" target="_self">Logout</a> </li>
</ul>

<?php
}
else {
# JIKA BELUM LOGIN (Tidak ada Session yang ditemukan)
?>
<ul>
	<li><a href="?open=Login" target="_self">Login</a> </li>	
</ul>
<?php } ?>
