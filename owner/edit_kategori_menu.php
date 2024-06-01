<?php
$title = 'Kategori Menu';
include("../koneksi.php");
include("validasiOwner.php");
include('header.php');
$getId = $_GET['id'];
$query = "SELECT * FROM kategori_menu WHERE id_kategori_menu = '$getId'";
$result = mysqli_query($conn, $query);

$category = mysqli_fetch_assoc($result);
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
                                <h6 class="text-white text-capitalize ps-3">Edit Kategori Menu</h6>
                            </div>
                        </div>
                        <div class="card-body px-4 pb-2">
                            <p>Icon kategori diambil dari <a class="text-primary" href="https://fonts.google.com/icons" target="_blank">Font Google</a></p>
                            <form method="post" action="<?= $base_url; ?>/owner/proses_edit_kategori_menu.php">
                                <input type="hidden" name="id" class="form-control " id="exampleFormControlInput1" placeholder="id kategori menu" value="<?= $category['id_kategori_menu']; ?>">
                                <div class="row">
                                    <div class="col-md-6 my-3">
                                        <label for="exampleFormControlInput1" class="form-label">nama kategori menu</label>
                                        <div class="input-group input-group-outline">
                                            <input type="text" name="nama" class="form-control " id="exampleFormControlInput1" placeholder="nama kategori menu" value="<?= $category['nama_kategori_menu']; ?>">
                                        </div>
                                    </div>

                                    <div class="col-md-6 my-3">
                                        <label for="exampleFormControlInput1" class="form-label">icon kategori menu</label>
                                        <div class="input-group input-group-outline">
                                            <input type="text" name="icon" class="form-control" id="exampleFormControlInput1" placeholder="icon kategori menu" value="<?= $category['icon_kategori_menu']; ?>">
                                        </div>
                                    </div>

                                    <div class=" text-center">
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