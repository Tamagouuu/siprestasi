<?php
include '../../config.php';
include '../../functions.php';
guest_move_to_login();

$data = query('SELECT * FROM tb_kelas INNER JOIN tb_tapel ON tb_kelas.tid = tb_tapel.tid');

// dd($data);

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

    <style>

    </style>


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
                        <h1 class="h3 mb-0 text-gray-800 font-weight-bold">Kelas</h1>
                    </div>
                    <a href="<?= BASE_URL ?>/admin/kelas/create.php" class="btn btn-success btn-icon-split mb-4">
                        <span class="icon text-white-50">
                            <i class="fas fa-plus"></i>
                        </span>
                        <span class="text">Tambah Data</span>
                    </a>
                    <!-- Content Row -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Data Kelas</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Nama Kelas</th>
                                            <th>Tingkat</th>
                                            <th>Tahun Ajaran</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th></th>
                                            <th></th>
                                            <th>Tahun Ajaran</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        <?php foreach ($data as $d) : ?>
                                            <tr>
                                                <td><?= $d['knama'] ?></td>
                                                <td><?= $d['ktingkat'] ?></td>
                                                <td><?= $d['ttapel'] ?></td>
                                                <td>
                                                    <a href="<?= BASE_URL ?>/admin/kelas/edit.php?kid=<?= $d['kid'] ?>" class=" btn btn-warning btn-circle btn-sm my-1">
                                                        <i class="fas fa-pencil-alt"></i>
                                                    </a>
                                                    <a onclick="return confirm('Yakin ingin menghapus?')" href="<?= BASE_URL ?>/admin/kelas/delete.php?kid=<?= $d['kid'] ?>" class=" btn btn-danger btn-circle btn-sm my-1">
                                                        <i class="fas fa-trash"></i>
                                                    </a>
                                                    <a href="<?= BASE_URL ?>/admin/kelas/tambah-peserta-kelas.php?kid=<?= $d['kid'] ?>" class=" btn btn-primary btn-circle btn-sm my-1">
                                                        <i class="fas fa-plus"></i>
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

    <script src="https://cdn.datatables.net/buttons/2.3.6/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.print.min.js"></script>

    <!-- Page level custom scripts -->
    <script>
        // Call the dataTables jQuery plugin
        $(document).ready(function() {
            $("#dataTable").DataTable({
                initComplete: function() {
                    this.api()
                        .columns([2, 3])
                        .every(function() {
                            var column = this;
                            var select = $('<select class="form-control"><option value="">--- Filter Data ---</option></select>')
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
                            className: "btn btn-primary btn-rounded btn-sm mb-md-4 mb-2"
                        },
                        {
                            extend: "csv",
                            className: "btn btn-primary btn-rounded btn-sm mb-md-4 mb-2"
                        },
                        {
                            extend: "pdf",
                            className: "btn btn-primary btn-rounded btn-sm mb-md-4 mb-2",
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
                            className: "btn btn-primary btn-rounded btn-sm mb-md-4 mb-2"
                        },
                        {
                            extend: "print",
                            className: "btn btn-primary btn-rounded btn-sm mb-md-4 mb-2"
                        },
                    ],
                },
            });
        });
    </script>
</body>

</html>