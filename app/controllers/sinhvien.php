<?php
require_once '../app/core/Controller.php';

class sinhvien extends Controller {
    public function index($page = 1) {
        // Lấy dữ liệu phân trang sinh viên từ model
        $currentpage = max(1, (int)$page); 
        $limit = 3;
        $offset = ($currentpage - 1) * $limit;
        

        $sinhvienModel = $this->model('sinhvienModel');
        $result = $sinhvienModel->paging($limit, $offset);
        $sinhviens = $result['sinhviens'];
        $totalpage = $result['totalpage'];

        // Chỉ gọi layout một lần, truyền đủ viewname và data
        $this->view('layout/mainLayout', [
            'viewname' => 'sinhvien/index',
            'students' => $sinhviens,   // đặt tên rõ ràng
            'title'    => 'Danh sách sinh viên',
            'totalpage' => $totalpage,
            'currentpage' => $currentpage
        ]);
    }

    public function create() {
        // Dùng layout cho form thêm sinh viên
        $this->view('layout/mainLayout', [
            'viewname' => 'sinhvien/create',
            'title'    => 'Thêm sinh viên'
        ]);
    }
    public function store() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $mssv = $_POST['mssv'] ?? '';
            $ten = $_POST['ten'] ?? '';
            $gioitinh = $_POST['gioitinh'] ?? '';

            $sinhvienModel = $this->model('sinhvienModel');
            if ($sinhvienModel->createSinhvien($mssv, $ten, $gioitinh)) {
                header('Location: /QLSV/public/sinhvien');
                exit();
            } else {
                echo "Lỗi khi thêm sinh viên.";
            }
        }
    }

}