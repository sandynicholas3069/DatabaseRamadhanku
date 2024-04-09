<?php 
include "koneksi.php";

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if(isset($_GET['id_kegiatan'])) {
    $id_kegiatan = $_GET['id_kegiatan'];
} else {
    header("Location: index.php");
}

$sql = "SELECT * FROM kegiatan WHERE id_kegiatan='$id_kegiatan'";
$result = mysqli_query($conn, $sql);

if(mysqli_num_rows($result) == 0) {
    echo "Data tidak ditemukan";
    exit();
}

$row = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ubah Data Kegiatan - Aktivitas Ramadhan</title>
    <style>
        body {
            background-image: url("Background.png");
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center;
            background-attachment: fixed;
        }
        .form-container {
            width: 50%;
            margin: 0 auto;
            padding: 20px;
            background-color: white;
            border-radius: 10px;
            box-shadow: 0px 0px 10px 0px rgba(0,0,0,0.5);
            margin-top: 50px;
        }
        .form-container h2 {
            text-align: center;
        }
        .form-group {
            margin-bottom: 20px;
        }
        .form-group label {
            display: block;
            margin-bottom: 5px;
        }
        .form-group input[type="text"], 
        .form-group input[type="date"],
        .form-group select {
            width: 100%;
            padding: 8px;
            border-radius: 5px;
            border: 1px solid #ccc;
            box-sizing: border-box;
        }
        .form-group button {
            padding: 10px 15px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .form-group button:hover {
            background-color: #45a049;
        }
        .popup {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            padding: 20px;
            background-color: white;
            border: 2px solid;
            border-radius: 5px;
            z-index: 9999;
        }
        .success-animation {
            color: #008000;
            font-size: 50px;
            text-align: center;
        }
        .error-animation {
            color: #ff0000;
            font-size: 50px;
            text-align: center;
        }
        .popup p {
            text-align: center;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h2>Ubah Data Kegiatan - Aktivitas Ramadhan</h2>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) . '?id_kegiatan=' . $row['id_kegiatan']; ?>" method="POST">
            <input type="hidden" name="id_kegiatan" value="<?php echo $row['id_kegiatan']; ?>">
            <div class="form-group">
                <label for="ramadhan_ke">Ramadhan ke-</label>
                <input type="number" id="ramadhan_ke" name="ramadhan_ke" value="<?php echo $row['ramadhan_ke']; ?>" required>
            </div>
            <div class="form-group">
                <label for="tanggal">Tanggal</label>
                <input type="date" id="tanggal" name="tanggal" value="<?php echo $row['tanggal']; ?>" required>
            </div>
            <div class="form-group">
                <label for="tarawih">Tarawih</label>
                <select id="tarawih" name="tarawih" required>
                    <option value="1" <?php if($row['tarawih'] == 1) echo 'selected'; ?>>Ya</option>
                    <option value="0" <?php if($row['tarawih'] == 0) echo 'selected'; ?>>Tidak</option>
                </select>
            </div>
            <div class="form-group">
                <label for="baca_alquran">Baca Al-Quran</label>
                <select id="baca_alquran" name="baca_alquran" required>
                    <option value="1" <?php if($row['baca_alquran'] == 1) echo 'selected'; ?>>Ya</option>
                    <option value="0" <?php if($row['baca_alquran'] == 0) echo 'selected'; ?>>Tidak</option>
                </select>
            </div>
            <div class="form-group">
                <label for="sedekah">Sedekah</label>
                <select id="sedekah" name="sedekah" required>
                    <option value="1" <?php if($row['sedekah'] == 1) echo 'selected'; ?>>Ya</option>
                    <option value="0" <?php if($row['sedekah'] == 0) echo 'selected'; ?>>Tidak</option>
                </select>
            </div>
            <div class="form-group">
                <label for="puasa">Puasa</label>
                <select id="puasa" name="puasa" required>
                    <option value="1" <?php if($row['puasa'] == 1) echo 'selected'; ?>>Ya</option>
                    <option value="0" <?php if($row['puasa'] == 0) echo 'selected'; ?>>Tidak</option>
                </select>
            </div>
            <div class="form-group">
                <button type="submit">Ubah Data</button>
            </div>
        </form>
    </div>

    <div id="popupSuccess" class="popup">
        <div class="success-animation">&#10003;</div>
        <p>Data berhasil diubah</p>
    </div>

    <div id="popupError" class="popup">
        <div class="error-animation">&#10007;</div>
        <p>Error: Gagal mengubah data</p>
    </div>

    <?php
    include "koneksi.php";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $id_kegiatan = $_POST["id_kegiatan"];
        $ramadhan_ke = $_POST["ramadhan_ke"];
        $tanggal = $_POST["tanggal"];
        $puasa = isset($_POST["puasa"]) ? 1 : 0;
        $baca_alquran = isset($_POST["baca_alquran"]) ? 1 : 0;
        $tarawih = isset($_POST["tarawih"]) ? 1 : 0;
        $sedekah = isset($_POST["sedekah"]) ? 1 : 0;

        $sql = "UPDATE kegiatan SET ramadhan_ke='$ramadhan_ke', tanggal='$tanggal', puasa='$puasa', baca_alquran='$baca_alquran', tarawih='$tarawih', sedekah='$sedekah' WHERE id_kegiatan='$id_kegiatan'";

        if (mysqli_query($conn, $sql)) {
            echo "<script>
                    document.getElementById('popupSuccess').style.display = 'block';
                    setTimeout(function(){
                        document.getElementById('popupSuccess').style.display = 'none';
                        window.location.href = 'halaman_awal.php';
                    }, 2000);
                </script>";
        } else {
            echo "<script>
                    document.getElementById('popupError').style.display = 'block';
                    setTimeout(function(){
                        document.getElementById('popupError').style.display = 'none';
                        window.location.href = 'halaman_awal.php';
                    }, 2000);
                </script>";
        }
    }
    ?>

</body>
</html>