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
    $productName = $_POST["productname"];
    $category = $_POST["category"];
    $price = $_POST["price"];
    $description = $_POST["description"];
    $quantity = $_POST["quantity"];
    $photo = $_POST["photo"];
    $stmt = $conn->prepare("INSERT INTO product_list (image,name,description,cost,category,quantity) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("bssisi", $photo, $productname, $description, $price, $category,$quantity);
    if ($stmt->execute() === TRUE) {
        echo "Product added successfully!";
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