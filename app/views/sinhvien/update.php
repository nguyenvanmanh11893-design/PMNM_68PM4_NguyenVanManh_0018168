<div class="container mt-4 d-flex justify-content-center">
    <div class="card shadow-sm w-100" style="max-width: 600px;">
        <div class="card-header bg-primary text-white text-center">
            <h4 class="mb-0"><?php echo !empty($title) ? $title : 'Cập nhật sinh viên'; ?></h4>
        </div>
        <div class="card-body">
            <form action="/QLSV/public/sinhvien/update/<?php echo $sinhvien['mssv']; ?>" method="POST">
                
                <div class="mb-3">
                    <label for="mssv" class="form-label fw-bold">Mã số sinh viên (MSSV):</label>
                    <input type="text" class="form-control" id="mssv" name="mssv" value="<?php echo htmlspecialchars($sinhvien['mssv']); ?>" required>
                </div>

                <div class="mb-3">
                    <label for="ten" class="form-label fw-bold">Tên sinh viên:</label>
                    <input type="text" class="form-control" id="ten" name="ten" value="<?php echo htmlspecialchars($sinhvien['ten']); ?>" required>
                </div>

                <div class="mb-4">
                    <label for="gioitinh" class="form-label fw-bold">Giới tính:</label>
                    <select class="form-select" id="gioitinh" name="gioitinh" required>
                        <option value="Nam" <?php echo ($sinhvien['gioitinh'] === 'Nam') ? 'selected' : ''; ?>>Nam</option>
                        <option value="Nữ" <?php echo ($sinhvien['gioitinh'] === 'Nữ') ? 'selected' : ''; ?>>Nữ</option>
                        <option value="Khác" <?php echo ($sinhvien['gioitinh'] === 'Khác') ? 'selected' : ''; ?>>Khác</option>
                    </select>
                </div>

                <div class="d-flex justify-content-between">
                    <a href="/QLSV/public/sinhvien" class="btn btn-secondary">Quay lại danh sách</a>
                    <button type="submit" class="btn btn-primary">Lưu thay đổi</button>
                </div>

            </form>
        </div>
    </div>
</div>