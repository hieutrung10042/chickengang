<?php
include 'connect.php';
include_once 'search.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CHICKEN GANG</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="style.css">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <!-- Nạp thư viện jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!-- Nạp script.js -->
    <script src="script.js"></script>
</head>

<body>
    <header>
        <a href="" class="brand">Chicken gang</a>
        <div class="menu-btn"></div>
        <div class="navigation">
            <div class="navigation-items">
                <a href="">Home</a>
                <a href="">About</a>
                <a href="">Product</a>
                <a href="feedback.php">Contact</a>
                <?php if (isset($_SESSION['username'])) { ?>
                    <a href="logout.php">Logout</a>
                    <div>Xin chào <?= $_SESSION['username'] ?></div>
                <?php } else { ?>
                    <a href="login.php">Login</a>
                    <a href="register.php">Register</a>
                <?php } ?>
                <!-- Nút nhấn để mở modal -->
                <button onclick="openModal()">Open Product Search</button>
                <!-- Modal -->
                <div id="productModal" class="modal">
                    <div class="modal-content">
                        <form id="searchForm" onsubmit="searchProducts(); return false;">
                            <input type="text" id="searchKeyword" placeholder="Enter keyword...">
                            <button type="submit">Search</button>
                        </form>
                        <div id="searchResults" class="product-info">
                            <!-- Thông tin sản phẩm sẽ được hiển thị ở đây -->
                        </div>
                        <span onclick="closeModal()" class="close">&times;</span>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </header>
    <!----HOME---->
    <section class="home">
        <video class="video-slide active" src="./img/1.mp4" autoplay muted loop></video>
        <video class="video-slide" src="./img/2.mp4" autoplay muted loop></video>
        <video class="video-slide" src="./img/3.mp4" autoplay muted loop></video>
        <video class="video-slide" src="./img/4.mp4" autoplay muted loop></video>
        <video class="video-slide" src="./img/5.mp4" autoplay muted loop></video>
        <div class="home-content active">
            <h1>clothing.<br><span>Shop</span></h1>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Maxime alias natus, nam doloribus quas non nemo rerum quam magnam reprehenderit ratione. Enim dicta velit provident doloribus asperiores obcaecati incidunt excepturi.</p>
            <div class="button-light">
                <a href="">
                    <span></span>
                    <span></span>
                    <span></span>
                    <span></span>
                    See more
                </a>
            </div>
        </div>
        <div class="home-content">
            <h1>fashion.<br><span>Shop</span></h1>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Maxime alias natus, nam doloribus quas non nemo rerum quam magnam reprehenderit ratione. Enim dicta velit provident doloribus asperiores obcaecati incidunt excepturi.</p>
            <div class="button-light">
                <a href="">
                    <span></span>
                    <span></span>
                    <span></span>
                    <span></span>
                    See more
                </a>
            </div>
        </div>
        <div class="home-content">
            <h1>fashion.<br><span>Shop</span></h1>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Maxime alias natus, nam doloribus quas non nemo rerum quam magnam reprehenderit ratione. Enim dicta velit provident doloribus asperiores obcaecati incidunt excepturi.</p>
            <div class="button-light">
                <a href="">
                    <span></span>
                    <span></span>
                    <span></span>
                    <span></span>
                    See more
                </a>
            </div>
        </div>
        <div class="home-content">
            <h1>fashion.<br><span>Shop</span></h1>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Maxime alias natus, nam doloribus quas non nemo rerum quam magnam reprehenderit ratione. Enim dicta velit provident doloribus asperiores obcaecati incidunt excepturi.</p>
            <div class="button-light">
                <a href="">
                    <span></span>
                    <span></span>
                    <span></span>
                    <span></span>
                    See more
                </a>
            </div>
        </div>
        <div class="home-content">
            <h1>fashion.<br><span>Shop</span></h1>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Maxime alias natus, nam doloribus quas non nemo rerum quam magnam reprehenderit ratione. Enim dicta velit provident doloribus asperiores obcaecati incidunt excepturi.</p>
            <div class="button-light">
                <a href="">
                    <span></span>
                    <span></span>
                    <span></span>
                    <span></span>
                    See more
                </a>
            </div>
        </div>
        <ul class="wrapper">
            <a href="https://www.facebook.com/HuyPham795">
                <li class="icon facebook">
                    <span class="tooltip">Facebook</span>
                    <svg viewBox="0 0 320 512" height="1.2em" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                        <path d="M279.14 288l14.22-92.66h-88.91v-60.13c0-25.35 12.42-50.06 52.24-50.06h40.42V6.26S260.43 0 225.36 0c-73.22 0-121.08 44.38-121.08 124.72v70.62H22.89V288h81.39v224h100.17V288z"></path>
                    </svg>
                </li>
            </a>

            <a href="">
                <li class="icon twitter">
                    <span class="tooltip">Twitter</span>
                    <svg height="1.8em" fill="currentColor" viewBox="0 0 48 48" xmlns="http://www.w3.org/2000/svg" class="twitter">
                        <path d="M42,12.429c-1.323,0.586-2.746,0.977-4.247,1.162c1.526-0.906,2.7-2.351,3.251-4.058c-1.428,0.837-3.01,1.452-4.693,1.776C34.967,9.884,33.05,9,30.926,9c-4.08,0-7.387,3.278-7.387,7.32c0,0.572,0.067,1.129,0.193,1.67c-6.138-0.308-11.582-3.226-15.224-7.654c-0.64,1.082-1,2.349-1,3.686c0,2.541,1.301,4.778,3.285,6.096c-1.211-0.037-2.351-0.374-3.349-0.914c0,0.022,0,0.055,0,0.086c0,3.551,2.547,6.508,5.923,7.181c-0.617,0.169-1.269,0.263-1.941,0.263c-0.477,0-0.942-0.054-1.392-0.135c0.94,2.902,3.667,5.023,6.898,5.086c-2.528,1.96-5.712,3.134-9.174,3.134c-0.598,0-1.183-0.034-1.761-0.104C9.268,36.786,13.152,38,17.321,38c13.585,0,21.017-11.156,21.017-20.834c0-0.317-0.01-0.633-0.025-0.945C39.763,15.197,41.013,13.905,42,12.429"></path>
                    </svg>
                </li>
            </a>
            <a href="https://www.instagram.com/_qhuy.ne_/">
                <li class="icon instagram">
                    <span class="tooltip">Instagram</span>
                    <svg xmlns="http://www.w3.org/2000/svg" height="1.2em" fill="currentColor" class="bi bi-instagram" viewBox="0 0 16 16">
                        <path d="M8 0C5.829 0 5.556.01 4.703.048 3.85.088 3.269.222 2.76.42a3.917 3.917 0 0 0-1.417.923A3.927 3.927 0 0 0 .42 2.76C.222 3.268.087 3.85.048 4.7.01 5.555 0 5.827 0 8.001c0 2.172.01 2.444.048 3.297.04.852.174 1.433.372 1.942.205.526.478.972.923 1.417.444.445.89.719 1.416.923.51.198 1.09.333 1.942.372C5.555 15.99 5.827 16 8 16s2.444-.01 3.298-.048c.851-.04 1.434-.174 1.943-.372a3.916 3.916 0 0 0 1.416-.923c.445-.445.718-.891.923-1.417.197-.509.332-1.09.372-1.942C15.99 10.445 16 10.173 16 8s-.01-2.445-.048-3.299c-.04-.851-.175-1.433-.372-1.941a3.926 3.926 0 0 0-.923-1.417A3.911 3.911 0 0 0 13.24.42c-.51-.198-1.092-.333-1.943-.372C10.443.01 10.172 0 7.998 0h.003zm-.717 1.442h.718c2.136 0 2.389.007 3.232.046.78.035 1.204.166 1.486.275.373.145.64.319.92.599.28.28.453.546.598.92.11.281.24.705.275 1.485.039.843.047 1.096.047 3.231s-.008 2.389-.047 3.232c-.035.78-.166 1.203-.275 1.485a2.47 2.47 0 0 1-.599.919c-.28.28-.546.453-.92.598-.28.11-.704.24-1.485.276-.843.038-1.096.047-3.232.047s-2.39-.009-3.233-.047c-.78-.036-1.203-.166-1.485-.276a2.478 2.478 0 0 1-.92-.598 2.48 2.48 0 0 1-.6-.92c-.109-.281-.24-.705-.275-1.485-.038-.843-.046-1.096-.046-3.233 0-2.136.008-2.388.046-3.231.036-.78.166-1.204.276-1.486.145-.373.319-.64.599-.92.28-.28.546-.453.92-.598.282-.11.705-.24 1.485-.276.738-.034 1.024-.044 2.515-.045v.002zm4.988 1.328a.96.96 0 1 0 0 1.92.96.96 0 0 0 0-1.92zm-4.27 1.122a4.109 4.109 0 1 0 0 8.217 4.109 4.109 0 0 0 0-8.217zm0 1.441a2.667 2.667 0 1 1 0 5.334 2.667 2.667 0 0 1 0-5.334z"></path>
                    </svg>
                </li>
            </a>

        </ul>

        <div class="home-slider-navigation">
            <div class="nav-btn active"></div>
            <div class="nav-btn"></div>
            <div class="nav-btn"></div>
            <div class="nav-btn"></div>
            <div class="nav-btn"></div>
        </div>
    </section>
    <!----CONTAINER---->
    <section class="container">
        <div class="container_wrapper">
            <ul class="menu">
                <li class="menu_item">
                    <a href="./all-product.php" class="menu_link">All PRODUCT</a>

                </li>
                <li class="menu_item"><a href="" class="menu_link">LEVENTS</a></li>
                <li class="menu_item"><a href="" class="menu_link">LAZY THINK COLLECTION</a></li>
                <li class="menu_item"><a href="" class="menu_link">REBEL COLLECTION®</a></li>
                <li class="menu_item">
                    <a href="" class="menu_link">SHOP</a><i class='bx bxs-down-arrow'></i>
                    <div class="menu_child">
                        <ul class="menu_child-list">
                            <li>
                                <a href="">
                                    <button class="cssbuttons-io">
                                        <span>
                                            <path d="M0 0h24v24H0z" fill="none"></path>
                                            BEST SELLER
                                        </span>
                                    </button>
                                </a>
                            </li>
                            <li>
                                <a href="">
                                    <button class="cssbuttons-io">
                                        <span>
                                            <path d="M0 0h24v24H0z" fill="none"></path>
                                            ALL ITEM
                                        </span>
                                    </button>
                                </a>
                            </li>
                            <li>
                                <a href="">
                                    <button class="cssbuttons-io">
                                        <span>
                                            <path d="M0 0h24v24H0z" fill="none"></path>
                                            T-SHIRT
                                        </span>
                                    </button>
                                </a>
                            </li>
                            <li>
                                <a href="">
                                    <button class="cssbuttons-io">
                                        <span>
                                            <path d="M0 0h24v24H0z" fill="none"></path>
                                            SHIRT
                                        </span>
                                    </button>
                                </a>
                            </li>
                            <li>
                                <a href="">
                                    <button class="cssbuttons-io">
                                        <span>
                                            <path d="M0 0h24v24H0z" fill="none"></path>
                                            OUTERWEAR
                                        </span>
                                    </button>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="menu_item">
                    <a href="" class="menu_link">COLLECTION</a><i class='bx bxs-down-arrow'></i>
                    <div class="menu_child">
                        <ul class="menu_child-list">
                            <li>
                                <a href="">
                                    <button class="cssbuttons-io">
                                        <span>
                                            <path d="M0 0h24v24H0z" fill="none"></path>
                                            FREEFALL
                                        </span>
                                    </button>
                                </a>
                            </li>
                            <li>
                                <a href="">
                                    <button class="cssbuttons-io">
                                        <span>
                                            <path d="M0 0h24v24H0z" fill="none"></path>
                                            REMAKE
                                        </span>
                                    </button>
                                </a>
                            </li>
                            <li>
                                <a href="">
                                    <button class="cssbuttons-io">
                                        <span>
                                            <path d="M0 0h24v24H0z" fill="none"></path>
                                            BASIC
                                        </span>
                                    </button>
                                </a>
                            </li>
                            <li>
                                <a href="">
                                    <button class="cssbuttons-io">
                                        <span>
                                            <path d="M0 0h24v24H0z" fill="none"></path>
                                            LUCKY
                                        </span>
                                    </button>
                                </a>
                            </li>
                            <li>
                                <a href="">
                                    <button class="cssbuttons-io">
                                        <span>
                                            <path d="M0 0h24v24H0z" fill="none"></path>
                                            STEPOUT
                                        </span>
                                    </button>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
            </ul>
        </div>
        <div class="wrapper-1">
            <h1>WELCOME TO <br> CHICKEN GANG</h1>
            <img src="./img/GIF.gif" alt="">
        </div>
        <section class="section-bg-scroll-one">
            <div class="img_section-bg-scroll-1">
                <a href=""><img src="https://contents.palcloset.jp/static/images/item/560468_2468155_7.jpg" alt="" data-aos="fade-up" data-aos-anchor-placement="top-bottom" data-aos-delay="300" data-aos-duration="1000"></a>
                <a href=""><img src="https://contents.palcloset.jp/static/images/item/560468_2468155_8.jpg" alt="" data-aos="fade-up" data-aos-anchor-placement="top-bottom" data-aos-delay="100" data-aos-duration="1000"></a>
            </div>
            <div class="img_section-bg-scroll-2">
                <a href=""><img src="https://contents.palcloset.jp/static/images/item/560468_2468155_9.jpg" alt="" data-aos="fade-up" data-aos-anchor-placement="top-bottom" data-aos-delay="100" data-aos-duration="1000"></a>
            </div>
        </section>
        <section class="section-bg-scroll-two">
            <div class="custom-card">
                <div class="img-box"><img src="https://images.pexels.com/photos/842963/pexels-photo-842963.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1"></div>
                <div class="custom-content">
                    <h2>LIVE</h2>
                    <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Architecto, hic? Magnam eum error saepe doloribus corrupti repellat quisquam alias doloremque!</p>
                    <a href="">Read More</a>
                </div>
            </div>
            <div class="custom-card">
                <div class="img-box"><img src="https://levents.asia/cdn/shop/files/homepage-ngang-4-1920x988_1.jpg?v=1699932491&width=750"></div>
                <div class="custom-content">
                    <h2>LOVE</h2>
                    <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Architecto, hic? Magnam eum error saepe doloribus corrupti repellat quisquam alias doloremque!</p>
                    <a href="">Read More</a>
                </div>
            </div>
            <div class="custom-card">
                <div class="img-box"><img src="https://levents.asia/cdn/shop/files/collection-summer-banner.jpg?v=1699932238&width=2000"></div>
                <div class="custom-content">
                    <h2>CHANGE</h2>
                    <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Architecto, hic? Magnam eum error saepe doloribus corrupti repellat quisquam alias doloremque!</p>
                    <a href="">Read More</a>
                </div>
            </div>
        </section>
        <section class="section-bg-scroll-three">
            <div class="img_section-bg-scroll-1">
                <a href=""><img src="https://i.pinimg.com/564x/5e/6f/8e/5e6f8ef115b55a215da24f03bbe4e889.jpg" alt="" data-aos="fade-up" data-aos-anchor-placement="top-bottom" data-aos-delay="300" data-aos-duration="1000"></a>
            </div>
            <div class="img_section-bg-scroll-2">
                <a href=""><img src="https://i.pinimg.com/564x/09/6e/57/096e578cc592cd524dd2ff5c992c2f5a.jpg" alt="" data-aos="fade-up" data-aos-anchor-placement="top-bottom" data-aos-delay="300" data-aos-duration="1000"></a>
            </div>
        </section>
    </section>
    <?php include "footer.php"; ?>
    <!-- ----JS---- -->
    <script type="text/javascript">
        const menuBtn = document.querySelector(".menu-btn");
        const navigation = document.querySelector(".navigation");

        menuBtn.addEventListener("click", () => {
            menuBtn.classList.toggle("active");
            navigation.classList.toggle("active");
        });

        const btns = document.querySelectorAll(".nav-btn");
        const slides = document.querySelectorAll(".video-slide");
        const contents = document.querySelectorAll(".home-content");

        //
        var sliderNav = function(manual) {
            btns.forEach((btn) => {
                btn.classList.remove("active");
            });

            slides.forEach((slide) => {
                slide.classList.remove("active");
            });

            contents.forEach((content) => {
                content.classList.remove("active");
            });

            btns[manual].classList.add("active");
            slides[manual].classList.add("active");
            contents[manual].classList.add("active");
        }

        btns.forEach((btn, i) => {
            btn.addEventListener("click", () => {
                sliderNav(i);
            });
        });

        window.onscroll = function() {
            stickyFunction()
        };

        var menu = document.querySelector(".menu");
        var sticky = menu.offsetTop;

        function stickyFunction() {
            if (window.pageYOffset >= sticky) {
                menu.classList.add("sticky");
            } else {
                menu.classList.remove("sticky");
            }
        }
        //Modal
        function openModal() {
    document.getElementById("productModal").style.display = "block";
}

function closeModal() {
    document.getElementById("productModal").style.display = "none";
}

// JavaScript để tìm kiếm sản phẩm
function searchProducts() {
    var keyword = document.getElementById("searchKeyword").value;

    // Sử dụng AJAX để gửi yêu cầu tìm kiếm và cập nhật kết quả trong modal
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("searchResults").innerHTML = this.responseText;
        }
    };
    xhttp.open("GET", "search.php?keyword=" + keyword, true);
    xhttp.send();
}
    </script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        AOS.init();
    </script>
</body>

</html>