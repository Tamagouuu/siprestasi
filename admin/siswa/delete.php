<?php
require '../../config.php';
require '../../functions.php';

$idSiswa = mysqli_escape_string($conn, $_GET['sid']) ?? null;

if ($idSiswa == null) {
    return redirect('admin/siswa/index.php');
}

mysqli_query($conn, "DELETE FROM tb_siswa WHERE sid = '$idSiswa'");

set_flash('success', 'Berhasil menghapus data siswa !');
header('location: index.php');
die;
