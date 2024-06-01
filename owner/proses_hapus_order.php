<?php
include('../koneksi.php');
include("validasiOwner.php");
$idDetail = $_POST['id_order_detail'];
$idHeader = $_POST['id_order_header'];
$totalHarga = $_POST['total'];

$queryDetail = "SELECT order_header.*, order_detail.*, menu.*
FROM order_detail
LEFT JOIN order_header ON order_header.id_order_header = order_detail.id_order_header
LEFT JOIN menu ON menu.id_menu = order_detail.id_menu
WHERE id_order_detail = '$idDetail'";
$resultDetail = mysqli_query($conn, $queryDetail);

if (mysqli_num_rows($resultDetail) < 1) {
?>
    <script>
        window.location.href = "<?= $base_url; ?>owner/billing.php";
    </script>;
    <?php
}
$orderDetail = mysqli_fetch_assoc($resultDetail);

$totalUpdate = ((int)$totalHarga) - ($orderDetail["qty"] * $orderDetail["harga"]);

$queryDelete = "DELETE FROM order_detail WHERE id_order_detail = '" . $idDetail . "'";
$resultDelete = mysqli_query($conn, $queryDelete);
if ($resultDelete) {
    $queryUpdate = "UPDATE order_header SET total_harga = '$totalUpdate' WHERE id_order_header = '$idHeader'";
    $resultUpdate = mysqli_query($conn, $queryUpdate);

    if ($resultUpdate) { ?>
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

<?php } else { ?>
    <script type="text/javascript">
        alert("Gagal dihapus: <?= mysqli_error($conn); ?>");
        window.location.href = "<?= $base_url . 'owner/billing.php' ?>";
    </script>
<?php }
?>