<?php
require '../../config.php';
require '../../functions.php';

checkParamsExist(['tb_tapel' => 'tid']);

$idTapel = mysqli_escape_string($conn, $_GET['tid']) ?? null;

if ($idTapel == null) {
    return redirect('admin/tahun_pelajaran/index.php');
}

mysqli_query($conn, "DELETE FROM tb_tapel WHERE tid = '$idTapel'");

set_flash('success', 'Berhasil menghapus data tahun pelajaran!');
header('location: index.php');
die;
