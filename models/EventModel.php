<?php

require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../node/nodeEvent.php';


class EventModel {
    private $table = "events";

    // Fungsi untuk menangani upload gambar
    public function upload() {
        if (!isset($_FILES['foto']) || $_FILES['foto']['error'] !== UPLOAD_ERR_OK) {
            echo "<script>
                    alert('Foto tidak ditemukan atau gagal di-upload!');
                  </script>";
            return false;
        }
    
        $namaFile = $_FILES['foto']['name'];
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
        $namaFileBaru = uniqid('event_', true) . '.' . $formatGambar;
    
        // Pastikan nama file baru yang digunakan untuk menyimpan file
        $filePath = '../images/event/' . $namaFileBaru;
        if (!move_uploaded_file($tmpName, $filePath)) {
            echo "<script>
                    alert('Gagal memindahkan file gambar!');
                  </script>";
            return false;
        }
    
        return $namaFileBaru;
    }
    
    public function hapusFileGambar($fileName) {
        $filePath = '../images/event/' . $fileName;
        if (file_exists($filePath)) {
            unlink($filePath);
        }
    }

    public function tambahEvent(EventJkt $event) {
        global $db;

        // Proses upload gambar
        $gambar = $this->upload();
        if (!$gambar) {
            return false;
        }

        // Menyimpan data ke dalam database
        $query = "INSERT INTO $this->table (foto, nama, tanggal, tempat, harga, stok, tipeEvent)
                  VALUES ('{$gambar}', '{$event->nama}', '{$event->tanggal}', '{$event->tempat}', '{$event->harga}', '{$event->stok}', '{$event->tipeEvent}')";
        mysqli_query($db, $query);
        return mysqli_affected_rows($db);
    }

    public function hapusEvent($id) {
        global $db;

        // Ambil data event untuk mendapatkan nama file foto
        $event = $this->getEventById($id);
        if ($event) {
            $this->hapusFileGambar($event['foto']);
        }

        $query = "DELETE FROM $this->table WHERE id = $id";
        mysqli_query($db, $query);
        return mysqli_affected_rows($db);
    }

    public function updateEvent($id, EventJkt $event) {
        global $db;
        
        if (isset($_FILES['foto']) && $_FILES['foto']['error'] === UPLOAD_ERR_OK) {
            $gambar = $this->upload();

            $gambar = $this->upload();
            if (!$gambar) {
                return false;
            }

            $eventLama = $this->getEventById($id);
            if ($eventLama && $eventLama['foto']) {
                $this->hapusFileGambar($eventLama['foto']);
            }
        } else {
            $eventLama = $this->getEventById($id);
            $gambar = $eventLama['foto'];
        }
    
        // Update data event di database
        $query = "UPDATE $this->table SET 
                    foto = '{$gambar}', 
                    nama = '{$event->nama}', 
                    tanggal = '{$event->tanggal}', 
                    tempat = '{$event->tempat}', 
                    harga = '{$event->harga}', 
                    stok = '{$event->stok}', 
                    tipeEvent = '{$event->tipeEvent}' 
                  WHERE id = $id";
        mysqli_query($db, $query);
        return mysqli_affected_rows($db);
    }

    public function updateStokEvent($id, $newStok) {
        global $db;
        $query = "UPDATE $this->table SET stok = $newStok WHERE id = $id";
        mysqli_query($db, $query);
        return mysqli_affected_rows($db);
    }
    

    public function getEvents() {
        global $db;
        $query = "SELECT * FROM $this->table";
        $result = mysqli_query($db, $query);
        $events = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $events[] = $row;
        }
        return $events;
    }

    public function getEventById($id) {
        global $db;
        $query = "SELECT * FROM $this->table WHERE id = $id";
        $result = mysqli_query($db, $query);
        return mysqli_fetch_assoc($result);
    }
}
?>
