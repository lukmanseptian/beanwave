<?php

include("../koneksi.php");
include("validasiKasir.php");
$nama = $_POST['nama'];
$jenisOrder = $_POST['jenis_order'];
$idMenu = $_POST['id_menu'];
$qty = $_POST['qty'];
$totalHarga = $_POST['total_harga'];
$idMetodePembayaran = $_POST['id_metode_pembayaran'];
$bayar = $_POST['bayar'];
$kasir = $username;
date_default_timezone_set('Asia/Jakarta');
$waktu = date('Y-m-d H:i:s');


$query = "INSERT INTO order_header (waktu, id_metode_pembayaran, kasir, total_harga, bayar, nama_customer, jenis_order)  VALUES ('$waktu', '$idMetodePembayaran', '$kasir', '$totalHarga', '$bayar', '$nama', '$jenisOrder')";
$result = mysqli_query($conn, $query);

if ($result) {
    $last_id = mysqli_insert_id($conn);
    for ($i = 0; $i < count($qty); $i++) {
        if ($idMenu[$i] != null and $qty[$i] != null) {
            $query2 = "INSERT INTO order_detail (id_order_header, id_menu, qty)  VALUES ('$last_id', '$idMenu[$i]', '$qty[$i]')";
            $result2 = mysqli_query($conn, $query2);
            if (!$result2) { ?>
                <script type="text/javascript">
                    alert("Gagal disimpan: <?= mysqli_error($conn); ?>");
                    window.location.href = "<?= $base_url . 'kasir/billing.php' ?>";
                </script>
    <?php }
        }
    }
    ?>
    <script type="text/javascript">
        alert("Berhasil disimpan");
        window.location.href = "<?= $base_url . 'kasir/billing.php?' ?>";
    </script>

<?php } else { ?>
    <script type="text/javascript">
        alert("Gagal disimpan: <?= mysqli_error($conn); ?>");
        window.location.href = "<?= $base_url . 'kasir/billing.php' ?>";
    </script>
<?php }
?>