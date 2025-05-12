<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Manage Slots</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <header id="main-header"></header>
  <script src="scripts/navbar.php"></script>

  <h2>Manage Doctor Slots</h2>

  <div class="slot-nav">
    <button id="showAddBtn">Add Slot</button>
    <button id="showRemoveBtn">Remove Slot</button>
  </div>

  <div id="addSlotSection" style="display: block;">
    <?php include('admin_slots_add.php'); ?>
  </div>

  <div id="removeSlotSection" style="display: none;">
    <?php include('admin_slots_remove.php'); ?>
  </div>

  <h3>Upcoming Available Slots</h3>
  <?php
  $conn = new mysqli("localhost", "root", "", "cs366");
  $result = $conn->query("SELECT s.slot_id, d.name AS doctor_name, s.appointment_date, s.appointment_time 
                          FROM Slots s 
                          JOIN Doctors d ON s.doctor_id = d.doctor_id 
                          WHERE s.is_available = 1 
                          ORDER BY s.appointment_date, s.appointment_time 
                          LIMIT 15");
  ?>

  <table class="slot-table">
    <thead>
      <tr>
        <th>Doctor</th>
        <th>Date</th>
        <th>Time</th>
      </tr>
    </thead>
    <tbody>
      <?php while ($row = $result->fetch_assoc()): ?>
        <tr>
          <td><?= htmlspecialchars($row['doctor_name']) ?></td>
          <td><?= htmlspecialchars($row['appointment_date']) ?></td>
          <td><?= htmlspecialchars($row['appointment_time']) ?></td>
        </tr>
      <?php endwhile; ?>
    </tbody>
  </table>
  <?php $conn->close(); ?>

  <script>
    document.getElementById('showAddBtn').addEventListener('click', () => {
      document.getElementById('addSlotSection').style.display = 'block';
      document.getElementById('removeSlotSection').style.display = 'none';
    });

    document.getElementById('showRemoveBtn').addEventListener('click', () => {
      document.getElementById('addSlotSection').style.display = 'none';
      document.getElementById('removeSlotSection').style.display = 'block';
    });
  </script>
</body>
</html>
