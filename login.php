<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Login</title>
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
        <?php
            session_start();

            // If already logged in as 'email_khach_hang' or 'tai_khoan', redirect to home page
            if (isset($_SESSION['email'])) {
                header("Location: index.php");
                exit();
            }
        ?>

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
                            <a href="account.php">
                                <i class="fas fa-solid fa-user"></i>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <!-- Login -->
        <section class="my-5 py-5">
            <div class="container text-center mt-3 pt-5">
                <h2 class="font-weight-bold">Login</h2>
                <hr class="mx-auto" />
            </div>
            <div class="mx-auto container">
                <form id="login-form" method="post">
                    <div class="form-group">
                        <label for="login-email">Email</label>
                        <input
                            type="text"
                            class="form-control"
                            id="login-email"
                            name="email"
                            placeholder="Email"
                            required
                        />
                    </div>
                    <div class="form-group">
                        <label for="login-password">Password</label>
                        <input
                            type="password"
                            class="form-control"
                            id="login-password"
                            name="password"
                            placeholder="Password"
                            required
                        />
                    </div>
                    <div class="form-group">
                        <input
                            type="submit"
                            class="form-control"
                            id="login-btn"
                            value="Login"
                            name="login"
                        />
                    </div>
                    <div class="form-group">
                        <a href="register.html" id="register-url" class="btn">
                            Don't have an account? Register
                        </a>
                    </div>
                </form>
            </div>
        </section>

        <?php
        // Handle form submission
        if (isset($_POST['login'])) {
            require 'server/connection.php';
            $email = $_POST['email'];
            $pass = $_POST['password'];

            // Prepare and bind
            $stmt = $conn->prepare("SELECT `user_id`, `name`, `email`, `password`, `role_id` FROM `user` WHERE `email` = ? AND `password` = ?");
            $stmt->bind_param("ss", $email, $pass);
            $stmt->execute();
            $result_customer = $stmt->get_result();

            if ($result_customer->num_rows > 0) {
                $row = $result_customer->fetch_assoc();
                $_SESSION['email'] = $row['email'];
                $_SESSION['password'] = $row['password'];
                $_SESSION['name'] = $row['name'];
                $_SESSION['user_id'] = $row['user_id'];
                $_SESSION['role_id'] = $row['role_id'];
                exit();
            } else {
                $error_message = "Invalid email or password.";
            }

            $stmt->close();
            $conn->close();
        }
        ?>

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
