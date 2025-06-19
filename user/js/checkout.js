import handleHeader from "./module-header.js";
import ToastMessage, { TYPE_SUCCESS, TYPE_ERROR, TYPE_WARNING } from "./module-toast.js";

$(document).ready(function () {
    handleHeader();

    // Load data check out
    $.ajax({
        type: "POST",
        url: "./php/handle-shopping.php",
        data: { loadDataOrder: 'customer' },
        success: function (response) {
            if (!isJSON(response)) {
                ToastMessage(TYPE_ERROR, 'Error Message', 'A system error has occurred', 4);
                return;
            }
            let dataProduct = JSON.parse(response).data;
            loadProduct(dataProduct);
            loadAmountPayment();
        },
        error: function (xhr, status, error) {
            console.error('Lỗi: ' + error);
        }
    });

    // Handle place order
    $('.btn__order').click(function () {
        let countCart = $('.header__cart .cart-count').html();
        if(countCart === "0") {
            ToastMessage(TYPE_WARNING, 'Warning Message', 'Please select at least one product before checkout', 4);
            return;
        } 
        let messageOrder = $('.notes__message').val();
        $.ajax({
            type: "POST",
            url: "./php/handle-order.php",
            data: {
                placeOrder: 'customer',
                messageOrder
            },
            success: function (response) {
                if (!isJSON(response)) {
                    ToastMessage(TYPE_ERROR, 'Error Message', 'A system error has occurred', 4);
                    return;
                }
                let result = JSON.parse(response);
                let noError = result.noError;
                if (noError) {
                    $('.checkout__list').html("");
                    $('.header__cart .cart-count').html("0");
                    $('.amount__payment').html("$0.00");
                    $('.notes__message').val("");
                    ToastMessage(TYPE_SUCCESS, 'Success Message', 'Ordered the product successfully', 4);
                } else {
                    ToastMessage(TYPE_WARNING, 'Warning Message', 'Please update all information before ordering', 4);
                }
            },
            error: function (xhr, status, error) {
                console.error('Lỗi: ' + error);
            }
        });
    });
});

function loadProduct(dataProduct = []) {
    let elementsProduct = dataProduct.map(product => {
        let total = (Number(product.quantity) * Number(product.price)).toFixed(2);
        return `
        <div class="checkout__item">
            <span class="item__name">${product.name_book}</span>
            <span class="item__count">x${product.quantity}</span>
            <span class="item__total">$${total}</span>
        </div>`;
    }).join('');
    $('.checkout__list').html(elementsProduct);
}

function loadAmountPayment() {
    let elementTotal = Array.from(document.querySelectorAll('.item__total'));
    let amountPayment = elementTotal.reduce((accumulator, item) => {
        let total = Number(item.innerHTML.substring(1));
        return accumulator + total;
    }, 0)
    document.querySelector('.amount__payment').innerHTML = `$${amountPayment.toFixed(2)}`;
}

function isJSON(string) {
    try {
        JSON.parse(string);
        return true;
    } catch (e) {
        return false;
    }
}