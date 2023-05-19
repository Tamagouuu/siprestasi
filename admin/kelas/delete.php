<?php
require '../../config.php';
require '../../functions.php';

$idKelas = mysqli_escape_string($conn, $_GET['kid']) ?? null;

if ($idKelas == null) {
    return redirect('admin/kelas/index.php');
}

mysqli_query($conn, "DELETE FROM tb_kelas WHERE kid = '$idKelas'");

set_flash('success', 'Berhasil menghapus data kelas!');
header('location: index.php');
die;
