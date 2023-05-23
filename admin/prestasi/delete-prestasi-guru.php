<?php
require '../../config.php';
require '../../functions.php';

checkParamsExist(['tb_prestasi' => 'pid', 'tb_ref_prestasi_guru' => 'gid']);

$idGuru = mysqli_escape_string($conn, $_GET['gid']) ?? null;
$idPrestasi = mysqli_escape_string($conn, $_GET['pid']) ?? null;

if ($idGuru == null || $idPrestasi == null) {
    return redirect('admin/prestasi/index.php');
}

mysqli_query($conn, "DELETE FROM tb_ref_prestasi_guru WHERE gid = '$idGuru' AND pid = '$idPrestasi'");


set_flash('success', 'Berhasil menghapus data prestasi!');
header('Location: ' . $_SERVER['HTTP_REFERER']);
die;
