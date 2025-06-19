function checkAddCategory(){
    //let reSpecial = /[`~!@#$%^&*()_+=?'":{}|<>-]/g;
    let reSpecial = /[`~!@#$%^&*()_+=?'":{}|<>\-;,./\\[\]]/g;
    let reNum = /\d/;
    let name = document.querySelector(".js-addCategory-name");
    if(name.value.trim()===""){
        document.querySelector(".name-addCategory-error").innerHTML = "Please enter the category name!";
        event.preventDefault();
    }else if(reSpecial.test(name.value)){
        document.querySelector(".name-addCategory-error").innerHTML = "Name contains invalid characters!";
        event.preventDefault();
    }
    else if(reNum.test(name.value)){
        document.querySelector(".name-addCategory-error").innerHTML = "Name must be letters!";
        event.preventDefault();
    }
}

function checkChangeCategory(){
    let id = document.querySelector(".js-category-id");
    let name = document.querySelector(".js-category-name");
    let reSpecialName = /[`~!@#$%^&*()_+=?'":{}|<>\-;,./\\[\]]/g;
    let reNum = /\d/;

    if(name.value.trim()===""){
        document.querySelector(".name-changeCategory-error").innerHTML = "Please enter the category name!";
        event.preventDefault();
    }
    else if(reSpecialName.test(name.value)){
        document.querySelector(".name-changeCategory-error").innerHTML = "Name contains invalid characters!";
        event.preventDefault();
    }
    else if(reNum.test(name.value)){
        document.querySelector(".name-changeCategory-error").innerHTML = "Name must be letters!";
        event.preventDefault();
    }
}