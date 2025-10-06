<?php
// Database connection variables
$host = "localhost";  // Host name
$dbname = "teachers_on_duty"; // Database name
$username = "chiku";    // MySQL username
$password = "chiku@2004";        // MySQL password

// Create connection
$conn = new mysqli($host, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve and sanitize form data
$account_name = mysqli_real_escape_string($conn, $_POST['accountName']);
$account_number = mysqli_real_escape_string($conn, $_POST['accountNumber']);
$re_account_number = mysqli_real_escape_string($conn, $_POST['reAccountNumber']);
$bank_name = mysqli_real_escape_string($conn, $_POST['bankName']);
$ifsc_code = mysqli_real_escape_string($conn, $_POST['ifscCode']);
$upi_id = mysqli_real_escape_string($conn, $_POST['upiid']);

// Check if account numbers match
if ($account_number !== $re_account_number) {
    echo "Account numbers do not match. Please go back and try again.";
    exit();
}

// Insert data into the bank_details table
$sql = "INSERT INTO bank_details (account_name, account_number, re_account_number, bank_name, ifsc_code, upi_id) 
        VALUES ('$account_name', '$account_number', '$re_account_number', '$bank_name', '$ifsc_code', '$upi_id')";

if ($conn->query($sql) === TRUE) {
    echo "Bank details submitted successfully!";
    // Redirect to a thank-you page (optional)
    header("Location: thankyou.html");
    exit();
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Close the database connection
$conn->close();
?>
