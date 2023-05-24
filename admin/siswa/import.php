<?php
require '../../config.php';
require '../../functions.php';

require "../../vendor/autoload.php";

use PhpOffice\PhpSpreadsheet\IOFactory;

guest_move_to_login();

if (isset($_POST['submit'])) {
    $err = "";
    $ekstensi = "";
    $success = "";

    $file_name = $_FILES['excel']['name'];
    $file_data = $_FILES['excel']['tmp_name'];

    if (empty($file_name)) {
        $err .= "Silahkan masukkan file yang ingin di upload. ";
    } else {
        $ekstensi = pathinfo($file_name)['extension'];
    }

    $ekstensi_allowed = ['xls', 'xlsx'];

    if (!in_array($ekstensi, $ekstensi_allowed)) {
        $err .= "Hanya menerima file tipe xls atau xlsx.";
    }

    if (empty($err)) {
        $reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReaderForFile($file_data);
        $spredsheet = $reader->load($file_data);
        $sheetData = $spredsheet->getActiveSheet()->toArray();

        $jumlahDataBerhasil = 0;
        $jumlahDataTelahTerdaftar = 0;
        for ($i = 1; $i < count($sheetData); $i++) {
            $nis = $sheetData[$i]['0'];
            $nama = $sheetData[$i]['1'];
            $gender = $sheetData[$i]['2'];

            $d = query("SELECT sid FROM tb_siswa WHERE sid = '$nis' LIMIT 1")[0] ?? null;

            if ($d == null) {
                mysqli_query($conn, "INSERT INTO tb_siswa VALUES ('$nis', '$nama', '$gender')");
                $jumlahDataBerhasil++;
            } else {
                $jumlahDataTelahTerdaftar++;
            }
        }

        if ($jumlahDataBerhasil == 0 && $err == "") {
            $err = "Data yang dimasukkan sudah terdaftar";
        }

        if ($jumlahDataBerhasil > 0 && $jumlahDataTelahTerdaftar > 0) {
            $success = "Data sejumlah $jumlahDataBerhasil berhasil ditambahkan dan $jumlahDataTelahTerdaftar data telah terdaftar";
        }

        if ($jumlahDataBerhasil > 0 && $jumlahDataTelahTerdaftar == 0) {
            $success = "Data sejumlah $jumlahDataBerhasil berhasil ditambahkan";
        }
    }

    if ($err) {
        set_flash('danger', $err);

        header('location: index.php');
        die;
    };

    if ($success) {
        set_flash('success', $success);

        header('location: index.php');
        die;
    };
}

?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SI Prestasi SMK Negeri 1 Denpasar</title>
    <link rel="icon" type="image/x-icon" href="<?= BASE_URL ?>/assets/favicon.ico" />

    <!-- Custom fonts for this template-->
    <link href="../../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="../../css/sb-admin-2.min.css" rel="stylesheet">


</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <?php require_once "../partial/sidebar.php" ?>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <?php require_once "../partial/topbar.php" ?>

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <h4 class="font-weight-bold">Import Data</h4>
                    <form method="post" class="card p-3" enctype="multipart/form-data">
                        <div class="input-group mb-3 mt-2">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="inputGroupFileAddon01">Upload Excel</span>
                            </div>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01" name="excel">
                                <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                            </div>
                        </div>
                        <div>
                            <button class="btn btn-success" name="submit">Import Data</button>
                        </div>
                    </form>
                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <?php require_once "../partial/footer.php" ?>

            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <?php require_once "../partial/logout-modal.php" ?>

    <!-- Bootstrap core JavaScript-->
    <script src="../../vendor/jquery/jquery.min.js"></script>
    <script src="../../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="../../vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="../../js/sb-admin-2.min.js"></script>

    <script>
        $('#inputGroupFile01').on('change', function() {
            //get the file name
            var fileName = $(this).val().replace('C:\\fakepath\\', " ")
            //replace the "Choose a file" label
            $(this).next('.custom-file-label').html(fileName);
        })
    </script>

</body>

</html>