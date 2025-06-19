const customers = document.querySelectorAll('.js-changeCustomer')
const modalCustomer = document.querySelector('.js-modal-customer')
const modalCustomerClose = document.querySelector('.js-modalCustomer-close')
const modalCustomerContainer = document.querySelector('.js-modalCustomer-container')
const customerName = document.querySelector('.js-customer-name')
const customerAddress = document.querySelector('.js-customer-address')
const customerEmail = document.querySelector('.js-customer-email')
const customerPhone = document.querySelector('.js-customer-phone')
const cancelCustomer = document.querySelector('.js-cancel-customer')

function hideFormChangeCustomer(){
    modalCustomer.classList.add('hide-form-change')
}

if(modalCustomer){
    modalCustomerClose.addEventListener('click', hideFormChangeCustomer)
    modalCustomer.addEventListener('click', hideFormChangeCustomer)
    modalCustomerContainer.addEventListener('click', function(event){
        event.stopPropagation()
    })
    cancelCustomer.addEventListener('click', hideFormChangeCustomer)
}

/*Bật tắt form xác nhận xóa*/
const deleteCustomers = document.querySelectorAll('.js-delete-customer')
const modalCustomerDelete = document.querySelector('.js-modal-deleteCustomer')   
const modalCustomerDeleteClose = document.querySelector('.js-modal-deleteCustomer-close')
const modalCustomerDeleteContainer = document.querySelector('.js-modal-deleteCustomer-container')
const modalCustomerDeleteChooseYes = document.querySelector('.js-customer-btn-yes')
const modalCustomerDeleteChooseNo = document.querySelector('.js-customer-btn-no')


function hideFormDeleteCustomer(){
    modalCustomerDelete.classList.add('hide-form-delete')
}

if(modalCustomerDelete){
    modalCustomerDeleteClose.addEventListener('click', hideFormDeleteCustomer)
    modalCustomerDelete.addEventListener('click', hideFormDeleteCustomer)
    modalCustomerDeleteContainer.addEventListener('click', function(){
        event.stopPropagation()
    })
    modalCustomerDeleteChooseNo.addEventListener('click', hideFormDeleteCustomer)
}

//Xóa thông báo lỗi form change customer
let nameChangeCustomer = document.querySelector(".js-customer-name");
let birthdayChangeCustomer = document.querySelector(".js-customer-birthday");
let emailChangeCustomer = document.querySelector(".js-customer-email");
let phoneChangeCustomer = document.querySelector(".js-customer-phone");
let addressChangeCustomer = document.querySelector(".js-customer-address");

if(modalCustomer){
    nameChangeCustomer.addEventListener('input', function(event) {
        if(event.target){
            document.querySelector(".name-changeCustomer-error").innerHTML = "";
        }
    });

    birthdayChangeCustomer.addEventListener('click', function(event) {
        if(event.target){
            document.querySelector(".birthday-changeCustomer-error").innerHTML = "";
        }
    });
    
    emailChangeCustomer.addEventListener('input', function(event) {
        if(event.target){
            document.querySelector(".email-changeCustomer-error").innerHTML = "";
        }
    });
    
    phoneChangeCustomer.addEventListener('input', function(event) {
        if(event.target){
            document.querySelector(".phone-changeCustomer-error").innerHTML = "";
        }
    });
    
    addressChangeCustomer.addEventListener('input', function(event) {
        if(event.target){
            document.querySelector(".address-changeCustomer-error").innerHTML = "";
        }
    });
}