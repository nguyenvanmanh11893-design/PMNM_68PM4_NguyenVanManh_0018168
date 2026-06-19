<h1 class="mb-4 text-center text-primary"><?php if (!empty($title)) echo $title; ?></h1>

<div class="w-100 mb-3 d-flex justify-content-between align-items-center">
    <a href="/QLSV/public/sinhvien/create" class="btn btn-success fw-bold">+ Thêm sinh viên</a>
</div>

<form method="GET" action="/QLSV/public/sinhvien/index" class="w-100 mb-3">
    <div class="row g-2">
        <div class="col-md-3">
            <input type="text" name="search" class="form-control" placeholder="Tìm MSSV, Tên..." value="<?php echo htmlspecialchars($search ?? ''); ?>">
        </div>
        <div class="col-md-2">
            <select name="malop" class="form-select">
                <option value="">-- Tất cả lớp --</option>
                <?php if (!empty($listLopHoc)): ?>
                    <?php foreach ($listLopHoc as $lop): ?>
                        <option value="<?php echo htmlspecialchars($lop['malop']); ?>" <?php echo (isset($malop) && $malop === $lop['malop']) ? 'selected' : ''; ?>>
                            <?php echo htmlspecialchars($lop['tenlop']); ?>
                        </option>
                    <?php endforeach; ?>
                <?php endif; ?>
            </select>
        </div>
        <div class="col-md-3">
            <select name="sort" class="form-select">
                <option value="id_asc" <?php echo (isset($sort) && $sort == 'id_asc') ? 'selected' : ''; ?>>Mặc định (ID Tăng)</option>
                <option value="mssv_asc" <?php echo (isset($sort) && $sort == 'mssv_asc') ? 'selected' : ''; ?>>MSSV Tăng dần</option>
                <option value="mssv_desc" <?php echo (isset($sort) && $sort == 'mssv_desc') ? 'selected' : ''; ?>>MSSV Giảm dần</option>
                <option value="ten_asc" <?php echo (isset($sort) && $sort == 'ten_asc') ? 'selected' : ''; ?>>Tên A-Z</option>
                <option value="ten_desc" <?php echo (isset($sort) && $sort == 'ten_desc') ? 'selected' : ''; ?>>Tên Z-A</option>
            </select>
        </div>
        <div class="col-md-2">
            <select name="limit" class="form-select">
                <option value="5" <?php echo (isset($limit) && $limit == 5) ? 'selected' : ''; ?>>5 dòng</option>
                <option value="10" <?php echo (isset($limit) && $limit == 10) ? 'selected' : ''; ?>>10 dòng</option>
                <option value="20" <?php echo (isset($limit) && $limit == 20) ? 'selected' : ''; ?>>20 dòng</option>
            </select>
        </div>
        <div class="col-md-2 d-flex gap-1">
            <button type="submit" class="btn btn-primary w-50">Lọc</button>
            <a href="/QLSV/public/sinhvien/index" class="btn btn-secondary w-50">Đặt lại</a>
        </div>
    </div>
</form>
<div class="card shadow-sm w-100">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-hover align-middle text-center mb-0">
                <thead class="table-primary">
                    <tr>
                        <th style="width: 50px;">STT</th>
                        <th style="width: 150px;">MSSV</th>
                        <th >Tên</th>
                        <th style="width: 150px;">Lớp học</th>
                        <th style="width: 100px;">Giới tính</th>
                        <th colspan="2" style="width: 120px;">Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($students) && is_array($students)): ?>
                        <?php $stt = ($currentpage - 1) * ($limit ?? 5) + 1; ?>
                        <?php foreach ($students as $sinhvien): ?>
                            <tr>
                                <td><?php echo $stt++; ?></td>
                                <td><?php echo htmlspecialchars($sinhvien['mssv']); ?></td>
                                <td><?php echo htmlspecialchars($sinhvien['ten']); ?></td>
                                <td class="fw-bold text-success">
                                    <?php echo htmlspecialchars($sinhvien['tenlop'] ?? 'Chưa xếp lớp'); ?>
                                </td>
                                <td><?php echo htmlspecialchars($sinhvien['gioitinh']); ?></td>
                                <td style="width: 100px;">
                                    <a class="btn btn-sm btn-outline-primary w-100" href="/QLSV/public/sinhvien/update/<?php echo $sinhvien['id']; ?>">Sửa</a>
                                </td>
                                <td style="width: 100px;">
                                    <a class="btn btn-sm btn-outline-danger w-100" href="/QLSV/public/sinhvien/delete/<?php echo $sinhvien['id']; ?>" onclick="return confirm('Bạn có chắc muốn xóa?');">Xóa</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="7" class="text-muted py-3">Không tìm thấy sinh viên nào.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <?php if (!empty($totalpage) && $totalpage > 1): ?>
            <?php
            $queryString = http_build_query([
                'search' => $search ?? '',
                'malop'  => $malop ?? '',
                'sort'   => $sort ?? 'id_asc',
                'limit'  => $limit ?? 5
            ]);
            ?>
            <nav class="mt-4 d-flex justify-content-center">
                <ul class="pagination mb-0">
                    <?php for ($i = 1; $i <= $totalpage; $i++): ?>
                        <?php if ($i == $currentpage): ?>
                            <li class="page-item active" aria-current="page"><span class="page-link"><?php echo $i; ?></span></li>
                        <?php else: ?>
                            <li class="page-item"><a class="page-link" href="/QLSV/public/sinhvien/index/<?php echo $i; ?>?<?php echo $queryString; ?>"><?php echo $i; ?></a></li>
                        <?php endif; ?>
                    <?php endfor; ?>
                </ul>
            </nav>
        <?php endif; ?>
    </div>
</div>