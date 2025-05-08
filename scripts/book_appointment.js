document.addEventListener("DOMContentLoaded", () => {
    const doctorSelect = document.getElementById("doctorSelect");
    const dateInput = document.getElementById("dateInput");

    doctorSelect.addEventListener("change", fetchSlots);
    dateInput.addEventListener("change", fetchSlots);

    function fetchSlots() {
        const doctorId = doctorSelect.value;
        const date = dateInput.value;

        if (!doctorId || !date) return;

        fetch(`scripts/get_slots.php?doctor_id=${doctorId}&date=${date}`)
            .then(res => res.json())
            .then(data => {
            const timeSelect = document.getElementById("timeSlotSelect");
            timeSelect.innerHTML = "";

            if (!data.length) {
                const opt = document.createElement("option");
                opt.text = "No available slots";
                opt.disabled = true;
                timeSelect.add(opt);
                return;
            }

            data.forEach(slot => {
                const opt = document.createElement("option");
                opt.value = slot.time;
                opt.text = slot.time;
                timeSelect.add(opt);
            });
            });
    }

    // Form submission
    document.getElementById("bookingForm").addEventListener("submit", function(e) {
    e.preventDefault();

    const formData = new FormData(this);
    fetch("scripts/book_appointment.php", {
        method: "POST",
        body: formData
    })
    .then(res => res.json())
    .then(data => {
        if (data.success) {
        alert("Appointment booked!");
        location.reload();
        } else {
        alert("Failed to book appointment: " + data.message);
        }
    });
    });
});