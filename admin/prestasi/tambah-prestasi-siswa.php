<?php
require '../../config.php';
require '../../functions.php';

guest_move_to_login();

checkParamsExist(['tb_prestasi' => 'pid']);


// $lomba = query("SELECT * FROM tb_lomba");
$prestasi = query("SELECT * FROM `tb_prestasi` JOIN tb_lomba ON tb_lomba.lid = tb_prestasi.lid WHERE pid = {$_GET['pid']}")[0];

$guru = query("SELECT * FROM `tb_guru`");
$siswa = query("SELECT * FROM `tb_siswa`");

$prestasi_siswa_tersedia = query("SELECT * FROM `tb_ref_prestasi_siswa` JOIN tb_siswa ON tb_siswa.sid = tb_ref_prestasi_siswa.sid WHERE tb_ref_prestasi_siswa.pid = {$_GET['pid']}");

$prestasi_guru_tersedia = query("SELECT * FROM `tb_ref_prestasi_pemb` JOIN tb_guru ON tb_guru.gid = tb_ref_prestasi_pemb.gid WHERE tb_ref_prestasi_pemb.pid = {$_GET['pid']}");

$nisSiswaBerprestasi = [];

foreach ($prestasi_siswa_tersedia as $p) {
    $nisSiswaBerprestasi[] = $p['sid'];
}

foreach ($siswa as $key => $s) {
    if (in_array($s['sid'], $nisSiswaBerprestasi)) {
        unset($siswa[$key]);
    }
}

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
    if (array_key_exists('gid', $_POST)) {
        $id_prestasi = $_POST['pid'];
        $id_guru = $_POST['gid'];
        mysqli_query($conn, "INSERT INTO tb_ref_prestasi_pemb VALUES ('$id_prestasi', '$id_guru')");
    } else {
        $id_prestasi = $_POST['pid'];
        $id_siswa = $_POST['sid'];
        mysqli_query($conn, "INSERT INTO tb_ref_prestasi_siswa VALUES ('$id_prestasi', '$id_siswa')");
    }

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

    <title>SI Prestasi SMK Negeri 1 Denpasar</title>
    <link rel="icon" type="image/x-icon" href="<?= BASE_URL ?>/assets/favicon.ico" />


    <!-- Custom fonts for this template-->
    <link href="../../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="../../css/sb-admin-2.min.css" rel="stylesheet">
    <link href="../../vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../../css/select2.min.css">
    <link href="../../css/styles.css" rel="stylesheet">

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
                    <div>
                        <input type="radio" id="siswa" value="siswa" name="showInput" checked>
                        <label for="siswa">Siswa</label>
                        <input type="radio" id="guru" value="guru" name="showInput">
                        <label for="guru">Pembimbing</label>
                    </div>

                    <form method="post" class="card p-3" id="form-prestasi">
                        <div class="mb-3">
                            <label for="lid" class="form-label">Lomba</label>
                            <select name="pid" id="pid" class="form-control" readonly>
                                <option value="<?= $prestasi['pid'] ?>"><?= $prestasi['lnama'] ?></option>
                            </select>
                        </div>
                        <div class="mb-3" id="input-wrapper">
                            <label for="sid" class="form-label">Siswa</label>
                            <select class="siswa-select form-control select2 select2-hidden-accessible" name="sid" required>
                                <option></option>
                                <?php foreach ($siswa as $option) : ?>
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
                            <h6 class="m-0 font-weight-bold text-primary">Data Siswa Berprestasi</h6>
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
                                        <?php foreach ($prestasi_siswa_tersedia as $d) : ?>
                                            <tr>
                                                <td><?= $d['sid'] ?></td>
                                                <td><?= $d['snama'] ?></td>
                                                <td>
                                                    <a onclick="return confirm('Yakin ingin menghapus?')" href="<?= BASE_URL ?>/admin/prestasi/delete-prestasi-siswa.php?sid=<?= $d['sid'] ?>&pid=<?= $_GET['pid'] ?>" class=" btn btn-danger btn-circle btn-sm my-1">
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
                    <div class="card shadow mt-3">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Data Pembimbing Siswa Berprestasi</h6>
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
                                                    <a onclick="return confirm('Yakin ingin menghapus?')" href="<?= BASE_URL ?>/admin/prestasi/delete-prestasi-siswa.php?gid=<?= $d['gid'] ?>&pid=<?= $_GET['pid'] ?>" class=" btn btn-danger btn-circle btn-sm my-1">
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
            $("table.display").DataTable();
            $('.siswa-select').select2({
                // theme: "bootstrap",
                width: "100%",
                placeholder: "Cari nama siswa"
            });

            $('input[name="showInput"]').on("change", (e) => {

                if (e.target.value == 'siswa') {
                    $("#input-wrapper").html(`  <label for="sid" class="form-label">Siswa</label>
                             <select class="siswa-select form-control select2 select2-hidden-accessible" name="sid" required>
                                <option></option>
                                <?php foreach ($siswa as $option) : ?>
                                    <option value="<?= $option['sid'] ?>"><?= $option['snama'] ?></option>
                                <?php endforeach ?>
                            </select>`)
                } else {
                    $("#input-wrapper").html(`<label for="gid" class="form-label">Guru</label>
                                
                          <select class="guru-select form-control select2 select2-hidden-accessible" name="gid" required>
                            <option></option>
                                <?php foreach ($guru as $option) : ?>
                                    <option value="<?= $option['gid'] ?>"><?= $option['gnama'] ?></option>
                                <?php endforeach ?>
                            </select>`)
                }

                $('.siswa-select').select2({
                    // theme: "bootstrap",
                    width: "100%",
                    placeholder: "Cari nama siswa"
                });

                $('.guru-select').select2({
                    // theme: "bootstrap",
                    width: "100%",
                    placeholder: "Cari nama guru"
                });
            })
        });
    </script>
</body>

</html>