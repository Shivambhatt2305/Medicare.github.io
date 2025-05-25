<!-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Medicare Registration</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<style>
    * {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
}

:root {
    --primary-color: #c62828;
    --primary-light: #ff5f52;
    --primary-dark: #8e0000;
    --text-on-primary: #ffffff;
    --background-color: #f5f5f5;
    --card-color: #ffffff;
    --text-color: #333333;
    --error-color: #d32f2f;
}

body {
    background-color: var(--background-color);
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 100vh;
}

.container {
    width: 100%;
    max-width: 1000px;
    padding: 20px;
}

.login-container {
    display: flex;
    background-color: var(--card-color);
    border-radius: 10px;
    overflow: hidden;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
}

.image-section {
    flex: 1;
    background-image: url('https://images.unsplash.com/photo-1576091160550-2173dba999ef?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80');
    background-size: cover;
    background-position: center;
    position: relative;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    text-align: center;
}

.overlay {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: linear-gradient(135deg, rgba(198, 40, 40, 0.9), rgba(142, 0, 0, 0.8));
}

.content {
    position: relative;
    z-index: 1;
    padding: 20px;
}

.content h1 {
    font-size: 2.5rem;
    margin-bottom: 10px;
    font-weight: 700;
}

.content p {
    font-size: 1.1rem;
    opacity: 0.9;
}

.form-section {
    flex: 1;
    padding: 40px;
    display: flex;
    flex-direction: column;
}

.form-header {
    margin-bottom: 30px;
    text-align: center;
}

.form-header h2 {
    color: var(--primary-color);
    font-size: 1.8rem;
    margin-bottom: 10px;
}

.form-header p {
    color: #666;
    font-size: 1rem;
}

.input-group {
    margin-bottom: 20px;
}

.input-group label {
    display: block;
    margin-bottom: 8px;
    color: var(--text-color);
    font-weight: 500;
}

.input-with-icon {
    position: relative;
}

.input-with-icon i {
    position: absolute;
    left: 15px;
    top: 50%;
    transform: translateY(-50%);
    color: #999;
}

.input-with-icon .toggle-password {
    left: auto;
    right: 15px;
    cursor: pointer;
}

.input-with-icon input {
    width: 100%;
    padding: 12px 15px 12px 40px;
    border: 1px solid #ddd;
    border-radius: 5px;
    font-size: 1rem;
    transition: border-color 0.3s;
}

.input-with-icon input:focus {
    outline: none;
    border-color: var(--primary-color);
}

.options {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 20px;
}

.remember-me {
    display: flex;
    align-items: center;
}

.remember-me input {
    margin-right: 8px;
}

.forgot-password {
    color: var(--primary-color);
    text-decoration: none;
    font-size: 0.9rem;
}

.forgot-password:hover {
    text-decoration: underline;
}

#error-message {
    color: var(--error-color);
    margin-bottom: 15px;
    font-size: 0.9rem;
    min-height: 20px;
}

.login-btn {
    width: 100%;
    padding: 12px;
    background-color: var(--primary-color);
    color: white;
    border: none;
    border-radius: 5px;
    font-size: 1rem;
    cursor: pointer;
    transition: background-color 0.3s;
}

.login-btn:hover {
    background-color: var(--primary-dark);
}

.register-link {
    margin-top: 20px;
    text-align: center;
    font-size: 0.9rem;
}

.register-link a {
    color: var(--primary-color);
    text-decoration: none;
}

.register-link a:hover {
    text-decoration: underline;
}

/* Responsive design */
@media (max-width: 768px) {
    .login-container {
        flex-direction: column;
    }
    
    .image-section {
        min-height: 200px;
    }
    
    .form-section {
        padding: 30px 20px;
    }
}
    /* Additional styles for registration page */
.registration-container {
    max-width: 1100px;
}

.input-row {
    display: flex;
    gap: 15px;
    margin-bottom: 0;
}

.input-row .input-group {
    flex: 1;
}

.password-strength {
    margin-top: 8px;
    font-size: 0.8rem;
}

.strength-meter {
    height: 4px;
    background-color: #e0e0e0;
    border-radius: 2px;
    margin-bottom: 5px;
}

