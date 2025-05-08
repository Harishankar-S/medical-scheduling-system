<?php
header("Content-Type: application/json");

if (!isset($_POST['doctor_id'], $_POST['appointment_date'], $_POST['appointment_time'])) {
  echo json_encode(["success" => false, "message" => "Missing data"]);
  exit;
}

$doctor_id = intval($_POST['doctor_id']);
$date = $_POST['appointment_date'];
$time = $_POST['appointment_time'];

$conn = new mysqli("localhost", "root", "", "cs366");

// For now, we'll assume a hardcoded patient_id
$patient_id = 1;

$stmt = $conn->prepare("INSERT INTO Appointments (doctor_id, patient_id, appointment_date, appointment_time) VALUES (?, ?, ?, ?)");
$stmt->bind_param("iiss", $doctor_id, $patient_id, $date, $time);
$success = $stmt->execute();

if ($success) {
  // Mark slot as unavailable
  $update = $conn->prepare("UPDATE Slots SET is_available = 0 WHERE doctor_id = ? AND appointment_date = ? AND appointment_time = ?");
  $update->bind_param("iss", $doctor_id, $date, $time);
  $update->execute();
}

echo json_encode(["success" => $success, "message" => $conn->error]);

$stmt->close();
$conn->close();
