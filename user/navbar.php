<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start(); // Mulai session jika belum dimulai
}
$isLoggedIn = isset($_SESSION['user_id']); // Cek status login
?>
<head>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
</head>

<style>
    .dropdown {
        position: relative;
    }

    .dropdown-content {
        position: absolute;
        top: 100%;
        left: 0;
        z-index: 10;
        background-color: white;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        border-radius: 0.25rem;
        width: 200px;
    }

    @media (max-width: 768px) {
        .mobile-menu {
            display: none;
        }

        .mobile-menu.show {
            display: block;
        }
    }
</style>

<nav class="bg-red-600 text-white py-4 shadow-md">
    <div class="container mx-auto flex items-center justify-between px-4">
        <a href="../user/index.php"><h1 class="text-2xl font-bold">JEKETI48</h1></a>
        <button id="menuToggle" class="block md:hidden text-white">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16m-7 6h7" />
            </svg>
        </button>
        <ul class="hidden md:flex space-x-4">
            <li><a href="../user/index.php" class="hover:underline">Home</a></li>
            <li><a href="../user/event.php" class="hover:underline">Event</a></li>
            <li><a href="../user/member.php" class="hover:underline">Member</a></li>
            <li class="dropdown relative">
                <button id="dropdownNavbarLink" class="flex items-center text-white">
                    JKTPoint
                    <svg class="w-3 h-3 ml-1" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1l4 4 4-4" />
                    </svg>
                </button>
                <div id="dropdownNavbar" class="dropdown-content hidden font-normal bg-white divide-y divide-gray-100 rounded-lg shadow z-10">
                    <ul class="py-2 text-sm text-gray-700">
                        <li><a href="../user/caraPembelian.php" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Cara Beli dan Pakai JKT48 Point</a></li>
                        <li><a href="../admin/index.php?modul=topUp&fitur=input" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Beli JKT48 Point</a></li>
                    </ul>
                </div>
            </li>
            <li><a href="../user/fanclub.php" class="hover:underline">JKT Fanclub</a></li>
        </ul>
        <div class="hidden md:flex space-x-2">
            <?php if ($isLoggedIn): ?>
                <a href="../user/profile.php" class="bg-white text-red-500 px-4 py-2 rounded-lg shadow hover:bg-gray-200">My Page</a>
                <a href="../user/logout.php" class="bg-white text-red-500 px-4 py-2 rounded-lg shadow hover:bg-gray-200">Logout</a>
            <?php else: ?>
                <a href="login.php" class="bg-white text-red-500 px-4 py-2 rounded-lg shadow hover:bg-gray-200">Login</a>
                <a href="index.php?modul=user&fitur=input" class="bg-white text-red-500 px-4 py-2 rounded-lg shadow hover:bg-gray-200">Register</a>
            <?php endif; ?>
        </div>
    </div>
    <div id="mobileMenu" class="mobile-menu hidden md:hidden bg-red-500 text-white px-4">
        <ul class="space-y-4">
            <li><a href="../user/index.php" class="hover:underline">Home</a></li>
            <li><a href="../user/event.php" class="hover:underline">Event</a></li>
            <li><a href="../user/member.php" class="hover:underline">Member</a></li>
            <li class="dropdown">
                <button id="mobileDropdownLink" class="flex items-center text-white">
                    JKTPoint
                    <svg class="w-4 h-4 ml-1" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1l4 4 4-4" />
                    </svg>
                </button>
                <div id="mobileDropdownMenu" class="dropdown-content hidden mt-2">
                    <ul class="py-2 text-sm text-gray-700">
                        <li><a href="caraPembelian.php" class="block px-4 py-2 hover:bg-gray-100">Cara Beli dan Pakai JKT48 Point</a></li>
                        <li><a href="../admin/index.php?modul=topUp&fitur=input" class="block px-4 py-2 hover:bg-gray-100">Beli JKT48 Point</a></li>
                    </ul>
                </div>
            </li>
            <li><a href="../user/fanclub.php" class="hover:underline">JKT Fanclub</a></li>
        </ul>
        <div class="mt-4 flex space-x-2">
            <?php if ($isLoggedIn): ?>
                <a href="../user/profile.php" class="bg-white text-red-500 px-4 py-2 rounded-lg shadow hover:bg-gray-200">My Page</a>
                <a href="../user/logout.php" class="bg-white text-red-500 px-4 py-2 rounded-lg shadow hover:bg-gray-200">Logout</a>
            <?php else: ?>
                <a href="login.php" class="bg-white text-red-500 px-4 py-2 rounded-lg shadow hover:bg-gray-200">Login</a>
                <a href="index.php?modul=user&fitur=input" class="bg-white text-red-500 px-4 py-2 rounded-lg shadow hover:bg-gray-200">Register</a>
            <?php endif; ?>
        </div>
    </div>
</nav>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const menuToggle = document.getElementById('menuToggle');
        const mobileMenu = document.getElementById('mobileMenu');
        const dropdownLink = document.getElementById('dropdownNavbarLink');
        const dropdownMenu = document.getElementById('dropdownNavbar');
        const mobileDropdownLink = document.getElementById('mobileDropdownLink');
        const mobileDropdownMenu = document.getElementById('mobileDropdownMenu');

        menuToggle.addEventListener('click', () => {
            mobileMenu.classList.toggle('show');
        });

        dropdownLink.addEventListener('click', (e) => {
            e.preventDefault();
            dropdownMenu.classList.toggle('hidden');
        });

        mobileDropdownLink.addEventListener('click', () => {
            mobileDropdownMenu.classList.toggle('hidden');
        });
    });
</script>
