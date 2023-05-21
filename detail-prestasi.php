<?php
include 'config.php';
include 'functions.php';

$prestasiId = $_GET['pid'];

$dataPrestasi = query("SELECT tb_lomba.*, tb_prestasi.pid, tb_prestasi.pperingkat, tb_prestasi.pdokumen FROM `tb_lomba` JOIN tb_prestasi ON tb_lomba.lid = tb_prestasi.lid WHERE pid = $prestasiId")[0];

// dd($dataPrestasi);

$isPrestasiGuru = $dataPrestasi['ljenis'] == 1;

if ($isPrestasiGuru) {
    $dataGuru = query("SELECT tb_guru.*, tb_ref_prestasi_guru.pid FROM tb_ref_prestasi_guru JOIN tb_guru ON tb_guru.gid = tb_ref_prestasi_guru.gid WHERE tb_ref_prestasi_guru.pid = $prestasiId");
} else {
    $dataPrestasiSiswa = query("SELECT tb_siswa.*, tb_kelas.* FROM `tb_lomba` JOIN tb_prestasi ON tb_lomba.lid = tb_prestasi.lid JOIN tb_ref_prestasi_siswa ON tb_ref_prestasi_siswa.pid = tb_prestasi.pid JOIN tb_siswa ON tb_siswa.sid = tb_ref_prestasi_siswa.sid JOIN tb_ref_kelas_siswa ON tb_ref_prestasi_siswa.sid = tb_ref_kelas_siswa.sid JOIN tb_kelas ON tb_kelas.kid = tb_ref_kelas_siswa.kid WHERE tb_prestasi.pid = $prestasiId");

    $dataGuru = query("SELECT tb_guru.*, tb_ref_prestasi_pemb.pid FROM tb_ref_prestasi_pemb JOIN tb_guru ON tb_guru.gid = tb_ref_prestasi_pemb.gid WHERE tb_ref_prestasi_pemb.pid = $prestasiId");
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

    <title>JalanKuy | Home</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">


    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <link href="css/styles.css" rel="stylesheet">

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">


        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
                    <h1 class="h3 m-0 text-primary">SI <span class="font-weight-bold">Prestasi</span></h1>
                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav align-items-center ml-auto">

                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">

                            <a href="login.php" class="btn btn-primary rounded-pill">Login</a>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <div class="jumbotron jumbotron-fluid rounded-lg bg-gradient-primary">
                        <div class="container text-white text-center ">
                            <h1 class="display-5 font-weight-bold nama-lomba"><?= $dataPrestasi['lnama'] ?></span></h1>
                            <p style="font-size: 1.8rem;" class="lead mx-auto font-weight-bold my-0 p-0"><?= $dataPrestasi['pperingkat'] ?></p>
                            <ul class="list-unstyled">
                                <li><span class="font-weight-bold"> Penyelenggara : </span> <?= $dataPrestasi['lpenyelenggara'] ?></li>
                                <li><span class="font-weight-bold"> Tingkat : </span> <?= ucfirst($dataPrestasi['ltingkat']) ?></li>
                                <li><span class="font-weight-bold"> Tahun : </span> <?= $dataPrestasi['ltahun'] ?></li>
                            </ul>
                            <?php if ($dataPrestasi['pdokumen']) : ?>
                                <a href="<?= BASE_URL . "/document/piagam/" . $dataPrestasi['pdokumen'] ?>" target="_blank" class="btn btn-outline-light">
                                    <i class="fa fa-eye mr-3"></i>Lihat Sertifikat
                                </a>
                            <?php else : ?>
                                <button class="btn btn-outline-light disabled">
                                    <i class="fa fa-eye mr-3"></i>Lihat Sertifikat
                                </button>
                            <?php endif ?>
                        </div>
                    </div>


                    <!-- Project Card Example -->

                    <?php if (!$isPrestasiGuru) : ?>
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
                                                <th>Kelas</th>
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                <th>NIS</th>
                                                <th>Nama Siswa</th>
                                                <th>Kelas</th>
                                            </tr>
                                        </tfoot>
                                        <tbody>
                                            <?php foreach ($dataPrestasiSiswa as $d) : ?>
                                                <tr>
                                                    <td><?= $d['sid'] ?></td>
                                                    <td><?= $d['snama'] ?></td>
                                                    <td>
                                                        <?= $d['knama'] ?>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                    <div class="card shadow mt-3">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary"> <?= $isPrestasiGuru ? 'Data Guru Berprestasi' : 'Data Pembimbing Siswa' ?></h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered display" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Nama Guru</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>ID</th>
                                            <th>Nama Guru</th>
                                            <th>Status</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        <?php foreach ($dataGuru as $d) : ?>
                                            <tr>
                                                <td><?= $d['gid'] ?></td>
                                                <td><?= $d['gnama'] ?></td>
                                                <td><?= $d['gstatus'] == 1 ? "Guru" : 'Non Guru' ?></td>
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
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; JalanKuy 2023</span>
                    </div>
                </div>
            </footer><!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <script src="vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <script src="https://cdn.datatables.net/buttons/2.3.6/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.print.min.js"></script>


    <script>
        $(document).ready(function() {
            var table = $("table.display").DataTable({
                initComplete: function() {
                    this.api()
                        .columns()
                        .every(function() {
                            var column = this;
                            var select = $('<select class="form-control table-filter"><option value="">--- Filter Data ---</option></select>')
                                .appendTo($(column.footer()).empty())
                                .on('change', function() {
                                    var val = $.fn.dataTable.util.escapeRegex($(this).val());

                                    column.search(val ? '^' + val + '$' : '', true, false).draw();
                                });

                            column
                                .data()
                                .unique()
                                .sort()
                                .each(function(d, j) {
                                    select.append('<option value="' + d + '">' + d + '</option>');
                                });
                        });
                },
                dom: '<"row"<"col-md-12"<"row mx-0"<"col-md-6"B><"col-md-6"f> > ><"col-md-12"rt> <"col-md-12"<"row mx-0"<"col-sm-12 col-md-5"i><"col-sm-12 col-md-7"p>>> >',
                buttons: {
                    buttons: [{
                            extend: "copy",
                            className: "btn btn-primary  btn-sm  mb-1"
                        },
                        {
                            extend: "csv",
                            className: "btn btn-primary  btn-sm  mb-1"
                        },
                        {
                            extend: "pdf",
                            className: "btn btn-primary  btn-sm  mb-1",
                            exportOptions: {
                                columns: [0, 1, 2]
                            },
                            customize: function(doc) {
                                doc.content[1].table.widths =
                                    Array(doc.content[1].table.body[0].length + 1).join('*').split('');
                            }
                        },
                        {
                            extend: "excel",
                            className: "btn btn-primary  btn-sm  mb-1"
                        },
                        {
                            extend: "print",
                            className: "btn btn-primary  btn-sm mb-1"
                        },
                    ],
                },
            });

        });
    </script>

</body>

</html>