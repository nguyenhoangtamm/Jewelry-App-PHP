function checkChangeCustomer(){
    let id = document.querySelector(".js-customer-id");
    let name = document.querySelector(".js-customer-name");
    let birthday = document.querySelector(".js-customer-birthday");
    let email = document.querySelector(".js-customer-email");
    let phone = document.querySelector(".js-customer-phone");
    let address = document.querySelector(".js-customer-address");
    let birthdayValue = birthday.value;
    let dateOfBirth = new Date(birthdayValue);
    let birthYear = dateOfBirth.getFullYear();
    let dateNow = new Date();
    let reSpecialName = /[`~!@#$%^&*()_+=?'":{}|<>\-;,./\\[\]]/g;
    let reSpecialAddress = /[`~!@#$%^&*()_+=?'":{}|<>\-;./\\[\]]/g;
    let reNum = /\d/;

    if(name.value.trim()===""){
        document.querySelector(".name-changeCustomer-error").innerHTML = "Please enter the customer name!";
        event.preventDefault();
    }
    else if(reSpecialName.test(name.value)){
        document.querySelector(".name-changeCustomer-error").innerHTML = "Name contains invalid characters!";
        event.preventDefault();
    }
    else if(reNum.test(name.value)){
        document.querySelector(".name-changeCustomer-error").innerHTML = "Name must be letters!";
        event.preventDefault();
    }

    if(dateNow.getFullYear() - parseInt(birthYear)<12){
        document.querySelector(".birthday-changeCustomer-error").innerHTML = "Only people 12 years of age and older can purchase!";
        event.preventDefault();
    }
    if(address.value.trim()===""){
        document.querySelector(".address-changeCustomer-error").innerHTML = "Please enter the customer address!";
        event.preventDefault();
    }
    else if(reSpecialAddress.test(address.value)){
        document.querySelector(".address-changeCustomer-error").innerHTML = "Address contains invalid characters!";
        event.preventDefault();
    }
    if(email.value.trim()===""){
        document.querySelector(".email-changeCustomer-error").innerHTML = "Please enter the customer email!";
        event.preventDefault();
    }
    else if(email.value.lastIndexOf('@gmail.com')===-1){
        document.querySelector(".email-changeCustomer-error").innerHTML = "Email must be gmail!";
        event.preventDefault();
    }

    if(phone.value.trim()===""){
        document.querySelector(".phone-changeCustomer-error").innerHTML = "Please enter the customer phone!";
        event.preventDefault();
    }
    else if(!reNum.test(phone.value)){
        document.querySelector(".phone-changeCustomer-error").innerHTML = "Phone must be numbers!";
        event.preventDefault();
    }
    else if(phone.value.length > 10){
        document.querySelector(".phone-changeCustomer-error").innerHTML = "The length exceeds 10 characters of the phone number!";
        event.preventDefault();
    }
}