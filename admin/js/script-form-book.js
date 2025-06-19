const addBooks = document.querySelectorAll('.js-add-book')
const modal = document.querySelector('.js-modal-addBook')   
const modalAddClose = document.querySelector('.js-modal-addBook-close')
const modalContainer = document.querySelector('.js-modal-addBook-container')
const cancelBooks = document.querySelectorAll('.js-cancel-book')

function showFormAddBook(){
    modal.classList.add('open')
}

function hideFormAddBook(){
    modal.classList.remove('open')
}

for(const addBook of addBooks){
    addBook.addEventListener('click', showFormAddBook)
}

for(const cancelBook of cancelBooks){
    cancelBook.addEventListener('click', hideFormAddBook)
}

modalAddClose.addEventListener('click', hideFormAddBook)
modal.addEventListener('click', hideFormAddBook)
modalContainer.addEventListener('click', function(){
    event.stopPropagation()
})


const changeBooks = document.querySelectorAll('.js-changeBook')
const modalChange = document.querySelector('.js-modal-changeBook')   
const modalChangeClose = document.querySelector('.js-modal-changeBook-close')
const modalChangeContainer = document.querySelector('.js-modal-changeBook-container')
const saveChange = document.querySelector('.js-save-changedBook')
const bookName = document.querySelector('.js-book-name')
const bookCategory = document.querySelector('.js-book-category')
const bookQuantity = document.querySelector('.js-book-quantity')
const bookPrice = document.querySelector('.js-book-price')
const bookAuthor = document.querySelector('.js-book-author')
const bookTags = document.querySelector('.js-book-tags')
const bookDescription = document.querySelector('.js-book-description')

if(modalChange){
    function hideFormChangeBook(){
        modalChange.classList.add('hide-form-change')
    }
    
    for(const cancelBook of cancelBooks){
        cancelBook.addEventListener('click', hideFormChangeBook)
    }
    
    modalChangeClose.addEventListener('click', hideFormChangeBook)
    modalChange.addEventListener('click', hideFormChangeBook)
    modalChangeContainer.addEventListener('click', function(){
        event.stopPropagation()
    })
}


/*Bật tắt form xác nhận xóa*/
const deleteBooks = document.querySelectorAll('.js-delete-book')
const modalDelete = document.querySelector('.js-modal-deleteBook')   
const modalDeleteClose = document.querySelector('.js-modal-deleteBook-close')
const modalDeleteContainer = document.querySelector('.js-modal-deleteBook-container')
const modalDeleteChooseYes = document.querySelector('.js-book-btn-yes')
const modalDeleteChooseNo = document.querySelector('.js-book-btn-no')

// function showFormDeleteBook(){
//     modalDelete.classList.add('open-form-delete')
// }

function hideFormDeleteBook(){
    modalDelete.classList.add('hide-form-delete')
}

// for(const deleteBook of deleteBooks){
//     deleteBook.addEventListener('click', showFormDeleteBook)
// }
if(modalDelete){
    modalDeleteClose.addEventListener('click', hideFormDeleteBook)
    modalDelete.addEventListener('click', hideFormDeleteBook)
    modalDeleteContainer.addEventListener('click', function(){
    event.stopPropagation()
    })
    // modalDeleteChooseYes.addEventListener('click', hideFormDeleteBook)
    modalDeleteChooseNo.addEventListener('click', hideFormDeleteBook)
}


//Xóa thông báo lỗi form add book
let name = document.querySelector(".js-addBook-name");
let des = document.querySelector(".js-addBook-description");
let tags = document.querySelector(".js-addBook-tags");
let img = document.querySelector(".js-addBook-img");
let price = document.querySelector(".js-addBook-price");
let quantity = document.querySelector(".js-addBook-quantity");

if(modal){
    name.addEventListener('input', function(event) {
        if(event.target){
            document.querySelector(".name-addBook-error").innerHTML = "";
        }
    });
    
    des.addEventListener('input', function(event) {
        if(event.target){
            document.querySelector(".des-addBook-error").innerHTML = "";
        }
    });
    
    price.addEventListener('input', function(event) {
        if(event.target){
            document.querySelector(".price-addBook-error").innerHTML = "";
        }
    });
    
    quantity.addEventListener('input', function(event) {
        if(event.target){
            document.querySelector(".quantity-addBook-error").innerHTML = "";
        }
    });
}


//Xóa thông báo lỗi form change book
let nameChange = document.querySelector(".js-changeBook-name");
let desChange = document.querySelector(".js-changeBook-description");
let tagsChange = document.querySelector(".js-changeBook-tags");
let imgChange = document.querySelector(".js-changeBook-img");
let priceChange = document.querySelector(".js-changeBook-price");
let quantityChange = document.querySelector(".js-changeBook-quantity");

if(modalChange){
    nameChange.addEventListener('input', function(event) {
        if(event.target){
            document.querySelector(".name-changeBook-error").innerHTML = "";
        }
    });
    
    desChange.addEventListener('input', function(event) {
        if(event.target){
            document.querySelector(".des-changeBook-error").innerHTML = "";
        }
    });
    
    priceChange.addEventListener('input', function(event) {
        if(event.target){
            document.querySelector(".price-changeBook-error").innerHTML = "";
        }
    });
    
    quantityChange.addEventListener('input', function(event) {
        if(event.target){
            document.querySelector(".quantity-changeBook-error").innerHTML = "";
        }
    });
}
