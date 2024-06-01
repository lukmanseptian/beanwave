<?php
include('../koneksi.php');
include("validasiOwner.php");
$username = $_POST['username'];
$query = "DELETE FROM user WHERE username = '" . $username . "'";

$result = mysqli_query($conn, $query);

if ($result) { ?>
   <script type="text/javascript">
      alert("Berhasil dihapus");
      window.location.href = "<?= $base_url . 'owner/user.php' ?>";
   </script>

<?php } else { ?>


   <script type="text/javascript">
      alert("Gagal dihapus: <?= mysqli_error($conn); ?>");
      window.location.href = "<?= $base_url . 'owner/user.php' ?>";
   </script>
<?php }
?>