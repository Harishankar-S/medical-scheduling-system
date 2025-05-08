<?php
$conn = new mysqli("localhost", "root", "", "cs366");

$name = $_POST['name'] ?? '';
$specialization = $_POST['specialization'] ?? '';
$availability = $_POST['availability'] ?? '';
$sort = $_POST['sort'] ?? '';

$query = "
  SELECT d.*, 
         (SELECT COUNT(*) FROM Appointments a WHERE a.doctor_id = d.doctor_id) AS appointment_count
  FROM Doctors d
  WHERE 1
";

$params = [];
$types = "";

if (!empty($name)) {
  $query .= " AND d.name LIKE ?";
  $params[] = "%$name%";
  $types .= "s";
}

if (!empty($specialization)) {
  $query .= " AND d.specialization LIKE ?";
  $params[] = "%$specialization%";
  $types .= "s";
}

if (!empty($availability)) {
  $query .= " AND d.availability LIKE ?";
  $params[] = "%$availability%";
  $types .= "s";
}

if ($sort === 'appointments') {
  $query .= " ORDER BY appointment_count DESC";
}

$stmt = $conn->prepare($query);

if (!empty($params)) {
  $stmt->bind_param($types, ...$params);
}

$stmt->execute();
$result = $stmt->get_result();

echo "<table class='appointment-table'>";
echo "<tr><th>Name</th><th>Specialization</th><th>Availability</th><th>Appointments</th></tr>";

while ($row = $result->fetch_assoc()) {
  echo "<tr>
          <td>" . htmlspecialchars($row['name']) . "</td>
          <td>" . htmlspecialchars($row['specialization']) . "</td>
          <td>" . htmlspecialchars($row['availability']) . "</td>
          <td>" . $row['appointment_count'] . "</td>
        </tr>";
}

echo "</table>";

$stmt->close();
$conn->close();
