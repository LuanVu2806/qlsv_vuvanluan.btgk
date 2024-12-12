<?php
// Kết nối cơ sở dữ liệu
try {
    $pdo = new PDO("mysql:host=localhost;dbname=qlsv_vuvanluan", "root", "");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Kết nối thất bại: " . $e->getMessage());
}

// Xử lý khi form được gửi
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Kiểm tra và lấy dữ liệu từ form
    $fullname = !empty($_POST['fullname']) ? trim($_POST['fullname']) : null;
    $dob = !empty($_POST['dob']) ? $_POST['dob'] : null;
    $gender = isset($_POST['gender']) ? (int)$_POST['gender'] : null;
    $hometown = !empty($_POST['hometown']) ? trim($_POST['hometown']) : null;
    $level_id = isset($_POST['level_id']) ? (int)$_POST['level_id'] : null;
    $group_id = isset($_POST['group_id']) ? (int)$_POST['group_id'] : null;

    // Kiểm tra dữ liệu đầu vào
    if ($fullname && $dob && $gender !== null && $hometown && $level_id !== null && $group_id !== null) {
        try {
            // Chuẩn bị câu lệnh SQL
            $sql = "INSERT INTO table_Studen (fullname, dob, gender, hometown, level_id, group_id) 
                    VALUES (:fullname, :dob, :gender, :hometown, :level_id, :group_id)";
            $stmt = $pdo->prepare($sql);

            // Gắn giá trị vào câu lệnh
            $stmt->bindParam(':fullname', $fullname);
            $stmt->bindParam(':dob', $dob);
            $stmt->bindParam(':gender', $gender);
            $stmt->bindParam(':hometown', $hometown);
            $stmt->bindParam(':level_id', $level_id);
            $stmt->bindParam(':group_id', $group_id);

            // Thực thi câu lệnh
            $stmt->execute();

            // Chuyển hướng về danh sách sinh viên
            header('Location: index.php'); // Thay "list_students.php" bằng tên trang danh sách của bạn
            exit;
        } catch (PDOException $e) {
            echo "Lỗi khi thêm dữ liệu: " . $e->getMessage();
        }
    } else {
        echo "Vui lòng nhập đầy đủ thông tin!";
    }
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Thêm sinh viên</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    <div class="container mt-4">
        <h1 class="text-center text-danger">Thêm sinh viên</h1>
        
        <!-- Form thêm sinh viên -->
        <form method="post">
            <div class="mb-3">
                <label for="fullname" class="form-label">Họ và tên</label>
                <input type="text" class="form-control" id="fullname" name="fullname" required>
            </div>
            <div class="mb-3">
                <label for="dob" class="form-label">Ngày sinh</label>
                <input type="date" class="form-control" id="dob" name="dob" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Giới tính</label>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="gender" value="1" required> 
                    <label class="form-check-label">Nam</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="gender" value="0" required>
                    <label class="form-check-label">Nữ</label>
                </div>
            </div>
            <div class="mb-3">
                <label for="hometown" class="form-label">Quê quán</label>
                <input type="text" class="form-control" id="hometown" name="hometown" required>
            </div>
            <div class="mb-3">
                <label for="level_id" class="form-label">Trình độ học vấn</label>
                <select class="form-control" name="level_id" required>
                    <option value="0">Tiến sĩ</option>
                    <option value="1">Thạc sĩ</option>
                    <option value="2">Kỹ sư</option>
                    <option value="3">Khác</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="group_id" class="form-label">Nhóm</label>
                <input type="number" class="form-control" id="group_id" name="group_id" min="1" required>
            </div>
            <button type="submit" class="btn btn-success">Lưu</button>
            <a href="index.php" class="btn btn-secondary">Quay lại</a>
        </form>
    </div>
</body>
</html>
