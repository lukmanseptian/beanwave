<?php

include("koneksi.php");
$username = $_POST['username'];
$password = $_POST["password"];

$sql = "SELECT * FROM user WHERE username = '" . $username . "'";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
  // output data of each row
  $row = mysqli_fetch_assoc($result);
  if ($row['password'] == $password) {
    session_start();
    $_SESSION["username"] = $row['username'];
    if ($row["id_role"] == 1) {
      header('Location:' . $base_url . "owner/home.php");
    } else {
      header('Location:' . $base_url . "kasir/home.php");
    }
  } else { ?>
    <script type="text/javascript">
      alert("Password salah");
      window.location.href = "login.php";
    </script>
  <?php }
} else { ?>
  <script type="text/javascript">
    alert("Username tidak terdaftar");
    window.location.href = "login.php";
  </script>
<?php }
?>