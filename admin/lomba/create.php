<?php
require '../../config.php';
require '../../functions.php';

guest_move_to_login();
$tingkat_option = get_tingkat_lomba_option();
$jenis_option =  get_jenis_lomba_option();
$tahun_pelajaran = query('SELECT * FROM tb_tapel');

if (isset($_POST['submit'])) {
    $jenis = mysqli_escape_string($conn, $_POST['ljenis']);
    $nama = mysqli_escape_string($conn, $_POST['lnama']);
    $tingkat = mysqli_escape_string($conn, $_POST['ltingkat']);
    $penyelenggara = mysqli_escape_string($conn, $_POST['lpenyelenggara']);
    $tahun = mysqli_escape_string($conn, $_POST['ltahun']);
    $tapel_id = mysqli_escape_string($conn, $_POST['tid']);

    $q = mysqli_query($conn, "INSERT INTO tb_lomba (`ljenis`,`lnama`,`ltingkat`,`lpenyelenggara`,`ltahun`,`tid`) 
        VALUES ('$jenis','$nama','$tingkat','$penyelenggara','$tahun','$tapel_id')
    ");

    set_flash('success','Berhasil membuat data lomba!');

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
                    <h4>Tambah Data</h4>
                    <form method="post" class="card p-3">
                        <div class="mb-3">
                            <label for="lnama" class="form-label">Nama Lomba</label>
                            <input name="lnama" class="form-control" id="lnama" />
                        </div>
                        <div class="mb-3">
                            <label for="ltahun" class="form-label">Tahun Lomba</label>
                            <input type="number" name="ltahun" class="form-control" id="ltahun" />
                        </div>
                        <div class="mb-3">
                            <label for="ltingkat" class="form-label">Tingkat Lomba</label>
                            <select name="ltingkat" id="ltingkat" class="form-control">
                                <?php foreach ($tingkat_option as $option) : ?>
                                    <option value="<?= $option ?>">
                                        <?= $option ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="ljenis" class="form-label">Jenis Lomba</label>
                            <select name="ljenis" id="ljenis" class="form-control">
                                <?php foreach ($jenis_option as $jenis_kode => $jenis_label) : ?>
                                    <option value="<?= $jenis_kode ?>">
                                        <?= $jenis_label ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="tid" class="form-label">Tahun Pelajaran</label>
                            <select name="tid" id="tid" class="form-control">
                                <?php foreach ($tahun_pelajaran as $option) : ?>
                                    <option value="<?= $option['tid'] ?>">
                                        <?= $option['ttapel'] ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="lpenyelenggara" class="form-label">Penyelenggara</label>
                            <input name="lpenyelenggara" class="form-control" id="lpenyelenggara" />
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