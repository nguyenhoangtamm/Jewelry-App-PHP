import handleHeader from "./module-header.js";
import ToastMessage, { TYPE_SUCCESS, TYPE_ERROR } from "./module-toast.js";


$(document).ready(function () {
    handleHeader();

    // Load data customer
    loadDataCustomer();

    // Submit update infor customer
    $('.form__update').submit(function (e) {
        e.preventDefault();
        let name = $('.form__update input[name="fullName"]').val().trim();
        let birthDate = $('.form__update input[name="birthDate"]').val();
        let yearBirthDate = birthDate.slice(0, birthDate.indexOf('-'));
        let dateNow = new Date();

        let address = $('.form__update input[name="address"]').val().trim();
        let email = $('.form__update input[name="email"]').val().trim();
        let phone = $('.form__update input[name="phone"]').val();

        let errorInput = {};
        let reSpecial = /[`~!@#$%^&*()_+=?'":{}|<>\-;,./\\[\]]/g;
        let reNum = /^[0-9]+$/;
        if (reSpecial.test(name)) {
            errorInput[0] = 'Full name contains invalid characters';
        }

        if (dateNow.getFullYear() - parseInt(yearBirthDate) < 12) {
            errorInput[1] = 'Only people 12 years of age and older can purchase';
        }

        if (reSpecial.test(address)) {
            errorInput[2] = 'Address contains invalid characters';
        }

        if (email.lastIndexOf('@gmail.com') === -1) {
            errorInput[3] = 'Please enter must be gmail "...@gmail.com"';
        }

        if (!reNum.test(phone)) {
            errorInput[4] = 'Please enter numbers only';
        } else if (phone.length > 10) {
            errorInput[4] = 'The length exceeds 10 characters of the phone number';
        }

        let formGroup = Array.from($('.form__update .form__group'));
        let errorSpan = Array.from($('.form__update .error__update-msg'));
        if (Object.keys(errorInput).length > 0) {
            for (let index in errorInput) {
                formGroup[index].classList.add('error');
                errorSpan[index].innerHTML = errorInput[index];
            }
            return
        }

        let data = {
            name,
            birthDate,
            address,
            email,
            phone
        }

        ajaxCustomer(data, (response) => {
            if (!isJSON(response)) {
                ToastMessage(TYPE_ERROR, 'Error Message', 'A system error has occurred', 4)
                return;
            }
            let data = JSON.parse(response);
            let isError = data.error;
            if (isError) {
                formGroup[3].classList.add('error');
                errorSpan[3].innerHTML = data.errorEmail;
            } else {
                loadDataCustomer();
                ToastMessage(TYPE_SUCCESS, 'Success Message', 'Updated customer information successfully', 4)
            }
        });
    })

    // Submit change password
    $('.form__change-pass').submit(function (e) {
        e.preventDefault();
        let currentPass = $('.form__change-pass input[name="currentPass"]').val();
        let newPass = $('.form__change-pass input[name="newPass"]').val();
        let confirmNewPass = $('.form__change-pass input[name="confirmNewPass"]').val();

        const regex = /^[a-zA-Z0-9@.]+$/;
        let errorInput = {};
        if (!regex.test(currentPass)) {
            errorInput[0] = 'Current password contains invalid characters';
        } else if (currentPass.length < 7 || currentPass.length > 20) {
            errorInput[0] = "Current password from 7 to 20 characters";
        }

        if (!regex.test(newPass)) {
            errorInput[1] = 'New password contains invalid characters';
        } else if (newPass.length < 7 || newPass.length > 20) {
            errorInput[1] = "New password from 7 to 20 characters";
        }

        if (!regex.test(confirmNewPass)) {
            errorInput[2] = 'Confirm new password contains invalid characters';
        } else if (newPass !== confirmNewPass) {
            errorInput[2] = 'Confirm new password is incorrect';
        }

        let formGroup = Array.from($('.form__change-pass .form__group'));
        let errorSpan = Array.from($('.form__change-pass .error__pass-msg'));
        if (Object.keys(errorInput).length > 0) {
            for (let index in errorInput) {
                formGroup[index].classList.add('error');
                errorSpan[index].innerHTML = errorInput[index];
            }
            return;
        }

        let data = {
            currentPass,
            newPass
        }

        ajaxCustomer(data, (response) => {
            if (!isJSON(response)) {
                ToastMessage(TYPE_ERROR, 'Error Message', 'A system error has occurred', 4)
                return;
            }
            let data = JSON.parse(response);
            let isError = data.error;
            if (isError) {
                formGroup[0].classList.add('error');
                errorSpan[0].innerHTML = data.errorPass;
            } else {
                $('.form__change-pass  input').val('');
                ToastMessage(TYPE_SUCCESS, 'Success Message', 'Password changed successfully', 4)
            }
        });
    })

    // Active Content
    $('.sidebar__item').click(function () {
        let elementTarget = this.dataset.target;
        document.querySelector('.account__content.active').classList.remove('active');
        document.querySelector(elementTarget).classList.add('active');
    })

    // Remove error when user input
    $(':is(.form__update, .form__change-pass) input').on('input', function () {
        let parentElement = this.closest('.form__group');
        parentElement.classList.remove('error');
    })

})

function loadDataCustomer() {
    ajaxCustomer({ loadDataCustomer: "customer" }, (response) => {
        if (!isJSON(response)) {
            ToastMessage(TYPE_ERROR, 'Error Message', 'A system error has occurred', 4)
            return;
        }
        let data = JSON.parse(response);
        let infoCustomer = data.infoCustomer[0],
            customerOrder = data.customerOrder;
        loadMyAccount(infoCustomer);
        loadUpdateInfo(infoCustomer);
        loadCustomerOrder(customerOrder);
        handleOverlayView(infoCustomer);
        handleOverlayDelete();
    })
}

function ajaxCustomer(dataAccount = {}, successConnect = () => { }) {
    $.ajax({
        type: "POST",
        url: "./php/handle-customer.php",
        data: dataAccount,
        success: successConnect,
        error: function (xhr, status, error) {
            console.error('Lỗi: ' + error);
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

function loadMyAccount(infoCustomer = {}) {
    if (Object.keys(infoCustomer).length > 0) {
        let date = new Date(infoCustomer.date_birth);
        let brirthDate = `${date.getDate() < 10 ? `0${date.getDate()}` : date.getDate()}
            - ${date.getMonth() + 1 < 10 ? `0${date.getMonth() + 1}` : date.getMonth() + 1} - ${date.getFullYear()}`;
        $('.account__group .account__name').html(infoCustomer.name_customer);
        $('.account__group .account__birth').html(brirthDate);
        $('.account__group .account__address').html(infoCustomer.address);
        $('.account__group .account__email').html(infoCustomer.email);
        $('.account__group .account__phone').html(infoCustomer.phone);
    }
}

function loadUpdateInfo(infoCustomer = {}) {
    if (Object.keys(infoCustomer).length > 0) {
        $('.form__update input[name="fullName"]').val(infoCustomer.name_customer);
        $('.form__update input[name="birthDate"]').val(infoCustomer.date_birth);
        $('.form__update input[name="address"]').val(infoCustomer.address);
        $('.form__update input[name="email"]').val(infoCustomer.email);
        $('.form__update input[name="phone"]').val(infoCustomer.phone);
    }
}

function loadCustomerOrder(customerOrder = []) {
    let statusOrder = {
        New: "new",
        Delivering: "delivering",
        Cancelled: "cancelled",
        Complete: "complete"
    };
    if(customerOrder.length > 0) {
        let elementOrder = customerOrder.map(itemOrder => {
            let date = new Date(itemOrder.order_date);
            let orderDate = `${date.getDate() < 10 ? `0${date.getDate()}` : date.getDate()}
                - ${date.getMonth() + 1 < 10 ? `0${date.getMonth() + 1}` : date.getMonth() + 1} - ${date.getFullYear()}`;
            let classStatus = statusOrder[itemOrder.status];
            return `
            <tr>
                <td>${itemOrder.id_order}</td>
                <td>${orderDate}</td>
                <td>${itemOrder.name_customer}</td>
                <td class="${classStatus}">${itemOrder.status}</td>
                <td>
                    <i class="bi bi-eye-fill order__view" data-order="${itemOrder.id_order}"></i>
                    <i class="bi bi-trash-fill order__trash ${itemOrder.status === "Delivering" ?
                    "disabled" : ""}" data-order="${itemOrder.id_order}"></i>
                    
                </td>
            </tr>`;
        }).join('');
        $('.table__order tbody').html(elementOrder);
    }else {
        let noProduct = `<tr><th class="no-product" colspan="5">There are no products in the cart</th></tr>`;
        $('.table__order tbody').html(noProduct);
    }
}

function handleOverlayView(infoCustomer = {}) {
    $('.order__view').click(function () {
        let idOrderView = this.dataset.order;
        $.ajax({
            type: "POST",
            url: "./php/handle-order.php",
            data: { idOrderView },
            success: function (response) {
                if (!isJSON(response)) {
                    ToastMessage(TYPE_ERROR, 'Error Message', 'A system error has occurred', 4)
                    return;
                }
                let dataView = JSON.parse(response);
                orderView(infoCustomer, dataView);
                document.querySelector('.overlay.view-order').classList.add('show');

            },
            error: function (xhr, status, error) {
                console.error('Lỗi: ' + error);
            }
        })
    })

    $('.overlay .close-view').click(function () {
        document.querySelector('.overlay.view-order').classList.remove('show');
    })
}

function orderView(infoCustomer = {}, dataView = []) {
    let overlayView = document.querySelector('.overlay.view-order');
    overlayView.querySelector('.customer-name').innerHTML = infoCustomer.name_customer;
    overlayView.querySelector('.customer-phone').innerHTML = infoCustomer.phone;
    overlayView.querySelector('.customer-address').innerHTML = infoCustomer.address;
    overlayView.querySelector('.customer-mail').innerHTML = infoCustomer.email;
    let elementProduct = dataView.map(order => {
        let amount = (Number(order.price) * Number(order.quantity)).toFixed(2);
        return `
        <tr>
            <td>${order.name_book}</td>
            <td>${order.quantity}</td>
            <td>$${Number(order.price).toFixed(2)}</td>
            <td>$${amount}</td>
        </tr>`;
    }).join('');
    overlayView.querySelector('.table__product tbody').innerHTML = elementProduct;
    let notes = dataView[0].notes;
    overlayView.querySelector('.order-notes').innerHTML = notes;
}

function handleOverlayDelete() {
    $('.order__trash').click(function () {
        let idOrder = this.dataset.order;
        document.querySelector('.overlay .sure__action').dataset.order = idOrder;
        document.querySelector('.overlay.delete-order').classList.add('show');
    })

    $('.overlay .no__action').click(function () {
        document.querySelector('.overlay.delete-order').classList.remove('show');
    })

    $('.overlay .sure__action').click(function () {
        let idOrderDelete = this.dataset.order;

        $.ajax({
            type: "POST",
            url: "./php/handle-order.php",
            data: { idOrderDelete },
            success: function (response) {
                if (!isJSON(response)) {
                    ToastMessage(TYPE_ERROR, 'Error Message', 'A system error has occurred', 4)
                    return;
                }
                let cartTrashElement = document.querySelector(`.order__trash[data-order="${idOrderDelete}"]`);
                let elementParent = cartTrashElement.parentElement.closest('tr');
                let tableOrder = document.querySelector('.table__order tbody');
                tableOrder.removeChild(elementParent);
                document.querySelector('.overlay.delete-order').classList.remove('show');
                if(tableOrder.children.length === 0) {
                    let noProduct = `<tr><th class="no-product" colspan="5">There are no products in the cart</th></tr>`;
                    tableOrder.innerHTML = noProduct;
                }
                ToastMessage(TYPE_SUCCESS, 'Infor Message', 'Product deleted successfully', 4)
            },
            error: function (xhr, status, error) {
                console.error('Lỗi: ' + error);
            }
        })
    })
}

