<?php

include("../koneksi.php");
include("validasiOwner.php");
$username = $_POST['username'];
$password = $_POST["password"];
$nama = $_POST["nama"];
$role = $_POST["role"];

$query = "UPDATE user SET nama_user = '$nama', password = '$password', id_role ='$role' WHERE username = '$username'";
$result = mysqli_query($conn, $query);

if ($result) { ?>
   <script type="text/javascript">
      alert("Berhasil disimpan");
      window.location.href = "<?= $base_url . 'owner/user.php' ?>";
   </script>

<?php } else { ?>


   <script type="text/javascript">
      alert("Gagal disimpan: <?= mysqli_error($conn); ?>");
      window.location.href = "<?= $base_url . 'owner/user.php' ?>";
   </script>
<?php }
?>