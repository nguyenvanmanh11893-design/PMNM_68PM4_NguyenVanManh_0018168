<?php
class auth {
    protected $user =[
    'username' => 'admin',
    'password' => 'admin123'
];
    public function login() {
        if ($_SERVER['REQUEST_METHOD']=='POST') {
            $username = $_POST['username'];
            $password = $_POST['password'];
            if ($username == $this->user['username'] && $password == $this->user['password']) {
                $_SESSION['username'] = $username;
                header('Location: /QLSV/public/home/index');
                exit;
            } else {
                header('Location: /QLSV/public/home/login');
            }
        }
    }
}

