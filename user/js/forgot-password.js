import ToastMessage, { TYPE_SUCCESS, TYPE_ERROR } from "./module-toast.js";


$(document).ready(function () {
    let verifyCode = '';
    (function () {
        emailjs.init("YoUUu9vP52eIGDPXx");
    })();

    // Submit form info
    $('#form__info-user').submit(function (e) {
        e.preventDefault();
        let userChange = $('#form__info-user input[name="userChange"]').val();
        let emailChange = $('#form__info-user input[name="emailChange"]').val();

        const regex = /^[a-zA-Z0-9@.]+$/;
        let isError = false;
        if (!regex.test(userChange)) {
            $('.user__error-msg').html('Username contains invalid characters');
            $('.user__error-msg').addClass('error');
            isError = true;
        }

        if (emailChange.lastIndexOf('@gmail.com') === -1) {
            $('.email__error-msg').html('Please enter must be gmail "...@gmail.com"');
            $('.email__error-msg').addClass('error');
            isError = true;
        }

        if (isError) {
            return;
        }

        let data = {
            userChange,
            emailChange
        }
        actionChangePass(data, (response) => {
            if (!isJSON(response)) {
                ToastMessage(TYPE_ERROR, 'Error Message', 'A system error has occurred', 4)
                return;
            }
            let elementInfo = document.querySelector('.info__mesage');

            let result = JSON.parse(response);
            let noError = result.noError;
            if (noError) {
                verifyCode = '';
                for (let i = 0; i < 6; i++) {
                    verifyCode += `${Math.floor(Math.random() * 10)}`
                }
                let serviceID = "service_zi1zbvg";
                let templateID = "template_7mlm9oc"
                let param = {
                    from_name: 'Books Store',
                    to_email: emailChange,
                    message: verifyCode,
                    reply_to: 'baitaplon2023@gmail.com',
                }

                emailjs.send(serviceID, templateID, param)
                    .then(function () {
                        ToastMessage(TYPE_SUCCESS, 'Success Message', 'Send verify code successfully', 4)
                        setTimeout(() => {
                            document.querySelector('.step__progress-bar').style.width = '50%';
                            document.querySelector('#form__verify-code').classList.add('active');
                            document.querySelector('.step__group.verify-code').classList.add('active');
                            document.querySelector('#form__info-user').classList.remove('active');
                            elementInfo.classList.remove('show');
                        }, 3000)
                    })
                    .catch(function (error) {
                        console.log('FAILED...', error);
                    });

                elementInfo.innerHTML = 'Please wait a moment';
                elementInfo.classList.add('show');
                elementInfo.classList.remove('show');
            } else {
                elementInfo.innerHTML = 'Username or email does not exist';
                elementInfo.classList.add('error');
            }
        });
    })

    // Submit form verify code
    $('#form__verify-code').submit(function (e) {
        e.preventDefault();
        let valueCode = Array.from($('#form__verify-code input')).map((item) => {
            return item.value
        }).join('');
        if (verifyCode === valueCode) {
            document.querySelector('.step__progress-bar').style.width = '100%';
            document.querySelector('#form__new-pass').classList.add('active');
            document.querySelector('.step__group.new-pass').classList.add('active');
            document.querySelector('#form__verify-code').classList.remove('active');
        } else {
            let elementError = document.querySelector('.verify__error-msg')
            elementError.innerHTML = 'Verify code is incorrect';
            elementError.classList.add('error');
        }
    })

    // Submit form create new pass
    $('#form__new-pass').submit(function (e) {
        e.preventDefault();
        let newPass = $('#form__new-pass input[name="newPass"]').val();
        let confirmPass = $('#form__new-pass input[name="confirmPass"]').val();

        const regex = /^[a-zA-Z0-9@.]+$/;
        let isError = false;
        if (!regex.test(newPass)) {
            $('.new__error-msg').html('Password contains invalid characters');
            $('.new__error-msg').addClass('error');
            isError = true;
        } else if (newPass.length < 7 || newPass.length > 20) {
            $('.new__error-msg').html('Password from 7 to 20 characters');
            $('.new__error-msg').addClass('error');
            isError = true;
        }

        if (!regex.test(confirmPass)) {
            $('.confirm__error-msg').html('Confirm password contains invalid characters');
            $('.confirm__error-msg').addClass('error');
            isError = true;
        } else if (confirmPass !== newPass) {
            $('.confirm__error-msg').html('Confirm password is incorrect');
            $('.confirm__error-msg').addClass('error');
            isError = true;
        }

        if (isError) {
            return;
        }

        let data = {
            newPass
        }
        actionChangePass(data, (response) => {
            if (response) {
                ToastMessage(TYPE_SUCCESS, 'Success Message', 'Password recovery successfully', 4)
                $('.step__progress-bar').width('0%');
                $('form input').val('');
                $('.forgot-pass__step .step__group').removeClass('active');
                $('.forgot-pass__inputs form').removeClass('active');
                $('.forgot-pass__step .step__group:first-child').addClass('active');
                $('.forgot-pass__inputs form:first-child').addClass('active');
            } else {
                ToastMessage(TYPE_ERROR, 'Error Message', 'A system error has occurred', 4)
            }
        });
    });

    changeStep();

    handleInputCode();

    $('#form__info-user input').on('input', function () {
        this.nextElementSibling.classList.remove('error');
        $('.info__mesage').removeClass('error show');
    })

    $('#form__verify-code input').on('input', function () {
        $('.verify__error-msg').removeClass('error');
    })

    $('#form__new-pass input').on('input', function () {
        this.nextElementSibling.classList.remove('error');
        $('.recovery__success-msg').remove('show');
    })
})



function changeStep() {
    $('.step__group').click(function () {
        if (this.matches('.active')) {
            let element = this.dataset.target;
            $('.forgot-pass__inputs form.active').removeClass('active');
            $(element).addClass('active');
        }
    })
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

function isJSON(string) {
    try {
        JSON.parse(string);
        return true;
    } catch (e) {
        return false;
    }
}


function actionChangePass(dataChange = {}, successConnect = () => { }) {
    $.ajax({
        type: "POST",
        url: "./php/handle-account.php",
        data: dataChange,
        success: successConnect,
        error: function (xhr, status, error) {
            console.error('Lỗi: ' + error);
        }
    })
}

