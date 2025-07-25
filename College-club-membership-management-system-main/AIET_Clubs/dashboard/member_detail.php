<?php
// member_detail.php
include('../dbconnect.php');

// Get the member's ID from the URL
$member_id = intval($_GET['id']);


// Query to fetch member's details
$sql = "SELECT * FROM members WHERE member_id = $member_id";
$result = mysqli_query($conn, $sql);

// Check if the member exists
if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);

    // Fetch member details
    $name = $row['name'];
    $club_name = $row['club_name'];
    
    // Fetch the events this member has participated in
    $event_sql = "SELECT e.event_name, me.completed FROM events e 
                  JOIN member_event me ON e.id = me.event_id 
                  WHERE me.member_id = $member_id";
    $event_result = mysqli_query($conn, $event_sql);

    // Calculate total points
    $total_points = 0;
    $events = [];
    if (mysqli_num_rows($event_result) > 0) {
        while ($event_row = mysqli_fetch_assoc($event_result)) {
            // Each completed event adds 5 points
            if ($event_row['completed'] == 1) {
                $total_points += 5;
            }
            // Store the event details in the events array
            $events[] = $event_row['event_name'];
        }
    }

    // Ensure points don't exceed the maximum of 100
    if ($total_points > 100) {
        $total_points = 100;
    }

    // Display member details and events
    echo "<h2>Member Details</h2>";
    echo "<p><strong>Name:</strong> " . $name . "</p>";
    echo "<p><strong>Club Name:</strong> " . $club_name . "</p>";

    echo "<h3>Events Participated:</h3>";
    if (count($events) > 0) {
        echo "<ul>";
        foreach ($events as $event) {
            echo "<li>" . $event . "</li>";
        }
        echo "</ul>";
    } else {
        echo "<p>This member has not participated in any events.</p>";
    }

    // Display the total points
    echo "<p><strong>Total Points:</strong> " . $total_points . " / 100</p>";
} else {
    echo "Member not found.";
}
// Back to member list
echo '<p><a href="../dashboard/behavior.php" style="text-decoration:none;">
        ← Back to Members List
      </a></p>';

// Close the database connection
mysqli_close($conn);
?>

