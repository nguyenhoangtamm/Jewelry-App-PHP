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

    <!-- BREAD START -->
    <section class="breadcrumb">
        <ul class="breadcrumb__list container">
            <li><a href="./index.php" class="breadcrumb__link">Home</a></li>
            <li><span class="breadcrumb__link">></span></li>
            <li><a href="./books.php" class="breadcrumb__link">Books</a></li>
            <li><span class="breadcrumb__link">></span></li>
            <li><a href="./checkout.php" class="breadcrumb__link">Checkout</a></li>
        </ul>
    </section>
    <!-- BREAD END -->

    <!-- SCROLL PAGE START -->
    <div class="scroll__page">
        <a href="#header">
            <i class="bi bi-chevron-up"></i>
        </a>
    </div>
    <!--  SCROLL PAGE START -->

    <!-- BREAD START -->
    <section class="checkout">
        <div class="checkout__container container">
            <div class="checkout__product">
                <h2 class="checkout__title">Your Order</h2>
                <div class="checkout__list">
                    <div class="checkout__item">
                        <span class="item__name">The Born of APLEX</span>
                        <span class="item__count">x1</span>
                        <span class="item__total">$26.00</span>
                    </div>
                    <div class="checkout__item">
                        <span class="item__name">The Throned Mirro</span>
                        <span class="item__count">x1</span>
                        <span class="item__total">$23.00</span>
                    </div>
                </div>
                <div class="checkout__shipping">
                    <h2 class="checkout__title">Shipping</h2>
                    <span class="shipping">Free Shipping</span>
                </div>
                <div class="checkout__payment">
                    <h2 class="checkout__title">Amount Payment</h2>
                    <div class="amount__payment">$79.000</div>
                </div>
            </div>
            <div class="checkout__action">
                <form class="form__notes" autocomplete="on">
                    <h1 class="checkout__title">Additional information</h1>
                    <p class="notes__desc">Order notes (optional)</p>
                    <textarea rows="3" name="Notes message" class="notes__message" 
                        placeholder="Notes about your order, e.g. special notes for delivery."></textarea>
                </form>

                <div class="payment__methods">
                    <h2 class="checkout__title">Payment Methods</h2>
                    <label class="active">
                        <input type="radio" name="payment" checked>
                        Cash On Delivery
                        <div class="payment__image">
                            <img src="../images_web/payment_0.png" alt="">
                        </div>
                    </label>
                    <label>
                        <input type="radio" name="payment" disabled>
                        MoMo App
                        <div class="payment__image">
                            <img src="../images_web/payment_1.png" alt="">
                        </div>
                    </label>
                    <label>
                        <input type="radio" name="payment" disabled>
                        Direct transfer
                        <div class="payment__image">
                            <img src="../images_web/payment_2.jpg" alt="">
                        </div>
                    </label>
                </div>
                <button class="btn btn-lg btn__order">Place Order</button>
            </div>
        </div>
    </section>
    <!-- BREAD END -->

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
    <script type="module" src="./js/checkout.js"></script>
</body>

</html>