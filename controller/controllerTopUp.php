<?php
session_start();
require_once __DIR__ . '/../models/TopUpModel.php';
require_once __DIR__ . '/../models/UserModel.php';

class TopUpController
{
    private $obj_topUp;
    private $obj_user;

    public function __construct()
    {
        $this->obj_topUp = new TopUpModel();
        $this->obj_user = new UserModel();
    }

    public function input()
    {
        include '../user/topUp.php';
    }

    public function add()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Check if the session has 'userId'
            if (!isset($_SESSION['user_id']) || empty($_SESSION['user_id'])) {
                echo "<script>alert('User ID tidak ditemukan. Silakan login terlebih dahulu.');</script>";
                return;
            }

            $userId = $_SESSION['user_id']; // Session value for userId
            $jumlahPoint = $_POST['buy_points']; // Corrected to 'buy_points' from form
            $tanggalTopUp = date('Y-m-d H:i:s');
            $status = 'pending';
            $bayar = $_POST['bayar'];

            if ($bayar < $jumlahPoint) {
                echo "<script>alert('Jumlah bayar tidak mencukupi. Silakan bayar sebesar Rp. " . number_format($jumlahPoint, 0, ',', '.') . " atau lebih.');</script>";
                echo "<script>window.location.href='../admin/index.php?modul=topUp&fitur=input';</script>";
                return;

            }

            $newTopUp = new NodeTopUp(null, $userId, $jumlahPoint, $tanggalTopUp, $status);
            $result = $this->obj_topUp->tambahTopUp($newTopUp);

            if ($result > 0) {
                echo "<script>alert('TopUp Sedang Diproses, silahkan tunggu!');</script>";
                echo "<script>window.location.href='../user/profile.php';</script>";
            } else {
                echo "<script>alert('Gagal menambahkan top-up.');</script>";
            }
        }
    }

    public function approve()
    {
        $id = $_GET['id'];
        $topUpData = $this->obj_topUp->getTopUpById($id);
        if ($topUpData) {
            // Update status to 'approved'
            $status = 'approved';

            // Perbarui saldo user jika status disetujui
            $userId = $topUpData['userId'];
            $jumlahPoint = $topUpData['jumlahPoint'];
            $user = $this->obj_user->getUserById($userId);

            if ($user) {
                $newSaldo = $user['saldo'] + $jumlahPoint;
                $this->obj_user->updateSaldo($userId, $newSaldo);
            }

            // Update the top-up status to 'approved'
            $result = $this->obj_topUp->updateStatusTopUp($id, $status);
            if ($result > 0) {
                echo "<script>alert('Top-up berhasil disetujui!');</script>";
                header("Location: index.php?modul=topUp");
            } else {
                echo "<script>alert('Gagal menyetujui top-up.');</script>";
            }
        } else {
            echo "<script>alert('Top-up tidak ditemukan!');</script>";
        }
    }

    public function reject()
    {
        $id = $_GET['id'];
        $topUpData = $this->obj_topUp->getTopUpById($id);
        if ($topUpData) {
            // Update status to 'rejected'
            $status = 'rejected';

            // Update the top-up status to 'rejected'
            $result = $this->obj_topUp->updateStatusTopUp($id, $status);
            if ($result > 0) {
                echo "<script>alert('Top-up berhasil ditolak!');</script>";
                header("Location: index.php?modul=topUp");
            } else {
                echo "<script>alert('Gagal menolak top-up.');</script>";
            }
        } else {
            echo "<script>alert('Top-up tidak ditemukan!');</script>";
        }
    }

    public function delete()
    {
        $id = $_GET['id'];
        $result = $this->obj_topUp->hapusTopUp($id);

        if ($result > 0) {
            echo "<script>alert('Top-up berhasil dihapus!');</script>";
        } else {
            echo "<script>alert('Gagal menghapus top-up.');</script>";
        }
        header("Location: index.php?modul=topUp");
    }

    public function list()
    {
        $topUps = $this->obj_topUp->getTopUpList();
        include "../admin/listTopUp.php";
    }
}
?>
