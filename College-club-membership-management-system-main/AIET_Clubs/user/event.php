<?php
session_start();
include('../dbconnect.php');

//$recommendations = json_decode(file_get_contents("../recommendations.json"), true);
$member_id = $_SESSION['member_id'] ?? 0;

if (!$member_id) {
    header("Location: ../userlogin.php");
    exit();
}

// Lấy interests từ members
// Lấy tags từ bảng mới
$stmt = $conn->prepare("SELECT tag FROM member_tags WHERE member_id = ?");
$stmt->bind_param("i", $member_id);
$stmt->execute();
$result = $stmt->get_result();
$tags = array_column($result->fetch_all(MYSQLI_ASSOC), 'tag');

$events = [];

if (!empty($tags)) {
    $placeholders = implode(',', array_fill(0, count($tags), '?'));

    $sql = "SELECT DISTINCT e.*
            FROM events e
            JOIN event_tags et ON e.id = et.event_id
            WHERE et.tag IN ($placeholders)
            ORDER BY e.event_date DESC";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param(str_repeat('s', count($tags)), ...$tags);
    $stmt->execute();
    $result = $stmt->get_result();
    $events = $result->fetch_all(MYSQLI_ASSOC);
}


// Xử lý đăng ký sự kiện
if (isset($_POST['register']) && $member_id > 0) {
    $event_id = intval($_POST['event_id']);

    $check = mysqli_query($conn, "SELECT * FROM member_event WHERE member_id = $member_id AND event_id = $event_id");
    if (mysqli_num_rows($check) === 0) {
        mysqli_query($conn, "INSERT INTO member_event (member_id, event_id, completed) VALUES ($member_id, $event_id, 0)");
        echo "<script>
            alert('✅ Successfully registered for event ID $event_id.');
            setTimeout(function() {
                window.location.href = 'profile.php';
            }, 2000);
        </script>";
    } else {
        $message = "⚠️ You already registered for this event.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Available Events</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="p-8 bg-gray-50">
    <!-- Header -->
    <div class="navbarheader">
        <div class="flex justify-center">
            <div class="self-center top-0 w-full max-w-7xl">
                <div class="flex justify-between items-center text-gray-700">
                    <div class="mx-8 my-4">
                        <div class="flex items-center space-x-4">
                            <img src="../images/logoIU.png" alt="Logo" class="h-14 w-auto object-contain" />
                        </div>
                    </div>
                    <ul class="hidden md:flex items-center text-[18px] font-semibold pr-10">
                        <li class="text-stone-600 hover:text-blue-600 font-medium mx-4"><a href="home.php">Home</a></li>
                        <li class="text-stone-600 hover:text-blue-600 font-medium mx-4"><a href="clubs.php">Our Clubs</a></li>
                        <li class="text-blue-600 font-bold mx-4"><a href="event.php">Event</a></li>
                        <li class="text-stone-600 hover:text-blue-600 font-medium mx-4"><a href="contact.php">Contact</a></li>
                        <li class="text-stone-600 hover:text-blue-600 font-medium mx-4"><a href="../index.php">Sign out</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Thông báo -->
    <?php if (isset($message)): ?>
        <div class="bg-yellow-100 border border-yellow-400 text-yellow-700 px-4 py-2 mb-4 rounded">
            <?= $message ?>
        </div>
    <?php endif; ?>

    <!-- Gợi ý sự kiện -->
    <div class="mt-8">
        

        <?php if (empty($events)): ?>
            <p class="text-red-600">⚠️ Không có sự kiện nào phù hợp với sở thích của bạn vào lúc này.</p>
        <?php else: ?>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <?php foreach ($events as $row): ?>
                    <div class="border rounded-lg p-4 shadow bg-white">
                        <img src="<?= htmlspecialchars($row['event_image']) ?>" alt="Event Image"
                             class="w-full h-40 object-cover rounded mb-2">
                        <h3 class="text-xl font-semibold text-gray-800"><?= htmlspecialchars($row['event_name']) ?></h3>

                        <?php if (in_array($row['id'], $recommendations[$member_id] ?? [])): ?>
                            <span class="inline-block text-green-600 font-semibold text-sm">🌟 Recommended for you</span>
                        <?php endif; ?>

                        <p class="text-gray-600 text-sm">📅 <?= $row['event_date'] ?></p>
                        <p class="mt-2 text-gray-700"><?= htmlspecialchars($row['description']) ?></p>

                        <!-- Đăng ký -->
                        <form method="POST" action="event.php" class="mt-4">
                            <input type="hidden" name="event_id" value="<?= $row['id'] ?>">
                            <button type="submit" name="register"
                                    class="text-white bg-blue-600 px-4 py-1 rounded hover:bg-blue-700">
                                Đăng ký
                            </button>
                        </form>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>

    <p class="mt-6">
        <a href="home.php" class="text-blue-600 hover:underline">← Back to homepage</a>
    </p>

<?php mysqli_close($conn); ?>
</body>
</html>
