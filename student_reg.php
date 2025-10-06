<?php
session_start();
$servername = "localhost";
$dbusername = "chiku"; // Use a different variable name to avoid confusion with form fields
$dbpassword = "chiku@2004";
$dbname = "teachers_on_duty";

// Debugging Helper
function debug($message) {
    error_log($message, 3, "error_log.txt"); // Logs errors in `error_log.txt`
}

// Create connection
$conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);

// Check connection
if ($conn->connect_error) {
    debug("Connection failed: " . $conn->connect_error);
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $email = filter_var(trim($_POST['email']), FILTER_VALIDATE_EMAIL);
    $password = trim($_POST['password']);
    $confirm_password = trim($_POST['confirm_password']);
    $first_name = htmlspecialchars(trim($_POST['first_name']));
    $middle_name = htmlspecialchars(trim($_POST['middle_name']));
    $last_name = htmlspecialchars(trim($_POST['last_name']));
    $phone_no = preg_replace('/\D/', '', $_POST['phone_no']);
    $whatsapp_no = preg_replace('/\D/', '', $_POST['whatsapp_no']);
    $qualifications = htmlspecialchars(trim($_POST['qualifications']));
    $age = intval($_POST['age']);
    $terms = isset($_POST['terms']);

    if (!$email) {
        $_SESSION['error'] = 'Invalid email address.';
        header('Location: student_registration.php');
        exit();
    }

    if (!$terms) {
        $_SESSION['error'] = 'You must accept the terms and conditions.';
        header('Location: student_registration.php');
        exit();
    }

    if ($password !== $confirm_password) {
        $_SESSION['error'] = 'Passwords do not match.';
        header('Location: student_registration.php');
        exit();
    }

    if (strlen($password) < 8) {
        $_SESSION['error'] = 'Password must be at least 8 characters long.';
        header('Location: student_registration.php');
        exit();
    }

    $stmt = $conn->prepare("SELECT * FROM students WHERE username = ? OR email = ?");
    if (!$stmt) {
        debug("Error preparing SELECT statement: " . $conn->error);
        $_SESSION['error'] = 'Database error.';
        header('Location: student_registration.php');
        exit();
    }

    $stmt->bind_param('ss', $username, $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $_SESSION['error'] = 'Username or email already exists.';
        $stmt->close();
        header('Location: student_registration.php');
        exit();
    }

    $hashed_password = password_hash($password, PASSWORD_BCRYPT);

    $stmt = $conn->prepare("INSERT INTO students (username, email, password, first_name, middle_name, last_name, phone_no, whatsapp_no, qualifications, age) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    if (!$stmt) {
        debug("Error preparing INSERT statement: " . $conn->error);
        $_SESSION['error'] = 'Database error.';
        header('Location: student_registration.php');
        exit();
    }

    $stmt->bind_param('sssssssssi', $username, $email, $hashed_password, $first_name, $middle_name, $last_name, $phone_no, $whatsapp_no, $qualifications, $age);

    if ($stmt->execute()) {
        $_SESSION['success'] = 'Registration successful! You can now log in.';
        header('Location: student_registration.php');
    } else {
        debug("Error executing INSERT statement: " . $stmt->error);
        $_SESSION['error'] = 'Registration failed. Please try again.';
        header('Location: student_registration.php');
    }

    $stmt->close();
}

$conn->close();
