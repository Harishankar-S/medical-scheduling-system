import React from 'react';
import { BrowserRouter as Router, Routes, Route, Link } from 'react-router-dom';
import Login from './components/Login';
import Dashboard from './components/Dashboard';
import BookAppointment from './components/BookAppointment';
import SlotManager from './components/SlotManager';
import SqlTool from './components/SqlTool';

export default function App() {
  return (
    <Router>
      <div>
        <nav style={{ margin: '10px' }}>
          <Link to="/" style={{ marginRight: '10px' }}>Login</Link>
          <Link to="/dashboard" style={{ marginRight: '10px' }}>Dashboard</Link>
          <Link to="/book" style={{ marginRight: '10px' }}>Book</Link>
          <Link to="/slots" style={{ marginRight: '10px' }}>Slots</Link>
          <Link to="/sql">SQL</Link>
        </nav>
        <Routes>
          <Route path="/" element={<Login />} />
          <Route path="/dashboard" element={<Dashboard />} />
          <Route path="/book" element={<BookAppointment />} />
          <Route path="/slots" element={<SlotManager />} />
          <Route path="/sql" element={<SqlTool />} />
        </Routes>
      </div>
    </Router>
  );
}
