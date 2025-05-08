<?php
$conn = new mysqli("localhost", "root", "", "cs366");
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$doctor_id = $_POST["doctor_id"];
$days = $_POST["days"];
$start_time = $_POST["start_time"];
$end_time = $_POST["end_time"];
$start_date = $_POST["start_date"];
$end_date = $_POST["end_date"];

$dayMap = [
  "Sun" => 0, "Mon" => 1, "Tue" => 2,
  "Wed" => 3, "Thu" => 4, "Fri" => 5, "Sat" => 6
];

$dayNumbers = array_map(function($d) use ($dayMap) {
  return $dayMap[$d];
}, $days);

$current = new DateTime($start_date);
$end = new DateTime($end_date);
$end->modify('+1 day');

while ($current < $end) {
  if (in_array((int)$current->format("w"), $dayNumbers)) {
    $dateStr = $current->format("Y-m-d");

    $start = new DateTime($start_time);
    $finish = new DateTime($end_time);

    while ($start < $finish) {
      $slotStart = $start->format("H:i:s");
      $start->modify("+15 minutes");
      $slotEnd = $start->format("H:i:s");

      $stmt = $conn->prepare("INSERT INTO Slots (appointment_date, start_time, end_time, doctor_id) VALUES (?, ?, ?, ?)");
      $stmt->bind_param("sssi", $dateStr, $slotStart, $slotEnd, $doctor_id);
      $stmt->execute();
    }
  }
  $current->modify("+1 day");
}

$conn->close();
echo "Slots generated successfully. <a href='../admin_slots.php'>Go back</a>";
?>