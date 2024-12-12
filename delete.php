<?php
require 'db.php'; // Kết nối cơ sở dữ liệu từ file db.php

// Kiểm tra ID được truyền qua URL
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = $_GET['id'];

    try {
        // Chuẩn bị câu lệnh DELETE
        $stmt = $conn->prepare("DELETE FROM table_studen WHERE id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);

        // Thực thi câu lệnh
        if ($stmt->execute()) {
            // Xóa thành công, chuyển hướng về trang index
            header('Location: index.php');
            exit();
        } else {
            echo "Lỗi: Không thể xóa sinh viên.";
        }
    } catch (PDOException $e) {
        echo "Lỗi cơ sở dữ liệu: " . $e->getMessage();
    }
} else {
    echo "ID không hợp lệ hoặc không được cung cấp.";
}
?>

