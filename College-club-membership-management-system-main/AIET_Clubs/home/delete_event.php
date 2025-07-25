<?php
// delete_event.php
include('../dbconnect.php');

// Kiểm tra xem đã truyền ID của sự kiện chưa
if (isset($_GET['id'])) {
    $event_id = intval($_GET['id']);

    // Xóa bản ghi trong bảng member_event trước (do ràng buộc khóa ngoại)
    $delete_member_event = "DELETE FROM member_event WHERE event_id = $event_id";
    mysqli_query($conn, $delete_member_event);

    // Xóa sự kiện chính
    $delete_event = "DELETE FROM events WHERE id = $event_id";
    $result = mysqli_query($conn, $delete_event);

    if ($result) {
        echo "<script>alert('Event deleted successfully'); window.location.href='display_events.php';</script>";
    } else {
        echo "<script>alert('Error deleting event: " . mysqli_error($conn) . "');</script>";
    }
} else {
    echo "<script>alert('No event ID provided'); window.location.href='display_events.php';</script>";
}
?>
