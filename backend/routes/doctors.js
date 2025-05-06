import express from 'express';
import { getAllDoctors } from '../controllers/doctorsController.js';
const router = express.Router();
router.get('/', getAllDoctors);
export default router;