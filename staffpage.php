<?php
$servername = "localhost";
$username = "job_management_username_2024";
$password = "job_management_password_2024";
$dbname = "job_management_name_2024";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Prepare and bind
$stmt = $conn->prepare("INSERT INTO jobs_table (first_name, last_name, email, location, description, completed) VALUES (?, ?, ?, ?, ?, 'no')");
$stmt->bind_param("sssss", $first_name, $last_name, $email, $location, $description);

// Set parameters and execute
$first_name = htmlspecialchars($_POST['first_name']);
$last_name = htmlspecialchars($_POST['last_name']);
$email = htmlspecialchars($_POST['email']);
$location = htmlspecialchars($_POST['location']);
$description = htmlspecialchars($_POST['description']);

if ($stmt->execute()) {
    echo "New record created successfully";
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
