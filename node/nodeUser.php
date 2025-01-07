<?php

// Interface untuk definisi umum User

// Abstract class untuk User JKT48
abstract class UserJktAbstract {
    public $id;
    public $nama;
    public $foto;
    public $email;
    public $password;
    public $tipeUser;
    public $jenisKelamin;
    public $tanggalLahir;
    public $alamat;

    public function __construct($id, $foto, $nama, $email, $password, $tipeUser, $jenisKelamin, $tanggalLahir, $alamat) {
        $this->id = $id;
        $this->foto = $foto;
        $this->nama = $nama;
        $this->email = $email;
        $this->password = $password;
        $this->tipeUser = $tipeUser;
        $this->jenisKelamin = $jenisKelamin;
        $this->tanggalLahir = $tanggalLahir;
        $this->alamat = $alamat;
    }
}

// Class turunan dengan implementasi tambahan untuk User
class UserJkt extends UserJktAbstract {
    public $saldo;
    public $idMemberJkt;

    public function __construct($id, $foto, $nama, $email, $password, $tipeUser, $jenisKelamin, $tanggalLahir, $alamat, $saldo, $idMemberJkt) {
        parent::__construct($id, $foto, $nama, $email, $password, $tipeUser, $jenisKelamin, $tanggalLahir, $alamat);
        $this->saldo = $saldo;
        $this->idMemberJkt = $idMemberJkt;
    }
}
?>
