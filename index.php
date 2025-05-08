<!DOCTYPE html>
<html>
<head>
  <title>Login</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>

  <h2>Login</h2>
  <div class="container">
    <form onsubmit="return handleLogin(event)">
      <input type="text" id="username" placeholder="Username" required><br>
      <input type="password" id="password" placeholder="Password" required><br>
    
      <label for="role">Login As:</label>
      <select id="role" required>
        <option value="">Select Role</option>
        <option value="patient">Patient</option>
        <option value="admin">Admin</option>
      </select><br>

      <button type="submit">Login</button>
    </form>
  </div>

  <script src="scripts/login.js"></script>
</body>
</html>
