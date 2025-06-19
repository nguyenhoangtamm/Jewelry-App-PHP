const addAuthors = document.querySelectorAll('.js-add-author')
const modal = document.querySelector('.js-modal-addAuthor')   
const modalAddClose = document.querySelector('.js-modal-addAuthor-close')
const modalContainer = document.querySelector('.js-modal-addAuthor-container')
const cancelAuthors = document.querySelectorAll('.js-cancel-author')

function showFormAddAuthor(){
    modal.classList.add('open')
}

function hideFormAddAuthor(){
    modal.classList.remove('open')
}

for(const addAuthor of addAuthors){
    addAuthor.addEventListener('click', showFormAddAuthor)
}

for(const cancelAuthor of cancelAuthors){
    cancelAuthor.addEventListener('click', hideFormAddAuthor)
}

modalAddClose.addEventListener('click', hideFormAddAuthor)
modal.addEventListener('click', hideFormAddAuthor)
modalContainer.addEventListener('click', function(){
    event.stopPropagation()
})

//Xóa thông báo lỗi form add author
let name = document.querySelector(".js-addAuthor-name");

if(modal){
    name.addEventListener('input', function(event) {
        if(event.target){
            document.querySelector(".name-addAuthor-error").innerHTML = "";
        }
    });
}

const authors = document.querySelectorAll('.js-changeAuthor')
const modalAuthor = document.querySelector('.js-modal-author')
const modalAuthorClose = document.querySelector('.js-modalAuthor-close')
const modalAuthorContainer = document.querySelector('.js-modalAuthor-container')
const authorName = document.querySelector('.js-author-name')
const cancelAuthor = document.querySelector('.js-cancel-author')

function hideFormChangeAuthor(){
    modalAuthor.classList.add('hide-form-change')
}

if(modalAuthor){
    modalAuthorClose.addEventListener('click', hideFormChangeAuthor)
    modalAuthor.addEventListener('click', hideFormChangeAuthor)
    modalAuthorContainer.addEventListener('click', function(event){
        event.stopPropagation()
    })
    for(const cancelAuthor of cancelAuthors){
        cancelAuthor.addEventListener('click', hideFormChangeAuthor)
    }
}

/*Bật tắt form xác nhận xóa*/
const deleteAuthors = document.querySelectorAll('.js-delete-author')
const modalAuthorDelete = document.querySelector('.js-modal-deleteAuthor')   
const modalAuthorDeleteClose = document.querySelector('.js-modal-deleteAuthor-close')
const modalAuthorDeleteContainer = document.querySelector('.js-modal-deleteAuthor-container')
const modalAuthorDeleteChooseNo = document.querySelector('.js-author-btn-no')


function hideFormDeleteAuthor(){
    modalAuthorDelete.classList.add('hide-form-delete')
}

if(modalAuthorDelete){
    modalAuthorDeleteClose.addEventListener('click', hideFormDeleteAuthor)
    modalAuthorDelete.addEventListener('click', hideFormDeleteAuthor)
    modalAuthorDeleteContainer.addEventListener('click', function(){
        event.stopPropagation()
    })
    modalAuthorDeleteChooseNo.addEventListener('click', hideFormDeleteAuthor)
}

//Xóa thông báo lỗi form change author
let nameChangeAuthor = document.querySelector(".js-author-name");
if(modalAuthor){
    nameChangeAuthor.addEventListener('input', function(event) {
        if(event.target){
            document.querySelector(".name-changeAuthor-error").innerHTML = "";
        }
    });
}