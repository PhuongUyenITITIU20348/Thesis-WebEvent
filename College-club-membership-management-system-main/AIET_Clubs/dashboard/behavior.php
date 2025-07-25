<?php
include('../dbconnect.php');

$sql = "SELECT m.member_id, m.name, m.club_name, 
               SUM(CASE WHEN me.completed = 1 THEN 5 ELSE 0 END) AS total_points
        FROM members m
        LEFT JOIN member_event me ON m.member_id = me.member_id
        GROUP BY m.member_id, m.name, m.club_name";

$result = mysqli_query($conn, $sql);

?>

<h2>Member Behavior Points</h2>
<table border="1" cellpadding="10">
    <thead>
        <tr>
            <th>Member ID</th>
            <th>Name</th>
            <th>Club</th>
            <th>Points</th>
        </tr>
    </thead>
    <tbody>
        <?php while ($row = mysqli_fetch_assoc($result)): ?>
            <tr>
                <td><?= $row['member_id'] ?></td>
                <td><?= $row['name'] ?></td>
                <td><?= $row['club_name'] ?></td>
                <td><?= min($row['total_points'], 100) ?> / 100</td>
            </tr>
        <?php endwhile; ?>
    </tbody>
</table>

<p>
    <a href="../home/home.php" 
       style="display: inline-block; margin-top: 20px; padding: 10px 20px; background-color: #28a745; color: white; text-decoration: none; border-radius: 5px;">
       ← Back to HomePage
    </a>
</p>


<?php mysqli_close($conn); ?>
