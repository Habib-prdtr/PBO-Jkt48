<?php

// Abstract class untuk member JKT48
abstract class MemberJktAbstract {
    public $id;
    public $foto;
    public $nama;
    public $tanggalLahir;

    public function __construct($id, $foto, $nama, $tanggalLahir) {
        $this->id = $id;
        $this->foto = $foto;
        $this->nama = $nama;
        $this->tanggalLahir = $tanggalLahir;
    }

    abstract public function getMemberDetail();
}

// Class turunan dengan implementasi tambahan
class MemberJkt extends MemberJktAbstract {
    public $golonganDarah;
    public $horoskop;
    public $tinggiBadan;

    public function __construct($id, $foto, $nama, $tanggalLahir, $golonganDarah, $horoskop, $tinggiBadan) {
        parent::__construct($id, $foto, $nama, $tanggalLahir);
        $this->golonganDarah = $golonganDarah;
        $this->horoskop = $horoskop;
        $this->tinggiBadan = $tinggiBadan;
    }

    public function getMemberDetail() {
        return [
            'ID' => $this->id,
            'Foto' => $this->foto,
            'Nama' => $this->nama,
            'Tanggal Lahir' => $this->tanggalLahir,
            'Golongan Darah' => $this->golonganDarah,
            'Horoskop' => $this->horoskop,
            'Tinggi Badan' => $this->tinggiBadan
        ];
    }
}
?>
