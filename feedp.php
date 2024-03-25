<?php
// Database connection parameters
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'urja';
$conn = new mysqli($host, $username, $password, $database);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        $name = $_POST["name"];
        $email = $_POST["email"];
        $feedback = $_POST["feedback"];

    $stmt = $conn->prepare("INSERT INTO feedbackt (name,email,feedback) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $name, $email, $feedback);
    if ($stmt->execute() === TRUE) {
        echo "feedback added successfully!";
        header("Location: home.html");
    } else {
        echo "Error: " . $conn->error;
    }
    
    } catch (Exception $e) {
        echo "Registration failed: " . $e->getMessage();
    }
}
    $stmt->close();
    $conn->close();
?>