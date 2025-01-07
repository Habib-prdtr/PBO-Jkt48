<?php
session_start();

// Tentukan apakah pengguna sudah login
$isLoggedIn = isset($_SESSION["login"]);

// Tentukan modul dan fitur yang bisa diakses tanpa login
$allowedModulesWithoutLogin = ['input', 'add','editTipeUser'];

// Cek apakah modul yang diakses memerlukan login atau bisa diakses tanpa login
if (!$isLoggedIn && isset($_GET['modul']) && $_GET['modul'] === 'user' && !in_array($_GET['fitur'], $allowedModulesWithoutLogin)) {
    // Jika belum login dan modul user selain 'input' dan 'editTipeUser' diakses, arahkan ke dashboard
    header("Location: ../user/dashboard.php");
    exit;
}

require_once __DIR__ . '/../controller/controllerUser.php'; // Memasukkan controllerUser
require_once __DIR__ . '/../controller/controllerTransaksi.php'; // Memasukkan controllerUser

// Menentukan modul
$modul = isset($_GET['modul']) ? $_GET['modul'] : 'dashboard';  // Default ke modul dashboard

switch ($modul) {
    case 'dashboard':
        header("Location: ../user/dashboard.php");
        break;

    case 'user':
        $fitur = isset($_GET['fitur']) ? $_GET['fitur'] : null;
        $userController = new UserController();

        switch ($fitur) {
            case 'input':
                $userController->input();
                break;

            case 'add':
                $userController->add();
                break;

            case 'edit':
                $userController->edit();
                break;

            case 'update':
                $userController->update();
                break;

            case 'delete':
                $userController->delete();
                break;

            case 'editTipeUser':
                $userController->editTipeUser();
                break;

            case 'upgradeTipeUser':
                $userController->upgradeTipeUser();
                break;

            default:
                echo "Fitur tidak ditemukan!";
                break;
        }
        break;

    case 'transaksi':
        $fitur = isset($_GET['fitur']) ? $_GET['fitur'] : null;
        $transaksiController = new TransaksiTiketController();

        switch ($fitur) {
            case 'input':
                $transaksiController->input();
                break;

            case 'add':
                $transaksiController->add();
                break;

            case 'edit':
                $transaksiController->edit();
                break;

            case 'update':
                $transaksiController->update();
                break;

            case 'delete':
                $transaksiController->delete();
                break;

            default:
                echo "Fitur transaksi tidak ditemukan!";
                break;
        }
        break;

    default:
        echo "Modul tidak ditemukan!";
        break;
}

