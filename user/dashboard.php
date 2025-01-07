<?php 
require_once __DIR__ . '/../models/EventModel.php';

$eventModel = new EventModel();
$events = $eventModel->getEvents();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JKT48 ITATS Official Website</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css">
</head>
<body class="bg-red-100 text-gray-800">
<?php include 'navbar.php'; ?>

    <section class="mt-4">
        <div class="swiper hero-home relative w-full max-w-5xl mx-auto">
            <div class="swiper-wrapper">
                <?php foreach ($events as $event): ?>
                    <div class="swiper-slide">
                        <a href="../user/index.php?modul=transaksi&fitur=input&id=<?= $event['id'] ?>">
                            <img class="mx-auto" src="../images/event/<?= $event['foto']; ?>" alt="<?= $event['nama'] ?>" />
                        </a>
                    </div>
                <?php endforeach; ?>
            </div>

            <div class="swiper-pagination"></div>
        </div>
    </section>

    <main class="container mx-auto mt-8 px-4">
    <section class="flex flex-col items-center gap-6 mt-8 relative py-8">
        <div class="bg-white shadow-lg rounded-full p-6 w-11/12 max-w-3xl flex items-center justify-center transform hover:scale-105 transition duration-300">
            <h3 class="text-lg font-bold text-black text-center">
                <button onclick="openModal('popup1', 'Apa itu JKT48?', 'JKT48 adalah grup idola asal Indonesia yang merupakan bagian dari AKB48 Group dari Jepang.')" class="hover:underline">Apa itu JKT48?</button>
            </h3>
        </div>
        <div class="bg-white shadow-lg rounded-full p-6 w-11/12 max-w-3xl flex items-center justify-center transform hover:scale-105 transition duration-300">
            <h3 class="text-lg font-bold text-black text-center">
                <button onclick="openModal('popup2', 'Apa itu JKT48 Point?', 'JKT48 Point adalah sistem poin yang bisa didapatkan oleh penggemar untuk berbagai kegiatan.')" class="hover:underline">Apa itu JKT48 Point?</button>
            </h3>
        </div>
        <div class="bg-white shadow-lg rounded-full p-6 w-11/12 max-w-3xl flex items-center justify-center transform hover:scale-105 transition duration-300">
            <h3 class="text-lg font-bold text-black text-center">
                <button onclick="openModal('popup3', 'Apa itu JKT48 Fanclub?', 'JKT48 Fanclub adalah komunitas resmi penggemar JKT48 dengan berbagai keuntungan khusus.')" class="hover:underline">Apa itu JKT48 Fanclub?</button>
            </h3>
        </div>
    </section>
</main>


<!-- Modal -->
<div id="infoModal" class="fixed inset-0 bg-black bg-opacity-50 hidden flex justify-center items-center">
    <div class="bg-white p-6 rounded-lg shadow-lg w-11/12 max-w-md transform transition duration-300 scale-100">
        <h3 class="text-2xl font-bold mb-4 text-purple-600" id="modalTitle">Modal Title</h3>
        <div id="modalContent" class="text-gray-700">
            <!-- Content will be populated here -->
        </div>
        <div class="flex justify-end mt-4">
            <button onclick="closeModal()" class="bg-purple-500 hover:bg-purple-600 text-white font-bold py-2 px-4 rounded-lg">Tutup</button>
        </div>
    </div>
</div>

<script>
    function openModal(id, title, content) {
        const modalTitle = document.getElementById('modalTitle');
        const modalContent = document.getElementById('modalContent');
        modalTitle.innerText = title;
        modalContent.innerHTML = `<p>${content}</p>`;
        document.getElementById('infoModal').classList.remove('hidden');
    }

    function closeModal() {
        document.getElementById('infoModal').classList.add('hidden');
    }


        const swiper = new Swiper('.swiper', {
            effect: "coverflow",
            grabCursor: true,
            centeredSlides: true,
            slidesPerView: "auto",
            coverflowEffect: {
                rotate: 15,
                stretch: 0,
                depth: 300,
                modifier: 1,
                slideShadows: true,
            },
            speed: 500,
            loop: true, // Pastikan loop aktif
            autoplay: {
                delay: 3000, // Interval autoplay
                disableOnInteraction: false, // Autoplay tetap berjalan meskipun ada interaksi
            },
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            },
            navigation: {
                nextEl: ".swiper-button-next",
                prevEl: ".swiper-button-prev",
            },
            on: {
                init: function () {
                    console.log('Swiper initialized');
                },
                slideChange: function () {
                    console.log('Slide changed');
                },
            },
        });
    </script>
    <footer class="bg-gray-800 text-white py-4 mt-8">
        <div class="container mx-auto text-center">
            <p>&copy; 2024 JKT48 ITATS Official Website. All Rights Reserved.</p>
        </div>
    </footer>
</body>
</html>
