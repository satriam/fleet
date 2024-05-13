<?php
header('Content-Type: application/json');

// Ambil data dari permintaan POST
$enteredPassword = isset($_POST['password']) ? $_POST['password'] : null;

if ($enteredPassword === null) {
    http_response_code(400); // Bad Request
    echo json_encode(['success' => false, 'error' => 'Invalid password data']);
} else {
    // Lakukan verifikasi kata sandi dari database
    $verificationResult = verifyPassword($enteredPassword);

    if ($verificationResult['success']) {
        // Verifikasi berhasil
        echo json_encode(['success' => true]);
    } else {
        // Verifikasi gagal
        echo json_encode(['success' => false, 'error' => $verificationResult['error']]);
    }
}

// Fungsi untuk verifikasi kata sandi
function verifyPassword($enteredPassword) {
    // Gantilah kredensial database sesuai dengan yang Anda gunakan
    include "config.php";
    // $hashedPassword = password_hash($enteredPassword, PASSWORD_DEFAULT);
    // Ambil kata sandi dan status aktif dari database
    $query = "SELECT password_hash, active FROM verify ";
    $result = $conn->query($query);

    // Periksa apakah ada hasil dari query
    if ($result) {
        while ($row = $result->fetch_assoc()) {
            $storedPasswordHash = $row['password_hash'];
            $isActive = $row['active'];
           
            // Periksa apakah akun aktif
            if ($isActive) {
                // Verifikasi kata sandi
                if (password_verify($enteredPassword, $storedPasswordHash)) {
                    // Kata sandi cocok, akun aktif
                    // Tutup koneksi
                    $conn->close();
                    return ['success' => true];
                }
            } else {
                // Akun tidak aktif
                $conn->close();
                return ['success' => false, 'error' => 'Inactive account'];
            }
        }
        // Kata sandi tidak cocok
        $conn->close();
        return ['success' => false, 'error' => 'Incorrect password'];
    } else {
        // Handle query error
        $conn->close();
        return ['success' => false, 'error' => 'Query error: ' . $conn->error];
    }
}
?>
