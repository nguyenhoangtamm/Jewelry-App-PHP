import ToastMessage, { TYPE_SUCCESS, TYPE_ERROR } from "./module-toast.js";

$(document).ready(function () {
    let verifyCode = '';
    (function () {
        emailjs.init("YoUUu9vP52eIGDPXx");
    })();
    // Submit form login
    $('.login__form').submit(function (e) {
        e.preventDefault();
        let username = $('input[name="userLoginAccount"]').val();
        let password = $('input[name="passLoginAccount"]').val();
        if (!checkValue(username) || !checkValue(password)) {
            $('.login__error-msg').html('Username or password contains invalid characters');
            $('.login__error-msg').addClass('error');
            return;
        }
        let data = {
            userLoginAccount: username,
            passLoginAccount: password
        }
        actionsAccount(data, (response) => {
            if (response) {
                let pathName = response
                window.location.pathname = pathName;
            } else {
                $('.login__error-msg').html('Incorrect username or password');
                $('.login__error-msg').addClass('error');
            }
        });
    })

    // Submit form create account
    $('.signup__form').submit(function (e) {
        e.preventDefault();
        let username = $('input[name="userCreateAccount"]').val();
        let email = $('input[name="emailCreateAccount"]').val().trim();
        let password = $('input[name="passCreateAccount"]').val();
        let comfirmPass = $('input[name="confirmPassAccount"]').val();
        let errorInput = {};

        if (!checkValue(username)) {
            errorInput[0] = "Username contains invalid characters";
        } else if (username.length < 7 || username.length > 20) {
            errorInput[0] = "Username from 7 to 20 characters";
        }

        if (email.lastIndexOf('@gmail.com') === -1) {
            errorInput[1] = 'Please enter must be gmail "...@gmail.com"';
        }

        if (!checkValue(password)) {
            errorInput[2] = "Password contains invalid characters";
        } else if (password.length < 7 || password.length > 20) {
            errorInput[2] = "Password from 7 to 20 characters";
        }

        if (!checkValue(comfirmPass)) {
            errorInput[3] = "Confirm password contains invalid characters";
        } else if (password !== comfirmPass) {
            errorInput[3] = "Confirm password is incorrect"
        }

        let inputGroupCreate = Array.from($('.signup__form .input__group'));
        let errorMessageCreate = Array.from($('.signup__form .create__error-msg'));
        if (Object.keys(errorInput).length > 0) {
            for (let index in errorInput) {
                inputGroupCreate[index].classList.add('error');
                errorMessageCreate[index].innerHTML = errorInput[index];
            }
            return;
        }

        let data = {
            checkUser: username,
            checkEmail: email
        }
        actionsAccount(data, (response) => {
            if (!isJSON(response)) {
                ToastMessage(TYPE_ERROR, 'Error Message', 'A system error has occurred', 4)
                return;
            }
            let data = JSON.parse(response);
            let isCreateError = data.error;
            if (!isCreateError) {
                verifyCode = '';
                for (let i = 0; i < 6; i++) {
                    verifyCode += `${Math.floor(Math.random() * 10)}`
                }
                let serviceID = "service_zi1zbvg";
                let templateID = "template_7mlm9oc"
                let param = {
                    from_name: 'Books Store',
                    to_email: email,
                    message: verifyCode,
                    reply_to: 'baitaplon2023@gmail.com',
                }

                emailjs.send(serviceID, templateID, param)
                    .then(function () {
                        ToastMessage(TYPE_SUCCESS, 'Success Message', 'Send verify code successfully', 4)
                        setTimeout(function () {
                            $('.signup__form').removeClass('show');
                            $('.verify-code__form').addClass('show');
                            $('.verify__error-msg').removeClass('error');
                        }, 3000)
                    })
                    .catch(function (error) {
                        console.log('FAILED...', error);
                    });
                $('.create__success-msg').addClass('show');
                $('.create__success-msg').html('Please wait a moment');
            } else {
                let errorMsg = data.message;
                for (let index in errorMsg) {
                    inputGroupCreate[index].classList.add('error');
                    errorMessageCreate[index].innerHTML = errorMsg[index];
                }
            }
        });
    });

    $('.verify-code__form').submit(function (e) {
        e.preventDefault();
        let valueCode = Array.from($('.verify-code__form input')).map((item) => {
            return item.value;
        }).join('');
        if (verifyCode === valueCode) {
            let username = $('input[name="userCreateAccount"]').val();
            let email = $('input[name="emailCreateAccount"]').val().trim();
            let password = $('input[name="passCreateAccount"]').val();
            let data = {
                userCreateAccount: username,
                emailCreateAccount: email,
                passCreateAccount: password
            }
            actionsAccount(data, (response) => {
                if (response) {
                    $('.signup__form').addClass('show');
                    $('.create__success-msg').html('Create account successfully');
                    $('.signup__form input').val('');
                } else {
                    ToastMessage(TYPE_ERROR, 'Error Message', 'A system error has occurred', 4);
                }
            });
        } else {
            $('.verify__error-msg').addClass('error');
        }
    })

    // Input verify code
    handleInputCode();

    $('.verify-code__form input').on('input', function () {
        $('.verify__error-msg').removeClass('error');
    })

    // Remove class error input group form create account
    $('.signup__form input').on('input', function (e) {
        let groupInput = e.target.closest('.input__group')
        groupInput.classList.remove('error');
    })

    // Remove msg when user input value login
    $('.login__form input').on('input', function () {
        $('.login__error-msg').removeClass('error');
    })

    // Reset all form when user change form
    $('.change__form').click(function () {
        $('.login-signup__container').toggleClass('left__active');
        $('.signup__form').addClass('show');
        $('.verify-code__form').removeClass('show');
        $('.login__error-msg').removeClass('error');
        $('.create__success-msg').removeClass('show');
        $('.signup__form .input__group').removeClass('error');
        $('.login-signup__container input').val('');
    })
});

function isJSON(string) {
    try {
        JSON.parse(string);
        return true;
    } catch (e) {
        return false;
    }
}

function handleInputCode() {
    let arrInput = Array.from($('.code__input input'));
    let lengthArr = arrInput.length;
    arrInput.forEach(function (element, index) {
        element.oninput = function () {
            if (this.value.length > 1) {
                this.value = this.value.slice(-1);
            }
            if (index + 1 !== lengthArr && this.value.length > 0) {
                arrInput[index + 1].focus();
            }
        }
    })
}

function checkValue(value) {
    const regex = /^[a-zA-Z0-9@.]+$/;
    return regex.test(value);
}

function actionsAccount(dataAccount = {}, successConnect = () => { }) {
    $.ajax({
        type: "POST",
        url: "./php/handle-account.php",
        data: dataAccount,
        success: successConnect,
        error: function (xhr, status, error) {
            console.error('Lỗi: ' + error);
        }
    })
}