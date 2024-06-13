<?php
// Bắt đầu hoặc khôi phục phiên
session_start();

// Kiểm tra xem phương thức yêu cầu có phải là POST không
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Kiểm tra xem có dữ liệu gửi lên không
    if (isset($_POST['index'])) {
        // Lấy chỉ số của sản phẩm trong giỏ hàng
        $index = $_POST['index'];

        // Kiểm tra xem chỉ số sản phẩm có hợp lệ không
        if (isset($_SESSION['cart'][$index])) {
            // Xóa sản phẩm khỏi giỏ hàng
            unset($_SESSION['cart'][$index]);
        }
    }

    // Chuyển hướng người dùng đến trang giỏ hàng
    header("Location: cart.php");
    exit();
}

// Nếu không có dữ liệu gửi lên hoặc dữ liệu không hợp lệ, chuyển hướng người dùng đến trang chính
header("Location: index.php");
exit();
?>
