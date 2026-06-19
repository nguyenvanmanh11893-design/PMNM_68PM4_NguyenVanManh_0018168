<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhập hệ thống QLSV</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f0f2f5;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .login-card {
            max-width: 400px;
            width: 100%;
            padding: 20px;
            border-radius: 10px;
        }
    </style>
</head>
<body>

    <div class="card shadow login-card border-0">
        <div class="card-body p-4">
            <h3 class="text-center mb-4 text-primary fw-bold">Đăng Nhập QLSV</h3>
            
            <form action="/QLSV/public/auth/login" method="POST">
                <div class="mb-3">
                    <label for="username" class="form-label fw-semibold">Tên đăng nhập</label>
                    <input type="text" class="form-control" id="username" name="username" placeholder="VD: admin" required>
                </div>
                
                <div class="mb-4">
                    <label for="password" class="form-label fw-semibold">Mật khẩu</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="VD: admin123" required>
                </div>
                
                <button type="submit" class="btn btn-primary w-100 fw-bold py-2">Đăng nhập</button>
            </form>
            
        </div>
    </div>

</body>
</html>