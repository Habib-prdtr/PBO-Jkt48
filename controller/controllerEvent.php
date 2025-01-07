<?php
require_once __DIR__ . '/../models/EventModel.php';

class EventController
{
    private $obj_event;

    public function __construct()
    {
        $this->obj_event = new EventModel();
    }

    public function input()
    {
        include '../admin/inputEvent.php';
    }

    public function add()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $foto = $_FILES['foto']['name'];
            $nama = $_POST['nama'];
            $tanggal = $_POST['tanggal'];
            $tempat = $_POST['tempat'];
            $harga = $_POST['harga'];
            $stok = $_POST['stok'];
            $tipeEvent = $_POST['tipeEvent'];

            $newEvent = new EventJkt(null, $foto, $nama, $tanggal, $tempat, $harga, $stok, $tipeEvent);
            $result = $this->obj_event->tambahEvent($newEvent);

            if ($result > 0) {
                echo "<script>alert('Event berhasil ditambahkan!');</script>";
                header("Location: index.php?modul=event");
            } else {
                echo "<script>alert('Gagal menambahkan event.');</script>";
            }
        }
    }

    public function edit()
    {
        $id = $_GET['id'];
        $eventData = $this->obj_event->getEventById($id);
        include '../admin/updateEvent.php';
    }

    public function update()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'];
            $nama = $_POST['nama'];
            $tanggal = $_POST['tanggal'];
            $tempat = $_POST['tempat'];
            $harga = $_POST['harga'];
            $stok = $_POST['stok'];
            $tipeEvent = $_POST['tipeEvent'];

            $eventLama = $this->obj_event->getEventById($id);
            $foto = $eventLama['foto'];

            $updatedEvent = new EventJkt(null, $foto, $nama, $tanggal, $tempat, $harga, $stok, $tipeEvent);
            $this->obj_event->updateEvent($id, $updatedEvent);

            header("Location: index.php?modul=event");
        }
    }

    public function delete()
    {
        $id = $_GET['id'];
        $this->obj_event->hapusEvent($id);
        header("Location: index.php?modul=event");
    }

    public function list()
    {
        $events = $this->obj_event->getEvents();
        include "../admin/listEvent.php";
    }
}
?>
