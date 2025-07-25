<?php
// register_member.php
include('../dbconnect.php');

// Ensure `event_id` is passed in the URL and handle its absence
if (isset($_GET['event_id'])) {
    $event_id = $_GET['event_id'];
} else {
    echo "Event ID is missing!";
    exit;
}

// Fetch all members who are not yet registered for this event
$sql = "SELECT * FROM members WHERE member_id NOT IN (SELECT member_id FROM member_event WHERE event_id = $event_id)";
$result = mysqli_query($conn, $sql);

// Handle Member Registration
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['register_member'])) {
    $member_id = $_POST['member_id'];

    // Insert the member into the member_event table to register them for the event
    $sql = "INSERT INTO member_event (member_id, event_id, completed) VALUES ($member_id, $event_id, 0)";
    
    if (mysqli_query($conn, $sql)) {
        echo "Member registered successfully!";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Member for Event</title>
</head>
<body>
    <h1>Register Member for Event</h1>

    <form action="register_member.php?event_id=<?php echo $event_id; ?>" method="POST">
        <label for="member_id">Select Member:</label>
        <select name="member_id" id="member_id" required>
            <?php while ($row = mysqli_fetch_assoc($result)): ?>
                <option value="<?php echo $row['id']; ?>"><?php echo $row['name']; ?></option>
            <?php endwhile; ?>
        </select><br><br>
        
        <input type="submit" name="register_member" value="Register Member">
    </form>
</body>
</html>

<?php
// Close the database connection
mysqli_close($conn);
?>
