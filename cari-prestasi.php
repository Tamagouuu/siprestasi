<?php
include 'config.php';
include 'functions.php';

$siswa = query("SELECT DISTINCT tb_siswa.snama, tb_siswa.sid  FROM `tb_ref_prestasi_siswa` JOIN tb_siswa ON tb_siswa.sid = tb_ref_prestasi_siswa.sid");

$guru = query("SELECT DISTINCT tb_guru.gnama, tb_guru.gid FROM `tb_ref_prestasi_guru` JOIN tb_guru ON tb_guru.gid = tb_ref_prestasi_guru.gid");

// dd($_GET);
$dataPrestasi = null;

if (count($_GET) > 1) {
    backToPrevPage();
}

if (!empty($_GET)) {
    if (isset($_GET['sid'])) {
        checkParamsExist(['tb_ref_prestasi_siswa' => 'sid']);
        $dataPrestasi = query("SELECT tb_prestasi.pid, tb_prestasi.pperingkat, tb_prestasi.pdokumen, tb_siswa.*, tb_lomba.* FROM `tb_ref_prestasi_siswa` JOIN tb_prestasi ON tb_prestasi.pid = tb_ref_prestasi_siswa.pid JOIN tb_siswa ON tb_siswa.sid = tb_ref_prestasi_siswa.sid JOIN tb_lomba ON tb_lomba.lid = tb_prestasi.lid WHERE tb_ref_prestasi_siswa.sid = '{$_GET['sid']}'");
    } elseif (isset($_GET['gid'])) {
        checkParamsExist(['tb_ref_prestasi_guru' => 'gid']);
        $dataPrestasi = query("SELECT tb_lomba.*, tb_prestasi.pid, tb_prestasi.pperingkat, tb_prestasi.pdokumen, tb_guru.gnama, tb_guru.gid FROM `tb_lomba` JOIN tb_prestasi ON tb_lomba.lid = tb_prestasi.lid JOIN tb_ref_prestasi_guru ON tb_ref_prestasi_guru.pid = tb_prestasi.pid JOIN tb_guru ON tb_ref_prestasi_guru.gid = tb_guru.gid  WHERE ljenis = 1 AND tb_guru.gid = '{$_GET['gid']}'");
    } else {
        backToPrevPage();
    }
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
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <!-- Custom styles for this template-->
    <link rel="stylesheet" href="css/select2.min.css">
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
                        <div class="container text-white ">
                            <h1 class="display-5 font-weight-bold nama-lomba text-center"> <i class="fas fa-search"></i> Cari Prestasi</h1>
                            <div class="row justify-content-center">
                                <div class="col-lg-5 col-md-6 mt-2">
                                    <select class="prestasi-search form-control select2 select2-hidden-accessible" name="prestasi">
                                        <option></option>
                                        <optgroup label="Siswa">
                                            <?php foreach ($siswa as $s) : ?>
                                                <option title="siswa" value="<?= $s['sid'] ?>" <?php if (isset($_GET['sid'])) : ?><?= $_GET['sid'] == $s['sid'] ? 'selected' : '' ?> <?php endif ?>><?= $s['snama'] ?></option>
                                            <?php endforeach ?>
                                        </optgroup>
                                        <optgroup label="Guru">
                                            <?php foreach ($guru as $g) : ?>
                                                <option title="guru" value="<?= $g['gid'] ?>" <?php if (isset($_GET['gid'])) : ?><?= $_GET['gid'] == $g['gid'] ? 'selected' : '' ?> <?php endif ?>><?= $g['gnama'] ?></option>
                                            <?php endforeach ?>
                                        </optgroup>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Project Card Example -->
                    <?php if (isset($_GET['sid'])) : ?>
                        <div class="alert alert-primary mb-4" role="alert">
                            Berikut merupakan prestasi dari <span class="font-weight-bold"><?= $dataPrestasi[0]['snama'] ?></span>
                        </div>
                        <div class="card mb-4">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary">Data Prestasi Siswa</h6>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered display" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>Nama Lomba</th>
                                                <th>Tingkat</th>
                                                <th>Penyelenggara</th>
                                                <th>Peringkat</th>
                                                <th>Tahun</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                <th>Nama Lomba</th>
                                                <th>Tingkat</th>
                                                <th>Penyelenggara</th>
                                                <th>Peringkat</th>
                                                <th>Tahun</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </tfoot>
                                        <tbody>
                                            <?php foreach ($dataPrestasi as $d) : ?>
                                                <tr>
                                                    <td><?= $d['lnama'] ?></td>
                                                    <td><?= ucfirst($d['ltingkat']) ?></td>
                                                    <td><?= $d['lpenyelenggara'] ?></td>
                                                    <td><?= $d['pperingkat'] ?></td>
                                                    <td><?= $d['ltahun'] ?></td>
                                                    <td class="text-center">
                                                        <a href="<?= BASE_URL ?>/detail-prestasi.php?pid=<?= $d['pid'] ?>" class=" btn btn-primary btn-sm my-1">
                                                            Detail
                                                        </a>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    <?php elseif (isset($_GET['gid'])) : ?>
                        <div class="alert alert-primary mb-4" role="alert">
                            Berikut merupakan prestasi dari <span class="font-weight-bold"><?= $dataPrestasi[0]['gnama'] ?></span>
                        </div>
                        <div class="card  mb-4">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary">Data Prestasi Guru</h6>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered display" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>Nama Lomba</th>
                                                <th>Tingkat</th>
                                                <th>Penyelenggara</th>
                                                <th>Peringkat</th>
                                                <th>Tahun</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                <th>Nama Lomba</th>
                                                <th>Tingkat</th>
                                                <th>Penyelenggara</th>
                                                <th>Peringkat</th>
                                                <th>Tahun</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </tfoot>
                                        <tbody>
                                            <?php foreach ($dataPrestasi as $d) : ?>
                                                <tr>
                                                    <td><?= $d['lnama'] ?></td>
                                                    <td><?= ucfirst($d['ltingkat']) ?></td>
                                                    <td><?= $d['lpenyelenggara'] ?></td>
                                                    <td><?= $d['pperingkat'] ?></td>
                                                    <td><?= $d['ltahun'] ?></td>
                                                    <td class="text-center">
                                                        <a href="<?= BASE_URL ?>/detail-prestasi.php?pid=<?= $d['pid'] ?>" class=" btn btn-primary btn-sm my-1">
                                                            Detail
                                                        </a>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    <?php endif ?>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->

            <footer class="sticky-footer bg-white <?= (isset($_GET['gid']) || isset($_GET['sid']) ? '' : 'footer-search') ?>">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; SI Prestasi 2023</span>
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
    <script src="js/select2.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.6/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.print.min.js"></script>


    <script>
        $(document).ready(function() {
            $('.prestasi-search').select2({
                // theme: "bootstrap",
                width: "100%",
                placeholder: "Cari nama guru / siswa"
            });

            $('.prestasi-search').on('select2:select', function(e) {
                // Do something
                if (e.params.data.title == "guru") {
                    window.location.replace("<?= BASE_URL ?>/cari-prestasi.php?gid=" + e.params.data.id)
                } else {
                    window.location.replace("<?= BASE_URL ?>/cari-prestasi.php?sid=" + e.params.data.id)
                }
            });

            var table = $("table.display").DataTable({
                initComplete: function() {
                    this.api()
                        .columns([0, 1, 2, 3, 4])
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