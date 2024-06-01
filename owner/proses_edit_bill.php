<?php

include("../koneksi.php");
include("validasiOwner.php");
$idHeader = $_POST['id_header'];
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


$query = "UPDATE order_header SET waktu = '$waktu', id_metode_pembayaran = '$idMetodePembayaran', kasir='$kasir', total_harga='$totalHarga', bayar='$bayar', nama_customer='$nama', jenis_order='$jenisOrder' WHERE id_order_header = '$idHeader'";
$result = mysqli_query($conn, $query);

if ($result) {
    for ($i = 0; $i < count($qty); $i++) {
        if ($idMenu[$i] != null and $qty[$i] != null) {
            $query2 = "INSERT INTO order_detail (id_order_header, id_menu, qty)  VALUES ('$idHeader', '$idMenu[$i]', '$qty[$i]')";
            $result2 = mysqli_query($conn, $query2);
            if (!$result2) { ?>
                <script type="text/javascript">
                    alert("Gagal disimpan: <?= mysqli_error($conn); ?>");
                    window.location.href = "<?= $base_url . 'owner/billing.php' ?>";
                </script>
    <?php }
        }
    }
    ?>
    <script type="text/javascript">
        alert("Berhasil disimpan");
        window.location.href = "<?= $base_url . 'owner/billing.php' ?>";
    </script>

<?php } else { ?>
    <script type="text/javascript">
        alert("Gagal disimpan: <?= mysqli_error($conn); ?>");
        window.location.href = "<?= $base_url . 'owner/billing.php' ?>";
    </script>
<?php }
?>