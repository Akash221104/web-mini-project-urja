<?php
// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $username = $_POST['username'];
    $password = $_POST['password'];
    $fullname = $_POST['yourname'];
    $mobileno = $_POST['mobile-number'];
    // Perform basic validation (you might want to add more robust validation)
        $servername = "localhost";
        $db_username = "root";
        $db_password = "";
        $dbname = "urja";
        $conn = new mysqli($servername, $db_username, $db_password, $dbname);
        if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
        }
        try {
            if($fullname && $mobileno && $password && $username == true)
            // Prepare and bind SQL statement
            $stmt = $conn->prepare("INSERT INTO users (fullname, username, password, mobileno) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("sssi", $fullname, $username, $password, $mobileno);
            if ($stmt->execute() === TRUE) {
                echo "User registered successfully!";
                header("Location: register.html");
            } else {
                echo "Error: " . $conn->error;
            }
            // Close connection
            $stmt->close();
            $conn->close();
        } catch (Exception $e) {
            // Registration failed, handle the exception
            echo "Registration failed: " . $e->getMessage();
        }
}
?>