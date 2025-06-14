<?php 
if (!isset($_SESSION['login'])) {
    header('Location: ../user/login.php');
    exit;
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List Top-Up</title>
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
                <!-- Top-Up Table -->
                <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                    <table class="w-full text-sm text-left text-gray-600">
                        <thead class="text-xs text-gray-700 uppercase bg-indigo-50">
                            <tr>
                                <th scope="col" class="px-6 py-3">Top-Up ID</th>
                                <th scope="col" class="px-6 py-3">User ID</th>
                                <th scope="col" class="px-6 py-3">Jumlah Point</th>
                                <th scope="col" class="px-6 py-3">Tanggal Top-Up</th>
                                <th scope="col" class="px-6 py-3">Status</th>
                                <th scope="col" class="px-6 py-3 text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $index = 1;
                            // Loop through each top-up
                            foreach ($topUps as $topUp) {
                            ?>
                                <tr class="bg-white border-b hover:bg-indigo-50">
                                    <!-- Top-Up ID -->
                                    <td class="px-6 py-4"><?php echo $index++; ?></td>

                                    <!-- User ID -->
                                    <td class="px-6 py-4"><?php echo htmlspecialchars($topUp['userId']); ?></td>

                                    <!-- Jumlah Point -->
                                    <td class="px-6 py-4"><?php echo htmlspecialchars($topUp['jumlahPoint']); ?> Point</td>

                                    <!-- Tanggal Top-Up -->
                                    <td class="px-6 py-4"><?php echo htmlspecialchars($topUp['tanggal']); ?></td>

                                    <!-- Status -->
                                    <td class="px-6 py-4 
                                        <?php echo ($topUp['status'] === 'rejected') ? 'text-red-500' : ($topUp['status'] === 'approved' ? 'text-blue-500' : ''); ?>">
                                        <?php echo htmlspecialchars($topUp['status']); ?>
                                    </td>


                                    <!-- Action -->
                                    <td class="px-6 py-4 text-center">
                                        <!-- Detail Button (Trigger Modal) -->
                                        <button onclick="openModal(<?php echo htmlspecialchars($topUp['id']); ?>, '<?php echo htmlspecialchars($topUp['userId']); ?>', <?php echo htmlspecialchars($topUp['jumlahPoint']); ?>, '<?php echo htmlspecialchars($topUp['tanggal']); ?>', '<?php echo htmlspecialchars($topUp['status']); ?>')" class="bg-blue-500 hover:bg-blue-600 text-white font-semibold py-1 px-2 rounded-lg mr-2 transition duration-200">Detail</button>

                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal for Top-Up Details -->
    <div id="topUpModal" class="fixed inset-0 bg-gray-500 bg-opacity-50 hidden flex justify-center items-center">
        <div class="bg-white p-6 rounded-lg shadow-lg w-1/3">
            <h3 class="text-xl font-semibold mb-4" id="topUpTitle">Detail Top-Up</h3>
            <div id="modalContent">
                <!-- Modal Content Will Be Populated Here -->
            </div>
            <div class="flex justify-end mt-4">
                <button onclick="closeModal()" class="bg-gray-500 hover:bg-gray-600 text-white font-semibold py-1 px-3 rounded-lg">Close</button>
                <a href="#" id="approveBtn" class="bg-green-500 hover:bg-green-600 text-white font-semibold py-1 px-3 rounded-lg ml-2">Approve</a>
                <a href="#" id="rejectBtn" class="bg-red-500 hover:bg-red-600 text-white font-semibold py-1 px-3 rounded-lg ml-2">Reject</a>

            </div>
        </div>
    </div>

    <script>
        function openModal(id, userId, jumlahPoint, tanggal, status) {
    console.log('Status:', status);  // Debugging log

    // Populate modal content
    const modalContent = document.getElementById('modalContent');
    const title = document.getElementById('topUpTitle');
    const approveBtn = document.getElementById('approveBtn');
    const rejectBtn = document.getElementById('rejectBtn');

    title.innerText = `Detail Top-Up ID: ${id}`;
    modalContent.innerHTML = `
        <p><strong>User ID:</strong> ${userId}</p>
        <p><strong>Jumlah Top-Up:</strong> ${jumlahPoint} Point</p>
        <p><strong>Tanggal Top-Up:</strong> ${tanggal}</p>
        <p><strong>Status:</strong> ${status}</p>
    `;

    // Set the action URLs for approve/reject
    approveBtn.href = `index.php?modul=topUp&fitur=approve&id=${id}`;
    rejectBtn.href = `index.php?modul=topUp&fitur=reject&id=${id}`;

    // Check the status and hide buttons if the status is 'approve' or 'reject'
    if (status === 'approved' || status === 'rejected') {
        approveBtn.classList.add('hidden');
        rejectBtn.classList.add('hidden');
    } else {
        approveBtn.classList.remove('hidden');
        rejectBtn.classList.remove('hidden');
    }

    // Show the modal
    document.getElementById('topUpModal').classList.remove('hidden');
}



        function closeModal() {
            // Hide the modal
            document.getElementById('topUpModal').classList.add('hidden');
        }
    </script>

</body>
</html>
