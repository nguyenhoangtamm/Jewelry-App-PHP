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
    <!-- LOGIN SIGNUP START -->
    <section class="login-signup">
        <div class="login-signup__container container">
            <div class="login">
                <form class="login__form" method="POST">
                    <div class="logo">
                        <a href="./index.php">
                            <img src="../images_web/logo.png" alt="logo">
                        </a>
                    </div>
                    <h1 class="form__heading">Login</h1>
                    <span class="login__error-msg"></span>
                    <label class="input__group">
                        <i class="bi bi-person-fill"></i>
                        <input type="text" name="userLoginAccount" placeholder="Username" required>
                    </label>
                    <label class="input__group">
                        <i class="bi bi-key-fill"></i>
                        <input type="password" name="passLoginAccount" placeholder="Password" required>
                    </label>
                    <a href="./forgot-password.php" class="forgot__pass">Forgot password?</a>
                    <button type="submit" name="loginAccount" class="btn btn-lg">LOGIN</button>

                    <div class="form__box">
                        <p>Not a member?</p>
                        <span class="change__form">Signup now</span>
                    </div>
                    <p class="social__text">Or <span>Login</span> with social platforms</p>
                    <div class="social__list">
                        <a href="#"><i class="bi bi-facebook"></i></a>
                        <a href="#"><i class="bi bi-google"></i></i></a>
                        <a href="#"><i class="bi bi-twitter"></i></a>
                    </div>
                </form>
            </div>
            <div class="sigup">
                <form class="signup__form show" autocomplete="on">
                    <h1 class="form__heading">Create a new account</h1>
                    <span class="create__success-msg">Create account successfully</span>
                    <label class="input__group">
                        <i class="bi bi-person-fill"></i>
                        <input type="text" placeholder="Username" name="userCreateAccount" required>
                        <span class="create__error-msg"></span>
                    </label>
                    <label class="input__group">
                        <i class="bi bi-envelope-fill"></i>
                        <input type="email" placeholder="Gmail" name="emailCreateAccount" required>
                        <span class="create__error-msg"></span>
                    </label>
                    <label class="input__group">
                        <i class="bi bi-key-fill"></i>
                        <input type="password" placeholder="Password" name="passCreateAccount" required>
                        <span class="create__error-msg"></span>
                    </label>
                    <label class="input__group">
                        <i class="bi bi-shield-lock-fill"></i>
                        <input type="password" placeholder="Confirm Password" name="confirmPassAccount" required>
                        <span class="create__error-msg"></span>
                    </label>
                    <button type="submit" class="btn btn-lg">SIGN UP</button>
                    <div class="form__box">
                        <p>Already have an account?</p>
                        <span class="change__form">Login here</span>
                    </div>
                    <p class="social__text">Or <span>Signup</span> with social platforms</p>
                    <div class="social__list">
                        <a href="#"><i class="bi bi-facebook"></i></a>
                        <a href="#"><i class="bi bi-google"></i></i></a>
                        <a href="#"><i class="bi bi-twitter"></i></a>
                    </div>

                </form>
                <form class="verify-code__form ">
                    <div class="logo">
                        <a href="./index.php">
                            <img src="../images_web/logo.png" alt="logo">
                        </a>
                    </div>
                    <h1 class="form__heading">Verification code</h1>
                    <span class="verify__error-msg">Verify code is incorrect</span>
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
            </div>

            <div class="caption__form">
                <div class="cap__login">
                    <h2>Wellcome to HV - DK Book Store</h2>
                    <p>
                        Where you can immerse yourself in many interesting stories of many different book genres
                    </p>
                    <button class="change__form">Sign up</button>
                    <div class="caption__image">
                        <img src="../images_web/login.png" alt="">
                    </div>
                </div>
                <div class="cap__signup">
                    <h2>Wellcome to HV - DK Book Store</h2>
                    <p>
                        Where you can immerse yourself in many interesting stories of many different book genres
                    </p>
                    <button class="change__form">Login</button>
                    <div class="caption__image">
                        <img src="../images_web/signup.png" alt="">
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- LOGIN SIGNUP END -->

    <!-- TOAST MESSAGE START -->
    <div id="toast">
    </div>
    <!-- TOAST MESSAGE END -->

    <script src="https://cdn.jsdelivr.net/npm/@emailjs/browser@3/dist/email.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script type="module" src="./js/login.js"></script>

</body>

</html>