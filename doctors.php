<!DOCTYPE html>
<html>
<head>
  <title>Doctors</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>

  <header id="main-header"></header>

  <script src="scripts/navbar.php"></script>

<h2>Doctors</h2>

<div>
  <label for="drspecial">Doctor specialization</label>
  <select name="drspecial" id="drspecial">
    <option value="All">All</option>
    <option value="Orthopedics">Orthopedics</option>
    <option value="Nephrology">Nephrology</option>
    <option value="Psychiatry">Psychiatry</option>
    <option value="Neurology">Neurology</option>
    <option value="Pulmonology">Pulmonology</option>
    <option value="Dermatology">Dermatology</option>
    <option value="Oncology">Oncology</option>
    <option value="Gastroenterology">Gastroenterology</option>
    <option value="Pediatrics">Pediatrics</option>
    <option value="Rheumatology">Rheumatology</option>
    <option value="ENT">ENT</option>
    <option value="Ophthalmology">Ophthalmology</option>
    <option value="Urology">Urology</option>
    <option value="Endocrinology">Endocrinology</option>
    <option value="Cardiology">Cardiology</option>
  </select>

  <label for="drdays">Select day availabilities</label>
  <select name="drdays" id="drdays">
    <option value="All">All</option>
    <option value="Tue/Thu">Tue/Thu</option>
    <option value="Mon-Fri">Mon-Fri</option>
    <option value="Mon/Wed/Fri">Mon/Wed/Fri</option>
    <option value="Mon/Wed">Mon/Wed</option>
    <option value="Fri">Fri</option>
  </select>

  <label for="drname">Search by name</label>
  <input type="text" id="drname" name="drname">

  <button type="button">Sort by appointment count</button>
</div>
<br>


<table>
  <tr><th>ID</th><th>Doctor</th><th>Specialization</th><th>Phone Number</th><th>Email</th><th>Availability</th></tr>
  <tr><td>1</td><td>Dr. Kevin Clark</td><td>Orthopedics</td><td>780-555-1001</td><td>k.clark@clinic.ca</td><td>Tue/Thu 13:00-17:00</td></tr>
  <tr><td>2</td><td>Dr. Christopher Jackson</td><td>Neurology</td><td>780-555-1002</td><td>c.jackson@clinic.ca</td><td>Tue/Thu 09:00-12:00</td></tr>
  <!-- Add more rows as needed -->
</table>

</body>
</html>
