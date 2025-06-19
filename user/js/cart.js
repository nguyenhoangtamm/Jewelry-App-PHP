import handleHeader from "./module-header.js";
import ToastMessage, { TYPE_SUCCESS, TYPE_ERROR, TYPE_WARNING } from "./module-toast.js";
$(document).ready(function () {
    handleHeader();
    ajaxShopping({ loadDataOrder: 'customer' }, (response) => {
        if (!isJSON(response)) {
            ToastMessage(TYPE_ERROR, 'Error Message', 'A system error has occurred', 4);
            return;
        }
        let dataShopping = JSON.parse(response).data;
        if (dataShopping.length > 0) {
            loadShopping(dataShopping);
            amountTotal();
            changeQuantity();
            handleOverlay();
            actionDelete();
        } else {
            let noProduct = `<tr><th class="no-product" colspan="6">There are no products in the cart</th></tr>`;
            $('.table__cart tbody').html(noProduct);
        }
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

function loadShopping(dataShopping = []) {
    let elementCart = dataShopping.map(cart => {
        let toatal = (Number(cart.price) * Number(cart.quantity)).toFixed(2);
        return `
        <tr>
            <td>
                <img src="../images_book/${cart.image_book}" class="cart__img">
                <span class="product__name">${cart.name_book}</span>
            </td>
            <td>
                <input type="number" name="cart quantity" min="0" 
                    value="${cart.quantity}" class="cart__quantity" data-shopping="${cart.id_shopping}">
            </td>
            <td class="cart__price">$${Number(cart.price).toFixed(2)}</td>
            <td>Free shipping</td>
            <td class="cart__total">$${toatal}</td>
            <td>
                <i class="bi bi-trash-fill cart__trash" data-shopping="${cart.id_shopping}"></i>
            </td>
        </tr>`;
    }).join('');
    $('.table__cart tbody').html(elementCart);
}

function amountTotal() {
    let elementsCartTotal = Array.from(document.querySelectorAll('.cart__total'));
    let amountTotal = elementsCartTotal.reduce(function (accumulator, element) {
        let toatal = Number(element.innerHTML.substring(1));
        return accumulator + toatal;
    }, 0);
    document.querySelector('.product__total').innerHTML = `$${amountTotal.toFixed(2)}`;
    document.querySelector('.totals').innerHTML = `$${amountTotal.toFixed(2)}`;
}

function handleOverlay() {
    // Show overlay deleted
    $('.cart__trash').click(function () {
        let overlay = document.querySelector('.overlay'),
            sureActionDelete = document.querySelector('.overlay .sure__action');
        overlay.classList.add('show');
        sureActionDelete.dataset.shopping = this.dataset.shopping;
    })

    // No deleted and hide overlay
    $('.overlay .no__action').click(function () {
        let overlay = document.querySelector('.overlay');
        overlay.classList.remove('show');
    })
}

function actionDelete() {
    $('.overlay .sure__action').click(function () {
        let idDeleteShopping = this.dataset.shopping;
        let overlay = document.querySelector('.overlay');
        overlay.classList.remove('show');
        ajaxShopping({ idDeleteShopping }, (response) => {
            if (!isJSON(response)) {
                ToastMessage(TYPE_ERROR, 'Error Message', 'A system error has occurred', 4)
                return;
            }
            let result = JSON.parse(response);
            let countCart = result.countCart;

            // Remove element contains card product deleted
            let cartTrashElement = document.querySelector(`.cart__trash[data-shopping="${idDeleteShopping}"]`);
            let trDeleteElement = cartTrashElement.parentElement.closest('tr'),
                tableBodyElement = document.querySelector('.table__cart tbody');
            tableBodyElement.removeChild(trDeleteElement);
            if (tableBodyElement.children.length === 0) {
                let noProduct = `<tr><th class="no-product" colspan="6">There are no products in the cart</th></tr>`;
                tableBodyElement.innerHTML = noProduct;
            }
            
            // Load Cart totals
            amountTotal();
            document.querySelector('.cart-count').innerHTML = countCart;
            ToastMessage(TYPE_SUCCESS, 'Infor Message', 'Product deleted successfully', 4);
        });
    })
}

function changeQuantity() {
    let previousValue;
    $('.cart__quantity').on('focus', function () {
        previousValue = this.value;
    })

    // Update quantity shopping cart when user change quantity 
    $('.cart__quantity').on('blur', function () {
        let elementQuantity = this;
        let valueQuantity = elementQuantity.value;

        if (valueQuantity !== previousValue) {
            let idShopping = elementQuantity.dataset.shopping;
            let parentElement = elementQuantity.closest('tr');
            let cartTotalElement = parentElement.querySelector('.cart__total'),
                cartPriceElement = parentElement.querySelector('.cart__price');
            if (!valueQuantity) {
                valueQuantity = 1;
            }

            let data = {
                idShopping,
                valueQuantity
            }

            ajaxShopping(data, (response) => {
                if (!isJSON(response)) {
                    ToastMessage(TYPE_ERROR, 'Error Message', 'A system error has occurred', 4)
                    return;
                }
                let result = JSON.parse(response);
                let noError = result.noError;
                if (noError) {
                    elementQuantity.value = valueQuantity;
                    let total = Number(cartPriceElement.innerHTML.substring(1)) * Number(valueQuantity);
                    cartTotalElement.innerHTML = `$${total.toFixed(2)}`;
                    amountTotal();
                } else {
                    elementQuantity.value = previousValue;
                    let errorMessage = result.msgError;
                    ToastMessage(TYPE_WARNING, 'Warning Message', errorMessage, 4)
                }
            });
        }
    })
}


function ajaxShopping(dataOrder = {}, functionSuccess = () => { }) {
    $.ajax({
        type: "POST",
        url: "./php/handle-shopping.php",
        data: dataOrder,
        success: functionSuccess,
        error: function (xhr, status, error) {
            console.error('Lỗi: ' + error);
        }
    });
}