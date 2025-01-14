<?php

require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../node/nodeMemberJkt.php';

class MemberModel {
    private $table = "memberjkt";

    // Fungsi untuk menangani upload gambar
    public function upload() {
        if (!isset($_FILES['foto']) || $_FILES['foto']['error'] !== UPLOAD_ERR_OK) {
            echo "<script>
                    alert('Foto tidak ditemukan atau gagal di-upload!');
                  </script>";
            return false;
        }
    
        $namaFile = $_FILES['foto']['name'];
        $sizeFile = $_FILES['foto']['size'];
        $error = $_FILES['foto']['error'];
        $tmpName = $_FILES['foto']['tmp_name'];
    
        // Cek apakah yang di-upload adalah gambar
        $formatGambarValid = ['jpg', 'jpeg', 'png'];
        $formatGambar = explode('.', $namaFile);
        $formatGambar = strtolower(end($formatGambar));
    
        if (!in_array($formatGambar, $formatGambarValid)) {
            echo "<script>
                    alert('Format gambar tidak didukung!');
                  </script>";
            return false;
        }
    
        // Generate nama gambar baru
        $namaFileBaru = uniqid('member_', true) . '.' . $formatGambar;
    
        // Pindahkan file gambar ke folder 'images/member/'
        $uploadDir = '../images/member/';
        if (!move_uploaded_file($tmpName, $uploadDir . $namaFileBaru)) {
            echo "<script>
                    alert('Gagal memindahkan file gambar!');
                  </script>";
            return false;
        }
    
        return $namaFileBaru;
    }
    
    // Fungsi untuk menghapus file gambar
    public function hapusFileGambar($fileName) {
        $filePath = '../images/member/' . $fileName;
        if (file_exists($filePath)) {
            unlink($filePath);
        }
    }

    // Fungsi untuk menambah data member
    public function tambahMember(MemberJkt $member) {
        global $db;

        // Proses upload gambar
        $gambar = $this->upload();
        if (!$gambar) {
            return false;
        }

        // Menyimpan data ke dalam database
        $query = "INSERT INTO $this->table (foto, nama, tanggalLahir, golonganDarah, horoskop, tinggiBadan)
                  VALUES ('{$gambar}', '{$member->nama}', '{$member->tanggalLahir}', '{$member->golonganDarah}', '{$member->horoskop}', '{$member->tinggiBadan}')";
        mysqli_query($db, $query);
        return mysqli_affected_rows($db);
    }

    // Fungsi untuk menghapus data member
    public function hapusMember($id) {
        global $db;

        // Ambil data member untuk mendapatkan nama file foto
        $member = $this->getMemberById($id);
        if ($member) {
            $this->hapusFileGambar($member['foto']);
        }

        $query = "DELETE FROM $this->table WHERE id = $id";
        mysqli_query($db, $query);
        return mysqli_affected_rows($db);
    }

    // Fungsi untuk mengupdate data member
    public function updateMember($id, MemberJkt $member) {
        global $db;
    
        // Cek jika ada gambar baru yang di-upload
        if (isset($_FILES['foto']) && $_FILES['foto']['error'] === UPLOAD_ERR_OK) {
            // Proses upload foto baru
            $gambar = $this->upload();
            if (!$gambar) {
                return false;
            }
    
            // Hapus foto lama jika ada foto baru
            $memberLama = $this->getMemberById($id);
            if ($memberLama && $memberLama['foto']) {
                $this->hapusFileGambar($memberLama['foto']);
            }
        } else {
            // Jika tidak ada foto baru, gunakan foto lama dari database
            $memberLama = $this->getMemberById($id);
            $gambar = $memberLama['foto'];
        }
    
        // Update data member di database
        $query = "UPDATE $this->table SET 
                    foto = '{$gambar}', 
                    nama = '{$member->nama}', 
                    tanggalLahir = '{$member->tanggalLahir}', 
                    golonganDarah = '{$member->golonganDarah}', 
                    horoskop = '{$member->horoskop}', 
                    tinggiBadan = '{$member->tinggiBadan}' 
                  WHERE id = $id";
        mysqli_query($db, $query);
        return mysqli_affected_rows($db);
    }    

    // Fungsi untuk mengambil semua member
    public function getMembers() {
        global $db;
        $query = "SELECT * FROM $this->table";
        $result = mysqli_query($db, $query);
        $members = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $members[] = $row;
        }
        return $members;
    }

    // Fungsi untuk mengambil member berdasarkan ID
    public function getMemberById($id) {
        global $db;
        $query = "SELECT * FROM $this->table WHERE id = $id";
        $result = mysqli_query($db, $query);
        return mysqli_fetch_assoc($result);
    }

    public function getDetailedMemberById($id) {
        $memberData = $this->getMemberById($id);
        if ($memberData) {
            $member = new MemberJkt(
                $memberData['id'],
                $memberData['foto'],
                $memberData['nama'],
                $memberData['tanggalLahir'],
                $memberData['golonganDarah'],
                $memberData['Horoskop'],
                $memberData['tinggiBadan']
            );
            return $member->getMemberDetail();
        }
        return null;
    }
    
}
?>
