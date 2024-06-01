<?php
$title = 'Kategori Menu';
include("../koneksi.php");
include("validasiOwner.php");
include('header.php');

$queryMenu = "SELECT * FROM menu WHERE status_menu='1'";
$resultMenu = mysqli_query($conn, $queryMenu);
$menus = array();
while ($row = mysqli_fetch_array($resultMenu)) {
    $menus[] = $row;
}

$queryPayment = "SELECT * FROM metode_pembayaran";
$resultPayment = mysqli_query($conn, $queryPayment);
$payments = array();
while ($row = mysqli_fetch_array($resultPayment)) {
    $payments[] = $row;
}


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
        window.location.href = "<?= $base_url; ?>owner/billing.php";
    </script>;
<?php
}
$orderHeader = mysqli_fetch_assoc($resultHeader);

$queryDetail = "SELECT order_detail.*, menu.*, order_header.*
FROM order_detail 
LEFT JOIN menu ON menu.id_menu = order_detail.id_menu
LEFT JOIN order_header ON order_header.id_order_header = order_detail.id_order_header
WHERE order_detail.id_order_header = '$getId'";

$resultDetail = mysqli_query($conn, $queryDetail);
$orders = array();
while ($row = mysqli_fetch_array($resultDetail)) {
    $orders[] = $row;
}

