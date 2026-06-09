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
        $sql = "SELECT * FROM sinhvien ";
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
    public function paging($limit, $offset , $search = ''){ {
        $sql = "SELECT * FROM sinhvien LIMIT :limit OFFSET :offset";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        
        //tính tổng số bản ghi
        $sqlCount = "SELECT COUNT(*) as total FROM sinhvien";
        $stmtCount = $this->conn->query($sqlCount);
        $totalRecord = $stmtCount->fetchColumn();
        $totalRecord = ceil($totalRecord / $limit);
        return ['sinhviens' => $result, 'totalpage' => $totalRecord];
    }
}
}
