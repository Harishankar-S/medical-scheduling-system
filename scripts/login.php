<?php
ob_start();
session_start();
header("Content-Type: application/json");

$username = $_POST['username'] ?? '';
$password = $_POST['password'] ?? '';
$role = $_POST['role'] ?? '';

$validLogin = false;

if ($role === 'admin' && $username === 'admin' && $password === 'admin') {
    $_SESSION['username'] = $username;
    $_SESSION['role'] = $role;
    $validLogin = true;
} elseif ($role === 'patient' && $username === 'patient' && $password === 'patient') {
    $_SESSION['username'] = $username;
    $_SESSION['role'] = $role;
    
    $_SESSION['patient_id'] = 1;
    $validLogin = true;
}

if ($validLogin) {
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid credentials']);
}

ob_end_flush();
?>