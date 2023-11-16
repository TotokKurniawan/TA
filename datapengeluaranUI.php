<?php
session_start();
require_once('koneksi.php');
?>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js" lang="">
<!--<![endif]-->

<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <title>Data Pengeluaran</title>
  <meta name="description" content="Aswaja Trans" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />

  <link rel="apple-touch-icon" href="assets/img/istockphoto-669053856-170667a.jpg" />
  <link rel="shortcut icon" href="assets/img/istockphoto-669053856-170667a.jpg" />

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/normalize.css@8.0.0/normalize.min.css" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/font-awesome@4.7.0/css/font-awesome.min.css" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/lykmapipo/themify-icons@0.1.2/css/themify-icons.css" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/pixeden-stroke-7-icon@1.2.3/pe-icon-7-stroke/dist/pe-icon-7-stroke.min.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/3.2.0/css/flag-icon.min.css" />
  <link rel="stylesheet" href="assets/css/cs-skin-elastic.css" />
  <link rel="stylesheet" href="assets/css/lib/datatable/dataTables.bootstrap.min.css" />
  <link rel="stylesheet" href="assets/css/style.css" />
  <link rel="stylesheet" href="sweetallert/sweetalert2.min.css">

  <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800" rel="stylesheet" type="text/css" />

  <!-- <script type="text/javascript" src="https://cdn.jsdelivr.net/html5shiv/3.7.3/html5shiv.min.js"></script> -->
</head>

