<?php

require '../config.php';
require '../functions.php';

function getDataPrestasi()
{
    if (!isset($_GET['jenis_lomba'])) {
        echo json_encode(["message" => "Tolong isi parameter"]);
    }

    $data = query("SELECT ltingkat, COUNT(ltingkat) as jumlah_data FROM `tb_prestasi` JOIN tb_lomba ON tb_prestasi.lid = tb_lomba.lid WHERE tb_lomba.ljenis = {$_GET['jenis_lomba']} GROUP BY (ltingkat)");

    echo json_encode($data);
}

getDataPrestasi();
