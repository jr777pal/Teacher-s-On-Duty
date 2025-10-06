<?php
class Database {
    private $servername = "localhost"; // Your database server (default is localhost)
    private $username = "chiku";       // Your database username
    private $password = "chiku@2004";           // Your database password
    private $dbname = "teachers_on_duty";  // Your database name
    public $conn;

    public function __construct() {
        $this->connect();
    }

    // Establish database connection
    private function connect() {
        $this->conn = new mysqli($this->servername, $this->username, $this->password, $this->dbname);

        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }

    // Close the connection
    public function close() {
        if ($this->conn) {
            $this->conn->close();
        }
    }
}

// Instantiate the database connection
$db = new Database();
$conn = $db->conn;
?>
