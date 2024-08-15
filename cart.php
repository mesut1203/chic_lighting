<?php 

session_start();

if(isset($_POST['add_to_cart'])) {

    // if user has already added a product to cart
    if (isset($_SESSION['cart'])) {
        
        // if product has already added to cart or not
        $product_array_ids = array_column($_SESSION['cart'], "product_id");

        if( !in_array($_POST['product_id'], $product_array_ids)) {
            
            $product_id = $_POST['product_id'];
            
            $product_array = array(
                            'product_id' => $_POST['product_id'],
                            'product_name' => $_POST['product_name'],
                            'product_price' => $_POST['product_price'],
                            'product_image' => $_POST['product_image'],
                            'product_quantity' => $_POST['product_quantity']
            );

        $_SESSION['cart'][$product_id] = $product_array;

            // product has already been added
        }else {
            echo '<script>alert("Product has already to cart");</script>';
            // echo '<script>window.location="index.php";</script>';


        }


        // if this is the first product
    }else {



        $product_id = $_POST['product_id'];
        $product_name = $_POST['product_name'];
        $product_price = $_POST['product_price'];
        $product_image = $_POST['product_image'];
        $product_quantity = $_POST['product_quantity'];

        $product_array = array(
                        'product_id' => $product_id,
                        'product_name' => $product_name,
                        'product_price' => $product_price,
                        'product_image' => $product_image,
                        'product_quantity' => $product_quantity
        );

       $_SESSION['cart'][$product_id] = $product_array;
        // [ 2=>[] , 3 =>[], 5 =>[] ]
    }

        // calculation total
        calculateTotalCart();





    // remove product from cart
}else if(isset($_POST['remove_product'])){

    $product_id = $_POST['product_id'];
    unset($_SESSION['cart'][$product_id]);

    // calculate total
    calculateTotalCart();


}else if(isset($_POST['edit_quantity'])) {

    // we got id and quantity from the form
    $product_id = $_POST['product_id'];
   $product_quantity = $_POST['product_quantity'];
//  get the product array from the session
    $product_array = $_SESSION['cart'][$product_id];

// update product quantity
    $product_array['product_quantity'] = $product_quantity;

// return array back it place
    $_SESSION['cart'][$product_id] = $product_array;


    // cacullate total
    calculateTotalCart();





}else {
    
    //header('location: index.php');
}




function calculateTotalCart() {
$total = 0;

    foreach($_SESSION['cart'] as $key => $value){
        
        $product = $_SESSION['cart'][$key];

        $price = $product['product_price'];
        $quantity = $product['product_quantity'];

        $total = $total + ($price * $quantity);
    }

    $_SESSION['total'] = $total;
}

?>








<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Document</title>
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
                            <a class="nav-link" href="#">Blog</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Contact Us</a>
                        </li>
                        <li class="nav-item">
                            <a href="cart.php"><i class="fas fa-solid fa-cart-shopping"></i></a>
                            <a href="login.php"><i class="fas fa-solid fa-user"></i></a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <!-- Cart -->
        <section class="cart container my-5 py-5">
            <div class="container mt-5">
                <h2 class="font-weight-bolde">Your cart</h2>
                <hr />
            </div>

            <table class="mt-5 pt-5">
                <tr>
                    <th>Product</th>
                    <th>Quantity</th>
                    <th>Subtotal</th>
                </tr>

            <?php foreach($_SESSION['cart'] as $key => $value) { ?>


                <tr>
                    <td>
                        <div class="product-info">
                            <img
                                src="./assets/img/<?php echo $value['product_image']; ?>"
                                alt=""
                            />
                            <div >
                                <p><?php echo $value['product_name']; ?></p>
                                <small><span>$</span><?php echo $value['product_price']; ?></small>
                                <br />
                                <form method="POST" action="cart.php">
                                    <input type="hidden" name="product_id" value="<?php echo $value['product_id']; ?>"/>
                                    <input type="submit" name="remove_product" class="remove-btn" value="remove"/>
                                </form>
                                
                            </div>
                        </div>
                    </td>

                    <td>
                        
                        <form method="POST" action="cart.php">
                            <input type="hidden" name="product_id" value="<?php echo $value['product_id']; ?>"/>
                            <input type="number" name="product_quantity" value="<?php echo $value['product_quantity']; ?>" />
                            <input type="submit" class="edit-btn" value="edit" name="edit_quantity"/>
                        </form>
                        
                        
                    </td>

                    <td>
                        <span>$</span>
                        <span class="product-price"><?php echo $value['product_quantity'] * $value['product_price']; ?></span>
                    </td>
                </tr>

                <?php } ?>     
            </table>

            <div class="cart-total">
                <table>
                    <!-- <tr>
                        <td>Subtotal</td>
                        <td>$155</td>
                    </tr> -->
                    <tr>
                        <td>Total</td>
                        <td>$ <?php echo $_SESSION['total'];  ?></td>
                    </tr>
                </table>
            </div>

            <div class="checkout-container">
                <form method="POST" action="checkout.php">
                    <input type="submit" class="btn checkout-btn" value="checkout" name="checkout"></input>

                </form>
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
