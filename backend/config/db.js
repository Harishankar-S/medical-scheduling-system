import { Sequelize } from 'sequelize';
import dotenv from 'dotenv';

// Load environment variables from .env file
dotenv.config();

// Initialize Sequelize with PostgreSQL connection parameters
export const sequelize = new Sequelize(
  process.env.DB_NAME,     // Database name
  process.env.DB_USER,     // Database user
  process.env.DB_PASS,     // Database password
  {
    host: process.env.DB_HOST,
    dialect: 'postgres'
  }
);