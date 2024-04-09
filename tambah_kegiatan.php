<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Data Kegiatan - Aktivitas Ramadhan</title>
    <style>
        body {
            background-image: url("Background.png");
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center;
            background-attachment: fixed;
        }

        .form-box {
            width: 400px;
            margin: 50px auto;
            padding: 20px;
            border: 2px solid black;
            border-radius: 10px;
            background-color: white !important;
        }

        .form-box h1 {
            text-align: center;
        }

        .form-box label {
            display: block;
            margin-bottom: 10px;
        }

        .form-box input[type="text"] {
            width: 100%;
            padding: 8px;
            margin-bottom: 15px;
            box-sizing: border-box;
        }

        .form-box input[type="checkbox"] {
            margin-right: 5px;
        }

        .form-box button[type="submit"] {
            background-color: #4caf50;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            width: 100%;
        }

        .form-box button[type="submit"]:hover {
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
    <div class="form-box">
        <h1>Tambah Data Kegiatan - Aktivitas Ramadhan</h1>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
            <label for="id_anak">ID Anak:</label>
            <input type="text" id="id_anak" name="id_anak" required><br><br>

            <label for="ramadhan_ke">Ramadhan ke:</label>
            <input type="text" id="ramadhan_ke" name="ramadhan_ke" required><br><br>

            <label for="tanggal">Tanggal:</label>
            <input type="date" id="tanggal" name="tanggal" required><br><br>

            <label>Pilih Kegiatan:</label><br>
            <input type="checkbox" id="tarawih" name="tarawih" value="1">
            <label for="tarawih">Tarawih</label><br>
            <input type="checkbox" id="baca_alquran" name="baca_alquran" value="1">
            <label for="baca_alquran">Baca Al-Quran</label><br>
            <input type="checkbox" id="sedekah" name="sedekah" value="1">
            <label for="sedekah">Sedekah</label><br><br>
            <input type="checkbox" id="puasa" name="puasa" value="1">
            <label for="puasa">Puasa</label><br>

            <button type="submit" value="Submit">Tambah</button>
        </form>
    </div>

    <div id="popupSuccess" class="popup">
        <div class="success-animation">&#10003;</div>
        <p>Data berhasil ditambahkan</p>
    </div>

    <div id="popupError" class="popup">
        <div class="error-animation">&#10007;</div>
        <p>Error: Gagal menambahkan data</p>
    </div>

    <?php
    include "koneksi.php";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $id_anak = $_POST["id_anak"];
        $ramadhan_ke = $_POST["ramadhan_ke"];
        $tanggal = $_POST["tanggal"];
        $puasa = isset($_POST["puasa"]) ? 1 : 0;
        $baca_alquran = isset($_POST["baca_alquran"]) ? 1 : 0;
        $tarawih = isset($_POST["tarawih"]) ? 1 : 0;
        $sedekah = isset($_POST["sedekah"]) ? 1 : 0;

        $sql = "INSERT INTO kegiatan (id_anak, ramadhan_ke, tanggal, puasa, baca_alquran, tarawih, sedekah) 
                VALUES ('$id_anak', '$ramadhan_ke', '$tanggal', '$puasa', '$baca_alquran', '$tarawih', '$sedekah')";

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