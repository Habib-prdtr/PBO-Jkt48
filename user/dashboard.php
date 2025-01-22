<?php 
require_once __DIR__ . '/../models/EventModel.php';

$eventModel = new EventModel();
$events = $eventModel->getEvents();
?>
<!DOCTYPE html>
<html lang="en" data-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JKT48 ITATS Official Website</title>
    <link rel="icon" type="image/jpeg" href="../images/icon.jpg">
    <link href="https://cdn.jsdelivr.net/npm/daisyui@latest/dist/full.css" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://unpkg.com/swiper@8/swiper-bundle.min.css" />
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: "#FF4136",
                        secondary: "#FF725C",
                        'jkt-gold': '#FFD700',
                    }
                }
            }
        }
    </script>
    <style>
        @import url("https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&display=swap");

*,
*::before,
*::after {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
  list-style-type: none;
  text-decoration: none;
}

:root {
  --primary: #ec994b;
  --white: #ffffff;
  --bg: #f5f5f5;
}

html {
  font-family: "Montserrat", sans-serif;
  scroll-behavior: smooth;
}

body {
    background: var(--bg);
    overflow-x: hidden; /* Menyembunyikan scroll horizontal */
}

.container {
    max-width: 124rem;
    padding: 0 1rem;
    margin: 0 auto;
    
     /* Pastikan tidak ada overflow pada kontainer */
}


#tranding .tranding-slider {
  height: 60rem;
  padding: 2rem 0;
  position: relative;
  perspective: 1500px; /* Memberikan efek kedalaman untuk slider */
}

.tranding-slide {
  width: 100%;
  height: 100%;
  position: relative;
  display: flex;
  justify-content: center;
  align-items: center;
}

.tranding-slide .tranding-slide-img img {
  width: 100%; /* Pastikan gambar memenuhi lebar slide */
  height: 100%; /* Pastikan gambar memenuhi tinggi slide */
  object-fit: cover;
  border-radius: 2rem;
}

.swiper-button-next, .swiper-button-prev {
  background: var(--white);
  width: 3.5rem;
  height: 3.5rem;
  border-radius: 50%;
  filter: drop-shadow(0px 8px 24px rgba(18, 28, 53, 0.1));
}

.swiper-pagination {
  position: relative;
  width: 15rem;
  bottom: 1rem;
}

.swiper-pagination .swiper-pagination-bullet-active {
  background: var(--primary);
}

    </style>
