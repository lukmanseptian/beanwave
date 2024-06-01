<?php

include("../koneksi.php");
include("validasiOwner.php");
$nama = $_POST['nama'];
$icon = $_POST["icon"];

$query = "INSERT INTO kategori_menu (nama_kategori_menu,icon_kategori_menu)  VALUES ('$nama', '$icon')";
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