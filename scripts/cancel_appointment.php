<?php
session_start();
header("Content-Type: application/json");

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'patient') {
    echo json_encode(["success" => false, "message" => "Unauthorized"]);
    exit;
}

if (!isset($_POST['appointment_id'])) {
    echo json_encode(["success" => false, "message" => "Missing appointment ID"]);
    exit;
}

$appointment_id = intval($_POST['appointment_id']);
$conn = new mysqli("localhost", "root", "", "cs366");

// Update appointment status
$stmt = $conn->prepare("UPDATE Appointments SET status = 'cancelled' WHERE appointment_id = ?");
$stmt->bind_param("i", $appointment_id);
$success = $stmt->execute();

// Optionally free up the slot (if you want)
if ($success) {
    $slot_stmt = $conn->prepare("
        UPDATE Slots 
        SET is_available = 1 
        WHERE slot_id = (SELECT slot_id FROM Appointments WHERE appointment_id = ?)
    ");
    $slot_stmt->bind_param("i", $appointment_id);
    $slot_stmt->execute();
    $slot_stmt->close();
}

echo json_encode(["success" => $success]);
$stmt->close();
$conn->close();
