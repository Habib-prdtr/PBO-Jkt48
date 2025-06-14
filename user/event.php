<?php
// Cek apakah pengguna sudah login
$isLoggedIn = isset($_SESSION['user_id']);  // Gantilah 'user_id' dengan ID session yang Anda gunakan setelah login

// Mengimpor model event
require_once __DIR__ . '/../models/EventModel.php';

$eventModel = new EventModel();
$events = $eventModel->getEvents();
?>

<!DOCTYPE html>
<html lang="id" data-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JKT48 Exclusive Events</title>
    <link rel="icon" type="image/jpeg" href="../images/icon.jpg">
    <link href="https://cdn.jsdelivr.net/npm/daisyui@latest/dist/full.css" rel="stylesheet" type="text/css" />
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'jkt-red': '#D10A30',
                        'jkt-gold': '#FFD700',
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-red-100 text-gray-800 flex flex-col min-h-screen">
    <?php include 'navbar.php'; ?>

    <!-- Main Content -->
    <h1 class="text-4xl font-extrabold text-center mt-8">JKT48 Events</h1>
    <main class="flex-grow py-8 px-4">
    <div class="container mx-auto">
        <div class="grid sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            <?php foreach ($events as $event): ?>
                <a href="../user/index.php?modul=transaksi&fitur=input&id=<?= $event['id'] ?>" class="group">
                    <div class="card bg-white shadow-lg hover:shadow-2xl transition-transform duration-300 transform group-hover:-translate-y-2 overflow-hidden">
                        <figure class="relative w-full mx-auto">
                            <div class="w-full h-auto max-h-96">
                                <img src="../images/event/<?= $event['foto'] ?>" alt="Event Image" class="w-full h-64 object-cover" />
                            </div>
                            <div class="absolute inset-0 bg-gradient-to-t from-black to-transparent opacity-70"></div>
                            <div class="absolute bottom-0 left-0 right-0 p-4 text-white">
                                <h3 class="text-lg sm:text-xl lg:text-2xl font-bold mb-2"><?= htmlspecialchars($event['nama']) ?></h3>
                                <p class="text-sm opacity-90"><?= htmlspecialchars($event['tanggal']) ?></p>
                            </div>
                        </figure>
                        <div class="card-body p-4">
                            <div class="flex justify-between items-center text-sm text-gray-600">
                                <span><i class="fas fa-map-marker-alt mr-2 text-jkt-red"></i><?= htmlspecialchars($event['tempat']) ?></span>
                            </div>
                        </div>
                    </div>
                </a>
            <?php endforeach; ?>
        </div>
    </div>
</main>


    <!-- Footer -->
    <footer class="bg-gray-900 text-white py-4 mt-10" style="overflow: hidden;">
        <div class="container mx-auto text-center px-20">
            <p class="text-jkt-gold font-semibold text-sm sm:text-base">&copy; 2024 JKT48 Official Fansite</p>
            <a href="https://www.instagram.com/habib_prdtr" target="_blank" class="text-sm sm:text-base">
                <i class="fab fa-instagram"></i> Author
            </a>
            <p class="mt-2 text-xs sm:text-sm">All Rights Reserved | Reference <a href="https://jkt48.com/" target="_blank">jkt48.com</a></p>
        </div>
    </footer>
    <div id="toast-container" class="fixed bottom-5 right-5 space-y-2 z-50"></div>
</body>
<script src="../includes/notifikasi.js"></script>
</html>
