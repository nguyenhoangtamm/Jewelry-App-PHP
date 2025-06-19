<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lí Book Store</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Spectral:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../css/style.css">
</head>

<body>
    <!-- HEADER START -->
    <header class="header" id="header">
        <div class="header__container container">
            <div class="header__left">
                <div class="logo">
                    <a href="./index.php">
                        <img src="../images_web/logo.png" alt="logo">
                    </a>
                </div>
                <ul class="header__menu">
                    <li>
                        <a href="./index.php">Home</a>
                    </li>
                    <li class="active">
                        <a href="./books.php">Books</a>
                    </li>
                    <li>
                        <a href="./about.php">About Us</a>
                    </li>
                    <li>
                        <a href="./contact.php">Contact</a>
                    </li>
                </ul>
            </div>

            <div class="header__right">
                <div class="header__cart">
                    <a href="./cart.php">
                        <i class="bi bi-cart3"></i>
                    </a>
                    <span class="cart-count">0</span>
                </div>
                <div class="header__actions">
                    <a href="./login-signup.php" class="btn btn-sm header__login <?php echo isset($_SESSION['customer']) ? "" : "show"; ?>">Login</a>
                    <div class="user__actions <?php echo isset($_SESSION['customer']) ? "show" : ""; ?>">
                        <div class="avatar">
                            <img src="../images_web/avatar.png" alt="">
                        </div>
                        <i class="bi bi-caret-down-fill"></i>
                        <ul class="action__list">
                            <li>
                                <a href="./myaccount.php">My account</a>
                            </li>
                            <li>
                                <a href="./checkout.php">Check out</a>
                            </li>
                            <li class="log-out">
                                <span>Log out</span>
                                <i class="bi bi-box-arrow-right"></i>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- HEADER END -->

    <!-- SCROLL PAGE START -->
    <div class="scroll__page">
        <a href="#header">
            <i class="bi bi-chevron-up"></i>
        </a>
    </div>
    <!--  SCROLL PAGE START -->

    <!-- BREAD START -->
    <section class="breadcrumb">
        <ul class="breadcrumb__list container">
            <li><a href="./index.php" class="breadcrumb__link">Home</a></li>
            <li><span class="breadcrumb__link">></span></li>
            <li><a href="./books.php" class="breadcrumb__link">Books</a></li>
            <li><span class="breadcrumb__link">></span></li>
            <li><a href="./cart.php" class="breadcrumb__link">Shopping Cart</a></li>
        </ul>
    </section>
    <!-- BREAD END -->

    <!-- SHOPPING CART START -->
    <section class="shopping-cart">
        <div class="shopping-cart__container container">
            <h1 class="section__title">Shopping Cart</h1>

            <table class="table__cart">
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Shipping</th>
                        <th>Total</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    
                    <!-- <tr>
                        <td colspan="6">
                            <img src="../images_book/TheBornofAPLEX.jpg" class="cart__img">
                            <span class="product__name">The Born of APLEX</span>
                        </td>
                        <td>
                            <input type="number" name="cart quantity" min="0" value="1" class="cart__quantity">
                        </td>
                        <td class="cart__price">$26.000</td>
                        <td>Free shipping</td>
                        <td class="cart__total">$26.00</td>
                        <td>
                            <i class="bi bi-trash-fill cart__trash"></i>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <img src="../images_book/TheThronedMirror.jpg" class="cart__img">
                            <span class="product__name">The Throned Mirro</span>
                        </td>
                        <td>
                            <input type="number" name="cart quantity" min="0" value="1" class="cart__quantity">
                        </td>
                        <td class="cart__price">$23.000</td>
                        <td>Free shipping</td>
                        <td class="cart__total">$23.00</td>
                        <td>
                            <i class="bi bi-trash-fill cart__trash"></i>
                        </td>
                    </tr> -->
                   
                </tbody>
            </table>

            <div class="cart__bill">
                <div class="cart__totals">
                    <h3 class="cart__totals-title">Cart Totals</h3>
                    <div class="total__group">
                        <p>Product totals</p>
                        <span class="product__total">$0.00</span>
                    </div>
                    <div class="total__group">
                        <p>Shipping</p>
                        <span class="shipping">Free Shipping</span>
                    </div>
                    <div class="total__group">
                        <p>Total</p>
                        <span class="totals">$0.00</span>
                    </div>
                </div>
                <div class="bill__action">
                    <a href="./checkout.php" class="btn btn-lg">Proceed To Checkout</a>
                </div>
            </div>
        </div>
    </section>
    <!-- SHOPPING CART END -->


    <!-- OVERLAY START -->
    <div class="overlay">
        <div class="overlay__content">
            <div class="overlay__delete">
                <h1 class="overplay__title">Delete</h1>
                <p class="overplay__desc">
                    Are you sure you want to delete?
                </p>
                <div class="actions">
                    <button class="no__action">Close</button>
                    <button class="sure__action" data-shopping="0">Yes, Delete</button>
                </div>
            </div>
        </div>
    </div>
    <!-- OVERLAY END -->

    <!-- TOAST MESSAGE START -->
    <div id="toast">
    </div>
    <!-- TOAST MESSAGE END -->

    <!-- FOOTER START -->
    <footer class="footer">
        <div class="footer__container container">
            <div class="footer__social">
                <p class="social__title">Wellcome to HV-DK Books Store</p>
                <p>Get the breathing space now, and we'll extend your term at the other end year for go.</p>
                <div class="social__list">
                    <a href="#"><i class="bi bi-facebook"></i></a>
                    <a href="#"><i class="bi bi-instagram"></i></a>
                    <a href="#"><i class="bi bi-twitter"></i></a>
                    <a href="#"><i class="bi bi-youtube"></i></a>
                    <a href="#"><i class="bi bi-linkedin"></i></a>
                </div>
            </div>

            <div class="footer__contact">
                <p class="contact__title">Contact</p>
                <p>
                    Address: Cao Lanh city, Dong Thap province, VietNam
                    <br>
                    Email: email@gmail.com
                    <br>
                    Phone: 0123456789
                </p>
            </div>
        </div>
        <div class="footer__design">
            <p>Powered by HV-DK Store</p>
        </div>
    </footer>
    <!-- FOOTER END -->

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script type="module" src="./js/cart.js"></script>

</body>

</html>