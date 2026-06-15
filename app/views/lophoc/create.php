<div class="container mt-2 d-flex justify-content-center">
    <div class="card shadow-sm w-100" style="max-width: 600px;">
        <div class="card-header bg-success text-white text-center">
            <h4 class="mb-0"><?php echo !empty($title) ? $title : 'Thêm lớp học'; ?></h4>
        </div>
        <div class="card-body">
            <form action="/QLSV/public/lophoc/store" method="POST">
                
                <div class="mb-3">
                    <label for="malop" class="form-label fw-bold">Mã lớp học:</label>
                    <input type="text" class="form-control" id="malop" name="malop" placeholder="VD: 68PM1..." required>
                </div>

                <div class="mb-3">
                    <label for="tenlop" class="form-label fw-bold">Tên lớp học:</label>
                    <input type="text" class="form-control" id="tenlop" name="tenlop" placeholder="Nhập tên lớp..." required>
                </div>

                <div class="mb-4">
                    <label for="ghichu" class="form-label fw-bold">Ghi chú (Tùy chọn):</label>
                    <textarea class="form-control" id="ghichu" name="ghichu" rows="4" placeholder="Nhập ghi chú..."></textarea>
                </div>

                <div class="d-flex justify-content-between">
                    <a href="/QLSV/public/lophoc" class="btn btn-secondary">Quay lại danh sách</a>
                    <button type="submit" class="btn btn-success">Thêm lớp học</button>
                </div>

            </form>
        </div>
    </div>
</div>