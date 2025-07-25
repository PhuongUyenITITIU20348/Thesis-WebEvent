<?php
session_start();
include('../dbconnect.php');

// Lấy member_id từ session
$member_id = $_SESSION['member_id'] ?? 0;

// Nếu không hợp lệ, chặn truy cập
if ($member_id <= 0 || !is_numeric($member_id)) {
    echo "Invalid member ID.";
    exit;
}



// Lấy thông tin thành viên
$sql = "SELECT name, email, club_name FROM members WHERE member_id = $member_id";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) === 0) {
    echo "Member not found.";
    exit;
}
$user = mysqli_fetch_assoc($result);


// Tính tổng điểm rèn luyện
$point_result = mysqli_query($conn, "
    SELECT SUM(CASE WHEN completed = 1 THEN 5 ELSE 0 END) AS total_points 
    FROM member_event 
    WHERE member_id = $member_id
");
$points = mysqli_fetch_assoc($point_result)['total_points'] ?? 0;
$points = min((int)$points, 100);

// Lấy sự kiện đã tham gia
$events_sql = "
    SELECT e.event_name, e.event_date, me.completed
    FROM events e
    JOIN member_event me ON e.id = me.event_id
    WHERE me.member_id = $member_id
";
$events = mysqli_query($conn, $events_sql);
?>

<h2>Member Profile</h2>



<p><strong>Name:</strong> <?= htmlspecialchars($user['name']) ?></p>
<p><strong>Email:</strong> <?= htmlspecialchars($user['email']) ?></p>
<p><strong>Club:</strong> <?= htmlspecialchars($user['club_name']) ?></p>
<p><strong>Behavior Points:</strong> <?= $points ?> / 100</p>

<h3>Event Participation</h3>

<?php if (mysqli_num_rows($events) > 0): ?>
    <table border="1" cellpadding="10">
        <thead>
            <tr>
                <th>Event Name</th>
                <th>Date</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($e = mysqli_fetch_assoc($events)): ?>
                <tr>
                    <td><?= htmlspecialchars($e['event_name']) ?></td>
                    <td><?= $e['event_date'] ?></td>
                    <td><?= $e['completed'] ? '✅ Done' : '❌ Not Completed' ?></td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
<?php else: ?>
    <p>This member hasn't participated in any events yet.</p>
<?php endif; ?>

<!-- Back button -->
<p>
    <a href="../user/home.php"
       style="display:inline-block; margin-top:20px; padding:8px 16px; background:#007BFF; color:white; text-decoration:none; border-radius:5px;">
       ← Back to HomePage
    </a>
</p>

<?php mysqli_close($conn); ?>
