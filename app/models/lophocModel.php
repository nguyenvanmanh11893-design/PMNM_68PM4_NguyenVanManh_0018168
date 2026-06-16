<?php
require_once '../app/core/connect.php';

class lophocModel {
    private $conn;

    public function __construct() {
        $db = new Connect();
        $db->connect();
        $this->conn = $db->conn;
    }

    // 1. Phân trang và lấy danh sách lớp học
    public function paging($limit, $offset) {
        $sql = "SELECT * FROM lophoc LIMIT :limit OFFSET :offset";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Tính tổng số trang
        $sqlCount = "SELECT COUNT(*) FROM lophoc";
        $stmtCount = $this->conn->query($sqlCount);
        $totalRecord = $stmtCount->fetchColumn();
        $totalpage = ceil($totalRecord / $limit);

        return ['lophocs' => $result, 'totalpage' => $totalpage];
    }

    // 2. Thêm lớp học
    public function createLophoc($malop, $tenlop, $ghichu) {
        $sql = "INSERT INTO lophoc (malop, tenlop, ghichu) VALUES (:malop, :tenlop, :ghichu)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':malop', $malop);
        $stmt->bindParam(':tenlop', $tenlop);
        $stmt->bindParam(':ghichu', $ghichu);
        return $stmt->execute();
    }

    // 3. Lấy 1 lớp học theo ID để hiện lên form Sửa
    public function getLophocById($id) {
        $sql = "SELECT * FROM lophoc WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // 4. Cập nhật lớp học
    public function updateLophoc($id, $malop, $tenlop, $ghichu) {
        $sql = "UPDATE lophoc SET malop = :malop, tenlop = :tenlop, ghichu = :ghichu WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->bindParam(':malop', $malop);
        $stmt->bindParam(':tenlop', $tenlop);
        $stmt->bindParam(':ghichu', $ghichu);
        return $stmt->execute();
    }

    // 5. Xóa lớp học
    public function deleteLophoc($id) {
        $sql = "DELETE FROM lophoc WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }
    // Hàm này lấy toàn bộ danh sách lớp học đổ ra thẻ <select>
    public function getAllLopHoc() {
        $sql = "SELECT * FROM lophoc";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>