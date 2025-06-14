<?php
session_start();
if (!isset($_SESSION['login'])) {
    header('Location: ../user/login.php');
    exit;
}


require_once __DIR__ . '/../controller/controllerMemberJkt.php';
require_once __DIR__ . '/../controller/controllerEvent.php';
require_once __DIR__ . '/../controller/controllerTopUp.php';
require_once __DIR__ . '/../controller/controllerTransaksi.php';

if (isset($_GET['modul'])) {
    $modul = $_GET['modul'];
} else {
    header("Location: index.php?modul=dashboard");
    exit;
}

switch ($modul) {
    case 'dashboard':
        header("Location: index.php?modul=member");
        break;

    case 'member':
        $fitur = isset($_GET['fitur']) ? $_GET['fitur'] : null;
        $memberController = new MemberController();

        switch ($fitur) {
            case 'input':
                $memberController->input();
                break;

            case 'add':
                $memberController->add();
                break;

            case 'edit':
                $memberController->edit();
                break;

            case 'update':
                $memberController->update();
                break;

            case 'delete':
                $memberController->delete();
                break;

            default:
                $memberController->list();
                break;
        }
        break;

    case 'event':
        $fitur = isset($_GET['fitur']) ? $_GET['fitur'] : null;
        $eventController = new EventController();

        switch ($fitur) {
            case 'input':
                $eventController->input();
                break;

            case 'add':
                $eventController->add();
                break;

            case 'edit':
                $eventController->edit();
                break;

            case 'update':
                $eventController->update();
                break;

            case 'delete':
                $eventController->delete();
                break;

            default:
                $eventController->list();
                break;
        }
        break;

        case 'topUp':
            $fitur = isset($_GET['fitur']) ? $_GET['fitur'] : null;
            $topUpController = new TopUpController();
        
            switch ($fitur) {
                case 'input':
                    $topUpController->input();
                    break;
        
                case 'add':
                    $topUpController->add();
                    break;
        
                case 'approve':
                    $topUpController->approve();
                    break;
        
                case 'reject':
                    $topUpController->reject();
                    break;
        
                case 'delete':
                    $topUpController->delete();
                    break;

                case 'cekNotifikasi':
                    $topUpController->cekNotifikasi();
                    break;
                
                case 'getSessionNotif':
                    $topUpController->getSessionNotif();
                    break;

                default:
                    $topUpController->list();
                    break;
            }
            break;  
            
    case 'transaksi':
        $fitur = isset($_GET['fitur']) ? $_GET['fitur'] : null;
        $transaksiController = new TransaksiTiketController();

        switch ($fitur) {
            case 'list':
                $transaksiController->list();
                break;

            default:
                $transaksiController->list();
                break;
        }
        break;

    default:
        header("Location: index.php?modul=dashboard");
        break;
}
?>