.strength-bar {
    height: 100%;
    width: 0;
    border-radius: 2px;
    transition: width 0.3s, background-color 0.3s;
}

.strength-text {
    color: #666;
    font-size: 0.8rem;
}

.terms-checkbox {
    display: flex;
    align-items: flex-start;
    margin-top: 5px;
}

.terms-checkbox input {
    margin-right: 10px;
    margin-top: 3px;
}

.terms-checkbox label {
    font-size: 0.9rem;
    line-height: 1.4;
}

.terms-checkbox a {
    color: var(--primary-color);
    text-decoration: none;
}

.terms-checkbox a:hover {
    text-decoration: underline;
}

.register-btn {
    margin-top: 10px;
}

/* Responsive adjustments */
@media (max-width: 768px) {
    .input-row {
        flex-direction: column;
        gap: 0;
    }
    
    .form-section {
        padding: 30px 20px;
    }
}
</style>
<body>
    <div class="container">
        <div class="login-container registration-container">
            <div class="image-section">
                <div class="overlay"></div>
                <div class="content">
                    <h1>Medicare</h1>
                    <p>Your health is our priority</p>
                </div>
            </div>
            <div class="form-section">
                <div class="form-header">
                    <h2>Create Account</h2>
                    <p>Join Medicare to access healthcare services</p>
                </div>
                <form id="register-form" action="register.php" method="POST">
                    <div class="input-row">
                        <div class="input-group">
                            <label for="first-name">First Name</label>
                            <div class="input-with-icon">
                                <i class="fas fa-user"></i>
                                <input type="text" id="first-name" name="first_name" required>
                            </div>
                        </div>
                        <div class="input-group">
                            <label for="last-name">Last Name</label>
                            <div class="input-with-icon">
                                <i class="fas fa-user"></i>
                                <input type="text" id="last-name" name="last_name" required>
                            </div>
                        </div>
                    </div>
                    
                    <div class="input-group">
                        <label for="email">Email Address</label>
                        <div class="input-with-icon">
                            <i class="fas fa-envelope"></i>
                            <input type="email" id="email" name="email" required>
                        </div>
                    </div>
                    
                    <div class="input-group">
                        <label for="username">Username</label>
                        <div class="input-with-icon">
                            <i class="fas fa-user-circle"></i>
                            <input type="text" id="username" name="username" required>
                        </div>
                    </div>
                    
                    <div class="input-group">
                        <label for="password">Password</label>
                        <div class="input-with-icon">
                            <i class="fas fa-lock"></i>
                            <input type="password" id="password" name="password" required>
                            <i class="fas fa-eye toggle-password"></i>
                        </div>
                        <div class="password-strength">
                            <div class="strength-meter">
                                <div class="strength-bar"></div>
                            </div>
                            <span class="strength-text">Password strength</span>
                        </div>
                    </div>
                    
                    <div class="input-group">
                        <label for="confirm-password">Confirm Password</label>
                        <div class="input-with-icon">
                            <i class="fas fa-lock"></i>
                            <input type="password" id="confirm-password" name="confirm_password" required>
                        </div>
                    </div>
                    
                    <div class="input-group">
                        <label for="dob">Date of Birth</label>
                        <div class="input-with-icon">
                            <i class="fas fa-calendar"></i>
                            <input type="date" id="dob" name="dob" required>
                        </div>
                    </div>
                    
                    <div class="input-group">
                        <div class="terms-checkbox">
                            <input type="checkbox" id="terms" name="terms" required>
                            <label for="terms">I agree to the <a href="#">Terms and Conditions</a> and <a href="#">Privacy Policy</a></label>
                        </div>
                    </div>
                    
                    <div id="error-message"></div>
                    <button type="submit" class="login-btn register-btn">Create Account</button>
                    
                    <div class="register-link">
                        <p>Already have an account? <a href="login.html">Login</a></p>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
    const registerForm = document.getElementById('register-form');
    const errorMessage = document.getElementById('error-message');
    const passwordInput = document.getElementById('password');
    const confirmPasswordInput = document.getElementById('confirm-password');
    const togglePassword = document.querySelector('.toggle-password');
    const strengthBar = document.querySelector('.strength-bar');
    const strengthText = document.querySelector('.strength-text');
    
    // Toggle password visibility
    togglePassword.addEventListener('click', function() {
        const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
        passwordInput.setAttribute('type', type);
        this.classList.toggle('fa-eye');
        this.classList.toggle('fa-eye-slash');
    });
    
    // Password strength meter
    passwordInput.addEventListener('input', function() {
        const password = this.value;
        const strength = calculatePasswordStrength(password);
        updateStrengthMeter(strength);
    });
    
    // Form validation
    registerForm.addEventListener('submit', function(e) {
        e.preventDefault();
        
        const username = document.getElementById('username').value.trim();
        const email = document.getElementById('email').value.trim();
        const password = passwordInput.value;
        const confirmPassword = confirmPasswordInput.value;
        const firstName = document.getElementById('first-name').value.trim();
        const lastName = document.getElementById('last-name').value.trim();
        const dob = document.getElementById('dob').value;
        const terms = document.getElementById('terms').checked;
        
        // Reset error message
        errorMessage.textContent = '';
        
        // Validate fields
        if (!firstName || !lastName) {
            showError('Please enter your full name');
            return;
        }
        
        if (!username) {
            showError('Please enter a username');
            return;
        }
        
        if (!validateEmail(email)) {
            showError('Please enter a valid email address');
            return;
        }
        
        if (password.length < 8) {
            showError('Password must be at least 8 characters long');
            return;
        }
        
        if (password !== confirmPassword) {
            showError('Passwords do not match');
            return;
        }
        
        if (!dob) {
            showError('Please enter your date of birth');
            return;
        }
        
        if (!terms) {
            showError('You must agree to the Terms and Conditions');
            return;
        }
        
        // If validation passes, submit the form
        this.submit();
    });
    
    function showError(message) {
        errorMessage.textContent = message;
        errorMessage.style.opacity = '1';
        
        // Add shake animation to form
        registerForm.classList.add('shake');
        setTimeout(() => {
            registerForm.classList.remove('shake');
        }, 500);
    }
    
    function validateEmail(email) {
        const re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        return re.test(email);
    }
    
    function calculatePasswordStrength(password) {
        let strength = 0;
        
        // Length check
        if (password.length >= 8) strength += 1;
        if (password.length >= 12) strength += 1;
        
        // Character variety checks
        if (/[A-Z]/.test(password)) strength += 1; // Has uppercase
        if (/[a-z]/.test(password)) strength += 1; // Has lowercase
        if (/[0-9]/.test(password)) strength += 1; // Has number
        if (/[^A-Za-z0-9]/.test(password)) strength += 1; // Has special char
        
        return Math.min(strength, 5); // Max strength is 5
    }
    
    function updateStrengthMeter(strength) {
        // Update the strength bar width and color
        const percentage = (strength / 5) * 100;
        strengthBar.style.width = `${percentage}%`;
        
        // Update color based on strength
        let color = '#e53935'; // Red (weak)
        let text = 'Weak';
        
        if (strength >= 2 && strength < 4) {
            color = '#ffb300'; // Amber (medium)
            text = 'Medium';
        } else if (strength >= 4) {
            color = '#43a047'; // Green (strong)
            text = 'Strong';
        }
        
        strengthBar.style.backgroundColor = color;
        strengthText.textContent = `Password strength: ${text}`;
        strengthText.style.color = color;
    }
    
    // Add animations to input fields
    const inputs = document.querySelectorAll('input');
    inputs.forEach(input => {
        input.addEventListener('focus', function() {
            this.parentElement.classList.add('focused');
        });
        
        input.addEventListener('blur', function() {
            if (this.value === '') {
                this.parentElement.classList.remove('focused');
            }
        });
    });
});
    </script>
