<?php
session_start();
$servername = "localhost";
$username = "chiku"; 
$password = "chiku@2004"; 
$dbname = "teachers_on_duty";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the form data
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Query to find the user by username
    $sql = "SELECT * FROM teachers WHERE username='$username'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        // Verify the password
        if (password_verify($password, $row['password'])) {
            // Password is correct, set session variables
            $_SESSION['username'] = $row['username'];
            $_SESSION['email'] = $row['email'];
            // Redirect to the dashboard or home page
            header("Location: teacher_info.html"); // Change this to your target page after login
            exit();
        } else {
            // Invalid password
            echo "Invalid password. <a href='teacher.html'>Try again</a>";
        }
    } else {
        // User not found
        echo "User not found. <a href='teacher.html'>Try again</a>";
    }
}

$conn->close();
?>
