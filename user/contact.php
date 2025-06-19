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
                    <li>
                        <a href="./books.php">Books</a>
                    </li>
                    <li>
                        <a href="./about.php">About Us</a>
                    </li>
                    <li class="active">
                        <a href="./contact.php">Contact</a>
                    </li>
                </ul>
            </div>

            <div class="header__right">
                <div class="header__cart">
                    <a href="./<?php echo isset($_SESSION['customer']) ? "cart.php" : "login-signup.php"; ?>">
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
            <li><a href="./contact.php" class="breadcrumb__link">Contact</a></li>
        </ul>
    </section>
    <!-- BREAD END -->

    <!-- CONTACT START -->
    <section class="contact">
        <div class="contact__container container">
            <div class="section__heading">
                <h1 class="section__title">Contact</h1>
                <p class="section__description">
                    Porttitor in nibh id aliquet quam aliquam aliquet pulvinar integer dolor quis elementum, dui cursus
                    nisi, nunc viverra nulla fringilla.
                </p>
            </div>

            <div class="contact__content">
                <div class="contact__mail">
                    <div class="mail__icon">
                        <i class="bi bi-envelope-fill"></i>
                    </div>
                    <div class="mail__content">
                        <p class="mail__title">MAIL US</p>
                        <p class="mail__text">mail@example.com</p>
                        <p class="mail__text">info@example.com</p>
                    </div>
                </div>
                <div class="contact__input">
                    <div class="input__heading">
                        <h2 class="input__title">Send A Message</h2>
                        <p class="input__description">
                            Ultrices dui maecenas quisque cras dui sed porttitor aliquam morbi
                            libero egestas lacus sed.
                        </p>
                    </div>
                    <form class="form__contact-input" action="./php/connect.php" method="post">
                        <input type="text" placeholder="Full name" name="Full name">
                        <input type="email" placeholder="Email address" name="Email address">
                        <input type="text" placeholder="Title message" name="Title message">
                        <textarea name="Yourmessage" placeholder="Your message" rows="10" required></textarea>
                        <button type="submit" name="submit_contact" class="btn btn-lg">Send Message</button>
                    </form>
                </div>
                <div class="contact__socials">
                    <a href="#"><i class="bi bi-facebook"></i></a>
                    <a href="#"><i class="bi bi-instagram"></i></a>
                    <a href="#"><i class="bi bi-twitter"></i></a>
                    <a href="#"><i class="bi bi-youtube"></i></a>
                    <a href="#"><i class="bi bi-linkedin"></i></a>
                </div>

            </div>
        </div>
    </section>
    <!-- CONTACT END -->

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
    <script type="module">
        import handleHeader from "./js/module-header.js";
        handleHeader();
    </script>
</body>

</html>