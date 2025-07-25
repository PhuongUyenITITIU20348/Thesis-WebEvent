<?php
include '../dbconnect.php';

$club_id = $_GET['updateid'];
$sql = "SELECT * FROM clubinfo WHERE club_id = $club_id";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);

$club_name = $row['club_name'];
$co_ordinator = $row['co_ordinator'];
$co_ordinator_id = $row['co_ordinator_id'];
$club_image = $row['club_image'];
$club_link = $row['club_link'];

if (isset($_POST['submit'])) {
    $club_name = $_POST['club_name'];
    $co_ordinator = $_POST['co_ordinator'];
    $co_ordinator_id = $_POST['co_ordinator_id'];
    $club_link = $_POST['club_link'];

    // Xử lý ảnh mới (nếu có)
    if ($_FILES['club_image']['name']) {
        $new_image = $_FILES['club_image']['name'];
        $tmp_name = $_FILES['club_image']['tmp_name'];
        $upload_path = "../images/" . basename($new_image);
        move_uploaded_file($tmp_name, $upload_path);
    } else {
        $new_image = $club_image; // giữ ảnh cũ
    }

    $sql = "UPDATE clubinfo 
            SET club_name = '$club_name',
                co_ordinator = '$co_ordinator',
                co_ordinator_id = '$co_ordinator_id',
                club_image = '$new_image',
                club_link = '$club_link'
            WHERE club_id = $club_id";

    $result = mysqli_query($conn, $sql);
    if ($result) {
        echo "<script>alert('Update successful!'); window.location.href='dashboard2.php';</script>";
    } else {
        echo "<script>alert('Error updating club: " . mysqli_error($conn) . "');</script>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Update Club</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-8">
  <div class="max-w-xl mx-auto bg-white p-6 rounded shadow">
    <h2 class="text-2xl font-bold text-center mb-6">Update Club</h2>
    <form method="POST" enctype="multipart/form-data">
      <label class="block mb-2">Club Name:</label>
      <input type="text" name="club_name" value="<?= htmlspecialchars($club_name) ?>" class="w-full border p-2 mb-4 rounded" required>

      <label class="block mb-2">Coordinator:</label>
      <input type="text" name="co_ordinator" value="<?= htmlspecialchars($co_ordinator) ?>" class="w-full border p-2 mb-4 rounded" required>

      <label class="block mb-2">Coordinator ID:</label>
      <input type="text" name="co_ordinator_id" value="<?= htmlspecialchars($co_ordinator_id) ?>" class="w-full border p-2 mb-4 rounded" required>

      <label class="block mb-2">Facebook Link:</label>
      <input type="url" name="club_link" value="<?= htmlspecialchars($club_link) ?>" class="w-full border p-2 mb-4 rounded">

      <label class="block mb-2">Club Image (optional):</label>
      <input type="file" name="club_image" accept="image/*" class="w-full border p-2 mb-4 rounded">
      <p class="text-sm text-gray-600 mb-4">Current image: <?= htmlspecialchars($club_image) ?></p>

      <button type="submit" name="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Update</button>
    </form>
  </div>
</body>
</html>
