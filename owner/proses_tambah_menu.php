<?php

include("../koneksi.php");
include("validasiOwner.php");
$nama = $_POST['nama'];
$kategori = $_POST["kategori"];
$harga = $_POST["harga"];
$status = $_POST["status"];
$foto = time() . basename($_FILES["foto"]["name"]);

// upload foto menu
$target_dir = "../assets/img/menu/";
$target_file = $target_dir . $foto;
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
// Check if image file is a actual image or fake image
if (isset($_POST["submit"])) {
    $check = getimagesize($_FILES["foto"]["tmp_name"]);
    if ($check !== false) {
        if (move_uploaded_file($_FILES["foto"]["tmp_name"], $target_file)) {
            $query = "INSERT INTO menu (nama_menu,kategori, harga, foto, status_menu)  VALUES ('$nama', '$kategori', '$harga', '$foto', '$status')";
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
?>