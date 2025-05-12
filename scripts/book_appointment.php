<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
header("Content-Type: application/json");

// Auth check
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'patient' || !isset($_SESSION['patient_id'])) {
  echo json_encode(["success" => false, "message" => "Unauthorized"]);
  exit;
}

if (!isset($_POST['doctor_id'], $_POST['appointment_date'], $_POST['start_time'])) {
  echo json_encode(["success" => false, "message" => "Missing data"]);
  exit;
}

$doctor_id = intval($_POST['doctor_id']);
$date = $_POST['appointment_date'];
$time = $_POST['start_time'];
$patient_id = $_SESSION['patient_id'];

$conn = new mysqli("localhost", "root", "", "cs366");

// Get slot_id and scheduling_interval from Slots table
$slotQuery = $conn->prepare("SELECT slot_id FROM Slots WHERE doctor_id = ? AND appointment_date = ? AND start_time = ?");
$slotQuery->bind_param("iss", $doctor_id, $date, $time);
$slotQuery->execute();
$slotResult = $slotQuery->get_result();

if ($slotResult->num_rows === 0) {
  echo json_encode(["success" => false, "message" => "Slot not found"]);
  exit;
}

$slot = $slotResult->fetch_assoc();
$slot_id = $slot['slot_id'];
$status = 'scheduled';

// Insert appointment
$stmt = $conn->prepare("INSERT INTO Appointments (slot_id, doctor_id, patient_id, appointment_date, appointment_time, schedule_date, status) VALUES (?, ?, ?, ?, ?, NOW(), ?)");
$stmt->bind_param("iiisss", $slot_id, $doctor_id, $patient_id, $date, $time, $status);
$success = $stmt->execute();

if ($success) {
  // Mark slot as unavailable
  $update = $conn->prepare("UPDATE Slots SET is_available = 0 WHERE slot_id = ?");
  $update->bind_param("i", $slot_id);
  $update->execute();
}

echo json_encode(["success" => $success, "message" => $success ? "Booked!" : $conn->error]);

$stmt->close();
$slotQuery->close();
$conn->close();
