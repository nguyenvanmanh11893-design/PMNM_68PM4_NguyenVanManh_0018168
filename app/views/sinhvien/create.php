<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php  if(!empty($title)) echo($title); ?></title>
</head>
<body>
    <h1> <?php if(!empty($title)) echo($title); ?></h1>
    <form action="/QLSV/public/sinhvien/store" method="POST">
        <label for="mssv">MSSV:</label><br>
        <input type="text" id="mssv" name="mssv" required><br><br>

        <label for="ten">Tên:</label><br>
        <input type="text" id="ten" name="ten" required><br><br>

        <label for="gioitinh">Giới tính:</label><br>
        <select id="gioitinh" name="gioitinh" required>
            <option value="">--Chọn giới tính--</option>
            <option value="Nam">Nam</option>
            <option value="Nữ">Nữ</option>
            <option value="Khác">Khác</option>
        </select><br><br>

        <input type="submit" value="Thêm sinh viên">


    
</body>
</html>