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
        // Lấy danh sách lớp học để hiển thị trong view
        $lophocModel = $this->model('lophocModel');
        $listLopHoc = $lophocModel->getAllLopHoc() ?? [];

        // Chỉ gọi layout một lần, truyền đủ viewname và data
        $this->view('layout/mainLayout', [
            'viewname' => 'sinhvien/index',
            'students' => $sinhviens,   
            'title'    => 'Danh sách sinh viên',
            'totalpage' => $totalpage,
            'currentpage' => $currentpage,
            'listLopHoc'  => $listLopHoc
        ]);
    }

    public function create() {
        $lophocModel = $this->model('lophocModel');
        $listLopHoc = $lophocModel->getAllLopHoc() ?? [];
        // Dùng layout cho form thêm sinh viên
        $this->view('layout/mainLayout', [
            'viewname' => 'sinhvien/create',
            'title'    => 'Thêm sinh viên',
            'listLopHoc' => $listLopHoc
        ]);
    }
    public function store() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $mssv = $_POST['mssv'] ?? '';
            $ten = $_POST['ten'] ?? '';
            $gioitinh = $_POST['gioitinh'] ?? '';
            $malop = $_POST['malop'] ?? '';

            $sinhvienModel = $this->model('sinhvienModel');
            if ($sinhvienModel->createSinhvien($mssv, $ten, $gioitinh, $malop)) {
                header('Location: /QLSV/public/sinhvien');
                exit();
            } else {
                echo "Lỗi khi thêm sinh viên.";
            }
        }
    }
    public function update($id = '') {
        $sinhvienModel = $this->model('sinhvienModel');
        $lophocModel = $this->model('lophocModel');
        $listLopHoc = $lophocModel->getAllLopHoc() ?? [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $mssv = $_POST['mssv'] ?? '';
            $ten = $_POST['ten'] ?? '';
            $gioitinh = $_POST['gioitinh'] ?? '';
            $malop = $_POST['malop'] ?? '';

            if ($sinhvienModel->updateSinhvien($id, $mssv, $ten, $gioitinh, $malop)) {
                header('Location: /QLSV/public/sinhvien');
                exit();
            } else {
                echo "Lỗi khi cập nhật! Mã số sinh viên này có thể đã tồn tại.";
            }
        } 
        else {
            if (empty($id)) {
                header('Location: /QLSV/public/sinhvien');
                exit();
            }

            $sinhvien = $sinhvienModel->getSinhvienById($id);
            if (!$sinhvien) {
                echo "Không tìm thấy sinh viên.";
                return;
            }

            $this->view('layout/mainLayout', [
                'viewname' => 'sinhvien/update',
                'title'    => 'Cập nhật sinh viên',
                'sinhvien' => $sinhvien ,
                'listLopHoc' => $listLopHoc
            ]);
        }
    }

    public function delete($id = '') {
        if (!empty($id)) {
            $sinhvienModel = $this->model('sinhvienModel');
            $sinhvienModel->deleteSinhvien($id);
        }
        header('Location: /QLSV/public/sinhvien');
        exit();
    }
} 
    