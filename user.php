<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Home</title>
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous" />
    <!-- Css -->
    <link rel="stylesheet" href="./assets/css/display_user.css" />
    <!-- Font awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white py-3 fixed-top">
        <div class="container">
            <img src="./assets/img/Logo.svg" alt="Logo" class="logo" />
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse nav-buttons" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="shop.php">Shop</a></li>
                    <li class="nav-item"><a class="nav-link" href="user.php">User</a></li>

                    <?php 
                        session_start();
                        if (isset($_SESSION['email'])) {
                            echo "<li class='nav-item'>";
                            echo "<a href='cart.php'><i class='fas fa-solid fa-cart-shopping'></i></a>";
                            echo "<a href='#'><i class='fas fa-solid fa-user'></i></a>";
                            echo "Hello " . $_SESSION['name'];
                            echo "<form method='post' action='logout.php' style='display:inline;'><button class='logout' type='submit' name='logout'>Log out</button></form>";
                            echo "</li>";
                        } else {
                            echo "<li class='nav-item'>";
                            echo "<a href='cart.php'><i class='fas fa-solid fa-cart-shopping'></i></a>";
                            echo "<a href='login.php'><i class='fas fa-solid fa-user'></i></a>";
                            echo "</li>";
                        }
                    ?>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Display user -->
    <?php 
        require 'server/connection.php';
        mysqli_set_charset($conn, 'UTF8');

        $sql = "SELECT * FROM `user` INNER JOIN `role` ON `role`.`role_id` = `user`.`role_id`";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) { 
            echo "<form method='post' action='update_revoke_delete.php'>";
            echo "<table>
                    <caption>Account</caption>
                    <tr>
                        <th>Select</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Password</th>
                        <th>Role</th>
                    </tr>";
            while ($row = $result->fetch_assoc()) { 
                echo "<tr>
                        <td><input type='checkbox' name='checkbox[]' value='" . $row['user_id'] . "' /></td>
                        <td>" . $row['name'] . "</td>
                        <td>" . $row['email'] . "</td>
                        <td>" . $row['password'] . "</td>
                        <td>" . $row['name_role'] . "</td> 
                    </tr>";
            }
            echo "</table>
                <input type='submit' name='update_role' value='Grant Role' />
                <input type='submit' name='revoke_role' value='Revoke Role' />
                <input type='submit' name='delete_acc' value='Delete Account' />
                <a href='index.php'>Homepage</a> 
                </form>";
        } else {
            echo "There are no accounts.";
        }

    ?>


    <!-- Footer -->
    <footer class="mt-5 py-5">
        <div class="row container mx-auto pt-5">
            <div class="footer-one col-lg-3 col-md-6 col-sm-12">
                <img src="" alt="" class="logo" />
                <p class="pt-3">We provide the best products for the most affordable prices.</p>
            </div>
            <div class="footer-one col-lg-3 col-md-6 col-sm-12">
                <h5 class="pb-2">Featured</h5>
                <ul class="text-uppercase">
                    <li><a href="#">Men</a></li>
                    <li><a href="#">Women</a></li>
                    <li><a href="#">Boys</a></li>
                    <li><a href="#">Girls</a></li>
                    <li><a href="#">New Arrivals</a></li>
                    <li><a href="#">Clothes</a></li>
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
                    <p>eCommerce @ 2025 All Rights Reserved</p>
                </div>
                <div class="col-lg-3 col-md-5 col-sm-12 mb-4">
                    <a href="#!" class="fab fa-facebook"></a>
                    <a href="#!" class="fab fa-instagram"></a>
                    <a href="#!" class="fab fa-twitter"></a>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
