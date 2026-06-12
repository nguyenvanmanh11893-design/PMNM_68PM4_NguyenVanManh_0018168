<div class="card shadow-sm">
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

            <div class="d-flex justify-content-between">
                <a href="/QLSV/public/sinhvien/index" class="btn btn-secondary">Quay lại</a>
                <button type="submit" class="btn btn-success">Lưu sinh viên</button>
            </div>

        </form>
    </div>
</div>