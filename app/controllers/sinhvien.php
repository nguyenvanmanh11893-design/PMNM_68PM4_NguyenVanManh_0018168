<?php
require_once '../app/core/Controller.php';
class sinhvien extends Controller {
    public function index(){
        $sinhvienModel = $this->model('sinhvienModel');
        $sinhviens = $sinhvienModel->getAllSinhVien();
        // trả về view
        
        $this->view('sinhvien/index', ['sinhviens' => $sinhviens , 'title' => 'Danh sách sinh viên']);
    }
    public function create(){
        $this->view('sinhvien/create', ['title' => 'Thêm sinh viên']);
    }
}
