<?php
$host = "localhost";
$user = "root";
$pass = "";
$db   = "projekweb";

$mysqli = new mysqli($host, $user, $pass, $db);

if ($mysqli->connect_errno) {
    die("Koneksi database gagal: " . $mysqli->connect_error);
}

$mysqli->set_charset("utf8mb4");
?>
