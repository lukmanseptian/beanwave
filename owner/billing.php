<?php
$title = "billing";
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
                                    <h6 class="mb-0">Daftar Transaksi</h6>
                                </div>
                                <div class="col-6 text-end">
                                    <a href="<?= $base_url . 'owner/tambah_bill.php'; ?>" class="btn bg-gradient-dark mb-0" href="javascript:;"><i class="material-icons text-sm">add</i>&nbsp;&nbsp;Tambah Bill</a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body px-0 pb-2">

                            <div class="table-responsive p-0">
                                <table class="table align-items-center mb-0">
                                    <thead>
                                        <tr>
                                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">No</th>
                                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Transaksi</th>
                                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Waktu</th>
                                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Total Harga</th>
                                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">MetodePembayaran</th>
                                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Kasir</th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $query = "SELECT order_header.*, metode_pembayaran.*, user.* FROM order_header
                                        LEFT JOIN metode_pembayaran ON order_header.id_metode_pembayaran = metode_pembayaran.id_metode_pembayaran
                                        LEFT JOIN user ON user.username = order_header.kasir
                                        ";
                                        $result = mysqli_query($conn, $query);
                                        $bills = array();
                                        while ($row = mysqli_fetch_array($result)) {
                                            $bills[] = $row;
                                        }

                                        $i = 1;
                                        foreach ($bills as $bill) {
                                        ?>
                                            <tr>
                                                <td class="align-middle text-center text-sm">
                                                    <span class="text-secondary text-xs font-weight-bold"><?= $i; ?></span>
                                                </td>
                                                <td class="align-middle text-center text-sm">
                                                    <a class="text-xs font-weight-bold mb-0 text-primary" target="_blank" href="<?= $base_url . 'owner/detail_bill.php?id=' . $bill['id_order_header']; ?>">Detail</a>
                                                </td>
                                                <td class="align-middle text-center text-sm">
                                                    <p class="text-xs font-weight-bold mb-0"><?= $bill['waktu'] ?></p>
                                                </td>
                                                <td class="align-middle text-center text-sm">
                                                    <p class="text-xs font-weight-bold mb-0"><?= $bill['total_harga'] ?></p>
                                                </td>
                                                <td class="align-middle text-center text-sm">
                                                    <p class="text-xs font-weight-bold mb-0"><?= $bill['nama_metode_pembayaran'] ?></p>
                                                </td>
                                                <td class="align-middle text-center text-sm">
                                                    <p class="text-xs font-weight-bold mb-0"><?= $bill['username'] ?></p>
                                                </td>
                                                <td class="text-sm">
                                                    <div class="ms-auto text-start">
                                                        <a class="btn btn-link text-dark px-3 mb-0" href="<?= $base_url . 'owner/edit_bill.php?id=' . $bill['id_order_header']; ?>"><i class="material-icons text-sm me-2">edit</i>Edit</a>
                                                        <a class="btn btn-link text-danger text-gradient px-3 mb-0" href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#hapusModal" data-id="<?= $bill['id_order_header'];  ?>" onclick="setHapus(this)"><i class="material-icons text-sm me-2">delete</i>delete</a>
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
                    <form method="post" action="<?= $base_url . 'owner/proses_hapus_bill.php'; ?>">
                        <div class="modal-body">
                            Apakah anda yakin akan menghapus data ini?
                            <input type="hidden" name="id_order" id="id_order">
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
            document.querySelector("#id_order").value = id;
            console.log(id);
        }
    </script>

</body>