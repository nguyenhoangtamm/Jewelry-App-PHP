import handleHeader from "./module-header.js";
import BookActions from "./module-bookaction.js";
import ToastMessage, { TYPE_SUCCESS, TYPE_WARNING, TYPE_ERROR } from "./module-toast.js";


$(document).ready(function () {
    BookActions();
    handleHeader();
    $('.details__actions button').click(function () {
        let idBook = this.dataset.id;
        let quantity = $('.details__actions input').val();

        $.ajax({
            type: "POST",
            url: "./php/handle-shopping.php",
            data: {
                checkCustomer: 'customer',
                idBook,
                quantity
            },
            success: function (response) {
                if (!isJSON(response)) {
                    ToastMessage(TYPE_ERROR, 'Error Message', 'A system error has occurred', 4)
                    return;
                }
                let result = JSON.parse(response);
                let noError = result.noError;
                if (noError) {
                    let cartCount = result.countCart;
                    document.querySelector('.header__cart .cart-count').innerHTML = cartCount;
                    ToastMessage(TYPE_SUCCESS, 'Success Message', 'Product added successfully', 4);
                } else {
                    let errorMessage = result.msgError;
                    ToastMessage(TYPE_WARNING, 'Warning Message', errorMessage, 4);
                }
            },
            error: function (xhr, status, error) {
                console.error('Lỗi: ' + error);
            }
        });
    });
});

function isJSON(string) {
    try {
        JSON.parse(string);
        return true;
    } catch (e) {
        return false;
    }
}
