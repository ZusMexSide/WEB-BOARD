<?php
class BD {

    private $servername = "localhost";
    private $username = "root";
    private $passw = "herrera";
    private $database = "webboard";
    protected $conn;

    public function __construct() {

        try {
            $this->conn = new PDO("mysql:host=$this->servername;dbname=$this->database", $this->username, $this->passw);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    }

}
?>