<!DOCTYPE html>
<html>
<head>
  <title>Appointments</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>

  <header id="main-header"></header>

  <script src="scripts/navbar.php"></script>

  <h2>Appointments</h2>

  <!-- FILTER PANEL -->
  <div id="filter-section" style="display: none; margin-bottom: 20px;">
    <h3>Filter Appointments</h3>

    <label for="type">Appointment Type:</label>
    <select id="type">
      <option value="">All</option>
      <option value="upcoming">Upcoming</option>
      <option value="past">Past</option>
    </select>

    <label for="status">Status:</label>
    <select id="status">
      <option value="">All</option>
      <option value="scheduled">Showed Up</option>
      <option value="no-show">No Show</option>
    </select>

    <label for="gender">Gender:</label>
    <select id="gender">
      <option value="">All</option>
      <option value="male">Male</option>
      <option value="female">Female</option>
    </select>

    <label for="patient-name">Patient Name:</label>
    <input type="text" id="patient-name" placeholder="Search by name">

    <label for="appointment-date">Date:</label>
    <input type="date" id="appointment-date">

    <label for="insurance">Insurance:</label>
    <input type="text" id="insurance" placeholder="Search by insurance">

    <button onclick="applyFilters()">Apply Filters</button>
    <button onclick="resetFilters()">Reset</button>
  </div>

  <!-- APPOINTMENTS TABLE -->
  <table id="appointments-table">
    <thead>
      <tr>
        <th>ID</th><th>Patient</th><th>Gender</th><th>Doctor</th>
        <th>Date</th><th>Time</th><th>Status</th><th>Insurance</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td>201</td><td>Jane Doe</td><td>female</td><td>Dr. Amy Chen</td>
        <td>2025-05-12</td><td>10:00</td><td>scheduled</td><td>Blue Cross</td>
      </tr>
      <tr>
        <td>202</td><td>John Smith</td><td>male</td><td>Dr. Raj Patel</td>
        <td>2025-04-10</td><td>09:30</td><td>no-show</td><td>SunLife</td>
      </tr>
      <!-- Add more dummy rows if needed -->
    </tbody>
  </table>

  <script>
    function applyFilters() {
      const type = document.getElementById("type").value;
      const status = document.getElementById("status").value;
      const gender = document.getElementById("gender").value;
      const name = document.getElementById("patient-name").value.toLowerCase();
      const date = document.getElementById("appointment-date").value;
      const insurance = document.getElementById("insurance").value.toLowerCase();

      const now = new Date().toISOString().split('T')[0];
      const rows = document.querySelectorAll("#appointments-table tbody tr");

      rows.forEach(row => {
        const cells = row.querySelectorAll("td");
        const rowDate = cells[4].textContent;
        const rowStatus = cells[6].textContent.toLowerCase();
        const rowGender = cells[2].textContent.toLowerCase();
        const rowName = cells[1].textContent.toLowerCase();
        const rowInsurance = cells[7].textContent.toLowerCase();

        let show = true;

        if (type === "upcoming" && rowDate < now) show = false;
        if (type === "past" && rowDate >= now) show = false;
        if (status && rowStatus !== status) show = false;
        if (gender && rowGender !== gender) show = false;
        if (name && !rowName.includes(name)) show = false;
        if (date && rowDate !== date) show = false;
        if (insurance && !rowInsurance.includes(insurance)) show = false;

        row.style.display = show ? "" : "none";
      });
    }

    function resetFilters() {
      document.getElementById("type").value = "";
      document.getElementById("status").value = "";
      document.getElementById("gender").value = "";
      document.getElementById("patient-name").value = "";
      document.getElementById("appointment-date").value = "";
      document.getElementById("insurance").value = "";

      applyFilters();
    }
  </script>

</body>
</html>
