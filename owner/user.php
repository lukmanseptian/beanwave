<?php
$title = "User";
include("../koneksi.php");
include("validasiOwner.php");
include('header.php'); ?>

<body class="g-sidenav-show  bg-gray-200">



  <?php include('sidebar.php'); ?>
  <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
    <?php include('navbar.php'); ?>

    <div class="container-fluid py-4">
      <div class="row">
        <div class="col-12">
          <div class="card my-4 mx-3">
            <div class="card-header pb-0 p-3">
              <div class="row">
                <div class="col-6 d-flex align-items-center">
                  <h6 class="mb-0">Daftar User</h6>
                </div>
                <div class="col-6 text-end">
                  <a href="<?= $base_url . 'owner/tambah_user.php'; ?>" class="btn bg-gradient-dark mb-0" href="javascript:;"><i class="material-icons text-sm">add</i>&nbsp;&nbsp;Tambah User</a>
                </div>
              </div>
            </div>
            <div class="card-body px-0 pb-2">

              <div class="table-responsive p-0">
                <table class="table align-items-center mb-0">
                  <thead>
                    <tr>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">No</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Username</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nama User</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Role</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $query = "SELECT user.*, role_user.* FROM user LEFT JOIN role_user ON user.id_role = role_user.id_role";
                    $result = mysqli_query($conn, $query);

                    $users = array();
                    while ($row = mysqli_fetch_array($result)) {
                      $users[] = $row;
                    }

                    $i = 1;
                    foreach ($users as $user) {
                    ?>
                      <tr>
                        <td class="align-middle text-center text-sm">
                          <span class="text-secondary text-xs font-weight-bold"><?= $i; ?></span>
                        </td>
                        <td class="align-middle text-center text-sm">
                          <p class="text-xs font-weight-bold mb-0"><?= $user['username'] ?></p>
                        </td>
                        <td class="align-middle text-center text-sm">
                          <p class="text-xs font-weight-bold mb-0"><?= $user['nama_user'] ?></p>
                        </td>
                        <td class="align-middle text-center text-sm">
                          <span class="text-secondary text-xs font-weight-bold"><?= $user['nama_role'] ?></span>
                        </td>
                        <td class="text-sm">
                          <div class="ms-auto text-start">
                            <a class="btn btn-link text-dark px-3 mb-0" href="<?= $base_url . 'owner/edit_user.php?id=' . $user['username']; ?>"><i class="material-icons text-sm me-2">edit</i>Edit</a>
                            <?php if ($user['id_role'] != '1') { ?>
                              <a class="btn btn-link text-danger text-gradient px-3 mb-0" href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#hapusModal" data-id="<?= $user['username'] ?>" onclick="setHapus(this)"><i class="material-icons text-sm me-2">delete</i>delete</a>
                            <?php } ?>
                          </div>
                        </td>
                      </tr>
                    <?php $i++;
                    }
                    ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>


    <div class="modal fade" id="hapusModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Konfirmasi Hapus</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <form method="post" action="<?= $base_url . 'owner/proses_hapus_user.php'; ?>">
            <div class="modal-body">
              Apakah anda yakin akan menghapus data ini?
              <input type="hidden" name="username" id="username">
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">Hapus</button>
            </div>
          </form>
        </div>
      </div>
    </div>


  </main>
  <?php include('footer.php'); ?>

  <script type="text/javascript">
    $(document).ready(function() {
      $('#example').DataTable();
    });
  </script>

  <script>
    function setHapus(dataPass) {
      console.log(dataPass);
      let id = dataPass.getAttribute("data-id");
      document.querySelector("#username").value = id;
      console.log(id);
    }
  </script>

</body>