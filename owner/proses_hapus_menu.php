<?php
include('../koneksi.php');
include("validasiOwner.php");
$id = $_POST['id_menu'];
$query = "DELETE FROM menu WHERE id_menu = '" . $id . "'";

$result = mysqli_query($conn, $query);

if ($result) { ?>
    <script type="text/javascript">
        alert("Berhasil dihapus");
        window.location.href = "<?= $base_url . 'owner/menu.php' ?>";
    </script>

<?php } else { ?>


    <script type="text/javascript">
        alert("Gagal dihapus: <?= mysqli_error($conn); ?>");
        window.location.href = "<?= $base_url . 'owner/menu.php' ?>";
    </script>
<?php }
?>