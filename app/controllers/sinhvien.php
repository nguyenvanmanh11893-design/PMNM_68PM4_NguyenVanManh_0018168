<?php
require_once '../app/core/Controller.php';

class sinhvien extends Controller {
    public function index($page = 1) {
        $currentpage = max(1, (int)$page); 
        
        // 1. Nhận các tham số từ URL (nếu có), thiết lập giá trị mặc định
        $limit = isset($_GET['limit']) ? max(1, (int)$_GET['limit']) : 5;
        $search = $_GET['search'] ?? '';
        $malop = $_GET['malop'] ?? '';
        $sort = $_GET['sort'] ?? 'id_asc';
        
        $offset = ($currentpage - 1) * $limit;

        // 2. Gọi model sinh viên và truyền đủ tham số
        $sinhvienModel = $this->model('sinhvienModel');
        $result = $sinhvienModel->paging($limit, $offset, $search, $malop, $sort);
        $sinhviens = $result['sinhviens'];
        $totalpage = $result['totalpage'];
        
        // 3. Lấy danh sách lớp học để hiển thị lên Dropdown Lọc
        $lophocModel = $this->model('lophocModel');
        $listLopHoc = $lophocModel->getAllLopHoc() ?? [];

        // 4. Truyền dữ liệu ra View
        $this->view('layout/mainLayout', [
            'viewname'    => 'sinhvien/index',
            'students'    => $sinhviens,   
            'title'       => 'Danh sách sinh viên',
            'totalpage'   => $totalpage,
            'currentpage' => $currentpage,
            'listLopHoc'  => $listLopHoc,
            // Truyền lại các tham số để giữ trạng thái trên form
            'limit'       => $limit,
            'search'      => $search,
            'malop'       => $malop,
            'sort'        => $sort
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
    