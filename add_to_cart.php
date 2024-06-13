<?php
// Kết nối đến cơ sở dữ liệu
require_once 'connect.php';

// Kiểm tra kết nối
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Bắt đầu hoặc khôi phục phiên
session_start();

// Xử lý dữ liệu gửi từ form
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Kiểm tra xem người dùng đã đăng nhập chưa
    if (isset($_SESSION["user_id"])) {
        $user_id = $_SESSION["user_id"]; // Sử dụng user_id từ phiên đăng nhập

        // Lặp qua mỗi sản phẩm được gửi từ form
        foreach ($_POST['products'] as $index => $product) {
            // Kiểm tra xem sản phẩm này có được thêm vào giỏ hàng không
            if (isset($_POST['add_to_cart_' . $index])) {
                // Lấy thông tin của sản phẩm từ dữ liệu gửi đi
                $product_id = $product['id'];
                $product_name = $product['name'];
                $price = $product['price'];
                $order_date = date("Y-m-d H:i:s"); // Lấy ngày giờ hiện tại
                $status = "pending"; // Trạng thái mặc định khi thêm vào giỏ hàng
                $total_money = $price; // Tạm thời chỉ có một sản phẩm, nên tổng tiền bằng giá của sản phẩm

                // Lấy đường dẫn hình ảnh từ dữ liệu sản phẩm
                $image_path = $product['images']['blue']; // Giả sử 'blue' là một trong các màu được chọn cho sản phẩm

                // Kiểm tra xem sản phẩm đã tồn tại trong giỏ hàng của người dùng chưa
                $check_cart_query = "SELECT * FROM Cart WHERE user_id = '$user_id' AND product_id = '$product_id'";
                $check_cart_result = mysqli_query($conn, $check_cart_query);
                if ($check_cart_result) {
                    if (mysqli_num_rows($check_cart_result) > 0) {
                        // Nếu sản phẩm đã tồn tại trong giỏ hàng, cập nhật số lượng và tổng tiền
                        $cart_row = mysqli_fetch_assoc($check_cart_result);
                        $new_quantity = $cart_row['quantity'] + 1;
                        $new_total_money = $cart_row['total_money'] + $price;
                        $update_cart_query = "UPDATE Cart SET quantity = '$new_quantity', total_money = '$new_total_money' WHERE id_Cart = '{$cart_row['id_Cart']}'";
                        if (mysqli_query($conn, $update_cart_query)) {
                            echo "<script>alert('Sản phẩm đã được cập nhật trong giỏ hàng'); window.location.href = 'index.php';</script>";
                            exit();
                        } else {
                            echo "Lỗi khi cập nhật giỏ hàng: " . mysqli_error($conn);
                        }
                    } else {
                        // Nếu sản phẩm chưa tồn tại trong giỏ hàng, thêm mới vào giỏ hàng
                        $insert_cart_query = "INSERT INTO Cart (user_id, product_id, image_path, product_name, price, order_date, status, total_money) 
                                                VALUES ('$user_id', '$product_id', '$image_path', '$product_name', '$price', '$order_date', '$status', '$total_money')";
                        if (mysqli_query($conn, $insert_cart_query)) {
                            echo "<script>alert('Sản phẩm đã được thêm vào giỏ hàng'); window.location.href = 'index.php';</script>";
                            exit();
                        } else {
                            echo "Lỗi khi thêm sản phẩm vào giỏ hàng: " . mysqli_error($conn);
                        }
                    }
                } else {
                    echo "Lỗi khi kiểm tra giỏ hàng: " . mysqli_error($conn);
                }
            }
        }
    } else {
        echo "Vui lòng đăng nhập trước khi thêm sản phẩm vào giỏ hàng.";
    }
}

// Đóng kết nối
mysqli_close($conn);
?>
