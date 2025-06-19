import handleHeader from "./module-header.js";
import BookActions from "./module-bookaction.js";
import ToastMessage, { TYPE_ERROR } from "./module-toast.js";

$(document).ready(function () {
    let sqlNewBook = 'SELECT id_book, name_book, image_book, name_category, name_author, price, description ' +
        'FROM `book` INNER JOIN `category` on book.id_category = category.id_category ' +
        'INNER JOIN `author` ON book.id_author = author.id_author ORDER BY id_book DESC LIMIT 0, 10;';
    let sqlSell = 'SELECT id_book, name_book, image_book, name_category, name_author, price ' +
        'FROM `book` INNER JOIN `category` on book.id_category = category.id_category ' +
        'INNER JOIN `author` ON book.id_author = author.id_author ORDER BY quantity DESC LIMIT 0, 10;';
    $.ajax({
        type: "POST",
        url: "./php/handle-product.php",
        data: {
            sqlNewBook,
            sqlSell
        },
        success: function (response) {
            if (!isJSON(response)) {
                ToastMessage(TYPE_ERROR, 'Error Message', 'A system error has occurred', 4)
                return;
            }
            let data = JSON.parse(response);
            let productNewBook = data.newBook;
            let productIntro = productNewBook[0];
            let productTrend = productNewBook.slice(0, 5);
            let productSell = data.sell;

            // Load intro book
            loadIntroBook(productIntro);
            
            // Load new book
            loadBook(productNewBook, '.new-books__wrapper', 'swiper-slide');

            // Swipper slide
            var swiper = new Swiper(".mySwiper", {
                slidesPerView: 5,
                spaceBetween: 10,
                loop: true,
                autoplay: {
                    delay: 2500,
                    disableOnInteraction: false,
                },
                navigation: {
                    nextEl: ".swiper-button-next",
                    prevEl: ".swiper-button-prev",
                }
            });

            // Load trend book
            loadBook(productTrend, '.trend-book .book__list');

            // Load selling book 
            loadBook(productSell, '.selling .book__list');

            // Module actions
            BookActions();
            handleHeader();
        },
        error: function (xhr, status, error) {
            console.error('Lỗi: ' + error);
        }
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

function loadIntroBook(productIntro = {}) {
    $('.introduce-book__name').html(productIntro.name_book);
    $('.introduce-book__desc').html(productIntro.description);
    $(".introduce-book__action a:first-child").attr("href",`./details.php?book=${productIntro.id_book}`);
    $(".introduce-book__image img").attr("src",`../images_book/${productIntro.image_book}`);
}

function loadBook(products = [], selector = '', classElement = '') {
    let itemsBook = products.map((product) => {
        return `
        <div class="book__item ${classElement}">
            <a href="./details.php?book=${product.id_book}">
                <img src="../images_book/${product.image_book}" alt="book image" class="book__img">
            </a>
            <div class="book__heading">
                <span class="book__author">${product.name_author}</span>
                <span class="book__category">${product.name_category}</span>
            </div>
        
            <span class="book__name">${product.name_book}</span>
            <span class="book__price">$${Number(product.price).toFixed(2)}</span>
            <button class="book__add" aria-label="Add to cart" data-id="${product.id_book}">
                <i class="bi bi-cart-plus"></i>
            </button>
        </div>`;
    }).join('');
    if ($(selector)) {
        $(selector).html(itemsBook);
    } else {
        console.log('Error Load item');
    }
}