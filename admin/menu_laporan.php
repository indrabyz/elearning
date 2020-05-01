<?php
if( isset($_SESSION['SES_LOGIN'])){
# JIKA SUDAH LOGIN, menu di bawah yang dijalankan
?>
<ul>
  	<li><a href="?open=Laporan-Pelajaran" target="_blank">Laporan Data Pelajaran</a></li>
	<li><a href="?open=Laporan-Kelas" target="_blank">Laporan Data Kelas</a> </li>
	<li><a href="?open=Laporan-User" target="_blank">Laporan Data User</a></li>
	<li><a href="?open=Laporan-Guru" target="_blank">Laporan Data Guru</a></li>
	<li><a href="?open=Laporan-Siswa" target="_blank">Laporan Data Siswa</a></li>
	<li><a href="?open=Laporan-Materi" target="_blank">Laporan Data Materi Belajar</a></li>
	<li><a href="?open=Laporan-Tugas" target="_blank">Laporan Data Tugas Belajar  </a></li>
	<li><a href="?open=Laporan-Mengajar" target="_blank">Laporan Data Mengajar</a></li>
</ul>
<?php
}
?>
