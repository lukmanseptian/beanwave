<?php
include('../koneksi.php');
include("validasiOwner.php");
$id = $_POST['id_metode_pembayaran'];
$query = "DELETE FROM metode_pembayaran WHERE id_metode_pembayaran = '" . $id . "'";

$result = mysqli_query($conn, $query);

if ($result) { ?>
    <script type="text/javascript">
        alert("Berhasil dihapus");
        window.location.href = "<?= $base_url . 'owner/metode_pembayaran.php' ?>";
    </script>

<?php } else { ?>


    <script type="text/javascript">
        alert("Gagal dihapus: <?= mysqli_error($conn); ?>");
        window.location.href = "<?= $base_url . 'owner/metode_pembayaran.php' ?>";
    </script>
<?php }
?>