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
            <li><a href="./books.php" class="breadcrumb__link">Books</a></li>
        </ul>
    </section>
    <!-- BREAD END -->

    <!-- BOOK HEADING START -->
    <section class="shop-book__heading">
        <h1 class="section__title">BOOKS LISTING</h1>
        <p class="section__description">
            Vulputate vulputate eget cursus nam ultricies mauris, malesuada elementum
            lacus arcu, sit dolor ipsum, ac felis, egestas vel tortor eget aenean.
        </p>
    </section>
    <!-- BOOK HEADING END -->

    <!-- SHOP BOOKS START -->
    <section class="books">
        <div class="books__container container">
            <div class="books__filter">
                <div class="filter__box">
                    <h2 class="filter__title">Filter By Price</h2>
                    <div class="filter__progress">
                        <div class="progress__value"></div>
                    </div>
                    <div class="filter__range">
                        <input type="range" name="filter by price" class="silder__price-min" min="0" max="100" step="10" value="0">
                        <input type="range" name="filter by price" class="silder__price-max" min="0" max="100" step="10" value="50">
                    </div>
                    <div class="filter__price-box">
                        <div class="filter__price-value">
                            <span class="min__price">$0</span>
                            <span>to</span>
                            <span class="max__price">$50</span>
                        </div>
                        <button type="button" class="filter__btn">Filter</button>

                    </div>
                </div>
                <div class="filter__box">
                    <div class="filter__heading">
                        <h2 class="filter__title">Filter By Cartegory</h2>
                        <div class="category__btn-icon" data-target="#list-category">
                            <i class="bi bi-plus-lg"></i>
                        </div>
                        <div class="category__btn-icon active" data-target="#list-category">
                            <i class="bi bi-dash-lg"></i>
                        </div>
                    </div>
                    <ul class="filter__box-list show" id="list-category">
                        <li>
                            <label>
                                <input type="checkbox" name="checkCategory" value="1">
                                <span class="check__category"></span>
                                Fantasy
                            </label>
                        </li>
                        <li>
                            <label>
                                <input type="checkbox" name="checkCategory" value="2">
                                <span class="check__category"></span>
                                Science
                            </label>
                        </li>
                        <li>
                            <label>
                                <input type="checkbox" name="checkCategory" value="3">
                                <span class="check__category"></span>
                                Fiction
                            </label>
                        </li>
                        <li>
                            <label>
                                <input type="checkbox" name="checkCategory" value="4">
                                <span class="check__category"></span>
                                Biography
                            </label>
                        </li>
                        <li>
                            <label>
                                <input type="checkbox" name="checkCategory" value="5">
                                <span class="check__category"></span>
                                Romance
                            </label>
                        </li>
                        <li>
                            <label>
                                <input type="checkbox" name="checkCategory" value="6">
                                <span class="check__category"></span>
                                Horror
                            </label>
                        </li>
                        <li>
                            <label>
                                <input type="checkbox" name="checkCategory" value="7">
                                <span class="check__category"></span>
                                Business
                            </label>
                        </li>

                    </ul>
                </div>
                <div class="filter__box">
                    <div class="filter__heading">
                        <h2 class="filter__title">Filter By Author</h2>
                        <div class="author__btn-icon" data-target="#list-author">
                            <i class="bi bi-plus-lg"></i>
                        </div>
                        <div class="author__btn-icon active" data-target="#list-author">
                            <i class="bi bi-dash-lg"></i>
                        </div>
                    </div>
                    <ul class="filter__box-list show" id="list-author">
                        <li>
                            <label>
                                <input type="checkbox" name="checkAuthor" value="1">
                                <span class="check__author"></span>
                                Tolkien
                            </label>
                        </li>
                        <li>
                            <label>
                                <input type="checkbox" name="checkAuthor" value="2">
                                <span class="check__author"></span>
                                Leigh Bardugo
                            </label>
                        </li>
                        <li>
                            <label>
                                <input type="checkbox" name="checkAuthor" value="3">
                                <span class="check__author"></span>
                                Jennifer Bosworth
                            </label>
                        </li>
                        <li>
                            <label>
                                <input type="checkbox" name="checkAuthor" value="4">
                                <span class="check__author"></span>
                                Sharlene Teo
                            </label>
                        </li>
                        <li>
                            <label>
                                <input type="checkbox" name="checkAuthor" value="5">
                                <span class="check__author"></span>
                                Francisco X Stork
                            </label>
                        </li>
                        <li>
                            <label>
                                <input type="checkbox" name="checkAuthor" value="6">
                                <span class="check__author"></span>
                                Susan Mallery
                            </label>
                        </li>
                        <li>
                            <label>
                                <input type="checkbox" name="checkAuthor" value="7">
                                <span class="check__author"></span>
                                Rebecca Yarros
                            </label>
                        </li>
                        <li>
                            <label>
                                <input type="checkbox" name="checkAuthor" value="8">
                                <span class="check__author"></span>
                                Muhammad Yunus
                            </label>
                        </li>
                        <li>
                            <label>
                                <input type="checkbox" name="checkAuthor" value="9">
                                <span class="check__author"></span>
                                John Feinstein
                            </label>
                        </li>
                        <li>
                            <label>
                                <input type="checkbox" name="checkAuthor" value="10">
                                <span class="check__author"></span>
                                Stephen King
                            </label>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="books__shop">
                <div class="filter__sort">
                    <div class="select__box">
                        <span class="select__sort" data-sort="ASC">Default Sort</span>
                        <div class="icon__down">
                            <i class="bi bi-caret-down-fill"></i>
                        </div>
                    </div>
                    <ul class="option__select">
                        <li class="option__item" data-sort="ASC">Default Sort</li>
                        <li class="option__item" data-sort="DESC">Price High To Low</li>
                    </ul>
                </div>

                <div class="book__list">
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
                </div>
                <div class="pagination">
                    <a href="./books.php" class="pagination__item prev disapled">Previous</a>
                    <a href="./books.php" class="pagination__item active">1</a>
                    <a href="./books.php" class="pagination__item ">2</a>
                    <a href="./books.php" class="pagination__item ">3</a>
                    <a href="./books.php" class="pagination__item ">4</a>
                    <a href="./books.php" class="pagination__item next ">Next</a>
                </div>
            </div>
        </div>
    </section>
    <!-- SHOP BOOKS END -->


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
    <script type="module" src="./js/books.js"></script>
</body>

</html>