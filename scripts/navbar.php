<?php
header("Content-Type: application/javascript");
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Expires: 0");
header("Pragma: no-cache");

session_start();
$role = $_SESSION['role'] ?? '';
?>

document.addEventListener('DOMContentLoaded', () => {
    const role = "<?php echo htmlspecialchars($role, ENT_QUOTES); ?>";
    let links = '';
  
    if (role === "admin") {
    links = `
        <a href="home.php">Home</a>
        <a href="dashboard.php">Dashboard</a>
        <a href="book.php">Book Appointment</a>
        <a href="slots.php">Manage Slots</a>
        <a href="upcoming.php">Appointments</a>
        <a href="doctors.php">Doctors</a>
        <a href="#" onclick="document.getElementById('logoutForm').submit()">Logout</a>
        <form id="logoutForm" action="scripts/logout.php" method="POST" style="display:none;"></form>
    `;
    } else if (role === "patient") {
    links = `
        <a href="home.php">Home</a>
        <a href="dashboard.php">Dashboard</a>
        <a href="book.php">Book Appointment</a>
        <a href="doctors.php">Doctors</a>
        <a href="#" onclick="document.getElementById('logoutForm').submit()">Logout</a>
        <form id="logoutForm" action="scripts/logout.php" method="POST" style="display:none;"></form>
    `;
    } else {
    links = `<a href="index.php">Login</a>`;
    }
  
    document.getElementById("main-header").innerHTML = `<nav>${links}</nav>`;
})