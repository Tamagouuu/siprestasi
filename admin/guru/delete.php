<?php
require '../../config.php';
require '../../functions.php';

checkParamsExist(['tb_guru' => 'gid']);


$idGuru = mysqli_escape_string($conn, $_GET['gid']) ?? null;

if ($idGuru == null) {
    return redirect('admin/guru/index.php');
}

mysqli_query($conn, "DELETE FROM tb_guru WHERE gid = '$idGuru'");

set_flash('success', 'Berhasil menghapus data guru !');
header('location: index.php');
die;
