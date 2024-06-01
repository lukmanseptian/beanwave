<?php

include("../koneksi.php");
include("validasiOwner.php");
$id = $_POST['id'];
$nama = $_POST['nama'];
$kategori = $_POST["kategori"];
$harga = $_POST["harga"];
$status = $_POST["status"];
$foto = $_POST["foto_lama"];

// Check if image file is a actual image or fake image
if ($_FILES["foto"]["tmp_name"] != null) {
    // upload foto menu
    $target_dir = "../assets/img/menu/";
    $newFoto = time() . basename($_FILES["foto"]["name"]);
    $target_file = $target_dir . $newFoto;
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    $check = getimagesize($_FILES["foto"]["tmp_name"]);
    if ($check !== false) {
        if (move_uploaded_file($_FILES["foto"]["tmp_name"], $target_file)) {
            $foto = $newFoto;
        } else { ?>
            <script type="text/javascript">
                alert("Gagal upload: <?= $_FILES["foto"]["error"] ?>");
                window.location.href = "<?= $base_url . 'owner/menu.php' ?>";
            </script>
        <?php
        }
    } else { ?>
        <script type="text/javascript">
            alert("File yang diupload bukan gambar");
            window.location.href = "<?= $base_url . 'owner/menu.php' ?>";
        </script>
    <?php }
}

$query = "UPDATE menu SET nama_menu = '$nama',kategori ='$kategori', harga = '$harga', foto = '$foto', status_menu ='$status' WHERE id_menu = '$id'";
$result = mysqli_query($conn, $query);

if ($result) { ?>
    <script type="text/javascript">
        alert("Berhasil disimpan");
        window.location.href = "<?= $base_url . 'owner/menu.php' ?>";
    </script>
<?php } else { ?>
    <script type="text/javascript">
        alert("Gagal disimpan: <?= mysqli_error($conn); ?>");
        window.location.href = "<?= $base_url . 'owner/menu.php' ?>";
    </script>
<?php }
?>