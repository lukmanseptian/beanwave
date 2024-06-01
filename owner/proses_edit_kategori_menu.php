<?php

include("../koneksi.php");
include("validasiOwner.php");
$id = $_POST['id'];
$nama = $_POST['nama'];
$icon = $_POST["icon"];

$query = "UPDATE kategori_menu SET nama_kategori_menu = '$nama', icon_kategori_menu = '$icon' WHERE id_kategori_menu = '$id'";
$result = mysqli_query($conn, $query);

if ($result) { ?>
    <script type="text/javascript">
        alert("Berhasil disimpan");
        window.location.href = "<?= $base_url . 'owner/kategori_menu.php' ?>";
    </script>

<?php } else { ?>


    <script type="text/javascript">
        alert("Gagal disimpan: <?= mysqli_error($conn); ?>");
        window.location.href = "<?= $base_url . 'owner/kategori_menu.php' ?>";
    </script>
<?php }
?>