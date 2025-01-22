<?php

require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../node/nodeUser.php';

class UserModel {
    private $table = "users";

    // Fungsi untuk menangani upload gambar
    public function upload() {
        if (!isset($_FILES['foto']) || $_FILES['foto']['error'] !== UPLOAD_ERR_OK) {
            echo "<script>
                    alert('Foto tidak ditemukan atau gagal di-upload!');
                  </script>";
            return false;
        }
    
        $namaFile = $_FILES['foto']['name'];
        $tmpName = $_FILES['foto']['tmp_name'];
    
        // Cek apakah yang di-upload adalah gambar
        $formatGambarValid = ['jpg', 'jpeg', 'png'];
        $formatGambar = explode('.', $namaFile);
        $formatGambar = strtolower(end($formatGambar));
    
        if (!in_array($formatGambar, $formatGambarValid)) {
            echo "<script>
                    alert('Format gambar tidak didukung!');
                  </script>";
            return false;
        }
    
        // Generate nama gambar baru
        $namaFileBaru = uniqid('user_', true) . '.' . $formatGambar;
    
        // Pastikan nama file baru yang digunakan untuk menyimpan file
        $filePath = '../images/user/' . $namaFileBaru;
        if (!move_uploaded_file($tmpName, $filePath)) {
            echo "<script>
                    alert('Gagal memindahkan file gambar!');
                  </script>";
            return false;
        }
    
        return $namaFileBaru;
    }
    
    public function hapusFileGambar($fileName) {
        $filePath = '../images/user/' . $fileName;
        if (file_exists($filePath)) {
            unlink($filePath);
        }
    }

    public function tambahUser(UserJkt $user) {
        global $db;

        $hashedPassword = password_hash($user->password, PASSWORD_DEFAULT);

        $gambar = $this->upload();
        if (!$gambar) {
            return false;
        }

        $query = "INSERT INTO $this->table (foto, nama, email, password, tipeUser, jenisKelamin, tanggalLahir, alamat, saldo, idMemberJkt)
                  VALUES ('{$gambar}', '{$user->nama}', '{$user->email}', '{$hashedPassword}', '{$user->tipeUser}', '{$user->jenisKelamin}', '{$user->tanggalLahir}', '{$user->alamat}', '{$user->saldo}', '{$user->idMemberJkt}')";
        mysqli_query($db, $query);
        return mysqli_affected_rows($db);
    }

    public function hapusUser($id) {
        global $db;

        $user = $this->getUserById($id);
        if ($user && $user['foto']) {
            // Hapus file gambar jika ada
            $this->hapusFileGambar($user['foto']);
        }

        // Hapus data user dari database
        $query = "DELETE FROM $this->table WHERE id = $id";
        mysqli_query($db, $query);

        return mysqli_affected_rows($db);
    }

    // Fungsi untuk memperbarui data user
    public function updateUser($id, UserJkt $user)
{
    global $db;

    if (isset($_FILES['foto']) && $_FILES['foto']['error'] === UPLOAD_ERR_OK) {
        // Upload gambar jika ada file gambar baru
        $gambar = $this->upload();

        // Menghapus gambar lama jika ada
        $userLama = $this->getUserById($id);
        if ($userLama && $userLama['foto']) {
            $this->hapusFileGambar($userLama['foto']);
        }
    } else {
        // Jika tidak ada gambar baru, gunakan gambar lama
        $userLama = $this->getUserById($id);
        $gambar = $userLama['foto'];
    }

    // Jika password diubah, hash password baru
    if (!empty($user->password)) {
        $hashedPassword = password_hash($user->password, PASSWORD_DEFAULT);
    } else {
        // Jika password tidak diubah, gunakan password lama
        $hashedPassword = $userLama['password'];
    }

    // Update data user di database
    $query = "UPDATE $this->table SET 
                foto = '{$gambar}', 
                nama = '{$user->nama}', 
                email = '{$user->email}', 
                password = '{$hashedPassword}', 
                tipeUser = '{$user->tipeUser}', 
                jenisKelamin = '{$user->jenisKelamin}', 
                tanggalLahir = '{$user->tanggalLahir}', 
                alamat = '{$user->alamat}', 
                saldo = '{$user->saldo}', 
                idMemberJkt = '{$user->idMemberJkt}' 
              WHERE id = $id";
    
    mysqli_query($db, $query);
    return mysqli_affected_rows($db);
}


