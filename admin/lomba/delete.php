<?php
require '../../config.php';
require '../../functions.php';


checkParamsExist(['tb_lomba' => 'lid']);

$idLomba = mysqli_escape_string($conn, $_GET['lid']) ?? null;

if ($idLomba == null) {
    return redirect('admin/lomba/index.php');
}

mysqli_query($conn, "DELETE FROM tb_lomba WHERE lid = '$idLomba'");

set_flash('success', 'Berhasil menghapus data lomba!');
header('location: index.php');
die;
