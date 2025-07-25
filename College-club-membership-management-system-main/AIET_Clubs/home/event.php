<?php
// event.php
include('../dbconnect.php');

// Initialize variables to avoid undefined variable warnings
$event_name = $event_date = $description = $image_path = '';

// Handle Create Event form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['create_event'])) {
    $event_name = $_POST['event_name'];
    $event_date = $_POST['event_date'];
    $description = $_POST['description'];
    $club_name = $_POST['club_name'];


    // Handle Image Upload
    if (isset($_FILES['event_image']) && $_FILES['event_image']['error'] == 0) {
        $upload_dir = 'uploads/'; // Directory where images will be uploaded
        $image_tmp_name = $_FILES['event_image']['tmp_name'];
        $image_name = time() . '_' . $_FILES['event_image']['name']; // Rename file to avoid conflicts
        $image_path = $upload_dir . $image_name;

        // Check if the file is an image and if its size is below the limit (e.g., 2MB)
        $image_file_type = strtolower(pathinfo($image_path, PATHINFO_EXTENSION));
        $allowed_types = ['jpg', 'jpeg', 'png', 'gif'];
        if (in_array($image_file_type, $allowed_types) && $_FILES['event_image']['size'] <= 2097152) { // 2MB limit
            // Move the uploaded file to the desired directory
            if (move_uploaded_file($image_tmp_name, $image_path)) {
                echo "Image uploaded successfully!<br>";
            } else {
                echo "Error uploading image.<br>";
            }
        } else {
            echo "Invalid file type or file size exceeds the limit.<br>";
        }
    }

    // SQL to insert the new event with image using prepared statements
    $sql = "INSERT INTO events (event_name, event_date, description, event_image, club_name) 
            VALUES (?, ?, ?, ?, ?)";
    
    if ($stmt = mysqli_prepare($conn, $sql)) {
        mysqli_stmt_bind_param($stmt, "ssssi", $event_name, $event_date, $description, $image_path, $club_name);
        if (mysqli_stmt_execute($stmt)) {
            echo "Event created successfully!";
        } else {
            echo "Error: " . mysqli_stmt_error($stmt) . "<br>";
        }
        mysqli_stmt_close($stmt);
    } else {
        echo "Error preparing the statement.<br>";
    }
}
    // Fetch clubs for the dropdown
$clubs = [];
$club_query = "SELECT club_name FROM clubinfo";
$club_result = mysqli_query($conn, $club_query);
if ($club_result && mysqli_num_rows($club_result) > 0) {
    while ($row = mysqli_fetch_assoc($club_result)) {
        $clubs[] = $row['club_name'];
    }
}


// Close the database connection
mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Events</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <!-- Main content section -->
    <main>
        <div class="container">
            <h1>Create New Event</h1>

            <!-- Create Event Form -->
            <form action="event.php" method="POST" enctype="multipart/form-data">
                <label for="event_name">Event Name:</label>
                <input type="text" name="event_name" id="event_name" value="<?php echo $event_name; ?>" required><br><br>

                <label for="event_date">Event Date:</label>
                <input type="date" name="event_date" id="event_date" value="<?php echo $event_date; ?>" required><br><br>

                <label for="description">Description:</label><br>
                <textarea name="description" id="description" rows="4" cols="50" required><?php echo $description; ?></textarea><br><br>

                <label for="event_image">Event Image:</label>
                <input type="file" name="event_image" id="event_image" accept="image/*"><br><br>
                <label for="club_name">Club:</label>
<select name="club_name" id="club_name" required>
    <option value="">-- Select a Club --</option>
    <?php foreach ($clubs as $club_name): ?>
        <option value="<?php echo htmlspecialchars($club_name); ?>">
            <?php echo htmlspecialchars($club_name); ?>
        </option>
    <?php endforeach; ?>
</select><br><br>


    <div style="display: flex; align-items: center; gap: 10px; margin-top: 10px;">
    <input type="submit" name="create_event" value="Create Event">
    
</div>
</form>
<div style="margin-top: 30px;">
  <?php include 'display_events.php'; ?>
</div>
        </div>
    </main>
</body>
</html>
