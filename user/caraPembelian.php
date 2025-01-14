<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mengenai Layanan JKT48 Point</title>
    <link rel="icon" type="image/jpeg" href="../images/icon.jpg">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'jkt-gold': '#FFD700',
                    },
                },
            },
        };
    </script>
    
</head>
<body class="bg-gray-100 text-gray-800">
    <?php include 'navbar.php'; ?>
    <div class="container mx-auto px-4 py-8">
        <div class="text-center mb-6">
            <h2 class="text-2xl lg:text-3xl font-bold text-gray-800">
                Mengenai Layanan JKT48 Point dan Petunjuk Penggunaan
            </h2>
        </div>
        <div class="bg-white p-4 sm:p-6 rounded-lg shadow-lg">
            <p class="text-sm sm:text-base leading-relaxed">
                Terima kasih atas dukungannya untuk JKT48.<br><br>
                JKT48 Point adalah sistem pembayaran layanan JKT48 dengan Point yang lebih mudah dan menguntungkan bagi pengguna.<br>
                Mulai sekarang, sistem pembayaran dengan Point dapat digunakan untuk membeli tiket teater dan nantinya dapat digunakan untuk berbagai layanan JKT48 yang lain.<br><br>
                <b>Mengenai Penggunaan Layanan JKT48 Point:</b><br>
                Dalam JKT48 Point, berlaku 1 point = Rp 1,-.<br>
                Dibandingkan menggunakan uang tunai, layanan point akan lebih menguntungkan dan memudahkan kamu dalam berbagai hal!<br><br>
                <b>Contoh Perhitungan Point:</b><br>
                Rp1.000.000 → 1.000.000 JKT48 Point<br>
                Rp2.000.000 → 2.000.000 JKT48 Point<br>
                Rp3.000.000 → 3.000.000 JKT48 Point<br>
                Rp5.000.000 → 5.000.000 JKT48 Point<br><br>
                <b>Cara untuk membeli JKT48 Point:</b><br>
                <span class="text-lg font-semibold underline">
                    1. Daftar jadi anggota di official website, lalu lakukan pembelian JKT48 Point secara online.
                </span><br>
                <hr class="my-4">
                Mohon selalu dukungannya untuk JKT48.<br><br>
                JKT48 Operation Team
            </p>
            <div class="text-center mt-4">
                <a href="../admin/index.php?modul=topUp&fitur=input" class="py-2 px-4 rounded-lg bg-red-500 text-white hover:bg-red-600 transition-all duration-300 text-sm sm:text-base">
                    Menuju Formulir Pembelian JKT Points
                </a>
            </div>
        </div>
    </div>
    <footer class="bg-gray-900 text-white py-4 mt-10" style="overflow: hidden;">
        <div class="container mx-auto text-center px-4">
            <p class="text-jkt-gold font-semibold text-sm sm:text-base">&copy; 2024 JKT48 Official Fansite</p>
            <a href="https://www.instagram.com/habib_prdtr" target="_blank" class="text-sm sm:text-base">
                <i class="fab fa-instagram"></i> Author
            </a>
            <p class="mt-2 text-xs sm:text-sm">All Rights Reserved | Reference <a href="https://jkt48.com/" target="_blank">jkt48.com</a></p>
        </div>
    </footer>
</body>
</html>
