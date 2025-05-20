// Import required packages
import express from "express";
import mongoose from "mongoose";
import bcrypt from "bcrypt";
import cors from "cors";
import path from "path";
import { fileURLToPath } from "url";
import fs from "fs";

const __filename = fileURLToPath(import.meta.url);
const __dirname = path.dirname(__filename);

// Initialize Express app
const app = express();
const PORT = process.env.PORT || 3000;

// Middleware
app.use(express.json());
app.use(express.urlencoded({ extended: true }));
app.use(cors());

// Add Content Security Policy middleware
app.use((req, res, next) => {
  res.setHeader(
    "Content-Security-Policy",
    "default-src 'self'; script-src 'self' 'unsafe-inline'; style-src 'self' 'unsafe-inline' https://fonts.googleapis.com; font-src 'self' https://fonts.gstatic.com; img-src 'self' https://i.ibb.co data:; connect-src 'self'"
  );
  next();
});

// Serve static files from the public directory
app.use(express.static(path.join(__dirname, "public")));

// Connect to MongoDB
mongoose
  .connect(
    "mongodb+srv://anshraythatha123:Ansh0308@cluster0.xrpbv.mongodb.net/?retryWrites=true&w=majority&appName=Cluster0",
    {
      useNewUrlParser: true,
      useUnifiedTopology: true,
    }
  )
  .then(() => {
    console.log("Connected to MongoDB");
  })
  .catch((err) => {
    console.error("MongoDB connection error:", err);
  });

// Create User Schema
const userSchema = new mongoose.Schema({
  name: { type: String, required: true },
  email: { type: String, required: true, unique: true },
  phone: { type: String, required: true },
  password: { type: String, required: true },
  role: { type: String, enum: ["patient", "doctor", "admin"], required: true },
  createdAt: { type: Date, default: Date.now },
});

// Create Checkup Request Schema
const checkupRequestSchema = new mongoose.Schema({
  userId: { type: mongoose.Schema.Types.ObjectId, ref: 'User', required: true },
  name: { type: String, required: true },
  email: { type: String, required: true },
  phone: { type: String, required: true },
  diseaseType: { type: String, required: true },
  status: { type: String, default: 'Pending', enum: ['Pending', 'Approved', 'Completed', 'Cancelled'] },
  createdAt: { type: Date, default: Date.now }
});

// Create Emergency Request Schema
const emergencyRequestSchema = new mongoose.Schema({
  userId: { type: mongoose.Schema.Types.ObjectId, ref: 'User', required: true },
  location: {
    latitude: { type: Number, required: true },
    longitude: { type: Number, required: true },
    address: { type: String }
  },
  driverName: { type: String },
  status: { type: String, default: 'Active', enum: ['Active', 'Completed', 'Cancelled'] },
  createdAt: { type: Date, default: Date.now }
});

// Create Appointment Schema
const appointmentSchema = new mongoose.Schema({
  userId: { type: mongoose.Schema.Types.ObjectId, ref: 'User', required: true },
  doctorId: { type: mongoose.Schema.Types.ObjectId, ref: 'User' },
  date: { type: Date, required: true },
  time: { type: String, required: true },
  reason: { type: String, required: true },
  status: { type: String, default: 'Scheduled', enum: ['Scheduled', 'Completed', 'Cancelled'] },
  createdAt: { type: Date, default: Date.now }
});

// Create Prescription Schema
const prescriptionSchema = new mongoose.Schema({
  userId: { type: mongoose.Schema.Types.ObjectId, ref: 'User', required: true },
  doctorId: { type: mongoose.Schema.Types.ObjectId, ref: 'User', required: true },
  medications: [{ 
    name: { type: String, required: true },
    dosage: { type: String, required: true },
    frequency: { type: String, required: true },
    duration: { type: String, required: true }
  }],
  instructions: { type: String },
  isActive: { type: Boolean, default: true },
  createdAt: { type: Date, default: Date.now }
});

// Create Medical Record Schema
const medicalRecordSchema = new mongoose.Schema({
  userId: { type: mongoose.Schema.Types.ObjectId, ref: 'User', required: true },
  recordType: { type: String, required: true },
  recordDate: { type: Date, required: true },
  description: { type: String, required: true },
  attachmentUrl: { type: String },
  createdAt: { type: Date, default: Date.now }
});

// Create Models
const User = mongoose.model("User", userSchema);
const CheckupRequest = mongoose.model("CheckupRequest", checkupRequestSchema);
const EmergencyRequest = mongoose.model("EmergencyRequest", emergencyRequestSchema);
const Appointment = mongoose.model("Appointment", appointmentSchema);
const Prescription = mongoose.model("Prescription", prescriptionSchema);
const MedicalRecord = mongoose.model("MedicalRecord", medicalRecordSchema);

// API Routes
// Signup endpoint
app.post("/api/signup", async (req, res) => {
  try {
    const { fullname, email, phone, password, role } = req.body;

    // Check if user exists
    const existingUser = await User.findOne({ email });
    if (existingUser) {
      return res
        .status(400)
        .json({ success: false, message: "Email already registered" });
    }

    // Hash password
    const salt = await bcrypt.genSalt(10);
    const hashedPassword = await bcrypt.hash(password, salt);

    // Create new user
    const user = new User({
      name: fullname,
      email,
      phone,
      password: hashedPassword,
      role,
    });

    await user.save();

    res.status(201).json({
      success: true,
      message: "Account created successfully",
      user: {
        id: user._id,
        name: user.name,
        email: user.email,
        role: user.role,
      },
    });
  } catch (error) {
    console.error("Signup error:", error);
    res.status(500).json({ success: false, message: "Server error" });
  }
});

