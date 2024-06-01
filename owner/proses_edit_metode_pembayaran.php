<?php

include("../koneksi.php");
include("validasiOwner.php");
$id = $_POST['id'];
$nama = $_POST['nama'];
$keterangan = $_POST["keterangan"];

$query = "UPDATE metode_pembayaran SET nama_metode_pembayaran = '$nama', keterangan_metode_pembayaran = '$keterangan' WHERE id_metode_pembayaran = '$id'";
$result = mysqli_query($conn, $query);

if ($result) { ?>
    <script type="text/javascript">
        alert("Berhasil disimpan");
        window.location.href = "<?= $base_url . 'owner/metode_pembayaran.php' ?>";
    </script>

<?php } else { ?>


    <script type="text/javascript">
        alert("Gagal disimpan: <?= mysqli_error($conn); ?>");
        window.location.href = "<?= $base_url . 'owner/metode_pembayaran.php' ?>";
    </script>
<?php }
?>