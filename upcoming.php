<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'patient') {
    header("Location: index.php");
    exit;
}

$patient_id = $_SESSION['patient_id'];
$conn = new mysqli("localhost", "root", "", "cs366");

// Get upcoming appointments
$stmt = $conn->prepare("
    SELECT 
        a.appointment_id, 
        a.appointment_date, 
        a.appointment_time, 
        a.status,
        d.name AS doctor_name
    FROM Appointments a
    JOIN Doctors d ON a.doctor_id = d.doctor_id
    WHERE a.patient_id = ?
    ORDER BY a.appointment_date DESC, a.appointment_time
");
$stmt->bind_param("i", $patient_id);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Your Appointments</title>
    <link rel="stylesheet" href="style.css">
</head>
  <body>
    <header id="main-header"></header>
    <script src="scripts/navbar.php"></script>
    <h2>Upcoming Appointments</h2>

    <?php if ($result->num_rows === 0): ?>
      <p>No upcoming appointments.</p>
    <?php else: ?>
      <table class="appointment-table">
        <thead>
          <tr>
            <th>Doctor</th>
            <th>Date</th>
            <th>Time</th>
            <th>Status</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          <?php while ($row = $result->fetch_assoc()): ?>
            <?php
              $statusClass = 'status-' . strtolower(str_replace(' ', '-', $row['status']));
            ?>
            <tr class="<?= htmlspecialchars($statusClass) ?>">
              <td><?= htmlspecialchars($row['doctor_name']) ?></td>
              <td><?= htmlspecialchars($row['appointment_date']) ?></td>
              <td><?= htmlspecialchars($row['appointment_time']) ?></td>
              <td><?= htmlspecialchars($row['status']) ?></td>
            <td>
              <?php if ($row['status'] === 'scheduled'): ?>
                <button class="cancel-btn" data-id="<?= $row['appointment_id'] ?>">Cancel</button>
              <?php else: ?>
                <em>N/A</em>
              <?php endif; ?>
            </td>

            </tr>
          <?php endwhile; ?>
        </tbody>
      </table>
    <?php endif; ?>

    <script src="./scripts/cancel_appointment.js"></script>
  </body>
</html>

<?php
$stmt->close();
$conn->close();
?>
