<?php
include('../dbconnect.php');

// Lấy danh sách các club từ bảng clubinfo
$clubs = [];
$club_query = "SELECT club_name FROM clubinfo";
$club_result = mysqli_query($conn, $club_query);
if ($club_result && mysqli_num_rows($club_result) > 0) {
    while ($row = mysqli_fetch_assoc($club_result)) {
        $clubs[] = $row['club_name'];
    }
}

// Lấy event_id từ URL
if (!isset($_GET['id'])) {
    echo "No event ID provided.";
    exit;
}
$event_id = intval($_GET['id']);

// Lấy dữ liệu sự kiện hiện tại
$sql = "SELECT * FROM events WHERE id = $event_id";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) === 0) {
    echo "Event not found.";
    exit;
}
$event = mysqli_fetch_assoc($result);

// Xử lý form update
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $event_name = mysqli_real_escape_string($conn, $_POST['event_name']);
    $event_date = mysqli_real_escape_string($conn, $_POST['event_date']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $club_name = mysqli_real_escape_string($conn, $_POST['club_name']);

    // Mặc định giữ ảnh cũ
    $event_image = $event['event_image'];

    // Nếu có ảnh mới được upload
    if (isset($_FILES['event_image']) && $_FILES['event_image']['error'] === UPLOAD_ERR_OK) {
        $upload_dir = 'uploads/';
        $tmp_name = $_FILES['event_image']['tmp_name'];
        $image_name = time() . '_' . basename($_FILES['event_image']['name']);
        $new_image_path = $upload_dir . $image_name;

        $allowed = ['jpg', 'jpeg', 'png', 'gif'];
        $ext = strtolower(pathinfo($new_image_path, PATHINFO_EXTENSION));

        if (in_array($ext, $allowed) && $_FILES['event_image']['size'] <= 2097152) {
            if (move_uploaded_file($tmp_name, $new_image_path)) {
                $event_image = $new_image_path;
            } else {
                echo "Error: Image upload failed.<br>";
            }
        } else {
            echo "Error: Invalid file type or file too large (max 2MB).<br>";
        }
    }

    // Cập nhật cơ sở dữ liệu
    $update_sql = "UPDATE events 
                   SET event_name='$event_name', event_date='$event_date', description='$description', event_image='$event_image', club_name='$club_name'
                   WHERE id = $event_id";

    if (mysqli_query($conn, $update_sql)) {
        header("Location: display_events.php");
        exit;
    } else {
        echo "Error updating event: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Event</title>
</head>
<body>

<h2>Edit Event: <?= htmlspecialchars($event['event_name']) ?></h2>

<form method="POST" enctype="multipart/form-data">
    <label>Event Name:</label><br>
    <input type="text" name="event_name" value="<?= htmlspecialchars($event['event_name']) ?>" required><br><br>

    <label>Event Date:</label><br>
    <input type="date" name="event_date" value="<?= $event['event_date'] ?>" required><br><br>

    <label>Description:</label><br>
    <textarea name="description" rows="4" cols="50" required><?= htmlspecialchars($event['description']) ?></textarea><br><br>

    <label>Upload New Image (optional):</label><br>
    <input type="file" name="event_image" accept="image/*"><br><br>

    <?php if (!empty($event['event_image'])): ?>
        <p>Current Image:</p>
        <img src="<?= htmlspecialchars($event['event_image']) ?>" alt="Current Image" width="150"><br><br>
    <?php endif; ?>

    <label>Club:</label><br>
    <select name="club_name" required>
        <option value="">-- Select a Club --</option>
        <?php foreach ($clubs as $club): ?>
            <option value="<?= htmlspecialchars($club) ?>" <?= ($event['club_name'] == $club) ? 'selected' : '' ?>>
                <?= htmlspecialchars($club) ?>
            </option>
        <?php endforeach; ?>
    </select><br><br>

    <button type="submit">Update Event</button>
</form>

<!-- Nút quay về -->
<p>
    <a href="display_events.php"
       style="display:inline-block; margin-top: 20px; padding: 8px 16px; background-color: #6c757d; color: white; text-decoration: none; border-radius: 5px;">
       ← Back to Events
    </a>
</p>

</body>
</html>

<?php mysqli_close($conn); ?>
