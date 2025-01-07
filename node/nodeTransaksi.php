<?php

// Interface untuk definisi umum Transaksi

// Abstract class untuk Transaksi Tiket
abstract class TransaksiTiketAbstract {
    public $id;
    public $userId;
    public $eventId;
    public $jumlahTiket;
    public $totalHarga;
    public $tanggal;

    public function __construct($id, $userId, $eventId, $jumlahTiket, $totalHarga, $tanggal) {
        $this->id = $id;
        $this->userId = $userId;
        $this->eventId = $eventId;
        $this->jumlahTiket = $jumlahTiket;
        $this->totalHarga = $totalHarga;
        $this->tanggal = $tanggal;
    }
}

// Class turunan dengan implementasi tambahan untuk Transaksi Tiket
class TransaksiTiket extends TransaksiTiketAbstract {
    public $bayar;
    public $kembalian;

    public function __construct($id, $userId, $eventId, $jumlahTiket, $totalHarga, $tanggal, $bayar, $kembalian) {
        parent::__construct($id, $userId, $eventId, $jumlahTiket, $totalHarga, $tanggal);
        $this->bayar = $bayar;
        $this->kembalian = $kembalian;
    }
}
?>
