<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($title) ? $title : 'QLSV'; ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        /* Cấu hình flex cho toàn bộ trang */
        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;  
        }

        /* Nội dung chính co giãn để đẩy footer xuống */
        .main-content {
            flex: 1;
        }

        .content {
            width: 90%;
            margin: 0 auto;
            padding: 20px 0;
        }

        /* Tuỳ chỉnh thêm nếu muốn header/footer đẹp */
        header, footer {
            flex-shrink: 0;
        }
    </style>
</head>
<body>
        <?php require_once '../app/views/layout/partial/header.php'; ?>
    

    <div class="main-content">
        <div class="content">
            <?php 
            if (!empty($viewname)) {
                require '../app/views/' . $viewname . '.php';
            }
            ?>
        </div>
    </div>
    
        <?php require_once '../app/views/layout/partial/footer.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>