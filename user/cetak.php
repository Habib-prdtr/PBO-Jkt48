<?php

use Mpdf\Mpdf;

session_start();
require_once '../assets/vendor/autoload.php';
require_once '../config/database.php';
require_once '../models/UserModel.php'; 
require_once ('../assets/phpqrcode/qrlib.php'); // Include PHP QR Code Library

// Cek apakah user sudah login
if (!isset($_SESSION['login'])) {
    // Jika tidak, redirect ke halaman login
    header('Location: ../user/login.php');
    exit;
}

// Ambil ID pengguna dari session
$user_id = $_SESSION['user_id'];

// Ambil data pengguna dari database
$userModel = new UserModel();
$user = $userModel->getUserById($user_id);

$id = $_GET['id'] ?? null;
$item = $userModel->getHistoryById($user_id, $id);

if (!$item) {
    echo "Data tidak ditemukan.";
    exit;
}

if (!$user) {
    // Jika data tidak ditemukan, tampilkan pesan error
    echo "Data pengguna tidak ditemukan.";
    exit;
}

// Generate QR Code
$kode = "JEKETI48-";
$info = $kode . $item['id'] . " | " . $item['eventNama'] . " | Tanggal: " . $item['Tanggal'] . " | Jumlah Tiket: " . $item['jumlahTiket'];
$qrCodePath = "../images/qrcode/" . $item['id'] . ".png";
QRcode::png($info, $qrCodePath, "L", 3, 3);

// Buat konten HTML untuk PDF
$html = '
<html>
<head>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        .container {
            max-width: 800px;
            margin: 20px auto;
            background: #fff;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
        .event-title {
            text-align: center;
            font-size: 24px;
            font-weight: bold;
            color: #333;
            padding: 10px;
            border: 2px solid #333;
            border-radius: 5px;
            display: inline-block;
            margin: 0 auto 20px;
        }
        .header {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
        }
        .header div {
            font-size: 14px;
            color: #666;
        }
        .header .company-name {
            font-size: 18px;
            font-weight: bold;
            color: #333;
        }
        .invoice-details {
            margin-top: 20px;
            padding: 10px 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
            background-color: #f9f9f9;
            font-family: Arial, sans-serif;
            font-size: 14px;
        }
        .row {
            display: flex;
            justify-content: space-between;
            margin: 8px 0;
            border-bottom: 1px dashed #ccc;
            padding-bottom: 5px;
        }
        .row:last-child {
            border-bottom: none;
        }
        .label {
            font-weight: bold;
            color: #333;
            width: 40%;
            text-align: left;
        }
        .value {
            width: 60%;
            text-align: right;
            color: #555;
        }
        .footer {
            text-align: center;
            font-size: 12px;
            color: #999;
            margin-top: 20px;
        }
        .row {
            display: flex;
            justify-content: flex-start;
            align-items: center;
            margin: 8px 0;
            border-bottom: 1px dashed #ccc;
            padding-bottom: 5px;
        }
        .row:last-child {
            border-bottom: none;
        }
        .qr-code {
            margin-right: 20px;
            text-align: center;
        }
        .amount {
            text-align: right;
            font-size: 18px;
            font-weight: bold;
            color: #333;
}
    </style>
</head>
<body>
    <div class="container">
        <div class="event-title">' . ($item['type'] === 'transaksi' ? ($item['eventNama'] ?? 'Upgrade OFC') : 'Top-Up') . '</div>
        <div class="header">
            <div>
                <div class="company-name">JEKETI48 Online</div>
                <div> ' . $item['tempat'] . '</div>
            </div>
            <div>
                <div><strong>Invoice ID:</strong> ' . $item['id'] . '</div>
                <div><strong>Tanggal:</strong> ' . $item['Tanggal'] . '</div>
            </div>
        </div>
        <div class="invoice-details">
            <div class="row">
                <span class="label">Deskripsi:</span> 
                <span class="value">' . ucfirst($item['type']) . '</span>
            </div>
            <div class="row">
                <span class="label">Jumlah:</span> 
                <span class="value">' . $item['jumlah'] . ' P</span>
            </div>';

if ($item['type'] === 'topUp') {
    $html .= '
    <div class="row">
        <span class="label">Status:</span> 
        <span class="value">' . ucfirst($item['status']) . '</span>
    </div>';
} elseif ($item['type'] === 'transaksi') {
    $html .= '
    <div class="row">
        <span class="label">Jumlah Tiket:</span> 
        <span class="value">' . ($item['jumlahTiket'] ? $item['jumlahTiket'] : 'N/A') . '</span>
    </div>
    <div class="row">
        <span class="label">Bayar:</span> 
        <span class="value">Rp ' . number_format($item['bayar'], 0, ',', '.') . '</span>
    </div>
    <div class="row">
        <span class="label">Kembalian:</span> 
        <span class="value">Rp ' . number_format($item['kembalian'], 0, ',', '.') . '</span>
    </div>';
}

$html .= '
        </div>
        <div class="row">
        <div class="qr-code">
            <p style="text-align: center; margin: 0;">QR Code</p>
            <img src="' . $qrCodePath . '" alt="QR Code" width="100" height="100">
        </div>
        <div class="amount">
            Total: Rp ' . number_format($item['jumlah'], 0, ',', '.') . '
        </div>
    </div>
        <div class="footer">
            Terima kasih telah menggunakan layanan kami. <br>
            <strong>JEKETI48 Online</strong>
        </div>
    </div>
</body>
</html>';

// Inisialisasi Mpdf
try {
    $mpdf = new \Mpdf\Mpdf();
    
    // Menambahkan QR code ke halaman
    $mpdf->Image($qrCodePath, 10, 150, 30, 30);  // Gambar QR Code di sebelah kiri halaman
    
    $mpdf->WriteHTML($html);
    $mpdf->Output('Detail_' . $item['id'] . '.pdf', 'I'); // 'I' untuk langsung di-download
} catch (\Mpdf\MpdfException $e) {
    echo "Error membuat PDF: " . $e->getMessage();
    exit;
}
