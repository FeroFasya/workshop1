<?php
$servername = "localhost"; // Ganti dengan nama server database kamu
$username = "root"; // Ganti dengan username database kamu
$password = ""; // Ganti dengan password database kamu
$dbname = "joy_db"; // Ganti dengan nama database kamu

// Buat koneksi ke database
$conn = new mysqli($servername, $username, $password, $dbname);

// Periksa koneksi
if ($conn->connect_error) {
    // Jika gagal koneksi, kirimkan respon error
    echo json_encode(['status' => 'error', 'message' => 'Koneksi gagal: ' . $conn->connect_error]);
    exit();
}

// Ambil data dari formulir
$name = $_POST['name'];
$game_id = $_POST['game_id'];
$reason = $_POST['reason'];

// Siapkan dan eksekusi query
$sql = "INSERT INTO contacts (name, game_id, reason) VALUES (?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sss", $name, $game_id, $reason);

if ($stmt->execute()) {
    // Jika berhasil, kirimkan respon sukses
    echo json_encode(['status' => 'success', 'message' => 'Data berhasil dikirim!']);
} else {
    // Jika gagal, kirimkan respon error
    echo json_encode(['status' => 'error', 'message' => 'Terjadi kesalahan: ' . $stmt->error]);
}

// Tutup koneksi
$stmt->close();
$conn->close();
?>
