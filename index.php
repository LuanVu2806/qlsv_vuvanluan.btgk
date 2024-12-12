<?php
require 'db.php';

// Lấy tất cả sinh viên từ cơ sở dữ liệu
$stmt = $conn->prepare("SELECT * FROM table_studen");
$stmt->execute();
$students = $stmt->fetchAll(PDO::FETCH_ASSOC); // Đổi tên biến từ $studen thành $students
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        body {
            background: linear-gradient(to right, #74ebd5, #9face6); /* Gradient background */
            font-family: 'Arial', sans-serif;
            color: #333;
        }
        .form-container {
            background-color: white;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2);
            max-width: 600px;
            margin: auto;
            margin-top: 50px;
        }
    </style>
    <title>Danh sách sinh viên</title>
</head>
<body>
    <div class="container mt-4">
        <h1 class="text-danger text-center">Danh sách sinh viên</h1>
        
        <!-- Thêm Sinh Viên Button -->
        <div class="mb-3">
            <a class="btn btn-primary" href="add.php">Thêm Sinh Viên</a>
        </div>

        <!-- Bảng Danh Sách Sinh Viên -->
        <table class="table table-primary table-borered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Họ và Tên</th>
                    <th>Ngày Sinh</th>
                    <th>Giới Tính</th>
                    <th>Quê Quán</th>
                    <th>Trình Độ</th>
                    <th>Nhóm</th>
                    <th>Hành Động</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($students as $student): ?>
                    <tr>
                        <td><?= $student['id'] ?></td>
                        <td><?= htmlspecialchars($student['fullname']) ?></td>
                        <td><?= date('d-m-Y', strtotime($student['dob'])) ?></td> <!-- Định dạng ngày tháng -->
                        <td><?= $student['gender'] == 1 ? 'Nam' : 'Nữ' ?></td>
                        <td><?= htmlspecialchars($student['hometown']) ?></td>
                        <td>
                            <?php 
                            switch ($student['level_id']) {
                                case 0: echo 'Tiến sĩ'; break;
                                case 1: echo 'Thạc sĩ'; break;
                                case 2: echo 'Kỹ sư'; break;
                                default: echo 'Khác'; break;
                            }
                            ?>
                        </td>
                        <td>Nhóm <?= $student['group_id'] ?></td>
                        <td>
                            <a class="btn btn-warning" href="edit.php?id=<?= $student['id'] ?>">Sửa</a>
                            <a class="btn btn-danger" href="delete.php?id=<?= $student['id'] ?>" onclick="return confirm('Bạn có chắc muốn xóa?');">Xóa</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>

