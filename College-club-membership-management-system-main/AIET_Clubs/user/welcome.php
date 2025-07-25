<?php
session_start();


$email = $_SESSION['email'];
$conn = mysqli_connect("localhost", "root", "", "aietclub");
if (!$conn) die("Kết nối thất bại");

// Lấy thông tin người dùng
$sql = "SELECT * FROM members WHERE email='$email'";
$result = mysqli_query($conn, $sql);
$user = mysqli_fetch_assoc($result);

echo "<h3>Chào mừng " . $user['name'] . "</h3>";
echo "<p>Sở thích của bạn: " . $user['interests'] . "</p>";
?>
