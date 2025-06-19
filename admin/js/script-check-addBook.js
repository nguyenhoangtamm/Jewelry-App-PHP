function checkAddBook(){
    let name = document.querySelector(".js-addBook-name");
    let des = document.querySelector(".js-addBook-description");
    let tags = document.querySelector(".js-addBook-tags");
    let img = document.querySelector(".js-addBook-img");
    let price = document.querySelector(".js-addBook-price");
    let quantity = document.querySelector(".js-addBook-quantity");
    if(name.value.trim()===""){
        document.querySelector(".name-addBook-error").innerHTML = "Please enter the book name!";
        event.preventDefault();
    }
    if(des.value.trim()===""){
        document.querySelector(".des-addBook-error").innerHTML = "Please enter the book description!";
        event.preventDefault();
    }
    if(tags.value.trim()===""){
        document.querySelector(".tags-addBook-error").innerHTML = "Please enter the book tags!";
        event.preventDefault();
    }
    if(img.files[0]===undefined){
        document.querySelector(".img-addBook-error").innerHTML = "Please upload the book image!";
        event.preventDefault();
    }
    if(price.value.trim()===""){
        document.querySelector(".price-addBook-error").innerHTML = "Please enter the book price!";
        event.preventDefault();
    }else if(price.value.includes(".")){
        document.querySelector(".price-addBook-error").innerHTML = "Book price must be an integer!";
    }
    if(quantity.value.trim()===""){
        document.querySelector(".quantity-addBook-error").innerHTML = "Please enter the book quantity!";
        event.preventDefault();
    }else if(quantity.value.includes(".")){
        document.querySelector(".quantity-addBook-error").innerHTML = "Book quantity must be an integer!";
    }
}

function checkChangeBook(){
    let name = document.querySelector(".js-changeBook-name");
    let des = document.querySelector(".js-changeBook-description");
    let tags = document.querySelector(".js-changeBook-tags");
    let img = document.querySelector(".js-changeBook-img");
    let price = document.querySelector(".js-changeBook-price");
    let quantity = document.querySelector(".js-changeBook-quantity");
    if(name.value.trim()===""){
        document.querySelector(".name-changeBook-error").innerHTML = "Please enter the book name!";
        event.preventDefault();
    }
    if(des.value.trim()===""){
        document.querySelector(".des-changeBook-error").innerHTML = "Please enter the book description!";
        event.preventDefault();
    }
    if(tags.value.trim()===""){
        document.querySelector(".tags-changeBook-error").innerHTML = "Please enter the book tags!";
        event.preventDefault();
    }
    // if(img.files[0]===undefined){
    //     document.querySelector(".img-changeBook-error").innerHTML = "Please upload the book image!";
    //     event.preventDefault();
    // }
    if(price.value.trim()===""){
        document.querySelector(".price-changeBook-error").innerHTML = "Please enter the book price!";
        event.preventDefault();
    }else if(price.value.includes(".")){
        document.querySelector(".price-changeBook-error").innerHTML = "Book price must be an integer!";
    }
    if(quantity.value.trim()===""){
        document.querySelector(".quantity-changeBook-error").innerHTML = "Please enter the book quantity!";
        event.preventDefault();
    }else if(quantity.value.includes(".")){
        document.querySelector(".quantity-changeBook-error").innerHTML = "Book quantity must be an integer!";
    }
}
