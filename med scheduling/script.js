function handleLogin(event) {
    event.preventDefault();
    const username = document.getElementById("username").value;
    const password = document.getElementById("password").value;
  
    // Simple check - just redirect for demo purposes
    if (username === "admin" && password === "admin") {
      window.location.href = "dashboard.html";
    } else {
      alert("Invalid credentials");
    }
  }