<body>
  <!-- Left Panel -->

  <aside id="left-panel" class="left-panel">
    <nav class="navbar navbar-expand-sm navbar-default">
      <div id="main-menu" class="main-menu collapse navbar-collapse">
        <ul class="nav navbar-nav">
          <li class="active">
            <a href="admin.php"><i class="menu-icon fa fa-laptop"></i>Dashboard
            </a>
          </li>
          <li class="menu-title">Master</li>
          <!-- /.menu-title -->
          <li class="menu-item">
            <a href="datapelangganUI.php" aria-haspopup="true" aria-expanded="false">
              <i class="menu-icon fa fa-user"></i>Data Pelanggan</a>
          </li>

          <li class="menu-item">
            <a href="datamobilUI.php" aria-haspopup="true" aria-expanded="false">
              <i class="menu-icon fa fa-car"></i>Data Mobil
            </a>
          </li>

          <li class="menu-item">
            <a href="datapengeluaranUI.php" aria-haspopup="true" aria-expanded="false">
              <i class="menu-icon fa fa-th"></i>Data Pengeluaran</a>
          </li>

          <li class="menu-title">Transaksi</li>
          <!-- /.menu-title -->

          <li class="menu-item">
            <a href="sewaUI.php" aria-haspopup="true" aria-expanded="false">
              <i class="menu-icon fa fa-shopping-cart"></i>Sewa</a>
          </li>

          <li>
            <a href="datasewaUI.php">
              <i class="menu-icon ti-shopping-cart"></i>Data Sewa
            </a>
          </li>

          <li>
            <a href="LaporanUI.php">
              <i class="menu-icon ti-file"></i>Laporan
            </a>
          </li>

          <li class="menu-item-">
            <a href="maps.php" aria-haspopup="true" aria-expanded="false">
              <i class="menu-icon fa fa-map"></i>Maps</a>
          </li>
          <li class="menu-title">Log Out</li>
          <!-- /.menu-title -->

          <li class="menu-item">
            <a href="#" onclick="logoutConfirmation();">
              <i class="menu-icon fa fa-sign-out"></i>
              <span class="menu-text" style="color: red;">Logout</span>
            </a>
          </li>

          <script>
            function logoutConfirmation() {
              var confirmation = confirm("Apakah Anda yakin ingin logout?");

              if (confirmation) {
                // Jika pengguna mengklik "OK" dalam pop-up konfirmasi, maka arahkan ke halaman logout
                window.location.href = "index.php";
              } else {
                // Jika pengguna mengklik "Batal," tidak ada tindakan yang diambil
              }
            }
          </script>
        </ul>
      </div>
      <!-- /.navbar-collapse -->
    </nav>
  </aside> <!-- /#left-panel -->
  <!-- /#left-panel -->

  <!-- Left Panel -->

  <!-- Right Panel -->

  <div id="right-panel" class="right-panel">
    <!-- Header-->
    <header id="header" class="header">
      <div class="top-left">
        <div class="navbar-header">
          <a class="navbar-brand" style="color: black ; " href="admin.php">
            <h4><span>ASWAJA TRANS</span></h3>
          </a>
          <a class="navbar-brand hidden" href="./"><img src="assets/images/logo2.png" alt="Logo" /></a>
          <a id="menuToggle" class="menutoggle"><i class="fa fa-bars"></i></a>
        </div>
      </div>
      <div class="top-right">
        <div class="header-menu">
          <div class="header-left">

            <div class="user-area dropdown float-right">
              <a href="#" class="dropdown-toggle active" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <?php
                $query = "SELECT Foto, Nama FROM User WHERE Username = '" . $_SESSION['username'] . "'";
                $result = mysqli_query($conn, $query);

                if ($result) {
                  $row = mysqli_fetch_assoc($result);
                  $urlFoto = $row['Foto'];
                  $namaUser = $row['Nama'];

                  echo '<span class="mr-2" style="text-transform: uppercase; font-weight: bold;">' . $namaUser . '</span>'; // Display user's name in uppercase and bold

                  if (!is_null($urlFoto)) {
                    $urlFoto = str_replace($_SERVER['DOCUMENT_ROOT'], '', $urlFoto);
                    echo '<img alt="User Avatar" src="' . $urlFoto . '" class="user-avatar rounded-circle img-thumbnail img-fluid">';
                  } else {
                    echo '<img alt="User Avatar" src="assets/images/polije.png" class="user-avatar rounded-circle img-thumbnail img-fluid">';
                  }
                } else {
                  echo 'Error dalam menjalankan query: ' . mysqli_error($conn);
                }
                ?>
              </a>

              <div class="user-menu dropdown-menu">
                <a class="dropdown-item" href="profile.php"><i class="fa fa-user"></i> My Profile</a>
                <a class="dropdown-item" href="login.php"><i class="fa fa-power-off"></i> Logout</a>
              </div>
            </div>

          </div>
        </div>
    </header>
    <!-- /#header -->
    <!-- Header-->

    <div class="breadcrumbs">
      <div class="breadcrumbs-inner">
        <div class="row m-0">
          <div class="col-sm-4">
            <div class="page-header float-left">
              <div class="page-title">
                <h1>PENGELUARAN</h1>
              </div>
            </div>
          </div>
          <div class="col-sm-8">
            <div class="page-header float-right">
              <div class="page-title">
                <ol class="breadcrumb text-right">
                  <li><a href="admin.php">Dashboard</a></li>
                  <li><a href="datapengeluaranUI.php">Data Pengeluaran</a></li>
                </ol>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="content">
      <div class="animated fadeIn">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <strong class="card-title">Data Pengeluaran</strong>
              </div>
              <?php

              $sql = "SELECT * FROM pengeluaran ORDER BY id_pengeluaran ASC";
              $result = $conn->query($sql);
              ?>
              <div class="card-body">
                <button type="button" name="age" id="age" data-toggle="modal" data-target="#add_data_Pengeluaran" class="btn btn-success" onMouseOver="this.style.backgroundColor='#006064'" onMouseOut="this.style.backgroundColor='#4CAF50'">Tambah Pengeluaran</button>
                <br><br>
                <table id="bootstrap-data-table" class="table table-striped table-bordered">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Nopol</th>
                      <th>Tgl Pengeluaran</th>
                      <th>Nominal</th>
                      <th>Keterangan</th>
                      <th>
                        <center>Action</center>
                      </th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    if ($result->num_rows > 0) {
                      $no = 1;
                      while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row['id_pengeluaran'] . "</td>";
                        echo "<td>" . $row['Nopol'] . "</td>";
                        echo "<td>" . $row['Tgl_Pengeluaran'] . "</td>";
                        echo "<td>Rp " . number_format($row['Nominal'], 0, ',', '.') . "</td>";
                        echo "<td>" . $row['Keterangan'] . "</td>";
                        echo '<td>
              <center>
                <a type="button" name="edit" value="Edit" data-toggle="modal" data-target="#editModal' . $row['id_pengeluaran'] . '" title="Edit Data ini" class="btn btn-sm" style="background: darkslateblue; color: white;">
                  <i class="fa fa-edit"></i> Edit
                </a>
                <a href="hapus/hapuspengeluaran.php?id_pengeluaran=' . $row['id_pengeluaran'] . '&reqkarya=dell" title="Hapus Simpanan" class="btn btn-danger btn-sm alert_notif">
                  <span class="fa fa-trash-o"> Hapus</span>
                </a>
              </center>
            </td>';
                        echo "</tr>";
                        $no++;

                        // Menampilkan modal edit untuk setiap data pengeluaran
                        echo '<div id="editModal' . $row['id_pengeluaran'] . '" class="modal fade">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Edit Data Pengeluaran</h4>
                  </div>
                  <div class="modal-body">
                    <form action="edit/editpengeluaran.php" method="post" id="update' . $row['id_pengeluaran'] . '" enctype="multipart/form-data">
                    <label >Id Pengeluaran</label>  
                    <input type="text" required value="' . $row['id_pengeluaran'] . '" name="id_pengeluaran" id="id_pengeluaran' . $row['id_pengeluaran'] . '" class="form-control" readonly>
                    <br>
                    <label >Nopol</label>  
                    <input type="text" required value="' . $row['Nopol'] . '" name="id_pengeluaran" id="id_pengeluaran' . $row['id_pengeluaran'] . '" class="form-control" readonly>
                    <br>
                    <label>Tanggal Pengeluaran</label>
                    <input type="date" required name="tgl_pengeluaran" id="tgl_pengeluaran' . $row['id_pengeluaran'] . '" value="' . $row['Tgl_Pengeluaran'] . '" class="form-control" />
                    <br />
                      <label>Nominal</label>
                      <div class="input-group">
                                <span class="input-group-addon">Rp</span>
                                <input type="text" required name="nominal" id="nominal' . $row['id_pengeluaran'] . '" value="' . $row['Nominal'] . '" class="form-control" />
                                </div>
                                
                      <br />
                      <label>Keterangan</label>
                      <input type="text" required name="keterangan" id="keterangan' . $row['id_pengeluaran'] . '" value="' . $row['Keterangan'] . '" class="form-control" />
                      <br />
                      <input type="submit" name="update" id="update' . $row['id_pengeluaran'] . '" value="Update" class="btn btn-success" onMouseOver="this.style.backgroundColor=\'#00796b\'" onMouseOut="this.style.backgroundColor=\'#4CAF50\'" />
                    </form>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-default" onMouseOver="this.style.backgroundColor=\'#ff6666\'" onMouseOut="this.style.backgroundColor=\'white\'" data-dismiss="modal">Close</button>
                  </div>
                </div>
              </div>
            </div>';
                      }
                    } else {
                      echo "<tr><td colspan='6'>Tidak ada data pengeluaran.</td></tr>";
                    }
                    $conn->close();
                    ?>
                  </tbody>

                </table>


              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- .animated -->
    </div>
    <!-- .content -->

    <div class="clearfix"></div>

    <footer class="site-footer">
      <div class="footer-inner bg-white">
        <div class="row">
          <div class="col-sm-6 ">Copyright &copy; 2023 TEAM 1 MIF D</div>
        </div>
      </div>
    </footer>
  </div>
  <!-- /#right-panel -->

  <!-- Right Panel -->

  <!-- Scripts -->
  <script src="https://cdn.jsdelivr.net/npm/jquery@2.2.4/dist/jquery.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.4/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/jquery-match-height@0.7.2/dist/jquery.matchHeight.min.js"></script>
  <script src="assets/js/main2.js"></script>

  <script src="assets/js/lib/data-table/datatables.min.js"></script>
  <script src="assets/js/lib/data-table/dataTables.bootstrap.min.js"></script>
  <script src="assets/js/lib/data-table/dataTables.buttons.min.js"></script>
  <script src="assets/js/lib/data-table/buttons.bootstrap.min.js"></script>
  <script src="assets/js/lib/data-table/jszip.min.js"></script>
  <script src="assets/js/lib/data-table/vfs_fonts.js"></script>
  <script src="assets/js/lib/data-table/buttons.html5.min.js"></script>
  <script src="assets/js/lib/data-table/buttons.print.min.js"></script>
  <script src="assets/js/lib/data-table/buttons.colVis.min.js"></script>
  <script src="assets/js/init/datatables-init.js"></script>
  <script src="sweetallert/sweetalert2.min.js"></script>

  <?php if (@$_SESSION['editpengeluaran']) { ?>
    <script>
      Swal.fire({
        icon: 'success',
        title: 'Sukses',
        text: 'Data Berhasil Di Ubah',
        timer: 2000,
        showConfirmButton: false
      })
    </script>
    <!-- agar sweet alert tidak muncul lagi saat di refresh -->
  <?php unset($_SESSION['editpengeluaran']);
  } ?>
  <!-- jika ada session sukses maka tampilkan sweet alert dengan pesan yang telah di set
        di dalam session sukses  -->
  <?php if (@$_SESSION['eroreditdatapengeluaran']) { ?>
    <script>
      Swal.fire({
        icon: 'error',
        title: 'Gagal',
        text: 'Gagal',
        timer: 2000,
        showConfirmButton: false
      })
    </script>
    <!-- agar sweet alert tidak muncul lagi saat di refresh -->
  <?php unset($_SESSION['eroreditdatapengeluaran']);
  } ?>


  <!-- jika ada session sukses maka tampilkan sweet alert dengan pesan yang telah di set
        di dalam session sukses  -->
  <?php if (@$_SESSION['suksessss']) { ?>
    <script>
      Swal.fire({
        icon: 'success',
        title: 'Sukses',
        text: 'Data Berhasil Di Hapus',
        timer: 2000,
        showConfirmButton: false
      })
    </script>
    <!-- agar sweet alert tidak muncul lagi saat di refresh -->
  <?php unset($_SESSION['suksessss']);
  } ?>


  <!-- konfirmasi hapus data dengan sweet alert  -->
  <script>
    $('.alert_notif').on('click', function() {
      var getLink = $(this).attr('href');
      Swal.fire({
        title: "Anda Yakin Menghapus Data Ini?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        confirmButtonText: 'Yes',
        cancelButtonColor: '#3085d6',
        cancelButtonText: "Cancel"

      }).then(result => {
        //jika klik ya maka arahkan ke proses.php
        if (result.isConfirmed) {
          window.location.href = getLink
        }
      })
      return false;
    });
  </script>

  <script type="text/javascript">
    $(document).ready(function() {
      $("#bootstrap-data-table-export").DataTable();
    });
  </script>

  <?php if (@$_SESSION['insertdatapengeluaran']) { ?>
    <script>
      Swal.fire({
        icon: 'success',
        title: 'Sukses',
        text: 'Data Berhasil Disimpan',
        timer: 2000,
        showConfirmButton: false
      })
    </script>
    <!-- agar sweet alert tidak muncul lagi saat di refresh -->
  <?php unset($_SESSION['insertdatapengeluaran']);
  } ?>
  <!-- jika ada session sukses maka tampilkan sweet alert dengan pesan yang telah di set
        di dalam session sukses  -->
  <?php if (@$_SESSION['erorinsertdatapengeluaran']) { ?>
    <script>
      Swal.fire({
        icon: 'error',
        title: 'Gagal',
        text: 'Gagal',
        timer: 2000,
        showConfirmButton: false
      })
    </script>
    <!-- agar sweet alert tidak muncul lagi saat di refresh -->
  <?php unset($_SESSION['erorinsertdatapengeluaran']);
  } ?>
