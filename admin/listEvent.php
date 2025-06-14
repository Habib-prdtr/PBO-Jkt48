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
    <title>List Event</title>
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
                <!-- Button to Insert New Event -->
                <div class="mb-4">
                    <a href="index.php?modul=event&fitur=input" class="bg-indigo-500 hover:bg-indigo-600 text-white font-semibold py-2 px-4 rounded-lg transition duration-300">
                        Insert New Event
                    </a>
                </div>

                <!-- Events Table -->
                <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                    <table class="w-full text-sm text-left text-gray-600">
                        <thead class="text-xs text-gray-700 uppercase bg-indigo-50">
                            <tr>
                                <th scope="col" class="px-6 py-3">Event ID</th>
                                <th scope="col" class="px-6 py-3">Foto</th>
                                <th scope="col" class="px-6 py-3">Name</th>
                                <th scope="col" class="px-6 py-3">Date</th>
                                <th scope="col" class="px-6 py-3">Place</th>
                                <th scope="col" class="px-6 py-3">Price</th>
                                <th scope="col" class="px-6 py-3">Stock</th>
                                <th scope="col" class="px-6 py-3">Event Type</th>
                                <th scope="col" class="px-6 py-3 text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $index = 1;
                            // Loop through each event
                            foreach ($events as $event) {
                            ?>
                                <tr class="bg-white border-b hover:bg-indigo-50">
                                    <!-- Event ID -->
                                    <td class="px-6 py-4"><?php echo $index++; ?></td>
                                  
                                    <!-- Foto -->
                                    <td class="px-6 py-4">
                                        <img src="../images/event/<?php echo htmlspecialchars($event['foto']); ?>" alt="Foto Event" class="w-16 h-16 rounded-full object-cover">
                                    </td>
                                    
                                    <!-- Name -->
                                    <td class="px-6 py-4"><?php echo htmlspecialchars($event['nama']); ?></td>

                                    <!-- Date -->
                                    <td class="px-6 py-4"><?php echo htmlspecialchars($event['tanggal']); ?></td>
                                  
                                    <!-- Place -->
                                    <td class="px-6 py-4"><?php echo htmlspecialchars($event['tempat']); ?></td>
                                  
                                    <!-- Price -->
                                    <td class="px-6 py-4"><?php echo htmlspecialchars($event['harga']); ?> IDR</td>

                                    <!-- Stock -->
                                    <td class="px-6 py-4"><?php echo htmlspecialchars($event['stok']); ?></td>

                                    <!-- Event Type -->
                                    <td class="px-6 py-4"><?php echo htmlspecialchars($event['tipeEvent']); ?></td>

                                    <!-- Action -->
                                    <td class="px-6 py-4 text-center">
                                        <a href="index.php?modul=event&fitur=edit&id=<?php echo $event['id']; ?>" class="bg-green-500 hover:bg-green-600 text-white font-semibold py-1 px-2 rounded-lg mr-2 transition duration-200">Update</a>
                                        <a href="index.php?modul=event&fitur=delete&id=<?php echo $event['id']; ?>" onclick="return confirm('Apakah Anda yakin ingin menghapus event ini?')" class="bg-red-500 hover:bg-red-600 text-white font-semibold py-1 px-2 rounded-lg mr-2 transition duration-200">Delete</a>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</body>
</html>
