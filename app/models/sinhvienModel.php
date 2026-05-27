<?php
require_once '../app/core/connect.php';
class sinhvienModel{
    private $conn;
    public function __construct()
    {
        $db = new Connect();
        $db->connect();
        $this->conn = $db->conn;
    }
    public function getAllSinhVien(){
        $sql = "SELECT * FROM sinhvien";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}