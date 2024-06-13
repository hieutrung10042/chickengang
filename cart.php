<?php
// Kết nối đến cơ sở dữ liệu
require_once 'connect.php';

// Bắt đầu hoặc khôi phục phiên
session_start();

// Khởi tạo giỏ hàng nếu chưa tồn tại trong session
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = array();
}

// Xử lý yêu cầu xóa sản phẩm khỏi giỏ hàng
if (isset($_POST['remove_item'])) {
    $index = $_POST['index'];
    unset($_SESSION['cart'][$index]);
    header("Location: cart.php");
    exit();
}

// Lấy danh sách sản phẩm từ cơ sở dữ liệu
$sql = "SELECT p.*, pi.color, pi.image_path 
        FROM Products p
        LEFT JOIN Product_Image pi ON p.id_Product = pi.product_id";
$result = $conn->query($sql);

// Kiểm tra và gán dữ liệu cho biến $products
if ($result->num_rows > 0) {
    $products = array();
    while ($row = $result->fetch_assoc()) {
        $product_id = $row['id_Product'];
        if (!isset($products[$product_id])) {
            $products[$product_id] = array(
                'id' => $row['id_Product'],
                'name' => $row['product_name'],
                'description' => $row['description'],
                'price' => $row['price'],
                'quantity' => $row['quantity'],
                'created_at' => $row['created_at'],
                'update_at' => $row['update_at'],
                'images' => array()
            );
        }

        if (!empty($row['color']) && !empty($row['image_path'])) {
            $products[$product_id]['images'][$row['color']] = $row['image_path'];
        }
    }
} else {
    echo "Không có dữ liệu trong bảng Products";
}

// Xử lý dữ liệu gửi từ form
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    foreach ($_POST['cart'] as $index => $item) {
        if (isset($_POST['update_quantity_' . $index])) {
            $quantity = $_POST['quantity'][$index];
            $_SESSION['cart'][$index]['quantity'] = $quantity;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Giỏ hàng</title>
    <link rel="stylesheet" href="style.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="style.css">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
     <!-- Nạp thư viện jQuery -->
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!-- Nạp script.js -->
    <script src="script.js"></script>
</head>
<body>
    <?php include "menu.php";?>
    <div class="shopping-cart">
    <!-- Title -->
    <div class="title">
        Shopping Bag
    </div>

    <?php foreach ($_SESSION['cart'] as $index => $item): ?>
        <!-- Product #<?= $index + 1 ?> -->
        <div class="item">
            <div class="buttons">
                <form action="<?= htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                    <input type="hidden" name="index" value="<?= $index; ?>">
                    <button type="submit" name="remove_item" class="delete-btn"></button>
                </form>
                <span class="like-btn"></span>
            </div>

            <div class="image">
                <img src="<?= $item['image_path']; ?>" alt="<?= $item['name']; ?>" />
            </div>

            <div class="description">
                <span><?= $item['name']; ?></span>
                <span><?= $item['color']; ?></span>
            </div>

            <div class="quantity">
                <form action="<?= htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                    <input type="hidden" name="cart[<?= $index; ?>][id]" value="<?= $item['id']; ?>">
                    <input type="hidden" name="cart[<?= $index; ?>][color]" value="<?= $item['color']; ?>">
                    <button type="submit" class="minus-btn" name="update_quantity_<?= $index; ?>"></button>
                    <input type="text" name="quantity[<?= $index; ?>]" value="<?= $item['quantity']; ?>">
                    <button type="submit" class="plus-btn" name="update_quantity_<?= $index; ?>"></button>
                </form>
            </div>

            <div class="total-price"><?= $item['price'] * $item['quantity']; ?></div>
        </div>
    <?php endforeach; ?>
</div>
<script>
    $('.like-btn').on('click', function() {
        $(this).toggleClass('is-active');
    });

    $('.minus-btn').on('click', function(e) {
        e.preventDefault();
        var $this = $(this);
        var $input = $this.closest('div').find('input');
        var value = parseInt($input.val());

        if (value > 1) {
            value = value - 1;
        } else {
            value = 0;
        }

        $input.val(value);
    });

    $('.plus-btn').on('click', function(e) {
        e.preventDefault();
        var $this = $(this);
        var $input = $this.closest('div').find('input');
        var value = parseInt($input.val());

        if (value < 100) {
            value = value + 1;
        } else {
            value = 100;
        }

        $input.val(value);
    });
</script>

</body>
</html>

