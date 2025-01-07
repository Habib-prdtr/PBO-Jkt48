<?php
require_once __DIR__ . '/../models/UserModel.php';
require_once __DIR__ . '/../models/memberJkt.php';
require_once __DIR__ . '/../models/TransaksiModel.php';

class UserController
{
    private $obj_user;
    private $listMember;
    private $obj_transaksiTiket;

    public function __construct()
    {
        $this->obj_user = new UserModel();
        $this->listMember = new MemberModel();
        $this->obj_transaksiTiket = new TransaksiTiketModel();

    }

    public function input()
    {
        $members = $this->listMember->getMembers(); // Mendapatkan data member JKT48
        
        include '../user/registrasi.php'; // Mengarahkan ke form registrasi
    }

    public function add()
    {
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $foto = $_FILES['foto']['name'];
            $nama = $_POST['nama'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $tipeUser = isset($_POST['tipeUser']) ? $_POST['tipeUser'] : 'General';
            $jenisKelamin = isset($_POST['jenisKelamin']) ? $_POST['jenisKelamin'] : 'Pria';
            $tanggalLahir = $_POST['tanggalLahir'];
            $alamat = $_POST['alamat'];
            $saldo = isset($_POST['saldo']) ? $_POST['saldo'] : 0;
            $idMemberJkt = $_POST['idMemberJkt'];

            $existingUser = $this->obj_user->getUserByEmail($email);
        
        if ($existingUser) {
            echo "<script>alert('Email sudah terdaftar, mohon isi ulang data diri anda!');</script>";
            echo "<script>window.location.href='index.php?modul=user&fitur=input';</script>";
        }

            $newUser = new UserJkt(null, $foto, $nama, $email, $password, $tipeUser, $jenisKelamin, $tanggalLahir, $alamat, $saldo, $idMemberJkt);
            $result = $this->obj_user->tambahUser($newUser);

            if ($result > 0) {
                echo "<script>alert('Registrasi Berhasil, Silahkan Login!');</script>";
            echo "<script>window.location.href='../user/login.php';</script>";
            } else {
                echo "<script>alert('Gagal menambahkan user.');</script>";
            }
        }
    }

    public function edit()
    {
        $id = $_GET['id'];
        $user = $this->obj_user->getUserById($id);
        $members = $this->listMember->getMembers(); // Mendapatkan data member JKT48 untuk pilihan edit
        include '../user/updateUser.php';
    }

    public function update()
{
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $id = $_POST['id'];
        $nama = $_POST['nama'];
        $email = $_POST['email'];
        $password = !empty($_POST['password']) ? $_POST['password'] : null;
        $jenisKelamin = isset($_POST['jenisKelamin']) ? $_POST['jenisKelamin'] : null;
        $tanggalLahir = $_POST['tanggalLahir'];
        $alamat = $_POST['alamat'];
        $idMemberJkt = $_POST['idMemberJkt'];

        // Mendapatkan data user lama
        $userLama = $this->obj_user->getUserById($id);

        // Update data user dengan foto baru atau lama
        $updatedUser = new UserJkt(null, '', $nama, $email, $password, $userLama['tipeUser'], $jenisKelamin, $tanggalLahir, $alamat, $userLama['saldo'], $idMemberJkt);

        // Proses update pada model
        $this->obj_user->updateUser($id, $updatedUser);

        // Redirect ke halaman user setelah update
        echo "<script>alert('Update data telah berhasil!');</script>";
        echo "<script>window.location.href='profile.php';</script>";
    }
}

    public function editTipeUser()
    {
        $id = $_GET['id'];
        $saldo = $this->obj_user->getSaldoById($id);
        include '../user/upgrade.php';
    }
    public function upgradeTipeUser()
{
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $userId = $_SESSION['user_id'];

        $user = $this->obj_user->getUserById($userId);
        $currentSaldo = $user['saldo'];
        $currentTipeUser = $user['tipeUser'];

        if ($currentTipeUser === 'OFC') {
            echo "<script>alert('Anda sudah memiliki tipe user OFC, tidak dapat di-upgrade lagi.');</script>";
            echo "<script>window.location.href='profile.php';</script>";
            return;
        }

        $newTipeUser = 'OFC';
        $biayaUpgrade = 300000;

        if ($currentSaldo >= $biayaUpgrade) {
            $newSaldo = $currentSaldo - $biayaUpgrade;

            $this->obj_user->updateSaldo($userId, $newSaldo);

            $result = $this->obj_user->upgradeTipeUser($userId, $newTipeUser);

            if ($result > 0) {
                // Simpan "history" upgrade ke tabel TransaksiTiketEvent
                $result = $this->obj_transaksiTiket->tambahTransaksi(new TransaksiTiket(
                    null, // ID akan otomatis diisi
                    $userId,
                    null, // Tidak ada event terkait
                    null, // Tidak membeli tiket
                    $biayaUpgrade,
                    date('Y-m-d H:i:s'),
                    $biayaUpgrade,
                    $newSaldo
                ));                

                echo "<script>alert('Upgrade OFC telah berhasil');</script>";
                echo "<script>window.location.href='profile.php';</script>";
            } else {
                echo "<script>alert('Gagal upgrade ke OFC.');</script>";
            }
        } else {
            echo "<script>alert('Saldo Anda tidak cukup untuk upgrade tipe user, silahkan isi saldo terlebih dahulu!');</script>";
            echo "<script>window.location.href='../admin/index.php?modul=topUp&fitur=input';</script>";
        }
    }
}


    public function delete()
    {
        $id = $_GET['id'];
        $this->obj_user->hapusUser($id);
        echo "<script>alert('Berhasil menghapus akun!');</script>";
        echo "<script>window.location.href='../user/logout.php';</script>";
    }
}
?>
