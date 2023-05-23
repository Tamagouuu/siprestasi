<?php
require '../../config.php';
require '../../functions.php';

checkParamsExist(['tb_admin' => 'aid']);


$idAdmin = mysqli_escape_string($conn, $_GET['aid']) ?? null;

if ($idAdmin == null) {
    return redirect('admin/kelola-admin/index.php');
}

mysqli_query($conn, "DELETE FROM tb_admin  WHERE aid = '$idAdmin'");

set_flash('success', 'Berhasil menghapus data admin !');
header('location: index.php');
die;
