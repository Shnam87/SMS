<?php
require_once __DIR__ . '/User.php';
require_once __DIR__ . '/Product.php';

class Database
{
    private $host = ""; 
    private $user = "root";
    private $pass = ""; 
    private $db = "sms_db";

    private $conn;

    public function __construct()
    {
        $this->conn = mysqli_connect($this->host, $this->user, $this->pass, $this->db);

        if (!$this->conn) {
            die("Connection failed!");
        }
        // echo "Connection OK";
    }
}