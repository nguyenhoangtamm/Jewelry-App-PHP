<?php include './php/connect.php';
session_start();
if (!isset($_GET['book'])) {
    echo 'No product choice';
    exit();
}
$idBook = $_GET['book'];
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
            <li><span class="breadcrumb__link">></span></li>
            <li><span class="breadcrumb__link link__name">The Throned Mirror</span></li>
        </ul>
    </section>
    <!-- BREAD END -->

    <!-- DETAILS START -->
    <section class="details">
        <div class="details__container container">
            <?php
            $sql = "SELECT name_book, image_book, name_category, name_author, tags, price, description
                FROM `book` INNER JOIN `category` on book.id_category = category.id_category 
                INNER JOIN `author` ON book.id_author = author.id_author
                WHERE id_book = $idBook";
            if ($result = $conn->query($sql)) {
                while ($row = $result->fetch_array()) {
                    $tags = $row['tags'];
                    $desc = $row['description'];
            ?>
                    <div class="details__content">
                        <div class="details__image">
                            <img src="../images_book/<?php echo $row['image_book'] ?>" alt="" class="details__img">
                        </div>
                        <div class="details__group">
                            <div class="details__heading">
                                <h3 class="details__author"> <?php echo $row['name_author'] ?> </h3>
                                <span>-----</span>
                                <h3 class="details__category"> <?php echo $row['name_category'] ?> </h3>
                            </div>
                            <h2 class="details__name"> <?php echo $row['name_book'] ?> </h2>

                            <div class="detail__price">
                                <span class="price">$ <?php echo $row['price'] ?> </span>
                                <span class="plus">+</span>
                                <span class="ship">Free Shipping</span>
                            </div>

                            <p class="details__introduce">
                                <?php echo $row['description'] ?>
                            </p>

                            <div class="details__actions">
                                <input type="number" class="quantity" name="quantity" min="0" value="1">
                                <button class="btn btn-md" data-id="<?php echo $idBook ?>">Add to cart</button>
                                <a href="./books.php" class="btn btn-md">Buy More</a>
                            </div>

                            <div class="details__tags">
                                <p class="tags__category">Category: <span> <?php echo $row['name_category'] ?> </span></p>
                                <p class="tags">Tags: <span> <?php echo $row['tags'] ?> </span></p>
                            </div>
                        </div>
                    </div>

                    <div class="details__description">
                        <h3 class="desc__title">Description</h3>
                        <p class="desc__text"><?php echo $desc ?></p>
                    </div>
            <?php
                }
            }
            ?>
            <div class="details__related">
                <h1 class="relate__title">Relate Products</h1>
                <div class="book__list">
                    <?php
                    $arrTags = explode(', ', $tags);
                    $arrTagsLenght = count($arrTags);
                    $whereTags = "";
                    foreach ($arrTags as $index => $tag) {
                        if ($index > 0) {
                            $whereTags = $whereTags . "OR tags LIKE '%" . $tag . "%' ";
                        } else {
                            $whereTags = $whereTags . "tags LIKE '%" . $tag . "%' ";
                        }
                    }
                    $sql = "SELECT id_book, name_book, image_book, name_category, name_author, price 
                        FROM `book` INNER JOIN `category` on book.id_category = category.id_category 
                        INNER JOIN `author` ON book.id_author = author.id_author 
                        WHERE  ($whereTags) AND id_book != $idBook ORDER BY id_book DESC LIMIT 0, 4;";
                    if ($result = $conn->query($sql)) {
                        while ($row = $result->fetch_array()) {
                            echo '
                            <div class="book__item">
                                <a href="./details.php?book=' . $row['id_book'] . '">
                                    <img src="../images_book/' . $row['image_book'] . '" alt="book image" class="book__img">
                                </a>
                                <div class="book__heading">
                                    <span class="book__author">' . $row['name_author'] . '</span>
                                    <span class="book__category">' . $row['name_category'] . '</span>
                                </div>
                            
                                <span class="book__name">' . $row['name_book'] . '</span>
                                <span class="book__price">$' . $row['price'] . '</span>
                                <button class="book__add" aria-label="Add to cart" data-id="' . $row['id_book'] . '">
                                    <i class="bi bi-cart-plus"></i>
                                </button>
                            </div>';
                        }
                    }
                    ?>
                </div>
            </div>
        </div>
    </section>
    <!-- DETAILS END -->


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
    <script type="module" src="./js/details.js"></script>

</body>

</html>

<?php
$conn->close();
?>