<div class="w-64 bg-gradient-to-b from-purple-700 to-blue-800 text-white p-5 space-y-6">
    <div class="text-2xl font-bold text-center text-white">
        <i class="fas fa-users"></i> Menu
    </div>
    <ul class="space-y-4 text-lg">
        <li>
            <a href="index.php?modul=dashboard" class="flex items-center py-2 px-4 rounded-lg hover:bg-blue-600 hover:shadow-lg transition duration-200 <?php echo (isset($_GET['modul']) && $_GET['modul'] == 'dashboard') || (!isset($_GET['modul'])) ? 'bg-blue-600' : ''; ?>">
                <i class="fas fa-tachometer-alt mr-3"></i> Dashboard
            </a>
        </li>
        <li>
            <a href="index.php?modul=member" class="flex items-center py-2 px-4 rounded-lg hover:bg-blue-600 hover:shadow-lg transition duration-200 <?php echo (isset($_GET['modul']) && $_GET['modul'] == 'member') ? 'bg-blue-600' : ''; ?>">
                <i class="fas fa-user-circle mr-3"></i> Master Data Member JKT48
            </a>
        </li>

        <li>
            <a href="index.php?modul=event" class="flex items-center py-2 px-4 rounded-lg hover:bg-blue-600 hover:shadow-lg transition duration-200 <?php echo (isset($_GET['modul']) && $_GET['modul'] == 'event') ? 'bg-blue-600' : ''; ?>">
                <i class="fas fa-calendar-alt mr-3"></i> Master Data Event
            </a>
        </li>
        <li>
            <a href="../admin/index.php?modul=topUp" class="flex items-center py-2 px-4 rounded-lg hover:bg-blue-600 hover:shadow-lg transition duration-200 <?php echo (isset($_GET['modul']) && $_GET['modul'] == 'topup') ? 'bg-blue-600' : ''; ?>">
                <i class="fas fa-credit-card mr-3"></i> Top Up
            </a>
        </li>
        <li>
            <a href="../admin/index.php?modul=transaksi" class="flex items-center py-2 px-4 rounded-lg hover:bg-blue-600 hover:shadow-lg transition duration-200 <?php echo (isset($_GET['modul']) && $_GET['modul'] == 'transaksi') ? 'bg-blue-600' : ''; ?>">
                <i class="fas fa-exchange-alt mr-3"></i> Transaksi
            </a>
        </li>
    </ul>
</div>
