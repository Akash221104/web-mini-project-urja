<?php
session_start();
// Database connection parameters
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'urja';
$conn = new mysqli($host, $username, $password, $database);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$username = $_POST["username"];
$password = $_POST["password"];
$secure_pass = password_hash($password, PASSWORD_BCRYPT);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $sql = "SELECT * FROM users WHERE username = '$username' AND password = '$secure_pass'";
    try {
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->get_result();
    
        // Check if any matching records found
        if ($result->num_rows > 0) {
            // Authentication successful
            $_SESSION['username'] = $username;
            header("Location: home.html");
        }
        // Close connection
        $stmt->close();
        $conn->close();
    } catch (Exception $e) {
        // Registration failed, handle the exception
        echo "Registration failed: " . $e->getMessage();
    }
}

// Close the database connection
$conn->close();
?>
