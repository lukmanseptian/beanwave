<?php

include("../koneksi.php");
include("validasiOwner.php");
$nama = $_POST['nama'];
$keterangan = $_POST["keterangan"];

$query = "INSERT INTO metode_pembayaran (nama_metode_pembayaran,keterangan_metode_pembayaran)  VALUES ('$nama', '$keterangan')";
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