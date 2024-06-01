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
                                <h6 class="text-white text-capitalize ps-3">Tambah Bill</h6>
                            </div>
                        </div>
                        <div class="card-body px-4 pb-2">
                            <form method="post" action="<?= $base_url; ?>/owner/proses_tambah_bill.php">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="input-group input-group-outline mb-3">
                                            <label class="form-label">nama customer</label>
                                            <input type="text" name="nama" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="input-group input-group-outline mb-3">
                                            <select class="form-control " name="jenis_order">
                                                <option value="Dine in">Dine in</option>
                                                <option value="Take away">Take away</option>
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
                                <hr class="dark horizontal my-4">
                                <div class="row d-flex justify-content-end">
                                    <div class="col-md-6">
                                        <table>
                                            <tr>
                                                <td>
                                                    <label class="form-label">total harga</label>
                                                </td>
                                                <td>
                                                    <div class="input-group input-group-outline mb-3 ms-3">
                                                        <input type="text" name="total_harga" class="form-control " id="total_harga" readonly>
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
                                                                <option value="<?= $payment['id_metode_pembayaran']; ?>"><?= $payment['nama_metode_pembayaran']; ?></option>
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
                                                        <input type="text" name="bayar" class="form-control" id="bayar" onchange="setKembali()">
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <label class=" form-label">kembali</label>
                                                </td>
                                                <td>
                                                    <div class="input-group input-group-outline mb-3 ms-3">
                                                        <input type="text" name="kembali" class="form-control " id="kembali" readonly disabled>
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
            let total = 0
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
    </script>
</body>