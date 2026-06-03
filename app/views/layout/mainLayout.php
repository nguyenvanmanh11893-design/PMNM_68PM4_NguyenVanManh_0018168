<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($title) ? $title : 'Quản lý sinh viên'; ?></title>
    <style>
        * {
            margin: 0;
            padding: 0;
        }
        .content {
            width: 60%;
            margin: 0 auto;
        }
    </style>
</head>
<body>
    <div>
        <?php require_once '../app/views/layout/partial/header.php'; ?>
    </div>

    <div class="content">
        <?php 
        if (!empty($viewname)) {
            require '../app/views/' . $viewname . '.php';
        }
        ?>
    </div> <!-- đóng content -->

    <div>
        <?php require_once '../app/views/layout/partial/footer.php'; ?>
    </div>
</body>
</html>