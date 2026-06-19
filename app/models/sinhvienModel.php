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
    public function createSinhvien($mssv, $ten, $gioitinh, $malop = null) {
        $sql = "INSERT INTO sinhvien (mssv, ten, gioitinh, malop) VALUES (:mssv, :ten, :gioitinh, :malop)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':mssv', $mssv);
        $stmt->bindParam(':ten', $ten);
        $stmt->bindParam(':gioitinh', $gioitinh);
        $stmt->bindParam(':malop', $malop);
        return $stmt->execute();
    }
    public function paging($limit, $offset , $search = '', $malop = '', $sort = 'id_asc'){ 
        // 1. Xây dựng điều kiện WHERE động
        $where = " WHERE 1=1 "; // 1=1 là mẹo để nối chuỗi AND phía sau dễ dàng
        $params = [];

        // Tìm theo tên hoặc MSSV (Dùng LIKE)
        if (!empty($search)) {
            $where .= " AND (sinhvien.mssv LIKE :search OR sinhvien.ten LIKE :search) ";
            $params[':search'] = "%$search%"; // Thêm % để tìm kiếm gần đúng
        }

        // Tìm theo Mã lớp (Tìm chính xác)
        if (!empty($malop)) {
            $where .= " AND sinhvien.malop = :malop ";
            $params[':malop'] = $malop;
        }

        // 2. Xây dựng điều kiện ORDER BY (Bắt buộc gán cứng chuỗi, không dùng bindParam để tránh lỗi SQL)
        $orderBy = " ORDER BY sinhvien.id ASC "; // Mặc định
        switch ($sort) {
            case 'mssv_asc':  $orderBy = " ORDER BY sinhvien.mssv ASC "; break;
            case 'mssv_desc': $orderBy = " ORDER BY sinhvien.mssv DESC "; break;
            case 'ten_asc':   $orderBy = " ORDER BY SUBSTRING_INDEX(sinhvien.ten, ' ', -1) ASC, sinhvien.ten ASC "; break;
            case 'ten_desc':  $orderBy = " ORDER BY SUBSTRING_INDEX(sinhvien.ten, ' ', -1) DESC, sinhvien.ten DESC "; break;
        }

        $sql = "SELECT sinhvien.* ,lophoc.tenlop FROM sinhvien LEFT JOIN lophoc ON sinhvien.malop = lophoc.malop " . $where . $orderBy . " LIMIT :limit OFFSET :offset";
        $stmt = $this->conn->prepare($sql);
        // Bind các tham số tìm kiếm (nếu có)
        foreach ($params as $key => $val) {
            $stmt->bindValue($key, $val);
        }
        $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        //tính tổng số bản ghi
        $sqlCount = "SELECT COUNT(*) as total FROM sinhvien" . $where;
        $stmtCount = $this->conn->prepare($sqlCount);
        foreach ($params as $key => $val) {
            $stmtCount->bindValue($key, $val);
        }
        $stmtCount->execute();
        $totalRecord = $stmtCount->fetchColumn();
        $totalRecord = ceil($totalRecord / $limit);
        return ['sinhviens' => $result, 'totalpage' => $totalRecord];
    
}
// Lấy thông tin 1 sinh viên theo MSSV để điền vào form Sửa
    public function getSinhvienById($id) {
        $sql = "SELECT * FROM sinhvien WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC); 
    }

    // Thực thi câu lệnh Cập nhật sinh viên
    public function updateSinhvien($id, $mssv, $ten, $gioitinh, $malop ) {
        $sql = "UPDATE sinhvien SET mssv = :mssv, ten = :ten, gioitinh = :gioitinh, malop = :malop WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->bindParam(':mssv', $mssv);
        $stmt->bindParam(':ten', $ten);
        $stmt->bindParam(':gioitinh', $gioitinh);
        $stmt->bindParam(':malop', $malop);
        return $stmt->execute();
    }

    // Thực thi câu lệnh Xóa sinh viên
    public function deleteSinhvien($id) {
        $sql = "DELETE FROM sinhvien WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }
}
