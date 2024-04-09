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

// Dapatkan informasi nama dan umur anak
$sql_info_anak = "SELECT nama FROM anak WHERE id_anak='$id_anak'";
$result_info_anak = mysqli_query($conn, $sql_info_anak);
$info_anak = mysqli_fetch_assoc($result_info_anak);
$nama = $info_anak['nama'];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rekap Kegiatan - Data Anak dan Kegiatan Ramadhan</title>
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
    <h1>Rekap Kegiatan Ramadhan</h1>
    <p>Rekap Kegiatan Setiap Anak</p>

    <h2>Nama : <?php echo $nama; ?></h2>

    <table border="1">
        <tr>
            <th>Ramadhan ke-</th>
            <th>Tanggal</th>
            <th>Sholat Tarawih</th>
            <th>Baca Al-Quran</th>
            <th>Sedekah</th>
            <th>Puasa</th>
            <th>Points</th>
            <th>Action</th>
        </tr>
        <?php
        $sql = "SELECT * FROM kegiatan WHERE id_anak='$id_anak'";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            $total_points = 0;
            while ($row = mysqli_fetch_assoc($result)) {
                $points = 0;
                if(isset($row['tarawih']) && $row['tarawih'] == 1) $points += 10;
                if(isset($row['baca_alquran']) && $row['baca_alquran'] == 1) $points += 20;
                if(isset($row['sedekah']) && $row['sedekah'] == 1) $points += 20;
                if(isset($row['puasa']) && $row['puasa'] == 1) {
                    $points += 50;
                }

                $total_points += $points;

                echo "<tr>";
                echo "<td>Hari ".$row['ramadhan_ke']."</td>";
                echo "<td>".$row['tanggal']."</td>";
                echo "<td>".(isset($row['tarawih']) && $row['tarawih'] == 1 ? 'v' : '<span class="red">x</span>')."</td>";
                echo "<td>".(isset($row['baca_alquran']) && $row['baca_alquran'] == 1 ? 'v' : '<span class="red">x</span>')."</td>";
                echo "<td>".(isset($row['sedekah']) && $row['sedekah'] == 1 ? 'v' : '<span class="red">x</span>')."</td>";
                echo "<td>".(isset($row['puasa']) && $row['puasa'] == 1 ? 'v' : '<span class="red">x</span>')."</td>";
                echo "<td>".$points."</td>";
                echo "<td>
                        <a class='button-box button-yellow' href='ubah_kegiatan.php?id_kegiatan=".$row['id_kegiatan']."'>Ubah</a>
                        <a class='button-box button-red' href='hapus_kegiatan.php?id_kegiatan=".$row['id_kegiatan']."'>Hapus</a>
                        <a class='button-box button-blue' href='rekap_point.php?id_anak=".$id_anak."'>Rekap Point</a>
                    </td>";
                echo "</tr>";
            }
            echo "<tr>";
            echo "<td colspan='6' style='text-align: right;'>TOTAL</td>";
            echo "<td>".$total_points." POINTS</td>";
            echo "<td></td>";
            echo "</tr>";
        } else {
            echo "<tr><td colspan='8'>Tidak ada data</td></tr>";
        }
        ?>
    </table>

    <footer>
        <p>&copy; <?php echo date('Y'); ?> Website Ramadhanku Dibuat Oleh Sandy Nicholas 22081010237</p>
    </footer>
</body>
</html>