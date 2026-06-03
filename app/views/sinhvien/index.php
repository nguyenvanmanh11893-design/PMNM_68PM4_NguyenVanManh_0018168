<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php if (!empty($title)) echo $title; ?></title>
</head>
<body>
    <h1> <?php if (!empty($title)) echo $title; ?></h1>
    <table border="1">
        <tr>
            <th>MSSV</th>
            <th>Tên</th>
            <th>Giới tính</th>
        </tr>
        
            <?php if (!empty($students) && is_array($students)): ?>
                <?php foreach($students as $sinhvien): ?>
                <tr>
                    <td><?php echo htmlspecialchars($sinhvien['mssv']); ?></td>
                    <td><?php echo htmlspecialchars($sinhvien['ten']); ?></td>
                    <td><?php echo htmlspecialchars($sinhvien['gioitinh']); ?></td>
                </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="4">Không có sinh viên nào.</td>
                </tr>
            <?php endif; ?>
    
        </table>

    
</body>
</html>