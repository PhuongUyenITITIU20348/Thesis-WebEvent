<?php
include('../dbconnect.php');

// Xử lý khi submit form
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $member_id = intval($_POST['member_id']);
    $event_id = intval($_POST['event_id']);
    $completed = isset($_POST['completed']) ? 1 : 0;

    // Kiểm tra trùng lặp
    $check_sql = "SELECT * FROM member_event WHERE member_id = $member_id AND event_id = $event_id";
    $check_result = mysqli_query($conn, $check_sql);

    if (mysqli_num_rows($check_result) > 0) {
        echo "<p style='color:red;'>This member is already registered for this event.</p>";
    } else {
        // Insert bản ghi mới
        $insert_sql = "INSERT INTO member_event (member_id, event_id, completed)
                       VALUES ($member_id, $event_id, $completed)";
        if (mysqli_query($conn, $insert_sql)) {
            echo "<p style='color:green;'>Member successfully registered for the event!</p>";
        } else {
            echo "<p style='color:red;'>Error: " . mysqli_error($conn) . "</p>";
        }
    }
}

// Lấy danh sách thành viên
$members = mysqli_query($conn, "SELECT member_id, name FROM members");

// Lấy danh sách sự kiện
$events = mysqli_query($conn, "SELECT id, event_name FROM events");
?>

<h2>Register Member for Event</h2>

<form method="POST">
    <label for="member_id">Select Member:</label><br>
    <select name="member_id" required>
        <option value="">-- Choose Member --</option>
        <?php while ($row = mysqli_fetch_assoc($members)): ?>
            <option value="<?= $row['member_id'] ?>"><?= $row['name'] ?> (ID: <?= $row['member_id'] ?>)</option>
        <?php endwhile; ?>
    </select><br><br>

    <label for="event_id">Select Event:</label><br>
    <select name="event_id" required>
        <option value="">-- Choose Event --</option>
        <?php while ($row = mysqli_fetch_assoc($events)): ?>
            <option value="<?= $row['id'] ?>"><?= $row['event_name'] ?> (ID: <?= $row['id'] ?>)</option>
        <?php endwhile; ?>
    </select><br><br>

    <label>
        <input type="checkbox" name="completed" value="1">
        Mark as Completed
    </label><br><br>

    <button type="submit">Register</button>
</form>
<p>
    <a href="../dashboard/behavior.php" 
       style="display: inline-block; margin-top: 20px; padding: 10px 20px; background-color: #28a745; color: white; text-decoration: none; border-radius: 5px;">
       ← Back to Behavior Page
    </a>
</p>