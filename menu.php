<?php
if(isset($_SESSION['SES_SISWA'])){
# JIKA SUDAH LOGIN, menu di bawah yang dijalankan
?>	

<ul>
	<li><a href="?open" target="_self">Home</a></li>
	<li><a href="?open=Profil-Siswa" target="_self">Profil Siswa</a></li>
	<li><a href="?open=Jadwal-Tampil" target="_self">Jadwal Belajar</a></li>
	<li><a href="?open=Materi-Tampil" target="_self">Materi Belajar</a></li>
	<li><a href="?open=Tugas-Tampil" target="_self">Tugas Belajar  </a></li>
	<li> <a href="?open=Logout" target="_self">Logout</a> </li>
</ul>

<?php
}
else {
# JIKA BELUM LOGIN (Tidak ada Session yang ditemukan)
?>
<ul>
	<li><a href="?open" target="_self">Home</a> </li>	
	<li><a href="?open=Profil-Sekolah" target="_self">Profil Sekolah</a> </li>	
	<li><a href="?open=Login" target="_self">Login Siswa</a> </li>	
	<li><a href="guru/?open=Login" target="_self">Login Guru</a> </li>	
	<li><a href="admin/?open=Login" target="_self">Login Admin</a> </li>	
</ul>
<?php } ?>
