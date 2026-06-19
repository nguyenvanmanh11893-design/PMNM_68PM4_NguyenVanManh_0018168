<?php
require_once '../app/core/Controller.php';

class lophoc extends Controller {
    
    // ACTION: HIỂN THỊ DANH SÁCH CÓ PHÂN TRANG
    public function index($page = 1) {
        $currentpage = max(1, (int)$page); 
        
        // 1. Bắt các tham số từ URL
        $limit = isset($_GET['limit']) ? max(1, (int)$_GET['limit']) : 5; // Mặc định 5 dòng
        $search = $_GET['search'] ?? '';
        $sort = $_GET['sort'] ?? 'id_asc';
        
        $offset = ($currentpage - 1) * $limit;
        
        // 2. Gọi model
        $lophocModel = $this->model('lophocModel');
        $result = $lophocModel->paging($limit, $offset, $search, $sort);

        // 3. Truyền dữ liệu ra View
        $this->view('layout/mainLayout', [
            'viewname'    => 'lophoc/index',
            'classes'     => $result['lophocs'],
            'title'       => 'Danh sách lớp học',
            'totalpage'   => $result['totalpage'],
            'currentpage' => $currentpage,
            
            // Các biến phục vụ giữ trạng thái Form
            'limit'       => $limit,
            'search'      => $search,
            'sort'        => $sort
        ]);
    }

    // ACTION: GIAO DIỆN THÊM MỚI
    public function create() {
        $this->view('layout/mainLayout', [
            'viewname' => 'lophoc/create',
            'title'    => 'Thêm lớp học mới'
        ]);
    }

    // ACTION: XỬ LÝ LƯU DỮ LIỆU THÊM MỚI
    public function store() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $malop = trim($_POST['malop'] ?? '');
            $tenlop = trim($_POST['tenlop'] ?? '');
            $ghichu = trim($_POST['ghichu'] ?? '');

            $lophocModel = $this->model('lophocModel');
            if ($lophocModel->createLophoc($malop, $tenlop, $ghichu)) {
                header('Location: /QLSV/public/lophoc');
                exit();
            } else {
                echo "Lỗi: Có thể mã lớp đã tồn tại!";
            }
        }
    }

    // ACTION: GIAO DIỆN VÀ XỬ LÝ CẬP NHẬT
    public function update($id = '') {
        $lophocModel = $this->model('lophocModel');

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $malop = trim($_POST['malop'] ?? '');
            $tenlop = trim($_POST['tenlop'] ?? '');
            $ghichu = trim($_POST['ghichu'] ?? '');
            

            if ($lophocModel->updateLophoc($id, $malop, $tenlop, $ghichu)) {
                header('Location: /QLSV/public/lophoc');
                exit();
            } else {
                echo "Lỗi khi cập nhật lớp học!";
            }
        } else {
            if (empty($id)) {
                header('Location: /QLSV/public/lophoc');
                exit();
            }

            $lophoc = $lophocModel->getLophocById($id);
            if (!$lophoc) {
                echo "Không tìm thấy lớp học.";
                return;
            }

            $this->view('layout/mainLayout', [
                'viewname' => 'lophoc/update',
                'title'    => 'Cập nhật lớp học',
                'lophoc'   => $lophoc
            ]);
        }
    }

    // ACTION: XÓA LỚP HỌC
    public function delete($id = '')
{
    if (!empty($id)) {

        $lophocModel = $this->model('lophocModel');

        // Lấy thông tin lớp
        $lophoc = $lophocModel->getLophocById($id);

        if (!$lophoc) {
            echo "Không tìm thấy lớp học";
            return;
        }

        // Đếm số sinh viên trong lớp
        $count = $lophocModel->countSinhVienByLop($lophoc['malop']);

        if ($count > 0) {
            echo "Không thể xóa lớp vì còn $count sinh viên trong lớp.";
            return;
        }

        $lophocModel->deleteLophoc($id);
    }

    header('Location: /QLSV/public/lophoc');
    exit();
}
}
?>