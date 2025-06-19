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
    <!-- FORGOT PASSWORD START -->
    <section class="forgot-pass">
        <div class="forgot-pass__container container">
            <div class="forgot-pass__heading">
                <div class="logo">
                    <a href="./index.php">
                        <img src="../images_web/logo.png" alt="logo">
                    </a>
                </div>
                <h1 class="forgot-pass__title">Password Recovery</h1>
            </div>

            <div class="forgot-pass__step">
                <div class="step__group verify-account active" data-target="#form__info-user">
                    <span class="step__count ">1</span>
                    <div class="step__desc">Verify Account</div>
                </div>
                <div class="step__group verify-code" data-target="#form__verify-code">
                    <span class="step__count">2</span>
                    <div class="step__desc">Verify Code</div>
                </div>
                <div class="step__group new-pass" data-target="#form__new-pass">
                    <span class="step__count">3</span>
                    <div class="step__desc">Create New Password</div>
                </div>

                <div class="step__progress">
                    <span class="step__progress-bar"></span>
                </div>
            </div>

            <div class="forgot-pass__inputs">
                <form class="active" id="form__info-user">
                    <span class="info__mesage"></span>
                    <div class="input__title">Your Username <span>*</span></div>
                    <input type="text" name="userChange" placeholder="Enter your username" required>
                    <span class="user__error-msg"></span>

                    <div class="input__title">Email Address <span>*</span></div>
                    <input type="email" name="emailChange" placeholder="Enter your email address" required>
                    <span class="email__error-msg"></span>
                    <button type="submit" class="btn btn-md">Get Code</button>
                </form>
                <form class="" id="form__verify-code">
                    <span class="verify__error-msg"></span>
                    <div class="input__title">Confirmation code <span>*</span></div>
                    <div class="code__input">
                        <input type="number" required>
                        <input type="number" required>
                        <input type="number" required>
                        <input type="number" required>
                        <input type="number" required>
                        <input type="number" required>
                    </div>
                    <button type="submit" class="btn btn-md">Verify</button>
                </form>
                <form class="" id="form__new-pass">
                    <div class="input__title">New Password <span>*</span></div>
                    <input type="password" name="newPass" placeholder="Enter new password" required>
                    <span class="new__error-msg"></span>

                    <div class="input__title">Confirm New Password <span>*</span></div>
                    <input type="password" name="confirmPass" placeholder="Confirm new password" required>
                    <span class="confirm__error-msg"></span>

                    <button type="submit" class="btn btn-md">Confirm</button>

                </form>
            </div>

            <div class="change__login">
                <p>Already have an account? <a href="./login-signup.php">Login here</a></p>
            </div>
        </div>
    </section>
    <!-- FORGOT PASSWORD END -->

    <!-- TOAST MESSAGE START -->
    <div id="toast">
    </div>
    <!-- TOAST MESSAGE END -->

    <script src="https://cdn.jsdelivr.net/npm/@emailjs/browser@3/dist/email.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script type="module" src="./js/forgot-password.js"></script>

</body>

</html>