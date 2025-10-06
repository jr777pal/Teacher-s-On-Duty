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
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hash the password

    $first_name = $_POST['first_name'];
    $middle_name = $_POST['middle_name'];
    $last_name = $_POST['last_name'];
    $pan_no = $_POST['pan_no'];
    $aadhar_no = $_POST['aadhar_no'];
    $phone_no = $_POST['phone_no'];
    $whatsapp_no = $_POST['whatsapp_no'];
    $qualifications = $_POST['qualifications'];
    $description = $_POST['description'];
    $age = $_POST['age'];
    $terms_accepted = isset($_POST['terms']) ? 1 : 0;

    // Insert into the database
    $sql = "INSERT INTO teachers (username, email, password, first_name, middle_name, last_name, pan_no, aadhar_no, phone_no, whatsapp_no, qualifications, description, age, terms_accepted) 
            VALUES ('$username', '$email', '$password', '$first_name', '$middle_name', '$last_name', '$pan_no', '$aadhar_no', '$phone_no', '$whatsapp_no', '$qualifications', '$description', '$age', '$terms_accepted')";

    if ($conn->query($sql) === TRUE) {
        echo "Registration successful!<a href='teacher.html'> Try Again</a> ";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>
