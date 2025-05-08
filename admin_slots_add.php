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
  <title>Generate Slots</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <h2>Generate Slots</h2>
  <form method="POST" action="scripts/generate_slots.php">
    <label for="doctor_id">Doctor:</label>
    <select name="doctor_id" required>
      <?php
      $conn = new mysqli("localhost", "root", "", "cs366");
      $result = $conn->query("SELECT doctor_id, name FROM Doctors");
      while ($row = $result->fetch_assoc()) {
        echo "<option value='{$row['doctor_id']}'>{$row['name']}</option>";
      }
      $conn->close();
      ?>
    </select><br>

    <label>Days Available:</label><br>
        <div style="display: flex; flex-wrap: wrap; gap: 10px; margin-bottom: 1em;">
        <?php
        $days = ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'];
        foreach ($days as $day) {
        echo "
            <label style='display: flex; align-items: center; gap: 5px;'>
            <input type='checkbox' name='days[]' value='$day'> $day
            </label>
        ";
        }
        ?>
        </div>

    <label>Start Time:</label>
    <input type="time" name="start_time" required><br>

    <label>End Time:</label>
    <input type="time" name="end_time" required><br>

    <label>Start Date:</label>
    <input type="date" name="start_date" required><br>

    <label>End Date:</label>
    <input type="date" name="end_date" required><br>

    <button type="submit">Generate Slots</button>
  </form>
</body>
</html>