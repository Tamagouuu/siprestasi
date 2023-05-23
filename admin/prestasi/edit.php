<?php
require '../../config.php';
require '../../functions.php';

guest_move_to_login();


$idPrestasi = mysqli_escape_string($conn, $_GET['pid']);

$lomba = query("SELECT * FROM tb_lomba");

$prestasi = query("SELECT * FROM tb_prestasi WHERE pid = '$idPrestasi'")[0];



if (isset($_POST['submit'])) {

    if ($_FILES['pdokumen']['error'] === 4) {
        $pdokumen = $prestasi['pdokumen'];
    } else {
        $pdokumen = upload('pdokumen');

        unlink("../../document/piagam/" . $prestasi['pdokumen']);
        if (!$pdokumen) {
            set_flash('danger', 'Data gagal ditambahkan!');
            redirect('/admin/prestasi/index.php');
            return false;
        }
    }

    $lid = mysqli_escape_string($conn, $_POST['lid']);
    $pperingkat = mysqli_escape_string($conn, $_POST['pperingkat']);

    $q = mysqli_query($conn, "UPDATE tb_prestasi SET 
    lid = '$lid',
    pperingkat = '$pperingkat',
    pdokumen = '$pdokumen'
    WHERE pid = $idPrestasi
    ");

    set_flash('success', 'Berhasil mengupdate data lomba!');
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
                    <h4 class="font-weight-bold">Edit Prestasi</h4>
                    <form method="post" class="card p-3" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="lid" class="form-label">Lomba</label>
                            <select name="lid" id="lid" class="form-control" required>
                                <?php foreach ($lomba as $option) : ?>
                                    <option value="<?= $option['lid'] ?>" <?= $prestasi['lid'] == $option['lid'] ? 'selected' : '' ?>><?= $option['lnama'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="mb-4">
                            <label for="pperingkat" class="form-label">Peringkat</label>
                            <input name="pperingkat" class="form-control" id="pperingkat" value="<?= $prestasi['pperingkat'] ?>" />
                        </div>
                        <div class="input-group mb-3 mt-2">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="inputGroupFileAddon01">Upload Dokumen</span>
                            </div>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01" name="pdokumen">
                                <label class="custom-file-label" for="inputGroupFile01"><?= $prestasi['pdokumen'] ?></label>
                            </div>
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

    <script>
        $('#inputGroupFile01').on('change', function() {
            //get the file name
            var fileName = $(this).val().replace('C:\\fakepath\\', " ")
            //replace the "Choose a file" label
            $(this).next('.custom-file-label').html(fileName);
        })
    </script>

</body>

</html>