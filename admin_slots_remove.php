<?php
$conn = new mysqli("localhost", "root", "", "cs366");

$result = $conn->query("SELECT s.slot_id, d.name AS doctor_name, s.appointment_date, s.appointment_time 
                        FROM Slots s 
                        JOIN Doctors d ON s.doctor_id = d.doctor_id 
                        WHERE s.is_available = 1 
                        ORDER BY s.appointment_date, s.appointment_time 
                        LIMIT 50");

if ($result->num_rows === 0): ?>
  <p>No available slots to remove.</p>
<?php else: ?>
    <div class="container">
        <form method="POST" action="scripts/remove_slot.php">
            <table class="slot-table">
            <thead>
                <tr>
                <th>Select</th>
                <th>Doctor</th>
                <th>Date</th>
                <th>Time</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><input type="checkbox" name="slot_ids[]" value="<?= $row['slot_id'] ?>"></td>
                    <td><?= htmlspecialchars($row['doctor_name']) ?></td>
                    <td><?= htmlspecialchars($row['appointment_date']) ?></td>
                    <td><?= htmlspecialchars($row['appointment_time']) ?></td>
                </tr>
                <?php endwhile; ?>
            </tbody>
            </table>
            <button type="submit">Remove Selected Slots</button>
        </form>
    </div>
<?php endif;

$conn->close();
?>
