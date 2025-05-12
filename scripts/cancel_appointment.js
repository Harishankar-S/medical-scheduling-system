document.addEventListener("DOMContentLoaded", () => {
  document.querySelectorAll(".cancel-btn").forEach(button => {
    button.addEventListener("click", () => {
      const appointmentId = button.dataset.id;

      if (!confirm("Are you sure you want to cancel this appointment?")) return;

      fetch("scripts/cancel_appointment.php", {
        method: "POST",
        headers: {
          "Content-Type": "application/x-www-form-urlencoded"
        },
        body: `appointment_id=${encodeURIComponent(appointmentId)}`
      })
      .then(res => res.json())
      .then(data => {
        if (data.success) {
          alert("Appointment cancelled.");
          location.reload();
        } else {
          alert("Failed to cancel: " + data.message);
        }
      });
    });
  });
});
