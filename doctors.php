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
  <script src="scripts/navbar.php"></script>

  <h2>Search Doctors</h2>
  <div class="container-centered">
    <?php
    $conn = new mysqli("localhost", "root", "", "cs366");

    // Get distinct specializations
    $specResult = $conn->query("SELECT DISTINCT specialization FROM Doctors ORDER BY specialization ASC");
    $specializations = [];
    while ($row = $specResult->fetch_assoc()) {
      $specializations[] = $row['specialization'];
    }
    $conn->close();
    ?>

    <form id="searchForm">
      <input type="text" name="name" placeholder="Search by name">

      <label for="specialization">Specialization:</label>
      <select name="specialization" id="specialization">
        <option value="">-- Any --</option>
        <?php foreach ($specializations as $spec): ?>
          <option value="<?= htmlspecialchars($spec) ?>"><?= htmlspecialchars($spec) ?></option>
        <?php endforeach; ?>
      </select>

      <label for="availability">Available on:</label>
      <select name="availability" id="availability">
        <option value="">-- Any --</option>
        <?php
        $days = ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'];
        foreach ($days as $day) {
          echo "<option value=\"$day\">$day</option>";
        }
        ?>
      </select>

      <label>
        Sort by:
        <select name="sort">
          <option value="">-- None --</option>
          <option value="appointments">Most Experienced</option>
          <option value="name">Name (A-Z)</option>
        </select>
      </label>

      <button type="submit">Search</button>
    </form>
  </div>

  <div id="results"></div>

  <script src="scripts/search_doctors.js"></script>
</body>
</html>
