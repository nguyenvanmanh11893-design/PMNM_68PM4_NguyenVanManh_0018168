<div class="container mt-2 d-flex justify-content-center">
    <div class="card shadow-sm w-100" style="max-width: 600px;">
        <div class="card-header bg-primary text-white text-center">
            <h4 class="mb-0"><?php echo !empty($title) ? $title : 'Cập nhật lớp học'; ?></h4>
        </div>
        <div class="card-body">
            <form action="/QLSV/public/lophoc/update/<?php echo $lophoc['id']; ?>" method="POST">
                
                <div class="mb-3">
                    <label for="malop" class="form-label fw-bold">Mã lớp học:</label>
                    <input type="text" class="form-control" id="malop" name="malop" value="<?php echo htmlspecialchars($lophoc['malop']); ?>" required>
                </div>

                <div class="mb-3">
                    <label for="tenlop" class="form-label fw-bold">Tên lớp học:</label>
                    <input type="text" class="form-control" id="tenlop" name="tenlop" value="<?php echo htmlspecialchars($lophoc['tenlop']); ?>" required>
                </div>

                <div class="mb-4">
                    <label for="ghichu" class="form-label fw-bold">Ghi chú:</label>
                    <textarea class="form-control" id="ghichu" name="ghichu" rows="4"><?php echo htmlspecialchars($lophoc['ghichu']); ?></textarea>
                </div>

                <div class="d-flex justify-content-between">
                    <a href="/QLSV/public/lophoc" class="btn btn-secondary">Hủy bỏ</a>
                    <button type="submit" class="btn btn-primary">Lưu thay đổi</button>
                </div>

            </form>
        </div>
    </div>
</div>