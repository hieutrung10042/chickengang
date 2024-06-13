<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<section class="container">
    <div class="container_wrapper">
        <ul class="menu">
            <li class="menu_item"><a href="./all-product.php" class="menu_link">All PRODUCT</a></li>
            <li class="menu_item"><a href="" class="menu_link">LEVENTS</a></li>
            <li class="menu_item"><a href="" class="menu_link">LAZY THINK COLLECTION</a></li>
            <li class="menu_item"><a href="" class="menu_link">REBEL COLLECTION®</a></li>
            <li class="menu_item">
                <a href="" class="menu_link">SHOP</a><i class='bx bxs-down-arrow'></i>
                <div class="menu_child">    
                    <ul class="menu_child-list">
                        <li><a href=""><button class="cssbuttons-io"><span>BEST SELLER</span></button></a></li>
                        <li><a href=""><button class="cssbuttons-io"><span>ALL ITEM</span></button></a></li>
                        <li><a href=""><button class="cssbuttons-io"><span>T-SHIRT</span></button></a></li>
                        <li><a href=""><button class="cssbuttons-io"><span>SHIRT</span></button></a></li>
                        <li><a href=""><button class="cssbuttons-io"><span>OUTERWEAR</span></button></a></li>
                    </ul>
                </div>
            </li>
            <li class="menu_item">
                <a href="" class="menu_link">COLLECTION</a><i class='bx bxs-down-arrow'></i>
                <div class="menu_child">    
                    <ul class="menu_child-list">
                        <li><a href=""><button class="cssbuttons-io"><span>FREEFALL</span></button></a></li>
                        <li><a href=""><button class="cssbuttons-io"><span>REMAKE</span></button></a></li>
                        <li><a href=""><button class="cssbuttons-io"><span>BASIC</span></button></a></li>
                        <li><a href=""><button class="cssbuttons-io"><span>LUCKY</span></button></a></li>
                        <li><a href=""><button class="cssbuttons-io"><span>STEPOUT</span></button></a></li>
                    </ul>
                </div>
            </li>
            <li class="menu_item" style="font-size: 25px;" id="cart_icon"><i class='bx bx-cart-alt' ></i></li>
        </ul>
    </div>
</section>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="script.js"></script>
<script>
    document.getElementById('cart_icon').addEventListener('click', function() {
        window.location.href = 'cart.php';
    });
</script>
</body>
</html>