// Login endpoint
app.post("/api/login", async (req, res) => {
  try {
    const { email, password, role } = req.body;

    // Find user
    const user = await User.findOne({ email });
    if (!user) {
      return res
        .status(400)
        .json({ success: false, message: "Invalid credentials" });
    }

    // Check role
    if (user.role !== role) {
      return res.status(400).json({ success: false, message: "Invalid role" });
    }

    // Verify password
    const isMatch = await bcrypt.compare(password, user.password);
    if (!isMatch) {
      return res
        .status(400)
        .json({ success: false, message: "Invalid credentials" });
    }

    res.json({
      success: true,
      message: "Login successful",
      user: {
        id: user._id,
        name: user.name,
        email: user.email,
        role: user.role,
      },
    });
  } catch (error) {
    console.error("Login error:", error);
    res.status(500).json({ success: false, message: "Server error" });
  }
});

// Checkup request endpoint
app.post("/api/checkup-request", async (req, res) => {
  try {
    const { userId, name, email, phone, diseaseType } = req.body;

    // Create new checkup request
    const checkupRequest = new CheckupRequest({
      userId,
      name,
      email,
      phone,
      diseaseType
    });

    await checkupRequest.save();

    res.status(201).json({
      success: true,
      message: "Checkup request submitted successfully",
      checkupRequest
    });
  } catch (error) {
    console.error("Checkup request error:", error);
    res.status(500).json({ success: false, message: "Server error" });
  }
});

// Emergency request endpoint
app.post("/api/emergency-request", async (req, res) => {
  try {
    const { userId, latitude, longitude, address, driverName } = req.body;

    // Create new emergency request
    const emergencyRequest = new EmergencyRequest({
      userId,
      location: {
        latitude,
        longitude,
        address
      },
      driverName
    });

    await emergencyRequest.save();

    res.status(201).json({
      success: true,
      message: "Emergency request submitted successfully",
      emergencyRequest
    });
  } catch (error) {
    console.error("Emergency request error:", error);
    res.status(500).json({ success: false, message: "Server error" });
  }
});

// Book appointment endpoint
app.post("/api/appointment", async (req, res) => {
  try {
    const { userId, doctorId, date, time, reason } = req.body;

    // Create new appointment
    const appointment = new Appointment({
      userId,
      doctorId,
      date,
      time,
      reason
    });

    await appointment.save();

    res.status(201).json({
      success: true,
      message: "Appointment booked successfully",
      appointment
    });
  } catch (error) {
    console.error("Appointment booking error:", error);
    res.status(500).json({ success: false, message: "Server error" });
  }
});

// Get user dashboard data
app.get("/api/dashboard/:userId", async (req, res) => {
  try {
    const { userId } = req.params;

    // Get user data
    const user = await User.findById(userId).select('-password');
    if (!user) {
      return res.status(404).json({ success: false, message: "User not found" });
    }

    // Get appointments
    const appointments = await Appointment.find({ 
      userId, 
      status: 'Scheduled' 
    }).sort({ date: 1 });

    // Get prescriptions
    const prescriptions = await Prescription.find({ 
      userId, 
      isActive: true 
    }).sort({ createdAt: -1 });

    // Get medical records
    const medicalRecords = await MedicalRecord.find({ 
      userId 
    }).sort({ createdAt: -1 });

    // Get checkup requests
    const checkupRequests = await CheckupRequest.find({ 
      userId 
    }).sort({ createdAt: -1 });

    // Get emergency requests
    const emergencyRequests = await EmergencyRequest.find({ 
      userId 
    }).sort({ createdAt: -1 });

    res.json({
      success: true,
      data: {
        user,
        appointments: appointments.length,
        prescriptions: prescriptions.length,
        medicalRecords: medicalRecords.length,
        checkupRequests,
        emergencyRequests,
        recentAppointments: appointments.slice(0, 3),
        recentPrescriptions: prescriptions.slice(0, 3),
        recentMedicalRecords: medicalRecords.slice(0, 3)
      }
    });
  } catch (error) {
    console.error("Dashboard data error:", error);
    res.status(500).json({ success: false, message: "Server error" });
  }
});

// Serve HTML files - Catch-all route for all HTML files
app.get("*.html", (req, res) => {
  // Extract the filename from the request URL
  const filename = req.path.substring(1); // Remove the leading slash
  const filePath = path.join(__dirname, "public", filename);

  // Check if the file exists
  try {
    if (fs.existsSync(filePath)) {
      res.sendFile(filePath);
    } else {
      console.error(`File not found: ${filePath}`);
      res.status(404).send("File not found");
    }
  } catch (err) {
    console.error(`Error checking file: ${err}`);
    res.status(500).send("Server error");
  }
});

// Root route
app.get("/", (req, res) => {
  res.sendFile(path.join(__dirname, "public", "index.html"));
});

// Start server
app.listen(PORT, () => {
  console.log(`Server running on port ${PORT}`);
});