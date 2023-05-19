<?php
require '../../config.php';
require '../../functions.php';


$idSiswa = mysqli_escape_string($conn, $_GET['sid']) ?? null;
$idKelas = mysqli_escape_string($conn, $_GET['kid']) ?? null;

if ($idSiswa == null || $idKelas == null) {
    return redirect('admin/kelas/index.php');
}

mysqli_query($conn, "DELETE FROM tb_ref_kelas_siswa WHERE kid = '$idKelas' AND sid = '$idSiswa'");


set_flash('success', 'Berhasil menghapus data peserta kelas!');
header('Location: ' . $_SERVER['HTTP_REFERER']);
die;
