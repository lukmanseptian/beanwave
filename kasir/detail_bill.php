<?php
$title = "billing";
include("../koneksi.php");
include("validasiKasir.php");
include('header.php');

$getId = $_GET['id'];

$queryHeader = "SELECT order_header.*, metode_pembayaran.*, user.* 
FROM order_header 
LEFT JOIN metode_pembayaran ON metode_pembayaran.id_metode_pembayaran = order_header.id_metode_pembayaran
LEFT JOIN user ON order_header.kasir = user.username
WHERE id_order_header = '$getId'";

$resultHeader = mysqli_query($conn, $queryHeader);
if (mysqli_num_rows($resultHeader) < 1) {
?>
    <script>
        window.location.href = "<?= $base_url; ?>kasir/billing.php";
    </script>;
<?php
}

$orderHeader = mysqli_fetch_assoc($resultHeader);



$queryDetail = "SELECT order_detail.*, menu.*
FROM order_detail 
LEFT JOIN menu ON menu.id_menu = order_detail.id_menu
WHERE id_order_header = '$getId'";

$resultDetail = mysqli_query($conn, $queryDetail);
$orders = array();
while ($row = mysqli_fetch_array($resultDetail)) {
    $orders[] = $row;
}

?>

<body>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg p-2">
        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-6">
                    <div class="text-center mb-5">
                        <div class="avatar">
                            <img src="<?= $base_url; ?>assets/img/logo_black.png">
                        </div>
                        <h5 class="mb-0">Beanwave</h5>
                    </div>
                    <ul class="list-group">
                        <li class="list-group-item border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg">
                            <div class="d-flex flex-column">
                                <h6 class="mb-1 text-dark font-weight-bold text-sm"><?= date("d/M/Y H:i:s", strtotime($orderHeader['waktu'])) ?></h6>
                                <span class="text-xs">ID Transaksi: #<?= $orderHeader['id_order_header'] ?></span>
                                <span class="text-xs">Kasir: <?= $orderHeader['nama_user'] ?></span>
                            </div>
                            <div class="d-flex flex-column text-sm me-4">
                                <span class="text-dark text-sm mb-0 px-0"><?= $orderHeader['nama_metode_pembayaran'] ?></span>
                                <span class="text-dark text-sm mb-0 px-0"><?= $orderHeader['nama_customer'] ?> - <?= $orderHeader['jenis_order'] ?></span>
                            </div>
                        </li>
                    </ul>

                    <div class="p-0 mt-2">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Menu</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Qty</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Harga</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Jumlah</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($orders as $order) {
                                ?>
                                    <tr>
                                        <td class="align-middle text-center text-sm">
                                            <p class="text-xs font-weight-bold mb-0"><?= $order['nama_menu'] ?></p>
                                        </td>
                                        <td class="align-middle text-center text-sm">
                                            <p class="text-xs font-weight-bold mb-0"><?= $order['qty'] ?></p>
                                        </td>
                                        <td class="align-middle text-center text-sm">
                                            <p class="text-xs font-weight-bold mb-0"><?= $order['harga'] ?></p>
                                        </td>
                                        <td class="align-middle text-center text-sm">
                                            <p class="text-xs font-weight-bold mb-0"><?= $order['qty'] * $order['harga'] ?></p>
                                        </td>
                                    </tr>
                                <?php
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>

                    <div class="row d-flex justify-content-end my-5">
                        <div class="col-md-4">
                            <table>
                                <tr>
                                    <td>
                                        <label class="form-label mb-1">total harga</label>
                                    </td>
                                    <td class="align-end">
                                        <h6 class="text-primary mb-1 ms-4"><?= $orderHeader['total_harga']; ?></h6>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <label class="form-label">bayar</label>
                                    </td>
                                    <td>
                                        <p class="text-xs font-weight-bold mb-0 ms-4"><?= $orderHeader['bayar']; ?></p>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <label class=" form-label">kembali</label>
                                    </td>
                                    <td>
                                        <p class="text-xs font-weight-bold mb-0 ms-4"><?= $orderHeader['bayar'] - $orderHeader['total_harga']; ?></p>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <?php include('footer.php'); ?>
</body>

<script>
    window.onload = function() {
        window.print();
    }
</script>