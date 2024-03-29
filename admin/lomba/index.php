<?php
include '../../config.php';
include '../../functions.php';
guest_move_to_login();

$data = query('SELECT * FROM tb_lomba INNER JOIN tb_tapel ON tb_lomba.tid = tb_tapel.tid');


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
                    <?= flash(); ?>
                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800 font-weight-bold">Lomba</h1>
                    </div>
                    <a href="<?= BASE_URL ?>/admin/lomba/create.php" class="btn btn-success btn-icon-split mb-4">
                        <span class="icon text-white-50">
                            <i class="fas fa-plus"></i>
                        </span>
                        <span class="text">Tambah Data</span>
                    </a>
                    <!-- Content Row -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Data Lomba</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Jenis Lomba</th>
                                            <th>Nama Lomba</th>
                                            <th>Tingkat Lomba</th>
                                            <th>Penyelenggara Lomba</th>
                                            <th>Tahun</th>
                                            <th>Tahun Pelajaran</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Jenis Lomba</th>
                                            <th>Nama Lomba</th>
                                            <th>Tingkat Lomba</th>
                                            <th>Penyelenggara Lomba</th>
                                            <th>Tahun</th>
                                            <th>Tahun Pelajaran</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        <?php foreach ($data as $d) : ?>
                                            <tr>
                                                <td><?= ($d['ljenis'] == 1) ? 'Lomba Guru' : 'Lomba Siswa' ?></td>
                                                <td><?= $d['lnama'] ?></td>
                                                <td><?= ucfirst($d['ltingkat']) ?></td>
                                                <td><?= $d['lpenyelenggara'] ?></td>
                                                <td><?= $d['ltahun'] ?></td>
                                                <td><?= $d['ttapel'] ?></td>
                                                <td>
                                                    <a href="<?= BASE_URL ?>/admin/lomba/edit.php?lid=<?= $d['lid'] ?>" class=" btn btn-warning btn-circle btn-sm my-1">
                                                        <i class="fas fa-pencil-alt"></i>
                                                    </a>
                                                    <a onclick="return confirm('Yakin ingin menghapus?')" href="<?= BASE_URL ?>/admin/lomba/delete.php?lid=<?= $d['lid'] ?>" class=" btn btn-danger btn-circle btn-sm my-1">
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
    <script src="../../js/demo/datatables-demo.js"></script>

</body>

</html>