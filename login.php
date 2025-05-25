<?php
// Database connection parameters
$host = "127.0.0.1";
$dbname = "medicare";
$db_username = "root";     // Database login (Workbench)
$db_password = "root";     // Your MySQL Workbench password

// Start session
session_start();

// Function to sanitize user input
function sanitize_input($data) {
    return htmlspecialchars(stripslashes(trim($data)));
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get and sanitize user input
    $username_input = sanitize_input($_POST["username"]);
    $password_input = $_POST["password"];
    $remember = isset($_POST["remember"]) ? true : false;

    // Validate input
    if (empty($username_input) || empty($password_input)) {
        header("Location: index.html?error=empty_fields");
        exit();
    }

    try {
        // Create database connection (Workbench credentials used here)
        $conn = new PDO("mysql:host=$host;dbname=$dbname", $db_username, $db_password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Prepare and execute SQL
        $stmt = $conn->prepare("SELECT id, username, password, role FROM users WHERE username = :username");
        $stmt->bindParam(":username", $username_input);
        $stmt->execute();

        // Check user
        if ($stmt->rowCount() > 0) {
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if (password_verify($password_input, $user["password"])) {
                // Set session
                $_SESSION["user_id"] = $user["id"];
                $_SESSION["username"] = $user["username"];
                $_SESSION["role"] = $user["role"];
                $_SESSION["logged_in"] = true;

                // Remember me
                if ($remember) {
                    $token = bin2hex(random_bytes(32));
                    $stmt = $conn->prepare("UPDATE users SET remember_token = :token WHERE id = :id");
                    $stmt->bindParam(":token", $token);
                    $stmt->bindParam(":id", $user["id"]);
                    $stmt->execute();

                    setcookie("remember_token", $token, time() + (86400 * 30), "/");
                }

                // Redirect
                if ($user["role"] === "admin") {
                    header("Location: admin/dashboard.php");
                } else {
                    header("Location: dashboard.php");
                }
                exit();
            } else {
                header("Location: index.html?error=invalid_credentials");
                exit();
            }
        } else {
            header("Location: index.html?error=invalid_credentials");
            exit();
        }
    } catch (PDOException $e) {
        header("Location: index.html?error=database_error");
        exit();
    }
} else {
    header("Location: index.html");
    exit();
}
?>