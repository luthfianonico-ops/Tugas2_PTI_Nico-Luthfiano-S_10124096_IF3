<?php
require 'config.php';
if (isset($_SESSION['login'])) {
    $id = (int)$_GET["id"];
    mysqli_query($conn, "DELETE FROM penerima_mbg WHERE id = $id");
}
header("Location: index.php");
?>