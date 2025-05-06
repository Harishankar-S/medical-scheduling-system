import { Doctor } from '../models/Doctor.js';
export const getAllDoctors = async (req, res) => {
  const doctors = await Doctor.findAll();
  res.json(doctors);
};