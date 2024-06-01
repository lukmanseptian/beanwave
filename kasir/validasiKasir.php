<?php
include("../koneksi.php");

session_start();
$username = $_SESSION["username"];

$sql = "SELECT * FROM user WHERE username = '" . $username . "'";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    // output data of each row
    $row = mysqli_fetch_assoc($result);
    if ($row['id_role'] != '2') {
?>
        <script>
            window.location.href = "<?= $base_url; ?>owner/home.php";
        </script>;
    <?php
    }
} else {
    ?>
    <script>
        window.location.href = "<?= $base_url; ?>login.php";
    </script>;
<?php
}
