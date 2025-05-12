<?php
session_start();
if (!isset($_SESSION['role'])) {
    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Find a Doctor</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <header id="main-header"></header>

  <h2>Search Doctors</h2>
  <form id="searchForm">
    <input type="text" name="name" placeholder="Search by name">
    <input type="text" name="specialization" placeholder="Specialization (e.g., Cardiology)">
    <input type="text" name="availability" placeholder="Availability (e.g., Mon, Tue)">
    <label>
      Sort by:
      <select name="sort">
        <option value="">-- None --</option>
        <option value="appointments">Most Experienced</option>
      </select>
    </label>
    <button type="submit">Search</button>
  </form>

  <div id="results"></div>

  <script src="scripts/search_doctors.js"></script>
</body>
</html>