</body>

</html>
<div id="add_data_Pengeluaran" class="modal fade">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Input Data Pengeluaran</h4>
      </div>
      <div class="modal-body">
        <form action="insert/insertpengeluaran.php" method="post" id="insert_form" enctype='multipart/form-data'>
          <label>No</label>
          <input type="text" name="no" id="no" class="form-control" value="<?php echo generateID(); ?>" readonly />
          <br />


          <label>Nopol</label>
          <select name="nopol" id="nopol" class="form-control">
            <?php
            $koneksi = mysqli_connect("localhost", "root", "", "aswajatrans2");
            if (mysqli_connect_errno()) {
              echo "Koneksi ke database gagal: " . mysqli_connect_error();
              exit();
            }
            $query = "SELECT nopol, merkmobil FROM mobil";
            $result = mysqli_query($koneksi, $query);

            while ($row = mysqli_fetch_assoc($result)) {
              echo "<option value='" . $row['nopol'] . "'>" . $row['nopol'] . " - " . $row['merkmobil'] . "</option>";
            }

            ?>
          </select>

          </select>
          <br />

          <label>Tanggal Pengeluaran</label>
          <input type="date" name="tanggal" id="tanggal" class="form-control">
          <br />

          <label>Nominal</label>
          <div class="input-group">
            <span class="input-group-addon">Rp</span>
            <input type="text" name="nom" id="nom" class="form-control" />
          </div>

          <br />

          <label>Keterangan</label>
          <input type="text" name="ket" id="ket" class="form-control" />
          <br />

          <input type="submit" name="insert" id="insert" value="Simpan" class="btn btn-success" onMouseOver="this.style.backgroundColor='#00796b'" onMouseOut="this.style.backgroundColor='#4CAF50'" />
        </form>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" onMouseOver="this.style.backgroundColor='#ff6666'" onMouseOut="this.style.backgroundColor='white'" data-dismiss="modal">Close</button>
        </div>
      </div>


    </div>
  </div>
</div>

<?php

function generateID()
{
  try {
    $conn = mysqli_connect("localhost", "root", "", "aswajatrans2");
    if (mysqli_connect_errno()) {
      echo "Koneksi ke database gagal: " . mysqli_connect_error();
      exit();
    }
    $sql = "SELECT * FROM pengeluaran ORDER BY id_pengeluaran ASC";
    $result = mysqli_query($conn, $sql);
    $nextNumber = 1;
    while ($row = mysqli_fetch_assoc($result)) {
      $NoJual = substr($row['id_pengeluaran'], 3);
      if (!empty($NoJual)) {
        $nextNumber = max($nextNumber, intval($NoJual) + 1);
      }
    }

    $AN = sprintf("%04d", $nextNumber);
    $newID = "PNG" . $AN;

    return $newID;
  } catch (Exception $e) {
    echo "Terjadi kesalahan: " . $e->getMessage();
  }
}
