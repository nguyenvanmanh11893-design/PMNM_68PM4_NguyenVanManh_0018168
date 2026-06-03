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
    public function createSinhvien($mssv, $ten, $gioitinh){
        $sql = "INSERT INTO sinhvien (mssv, ten, gioitinh) VALUES (:mssv, :ten, :gioitinh)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':mssv', $mssv);
        $stmt->bindParam(':ten', $ten);
        $stmt->bindParam(':gioitinh', $gioitinh);
        return $stmt->execute();
    }
}