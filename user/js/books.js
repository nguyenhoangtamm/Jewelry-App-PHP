import handleHeader from "./module-header.js";
import ToastMessage, { TYPE_SUCCESS, TYPE_ERROR } from "./module-toast.js";
import BookActions from "./module-bookaction.js";
handleHeader();

console.log(window);
$(document).ready(function () {
    let sqlBook = "SELECT id_book, name_book, image_book, name_category, name_author, price " +
        "FROM `book` INNER JOIN `category` on book.id_category = category.id_category " +
        "INNER JOIN `author` ON book.id_author = author.id_author LIMIT 0, 8;"
    $.ajax({
        type: "POST",
        url: "./php/handle-product.php",
        data: {
            numResult: "SELECT * FROM `book`",
            sqlCategory: "SELECT * FROM `category`",
            sqlAuthor: "SELECT * FROM `author`",
            sqlBook
        },
        success: function (response) {
            if(!isJSON(response)) {
                ToastMessage(TYPE_ERROR, 'Error Message', 'A system error has occurred', 4)
                return;
            }
            let data = JSON.parse(response);
            let numPages = (data.dataNum % 8) !== 0 ? (Math.floor(data.dataNum / 8) + 1) : (data.dataNum / 8),
                dataBooks = data.dataBook,
                dataCategorys = data.dataCategory,
                dataAuthors = data.dataAuthor;

            //Load book Item
            loadBookItem(dataBooks)

            //Load Category
            loadCategory(dataCategorys);

            //Load Author
            loadAuthor(dataAuthors);

            //Load Pagination
            loadPagination(1, numPages);

            // Check select category or author
            $('input[type="checkbox"]').change(filterItem);

            // Click filter price
            $('.filter__price-box .filter__btn').click(filterItem);

            // Change page list book
            $(document).on('click', '.pagination__item:not(.disapled)', changePage);

            // Handle select option sort price
            handleSortPirce();

            // Change price input value 
            changePriceInput();

            // Action show, hide list category and author
            showHideListCheckbox();

        },
        error: function (xhr, status, error) {
            console.error('Lỗi: ' + error);
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

function loadBookItem(dataBooks = []) {
    let htmlBookItem = dataBooks.map(data => {
        return `
            <div class="book__item">
                <a href="./details.php?book=${data.id_book}">
                    <img src="../images_book/${data.image_book}" alt="book image" class="book__img">
                </a>
                <div class="book__heading">
                    <span class="book__author">${data.name_author}</span>
                    <span class="book__category">${data.name_category}</span>
                </div>
            
                <span class="book__name">${data.name_book}</span>
                <span class="book__price">$${Number(data.price).toFixed(2)}</span>
                <button class="book__add" aria-label="Add to cart" data-id="${data.id_book}">
                    <i class="bi bi-cart-plus"></i>
                </button>
            </div>`;
    }).join('');
    $('.book__list').html(htmlBookItem);
    BookActions();
}

function loadCategory(dataCategorys = []) {
    let htmlCategory = dataCategorys.map(data => {
        return `
        <li>
            <label>
                <input type="checkbox" name="checkCategory" value="${data.id_category}">
                <span class="check__category"></span>
                ${data.name_category}
            </label>
        </li>`;
    }).join('');
    $('#list-category').html(htmlCategory);
}

function loadAuthor(dataAuthors = []) {
    let htmlAuthor = dataAuthors.map(data => {
        return `
        <li>
            <label>
                <input type="checkbox" name="checkAuthor" value="${data.id_author}">
                <span class="check__author"></span>
                ${data.name_author}
            </label>
        </li>`;
    }).join('');
    $('#list-author').html(htmlAuthor);
}

function loadPagination(activePage = 1, numPages = 0) {
    if (numPages !== 0) {
        let arrPagination = [];
        let element = '';
        element = `<button class="pagination__item prev ${(activePage - 1 == 0) ? "disabled" : ""}" 
                    data-page="${(activePage - 1 == 0) ? 1 : (activePage - 1)}">
                        Previous
                    </button>`;
        arrPagination.push(element);
        for (let i = 1; i <= numPages; i++) {
            if (i === activePage) {
                element = `<button class="pagination__item active" data-page="${i}">${i}</button>`
            } else {
                element = `<button class="pagination__item" data-page="${i}">${i}</button>`;
            }
            arrPagination.push(element);
        }

        element = `<button class="pagination__item next ${(activePage == numPages) ? "disabled" : ""}" 
                    data-page="${(activePage == numPages) ? activePage : (activePage + 1)}">
                        Next
                    </button>`;
        arrPagination.push(element)
        let htmlPagination = arrPagination.join('');
        $('.pagination').html(htmlPagination);
    } else {
        $('.pagination').html('');
    }
}

function changePage() {
    let sqlPage = dataAjax();
    let numPage = this.dataset.page;
    $.ajax({
        type: "POST",
        url: "./php/handle-product.php",
        data: {
            numPage,
            sqlPage
        },
        success: function (response) {
            if(!isJSON(response)) {
                ToastMessage(TYPE_ERROR, 'Error Message', 'A system error has occurred', 4)
                return;
            }
            let data = JSON.parse(response);
            let dataChangePage = data.dataChangePage,
                pageActive = data.pageActive,
                numPage = (data.pageNum % 8) !== 0 ? (Math.floor(data.pageNum / 8) + 1) : (data.pageNum / 8);
            loadBookItem(dataChangePage);
            loadPagination(pageActive, numPage);
            // document.documentElement.scrollTop = 620;
            window.scrollTo({top: 620})
        }
    });

}

function filterItem() {
    let sqlFilter = dataAjax();
    $.ajax({
        type: "POST",
        url: "./php/handle-product.php",
        data: {
            sqlFilter
        },
        success: function (response) {
            if(!isJSON(response)) {
                ToastMessage(TYPE_ERROR, 'Error Message', 'A system error has occurred', 4)
                return;
            }
            let dataFilter = JSON.parse(response);
            if (dataFilter.length > 0) {
                let numPages = (dataFilter.length % 8) !== 0? (Math.floor((dataFilter.length / 8)) + 1) : (dataFilter.length / 8);
                let dataBookNew = dataFilter.slice(0, 8);

                loadBookItem(dataBookNew);

                if (numPages > 1) {
                    loadPagination(1, numPages);
                } else {
                    loadPagination();
                }
            } else {
                let element = `<h1 class="no-result">Sorry, no results were found matching your request</h1>`
                $('.book__list').html(element);
                loadPagination();
            }
        }
    });
}

function dataAjax() {
    let sqlBook = "SELECT id_book, name_book, image_book, name_category, name_author, price " +
        "FROM `book` INNER JOIN `category` on book.id_category = category.id_category " +
        "INNER JOIN `author` ON book.id_author = author.id_author WHERE"
    let data = [sqlBook];
    let arrCheckCategory = [];
    let arrCheckAuthor = [];

    Array.from($('input[name="checkCategory"]:checked')).forEach(element => {
        arrCheckCategory.push(element.value);
    });

    Array.from($('input[name="checkAuthor"]:checked')).forEach(element => {
        arrCheckAuthor.push(element.value);
    });

    if (arrCheckCategory.length > 0) {
        let sqlCategory = arrCheckCategory.map((element, index) => {
            if (index > 0)
                return `OR book.id_category = ${element}`;
            else
                return `book.id_category = ${element}`;
        }).join(' ');
        data.push(`(${sqlCategory})`);
    }

    if (arrCheckAuthor.length > 0) {
        let sqlAuthor = arrCheckAuthor.map((element, index) => {
            if (index > 0)
                return `OR book.id_author = ${element}`;
            else
                return `book.id_author = ${element}`;
        }).join(' ');
        data.push(`(${sqlAuthor})`);
    }

    let filterPrice = `(price BETWEEN ${$('.min__price').html().substring(1)} AND ${$('.max__price').html().substring(1)})`
    data.push(filterPrice);

    let sortPrice = ` ORDER BY price ${document.querySelector('.select__sort').dataset.sort}`

    let sqlFilter = data.map((element, index) => {
        if (index > 1)
            return `AND ${element}`;
        else
            return `${element}`;
    }).join(' ') + sortPrice;

    return sqlFilter;
}

function handleSortPirce() {
    let selectSort = document.querySelector('.select__box .select__sort'),
        optionSelect = document.querySelector('.filter__sort .option__select');
    if (selectSort && selectSort) {
        let optionItem = optionSelect.querySelectorAll('.option__item');
        selectSort.addEventListener('click', () => {
            optionSelect.classList.toggle('show');
        })

        optionItem.forEach((item) => {
            item.addEventListener('click', (e) => {
                selectSort.innerHTML = e.target.innerHTML;
                selectSort.dataset.sort = e.target.dataset.sort;
                optionSelect.classList.remove('show');
                filterItem();
            })
        })
    }
}

// Action Change filter price
function changePriceInput() {
    let rangeMinPrice = document.querySelector('.silder__price-min');
    let rangeMaxPrice = document.querySelector('.silder__price-max');
    let progressValue = document.querySelector('.filter__progress .progress__value');
    let minGap = 10;

    if (rangeMinPrice && rangeMaxPrice && progressValue) {
        rangeMinPrice.addEventListener('input', (e) => {
            let minPriceText = document.querySelector('.filter__price-value .min__price');
            let minValue = parseInt(rangeMinPrice.value);
            let maxValue = parseInt(rangeMaxPrice.value);
            if (maxValue - minValue >= minGap) {
                progressValue.style.left = `${(minValue / 100) * 100}%`;
                minPriceText.innerHTML = `$${minValue}`
            } else {
                rangeMinPrice.value = maxValue - minGap;
            }
        });
        rangeMaxPrice.addEventListener('input', (e) => {
            let maxPriceText = document.querySelector('.filter__price-value .max__price');
            let minValue = parseInt(rangeMinPrice.value);
            let maxValue = parseInt(rangeMaxPrice.value);
            if (maxValue - minValue >= minGap) {
                progressValue.style.right = `${100 - ((maxValue / 100) * 100)}%`;
                maxPriceText.innerHTML = `$${maxValue}`
            } else {
                rangeMaxPrice.value = minValue + minGap;
            }
        });
    }
}

// Action show, hide list category and author
function showHideListCheckbox() {
    $('.category__btn-icon').click(function () {
        $('.category__btn-icon:not(.active)').addClass('active');
        this.classList.remove('active');
        let listCategory = this.dataset.target;
        $(listCategory).toggleClass('show');
    })

    $('.author__btn-icon').click(function () {
        $('.author__btn-icon:not(.active)').addClass('active');
        this.classList.remove('active');
        let listCategory = this.dataset.target;
        $(listCategory).toggleClass('show');
    })
}