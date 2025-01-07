
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List Transaksi Tiket</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 font-sans leading-normal tracking-normal">

    <!-- Navbar -->
    <?php include '../includes/navbar.php'; ?>

    <!-- Main container -->
    <div class="flex min-h-screen bg-gradient-to-r from-blue-100 to-purple-200">
        <!-- Sidebar -->
        <?php include '../includes/sidebar.php'; ?>

        <!-- Main Content -->
        <div class="flex-1 p-8">
            <div class="container mx-auto bg-white p-6 rounded-lg shadow-lg">
                <!-- Transaksi Tiket Table -->
                <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                    <table class="w-full text-sm text-left text-gray-600">
                        <thead class="text-xs text-gray-700 uppercase bg-indigo-50">
                            <tr>
                                <th scope="col" class="px-6 py-3">Transaksi ID</th>
                                <th scope="col" class="px-6 py-3">User ID</th>
                                <th scope="col" class="px-6 py-3">Event</th>
                                <th scope="col" class="px-6 py-3">Jumlah Tiket</th>
                                <th scope="col" class="px-6 py-3">Tanggal Transaksi</th>
                                <th scope="col" class="px-6 py-3 text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $index = 1;
                            // Loop through each transaksi tiket
                            foreach ($transaksiTikets as $transaksi) {
                            ?>
                                <tr class="bg-white border-b hover:bg-indigo-50">
                                    <!-- Transaksi ID -->
                                    <td class="px-6 py-4"><?php echo $index++; ?></td>

                                    <!-- User ID -->
                                    <td class="px-6 py-4"><?php echo htmlspecialchars($transaksi['userId'] ?? 'NULL'); ?></td>

                                    <!-- Event -->
                                    <td class="px-6 py-4"><?php echo htmlspecialchars($transaksi['namaEvent'] ?? 'Upgrade OFC'); ?></td>

                                    <!-- Jumlah Tiket -->
                                    <td class="px-6 py-4"><?php echo htmlspecialchars($transaksi['jumlahTiket'] ?? 'N/A'); ?> Tiket</td>

                                    <!-- Tanggal Transaksi -->
                                    <td class="px-6 py-4"><?php echo htmlspecialchars($transaksi['tanggal']); ?></td>

                                    <!-- Action -->
                                    <td class="px-6 py-4 text-center">
                                        <!-- Detail Button (Trigger Modal) -->
                                        <button onclick="openModal(
                                            <?php echo htmlspecialchars($transaksi['id']); ?>, 
                                            '<?php echo htmlspecialchars($transaksi['userId'] ?? 'N/A'); ?>', 
                                            '<?php echo htmlspecialchars($transaksi['jumlahTiket'] ?? 'N/A'); ?>', 
                                            '<?php echo htmlspecialchars($transaksi['namaEvent'] ?? 'Upgrade OFC'); ?>', 
                                            '<?php echo htmlspecialchars($transaksi['totalHarga']); ?>', 
                                            '<?php echo htmlspecialchars($transaksi['tanggal']); ?>', 
                                            '<?php echo htmlspecialchars($transaksi['bayar']); ?>', 
                                            '<?php echo htmlspecialchars($transaksi['kembalian']); ?>'
                                        )" class="bg-blue-500 hover:bg-blue-600 text-white font-semibold py-1 px-2 rounded-lg mr-2 transition duration-200">Detail</button>


                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal for Transaksi Details -->
    <div id="transaksiModal" class="fixed inset-0 bg-gray-500 bg-opacity-50 hidden flex justify-center items-center">
        <div class="bg-white p-6 rounded-lg shadow-lg w-1/3">
            <h3 class="text-xl font-semibold mb-4" id="transaksiTitle">Detail Transaksi Tiket</h3>
            <div id="modalContent">
                <!-- Modal Content Will Be Populated Here -->
            </div>
            <div class="flex justify-end mt-4">
                <button onclick="closeModal()" class="bg-gray-500 hover:bg-gray-600 text-white font-semibold py-1 px-3 rounded-lg">Close</button>
            </div>
        </div>
    </div>

    <script>
        function openModal(id, userId, jumlahTiket, eventNama, totalHarga, tanggalTransaksi, bayar, kembalian) {
    // Ganti nilai NULL atau undefined dengan string default
    userId = userId || 'N/A';
    jumlahTiket = jumlahTiket || 'N/A';
    eventNama = eventNama || 'N/A';
    totalHarga = totalHarga || 'N/A';
    tanggalTransaksi = tanggalTransaksi || 'N/A';
    bayar = bayar || 'N/A';
    kembalian = kembalian || 'N/A';

    // Populate modal content
    const modalContent = document.getElementById('modalContent');
    const title = document.getElementById('transaksiTitle');

    title.innerText = `Detail Transaksi Tiket ID: ${id}`;
    modalContent.innerHTML = `
        <p><strong>User ID:</strong> ${userId}</p>
        <p><strong>Event:</strong> ${eventNama}</p>
        <p><strong>Jumlah Tiket:</strong> ${jumlahTiket} Tiket</p>
        <p><strong>Total Harga:</strong> Rp ${totalHarga}</p>
        <p><strong>Tanggal Transaksi:</strong> ${tanggalTransaksi}</p>
        <p><strong>Bayar:</strong> Rp ${bayar}</p>
        <p><strong>Kembalian:</strong> Rp ${kembalian}</p>
    `;

    // Show the modal
    document.getElementById('transaksiModal').classList.remove('hidden');
}


        function closeModal() {
            // Hide the modal
            document.getElementById('transaksiModal').classList.add('hidden');
        }
    </script>

</body>
</html>