    public function updateSaldo($userId, $newSaldo)
    {
        global $db;
        $query = "UPDATE $this->table SET saldo = $newSaldo WHERE id = $userId";
        mysqli_query($db, $query);
        return mysqli_affected_rows($db);
    }

    public function upgradeTipeUser($id, $newTipeUser) {
        global $db;
    
        // Update tipeUser user di database
        $query = "UPDATE $this->table SET tipeUser = '$newTipeUser' WHERE id = $id";
        mysqli_query($db, $query);
    
        return mysqli_affected_rows($db); // Mengembalikan jumlah baris yang terpengaruh
    }

    // Fungsi untuk mengambil data user berdasarkan id dengan JOIN untuk mendapatkan nama oshimen
    public function getUserById($id) {
        global $db;
        // Pastikan untuk membersihkan input untuk mencegah SQL Injection
        $id = mysqli_real_escape_string($db, $id);
    
        $query = "SELECT users.*, memberjkt.nama AS namaOshimen, memberjkt.foto AS fotoOshimen
                  FROM users
                  LEFT JOIN memberjkt ON users.idMemberJkt = memberjkt.id
                  WHERE users.id = $id";
        
        $result = mysqli_query($db, $query);
        return mysqli_fetch_assoc($result);
    }
    

    public function getUserByEmail($email) {
        global $db;
        $query = "SELECT * FROM $this->table WHERE email = '$email'";
        $result = mysqli_query($db, $query);
        return mysqli_fetch_assoc($result); // Mengembalikan user jika email ditemukan, null jika tidak ada
    }

    public function getSaldoById($id) {
        global $db;
        $query = "SELECT saldo FROM $this->table WHERE id = $id";
        $result = mysqli_query($db, $query);
        return mysqli_fetch_assoc($result)['saldo'];
    }
    
    public function getAllHistory($userId)
    {
        global $db;
        $userId = mysqli_real_escape_string($db, $userId);
        $query = "
            SELECT 
                t.id AS id, 
                t.jumlahPoint AS jumlah, 
                t.tanggal AS Tanggal, 
                t.status AS status, 
                NULL AS eventNama, 
                NULL AS jumlahTiket, 
                NULL AS bayar, 
                NULL AS kembalian, 
                'topUp' AS type
            FROM topup t
            WHERE t.userId = '$userId' AND t.status NOT IN ( 'pending') 
            
            UNION ALL
    
            SELECT 
                tr.id AS id, 
                tr.totalHarga AS jumlah, 
                tr.tanggal AS Tanggal, 
                NULL AS status, 
                e.nama AS eventNama, 
                tr.jumlahTiket AS jumlahTiket, 
                tr.bayar AS bayar, 
                tr.kembalian AS kembalian, 
                'transaksi' AS type
            FROM transaksitiket tr
            LEFT JOIN events e ON tr.eventId = e.id
            WHERE tr.userId = '$userId'
    
            
            ORDER BY Tanggal ASC
        ";
        $result = mysqli_query($db, $query);
    
        if (!$result) {
            die("Query error: " . mysqli_error($db));
        }
    
        // Ambil hasil query
        $history = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $history[] = $row;
        }
    
        return $history;
    }

function getHistoryById($userId, $id) {
    global $db;
    $userId = mysqli_real_escape_string($db, $userId);
    $id = mysqli_real_escape_string($db, $id);
    $query = "
        SELECT 
            t.id AS id, 
            t.jumlahPoint AS jumlah, 
            t.tanggal AS Tanggal, 
            t.status AS status, 
            NULL AS eventNama, 
            NULL AS jumlahTiket, 
            NULL AS bayar, 
            NULL AS kembalian, 
            NULL AS tempat,
            'topUp' AS type
        FROM topup t
        WHERE t.userId = '$userId' AND t.id = '$id' AND t.status NOT IN ( 'pending') 
        
        UNION ALL

        SELECT 
            tr.id AS id, 
            tr.totalHarga AS jumlah, 
            tr.tanggal AS Tanggal, 
            NULL AS status, 
            e.nama AS eventNama, 
            tr.jumlahTiket AS jumlahTiket, 
            tr.bayar AS bayar, 
            tr.kembalian AS kembalian, 
            e.tempat AS tempat,
            'transaksi' AS type
        FROM transaksitiket tr
        LEFT JOIN events e ON tr.eventId = e.id
        WHERE tr.userId = '$userId' AND tr.id = '$id'
    ";
    $result = mysqli_query($db, $query);

    if (!$result) {
        die("Query error: " . mysqli_error($db));
    }

    return mysqli_fetch_assoc($result);
}
}
?>
