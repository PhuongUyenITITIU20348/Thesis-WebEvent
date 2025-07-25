<?php
include '../dbconnect.php';

if (isset($_POST['add'])) {
    //$club_id = $_POST['club_id'];
    $club_name = $_POST['club_name'];
    $coordinator = $_POST['co_ordinator'];
    $coordinator_id = $_POST['co_ordinator_id'];
    $club_link = $_POST['club_link'];
    
    // Xử lý ảnh upload
    $image_name = $_FILES['club_image']['name'];
    $image_tmp = $_FILES['club_image']['tmp_name'];

    // Nếu có ảnh, lưu vào thư mục images
    if ($image_name != "") {
        $target_path = "../images/" . basename($image_name);
        move_uploaded_file($image_tmp, $target_path);
    } else {
        $image_name = "default-club.png"; // fallback nếu không có ảnh
    }

    // Chèn vào DB
    $sql = "INSERT INTO clubinfo (club_name, co_ordinator, co_ordinator_id, club_image, club_link)
        VALUES ('$club_name', '$coordinator', '$coordinator_id', '$image_name', '$club_link')";

    if (mysqli_query($conn, $sql)) {
        echo "<script>alert('Club added successfully!');</script>";
    } else {
        echo "<script>alert('Error adding club: " . mysqli_error($conn) . "');</script>";
    }
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"
  />
    <title>Add Clubs</title>
</head>
<body>
 
    <div class="flex items-center justify-center min-h-screen bg-orange-100">
        <div class="px-8 py-6 mx-4 mt-4 text-left bg-white shadow-lg md:w-1/3 lg:w-1/3 sm:w-1/3 animate__animated animate__slideInDown">
            <div class="flex justify-center">

                
            </div>
            <h3 class="text-2xl font-bold text-center">ADD HERE</h3>
            <form method="POST" enctype="multipart/form-data">
  <label>Club Name:</label>
  <input type="text" name="club_name" required class="border p-2 rounded w-full mb-4">

  <label>Coordinator:</label>
  <input type="text" name="co_ordinator" required class="border p-2 rounded w-full mb-4">

  <label>Coordinator ID:</label>
  <input type="text" name="co_ordinator_id" required class="border p-2 rounded w-full mb-4">

  <label>Club Image:</label>
  <input type="file" name="club_image" accept="image/*" class="border p-2 rounded w-full mb-4">
  <label>Link:</label>
<input type="url" name="club_link" placeholder="https://facebook.com/..." class="border p-2 rounded w-full mb-4">

  <button type="submit" name="add" class="bg-blue-600 items-center text-white px-4 py-2 rounded hover:bg-blue-700">
    Add Club
  </button>
</form>

        </div>
    </div>
</body>
</html>