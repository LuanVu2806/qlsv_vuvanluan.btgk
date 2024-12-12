<?php
// Kết nối cơ sở dữ liệu
try {
    $pdo = new PDO("mysql:host=localhost;dbname=qlsv_vuvanluan", "root", "");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Kết nối thất bại: " . $e->getMessage());
}

// Lấy thông tin sinh viên từ ID
$id = $_GET['id'] ?? null; // Lấy ID từ URL
if ($id === null) {
    die("Không tìm thấy sinh viên."); // Kiểm tra nếu không có ID
}

try {
    $sql = "SELECT * FROM table_Studen WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    $studen = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$studen) {
        die("Không tìm thấy thông tin sinh viên.");
    }
} catch (PDOException $e) {
    die("Lỗi: " . $e->getMessage());
}

// Xử lý khi gửi form
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Lấy dữ liệu từ form
    $fullname = $_POST['fullname'] ?? null;
    $dob = $_POST['dob'] ?? null;
    $gender = $_POST['gender'] ?? null;
    $hometown = $_POST['hometown'] ?? null;
    $level_id = $_POST['level_id'] ?? null;
    $group_id = $_POST['group_id'] ?? null;

    // Kiểm tra dữ liệu đầu vào
    if ($fullname && $dob && $gender !== null && $hometown && $level_id !== null && $group_id !== null) {
        try {
            // Câu truy vấn UPDATE
            $sql = "UPDATE table_Studen 
                    SET fullname = :fullname, dob = :dob, gender = :gender, 
                        hometown = :hometown, level_id = :level_id, group_id = :group_id 
                    WHERE id = :id";

            $stmt = $pdo->prepare($sql);

            // Gán giá trị cho các tham số
            $stmt->bindParam(':fullname', $fullname);
            $stmt->bindParam(':dob', $dob);
            $stmt->bindParam(':gender', $gender, PDO::PARAM_INT);
            $stmt->bindParam(':hometown', $hometown);
            $stmt->bindParam(':level_id', $level_id, PDO::PARAM_INT);
            $stmt->bindParam(':group_id', $group_id, PDO::PARAM_INT);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);

            // Thực thi câu lệnh
            if ($stmt->execute()) {
                // Quay lại trang danh sách
                header("Location: index.php");
                exit;
            } else {
                echo "Lỗi khi cập nhật: " . $stmt->errorInfo()[2];
            }
        } catch (PDOException $e) {
            echo "Lỗi: " . $e->getMessage();
        }
    } else {
        echo "Vui lòng nhập đầy đủ thông tin.";
    }
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Chỉnh sửa thông tin sinh viên</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    <div class="container mt-4">
        <h1 class="text-center text-danger">Chỉnh sửa thông tin sinh viên</h1>
        
        <!-- Form chỉnh sửa thông tin sinh viên -->
        <form method="POST">
            <div class="mb-3">
                <label for="fullname" class="form-label">Họ và tên</label>
                <input type="text" class="form-control" id="fullname" name="fullname" value="<?= htmlspecialchars($studen['fullname']) ?>" required>
            </div>
            <div class="mb-3">
                <label for="dob" class="form-label">Ngày sinh</label>
                <input type="date" class="form-control" id="dob" name="dob" value="<?= htmlspecialchars(date('Y-m-d', strtotime($studen['dob']))) ?>" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Giới tính</label>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="gender" value="1" <?= $studen['gender'] == 1 ? 'checked' : '' ?>>
                    <label class="form-check-label">Nam</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="gender" value="0" <?= $studen['gender'] == 0 ? 'checked' : '' ?>>
                    <label class="form-check-label">Nữ</label>
                </div>
            </div>
            <div class="mb-3">
                <label for="hometown" class="form-label">Quê quán</label>
                <input type="text" class="form-control" id="hometown" name="hometown" value="<?= htmlspecialchars($studen['hometown']) ?>" required>
            </div>
            <div class="mb-3">
                <label for="level_id" class="form-label">Trình độ học vấn</label>
                <select class="form-control" name="level_id" required>
                    <option value="0" <?= $studen['level_id'] == 0 ? 'selected' : '' ?>>Tiến sĩ</option>
                    <option value="1" <?= $studen['level_id'] == 1 ? 'selected' : '' ?>>Thạc sĩ</option>
                    <option value="2" <?= $studen['level_id'] == 2 ? 'selected' : '' ?>>Kỹ sư</option>
                    <option value="3" <?= $studen['level_id'] == 3 ? 'selected' : '' ?>>Khác</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="group_id" class="form-label">Nhóm</label>
                <input type="number" class="form-control" id="group_id" name="group_id" value="<?= htmlspecialchars($studen['group_id']) ?>" min="1" required>
            </div>
            <button type="submit" class="btn btn-success">Lưu</button>
            <a href="index.php" class="btn btn-secondary">Quay lại</a>
        </form>
    </div>
</body>
</html>
