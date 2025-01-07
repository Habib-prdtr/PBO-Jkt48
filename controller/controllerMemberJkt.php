<?php
require_once __DIR__ . '/../models/memberJkt.php';

class MemberController
{
    private $obj_member;

    public function __construct()
    {
        $this->obj_member = new MemberModel();
    }

    public function input()
    {
        include '../admin/inputMember.php';
    }

    public function add()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $foto = $_FILES['foto']['name'];
            $nama = $_POST['nama'];
            $tanggalLahir = $_POST['tanggalLahir'];
            $golonganDarah = $_POST['golonganDarah'];
            $horoskop = $_POST['horoskop'];
            $tinggiBadan = $_POST['tinggiBadan'];

            $newMember = new MemberJkt(null, $foto, $nama, $tanggalLahir, $golonganDarah, $horoskop, $tinggiBadan);
            $result = $this->obj_member->tambahMember($newMember);

            if ($result > 0) {
                echo "<script>alert('Member berhasil ditambahkan!');</script>";
                header("Location: index.php?modul=member");
            } else {
                echo "<script>alert('Gagal menambahkan member.');</script>";
            }
        }
    }

    public function edit()
    {
        $id = $_GET['id'];
        $memberData = $this->obj_member->getMemberById($id);
        include '../admin/updateMember.php';
    }

    public function update()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'];
            $foto = $_FILES['foto']['name'] ?? $_POST['old_foto'];
            $nama = $_POST['nama'];
            $tanggalLahir = $_POST['tanggalLahir'];
            $golonganDarah = $_POST['golonganDarah'];
            $horoskop = $_POST['horoskop'];
            $tinggiBadan = $_POST['tinggiBadan'];

            $updatedMember = new MemberJkt(null, $foto, $nama, $tanggalLahir, $golonganDarah, $horoskop, $tinggiBadan);
            $this->obj_member->updateMember($id, $updatedMember);
            header("Location: index.php?modul=member");
        }
    }

    public function delete()
    {
        $id = $_GET['id'];
        $this->obj_member->hapusMember($id);
        header("Location: index.php?modul=member");
    }

    public function list()
    {
        $members = $this->obj_member->getMembers();
        include "../admin/listMemberJkt.php";
    }
}
?>
