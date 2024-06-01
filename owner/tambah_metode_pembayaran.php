<?php
$title = 'Metode Pembayaran';
include("../koneksi.php");
include("validasiOwner.php");
include('header.php'); ?>

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
                                <h6 class="text-white text-capitalize ps-3">Tambah Metode Pembayaran</h6>
                            </div>
                        </div>
                        <div class="card-body px-4 pb-2">
                            <form method="post" action="<?= $base_url; ?>/owner/proses_tambah_metode_pembayaran.php">
                                <div class="row">
                                    <div class="col-md-6 my-3">
                                        <label for="exampleFormControlInput1" class="form-label">nama metode pembayaran</label>
                                        <div class="input-group input-group-outline">
                                            <input type="text" name="nama" class="form-control " id="exampleFormControlInput1" placeholder="nama metode pembayaran">
                                        </div>
                                    </div>

                                    <div class="col-md-6 my-3">
                                        <label for="exampleFormControlInput1" class="form-label">keterangan metode pembayaran</label>
                                        <div class="input-group input-group-outline">
                                            <input type="text" name="keterangan" class="form-control" id="exampleFormControlInput1" placeholder="keterangan metode pembayaran">
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