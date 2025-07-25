<?php
session_start();
include('../dbconnect.php');

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['interests'])) {
    $member_id = $_SESSION['member_id'];
    $interests = $_POST['interests']; // là array

    // Xóa tất cả sở thích cũ
    $stmt_delete = $conn->prepare("DELETE FROM member_tags WHERE member_id = ?");
    $stmt_delete->bind_param("i", $member_id);
    $stmt_delete->execute();

    // Lưu lại từng tag
    $stmt_insert = $conn->prepare("INSERT INTO member_tags (member_id, tag) VALUES (?, ?)");
    foreach ($interests as $tag) {
        $clean_tag = trim($tag);
        $stmt_insert->bind_param("is", $member_id, $clean_tag);
        $stmt_insert->execute();
    }

    header("Location: ../userlogin.php");
    exit();
}
?>
