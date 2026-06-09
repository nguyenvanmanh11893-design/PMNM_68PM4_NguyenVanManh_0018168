<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php if (!empty($title)) echo $title; ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="d-flex flex-column min-vh-100 bg-light">
    <main class="container flex-grow-1 d-flex flex-column align-items-center">
        <h1 class="mb-4 text-center text-primary"><?php if (!empty($title)) echo $title; ?></h1>
        
        <div class="card shadow-sm w-100" style="max-width: 900px;">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover align-middle text-center mb-0">
                        <thead class="table-primary">
                            <tr>
                                <th>MSSV</th>
                                <th>Tên</th>
                                <th>Giới tính</th>
                                <th colspan="2">Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($students) && is_array($students)): ?>
                                <?php foreach($students as $sinhvien): ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($sinhvien['mssv']); ?></td>
                                    <td><?php echo htmlspecialchars($sinhvien['ten']); ?></td>
                                    <td><?php echo htmlspecialchars($sinhvien['gioitinh']); ?></td>
                                    <td style="width: 100px;">
                                        <a class="btn btn-sm btn-outline-primary w-100" href="/QLSV/public/sinhvien/edit/<?php echo $sinhvien['mssv']; ?>">Sửa</a>
                                    </td>
                                    <td style="width: 100px;">
                                        <a class="btn btn-sm btn-outline-danger w-100" href="/QLSV/public/sinhvien/delete/<?php echo $sinhvien['mssv']; ?>" onclick="return confirm('Bạn có chắc muốn xóa?');">Xóa</a>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="5" class="text-muted py-3">Không có sinh viên nào.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>

                <!-- Phân trang -->
                <?php if (!empty($totalpage)): ?>
                <nav class="mt-4 d-flex justify-content-center">
                    <ul class="pagination mb-0">
                        <?php for ($i = 1; $i <= $totalpage; $i++): ?>
                            <?php if ($i == $currentpage): ?>   
                                <li class="page-item active" aria-current="page"><span class="page-link"><?php echo $i; ?></span></li>
                            <?php else: ?>
                                <li class="page-item"><a class="page-link" href="/QLSV/public/sinhvien/index/<?php echo $i; ?>"><?php echo $i; ?></a></li>
                            <?php endif; ?>
                        <?php endfor; ?>
                    </ul>
                </nav>
                <?php endif; ?>
            </div>
        </div>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>