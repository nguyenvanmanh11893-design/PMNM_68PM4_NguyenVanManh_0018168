<div class="d-flex flex-column align-items-center w-100">
    <h3 class="mb-2 text-center text-primary"><?php echo !empty($title) ? $title : ''; ?></h3>
    
    <div class="w-100 mb-2 d-flex justify-content-between align-items-center" >
        <a href="/QLSV/public/lophoc/create" class="btn btn-sm btn-success fw-bold">+ Thêm lớp học</a>
    </div>

    <form method="GET" action="/QLSV/public/lophoc/index" class="w-100 mb-3">
        <div class="row g-2">
            <div class="col-md-4">
                <input type="text" name="search" class="form-control" placeholder="Tìm Mã lớp, Tên lớp..." value="<?php echo htmlspecialchars($search ?? ''); ?>">
            </div>
            <div class="col-md-3">
                <select name="sort" class="form-select">
                    <option value="id_asc" <?php echo (isset($sort) && $sort == 'id_asc') ? 'selected' : ''; ?>>Mặc định (Cũ nhất)</option>
                    <option value="malop_asc" <?php echo (isset($sort) && $sort == 'malop_asc') ? 'selected' : ''; ?>>Mã lớp A-Z</option>
                    <option value="malop_desc" <?php echo (isset($sort) && $sort == 'malop_desc') ? 'selected' : ''; ?>>Mã lớp Z-A</option>
                    <option value="tenlop_asc" <?php echo (isset($sort) && $sort == 'tenlop_asc') ? 'selected' : ''; ?>>Tên lớp A-Z</option>
                    <option value="tenlop_desc" <?php echo (isset($sort) && $sort == 'tenlop_desc') ? 'selected' : ''; ?>>Tên lớp Z-A</option>
                </select>
            </div>
            <div class="col-md-2">
                <select name="limit" class="form-select">
                    <option value="5" <?php echo (isset($limit) && $limit == 5) ? 'selected' : ''; ?>>5 dòng</option>
                    <option value="10" <?php echo (isset($limit) && $limit == 10) ? 'selected' : ''; ?>>10 dòng</option>
                    <option value="20" <?php echo (isset($limit) && $limit == 20) ? 'selected' : ''; ?>>20 dòng</option>
                </select>
            </div>
            <div class="col-md-3 d-flex gap-1">
                <button type="submit" class="btn btn-primary w-50">Lọc</button>
                <a href="/QLSV/public/lophoc/index" class="btn btn-secondary w-50">Đặt lại</a>
            </div>
        </div>
    </form>

    <div class="card shadow-sm w-100">
        <div class="card-body p-2">
            <div class="table-responsive">
                <table class="table table-bordered table-hover table-sm align-middle text-center mb-0">
                    <thead class="table-primary">
                        <tr>
                            <th style="width: 50px;">STT</th>
                            <th style="width: 150px;">Mã lớp</th>
                            <th class="text-start ps-3">Tên lớp</th>
                            <th class="text-start ps-3">Ghi chú</th>
                            <th colspan="2" style="width: 120px;">Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($classes) && is_array($classes)): ?>
                            <?php $stt = ($currentpage - 1) * ($limit ?? 5) + 1; ?>
                            <?php foreach($classes as $lophoc): ?>
                            <tr>
                                <td><?php echo $stt++; ?></td>
                                <td class="fw-bold text-success"><?php echo htmlspecialchars($lophoc['malop']); ?></td>
                                <td class="text-start ps-3 fw-semibold"><?php echo htmlspecialchars($lophoc['tenlop']); ?></td>
                                <td class="text-start ps-3 text-muted"><?php echo nl2br(htmlspecialchars($lophoc['ghichu'])); ?></td>
                                <td style="width: 60px;">
                                    <a class="btn btn-sm btn-outline-primary w-100 px-1 py-0" href="/QLSV/public/lophoc/update/<?php echo $lophoc['id']; ?>">Sửa</a>
                                </td>
                                <td style="width: 60px;">
                                    <a class="btn btn-sm btn-outline-danger w-100 px-1 py-0" href="/QLSV/public/lophoc/delete/<?php echo $lophoc['id']; ?>" onclick="return confirm('Chỉ có thể xóa lớp khi không còn sinh viên. Tiếp tục?');">Xóa</a>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="6" class="text-muted py-3">Chưa có lớp học nào trong hệ thống hoặc không tìm thấy kết quả.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>

            <?php if (!empty($totalpage) && $totalpage > 1): ?>
            <?php 
                // Tạo chuỗi query (VD: search=an&sort=id_asc&limit=5)
                $queryString = http_build_query([
                    'search' => $search ?? '',
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
                            <li class="page-item"><a class="page-link" href="/QLSV/public/lophoc/index/<?php echo $i; ?>?<?php echo $queryString; ?>"><?php echo $i; ?></a></li>
                        <?php endif; ?>
                    <?php endfor; ?>
                </ul>
            </nav>
            <?php endif; ?>
        </div>
    </div>
</div>