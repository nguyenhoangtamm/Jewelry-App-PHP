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
            <li><a href="./myaccount.php" class="breadcrumb__link">My Account</a></li>
        </ul>
    </section>
    <!-- BREAD END -->

    <!-- ACCOUNT START -->
    <section class="account">
        <div class="account__container container">
            <div class="account__siderbar">
                <span class="sidebar__item" data-target="#my-account">
                    <i class="bi bi-person-badge"></i>
                    My Account
                </span>
                <span class="sidebar__item" data-target="#update-info">
                    <i class="bi bi-arrow-repeat"></i>
                    Update Info
                </span>
                <span class="sidebar__item" data-target="#order">
                    <i class="bi bi-cart"></i>
                    Order
                </span>
                <span class="sidebar__item" data-target="#change-password">
                    <i class="bi bi-key"></i>
                    Change Password
                </span>
            </div>
            <div class="account__main">
                <div class="account__content active" id="my-account">
                    <div class="account__info">
                        <div class="account__group">
                            <span>Name: </span>
                            <span class="account__name"></span>
                        </div>
                        <div class="account__group">
                            <span>Date of birth: </span>
                            <span class="account__birth"></span>
                        </div>
                        <div class="account__group">
                            <span>Address: </span>
                            <span class="account__address"></span>
                        </div>
                        <div class="account__group">
                            <span>Email: </span>
                            <span class="account__email"></span>
                        </div>
                        <div class="account__group">
                            <span>Phone: </span>
                            <span class="account__phone"></span>
                        </div>
                    </div>
                    <div class="account__avatar">
                        <img src="../images_web/avatar.png" alt="">
                    </div>
                </div>
                <div class="account__content" id="update-info">
                    <form class="form__update" autocomplete="on">
                        <div class="form__group">
                            <h3 class="form__title">Full Name <span>*</span></h3>
                            <input type="text" name="fullName" placeholder="Enter your full name" required>
                            <span class="error__update-msg"></span>
                        </div>
                        <div class="form__group">
                            <h3 class="form__title">Date Of Birth <span>*</span></h3>
                            <input type="date" name="birthDate" required>
                            <span class="error__update-msg"></span>
                        </div>
                        <div class="form__group">
                            <h3 class="form__title">Address <span>*</span></h3>
                            <input type="text" name="address" placeholder="House number, Town, Province" required>
                            <span class="error__update-msg"></span>
                        </div>
                        <div class="form__group">
                            <h3 class="form__title">Email <span>*</span></h3>
                            <input type="email" name="email" placeholder="Enter your email" required>
                            <span class="error__update-msg"></span>
                        </div>
                        <div class="form__group">
                            <h3 class="form__title">Phone <span>*</span></h3>
                            <input type="text" name="phone" placeholder="Enter your phone number" required>
                            <span class="error__update-msg"></span>
                        </div>
                        <button type="submit" class="btn btn-lg">Save Changes</button>
                    </form>
                </div>
                <div class="account__content" id="order">
                    <table class="table__order">
                        <thead>
                            <tr>
                                <th>Order #</th>
                                <th>Order Date</th>
                                <th>Bill-to Name</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            
                        <!-- 
                            <tr>
                                <td>123456</td>
                                <td>12/5/2023</td>
                                <td>$26.00</td>
                                <td class="new">
                                    New
                                </td>
                                <td>
                                    <i class="bi bi-eye-fill order__view"></i>
                                    <i class="bi bi-trash-fill order__trash"></i>
                                </td>
                            </tr>
                            <tr>
                                <td>123456</td>
                                <td>12/5/2023</td>
                                <td>$26.00</td>
                                <td class="delivering">
                                    Delivering
                                </td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>123456</td>
                                <td>12/5/2023</td>
                                <td>$26.00</td>
                                <td class="cancelled">
                                    Cancelled
                                </td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>123456</td>
                                <td>12/5/2023</td>
                                <td>$26.00</td>
                                <td class="completed">
                                    Completed
                                </td>
                                <td></td>
                            </tr> -->

                        </tbody>
                    </table>
                </div>
                <div class="account__content" id="change-password">
                    <form class="form__change-pass">
                        <div class="form__group">
                            <h3 class="form__title">Current Password <span>*</span></h3>
                            <input type="password" name="currentPass" placeholder="Enter current password" required>
                            <span class="error__pass-msg"></span>
                        </div>
                        <div class="form__group">
                            <h3 class="form__title">New Password <span>*</span></h3>
                            <input type="password" name="newPass" placeholder="Enter new password" required>
                            <span class="error__pass-msg"></span>
                        </div>
                        <div class="form__group">
                            <h3 class="form__title">Confirm New Password <span>*</span></h3>
                            <input type="password" name="confirmNewPass" placeholder="Confirm new password" required>
                            <span class="error__pass-msg"></span>
                        </div>
                        <button type="submit" class="btn btn-lg">Save Change</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <!-- ACCOUNT END -->

    <!-- OVERLAY DELETE ORDER START -->
    <div class="overlay delete-order">
        <div class="overlay__content">
            <div class="overlay__delete">
                <h1 class="overplay__title">Delete</h1>
                <p class="overplay__desc">
                    Are you sure you want to delete?
                </p>
                <div class="actions">
                    <button class="no__action">Close</button>
                    <button class="sure__action" data-order="0">Yes, Delete</button>
                </div>
            </div>
        </div>
    </div>
    <!-- OVERLAY DELETE ORDER END -->

    <!-- OVERLAY DELETE ORDER START -->
    <div class="overlay view-order">
        <div class="overlay__content">
            <div class="bill__header">
                <h1 class="overplay__title">Books Store Bill</h1>
                <p>+0123456789</p>
                <p>Cao Lanh city, Dong Thap province, VietNam</p>
            </div>
            <div class="bill__info">
                <p class="bill__date">Order Date : 02/12/1000</p>
                <div class="bill__customer">
                    <div class="wrapper-left">
                        <p>Sold to:</p>
                        <p class="customer-name">Nguyen Huu Vinh</p>
                    </div>
                    <div class="wrapper-right">
                        <p class="customer-phone">1234567</p>
                        <p class="customer-address">lapvodong thap</p>
                        <p class="customer-mail">1321@gmail.com</p>
                    </div>
                </div>
            </div>
            <div class="bill__main">
                <table class="table__product">
                    <thead>
                        <tr>
                            <th>Product</th>
                            <th>Quantity</th>
                            <th>Price</th>
                            <th>Amount</th>
                        </tr>
                    </thead>
                    <tbody>
<!-- 
                        <tr>
                            <td>hahdhsahdhasd</td>
                            <td>2</td>
                            <td>$30.00</td>
                            <td>$79</td>
                        </tr>
                        <tr>
                            <td>hahdhsahdhasd</td>
                            <td>2</td>
                            <td>$30.00</td>
                            <td>$79</td>
                        </tr>
                        <tr>
                            <td>hahdhsahdhasd</td>
                            <td>2</td>
                            <td>$30.00</td>
                            <td>$79</td>
                        </tr>
                         -->
                    </tbody>
                </table>
            </div>
            <div class="bill__total">
                <p class="shipping">
                    Shipping: Free Shipping
                </p>
                <p class="total__main">
                    Total: <span class="total__amount">$104.00</span>
                </p>
            </div>
            <div class="bill__notes">
                <p>
                    Order notes:
                    <span class="order-notes">Hello</span>
                </p>
            </div>
            <div class="bill__footer">
                <h2>Books Store thank you!!</h2>
            </div>
            <button class="close-view">Close</button>
        </div>
    </div>
    <!-- OVERLAY DELETE ORDER END -->

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
    <script type="module" src="./js/account.js"></script>

</body>

</html>