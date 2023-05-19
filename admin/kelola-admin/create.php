<?php
require '../../config.php';
require '../../functions.php';

guest_move_to_login();

if (isset($_POST['submit'])) {
    $ausername = mysqli_escape_string($conn, $_POST['ausername']);
    $apassword = mysqli_escape_string($conn, $_POST['apassword']);
    $anama = mysqli_escape_string($conn, $_POST['anama']);
    $ajabatan = mysqli_escape_string($conn, $_POST['ajabatan']);

    $q = mysqli_query($conn, "INSERT INTO tb_admin VALUES (null, '$ausername', '$apassword', '$anama', '$ajabatan')");

    set_flash('success', 'Berhasil membuat data admin!');

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

    <title>SB Admin 2 - Dashboard</title>

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
                            <label for="ausername" class="form-label">Username</label>
                            <input name="ausername" class="form-control" id="ausername" />
                        </div>
                        <div class="mb-3">
                            <label for="apassword" class="form-label">Password</label>
                            <input name="apassword" class="form-control" type="password" id="apassword" />
                        </div>
                        <div class="mb-3">
                            <label for="anama" class="form-label">Nama Admin</label>
                            <input name="anama" class="form-control" id="anama" />
                        </div>
                        <div class="mb-3">
                            <label for="ajabatan" class="form-label">Jabatan</label>
                            <input name="ajabatan" class="form-control" id="ajabatan" />
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