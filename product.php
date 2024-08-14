<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Shop</title>
        <!-- Bootstrap -->
        <link
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
            rel="stylesheet"
            integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
            crossorigin="anonymous"
        />
        <!-- Css -->
        <link rel="stylesheet" href="./assets/css/style.css" />

        <!-- Font awesome -->
        <link
            rel="stylesheet"
            href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
            integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
            crossorigin="anonymous"
            referrerpolicy="no-referrer"
        />

        <style>
            .product img {
                width: 100%;
                height: auto;
                box-sizing: border-box;
                object-fit: cover;
            }

            .pagination a {
                color: coral;
            }

            .pagination li:hover a {
                color: #fff;
                background-color: coral;
            }
        </style>
    </head>
    <body>
            <!-- Navbar  -->
            <nav class="navbar navbar-expand-lg navbar-light bg-white py-3 fixed-top">
                <div class="container">
                    <img src="./assets/img/Logo.svg" alt="" class="logo" />
                    <button
                        class="navbar-toggler"
                        type="button"
                        data-bs-toggle="collapse"
                        data-bs-target="#navbarSupportedContent"
                        aria-controls="navbarSupportedContent"
                        aria-expanded="false"
                        aria-label="Toggle navigation"
                    >
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse nav-buttons" id="navbarSupportedContent">
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                            <li class="nav-item">
                                <a class="nav-link" href="index.php">Home</a>
                            </li>
                            <?php 
                                session_start();
                                
                                if (isset($_SESSION['email'])) {
                                    if ($_SESSION['email'] == 'admin@gmail.com') {
                                        echo "<li class='nav-item'>";
                                        echo "<a class='nav-link' href='product.php'>Product</a>";
                                        echo "</li>";
                                        echo "<li class='nav-item'>";
                                        echo "<a class='nav-link' href='user.php'>User</a>";
                                        echo "</li>";
                                    }
                                    else{
                                        echo "<li class='nav-item'>";
                                        echo "<a class='nav-link' href='information.php'>Information</a>";
                                        echo "</li>";
                                    }
                                    echo "<li class='nav-item'>";
                                    echo "<a href='cart.php'>";
                                    echo "<i class='fas fa-solid fa-cart-shopping'></i>";
                                    echo "</a>";
                                    echo "<a href='#'>";
                                    echo "<i class='fas fa-solid fa-user'></i>";
                                    echo "</a>";
                                    echo "Hello " . $_SESSION['name'];
                                    echo "<form method='post' action='logout.php' style='display:inline;'>";
                                    echo "<button class='logout' type='submit' name='logout'>Log out</button>";
                                    echo "</form>";
                                    echo "</li>";
                                } else {
                                    echo "<li class='nav-item'>";
                                    echo "<a href='cart.php'>";
                                    echo "<i class='fas fa-solid fa-cart-shopping'></i>";
                                    echo "</a>";
                                    echo "<a href='login.php'>";
                                    echo "<i class='fas fa-solid fa-user'></i>";
                                    echo "</a>";
                                    echo "</li>";
                                }
                            ?>

                        </ul>
                    </div>
                </div>
            </nav>

        <!-- Featured -->
        <section id="featured" class="my-5 py-5">
            <div class="container mt-5 py-5">
                <h3>Our Product</h3>
                <hr />
                <p>Here you can check out our product</p>
            </div>
            <div class="row mx-auto container">
                <?php 
                    require 'server/connection.php';

                    $sql = "SELECT * FROM `product`";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo '<div onclick="window.location.href=\'single_product.php\';" class="product text-center col-lg-3 col-md-4 col-sm-12">';
                            echo '<img src="./assets/img/' . $row['image_product'] . '" alt="" class="img-fluid mb-3" />';
                            echo '<div class="star">';
                            echo '<i class="fas fa-star"></i>';
                            echo '<i class="fas fa-star"></i>';
                            echo '<i class="fas fa-star"></i>';
                            echo '<i class="fas fa-star"></i>';
                            echo '<i class="fas fa-star"></i>';
                            echo '</div>';
                            echo '<h5 class="p-name">' . $row['title'] . '</h5>';
                            echo '<h4 class="p-price">' . $row['price'] . '</h4>';
                            
                            if ($_SESSION['email'] == 'admin@gmail.com') {
                                echo '<button class="buy-btn">Detail</button>';
                            } else {
                                echo '<button class="buy-btn">Buy Now</button>';
                            }
                            echo '</div>';
                        }
                    }

                    if ($_SESSION['email'] == 'admin@gmail.com') {
                        echo '<nav aria-label="Page navigation example">';
                        echo '<ul class="pagination mt-5">';
                        echo '<li class="page-item">';
                        echo '<a href="update_add_delete_product.php" class="page-link">Change Product</a>';
                        echo '</li>';
                        echo '</nav>';
                    } else {
                        echo "";
                    }
                ?>

            </div>
        </section>

        <!-- footer -->
        <footer class="mt-5 py-5">
            <div class="row container mx-auto pt-5">
                <div class="footer-one col-lg-3 col-md-6 col-sm-12">
                    <img src="" alt="" class="logo" />
                    <p class="pt-3">
                        We provide the best products for the most affordable
                        prices
                    </p>
                </div>
                <div class="footer-one col-lg-3 col-md-6 col-sm-12">
                    <h5 class="pb-2">Featured</h5>
                    <ul class="text-uppercase">
                        <li><a href="#">men</a></li>
                        <li><a href="#">women</a></li>
                        <li><a href="#">boy</a></li>
                        <li><a href="#">girls</a></li>
                        <li><a href="#">new arrivals</a></li>
                        <li><a href="#">clothes</a></li>
                    </ul>
                </div>

                <div class="footer-one col-lg-3 col-md-6 col-sm-12">
                    <h5 class="pb-2">Contact Us</h5>
                    <div>
                        <h6 class="text-uppercase">Address</h6>
                        <p>285 Doi Can, Ha Noi</p>
                    </div>
                    <div>
                        <h6 class="text-uppercase">Phone</h6>
                        <p>0335390018</p>
                    </div>
                    <div>
                        <h6 class="text-uppercase">Email</h6>
                        <p>info@email.com</p>
                    </div>
                </div>

                <div class="footer-one col-lg-3 col-md-6 col-sm-12">
                    <h5 class="pb-2">Instagram</h5>
                    <div class="row">
                        <img src="" alt="" class="img-fluid w-25 h100 m-2" />
                        <img src="" alt="" class="img-fluid w-25 h100 m-2" />
                        <img src="" alt="" class="img-fluid w-25 h100 m-2" />
                        <img src="" alt="" class="img-fluid w-25 h100 m-2" />
                        <img src="" alt="" class="img-fluid w-25 h100 m-2" />
                    </div>
                </div>
            </div>

            <div class="copyright mt-5">
                <div class="row container mx-auto">
                    <div class="col-lg-3 col-5 col-sm-12 mb-4">
                        <img src="./assets/img/mbbabnk.webp" alt="" />
                    </div>
                    <div class="col-lg-3 col-5 col-sm-12 mb-4 text-nowrap mb-2">
                        <p>eComerce @ 2025 All Right Reserved</p>
                    </div>
                    <div class="col-lg-3 col-md-5 col-sm-12 mb-4">
                        <a href="#!" class="fab fa-facebook"></a>
                        <a href="#!" class="fab fa-instagram"></a>
                        <a href="#!" class="fab fa-twitter"></a>
                    </div>
                </div>
            </div>
        </footer>
        <script
            src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
            crossorigin="anonymous"
        ></script>
    </body>
</html>
