<?php
// Database connection parameters
$host = "localhost";
$dbname = "medicare_db";
$username = "root";
$password = ""; // Update with your actual database password

// Function to sanitize user input
function sanitize_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get and sanitize user input
    $first_name = sanitize_input($_POST["first_name"]);
    $last_name = sanitize_input($_POST["last_name"]);
    $email = sanitize_input($_POST["email"]);
    $username = sanitize_input($_POST["username"]);
    $password = $_POST["password"]; // Don't sanitize password before hashing
    $confirm_password = $_POST["confirm_password"];
    $dob = sanitize_input($_POST["dob"]);
    $terms = isset($_POST["terms"]) ? true : false;
    
    // Validate input
    $errors = [];
    
    if (empty($first_name) || empty($last_name)) {
        $errors[] = "Full name is required";
    }
    
    if (empty($email)) {
        $errors[] = "Email is required";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email format";
    }
    
    if (empty($username)) {
        $errors[] = "Username is required";
    }
    
    if (empty($password)) {
        $errors[] = "Password is required";
    } elseif (strlen($password) < 8) {
        $errors[] = "Password must be at least 8 characters long";
    }
    
    if ($password !== $confirm_password) {
        $errors[] = "Passwords do not match";
    }
    
    if (empty($dob)) {
        $errors[] = "Date of birth is required";
    }
    
    if (!$terms) {
        $errors[] = "You must agree to the Terms and Conditions";
    }
    
    // If there are validation errors, redirect back with error messages
    if (!empty($errors)) {
        $error_string = implode(", ", $errors);
        header("Location: register.html?error=" . urlencode($error_string));
        exit();
    }
    
    try {
        // Create database connection
        $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
        // Set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        // Check if username already exists
        $stmt = $conn->prepare("SELECT id FROM users WHERE username = :username");
        $stmt->bindParam(":username", $username);
        $stmt->execute();
        
        if ($stmt->rowCount() > 0) {
            header("Location: register.html?error=username_taken");
            exit();
        }
        
        // Check if email already exists
        $stmt = $conn->prepare("SELECT id FROM users WHERE email = :email");
        $stmt->bindParam(":email", $email);
        $stmt->execute();
        
        if ($stmt->rowCount() > 0) {
            header("Location: register.html?error=email_taken");
            exit();
        }
        
        // Hash the password
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        
        // Prepare SQL statement to insert new user
        $stmt = $conn->prepare("INSERT INTO users (first_name, last_name, email, username, password, dob, role, created_at) 
                               VALUES (:first_name, :last_name, :email, :username, :password, :dob, 'user', NOW())");
        
        // Bind parameters
        $stmt->bindParam(":first_name", $first_name);
        $stmt->bindParam(":last_name", $last_name);
        $stmt->bindParam(":email", $email);
        $stmt->bindParam(":username", $username);
        $stmt->bindParam(":password", $hashed_password);
        $stmt->bindParam(":dob", $dob);
        
        // Execute the statement
        $stmt->execute();
        
        // Registration successful, redirect to login page with success message
        header("Location: index.html?registration=success");
        exit();
        
    } catch(PDOException $e) {
        // Database connection error
        header("Location: register.html?error=database_error");
        exit();
    }
    
    // Close connection
    $conn = null;
} else {
    // If not a POST request, redirect to registration page
    header("Location: register.html");
    exit();
}
?>