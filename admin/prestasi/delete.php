<?php
require '../../config.php';
require '../../functions.php';

$idPrestasi = mysqli_escape_string($conn, $_GET['pid']) ?? null;

if ($idPrestasi == null) {
    return redirect('admin/prestasi/index.php');
}

$pdf = query("SELECT pdokumen FROM tb_prestasi WHERE pid = '$idPrestasi'")[0];

unlink("../../document/piagam/" . $pdf['pdokumen']);


mysqli_query($conn, "DELETE FROM tb_prestasi WHERE pid = '$idPrestasi'");

set_flash('success', 'Berhasil menghapus data prestasi!');
header('location: index.php');
die;
