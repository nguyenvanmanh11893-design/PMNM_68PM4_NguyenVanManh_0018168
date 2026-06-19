<div class="container mt-4 d-flex justify-content-center">
    <div class="card shadow-sm w-100" style="max-width: 600px;">
    <div class="card-header bg-success text-white text-center">
        <h4 class="mb-0"><?php echo !empty($title) ? $title : 'Thêm sinh viên mới'; ?></h4>
    </div>
    <div class="card-body">
        <form action="/QLSV/public/sinhvien/store" method="POST">

            <div class="mb-3">
                <label for="mssv" class="form-label fw-bold">Mã số sinh viên (MSSV):</label>
                <input type="text" class="form-control" id="mssv" name="mssv" placeholder="Nhập MSSV..." required>
            </div>

            <div class="mb-3">
                <label for="ten" class="form-label fw-bold">Tên sinh viên:</label>
                <input type="text" class="form-control" id="ten" name="ten" placeholder="Nhập họ và tên..." required>
            </div>

            <div class="mb-4">
                <label for="gioitinh" class="form-label fw-bold">Giới tính:</label>
                <select class="form-select" id="gioitinh" name="gioitinh" required>
                    <option value="" disabled selected>-- Chọn giới tính --</option>
                    <option value="Nam">Nam</option>
                    <option value="Nữ">Nữ</option>
                    <option value="Khác">Khác</option>
                </select>
            </div>
            <div class="mb-4">
                <label for="malop" class="form-label fw-bold">Chọn Lớp học:</label>
                <select class="form-select" id="malop" name="malop">
                    <option value="" selected>-- Chưa xếp lớp --</option>
                    <?php if (!empty($listLopHoc)): ?>
                        <?php foreach ($listLopHoc as $lop): ?>
                            <option value="<?php echo htmlspecialchars($lop['malop']); ?>">
                                <?php echo htmlspecialchars($lop['tenlop']); ?> (<?php echo htmlspecialchars($lop['malop']); ?>)
                            </option>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </select>
            </div>

            <div class="d-flex justify-content-between">
                <a href="/QLSV/public/sinhvien/index" class="btn btn-secondary">Quay lại</a>
                <button type="submit" class="btn btn-success">Lưu sinh viên</button>
            </div>

        </form>
    </div>
</div>