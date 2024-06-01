<?php
$title = "Dashboard";
include("../koneksi.php");
include("validasiKasir.php");
include('header.php');

date_default_timezone_set('Asia/Jakarta');
$tanggal = date('Y-m-d');

$queryHeader = "SELECT order_header.*, metode_pembayaran.*, user.* 
FROM order_header 
LEFT JOIN metode_pembayaran ON metode_pembayaran.id_metode_pembayaran = order_header.id_metode_pembayaran
LEFT JOIN user ON order_header.kasir = user.username
WHERE waktu LIKE '$tanggal%'";

$resultHeader = mysqli_query($conn, $queryHeader);
$jumlahCustomer = mysqli_num_rows($resultHeader);


$queryTotalHarga = "SELECT SUM(total_harga) as total
FROM order_header 
WHERE waktu LIKE '$tanggal%'";

$resultTotalHarga = mysqli_query($conn, $queryTotalHarga);
$data = mysqli_fetch_assoc($resultTotalHarga);


$queryTotalMenu = "SELECT SUM(qty) as total
FROM order_detail LEFT JOIN order_header ON order_detail.id_order_header = order_header.id_order_header 
WHERE order_header.waktu LIKE '$tanggal%'";

$resultTotalMenu = mysqli_query($conn, $queryTotalMenu);
$menu = mysqli_fetch_assoc($resultTotalMenu);
?>

<body class="g-sidenav-show  bg-gray-200">



    <?php include('sidebar.php'); ?>

    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">

        <?php include('navbar.php'); ?>


        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-xl-4 col-sm-6 mb-xl-0 mb-4">
                    <div class="card">
                        <div class="card-header p-3 pt-2">
                            <div class="icon icon-lg icon-shape bg-gradient-dark shadow-dark text-center border-radius-xl mt-n4 position-absolute">
                                <i class="material-icons opacity-10">payments</i>
                            </div>
                            <div class="text-end pt-1">
                                <p class="text-sm mb-0 text-capitalize">pendapatan hari ini</p>
                                <h4 class="mb-0">Rp <?= $data['total']; ?></h4>
                            </div>
                        </div>
                        <hr class="dark horizontal my-0">
                        <div class="card-footer p-3">
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-sm-6 mb-xl-0 mb-4">
                    <div class="card">
                        <div class="card-header p-3 pt-2">
                            <div class="icon icon-lg icon-shape bg-gradient-primary shadow-primary text-center border-radius-xl mt-n4 position-absolute">
                                <i class="material-icons opacity-10">person</i>
                            </div>
                            <div class="text-end pt-1">
                                <p class="text-sm mb-0 text-capitalize">pelanggan hari ini</p>
                                <h4 class="mb-0"><?= $jumlahCustomer; ?></h4>
                            </div>
                        </div>
                        <hr class="dark horizontal my-0">
                        <div class="card-footer p-3">
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-sm-6 mb-xl-0 mb-4">
                    <div class="card">
                        <div class="card-header p-3 pt-2">
                            <div class="icon icon-lg icon-shape bg-gradient-success shadow-success text-center border-radius-xl mt-n4 position-absolute">
                                <i class="material-icons opacity-10">fastfood</i>
                            </div>
                            <div class="text-end pt-1">
                                <p class="text-sm mb-0 text-capitalize">menu yang terjual</p>
                                <h4 class="mb-0"><?= $menu['total'] != null ? $menu['total'] : "0"; ?></h4>
                            </div>
                        </div>
                        <hr class="dark horizontal my-0">
                        <div class="card-footer p-3">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <?php include('footer.php'); ?>
</body>

</html>