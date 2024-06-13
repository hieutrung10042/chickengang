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
    foreach ($_POST['products'] as $index => $product) {
        if (isset($_POST['add_to_cart_' . $index])) {
            $product_id = $product['id'];
            $product_name = $product['name'];
            $price = $product['price'];
            $color = $_POST['products'][$index]['color'];
            $quantity = $_POST['products'][$index]['num'];
            $image_path = $product['image_path']; // Lấy đường dẫn của hình ảnh từ trường ẩn

            // Tạo một mảng chứa thông tin sản phẩm
            $item = array(
                'id' => $product_id,
                'name' => $product_name,
                'price' => $price,
                'color' => $color,
                'quantity' => $quantity,
                'image_path' => $image_path // Thêm đường dẫn hình ảnh vào mảng sản phẩm
            );

            // Thêm sản phẩm vào giỏ hàng (mảng session)
            $_SESSION['cart'][] = $item;

            // Chuyển hướng người dùng đến trang giỏ hàng
            header("Location: cart.php");
            exit();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tất cả sản phẩm</title>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php include "menu.php";?>
    <section class="product-container">
        <!-- Thẻ Card cho sản phẩm -->
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" style="display: flex; flex-wrap: wrap; justify-content:center;">
            <?php foreach ($products as $index => $product): ?>
                <div class="product-card" style="margin: 10px">
                    <!-- Các trường ẩn chứa thông tin sản phẩm -->
                    <input type="hidden" name="products[<?= $index; ?>][id]" value="<?= $product['id']; ?>">
                    <input type="hidden" name="products[<?= $index; ?>][name]" value="<?= $product['name']; ?>">
                    <input type="hidden" name="products[<?= $index; ?>][price]" value="<?= $product['price']; ?>">
                    <input type="hidden" name="products[<?= $index; ?>][color]" id="selected_color_<?= $index; ?>" value="blue">
                    <input type="hidden" name="products[<?= $index;?>][num]" value="1">
                    <input type="hidden" name="products[<?= $index; ?>][image_path]" id="product_image_<?= $index; ?>" value="<?= reset($product['images']); ?>">

                    <!-- Thêm trường ẩn để lưu đường dẫn hình ảnh -->
                                    <!-- Logo và hình ảnh sản phẩm -->
                <div class="logo-cart">
                    <div class="heart-container" title="Thích">
                        <input type="checkbox" class="checkbox" id="Give-It-An-Id">
                        <div class="svg-container">
                            <!-- Mã SVG -->
                        </div>
                    </div>
                    <i class='bx bx-shopping-bag'></i>
                </div>
                <div class="main-images">
                    <?php foreach ($product['images'] as $color => $image): ?>
                        <img id="<?= $color; ?>" class="<?= $color === 'blue' ? 'active' : ''; ?>" src="img/<?= $image; ?>" alt="<?= $color; ?>" name="<?= $color; ?>">
                    <?php endforeach; ?>
                </div>
                <!-- Chi tiết sản phẩm -->
                <div class="shoe-details">
                    <span class="shoe_name"><?= $product['name']; ?></span>
                    <p><?= $product['description']; ?></p>
                </div>
                <!-- Lựa chọn màu sắc -->
                <div class="color-price">
                    <div class="color-option">
                    <span class="color">Colour:</span>
                        <div class="circles">   
                        <span class="circle blue active" id="blue" data-index="<?= $index; ?>" data-color="blue"></span>
                        <span class="circle pink" id="pink" data-index="<?= $index; ?>" data-color="pink"></span>
                        <span class="circle yellow" id="yellow" data-index="<?= $index; ?>" data-color="yellow"></span>
                        </div>
                    </div>
                    <!-- Giá sản phẩm -->
                    <div class="price">
                        <span class="price_num"><?= $product['price']; ?></span>
                        <span class="price_letter">Just <?= $product['price']; ?>$ only</span>
                    </div>
                </div>
                <!-- Nút Thêm vào giỏ hàng -->
                <div class="button">
                    <div class="button-layer"></div>
                    <button type="submit" name="add_to_cart_<?= $index; ?>">Add to cart</button>
                </div>
            </div>
        <?php endforeach; ?>
    </form>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        document.querySelectorAll('.color-option').forEach(circle => {
            circle.addEventListener("click", (e) => {
                let target = e.target;
                if (target.classList.contains("circle")) {
                    let colorName = target.id;
                    let productCard = circle.closest('.product-card');
                    productCard.querySelectorAll('.color-option .circle').forEach(c => {
                        c.classList.remove("active");
                    });
                    target.classList.add("active");
                    productCard.querySelectorAll(".main-images img").forEach(image => {
                        if (image.getAttribute("name") === colorName) {
                            image.classList.add("active");
                        } else {
                            image.classList.remove("active");
                        }
                    });
                    let index = productCard.querySelector('.circle').getAttribute('data-index');
                    document.getElementById(`selected_color_${index}`).value = colorName;
                }
            });
        });
    </script>
    <script>
  document.querySelectorAll('.color-option .circle').forEach(circle => {
    circle.addEventListener("click", (e) => {
        let target = e.target;
        if (target.classList.contains("circle")) {
            let colorName = target.id;
            let productCard = target.closest('.product-card');
            let index = productCard.querySelector('.circle').getAttribute('data-index');
            let imagePath = productCard.querySelector(`img[name="${colorName}"]`).getAttribute('src'); // Lấy đường dẫn hình ảnh tương ứng với màu sắc được chọn
            document.getElementById(`product_image_${index}`).value = imagePath; // Cập nhật đường dẫn hình ảnh
        }
    });
});

</script>

    
</section>
