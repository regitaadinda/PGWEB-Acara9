<?php
// Mengoneksikan ke database sesuai dengan setting MySQL
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "pgweb_acara8";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Cek jika ada ID yang diterima
if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $sql = "SELECT * FROM 7b WHERE id = $id";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
} else {
    die("ID tidak valid.");
}

// Proses form ketika disubmit
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $kecamatan = htmlspecialchars($_POST['kecamatan']);
    $longitude = htmlspecialchars($_POST['longitude']);
    $latitude = htmlspecialchars($_POST['latitude']);
    $luas = htmlspecialchars($_POST['luas']);
    $jumlah_penduduk = htmlspecialchars($_POST['jumlah_penduduk']);

    // Update data ke database
    $sql_update = "UPDATE 7b SET kecamatan='$kecamatan', longitude='$longitude', latitude='$latitude', luas='$luas', jumlah_penduduk='$jumlah_penduduk' WHERE ID=$id";

    if ($conn->query($sql_update) === TRUE) {
        header("Location: index.php"); // Ganti 'index.php' dengan nama file utama Anda
        exit;
    } else {
        echo "Error updating record: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Data</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    <div class="container">
        <h2>Edit Data</h2>
        <form method="POST" action="">
            <div class="mb-3">
                <label for="kecamatan" class="form-label">Kecamatan</label>
                <input type="text" class="form-control" name="kecamatan" value="<?php echo htmlspecialchars($row['kecamatan']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="longitude" class="form-label">Longitude</label>
                <input type="text" class="form-control" name="longitude" value="<?php echo htmlspecialchars($row['longitude']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="latitude" class="form-label">Latitude</label>
                <input type="text" class="form-control" name="latitude" value="<?php echo htmlspecialchars($row['latitude']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="luas" class="form-label">Luas</label>
                <input type="text" class="form-control" name="luas" value="<?php echo htmlspecialchars($row['luas']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="jumlah_penduduk" class="form-label">Jumlah Penduduk</label>
                <input type="number" class="form-control" name="jumlah_penduduk" value="<?php echo htmlspecialchars($row['jumlah_penduduk']); ?>" required>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
</body>
</html>