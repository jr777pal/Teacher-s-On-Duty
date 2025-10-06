<?php
session_start();
require_once 'db_connection_login.php'; // Include the database connection file

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form data
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    // Validate input fields
    if (empty($username) || empty($password)) {
        $_SESSION['error'] = 'Both fields are required.';
        header('Location: student_login.html'); // Redirect back to login page
        exit();
    }

    // Query to check for user credentials
    $query = "SELECT * FROM students WHERE username = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('s', $username);
    $stmt->execute();
    $result = $stmt->get_result();

    // If user exists
    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();

        // Verify the password
        if (password_verify($password, $user['password'])) {
            // Set session variables for logged-in user
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['logged_in'] = true;

            // Redirect to the dashboard or home page
            header('Location: student_profile.php');
            exit();
        } else {
            $_SESSION['error'] = 'Invalid password.';
            header('Location: student_login.html');
            exit();
        }
    } else {
        $_SESSION['error'] = 'No account found with that username.';
        header('Location: student_login.html');
        exit();
    }
}
?>
