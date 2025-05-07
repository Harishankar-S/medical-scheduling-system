function handleLogin(event) {
  event.preventDefault();
  const username = document.getElementById("username").value.trim();
  const password = document.getElementById("password").value.trim();
  const role = document.getElementById("role").value;

  if ((username === "admin" && password === "admin" && role === "admin") ||
      (username === "patient" && password === "patient" && role === "patient")) {
    
    // Save role in localStorage
    localStorage.setItem("userRole", role);
    window.location.href = "home.html";
  } else {
    alert("Invalid login or role.");
  }
}

function getUserRole() {
  return localStorage.getItem("userRole");
}
