import React, { useEffect, useState } from 'react';
import api from '../api';

export default function Dashboard() {
  const [appointments, setAppointments] = useState([]);

  useEffect(() => {
    api.get('/appointments')
      .then(res => setAppointments(res.data))
      .catch(err => console.error(err));
  }, []);

  return (
    <div>
      <h2>My Appointments</h2>
      <table>
        <thead>
          <tr>
            <th>ID</th><th>Date</th><th>Time</th><th>Status</th>
          </tr>
        </thead>
        <tbody>
          {appointments.map(app => (
            <tr key={app.appointment_id}>
              <td>{app.appointment_id}</td>
              <td>{app.appointment_date}</td>
              <td>{app.appointment_time}</td>
              <td>{app.status}</td>
            </tr>
          ))}
        </tbody>
      </table>
    </div>
  );
}