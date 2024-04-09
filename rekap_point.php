<?php 
include "koneksi.php";

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if(isset($_GET['id_anak'])) {
    $id_anak = $_GET['id_anak'];
} else {
    header("Location: index.php");
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rekap Point - Data Anak dan Kegiatan Ramadhan</title>
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
        .red {
            background-color: red;
        }
    </style>
</head>
<body>
    <img src="Ramadhanku.png" alt="Logo Ramadhan" class="logo">
    <h1>Rekap Point - Data Anak dan Kegiatan Ramadhan</h1>
    <p>Rekap Point Setiap Anak</p>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Anak</th>
                <th>Jumlah Point</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $sql = "SELECT anak.id_anak, anak.nama, 
                    SUM(
                        IF(kegiatan.tarawih = 1, 10, 0) + 
                        IF(kegiatan.baca_alquran = 1, 20, 0) + 
                        IF(kegiatan.sedekah = 1, 20, 0) + 
                        IF(kegiatan.puasa = 1 AND kegiatan.puasa >= 20, CEIL(50 * 1.3), IF(kegiatan.puasa = 1, 50, 0))
                    ) AS total_points
                    FROM anak
                    LEFT JOIN kegiatan ON anak.id_anak = kegiatan.id_anak
                    WHERE anak.id_anak='$id_anak'
                    GROUP BY anak.id_anak, anak.nama";
            $result = mysqli_query($conn, $sql);
            if (mysqli_num_rows($result) > 0) {
                $no = 1;
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>".$no++."</td>";
                    echo "<td>".$row['nama']."</td>";
                    echo "<td>".$row['total_points']." point</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='3'>Tidak ada data</td></tr>";
            }
            ?>
        </tbody>
    </table>

    <footer>
        <p>&copy; <?php echo date('Y'); ?> Website Ramadhanku Dibuat Oleh Sandy Nicholas 22081010237</p>
    </footer>
</body>
</html>