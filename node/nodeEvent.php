<?php

// Abstract class untuk Event JKT48
abstract class EventJktAbstract{
    public $id;
    public $nama;
    public $foto;
    public $tanggal;
    public $tempat;

    public function __construct($id, $foto, $nama, $tanggal, $tempat) {
        $this->id = $id;
        $this->foto = $foto;
        $this->nama = $nama;
        $this->tanggal = $tanggal;
        $this->tempat = $tempat;
    }
}

// Class turunan dengan implementasi tambahan untuk Event
class EventJkt extends EventJktAbstract {
    public $harga;
    public $stok;
    public $tipeEvent;

    public function __construct($id, $foto, $nama, $tanggal, $tempat, $harga, $stok, $tipeEvent) {
        parent::__construct($id, $foto, $nama, $tanggal, $tempat);
        $this->harga = $harga;
        $this->stok = $stok;
        $this->tipeEvent = $tipeEvent;
    }
}
?>
