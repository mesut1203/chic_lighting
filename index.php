<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Home</title>
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
    </head>
    <body>
        <!-- Navbar  -->
        <nav
            class="navbar navbar-expand-lg navbar-light bg-white py-3 fixed-top"
        >
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
                <div
                    class="collapse navbar-collapse nav-buttons"
                    id="navbarSupportedContent"
                >
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link" href="index.php">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="shop.php">Shop</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="#">Contact Us</a>
                        </li>
                        <li class="nav-item">
                            <a href="cart.php">
                                <i class="fas fa-solid fa-cart-shopping"></i>
                            </a>
                            <a href="login.php">
                                <i class="fas fa-solid fa-user"></i>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <!-- Home  -->
        <section id="home">
            <div class="container">
                <h5>NEW ARRIVALS</h5>
                <h1><span>Best Prices</span> This Season</h1>
                <p>
                    Eshop offers the best product for the most affordable prices
                </p>
                <button>Shop Now</button>
            </div>
        </section>

        <!-- Brannd  -->
        <section id="brand" class="container">
            <div class="row">
                <img
                    src="./assets/img/cilent-1.svg"
                    alt=""
                    class="img-fluid col-lg-3 col-md-6 col-sm-12"
                />
                <img
                    src="./assets/img/cilent-1.svg"
                    alt=""
                    class="img-fluid col-lg-3 col-md-6 col-sm-12"
                />
                <img
                    src="./assets/img/cilent-1.svg"
                    alt=""
                    class="img-fluid col-lg-3 col-md-6 col-sm-12"
                />
                <img
                    src="./assets/img/cilent-1.svg"
                    alt=""
                    class="img-fluid col-lg-3 col-md-6 col-sm-12"
                />
            </div>
        </section>

        <!-- New  -->
        <section id="new" class="w-100">
            <div class="row p-0 m-0">
                <!-- 1 -->
                <div class="one col-lg-4 col-md-12 col-sm-12 p-0">
                    <img
                        src="./assets/img/bradyn-shock-r0KP1Ua9-A4-unsplash.jpg"
                        alt=""
                        class="img-fluid"
                    />
                    <div class="details">
                        <h2>Extremely Awesome Shoes</h2>
                        <button class="text-uppercase">Shop Now</button>
                    </div>
                </div>

                <!-- 2 -->
                <div class="one col-lg-4 col-md-12 col-sm-12 p-0">
                    <img
                        src="./assets/img/bradyn-shock-r0KP1Ua9-A4-unsplash.jpg"
                        alt=""
                        class="img-fluid"
                    />
                    <div class="details">
                        <h2>Awesome Jacket</h2>
                        <button class="text-uppercase">Shop Now</button>
                    </div>
                </div>

                <!-- 3 -->
                <div class="one col-lg-4 col-md-12 col-sm-12 p-0">
                    <img
                        src="./assets/img/bradyn-shock-r0KP1Ua9-A4-unsplash.jpg"
                        alt=""
                        class="img-fluid"
                    />
                    <div class="details">
                        <h2>50% 0FF Watches</h2>
                        <button class="text-uppercase">Shop Now</button>
                    </div>
                </div>
            </div>
        </section>

        <!-- Featured -->
        <section id="featured" class="my-5 pb-5">
            <div class="container text-center mt-5 py-5">
                <h3>Our Featured</h3>
                <hr class="mx-auto" />
                <p>Here you can check out our featured product</p>
            </div>
            <div class="row mx-auto container-fluid">

            <?php include ('server/get_featured_product.php'); ?>

            <?php while($row= $featured_products->fetch_assoc()) { ?> 
                <!-- 1 -->
                <div class="product text-center col-lg-3 col-md-4 col-sm-12">
                    <img
                        src="./assets/img/<?php echo $row['product_image']; ?>"
                        alt=""
                        class="img-fluid mb-3"
                    />
                    <div class="star">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                    <h5 class="p-name"><?php echo $row['product_name']; ?></h5>
                    <h4 class="p-price">$<?php echo $row['product_price']; ?></h4>
                    <a href="<?php echo 'single_product.php?product_id=' . $row['product_id']; ?>"><button class="buy-btn">Buy Now</button></a>
                </div>

               <?php }  ?>
           
        </section>

        <!-- banner -->
        <section id="banner" class="my-5 pb-5">
            <div class="container">
                <h4>MID SEASON'S SALE</h4>
                <h1>
                    Autumn Collection <br />
                    UP to 30% OFF
                </h1>
                <button class="text-uppercase">shop now</button>
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
