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
} elseif ($sort === 'name') {
  $query .= " ORDER BY d.name ASC";
}

$stmt = $conn->prepare($query);

if (!empty($params)) {
  $stmt->bind_param($types, ...$params);
}

$stmt->execute();
$result = $stmt->get_result();

echo "<table class='appointment-table'>";
echo "<tr>
    <th>Name</th>
    <th>Specialization</th>
    <th>Availability</th>
    <th>Phone</th>
    <th>Email</th>
    <th>Appointments</th>
    <th>Book</th>
    </tr>";

while ($row = $result->fetch_assoc()) {
    echo "<tr>
        <td>" . htmlspecialchars($row['name']) . "</td>
        <td>" . htmlspecialchars($row['specialization']) . "</td>
        <td>" . htmlspecialchars($row['availability']) . "</td>
        <td>" . htmlspecialchars($row['phone_number']) . "</td>
        <td>" . htmlspecialchars($row['email']) . "</td>
        <td>" . $row['appointment_count'] . "</td>
        <td>
            <a href='book.php?doctor_id=" . $row['doctor_id'] . "' class='book-btn'>Book Now</a>
        </td>
      </tr>";

}

echo "</table>";

$stmt->close();
$conn->close();
