<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'patient') {
    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Book Appointment</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <header id="main-header"></header>

  <h2>Book a New Appointment</h2>
  <form id="bookingForm">
    <label>Doctor:</label>
    <select name="doctor_id" id="doctorSelect" required>
      <option value="">-- Select Doctor --</option>
      <?php
      $conn = new mysqli("localhost", "root", "", "cs366");
      $result = $conn->query("SELECT doctor_id, name FROM Doctors");
      while ($row = $result->fetch_assoc()) {
        echo "<option value='{$row['doctor_id']}'>{$row['name']}</option>";
      }
      $conn->close();
      ?>
    </select><br>

    <label>Date:</label>
    <input type="date" id="dateInput" name="appointment_date" required><br>

    <label>Time Slot:</label>
    <select id="timeSlotSelect" name="start_time" required>
      <option value="">Select a doctor and date first.</option>
    </select><br>

    <button type="submit">Confirm Appointment</button>
  </form>

  <script src="./scripts/book_appointment.js"></script>
</body>
</html>
