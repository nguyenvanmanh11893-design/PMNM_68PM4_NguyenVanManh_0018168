<?php
// Gọi file Controller gốc
require_once '../app/core/Controller.php';

class home extends Controller // Kế thừa Controller
{
    public function index()
    {
        // Gọi view thông qua mainLayout để có Header và Footer
        $this->view('layout/mainLayout', [
            'viewname' => 'home/index',
            'title'    => 'Trang chủ hệ thống'
        ]);
    }
    
    public function about()
    {
        echo "Đây là trang giới thiệu";
    }
    
    public function login()
    {
        require_once '../app/views/home/login.php';
    }
}