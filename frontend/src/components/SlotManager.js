import React, { useEffect, useState } from 'react';
import api from '../api';

export default function SlotManager() {
  const [slots, setSlots] = useState([]);

  useEffect(() => {
    api.get('/slots').then(res => setSlots(res.data));
  }, []);

  const toggle = (id, current) => {
    api.put(`/slots/${id}`, { is_available: !current })
      .then(() => setSlots(prev => prev.map(s => s.slot_id === id ? { ...s, is_available: !current } : s)));
  };

  return (
    <div>
      <h2>Manage Slots</h2>
      <table>
        <thead>
          <tr><th>ID</th><th>Date</th><th>Time</th><th>Available</th><th>Action</th></tr>
        </thead>
        <tbody>
          {slots.map(slot => (
            <tr key={slot.slot_id}>
              <td>{slot.slot_id}</td>
              <td>{slot.appointment_date}</td>
              <td>{slot.appointment_time}</td>
              <td>{slot.is_available ? 'Yes' : 'No'}</td>
              <td>
                <button onClick={() => toggle(slot.slot_id, slot.is_available)}>
                  {slot.is_available ? 'Disable' : 'Enable'}
                </button>
              </td>
            </tr>
          ))}
        </tbody>
      </table>
    </div>
  );
}