</body>
</html> -->

<?php
session_start();

// Database configuration
$host = "localhost";
$dbname = "medicare";
$db_username = "root";
$db_password = "root";

// Initialize variables
$first_name = $last_name = $email = $username = $dob = "";
$errors = [];

// Process registration form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize inputs
    $first_name = htmlspecialchars(trim($_POST['first_name']));
    $last_name = htmlspecialchars(trim($_POST['last_name']));
    $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
    $username = htmlspecialchars(trim($_POST['username']));
    $password = trim($_POST['password']);
    $confirm_password = trim($_POST['confirm_password']);
    $dob = htmlspecialchars(trim($_POST['dob']));
    $terms = isset($_POST['terms']) ? true : false;
    
    // Validate inputs
    if (empty($first_name)) {
        $errors['first_name'] = "First name is required";
    }
    
    if (empty($last_name)) {
        $errors['last_name'] = "Last name is required";
    }
    
    if (empty($email)) {
        $errors['email'] = "Email is required";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = "Invalid email format";
    }
    
    if (empty($username)) {
        $errors['username'] = "Username is required";
    } elseif (strlen($username) < 4) {
        $errors['username'] = "Username must be at least 4 characters";
    }
    
    if (empty($password)) {
        $errors['password'] = "Password is required";
    } elseif (strlen($password) < 8) {
        $errors['password'] = "Password must be at least 8 characters";
    } elseif (!preg_match("/[A-Z]/", $password) || !preg_match("/[0-9]/", $password)) {
        $errors['password'] = "Password must contain at least one uppercase letter and one number";
    }
    
    if ($password !== $confirm_password) {
        $errors['confirm_password'] = "Passwords do not match";
    }
    
    if (empty($dob)) {
        $errors['dob'] = "Date of birth is required";
    }
    
    if (!$terms) {
        $errors['terms'] = "You must accept the terms and conditions";
    }
    
    // If no errors, proceed with registration
    if (empty($errors)) {
        try {
            // Connect to database
            $conn = new PDO("mysql:host=$host;dbname=$dbname", $db_username, $db_password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
            // Check if username exists
            $stmt = $conn->prepare("SELECT id FROM users WHERE username = :username");
            $stmt->bindParam(':username', $username);
            $stmt->execute();
            
            if ($stmt->rowCount() > 0) {
                $errors['username'] = "Username already taken";
            } else {
                // Check if email exists
                $stmt = $conn->prepare("SELECT id FROM users WHERE email = :email");
                $stmt->bindParam(':email', $email);
                $stmt->execute();
                
                if ($stmt->rowCount() > 0) {
                    $errors['email'] = "Email already registered";
                } else {
                    // Hash password
                    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
                    
                    // Insert new user
                    $stmt = $conn->prepare("INSERT INTO users (first_name, last_name, email, username, password, dob, role, created_at) 
                                           VALUES (:first_name, :last_name, :email, :username, :password, :dob, 'patient', NOW())");
                    
                    $stmt->bindParam(':first_name', $first_name);
                    $stmt->bindParam(':last_name', $last_name);
                    $stmt->bindParam(':email', $email);
                    $stmt->bindParam(':username', $username);
                    $stmt->bindParam(':password', $hashed_password);
                    $stmt->bindParam(':dob', $dob);
                    
                    if ($stmt->execute()) {
                        // Registration successful
                        $_SESSION['registration_success'] = true;
                        header("Location: login.php?registration=success");
                        exit();
                    }
                }
            }
        } catch(PDOException $e) {
            $errors['database'] = "Registration error: " . $e->getMessage();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Medicare Registration</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Your existing CSS styles with additions for registration form */
        body {
            background-color: #f5f5f5;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }
        
        .registration-container {
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            padding: 40px;
            max-width: 800px;
            width: 100%;
        }
        
        .form-header {
            text-align: center;
            margin-bottom: 30px;
        }
        
        .form-header h2 {
            color: #c62828;
            margin-bottom: 10px;
        }
        
        .error-message {
            color: #d32f2f;
            font-size: 0.9rem;
            margin-top: 5px;
        }
        
        .input-with-icon {
            position: relative;
        }
        
        .input-with-icon i {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #999;
        }
        
        .input-with-icon input {
            padding-left: 40px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="registration-container">
            <div class="form-header">
                <h2>Create Your Account</h2>
                <p>Join Medicare today for better healthcare</p>
            </div>
            
            <?php if (!empty($errors['database'])): ?>
                <div class="alert alert-danger"><?php echo $errors['database']; ?></div>
            <?php endif; ?>
            
            <form method="POST" action="registration.php">
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="first_name" class="form-label">First Name</label>
                        <input type="text" class="form-control <?php echo isset($errors['first_name']) ? 'is-invalid' : ''; ?>" 
                               id="first_name" name="first_name" value="<?php echo htmlspecialchars($first_name); ?>" required>
                        <?php if (isset($errors['first_name'])): ?>
                            <div class="error-message"><?php echo $errors['first_name']; ?></div>
                        <?php endif; ?>
                    </div>
                    <div class="col-md-6">
                        <label for="last_name" class="form-label">Last Name</label>
                        <input type="text" class="form-control <?php echo isset($errors['last_name']) ? 'is-invalid' : ''; ?>" 
                               id="last_name" name="last_name" value="<?php echo htmlspecialchars($last_name); ?>" required>
                        <?php if (isset($errors['last_name'])): ?>
                            <div class="error-message"><?php echo $errors['last_name']; ?></div>
                        <?php endif; ?>
                    </div>
                </div>
                
                
                
                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <div class="input-with-icon">
                        <i class="fas fa-user"></i>
                        <input type="text" class="form-control <?php echo isset($errors['username']) ? 'is-invalid' : ''; ?>" 
                               id="username" name="username" value="<?php echo htmlspecialchars($username); ?>" required>
                    </div>
                    <?php if (isset($errors['username'])): ?>
                        <div class="error-message"><?php echo $errors['username']; ?></div>
                    <?php endif; ?>
                </div>
                
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="password" class="form-label">Password</label>
                        <div class="input-with-icon">
                            <i class="fas fa-lock"></i>
                            <input type="password" class="form-control <?php echo isset($errors['password']) ? 'is-invalid' : ''; ?>" 
                                   id="password" name="password" required>
                            <i class="fas fa-eye toggle-password" style="right: 15px; left: auto; cursor: pointer;"></i>
                        </div>
                        <?php if (isset($errors['password'])): ?>
                            <div class="error-message"><?php echo $errors['password']; ?></div>
                        <?php endif; ?>
                    </div>
                    <div class="col-md-6">
                        <label for="confirm_password" class="form-label">Confirm Password</label>
                        <div class="input-with-icon">
                            <i class="fas fa-lock"></i>
                            <input type="password" class="form-control <?php echo isset($errors['confirm_password']) ? 'is-invalid' : ''; ?>" 
                                   id="confirm_password" name="confirm_password" required>
                        </div>
                        <?php if (isset($errors['confirm_password'])): ?>
                            <div class="error-message"><?php echo $errors['confirm_password']; ?></div>
                        <?php endif; ?>
                    </div>
                </div>
                
                <div class="mb-3">
                    <label for="dob" class="form-label">Date of Birth</label>
                    <input type="date" class="form-control <?php echo isset($errors['dob']) ? 'is-invalid' : ''; ?>" 
                           id="dob" name="dob" value="<?php echo htmlspecialchars($dob); ?>" required>
                    <?php if (isset($errors['dob'])): ?>
                        <div class="error-message"><?php echo $errors['dob']; ?></div>
                    <?php endif; ?>
                </div>
                
                <div class="mb-3 form-check">
                    <input type="checkbox" class="form-check-input <?php echo isset($errors['terms']) ? 'is-invalid' : ''; ?>" 
                           id="terms" name="terms" required>
                    <label class="form-check-label" for="terms">I agree to the Terms and Conditions</label>
                    <?php if (isset($errors['terms'])): ?>
                        <div class="error-message"><?php echo $errors['terms']; ?></div>
                    <?php endif; ?>
                </div>
                
                <button type="submit" class="btn btn-primary w-100 py-2">Register</button>
                
                <div class="text-center mt-3">
                    <p>Already have an account? <a href="login.php">Login here</a></p>
                </div>
            </form>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Toggle password visibility
            const togglePassword = document.querySelector('.toggle-password');
            const passwordInput = document.getElementById('password');
            
            if (togglePassword && passwordInput) {
                togglePassword.addEventListener('click', function() {
                    const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
                    passwordInput.setAttribute('type', type);
                    this.classList.toggle('fa-eye');
                    this.classList.toggle('fa-eye-slash');
                });
            }
            
            // Form validation
            const form = document.querySelector('form');
            if (form) {
                form.addEventListener('submit', function(e) {
                    // Client-side validation can be added here
                });
            }
        });
    </script>
</body>
</html>