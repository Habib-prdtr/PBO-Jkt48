<?php

// Cek apakah pengguna sudah login
$isLoggedIn = isset($_SESSION['user_id']);  // Gantilah 'user_id' dengan ID session yang Anda gunakan setelah login
?>
<?php
require_once __DIR__ . '/../models/EventModel.php';

$eventModel = new EventModel();
$events = $eventModel->getEvents();
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Event JKT48</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">

    <style>
        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            margin: 0;
        }
        main {
            flex: 1;
        }
    </style>
</head>
<body class="bg-gray-100 text-gray-800">

    <?php include 'navbar.php'; ?>

    <main class="py-8">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl font-semibold mb-6 text-center text-gray-800">Daftar Event JKT48</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <?php foreach ($events as $event): ?>
                    <div class="col-span-1">
                        <div class="bg-white rounded-lg shadow-lg overflow-hidden transition-transform transform hover:scale-105">
                            <a href="../user/index.php?modul=transaksi&fitur=input&id=<?= $event['id'] ?>">
                                <div class="relative">
                                    <img class="w-full h-64 object-cover" src="../images/event/<?= $event['foto'] ?>" alt="<?= htmlspecialchars($event['nama']) ?>"/>
                                    <div class="absolute inset-0 bg-gradient-to-b from-transparent to-gray-900 bg-opacity-50"></div>
                                    <div class="absolute bottom-0 left-0 p-4">
                                        <h4 class="text-lg font-semibold text-white"><?= htmlspecialchars($event['nama']) ?></h4>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </main>

    <footer class="bg-gray-800 text-white py-4">
        <div class="container mx-auto text-center">
            <p>&copy; 2024 JKT48 Fansite. All Rights Reserved.</p>
        </div>
    </footer>
</body>
</html>
