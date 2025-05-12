<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../index.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !isset($_POST['slot_ids'])) {
    header("Location: ../admin_slots.php");
    exit;
}

$conn = new mysqli("localhost", "root", "", "cs366");

$slotIds = $_POST['slot_ids'];
$placeholders = implode(',', array_fill(0, count($slotIds), '?'));
$types = str_repeat('i', count($slotIds));

$stmt = $conn->prepare("DELETE FROM Slots WHERE slot_id IN ($placeholders)");

if ($stmt) {
    $stmt->bind_param($types, ...$slotIds);
    $stmt->execute();
    $stmt->close();
}

$conn->close();
header("Location: ../admin_slots.php");
exit;
