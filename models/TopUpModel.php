<?php

require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../node/nodeTopUp.php';

class TopUpModel {
    private $table = "topup";

    // Fungsi untuk menambahkan transaksi top-up
    public function tambahTopUp(NodeTopUp $topUp) {
        global $db;

        $query = "INSERT INTO $this->table (userId, jumlahPoint, tanggal, status) 
                  VALUES ('{$topUp->userId}', '{$topUp->jumlahPoint}', '{$topUp->tanggal}', '{$topUp->status}')";
        mysqli_query($db, $query);
        return mysqli_affected_rows($db);
    }

    // Fungsi untuk memperbarui status top-up (misalnya, disetujui admin)
    public function updateStatusTopUp($id, $statusBaru) {
        global $db;
        $query = "UPDATE $this->table SET status = '$statusBaru' WHERE id = $id";
        mysqli_query($db, $query);
        return mysqli_affected_rows($db);
    }

    // Fungsi untuk menghapus data top-up berdasarkan id
    public function hapusTopUp($id) {
        global $db;

        $query = "DELETE FROM $this->table WHERE id = $id";
        mysqli_query($db, $query);
        return mysqli_affected_rows($db);
    }

    // Fungsi untuk mendapatkan data top-up berdasarkan id
    public function getTopUpById($id) {
        global $db;
        $id = mysqli_real_escape_string($db, $id);

        $query = "SELECT * FROM $this->table WHERE id = $id";
        $result = mysqli_query($db, $query);
        return mysqli_fetch_assoc($result);
    }

    // Fungsi untuk mendapatkan semua data top-up dengan opsi filter (misalnya berdasarkan userId)
    public function getTopUpList() {
        global $db;
        $query = "SELECT topup.*, users.nama AS namaUser 
                  FROM topup 
                  JOIN users ON topup.userId = users.id
                  ORDER BY topup.tanggal ASC"; // Urutkan dari lama ke baru
        $result = mysqli_query($db, $query);
        $topUpList = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $topUpList[] = $row;
        }
        return $topUpList;
    }
    
}
?>
