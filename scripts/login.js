function handleLogin(event) {
  event.preventDefault();
  const username = document.getElementById("username").value.trim();
  const password = document.getElementById("password").value.trim();
  const role = document.getElementById("role").value;

  fetch("scripts/login.php", {
    method: "POST",
    headers: {
      "Content-Type": "application/x-www-form-urlencoded",
    },
    body: `username=${encodeURIComponent(username)}&password=${encodeURIComponent(password)}&role=${encodeURIComponent(role)}`
  })
  .then(res => res.json())
  .then(data => {
    if (data.success) {
      window.location.href = "home.php";
    } else {
      alert("Invalid login.");
    }
  });
}