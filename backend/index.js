import express from 'express';
import cors from 'cors';
import { sequelize } from './config/db.js';
import patientsRoutes from './routes/patients.js';
import slotsRoutes from './routes/slots.js';
import appointmentsRoutes from './routes/appointments.js';
import doctorsRoutes from './routes/doctors.js';
const app = express();
app.use(cors());
app.use(express.json());
app.use('/api/patients', patientsRoutes);
app.use('/api/slots', slotsRoutes);
app.use('/api/appointments', appointmentsRoutes);
app.use('/api/doctors', doctorsRoutes);
const start = async () => {
  try {
    await sequelize.authenticate();
    console.log('DB connected');
    app.listen(process.env.PORT, () =>
      console.log(`Server running on ${process.env.PORT}`)
    );
  } catch (err) { console.error(err); }
};
start();