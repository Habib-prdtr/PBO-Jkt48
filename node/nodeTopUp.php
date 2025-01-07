<?php

// Abstract class untuk TopUp
abstract class TopUpAbstract {
    public $id;
    public $userId;
    public $jumlahPoint;
    public $tanggal;
    public $status;

    public function __construct($id, $userId, $jumlahPoint, $tanggal, $status) {
        $this->id = $id;
        $this->userId = $userId;
        $this->jumlahPoint = $jumlahPoint;
        $this->tanggal = $tanggal;
        $this->status = $status;
    }
}

// Class turunan dengan implementasi tambahan untuk TopUp
class NodeTopUp extends TopUpAbstract {
    public function __construct($id, $userId, $jumlahPoint, $tanggal, $status) {
        parent::__construct($id, $userId, $jumlahPoint, $tanggal, $status);
    }

    public function approveTopUp() {
        $this->status = 'approved';
    }

    public function rejectTopUp() {
        $this->status = 'rejected';
    }
}

?>
