<?php
$title = 'Menu';
include("../koneksi.php");
include("validasiOwner.php");
include('header.php');

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
                                <h6 class="text-white text-capitalize ps-3">Tambah Menu</h6>
                            </div>
                        </div>
                        <div class="card-body px-4 pb-2">
                            <form method="post" action="<?= $base_url; ?>owner/proses_tambah_menu.php" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-md-6 my-3">
                                        <label for="exampleFormControlInput1" class="form-label">nama menu</label>
                                        <div class="input-group input-group-outline">
                                            <input type="text" name="nama" class="form-control " id="exampleFormControlInput1" placeholder="nama menu">
                                        </div>
                                    </div>

                                    <div class="col-md-6 my-3">
                                        <label for="exampleFormControlInput1" class="form-label">kategori</label>
                                        <div class="input-group input-group-outline">
                                            <select name="kategori" class="form-control" aria-label="Default select example">
                                                <option selected>kategori menu</option>
                                                <?php
                                                $query = "SELECT * FROM kategori_menu";
                                                $result = mysqli_query($conn, $query);
                                                $categories = array();
                                                while ($row = mysqli_fetch_array($result)) {
                                                    $categories[] = $row;
                                                }

                                                foreach ($categories as $category) {
                                                ?>
                                                    <option value="<?= $category['id_kategori_menu'] ?>"><?= $category['nama_kategori_menu'] ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-6 my-3">
                                        <label for="exampleFormControlInput1" class="form-label">harga</label>
                                        <div class="input-group input-group-outline">
                                            <input type="text" name="harga" class="form-control" id="exampleFormControlInput1" placeholder="harga">
                                        </div>
                                    </div>

                                    <div class="col-md-6 my-3">
                                        <label for="exampleFormControlInput1" class="form-label">status</label>
                                        <div class="input-group input-group-outline">
                                            <select name="status" class="form-control" aria-label="Default select example">
                                                <option value="1">Tersedia</option>
                                                <option value="0">Habis</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-6 my-3">
                                        <label for="exampleFormControlInput1" class="form-label">foto</label>
                                        <div class="input-group input-group-outline">
                                            <input type="file" name="foto" class="form-control" id="exampleFormControlInput1" placeholder="foto">
                                        </div>
                                    </div>

                                    <div class="text-center">
                                        <button type="submit" name="submit" class="btn bg-gradient-primary my-4 mb-2">Simpan</button>
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