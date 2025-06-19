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
                    <li class="active">
                        <a href="./about.php">About Us</a>
                    </li>
                    <li>
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
            <li><a href="./about.php" class="breadcrumb__link">About Us</a></li>
        </ul>
    </section>
    <!-- BREAD END -->

    <!-- ABOUT START -->
    <section class="about">
        <div class="about__container container">
            <div class="about__heading">
                <img src="../images_web/about.png" alt="">
                <div class="heading__content ">
                    <h1 class="heading__text">About Us</h1>
                    <p class="heading__description">
                        Porttitor in nibh id aliquet quam aliquam aliquet pulvinar integer dolor quis elementum, dui cursus
                        nisi, nunc viverra nulla fringilla.
                    </p>
                </div>
            </div>
            <div class="about__main">
                <div class="about__work">
                    <h2 class="about__title">Well-coordinated Teamwork</h2>
                    <div class="about__description">
                        We are thrilled to offer you a wide range of products that you won't find anywhere else. Where
                        you can immerse yourself in many interesting stories of many different book genres, we have a
                        variety of books just for you
                    </div>
                    <div class="about__description">
                        Our commitment to quality is reflected in every product we offer. We work with top suppliers and
                        manufacturers to ensure that every item we sell meets our high standards for durability,
                        performance, and style. And with a user-friendly interface and intuitive navigation, shopping on
                        our site is a breeze. We understand that security is a top concern for online shoppers, which is
                        why we employ the latest encryption technologies and follow industry best practices to keep your
                        personal information safe. And with fast, reliable shipping options, you can enjoy your
                        purchases in no time.
                    </div>
                </div>
                <div class="about__counter">
                    <div class="counter__wrapper">
                        <div class="counter__icon">
                            <i class="bi bi-hand-thumbs-up-fill"></i>
                        </div>
                        <div class="counter__content">
                            <h2 class="counter__amount">750+</h2>
                            <p class="counter__name">Happy Customers</p>
                        </div>
                    </div>
                    <div class="counter__wrapper">
                        <div class="counter__icon">
                            <i class="bi bi-calendar2-month-fill"></i>
                        </div>
                        <div class="counter__content">
                            <h2 class="counter__amount">2023</h2>
                            <p class="counter__name">Founding Year</p>
                        </div>
                    </div>
                    <div class="counter__wrapper">
                        <div class="counter__icon">
                            <i class="bi bi-card-checklist"></i>
                        </div>
                        <div class="counter__content">
                            <h2 class="counter__amount">120+</h2>
                            <p class="counter__name">Product Orders</p>
                        </div>
                    </div>
                    <div class="counter__wrapper">
                        <div class="counter__icon">
                            <i class="bi bi-patch-check-fill"></i>
                        </div>
                        <div class="counter__content">
                            <h2 class="counter__amount">60+</h2>
                            <p class="counter__name">Quality Products</p>
                        </div>
                    </div>
                </div>

                <div class="about__member">
                    <div class="member__image">
                        <img src="../images_web/about1.png" alt="">
                    </div>
                    <div class="about__description">
                        At our website, we are passionate about providing our customers with the best possible
                        shopping experience. From our extensive product selection to our exceptional customer service,
                        we are committed to exceeding your expectations.
                        So start browsing today and find the perfect products to suit your needs!
                    </div>
                    <div class="member__image">
                        <img src="../images_web/about2.png" alt="">
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ABOUT END -->

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