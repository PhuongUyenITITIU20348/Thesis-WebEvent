<?php
include '../dbconnect.php';

// Lấy danh sách CLB từ bảng clubinfo
$clubs = mysqli_query($conn, "SELECT * FROM clubinfo ORDER BY club_id ASC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Our Clubs</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
</head>
<body class="bg-[#f1f5f9]">

  <!-- Header -->
  <div class="flex justify-between items-center px-8 py-4 bg-white shadow">
    <img src="../images/logoIU.png" alt="Logo" class="h-14 w-auto">
    <ul class="flex space-x-6 text-lg font-semibold text-gray-700">
      <li><a href="home.php" class="hover:text-blue-600">Home</a></li>
      <li><a href="../dashboard/dashboard.php" class="hover:text-blue-600">Dashboard</a></li>
      <li><a href="clubs.php" class="hover:text-blue-600">Our Clubs</a></li>
      <li><a href="event.php" class="hover:text-blue-600">Event</a></li>
      <li><a href="contact.php" class="hover:text-blue-600">Contact</a></li>
      <li><a href="../index.php" class="hover:text-blue-600">Sign out</a></li>
    </ul>
  </div>

  <!-- Title -->
  <div class="text-3xl text-green-600 font-bold text-center mt-10 mb-6 animate__animated animate__fadeInDown">
    OUR CLUBS
  </div>

  <!-- Club Grid -->
  <div class="flex flex-col items-center justify-evenly my-12 lg:px-10 lg:flex-row flex-wrap gap-10">
    <?php
    $index = 1;
    while ($club = mysqli_fetch_assoc($clubs)):
    ?>
    <div class="flex flex-col justify-center items-center p-10 bg-white shadow w-[90%] md:w-[70%] lg:w-[30%] overflow-hidden animate__animated animate__flipInY">
      
      <h2 class="text-xl font-bold text-green-700 mb-2 hover:underline">
  <a href="<?= htmlspecialchars($club['club_link']) ?>" target="_blank">
    <?= $index++ . '. ' . strtoupper(htmlspecialchars($club['club_name'])) ?>
  </a>
</h2>


      <p class="text-black mt-1 text-center w-[90%] lg:w-[100%]">
        <?= htmlspecialchars($club['co_ordinator']) ?> - CLB trực thuộc trường Đại học Quốc Tế - ĐHQG TP.HCM
      </p>

      <!-- Placeholder ảnh CLB -->
      <img src="../images/<?= htmlspecialchars($club['club_image']) ?>" 
     class="rounded-full mt-4 w-40 h-40 object-cover" 
     alt="<?= htmlspecialchars($club['club_name']) ?> Logo" />

    </div>
    <?php endwhile; ?>
  </div>

</body>
</html>
