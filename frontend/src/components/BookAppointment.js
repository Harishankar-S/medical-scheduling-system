import React, { useEffect, useState } from 'react';
import api from '../api';

export default function BookAppointment() {
  const [doctors, setDoctors] = useState([]);
  const [doctorId, setDoctorId] = useState('');
  const [slot, setSlot] = useState('');
  const [slots, setSlots] = useState([]);

  useEffect(() => {
    api.get('/doctors').then(res => setDoctors(res.data));
  }, []);

  useEffect(() => {
    if (doctorId) {
      api.get(`/slots?doctorId=${doctorId}`).then(res => setSlots(res.data));
    }
  }, [doctorId]);

  const book = () => {
    api.post('/appointments', {
      patient_id: 1,
      slot_id: slot,
      status: 'booked'
    }).then(() => alert('Booked'));
  };

  return (
    <div>
      <h2>Book Appointment</h2>
      <select onChange={e => setDoctorId(e.target.value)}>
        <option>Select Doctor</option>
        {doctors.map(d => (
          <option key={d.doctor_id} value={d.doctor_id}>{d.name}</option>
        ))}
      </select>

      <select onChange={e => setSlot(e.target.value)}>
        <option>Select Slot</option>
        {slots.map(s => (
          <option key={s.slot_id} value={s.slot_id}>{s.appointment_date} at {s.appointment_time}</option>
        ))}
      </select>

      <button onClick={book}>Confirm</button>
    </div>
  );
}