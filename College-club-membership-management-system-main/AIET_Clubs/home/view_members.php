<?php
include('../dbconnect.php');

$event_id = isset($_GET['event_id']) ? intval($_GET['event_id']) : 0;
// Cập nhật trạng thái nếu form được submit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $member_id = intval($_POST['member_id']);
    $event_id = intval($_POST['event_id']);
    $completed = ($_POST['completed'] === '1') ? 1 : 0;

    // Cập nhật trạng thái
    $update_sql = "UPDATE member_event SET completed = $completed WHERE member_id = $member_id AND event_id = $event_id";
    mysqli_query($conn, $update_sql);
}

// Lấy tên sự kiện
$event_query = mysqli_query($conn, "SELECT event_name FROM events WHERE id = $event_id");
$event_name = ($row = mysqli_fetch_assoc($event_query)) ? $row['event_name'] : 'Unknown';

// Lấy thành viên đã đăng ký
$sql = "SELECT m.member_id, m.name, m.email, m.club_name, me.completed
        FROM members m
        JOIN member_event me ON m.member_id = me.member_id
        WHERE me.event_id = $event_id";

$result = mysqli_query($conn, $sql);
?>

<h2>Members Registered for: <?= htmlspecialchars($event_name) ?></h2>

<?php if (mysqli_num_rows($result) > 0): ?>
<table border="1" cellpadding="10">
    <thead>
        <tr>
            <th>Member ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Club</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
        <?php while ($row = mysqli_fetch_assoc($result)): ?>
            <tr>
                <td><?= $row['member_id'] ?></td>
                <td><?= $row['name'] ?></td>
                <td><?= $row['email'] ?></td>
                <td><?= $row['club_name'] ?></td>
                <td><form method="POST" style="margin:0;">
    <input type="hidden" name="member_id" value="<?= $row['member_id'] ?>">
    <input type="hidden" name="event_id" value="<?= $event_id ?>">
    <select name="completed" onchange="this.form.submit()">
        <option value="1" <?= $row['completed'] ? 'selected' : '' ?>>Done</option>
        <option value="0" <?= !$row['completed'] ? 'selected' : '' ?>>Not Completed</option>
    </select>
</form>
</td>
            </tr>
        <?php endwhile; ?>
    </tbody>
</table>
<?php else: ?>
    <p>No members have registered for this event.</p>
<?php endif; ?>

<p>
    <a href="display_events.php"
       style="display:inline-block; margin-top:20px; padding:8px 16px; background:#007BFF; color:white; text-decoration:none; border-radius:5px;">
       ← Back to Events
    </a>
</p>
<p>
    <a href="../dashboard/behavior.php"
       style="display:inline-block; margin-top: 20px; padding: 8px 16px; background-color: #28a745; color: white; text-decoration: none; border-radius: 5px;">
       ← Back to Behavior Page
    </a>
</p>
<?php mysqli_close($conn); ?>
