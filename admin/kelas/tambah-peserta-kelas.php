<?php
require '../../config.php';
require '../../functions.php';

guest_move_to_login();

checkParamsExist(['tb_kelas' => 'kid']);

// $lomba = query("SELECT * FROM tb_lomba");

$kelas = query("SELECT tb_kelas.*, tb_tapel.ttapel FROM `tb_kelas` JOIN tb_tapel ON tb_tapel.tid = tb_kelas.tid WHERE tb_kelas.kid = {$_GET['kid']}")[0];

$siswa_tersedia = query("SELECT tb_ref_kelas_siswa.kid, tb_siswa.*, tb_kelas.knama, tb_tapel.* FROM `tb_ref_kelas_siswa` JOIN tb_kelas ON tb_kelas.kid = tb_ref_kelas_siswa.kid JOIN tb_tapel ON tb_tapel.tid = tb_kelas.tid RIGHT JOIN tb_siswa ON tb_siswa.sid = tb_ref_kelas_siswa.sid WHERE  ttapel NOT IN ('{$kelas['ttapel']}') OR tb_ref_kelas_siswa.kid IS NULL");

$siswa_terdaftar = query("SELECT tb_ref_kelas_siswa.kid, tb_siswa.* FROM `tb_ref_kelas_siswa` JOIN tb_siswa ON tb_siswa.sid = tb_ref_kelas_siswa.sid WHERE tb_ref_kelas_siswa.kid = {$_GET['kid']}");


// select dulu siswa jika ia terdapat di tingkat kelas yang bersangkutan

$siswa_terdaftar_tingkat = query("SELECT * FROM v_siswa_kelas WHERE ktingkat = '{$kelas['ktingkat']}'");

// Yang ini berfungsi untuk mengecek apakah siswa tersebut sudah ada pada kelas tersebut sehingga tidak akan muncul dioption berdasarkan ada atau tidaknya dia dikelas tersebut

$nisSiswaBerprestasi = [];

foreach ($siswa_terdaftar as $p) {
    $nisSiswaBerprestasi[] = $p['sid'];
}

foreach ($siswa_tersedia as $key => $s) {
    if (in_array($s['sid'], $nisSiswaBerprestasi)) {
        unset($siswa_tersedia[$key]);
    }
}

// Yang ini berfungsi untuk mengecek apakah siswa tersebut sudah ada pada kelas tersebut sehingga tidak akan muncul dioption berdasarkan ada atau tidaknya dia di tingkat kelas tersebut

$nisSiswaBerprestasi = [];

foreach ($siswa_terdaftar_tingkat as $p) {
    $nisSiswaBerprestasi[] = $p['sid'];
}

foreach ($siswa_tersedia as $key => $s) {
    if (in_array($s['sid'], $nisSiswaBerprestasi)) {
        unset($siswa_tersedia[$key]);
    }
}


if (isset($_POST['submit'])) {

    $id_kelas = $_POST['kid'];
    $id_siswa = $_POST['sid'];
    mysqli_query($conn, "INSERT INTO tb_ref_kelas_siswa VALUES ('$id_kelas', '$id_siswa')");


    set_flash('success', 'Berhasil membuat data peserta kelas!');

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

    <title>SI Prestasi SMK Negeri 1 Denpasar</title>
    <link rel="icon" type="image/x-icon" href="<?= BASE_URL ?>/assets/favicon.ico" />

    <!-- Custom fonts for this template-->
    <link href="../../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="../../css/sb-admin-2.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../../css/select2.min.css">
    <link href="../../css/styles.css" rel="stylesheet">
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

                    <h4 class="font-weight-bold">Kelas</h4>
                    <?= flash() ?>

                    <form method="post" class="card p-3" id="form-prestasi">
                        <div class="mb-3">
                            <label for="lid" class="form-label">Kelas</label>
                            <select name="kid" id="kid" class="form-control" readonly>
                                <option value="<?= $kelas['kid'] ?>"><?= $kelas['knama'] ?></option>
                            </select>
                        </div>
                        <div class="mb-3" id="input-wrapper">
                            <label for="sid" class="form-label">Siswa</label>

                            <select class="siswa-select form-control select2 select2-hidden-accessible" name="sid" required>
                                <option></option>
                                <?php foreach ($siswa_tersedia as $option) : ?>
                                    <option value="<?= $option['sid'] ?>"><?= $option['snama'] ?></option>
                                <?php endforeach ?>
                            </select>

                        </div>
                        <div>
                            <button class="btn btn-success" name="submit">Simpan Data</button>
                        </div>
                    </form>
                    <div class="card shadow mt-3">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Data Peserta Kelas</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered display" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>NIS</th>
                                            <th>Nama Siswa</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>NIS</th>
                                            <th>Nama Siswa</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        <?php foreach ($siswa_terdaftar as $d) : ?>
                                            <tr>
                                                <td><?= $d['sid'] ?></td>
                                                <td><?= $d['snama'] ?></td>
                                                <td>
                                                    <a onclick="return confirm('Yakin ingin menghapus?')" href="<?= BASE_URL ?>/admin/kelas/delete-peserta-kelas.php?kid=<?= $_GET['kid'] ?>&sid=<?= $d['sid'] ?>" class=" btn btn-danger btn-circle btn-sm my-1">
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
    <script src="../../js/select2.min.js"></script>

    <!-- Page level plugins -->
    <script src="../../vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="../../vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script>
        $(document).ready(function() {
            $('.siswa-select').select2({
                // theme: "bootstrap",
                width: "100%",
                placeholder: "Cari nama siswa"
            });

            $("table.display").DataTable();

        });
    </script>
</body>

</html>