<?php

include("../koneksi.php");
include("validasiOwner.php");
$username = $_POST['username'];
$password = $_POST["password"];
$nama = $_POST["nama"];
$role = $_POST["role"];

$query = "INSERT INTO user VALUES ('$username', '$nama', '$password', '$role')";
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