<?php
// Koneksi ke database
$host = "localhost";
$username = "root";
$password = "";
$database = "ramadhanku";

$conn = mysqli_connect($host, $username, $password, $database);

if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>