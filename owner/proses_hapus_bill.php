<?php
include('../koneksi.php');
include("validasiOwner.php");
$id = $_POST['id_order'];

$query = "DELETE FROM order_header WHERE id_order_header = '" . $id . "'";

$result = mysqli_query($conn, $query);

if ($result) {
    $query2 = "DELETE FROM order_detail WHERE id_order_header = '" . $id . "'";
    $result2 = mysqli_query($conn, $query2);
    if ($result2) {
?>
        <script type="text/javascript">
            alert("Berhasil dihapus");
            window.location.href = "<?= $base_url . 'owner/billing.php' ?>";
        </script>

    <?php } else { ?>
        <script type="text/javascript">
            alert("Gagal dihapus: <?= mysqli_error($conn); ?>");
            window.location.href = "<?= $base_url . 'owner/billing.php' ?>";
        </script>
    <?php }
} else { ?>
    <script type="text/javascript">
        alert("Gagal dihapus: <?= mysqli_error($conn); ?>");
        window.location.href = "<?= $base_url . 'owner/billing.php' ?>";
    </script>
<?php }
?>