<?php
include 'config.php';
include 'functions.php';

$dataPrestasiSiswa = query('SELECT tb_lomba.*, tb_prestasi.pid, tb_prestasi.pperingkat, tb_prestasi.pdokumen FROM `tb_lomba` JOIN tb_prestasi ON tb_lomba.lid = tb_prestasi.lid WHERE ljenis = 2');

$dataPrestasiGuru = query('SELECT tb_lomba.*, tb_prestasi.pid, tb_prestasi.pperingkat, tb_prestasi.pdokumen FROM `tb_lomba` JOIN tb_prestasi ON tb_lomba.lid = tb_prestasi.lid WHERE ljenis = 1');


?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" />
  <title>SI Prestasi SMK Negeri 1 Denpasar</title>
  <link rel="icon" type="image/x-icon" href="assets/img/favicon.ico" />
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css" />
  <link rel="stylesheet" type="text/css" href="css/sb-admin-2.min.css" />
  <link rel="stylesheet" type="text/css" href="css/landing-page.css" />
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
  <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
</head>

<body>
  <div id="navHeadWrapper" class="navHeaderWrapper header-image">
    <!-- NavBar -->
    <!-- Brand -->
    <div class="">
      <nav class="navbar navbar-expand-lg bg-faded header-nav">
        <div class="container">
          <div class="col-xl-4 col-lg-3 col-6 mx-auto">
            <a class="navbar-brand" href="#">
              <h1 class="h3 m-0">SI <span class="font-weight-bold">Prestasi</span></h1>
            </a>
          </div>

          <div class="col-6 text-right d-lg-none d-block">
            <button class="navbar-toggler collapsed" type="button" data-toggle="collapse" data-target="#nav-content" aria-controls="nav-content" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon fa fa-bars"></span>
            </button>
          </div>

          <div class="col-xl-8 col-lg-9">
            <!-- Links -->
            <div class="collapse navbar-collapse justify-content-end" id="nav-content">
              <ul class="navbar-nav text-center mt-lg-0 mt-5">
                <li class="nav-item active">
                  <a class="nav-link js-scroll-trigger" href="#navHeadWrapper">Home</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link js-scroll-trigger" href="#prestasiWrapper">Prestasi</a>
                </li>
              </ul>
              <div class="button-inline justify-content-lg-start d-flex justify-content-center mt-lg-0 mt-3">
                <a class="btn ml-xl-4" href="<?= BASE_URL . "/login.php" ?>">Login</a>
              </div>
            </div>
          </div>
        </div>
      </nav>
    </div>
    <!-- /NavBar -->

    <!-- Header -->
    <div id="headerWrapper" class="container">
      <div class="row justify-content-center">
        <div class="col-lg-8 col-md-12 col-sm-12 col-12 align-self-center mb-lg-0 mb-5">
          <div class="site-header-inner mt-lg-0 mt-5 text-center">
            <h2>Sistem Informasi Prestasi SMK Negeri 1 Denpasar</h2>
            <a class="btn btn-primary mb-2 mx-1 js-scroll-trigger mt-5" href="#prestasiWrapper">List Prestasi</a>
          </div>
        </div>
      </div>
    </div>
    <!-- /Header -->
  </div>

  <!-- Why Choose Us -->
  <div class="container scroll-offset">
    <div id="prestasiWrapper" class="row">
      <div class="col-md-12 text-center mb-5">
        <h2 class="section-title mb-1">
          Prestasi <br />
          Siswa & Guru
        </h2>
      </div>

      <div class="col-md-12">
        <ul class="nav nav-pills mb-5 justify-content-center" id="pills-tab" role="tablist">
          <li class="col-xl-3 col-lg-3 col-md-6 col-12 nav-item mb-4 text-center">
            <a class="nav-link active" id="pills-siswa-tab" data-toggle="pill" href="#pills-siswa" role="tab" aria-controls="pills-siswa" aria-selected="true">
              <i class="fa fa-user-graduate"></i>
              <h6 class="mt-2 mb-3">Siswa</h6>
              <span class="arrow"></span>
            </a>
          </li>

          <li class="col-xl-3 col-lg-3 col-md-6 col-12 nav-item mb-md-0 mb-4 text-center">
            <a class="nav-link" id="pills-branding-tab" data-toggle="pill" href="#pills-guru" role="tab" aria-controls="pills-guru" aria-selected="false">
              <i class="fa fa-chalkboard-teacher"></i>
              <h6 class="mt-2 mb-3">Guru</h6>
              <span class="arrow"></span>
            </a>
          </li>
        </ul>
      </div>

      <div class="col-md-12">
        <div class="tab-content" id="pills-tabContent">
          <div class="tab-pane fade show active" id="pills-siswa" role="tabpanel" aria-labelledby="pills-siswa-tab">
            <div class="card  mb-4">
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
                        <th>Aksi</th>
                      </tr>
                    </thead>
                    <tfoot>
                      <tr>
                        <th>Nama Lomba</th>
                        <th>Tingkat</th>
                        <th>Penyelenggara</th>
                        <th>Peringkat</th>
                        <th>Aksi</th>
                      </tr>
                    </tfoot>
                    <tbody>
                      <?php foreach ($dataPrestasiSiswa as $d) : ?>
                        <tr>
                          <td><?= $d['lnama'] ?></td>
                          <td><?= ucfirst($d['ltingkat']) ?></td>
                          <td><?= $d['lpenyelenggara'] ?></td>
                          <td><?= $d['pperingkat'] ?></td>
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
          </div>

          <div class="tab-pane fade" id="pills-guru" role="tabpanel" aria-labelledby="pills-guru-tab">
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
                        <th>Aksi</th>
                      </tr>
                    </thead>
                    <tfoot>
                      <tr>
                        <th>Nama Lomba</th>
                        <th>Tingkat</th>
                        <th>Penyelenggara</th>
                        <th>Peringkat</th>
                        <th>Aksi</th>
                      </tr>
                    </tfoot>
                    <tbody>
                      <?php foreach ($dataPrestasiGuru as $d) : ?>
                        <tr>
                          <td><?= $d['lnama'] ?></td>
                          <td><?= ucfirst($d['ltingkat']) ?></td>
                          <td><?= $d['lpenyelenggara'] ?></td>
                          <td><?= $d['pperingkat'] ?></td>
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
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Welcome to our agency -->

  <!-- Mini Footer -->
  <div id="miniFooterWrapper" class="">
    <div class="container">
      <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12">
          <div class="position-relative">
            <div class="arrow text-center">
              <img alt="image-icon" src="assets/img/footer-arrow.svg" class="img-fluid" />
            </div>
          </div>
          <div class="row">
            <div class="col-lg-5 mx-auto col-lg-6 col-md-6 site-content-inner text-md-left text-center copyright align-self-center">
              <p class="mt-md-0 mt-4 mb-0">© 2023 SI Prestasi <a href="index.html">SKENSA</a>.</p>
            </div>
            <div class="col-xl-5 mx-auto col-lg-6 col-md-6 site-content-inner text-md-right text-center align-self-center">
              <p class="mb-0">Jl. Cokroaminoto No.84, Denpasar-Bali</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- /Mini Footer -->

  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin-2.min.js"></script>
  <script src="js/landing-page.js"></script>

  <!-- Page level plugins -->
  <script src="vendor/datatables/jquery.dataTables.min.js"></script>
  <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

  <script src="https://cdn.datatables.net/buttons/2.3.6/js/dataTables.buttons.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
  <script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.html5.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.print.min.js"></script>

  <script>
    // Call the dataTables jQuery plugin
    $(document).ready(function() {
      var table = $("table.display").DataTable({
        initComplete: function() {
          this.api()
            .columns([0, 1, 2, 3])
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