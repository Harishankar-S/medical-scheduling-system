<?php
header("Content-Type: application/json");

if (!isset($_GET['doctor_id']) || !isset($_GET['date'])) {
  echo json_encode([]);
  exit;
}

$doctor_id = intval($_GET['doctor_id']);
$date = $_GET['date'];

$conn = new mysqli("localhost", "root", "", "cs366");

if ($conn->connect_error) {
  echo json_encode([]);
  exit;
}

$stmt = $conn->prepare("SELECT start_time FROM Slots WHERE doctor_id = ? AND appointment_date = ? AND is_available = 1");
$stmt->bind_param("is", $doctor_id, $date);
$stmt->execute();
$result = $stmt->get_result();

$slots = [];
while ($row = $result->fetch_assoc()) {
  $slots[] = ["time" => $row["start_time"]];
}

echo json_encode($slots);
$stmt->close();
$conn->close();
