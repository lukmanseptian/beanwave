<?php
$title = 'User';

include("../koneksi.php");
include("validasiOwner.php");
include('header.php');
$getUsername = $_GET['id'];
$query = "SELECT user.*, role_user.* FROM user LEFT JOIN role_user ON user.id_role = role_user.id_role WHERE username = '$getUsername'";
$result = mysqli_query($conn, $query);

$user =  mysqli_fetch_assoc($result);
?>

<body class="g-sidenav-show  bg-gray-200">



    <?php include('sidebar.php'); ?>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
        <?php include('navbar.php'); ?>

        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-12">
                    <div class="card my-4 mx-3">
                        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                            <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                                <h6 class="text-white text-capitalize ps-3">Edit User</h6>
                            </div>
                        </div>
                        <div class="card-body px-4 pb-2">
                            <form method="post" action="<?= $base_url; ?>/owner/proses_edit_user.php">
                                <div class="row">
                                    <div class="col-md-6 my-3">
                                        <label for="exampleFormControlInput1" class="form-label">nama user</label>
                                        <div class="input-group input-group-outline">
                                            <input type="text" name="nama" class="form-control " id="exampleFormControlInput1" placeholder="nama user" value="<?= $user['nama_user']; ?>">
                                        </div>
                                    </div>

                                    <div class="col-md-6 my-3">
                                        <label for="exampleFormControlInput1" class="form-label">username</label>
                                        <div class="input-group input-group-outline">
                                            <input type="text" name="username" class="form-control" id="exampleFormControlInput1" placeholder="username" readonly value="<?= $user['username']; ?>">
                                        </div>
                                    </div>

                                    <div class="col-md-6 my-3">
                                        <label for="exampleFormControlInput1" class="form-label">password</label>
                                        <div class="input-group input-group-outline">
                                            <input type="text" name="password" class="form-control" id="exampleFormControlInput1" placeholder="password" value="<?= $user['password']; ?>">
                                        </div>
                                    </div>

                                    <div class="col-md-6 my-3">
                                        <label for="exampleFormControlInput1" class="form-label">role user</label>
                                        <div class="input-group input-group-outline">
                                            <select name="role" class="form-control" aria-label="Default select example">
                                                <option selected>role user</option>
                                                <option value="1" <?= $user['id_role'] == 1 ? "selected" : ""; ?>>owner</option>
                                                <option value="2" <?= $user['id_role'] == 2 ? "selected" : ""; ?>>kasir</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="text-center">
                                        <button type="submit" class="btn bg-gradient-primary my-4 mb-2">Simpan</button>
                                    </div>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </main>
    <?php include('footer.php'); ?>



</body>