import ToastMessage, { TYPE_WARNING, TYPE_ERROR } from "./module-toast.js";

function handleHeader() {
    let userAction = document.querySelector('.user__actions');
    let actionList = document.querySelector('.action__list');
    userAction.addEventListener('click', () => {
        actionList.classList.toggle('show');
    });

    loadCartCount();

    $('.user__actions .log-out').click(function () {
        $.ajax({
            type: "POST",
            url: "./php/handle-account.php",
            data: {
                logOut: "customer"
            },
            success: function (response) {
                if (!isJSON(response)) {
                    ToastMessage(TYPE_ERROR, 'Error Message', 'A system error has occurred', 4)
                    return;
                }
                let currentPathName = window.location.pathname;
                switch (currentPathName) {
                    case '/user/cart.php':
                    case '/user/checkout.php':
                    case '/user/myaccount.php':
                        window.location.pathname = './user/index.php';
                        break;
                    default:
                        window.location.reload();
                }
            },
            error: function (xhr, status, error) {
                console.error('Lỗi: ' + error);
            }
        });
    });
}

export function loadCartCount() {
    $.ajax({
        type: "POST",
        url: "./php/handle-shopping.php",
        data: {
            loadCountCart: "customer"
        },
        success: function (response) {
            if (!isJSON(response)) {
                ToastMessage(TYPE_ERROR, 'Error Message', 'A system error has occurred', 4)
                return;
            }
            let result = JSON.parse(response);
            let countCart = result.countCart;
            if (countCart != 0) {
                document.querySelector('.cart-count').innerHTML = countCart;
            }
        },
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

export default handleHeader;