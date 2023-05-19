<?php
require '../../config.php';
require '../../functions.php';

guest_move_to_login();

// $lomba = query("SELECT * FROM tb_lomba");
$prestasi = query("SELECT * FROM `tb_prestasi` JOIN tb_lomba ON tb_lomba.lid = tb_prestasi.lid WHERE pid = {$_GET['pid']}")[0];

$guru = query("SELECT * FROM `tb_guru`");


$prestasi_guru_tersedia = query("SELECT * FROM `tb_ref_prestasi_guru` JOIN tb_guru ON tb_guru.gid = tb_ref_prestasi_guru.gid WHERE tb_ref_prestasi_guru.pid = {$_GET['pid']}");

$idGuruBerprestasi = [];

foreach ($prestasi_guru_tersedia as $g) {
    $idGuruBerprestasi[] = $g['gid'];
}

foreach ($guru as $key => $g) {
    if (in_array($g['gid'], $idGuruBerprestasi)) {
        unset($guru[$key]);
    }
}

if (isset($_POST['submit'])) {

    $id_prestasi = $_POST['pid'];
    $id_guru = $_POST['gid'];
    mysqli_query($conn, "INSERT INTO tb_ref_prestasi_guru VALUES ('$id_prestasi', '$id_guru')");


    set_flash('success', 'Berhasil membuat data prestasi!');

    header("Refresh:0");
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
    <link href="../../vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

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

                    <h4 class="font-weight-bold">Prestasi</h4>
                    <?= flash() ?>

                    <form method="post" class="card p-3" id="form-prestasi">
                        <div class="mb-3">
                            <label for="lid" class="form-label">Lomba</label>
                            <select name="pid" id="pid" class="form-control" readonly>
                                <option value="<?= $prestasi['pid'] ?>"><?= $prestasi['lnama'] ?></option>
                            </select>
                        </div>
                        <div class="mb-3" id="input-wrapper">
                            <label for="gid" class="form-label">Guru</label>
                            <select id="gid" class="form-control" name="gid">
                                <?php foreach ($guru as $option) : ?>
                                    <option value="<?= $option['gid'] ?>"><?= $option['gnama'] ?></option>
                                <?php endforeach ?>
                            </select>
                        </div>
                        <div>
                            <button class="btn btn-success" name="submit">Simpan Data</button>
                        </div>
                    </form>
                    <div class="card shadow mt-3">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Data Guru Berprestasi</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered display" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Nama Guru</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>ID</th>
                                            <th>Nama Guru</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        <?php foreach ($prestasi_guru_tersedia as $d) : ?>
                                            <tr>
                                                <td><?= $d['gid'] ?></td>
                                                <td><?= $d['gnama'] ?></td>
                                                <td>
                                                    <a onclick="return confirm('Yakin ingin menghapus?')" href="<?= BASE_URL ?>/admin/prestasi/delete-prestasi-guru.php?gid=<?= $d['gid'] ?>&pid=<?= $_GET['pid'] ?>" class=" btn btn-danger btn-circle btn-sm my-1">
                                                        <i class="fas fa-trash"></i>
                                                    </a>

                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
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
    <script src="../../vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="../../vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script>
        $(document).ready(function() {
            $("table.display").DataTable();

        });
    </script>
</body>

</html>