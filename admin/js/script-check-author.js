function checkAddAuthor(){
    //let reSpecial = /[`~!@#$%^&*()_+=?'":{}|<>-]/g;
    let reSpecial = /[`~!@#$%^&*()_+=?'":{}|<>\-;,./\\[\]]/g;
    let reNum = /\d/;
    let name = document.querySelector(".js-addAuthor-name");
    if(name.value.trim()===""){
        document.querySelector(".name-addAuthor-error").innerHTML = "Please enter the author name!";
        event.preventDefault();
    }else if(reSpecial.test(name.value)){
        document.querySelector(".name-addAuthor-error").innerHTML = "Name contains invalid characters!";
        event.preventDefault();
    }
    else if(reNum.test(name.value)){
        document.querySelector(".name-addAuthor-error").innerHTML = "Name must be letters!";
        event.preventDefault();
    }
}

function checkChangeAuthor(){
    let id = document.querySelector(".js-author-id");
    let name = document.querySelector(".js-author-name");
    let reSpecialName = /[`~!@#$%^&*()_+=?'":{}|<>\-;,./\\[\]]/g;
    let reNum = /\d/;

    if(name.value.trim()===""){
        document.querySelector(".name-changeAuthor-error").innerHTML = "Please enter the author name!";
        event.preventDefault();
    }
    else if(reSpecialName.test(name.value)){
        document.querySelector(".name-changeAuthor-error").innerHTML = "Name contains invalid characters!";
        event.preventDefault();
    }
    else if(reNum.test(name.value)){
        document.querySelector(".name-changeAuthor-error").innerHTML = "Name must be letters!";
        event.preventDefault();
    }
}