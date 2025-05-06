import { DataTypes } from 'sequelize';
import { sequelize } from '../config/db.js';
export const Doctor = sequelize.define('Doctor', {
  doctor_id: { type: DataTypes.INTEGER, primaryKey: true },
  name: DataTypes.STRING,
  specialization: DataTypes.STRING,
  phone_number: DataTypes.STRING,
  email: DataTypes.STRING,
  availability: DataTypes.STRING
}, { timestamps: false });