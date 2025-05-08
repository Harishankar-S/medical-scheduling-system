<?php
ob_start(); // buffer output
session_start();
header("Content-Type: application/json"); // ensure JSON response

$username = $_POST['username'] ?? '';
$password = $_POST['password'] ?? '';
$role = $_POST['role'] ?? '';

if (
    ($username === 'admin' && $password === 'admin' && $role === 'admin') ||
    ($username === 'patient' && $password === 'patient' && $role === 'patient')
) {
    $_SESSION['username'] = $username;
    $_SESSION['role'] = $role;
    echo json_encode(['success' => true]);
} else {
    $_SESSION['patient_id'] = 1;
    echo json_encode(['success' => false, 'message' => 'Invalid credentials']);
}
ob_end_flush();
?>