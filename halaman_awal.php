<?php 
include "koneksi.php";

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Awal - Data Anak dan Kegiatan Ramadhan</title>
    <style>
        body {
            background-color: #9DC183;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            background-color: white;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: black;
            color: white;
        }
        h1, p {
            text-align: center;
        }
        .logo{
            display: block;
            margin: 0 auto 20px;
        }
        .button-box {
            display: inline-block;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin-right: 10px;
        }
        .button-blue {
            background-color: blue;
            color: white;
        }
        .button-yellow {
            background-color: yellow;
            color: black;
        }
        .button-red {
            background-color: red;
            color: white;
        }
        .button-container {
            display: inline-block;
        }
        .button-container button {
            margin-right: 0;
        }
        .button-container a {
            margin-right: 10px;
        }
    </style>
</head>
<body>
    <img src="Ramadhanku.png" alt="Logo Ramadhan" class="logo">
    <h1>Data Anak dan Kegiatan Ramadhan</h1>
    <p>Daftar Nama Anak dan Umurnya</p>

    <table border="1">
        <tr>
            <th>No</th>
            <th>Nama Anak</th>
            <th>Umur</th>
            <th>Action</th>
        </tr>
        <?php

        $sql = "SELECT * FROM anak";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            $no = 1;
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>".$no."</td>";
                echo "<td>".$row['nama']."</td>";
                echo "<td>".(date("Y") - $row['thn_lahir'])." thn</td>";
                echo "<td class='button-container'>
                        <a class='button-box button-blue' href='tambah_kegiatan.php?id_anak=".$row['id_anak']."'>Tambah Kegiatan</a>
                        <a class='button-box button-yellow' href='rekap_kegiatan.php?id_anak=".$row['id_anak']."'>Lihat Rekap</a>
                    </td>";
                echo "</tr>";
                $no++;
            }
        } else {
            echo "<tr><td colspan='4'>Tidak ada data</td></tr>";
        }
        ?>
    </table>

    <footer>
        <p>&copy; <?php echo date('Y'); ?> Website Ramadhanku Dibuat Oleh Sandy Nicholas 22081010237</p>
    </footer>
</body>
</html>