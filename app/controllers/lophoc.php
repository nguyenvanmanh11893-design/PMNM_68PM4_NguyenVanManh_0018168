<?php
require_once '../app/core/Controller.php';

class lophoc extends Controller {
    
    // ACTION: HIỂN THỊ DANH SÁCH CÓ PHÂN TRANG
    public function index($page = 1) {
        $currentpage = max(1, (int)$page); 
        $limit = 5; // Hiển thị 5 lớp trên 1 trang
        $offset = ($currentpage - 1) * $limit;
        
        $lophocModel = $this->model('lophocModel');
        $result = $lophocModel->paging($limit, $offset);

        $this->view('layout/mainLayout', [
            'viewname'    => 'lophoc/index',
            'classes'     => $result['lophocs'],
            'title'       => 'Danh sách lớp học',
            'totalpage'   => $result['totalpage'],
            'currentpage' => $currentpage,
            'limit'       => $limit
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
    public function delete($id = '') {
        if (!empty($id)) {
            $lophocModel = $this->model('lophocModel');
            $lophocModel->deleteLophoc($id);
        }
        header('Location: /QLSV/public/lophoc');
        exit();
    }
}
?>