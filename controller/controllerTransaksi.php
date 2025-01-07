<?php

require_once __DIR__ . '/../models/TransaksiModel.php';
require_once __DIR__ . '/../models/UserModel.php';
require_once __DIR__ . '/../models/EventModel.php';

class TransaksiTiketController
{
    private $obj_transaksiTiket;
    private $obj_user;
    private $obj_event;

    public function __construct()
    {
        $this->obj_transaksiTiket = new TransaksiTiketModel();
        $this->obj_user = new UserModel();
        $this->obj_event = new EventModel();
    }

    public function input()
    {   
        $id = $_GET['id'];
        $event = $this->obj_event->getEventById($id);
        include '../user/tiket.php';
    }

    public function add()
{
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Pastikan user sudah login dengan mengecek session
        if (!isset($_SESSION['user_id']) || empty($_SESSION['user_id'])) {
            echo "<script>alert('User ID tidak ditemukan. Silakan login terlebih dahulu.');</script>";
            return;
        }

        // Ambil ID user dari session
        $userId = $_SESSION['user_id'];
        $eventId = $_POST['event_id']; 
        $jumlahTiket = $_POST['jumlahTiket']; 
        $totalHarga = floatval(str_replace('Rp ', '', $_POST['totalHarga'])); // Menghapus simbol "Rp"
        $tanggalTransaksi = date('Y-m-d H:i:s'); 

        $kembalian = floatval(str_replace('Rp ', '', $_POST['kembalian'])); // Menghapus simbol "Rp"
        $bayar = floatval($_POST['bayar']);

        // Ambil saldo pengguna dan tipe user dari database
        $user = $this->obj_user->getUserById($userId);
        $saldoUser = $user['saldo'];
        $tipeUser = $user['tipeUser']; // Mendapatkan tipe user

        // Cek apakah saldo cukup untuk melakukan pembayaran
        if ($saldoUser < $bayar) {
            echo "<script>alert('Saldo Anda tidak mencukupi, silahkan TopUp terlebih dahulu.');</script>";
            echo "<script>window.location.href='../admin/index.php?modul=topUp&fitur=input';</script>"; 
            return;
        }

        // Ambil stok event dan tipe event dari database
        $event = $this->obj_event->getEventById($eventId);
        $stokEvent = $event['stok'];
        $tipeEvent = $event['tipeEvent']; // Mendapatkan tipe event

        // Pengecekan jika tipe user 'General' mencoba membeli tiket dengan tipe event 'OFC'
        if ($tipeUser === 'General' && $tipeEvent === 'OFC') {
            echo "<script>alert('User dengan tipe General tidak dapat membeli tiket tipe OFC.');</script>";
            echo "<script>window.location.href='../user/profile.php';</script>";
            return;
        }

        // Validasi apakah stok cukup untuk jumlah tiket yang dibeli
        if ($stokEvent < $jumlahTiket) {
            echo "<script>alert('Stok tiket tidak cukup. Hanya tersedia $stokEvent tiket.');</script>";
            echo "<script>window.location.href='../user/profile.php';</script>";
            return;
        }

        // Kurangi stok event sesuai jumlah tiket yang dibeli
        $stokBaru = $stokEvent - $jumlahTiket;

        // Update stok event di database
        $updateStok = $this->obj_event->updateStokEvent($eventId, $stokBaru);

        // Kurangi saldo pengguna sesuai jumlah yang dibayar
        $saldoBaru = $saldoUser - $bayar;

        // Update saldo pengguna di database
        $updateSaldo = $this->obj_user->updateSaldo($userId, $saldoBaru);

        // Jika saldo dan stok berhasil diperbarui, lanjutkan dengan penambahan transaksi tiket
        if ($updateSaldo > 0 && $updateStok > 0) {
            // Membuat objek TransaksiTiket untuk ditambahkan ke database
            $newTransaksi = new TransaksiTiket(null, $userId, $eventId, $jumlahTiket, $totalHarga, $tanggalTransaksi, $bayar, $kembalian);
            $result = $this->obj_transaksiTiket->tambahTransaksi($newTransaksi);

            if ($result > 0) {
                echo "<script>alert('Transaksi Tiket berhasil diproses!');</script>";
                echo "<script>window.location.href='../user/profile.php';</script>";
            } else {
                echo "<script>alert('Gagal menambahkan transaksi tiket.');</script>";
            }
        } else {
            echo "<script>alert('Gagal memperbarui saldo atau stok event.');</script>";
        }
    }
}



    public function edit()
    {
        $id = $_GET['id']; // Ambil ID dari URL
        $transaksi = $this->obj_transaksiTiket->getTransaksiById($id); // Ambil data transaksi berdasarkan ID
        include '../user/updateTransaksi.php'; // Sertakan halaman form untuk update
    }

    public function update()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Ambil data dari form
            $id = $_POST['id']; // ID transaksi
            $userId = $_POST['user_id']; // ID user yang melakukan transaksi
            $eventId = $_POST['event_id']; // ID event
            $jumlahTiket = $_POST['jumlah_tiket']; // Jumlah tiket yang dibeli
            $totalHarga = $_POST['total_harga']; // Total harga tiket
            $tanggalTransaksi = date('Y-m-d H:i:s'); // Tanggal transaksi
            $bayar = $_POST['bayar']; // Jumlah yang dibayar
            $kembalian = $bayar - $totalHarga; // Menghitung kembalian

            // Membuat objek transaksi tiket dengan data baru
            $updatedTransaksi = new TransaksiTiket($id, $userId, $eventId, $jumlahTiket, $totalHarga, $tanggalTransaksi, $bayar, $kembalian);

            // Update transaksi di model
            $result = $this->obj_transaksiTiket->updateTransaksi($id, $updatedTransaksi);

            if ($result > 0) {
                echo "<script>alert('Transaksi Tiket berhasil diperbarui!');</script>";
                echo "<script>window.location.href='../user/profile.php';</script>"; // Redirect setelah berhasil
            } else {
                echo "<script>alert('Gagal memperbarui transaksi tiket.');</script>";
            }
        }
    }

    public function delete()
    {
        $id = $_GET['id'];
        $result = $this->obj_transaksiTiket->hapusTransaksi($id);

        if ($result > 0) {
            echo "<script>alert('Transaksi berhasil dihapus!');</script>";
        } else {
            echo "<script>alert('Gagal menghapus transaksi.');</script>";
        }
        header("Location: index.php?modul=transaksiTiket");
    }

    public function list()
    {
        $transaksiTikets = $this->obj_transaksiTiket->getTransaksiList();
        include "../admin/listTransaksi.php";
    }
}
?>
