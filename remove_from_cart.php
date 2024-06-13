<?php
// Bắt đầu hoặc khôi phục phiên
session_start();

// Kiểm tra xem yêu cầu POST có chứa chỉ mục của sản phẩm cần xóa không
if (isset($_POST['index'])) {
    // Lấy chỉ mục của sản phẩm cần xóa
    $index = $_POST['index'];

    // Kiểm tra xem giỏ hàng có tồn tại không và sản phẩm tại chỉ mục được chỉ định có tồn tại không
    if (isset($_SESSION['cart'][$index])) {
        // Xóa sản phẩm khỏi giỏ hàng
        unset($_SESSION['cart'][$index]);

        // Chuyển hướng người dùng đến trang giỏ hàng sau khi xóa sản phẩm
        header("Location: cart.php");
        exit();
    } else {
        // Nếu sản phẩm không tồn tại trong giỏ hàng, hiển thị thông báo lỗi
        echo "Sản phẩm không tồn tại trong giỏ hàng.";
    }
} else {
    // Nếu không có chỉ mục sản phẩm được gửi trong yêu cầu POST, hiển thị thông báo lỗi
    echo "Không có chỉ mục sản phẩm được gửi.";
}
?>
