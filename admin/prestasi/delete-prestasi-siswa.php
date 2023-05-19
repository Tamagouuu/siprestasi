<?php
require '../../config.php';
require '../../functions.php';

if (array_key_exists('gid', $_GET)) {
    $idGuru = mysqli_escape_string($conn, $_GET['gid']) ?? null;
    $idPrestasi = mysqli_escape_string($conn, $_GET['pid']) ?? null;

    if ($idGuru == null || $idPrestasi == null) {
        return redirect('admin/prestasi/index.php');
    }

    mysqli_query($conn, "DELETE FROM tb_ref_prestasi_pemb WHERE gid = '$idGuru' AND pid = '$idPrestasi'");
} else {
    $idSiswa = mysqli_escape_string($conn, $_GET['sid']) ?? null;
    $idPrestasi = mysqli_escape_string($conn, $_GET['pid']) ?? null;

    if ($idSiswa == null || $idPrestasi == null) {
        return redirect('admin/prestasi/index.php');
    }

    mysqli_query($conn, "DELETE FROM tb_ref_prestasi_siswa WHERE sid = '$idSiswa' AND pid = '$idPrestasi'");
}

set_flash('success', 'Berhasil menghapus data prestasi!');
header('Location: ' . $_SERVER['HTTP_REFERER']);
die;
