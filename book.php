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
  <script src="./scripts/navbar.php"></script>

  <h2>Book a New Appointment</h2>
  <div class="container">
    <form id="bookingForm">
      <label>Doctor:</label>
      <select name="doctor_id" id="doctorSelect" required>
        <option value="">-- Select Doctor --</option>
        <?php
        $conn = new mysqli("localhost", "root", "", "cs366");
        $result = $conn->query("SELECT doctor_id, name FROM Doctors");
        $preselectedDoctor = isset($_GET['doctor_id']) ? intval($_GET['doctor_id']) : null;
        while ($row = $result->fetch_assoc()) {
          $selected = $row['doctor_id'] == $preselectedDoctor ? 'selected' : '';
          echo "<option value='{$row['doctor_id']}' $selected>{$row['name']}</option>";
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
  </div>

  <script src="./scripts/book_appointment.js"></script>
</body>
</html>
