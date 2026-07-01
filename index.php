<?php 
include 'config.php'; 

$message = "";
$edit_user = null;

// 1. XỬ LÝ CHỨC NĂNG: THÊM HOẶC CẬP NHẬT (UPDATE)
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['action'])) {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);

    if ($_POST['action'] == 'add') {
        // Thêm mới
        $stmt = $conn->prepare("INSERT INTO users (name, email) VALUES (?, ?)");
        $stmt->bind_param("ss", $name, $email);
        if ($stmt->execute()) {
            $message = "<div class='alert alert-success'>Thêm thành công!</div>";
        } else {
            $message = "<div class='alert alert-danger'>Lỗi hoặc Email đã tồn tại!</div>";
        }
    } elseif ($_POST['action'] == 'update') {
        // Cập nhật dữ liệu
        $id = intval($_POST['id']);
        $stmt = $conn->prepare("UPDATE users SET name = ?, email = ? WHERE id = ?");
        $stmt->bind_param("ssi", $name, $email, $id);
        if ($stmt->execute()) {
            $message = "<div class='alert alert-success'>Cập nhật thành công!</div>";
        } else {
            $message = "<div class='alert alert-danger'>Cập nhật thất bại!</div>";
        }
    }
}

// 2. XỬ LÝ CHỨC NĂNG: XÓA (DELETE)
if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']);
    $stmt = $conn->prepare("DELETE FROM users WHERE id = ?");
    $stmt->bind_param("i", $id);
    if ($stmt->execute()) {
        header("Location: index.php"); // Load lại trang để sạch URL
        exit();
    }
}

// 3. LẤY THÔNG TIN ĐỂ ĐƯA LÊN FORM SỬA (EDIT)
if (isset($_GET['edit'])) {
    $id = intval($_GET['edit']);
    $result = $conn->query("SELECT * FROM users WHERE id = $id");
    if ($result->num_rows > 0) {
        $edit_user = $result->fetch_assoc();
    }
}

// 4. LẤY DANH SÁCH HIỂN THỊ (READ)
$users = $conn->query("SELECT * FROM users ORDER BY id DESC");
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản Lý Người Dùng - CRUD PHP</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #f8f9fa; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; }
        .card { border: none; box-shadow: 0 4px 6px rgba(0,0,0,0.1); }
    </style>
</head>
<body>

<div class="container py-5">
    <div class="text-center mb-5">
        <h1 class="fw-bold text-primary">Hệ Thống Quản Lý Thành Viên</h1>
        <p class="text-muted">CRUD PHP thuần kết nối hệ quản trị cơ sở dữ liệu MySQL</p>
    </div>

    <?php echo $message; ?>

    <div class="row g-4">
        <div class="col-md-4">
            <div class="card p-4">
                <h4 class="mb-3 fw-bold text-secondary">
                    <?php echo $edit_user ? "Cập Nhật Thông Tin" : "Thêm Thành Viên Mới"; ?>
                </h4>
                
                <form method="POST" action="index.php">
                    <input type="hidden" name="action" value="<?php echo $edit_user ? 'update' : 'add'; ?>">
                    <?php if ($edit_user): ?>
                        <input type="hidden" name="id" value="<?php echo $edit_user['id']; ?>">
                    <?php endif; ?>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Họ và Tên</label>
                        <input type="text" name="name" class="form-control" placeholder="Nhập tên..." required 
                               value="<?php echo $edit_user ? htmlspecialchars($edit_user['name']) : ''; ?>">
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Địa chỉ Email</label>
                        <input type="email" name="email" class="form-control" placeholder="name@example.com" required
                               value="<?php echo $edit_user ? htmlspecialchars($edit_user['email']) : ''; ?>">
                    </div>

                    <button type="submit" class="btn <?php echo $edit_user ? 'btn-warning' : 'btn-primary'; ?> w-100 fw-bold">
                        <?php echo $edit_user ? "Cập nhật" : "Thêm ngay"; ?>
                    </button>

                    <?php if ($edit_user): ?>
                        <a href="index.php" class="btn btn-light w-100 mt-2 text-decoration-none">Hủy sửa</a>
                    <?php endif; ?>
                </form>
            </div>
        </div>

        <div class="col-md-8">
            <div class="card p-4">
                <h4 class="mb-3 fw-bold text-secondary">Danh Sách Thành Viên</h4>
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead class="table-dark">
                            <tr>
                                <th>ID</th>
                                <th>Họ và Tên</th>
                                <th>Email</th>
                                <th class="text-center">Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if ($users->num_rows > 0): ?>
                                <?php while($row = $users->fetch_assoc()): ?>
                                    <tr>
                                        <td><strong>#<?php echo $row['id']; ?></strong></td>
                                        <td><?php echo htmlspecialchars($row['name']); ?></td>
                                        <td><?php echo htmlspecialchars($row['email']); ?></td>
                                        <td class="text-center">
                                            <a href="index.php?edit=<?php echo $row['id']; ?>" class="btn btn-sm btn-outline-info me-1">Sửa</a>
                                            <a href="index.php?delete=<?php echo $row['id']; ?>" class="btn btn-sm btn-outline-danger" 
                                               onclick="return confirm('Bạn có chắc chắn muốn xóa thành viên này?')">Xóa</a>
                                        </td>
                                    </tr>
                                <?php endwhile; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="4" class="text-center text-muted py-3">Chưa có thành viên nào trong danh sách.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>