</head>
<body class="bg-red-100">
    <?php include 'navbar.php'; ?>

    <div class="container mx-auto px-4 py-8" >
        <div id="tranding" class="tranding-slider w-full md:w-[70%] mx-auto mb-4 mt-10 overflow-visible max-w-screen" >
            <div class="swiper-wrapper">
                <?php foreach ($events as $event): ?>
                    <div class="swiper-slide tranding-slide">
                        <a href="../user/index.php?modul=transaksi&fitur=input&id=<?= $event['id'] ?>">
                            <div class="tranding-slide-img">
                                <img src="../images/event/<?= $event['foto']; ?>" 
                                     alt="<?= htmlspecialchars($event['nama']); ?>" />
                            </div>
                        </a>
                    </div>
                <?php endforeach; ?>
            </div>

            <div class="swiper-pagination"></div>
        </div>
    </div>
    <main class="container mx-auto mt-8 mb-10 px-4 sm:px-6 md:px-8 lg:px-16">

        <section class="max-w-2xl mx-auto space-y-6">
            <div class="card bg-base-100 shadow-xl hover:shadow-2xl transition-all duration-300">
                <div class="card-body">
                    <h3 class="card-title text-xl font-bold text-purple-700">
                        <i class="fas fa-question-circle mr-2"></i>Apa itu JKT48?
                    </h3>
                    <p class="text-gray-600">Klik untuk mengetahui lebih lanjut tentang grup idola asal Indonesia ini.</p>
                    <div class="card-actions justify-end">
                        <button onclick="openModal('popup1', 'Apa itu JKT48?', 'JKT48 adalah grup idola asal Indonesia yang merupakan bagian dari AKB48 Group dari Jepang. Mereka terkenal dengan pertunjukan reguler dan interaksi dekat dengan penggemar.')" class="btn btn-primary">Baca Selengkapnya</button>
                    </div>
                </div>
            </div>
            
            <div class="card bg-base-100 shadow-xl hover:shadow-2xl transition-all duration-300">
                <div class="card-body">
                    <h3 class="card-title text-xl font-bold text-purple-700">
                        <i class="fas fa-star mr-2"></i>Apa itu JKT48 Point?
                    </h3>
                    <p class="text-gray-600">Pelajari tentang sistem poin yang bisa Anda dapatkan sebagai penggemar JKT48.</p>
                    <div class="card-actions justify-end">
                        <button onclick="openModal('popup2', 'Apa itu JKT48 Point?', 'JKT48 Point adalah sistem poin yang bisa didapatkan oleh penggemar untuk berbagai kegiatan. Poin ini dapat dibeli dihalaman pembalian JKTPoint.')" class="btn btn-primary">Baca Selengkapnya</button>
                    </div>
                </div>
            </div>
            
            <div class="card bg-base-100 shadow-xl hover:shadow-2xl transition-all duration-300">
                <div class="card-body">
                    <h3 class="card-title text-xl font-bold text-purple-700">
                        <i class="fas fa-users mr-2"></i>Apa itu JKT48 Fanclub?
                    </h3>
                    <p class="text-gray-600">Temukan keuntungan menjadi bagian dari komunitas resmi penggemar JKT48.</p>
                    <div class="card-actions justify-end">
                        <button onclick="openModal('popup3', 'Apa itu JKT48 Fanclub?', 'JKT48 Fanclub adalah komunitas resmi penggemar JKT48 dengan berbagai keuntungan khusus. Anggota mendapatkan akses prioritas ke tiket konser, merchandise eksklusif, dan kesempatan bertemu dengan member JKT48.')" class="btn btn-primary">Baca Selengkapnya</button>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <!-- Modal -->
    <div id="infoModal" class="modal">
        <div class="modal-box">
            <h3 class="font-bold text-2xl mb-4 text-purple-700" id="modalTitle"></h3>
            <p class="py-4 text-gray-700" id="modalContent"></p>
            <div class="modal-action">
                <button onclick="closeModal()" class="btn btn-primary">Tutup</button>
            </div>
        </div>
    </div>

    <footer class="bg-gray-900 text-white py-4 mt-auto" style="overflow: hidden;">
        <div class="container mx-auto text-center px-20">
            <p class="text-jkt-gold font-semibold text-sm sm:text-base">&copy; 2024 JKT48 Official Fansite</p>
            <a href="https://www.instagram.com/habib_prdtr" target="_blank" class="text-sm sm:text-base">
                <i class="fab fa-instagram"></i> Author
            </a>
            <p class="mt-2 text-xs sm:text-sm">All Rights Reserved | Reference <a href="https://jkt48.com/" target="_blank">jkt48.com</a></p>
        </div>
    </footer>

    <script src="https://unpkg.com/swiper@8/swiper-bundle.min.js"></script>
    <script>
function openModal(id, title, content) {
            const modal = document.getElementById('infoModal');
            const modalTitle = document.getElementById('modalTitle');
            const modalContent = document.getElementById('modalContent');
            modalTitle.innerText = title;
            modalContent.innerHTML = content;
            modal.classList.add('modal-open');
        }

        function closeModal() {
            const modal = document.getElementById('infoModal');
            modal.classList.remove('modal-open');
        }
        var TrandingSlider = new Swiper('.tranding-slider', {
            effect: 'coverflow',
            grabCursor: true,
            centeredSlides: true,  // Pastikan slide tengah berada di tengah
            loop: true,
            slidesPerView: 'auto',  // Agar semua slide terlihat
            coverflowEffect: {
                rotate: 50,  // Rotasi untuk menciptakan efek 3D
                stretch: 0,
                depth: 200,  // Kedalaman efek 3D
                modifier: 1,  // Pengaturan kecepatan rotasi
            },
            autoplay: {
                delay: 3000, // Waktu jeda antar slide
                disableOnInteraction: false, // Autoplay tidak berhenti setelah interaksi
            },
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            },
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            }
        });
    </script>
</body>
</html>
