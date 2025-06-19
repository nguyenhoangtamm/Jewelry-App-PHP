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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css" />
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
                    <li class="active">
                        <a href="./index.php">Home</a>
                    </li>
                    <li>
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
                    <a href="./<?php echo isset($_SESSION['customer']) ? "cart.php" : "login-signup.php"; ?>">
                        <i class="bi bi-cart3"></i>
                    </a>
                    <span class="cart-count">0</span>
                </div>
                <div class="header__actions">
                    <a href="./login-signup.php" class="btn btn-sm header__login <?php echo isset($_SESSION['customer']) ? "" : "show"; ?>">
                        Login
                    </a>
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


    <!-- INTRODUCE BOOK START -->
    <section class="introduce-book">
        <div class="introduce-book__container container">
            <div class="introduce-book__description">
                <div class="introduce-book__intro">
                    <p class="introduce-book__title">NEW BOOK</p>
                    <p class="introduce-book__name"> <!-- The Sons of The Empire --></p>
                    <p class="introduce-book__desc">
                        <!-- Justo habitant at augue ac sed proin consectetur ac urna nisl elit
                        nulla facilisis viverra dolor sagittis nisi risus egestas adipiscing
                        nibh euismod. -->
                    </p>
                </div>
                <div class="introduce-book__action">
                    <a href="./details.php" class="btn btn-lg">Buy Now</a>
                    <a href="./books.php" class="btn btn-lg">Read More</a>
                </div>
            </div>

            <div class="introduce-book__image">
                <!-- <img src="../images_book/TheSonOfTheEmpire.jpg" alt="img" class="introduce-book__img"> -->
                <img src="" alt="img" class="introduce-book__img">
            </div>
        </div>
    </section>
    <!-- INTRODUCE BOOK END -->

    <!-- NEWBOOK START -->
    <section class="new-books ">
        <div class="new-books__container container">
            <div class="section__heading">
                <h1 class="section__title">NEW BOOKS</h1>
                <p class="section__description">
                    Vulputate vulputate eget cursus nam ultricies mauris, malesuada elementum
                    lacus arcu, sit dolor ipsum, ac felis, egestas vel tortor eget aenean.
                </p>
            </div>

            <div class="new-books__main">
                <div class="new-books__list mySwiper">
                    <div class="new-books__wrapper swiper-wrapper">
                        <!-- 
                        <div class="book__item swiper-slide">
                            <a href="./details.php?book=26">
                                <img src="../images_book/GirlInTheWalls.jpg" alt="book image" class="book__img">
                            </a>
                            <div class="book__heading">
                                <span class="book__author">Tolkien</span>
                                <span class="book__category">Romance</span>
                            </div>
                            <span class="book__name">Girl In The Walls</span>
                            <span class="book__price">$25</span>
                            <button class="book__add" aria-label="Add to cart">
                                <i class="bi bi-cart-plus"></i>
                            </button>
                        </div>
                        <div class="book__item swiper-slide">
                            <a href="./details.php?book=25">
                                <img src="../images_book/Crossfire2ReflectedInYou.jpg" alt="book image" class="book__img">
                            </a>
                            <div class="book__heading">
                                <span class="book__author">Muhammad Yunus</span>
                                <span class="book__category">Romance</span>
                            </div>
                            <span class="book__name">Crossfire 2: Reflected In You</span>
                            <span class="book__price">$20</span>
                            <button class="book__add" aria-label="Add to cart">
                                <i class="bi bi-cart-plus"></i>
                            </button>
                        </div>
                        <div class="book__item swiper-slide">
                            <a href="./details.php?book=24">
                                <img src="../images_book/TheGiver.jpg" alt="book image" class="book__img">
                            </a>
                            <div class="book__heading">
                                <span class="book__author">Francisco X Stork</span>
                                <span class="book__category">Science</span>
                            </div>
                            <span class="book__name">The Giver</span>
                            <span class="book__price">$23</span>
                            <button class="book__add" aria-label="Add to cart">
                                <i class="bi bi-cart-plus"></i>
                            </button>
                        </div>
                        <div class="book__item swiper-slide">
                            <a href="./details.php?book=23">
                                <img src="../images_book/MinecraftTheShipwreck.jpg" alt="book image" class="book__img">
                            </a>
                            <div class="book__heading">
                                <span class="book__author">Sharlene Teo</span>
                                <span class="book__category">Science</span>
                            </div>
                            <span class="book__name">Minecraft: The Shipwreck</span>
                            <span class="book__price">$22</span>
                            <button class="book__add" aria-label="Add to cart">
                                <i class="bi bi-cart-plus"></i>
                            </button>
                        </div>
                        <div class="book__item swiper-slide">
                            <a href="./details.php?book=22">
                                <img src="../images_book/TheHouseonVesperSands.jpg" alt="book image" class="book__img">
                            </a>
                            <div class="book__heading">
                                <span class="book__author">Leigh Bardugo</span>
                                <span class="book__category">Horror</span>
                            </div>
                            <span class="book__name">The House on Vesper Sands</span>
                            <span class="book__price">$22</span>
                            <button class="book__add" aria-label="Add to cart">
                                <i class="bi bi-cart-plus"></i>
                            </button>
                        </div>
                        <div class="book__item swiper-slide">
                            <a href="./details.php?book=21">
                                <img src="../images_book/TheGraveyardBook.jpg" alt="book image" class="book__img">
                            </a>
                            <div class="book__heading">
                                <span class="book__author">Susan Mallery</span>
                                <span class="book__category">Horror</span>
                            </div>
                            <span class="book__name">The Graveyard Book</span>
                            <span class="book__price">$18</span>
                            <button class="book__add" aria-label="Add to cart">
                                <i class="bi bi-cart-plus"></i>
                            </button>
                        </div>
                        <div class="book__item swiper-slide">
                            <a href="./details.php?book=20">
                                <img src="../images_book/IT.jpg" alt="book image" class="book__img">
                            </a>
                            <div class="book__heading">
                                <span class="book__author">Stephen King</span>
                                <span class="book__category">Horror</span>
                            </div>
                            <span class="book__name">IT</span>
                            <span class="book__price">$35</span>
                            <button class="book__add" aria-label="Add to cart">
                                <i class="bi bi-cart-plus"></i>
                            </button>
                        </div>
                        <div class="book__item swiper-slide">
                            <a href="./details.php?book=19">
                                <img src="../images_book/TheFirstMajor.jpg" alt="book image" class="book__img">
                            </a>
                            <div class="book__heading">
                                <span class="book__author">John Feinstein</span>
                                <span class="book__category">Biography</span>
                            </div>
                            <span class="book__name">The First Major</span>
                            <span class="book__price">$23</span>
                            <button class="book__add" aria-label="Add to cart">
                                <i class="bi bi-cart-plus"></i>
                            </button>
                        </div>
                        <div class="book__item swiper-slide">
                            <a href="./details.php?book=18">
                                <img src="../images_book/BankerToThePoor.jpg" alt="book image" class="book__img">
                            </a>
                            <div class="book__heading">
                                <span class="book__author">Muhammad Yunus</span>
                                <span class="book__category">Biography</span>
                            </div>
                            <span class="book__name">Banker To The Poor</span>
                            <span class="book__price">$25</span>
                            <button class="book__add" aria-label="Add to cart">
                                <i class="bi bi-cart-plus"></i>
                            </button>
                        </div>
                        <div class="book__item swiper-slide">
                            <a href="./details.php?book=17">
                                <img src="../images_book/EinsteinHisLifeandUniverse.jpg" alt="book image" class="book__img">
                            </a>
                            <div class="book__heading">
                                <span class="book__author">Muhammad Yunus</span>
                                <span class="book__category">Biography</span>
                            </div>
                            <span class="book__name">Einstein: His Life and Universe</span>
                            <span class="book__price">$24</span>
                            <button class="book__add" aria-label="Add to cart">
                                <i class="bi bi-cart-plus"></i>
                            </button>
                        </div> 
                    -->

                    </div>
                    <div class="swiper-button-next"></div>
                    <div class="swiper-button-prev"></div>
                </div>
            </div>
        </div>
    </section>
    <!-- NEWBOOK END -->

    <div class="break"></div>

    <!-- NEWBOOK START -->
    <section class="trend-book">
        <div class="trend-book__container container ">
            <div class="section__heading">
                <h1 class="section__title ">Trend book</h1>
                <p class="section__description">
                    Vulputate vulputate eget cursus nam ultricies mauris, malesuada elementum
                    lacus arcu, sit dolor ipsum, ac felis, egestas vel tortor eget aenean.
                </p>
            </div>
            <div class="book__list">
                <!--                 
                <div class="book__item">
                    <a href="./details.php?book=26">
                        <img src="../images_book/GirlInTheWalls.jpg" alt="book image" class="book__img">
                    </a>
                    <div class="book__heading">
                        <span class="book__author">Tolkien</span>
                        <span class="book__category">Romance</span>
                    </div>
                    <span class="book__name">Girl In The Walls</span>
                    <span class="book__price">$25</span>
                    <button class="book__add" aria-label="Add to cart">
                        <i class="bi bi-cart-plus"></i>
                    </button>
                </div>
                <div class="book__item">
                    <a href="./details.php?book=25">
                        <img src="../images_book/Crossfire2ReflectedInYou.jpg" alt="book image" class="book__img">
                    </a>
                    <div class="book__heading">
                        <span class="book__author">Muhammad Yunus</span>
                        <span class="book__category">Romance</span>
                    </div>
                    <span class="book__name">Crossfire 2: Reflected In You</span>
                    <span class="book__price">$20</span>
                    <button class="book__add" aria-label="Add to cart">
                        <i class="bi bi-cart-plus"></i>
                    </button>
                </div>
                <div class="book__item">
                    <a href="./details.php?book=24">
                        <img src="../images_book/TheGiver.jpg" alt="book image" class="book__img">
                    </a>
                    <div class="book__heading">
                        <span class="book__author">Francisco X Stork</span>
                        <span class="book__category">Science</span>
                    </div>
                    <span class="book__name">The Giver</span>
                    <span class="book__price">$23</span>
                    <button class="book__add" aria-label="Add to cart">
                        <i class="bi bi-cart-plus"></i>
                    </button>
                </div>
                <div class="book__item">
                    <a href="./details.php?book=23">
                        <img src="../images_book/MinecraftTheShipwreck.jpg" alt="book image" class="book__img">
                    </a>
                    <div class="book__heading">
                        <span class="book__author">Sharlene Teo</span>
                        <span class="book__category">Science</span>
                    </div>
                    <span class="book__name">Minecraft: The Shipwreck</span>
                    <span class="book__price">$22</span>
                    <button class="book__add" aria-label="Add to cart">
                        <i class="bi bi-cart-plus"></i>
                    </button>
                </div>
                <div class="book__item">
                    <a href="./details.php?book=22">
                        <img src="../images_book/TheHouseonVesperSands.jpg" alt="book image" class="book__img">
                    </a>
                    <div class="book__heading">
                        <span class="book__author">Leigh Bardugo</span>
                        <span class="book__category">Horror</span>
                    </div>
                    <span class="book__name">The House on Vesper Sands</span>
                    <span class="book__price">$22</span>
                    <button class="book__add" aria-label="Add to cart">
                        <i class="bi bi-cart-plus"></i>
                    </button>
                </div> 
            -->
            </div>
        </div>
    </section>
    <!-- NEWBOOK END -->


    <!-- SELLING START -->
    <section class="selling">
        <div class="selling__container container">
            <div class="section__heading">
                <h1 class="section__title">Best Selling Books</h1>
                <p class="section__description">
                    Vulputate vulputate eget cursus nam ultricies mauris, malesuada elementum
                    lacus arcu, sit dolor ipsum, ac felis, egestas vel tortor eget aenean.
                </p>
            </div>
            <div class="content__selling">
                <div class="book__list">
                    <!-- 
                    <div class="book__item">
                        <a href="./details.php?book= 1">
                            <img src="../images_book/TheThronedMirror.jpg" alt="book image" class="book__img">
                        </a>
                        <div class="book__heading">
                            <span class="book__author">Tolkien</span>
                            <span class="book__category">Fantasy</span>
                        </div>

                        <span class="book__name">The Throned Mirror</span>
                        <span class="book__price">$23</span>
                        <button class="book__add" aria-label="Add to cart">
                            <i class="bi bi-cart-plus"></i>
                        </button>
                    </div>
                    <div class="book__item">
                        <a href="./details.php?book= 6">
                            <img src="../images_book/CyberAngle.jpg" alt="book image" class="book__img">
                        </a>
                        <div class="book__heading">
                            <span class="book__author">Tolkien</span>
                            <span class="book__category">Romance</span>
                        </div>

                        <span class="book__name">Cyber Angle</span>
                        <span class="book__price">$20</span>
                        <button class="book__add" aria-label="Add to cart">
                            <i class="bi bi-cart-plus"></i>
                        </button>
                    </div>
                    <div class="book__item">
                        <a href="./details.php?book= 9">
                            <img src="../images_book/TheSilmarillion.jpg" alt="book image" class="book__img">
                        </a>
                        <div class="book__heading">
                            <span class="book__author">Tolkien</span>
                            <span class="book__category">Fantasy</span>
                        </div>

                        <span class="book__name">The Silmarillion</span>
                        <span class="book__price">$15</span>
                        <button class="book__add" aria-label="Add to cart">
                            <i class="bi bi-cart-plus"></i>
                        </button>
                    </div>
                    <div class="book__item">
                        <a href="./details.php?book= 11">
                            <img src="../images_book/TheHobbit.jpg" alt="book image" class="book__img">
                        </a>
                        <div class="book__heading">
                            <span class="book__author">Tolkien</span>
                            <span class="book__category">Fiction</span>
                        </div>

                        <span class="book__name">The Hobbit</span>
                        <span class="book__price">$16</span>
                        <button class="book__add" aria-label="Add to cart">
                            <i class="bi bi-cart-plus"></i>
                        </button>
                    </div>
                    <div class="book__item">
                        <a href="./details.php?book= 26">
                            <img src="../images_book/GirlInTheWalls.jpg" alt="book image" class="book__img">
                        </a>
                        <div class="book__heading">
                            <span class="book__author">Tolkien</span>
                            <span class="book__category">Romance</span>
                        </div>

                        <span class="book__name">Girl In The Walls</span>
                        <span class="book__price">$25</span>
                        <button class="book__add" aria-label="Add to cart">
                            <i class="bi bi-cart-plus"></i>
                        </button>
                    </div>
                    <div class="book__item">
                        <a href="./details.php?book= 5">
                            <img src="../images_book/2024Sanctuary.jpg" alt="book image" class="book__img">
                        </a>
                        <div class="book__heading">
                            <span class="book__author">Leigh Bardugo</span>
                            <span class="book__category">Fantasy</span>
                        </div>

                        <span class="book__name">2024: Sanctuary</span>
                        <span class="book__price">$24</span>
                        <button class="book__add" aria-label="Add to cart">
                            <i class="bi bi-cart-plus"></i>
                        </button>
                    </div>
                    <div class="book__item">
                        <a href="./details.php?book= 10">
                            <img src="../images_book/SixOfCrowsBook.jpg" alt="book image" class="book__img">
                        </a>
                        <div class="book__heading">
                            <span class="book__author">Leigh Bardugo</span>
                            <span class="book__category">Fantasy</span>
                        </div>

                        <span class="book__name">Six Of Crows Book</span>
                        <span class="book__price">$18</span>
                        <button class="book__add" aria-label="Add to cart">
                            <i class="bi bi-cart-plus"></i>
                        </button>
                    </div>
                    <div class="book__item">
                        <a href="./details.php?book= 22">
                            <img src="../images_book/TheHouseonVesperSands.jpg" alt="book image" class="book__img">
                        </a>
                        <div class="book__heading">
                            <span class="book__author">Leigh Bardugo</span>
                            <span class="book__category">Horror</span>
                        </div>

                        <span class="book__name">The House on Vesper Sands</span>
                        <span class="book__price">$22</span>
                        <button class="book__add" aria-label="Add to cart">
                            <i class="bi bi-cart-plus"></i>
                        </button>
                    </div>
                    <div class="book__item">
                        <a href="./details.php?book= 8">
                            <img src="../images_book/TheReturnofTheKing.jpg" alt="book image" class="book__img">
                        </a>
                        <div class="book__heading">
                            <span class="book__author">Jennifer Bosworth</span>
                            <span class="book__category">Biography</span>
                        </div>

                        <span class="book__name">The Return of The King</span>
                        <span class="book__price">$28</span>
                        <button class="book__add" aria-label="Add to cart">
                            <i class="bi bi-cart-plus"></i>
                        </button>
                    </div>
                    <div class="book__item">
                        <a href="./details.php?book= 12">
                            <img src="../images_book/TheKillingJar.jpg" alt="book image" class="book__img">
                        </a>
                        <div class="book__heading">
                            <span class="book__author">Jennifer Bosworth</span>
                            <span class="book__category">Horror</span>
                        </div>

                        <span class="book__name">The Killing Jar</span>
                        <span class="book__price">$25</span>
                        <button class="book__add" aria-label="Add to cart">
                            <i class="bi bi-cart-plus"></i>
                        </button>
                    </div> 
                -->

                </div>
                <div class="selling__action">
                    <a href="./books.php" class="btn btn-lg"> Read More </a>
                </div>
            </div>
        </div>
    </section>
    <!-- SELLING END -->

    <!-- SUBSCRIBE START -->
    <section class="subscribe">
        <div class="subscribe__container container">
            <div class="section__heading">
                <h1 class="section__title">Be the first to know</h1>
                <p class="section__description">
                    Lectus amet scelerisque fusce est venenatis, eget enim dolor amet vitae pharetra
                </p>
            </div>

            <div class="subscribe__input">
                <input type="Email" placeholder="Your email please" name="email sub" disabled>
                <a href="#" class="btn btn-lg">Subscribe</a>
            </div>
        </div>
    </section>
    <!-- SUBSCRIBE END -->

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
    <script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script type="module" src="./js/index.js"></script>

</body>

</html>