<div class="d-flex flex-column align-items-center w-100">
    <h1 class="mb-4 text-center text-primary"><?php echo !empty($title) ? $title : ''; ?></h1>
    
    <div class="w-100 mb-3" style="max-width: 900px;">
        <a href="/QLSV/public/lophoc/create" class="btn btn-success fw-bold">+ Thêm lớp học</a>
    </div>

    <div class="card shadow-sm w-100" style="max-width: 900px;">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover align-middle text-center mb-0">
                    <thead class="table-primary">
                        <tr>
                            <th style="width: 50px;">STT</th>
                            <th style="width: 150px;">Mã lớp</th>
                            <th>Tên lớp</th>
                            <th>Ghi chú</th>
                            <th colspan="2" style="width: 160px;">Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($classes) && is_array($classes)): ?>
                            <?php $stt = ($currentpage - 1) * $limit + 1; ?>
                            <?php foreach($classes as $lophoc): ?>
                            <tr>
                                <td><?php echo $stt++; ?></td>
                                <td class="fw-bold text-success"><?php echo htmlspecialchars($lophoc['malop']); ?></td>
                                <td><?php echo htmlspecialchars($lophoc['tenlop']); ?></td>
                                <td class="text-start"><?php echo nl2br(htmlspecialchars($lophoc['ghichu'])); ?></td>
                                <td style="width: 80px;">
                                    <a class="btn btn-sm btn-outline-primary w-100" href="/QLSV/public/lophoc/update/<?php echo $lophoc['id']; ?>">Sửa</a>
                                </td>
                                <td style="width: 80px;">
                                    <a class="btn btn-sm btn-outline-danger w-100" href="/QLSV/public/lophoc/delete/<?php echo $lophoc['id']; ?>" onclick="return confirm('Xóa lớp này sẽ mất toàn bộ dữ liệu. Bạn có chắc chắn?');">Xóa</a>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="6" class="text-muted py-3">Chưa có lớp học nào trong hệ thống.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>

            <?php if (!empty($totalpage) && $totalpage > 1): ?>
            <nav class="mt-4 d-flex justify-content-center">
                <ul class="pagination mb-0">
                    <?php for ($i = 1; $i <= $totalpage; $i++): ?>
                        <li class="page-item <?php echo ($i == $currentpage) ? 'active' : ''; ?>">
                            <a class="page-link" href="/QLSV/public/lophoc/index/<?php echo $i; ?>"><?php echo $i; ?></a>
                        </li>
                    <?php endfor; ?>
                </ul>
            </nav>
            <?php endif; ?>
        </div>
    </div>
</div>