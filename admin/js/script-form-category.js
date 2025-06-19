const addCategorys = document.querySelectorAll('.js-add-category')
const modal = document.querySelector('.js-modal-addCategory')   
const modalAddClose = document.querySelector('.js-modal-addCategory-close')
const modalContainer = document.querySelector('.js-modal-addCategory-container')
const cancelCategorys = document.querySelectorAll('.js-cancel-category')

function showFormAddCategory(){
    modal.classList.add('open')
}

function hideFormAddCategory(){
    modal.classList.remove('open')
}

for(const addCategory of addCategorys){
    addCategory.addEventListener('click', showFormAddCategory)
}

for(const cancelCategory of cancelCategorys){
    cancelCategory.addEventListener('click', hideFormAddCategory)
}

modalAddClose.addEventListener('click', hideFormAddCategory)
modal.addEventListener('click', hideFormAddCategory)
modalContainer.addEventListener('click', function(){
    event.stopPropagation()
})

//Xóa thông báo lỗi form add author
let name = document.querySelector(".js-addCategory-name");

if(modal){
    name.addEventListener('input', function(event) {
        if(event.target){
            document.querySelector(".name-addCategory-error").innerHTML = "";
        }
    });
}

const categorys = document.querySelectorAll('.js-changeCategory')
const modalCategory = document.querySelector('.js-modal-category')
const modalCategoryClose = document.querySelector('.js-modalCategory-close')
const modalCategoryContainer = document.querySelector('.js-modalCategory-container')
const categoryName = document.querySelector('.js-category-name')
const cancelCategory = document.querySelector('.js-cancel-category')

function hideFormChangeCategory(){
    modalCategory.classList.add('hide-form-change')
}

if(modalCategory){
    modalCategoryClose.addEventListener('click', hideFormChangeCategory)
    modalCategory.addEventListener('click', hideFormChangeCategory)
    modalCategoryContainer.addEventListener('click', function(event){
        event.stopPropagation()
    })
    for(const cancelCategory of cancelCategorys){
        cancelCategory.addEventListener('click', hideFormChangeCategory)
    }
}

/*Bật tắt form xác nhận xóa*/
const deleteCategorys = document.querySelectorAll('.js-delete-category')
const modalCategoryDelete = document.querySelector('.js-modal-deleteCategory')   
const modalCategoryDeleteClose = document.querySelector('.js-modal-deleteCategory-close')
const modalCategoryDeleteContainer = document.querySelector('.js-modal-deleteCategory-container')
const modalCategoryDeleteChooseNo = document.querySelector('.js-category-btn-no')


function hideFormDeleteCategory(){
    modalCategoryDelete.classList.add('hide-form-delete')
}

if(modalCategoryDelete){
    modalCategoryDeleteClose.addEventListener('click', hideFormDeleteCategory)
    modalCategoryDelete.addEventListener('click', hideFormDeleteCategory)
    modalCategoryDeleteContainer.addEventListener('click', function(){
        event.stopPropagation()
    })
    modalCategoryDeleteChooseNo.addEventListener('click', hideFormDeleteCategory)
}

//Xóa thông báo lỗi form change author
let nameChangeCategory = document.querySelector(".js-category-name");
if(modalCategory){
    nameChangeCategory.addEventListener('input', function(event) {
        if(event.target){
            document.querySelector(".name-changeCategory-error").innerHTML = "";
        }
    });
}