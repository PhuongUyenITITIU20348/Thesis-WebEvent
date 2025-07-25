<?php
include('../dbconnect.php');

// Lấy tất cả sự kiện
$sql = "SELECT * FROM events";
$result = mysqli_query($conn, $sql);
?>

<h2>List of Events</h2>

<table border="1" cellpadding="10">
    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Date</th>
            <th>Description</th>
            <th>Image</th>
            <th>View Members</th>
            <th>Operation</th>
        </tr>
    </thead>
    <tbody>
        <?php if (mysqli_num_rows($result) > 0): ?>
            <?php while ($row = mysqli_fetch_assoc($result)): ?>
                <tr>
                    <td><?= $row['id'] ?></td>
                    <td><?= $row['event_name'] ?></td>
                    <td><?= $row['event_date'] ?></td>
                    <td><?= $row['description'] ?></td>
                    <td>
                        <?php if (!empty($row['event_image'])): ?>
                            <img src="<?= $row['event_image'] ?>" alt="Event Image" width=auto height=auto>
                        <?php else: ?>
                            No Image
                        <?php endif; ?>
                    </td>
                    <td>
                        <a href="view_members.php?event_id=<?= $row['id'] ?>">View Members</a>
                    </td>
                    <td>
                        <a href="edit_event.php?id=<?= $row['id'] ?>">Edit</a> |
                        <a href="delete_event.php?id=<?= $row['id'] ?>" onclick="return confirm('Are you sure you want to delete this event?');">Delete</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        <?php else: ?>
            <tr><td colspan="7">No events found.</td></tr>
        <?php endif; ?>
    </tbody>
</table>

<?php mysqli_close($conn); ?>
