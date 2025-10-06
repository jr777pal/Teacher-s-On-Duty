<?php
// Database configuration
$host = "localhost"; // Replace with your database host
$dbname = "teachers_on_duty"; // Database name
$username = "chiku"; // Replace with your database username
$password = "chiku@2004"; // Replace with your database password

// Create a connection to the database
try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get form inputs
    $name = $_POST['name'] ?? '';
    $mobile = $_POST['mobile_number'] ?? '';
    $email = $_POST['email'] ?? '';
    $area = $_POST['area_location'] ?? '';
    $gradeSubjects = $_POST['grade_subjects'] ?? '';
    $locationPref = $_POST['location_preference'] ?? '';

    // Insert form data into the database
    $sql = "INSERT INTO teacher_requests (name, mobile_number, email, area_location, grade_subjects, location_preference) 
            VALUES (:name, :mobile, :email, :area, :gradeSubjects, :locationPref)";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':mobile', $mobile);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':area', $area);
    $stmt->bindParam(':gradeSubjects', $gradeSubjects);
    $stmt->bindParam(':locationPref', $locationPref);

    if ($stmt->execute()) {
        echo "Form submitted successfully! We will Contact you soon for the class. ";
    } else {
        echo "Failed to submit the form.";
    }
}
?>