// var_dump($orders);
// die;
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
                                <h6 class="text-white text-capitalize ps-3">Edit Bill</h6>
                            </div>
                        </div>
                        <div class="card-body px-4 pb-2">
                            <div class="table-responsive">
                                <table class="table align-items-center">
                                    <thead>
                                        <tr>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">menu</th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">harga</th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">qty</th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($orders as $order) { ?>
                                            <tr>
                                                <td>
                                                    <div class="input-group input-group-outline">
                                                        <select class="form-control">
                                                            <option><?= $order['nama_menu']; ?></option>
                                                        </select>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="input-group input-group-outline">
                                                        <input type="text" class="form-control" readonly disabled value="<?= $order['harga']; ?>">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="input-group input-group-outline">
                                                        <input type="text" class="form-control" readonly disabled value="<?= $order['qty']; ?>">
                                                    </div>
                                                </td>
                                                <td class="text-sm">
                                                    <div class="ms-auto text-start">
                                                        <a class="btn btn-link text-danger text-gradient px-3 mb-0" href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#hapusModal" data-iddetail="<?= $order['id_order_detail'];  ?>" data-idheader="<?= $order['id_order_header'];  ?>" data-total="<?= $order['total_harga'];  ?>" onclick="setHapus(this)"><i class="material-icons text-sm me-2">delete</i>delete</a>
                                                    </div>
                                                </td>
                                            </tr>

                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>

                            <hr class="dark horizontal my-4">

                            <form method="post" action="<?= $base_url; ?>/owner/proses_edit_bill.php">
                                <div class="row">
                                    <input type="hidden" name="id_header" class="form-control" value="<?= $orderHeader['id_order_header']; ?>">
                                    <div class="col-md-6">
                                        <label class="form-label">nama customer</label>
                                        <div class="input-group input-group-outline mb-3">
                                            <input type="text" name="nama" class="form-control" value="<?= $orderHeader['nama_customer']; ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">jenis order</label>
                                        <div class="input-group input-group-outline mb-3">
                                            <select class="form-control " name="jenis_order">
                                                <option value="Dine in" <?= $orderHeader['jenis_order'] == "Dine in" ? "selected" : ""; ?>>Dine in</option>
                                                <option value="Take away" <?= $orderHeader['jenis_order'] == "Take away" ? "selected" : ""; ?>>Take away</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="table-responsive">
                                    <table class="table align-items-center" id="tableOrder">
                                        <thead>
                                            <tr>
                                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">menu</th>
                                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">harga</th>
                                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">qty</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr class="order">
                                                <td>
                                                    <div class="input-group input-group-outline">
                                                        <select name="id_menu[]" id="id_menu1" class="form-control" onchange="setHarga(this)">
                                                            <option disabled selected>Menu</option>
                                                            <?php foreach ($menus as $menu) { ?>
                                                                <option value="<?= $menu['id_menu']; ?>" harga="<?= $menu['harga']; ?>"><?= $menu['nama_menu']; ?></option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="input-group input-group-outline">
                                                        <input type="text" name="harga[]" id="harga1" class="form-control" readonly disabled placeholder="harga">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="input-group input-group-outline">
                                                        <input type="text" name="qty[]" id="qty1" class="form-control" placeholder="qty" onchange="setTotalHarga()">
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>

                                <div class="row d-flex justify-content-end">
                                    <div class="col-md-6">
                                        <table>
                                            <tr>
                                                <td>
                                                    <label class="form-label">total harga</label>
                                                </td>
                                                <td>
                                                    <div class="input-group input-group-outline mb-3 ms-3">
                                                        <input type="text" name="total_harga" class="form-control" value="<?= $orderHeader['total_harga']; ?>" id="total_harga" readonly>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <label class="form-label">metode pembayaran</label>
                                                </td>
                                                <td>
                                                    <div class="input-group input-group-outline mb-3 ms-3">
                                                        <select name="id_metode_pembayaran" class="form-control " id="id_metode_pembayaran">
                                                            <?php foreach ($payments as $payment) { ?>
                                                                <option value="<?= $payment['id_metode_pembayaran']; ?>" <?= $orderHeader['id_metode_pembayaran'] == $payment['id_metode_pembayaran'] ? "selected" : ""; ?>><?= $payment['nama_metode_pembayaran']; ?></option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <label class="form-label">bayar</label>
                                                </td>
                                                <td>
                                                    <div class="input-group input-group-outline mb-3 ms-3">
                                                        <input type="text" name="bayar" class="form-control" id="bayar" value="<?= $orderHeader['bayar']; ?>" onchange="setKembali()">
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <label class=" form-label">kembali</label>
                                                </td>
                                                <td>
                                                    <div class="input-group input-group-outline mb-3 ms-3">
                                                        <input type="text" name="kembali" class="form-control " id="kembali" value="<?= $orderHeader['bayar'] - $orderHeader['total_harga']; ?>" readonly disabled>
                                                    </div>
                                                </td>
                                            </tr>
                                        </table>
                                        <div class="text-center">
                                            <button type="submit" class="btn bg-gradient-primary my-4 mb-2">Bayar</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </main>


    <div class="modal fade" id="hapusModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Konfirmasi Hapus</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="post" action="<?= $base_url . 'owner/proses_hapus_order.php'; ?>">
                    <div class="modal-body">
                        Apakah anda yakin akan menghapus data ini?
                        <input type="hidden" name="id_order_header" id="id_order_header">
                        <input type="hidden" name="total" id="total">
                        <input type="hidden" name="id_order_detail" id="id_order_detail">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Hapus</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <?php include('footer.php'); ?>

    <script>
        var count = 1;
        $('body').on('focus', ".order:last input", function() {
            count++;
            var $clone = $('.order:last').clone();
            $clone.find("input,select").each(function() {
                $(this).attr({
                    id: $(this).attr("id").replace(/\d/g, '') + count
                });
            });
            $("#tableOrder").append($clone);
            $(".order:last .cleanVal").val('');
        });


        function setHarga(dataPass) {
            let idElMenu = dataPass.getAttribute('id')
            let idElHarga = "harga" + idElMenu.replace(/\D/g, '')
            let harga = dataPass.options[dataPass.selectedIndex].getAttribute('harga')
            document.getElementById(idElHarga).value = harga
            setTotalHarga()
        }

        function setTotalHarga() {
            var nRow = document.getElementById("tableOrder").rows.length - 1;
            let total = parseInt('<?= $orderHeader["total_harga"]; ?>')
            for (let i = 0; i < nRow; i++) {
                let harga = document.getElementById("harga" + (i + 1)).value
                let qty = document.getElementById("qty" + (i + 1)).value
                if (harga != null && qty != null) {
                    total += harga * qty
                }
            }
            document.getElementById("total_harga").value = total
            setKembali()
        }

        function setKembali() {
            let total = document.getElementById("total_harga").value
            let bayar = document.getElementById("bayar").value
            document.getElementById("kembali").value = bayar - total
        }

        function setHapus(dataPass) {
            console.log(dataPass);
            let idDetail = dataPass.getAttribute("data-iddetail");
            let idHeader = dataPass.getAttribute("data-idheader");
            let totalHarga = dataPass.getAttribute("data-total");
            document.querySelector("#id_order_detail").value = idDetail;
            document.querySelector("#id_order_header").value = idHeader;
            document.querySelector("#total").value = totalHarga;
        }
    </script>
</body>