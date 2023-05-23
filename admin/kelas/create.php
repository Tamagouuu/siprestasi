<?php
require '../../config.php';
require '../../functions.php';

guest_move_to_login();

$tapel = query("SELECT * FROM tb_tapel");


if (isset($_POST['submit'])) {
    $knama = mysqli_escape_string($conn, $_POST['knama']);
    $ktingkat = mysqli_escape_string($conn, $_POST['ktingkat']);
    $tid = mysqli_escape_string($conn, $_POST['tid']);

    $q = mysqli_query($conn, "INSERT INTO tb_kelas VALUES (null, '$knama', '$ktingkat', '$tid')");

    set_flash('success', 'Berhasil membuat data kelas!');

    header('location: index.php');
    die;
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

                    <h4 class="font-weight-bold">Tambah Data</h4>
                    <form method="post" class="card p-3">
                        <div class="mb-3">
                            <label for="knama" class="form-label">Nama Kelas</label>
                            <input name="knama" class="form-control" id="knama" required />
                        </div>
                        <div class="mb-3">
                            <label for="ktingkat" class="form-label">Tingkat</label>
                            <select name="ktingkat" id="ktingkat" class="form-control" required>
                                <option value="10">10</option>
                                <option value="11">11</option>
                                <option value="12">12</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="tid" class="form-label">Tahun Pelajaran</label>
                            <select name="tid" id="tid" class="form-control" required>
                                <?php foreach ($tapel as $option) : ?>
                                    <option value="<?= $option['tid'] ?>">
                                        <?= $option['ttapel'] ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div>
                            <button class="btn btn-success" name="submit">Simpan Data</button>
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

    <!-- Page level plugins -->
    <script src="../../vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="../../js/demo/chart-area-demo.js"></script>
    <script src="../../js/demo/chart-pie-demo.js"></script>

</body>

</html>