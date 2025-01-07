<?php

require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../node/nodeTransaksi.php';

class TransaksiTiketModel {
    private $table = "transaksitiket";

    // Fungsi untuk menambahkan transaksi tiket
    public function tambahTransaksi(TransaksiTiket $transaksiTiket) {
        global $db;

        $query = "INSERT INTO $this->table (userId, eventId, jumlahTiket, totalHarga, tanggal, bayar, kembalian) 
                  VALUES ('{$transaksiTiket->userId}', " . ($transaksiTiket->eventId === null ? "NULL" : "'{$transaksiTiket->eventId}'") . ", " . ($transaksiTiket->jumlahTiket === null ? "NULL" : "'{$transaksiTiket->jumlahTiket}'") . ", '{$transaksiTiket->totalHarga}', '{$transaksiTiket->tanggal}', '{$transaksiTiket->bayar}', '{$transaksiTiket->kembalian}')";
        mysqli_query($db, $query);
        return mysqli_affected_rows($db);
    }

    // Fungsi untuk memperbarui data transaksi tiket berdasarkan id
    public function updateTransaksi($id, TransaksiTiket $transaksiTiket) {
        global $db;

        $query = "UPDATE $this->table 
                  SET userId = '{$transaksiTiket->userId}', 
                      eventId = '{$transaksiTiket->eventId}', 
                      jumlahTiket = '{$transaksiTiket->jumlahTiket}', 
                      totalHarga = '{$transaksiTiket->totalHarga}', 
                      tanggal = '{$transaksiTiket->tanggal}', 
                      bayar = '{$transaksiTiket->bayar}', 
                      kembalian = '{$transaksiTiket->kembalian}' 
                  WHERE id = $id";
        mysqli_query($db, $query);
        return mysqli_affected_rows($db);
    }

    // Fungsi untuk menghapus data transaksi tiket berdasarkan id
    public function hapusTransaksi($id) {
        global $db;

        $query = "DELETE FROM $this->table WHERE id = $id";
        mysqli_query($db, $query);
        return mysqli_affected_rows($db);
    }

    // Fungsi untuk mendapatkan data transaksi tiket berdasarkan id
    public function getTransaksiById($id) {
        global $db;
        $id = mysqli_real_escape_string($db, $id);

        $query = "SELECT * FROM $this->table WHERE id = $id";
        $result = mysqli_query($db, $query);
        return mysqli_fetch_assoc($result);
    }

    // Fungsi untuk mendapatkan semua data transaksi tiket
    public function getTransaksiList() {
        global $db;
        $query = "SELECT transaksitiket.*, 
                 users.nama AS namaUser, 
                 events.nama AS namaEvent
          FROM transaksitiket
          LEFT JOIN users ON transaksitiket.userId = users.id
          LEFT JOIN events ON transaksitiket.eventId = events.id
          ORDER BY transaksitiket.tanggal ASC";

        $result = mysqli_query($db, $query);
        $transaksiList = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $transaksiList[] = $row;
        }
        return $transaksiList;
    }
}
?>
