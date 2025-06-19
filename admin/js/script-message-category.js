// Toast add function
function toastAddCategorySuccess() {
    const main = document.getElementById("toast-addCategory-success");
    if (main) {
        const toast = document.createElement("div");

        // Auto remove toast
        const autoRemoveId = setTimeout(function () {
        main.removeChild(toast);
        }, 4000);

        // Remove toast when clicked
        toast.onclick = function (e) {
            if (e.target.closest(".toast-close")) {
                main.removeChild(toast);
                clearTimeout(autoRemoveId);
            }
        };

        const icons = {
        success: "fas fa-check-circle",
        info: "fas fa-info-circle",
        warning: "fas fa-exclamation-circle",
        error: "fas fa-exclamation-circle"
        };
        const icon = icons['success'];
        const delay = (3000 / 1000).toFixed(2);

        toast.classList.add("toast", "toast-success");
        toast.style.animation = `slideInLeft ease .4s, fadeOut linear 1s ${delay}s forwards`;

        toast.innerHTML = `
                        <div class="toast-icon">
                            <i class="success"></i>
                        </div>
                        <div class="toast-body">
                            <h3 class="toast-title">Success</h3>
                            <p class="toast-msg">Add category successful!</p>
                        </div>
                        <div class="toast-close">
                            <i class="fas fa-times"></i>
                        </div>
                    `;
        main.appendChild(toast);
    }
}

function toastAddCategoryError() {
    const main = document.getElementById("toast-addCategory-error");
    if (main) {
        const toast = document.createElement("div");

        // Auto remove toast
        const autoRemoveId = setTimeout(function () {
        main.removeChild(toast);
        }, 4000);

        // Remove toast when clicked
        toast.onclick = function (e) {
            if (e.target.closest(".toast-close")) {
                main.removeChild(toast);
                clearTimeout(autoRemoveId);
            }
        };

        const icons = {
        success: "fas fa-check-circle",
        info: "fas fa-info-circle",
        warning: "fas fa-exclamation-circle",
        error: "fas fa-exclamation-circle"
        };
        const icon = icons['error'];
        const delay = (3000 / 1000).toFixed(2);

        toast.classList.add("toast", "toast-error");
        toast.style.animation = `slideInLeft ease .4s, fadeOut linear 1s ${delay}s forwards`;

        toast.innerHTML = `
                        <div class="toast-icon">
                            <i class="error"></i>
                        </div>
                        <div class="toast-body">
                            <h3 class="toast-title">Error</h3>
                            <p class="toast-msg">Add category unsuccessful!</p>
                        </div>
                        <div class="toast-close">
                            <i class="fas fa-times"></i>
                        </div>
                    `;
        main.appendChild(toast);
    }
}

// Toast change function
function toastChangeCategorySuccess() {
    const main = document.getElementById("toast-changeCategory-success");
    if (main) {
        const toast = document.createElement("div");

        // Auto remove toast
        const autoRemoveId = setTimeout(function () {
        main.removeChild(toast);
        }, 4000);

        // Remove toast when clicked
        toast.onclick = function (e) {
            if (e.target.closest(".toast-close")) {
                main.removeChild(toast);
                clearTimeout(autoRemoveId);
            }
        };

        const icons = {
        success: "fas fa-check-circle",
        info: "fas fa-info-circle",
        warning: "fas fa-exclamation-circle",
        error: "fas fa-exclamation-circle"
        };
        const icon = icons['success'];
        const delay = (3000 / 1000).toFixed(2);

        toast.classList.add("toast", "toast-success");
        toast.style.animation = `slideInLeft ease .4s, fadeOut linear 1s ${delay}s forwards`;

        toast.innerHTML = `
                        <div class="toast-icon">
                            <i class="success"></i>
                        </div>
                        <div class="toast-body">
                            <h3 class="toast-title">Success</h3>
                            <p class="toast-msg">Change category information successful!</p>
                        </div>
                        <div class="toast-close">
                            <i class="fas fa-times"></i>
                        </div>
                    `;
        main.appendChild(toast);
    }
}

function toastChangeCategoryError() {
    const main = document.getElementById("toast-changeCategory-error");
    if (main) {
        const toast = document.createElement("div");

        // Auto remove toast
        const autoRemoveId = setTimeout(function () {
        main.removeChild(toast);
        }, 4000);

        // Remove toast when clicked
        toast.onclick = function (e) {
            if (e.target.closest(".toast-close")) {
                main.removeChild(toast);
                clearTimeout(autoRemoveId);
            }
        };

        const icons = {
        success: "fas fa-check-circle",
        info: "fas fa-info-circle",
        warning: "fas fa-exclamation-circle",
        error: "fas fa-exclamation-circle"
        };
        const icon = icons['error'];
        const delay = (3000 / 1000).toFixed(2);

        toast.classList.add("toast", "toast-error");
        toast.style.animation = `slideInLeft ease .4s, fadeOut linear 1s ${delay}s forwards`;

        toast.innerHTML = `
                        <div class="toast-icon">
                            <i class="error"></i>
                        </div>
                        <div class="toast-body">
                            <h3 class="toast-title">Error</h3>
                            <p class="toast-msg">Change category information unsuccessful!</p>
                        </div>
                        <div class="toast-close">
                            <i class="fas fa-times"></i>
                        </div>
                    `;
        main.appendChild(toast);
    }
}

// Toast trùng tên
function toastNameCategoryError() {
    const main = document.getElementById("toast-changeNameCategory-error");
    if (main) {
        const toast = document.createElement("div");

        // Auto remove toast
        const autoRemoveId = setTimeout(function () {
        main.removeChild(toast);
        }, 4000);

        // Remove toast when clicked
        toast.onclick = function (e) {
            if (e.target.closest(".toast-close")) {
                main.removeChild(toast);
                clearTimeout(autoRemoveId);
            }
        };

        const icons = {
        success: "fas fa-check-circle",
        info: "fas fa-info-circle",
        warning: "fas fa-exclamation-circle",
        error: "fas fa-exclamation-circle"
        };
        const icon = icons['error'];
        const delay = (3000 / 1000).toFixed(2);

        toast.classList.add("toast", "toast-error");
        toast.style.animation = `slideInLeft ease .4s, fadeOut linear 1s ${delay}s forwards`;

        toast.innerHTML = `
                        <div class="toast-icon">
                            <i class="error"></i>
                        </div>
                        <div class="toast-body">
                            <h3 class="toast-title">Error</h3>
                            <p class="toast-msg">Name category already exists!</p>
                        </div>
                        <div class="toast-close">
                            <i class="fas fa-times"></i>
                        </div>
                    `;
        main.appendChild(toast);
    }
}

// Toast delete function
function toastDeleteCategorySuccess() {
    const main = document.getElementById("toast-deleteCategory-success");
    if (main) {
        const toast = document.createElement("div");

        // Auto remove toast
        const autoRemoveId = setTimeout(function () {
        main.removeChild(toast);
        }, 4000);

        // Remove toast when clicked
        toast.onclick = function (e) {
            if (e.target.closest(".toast-close")) {
                main.removeChild(toast);
                clearTimeout(autoRemoveId);
            }
        };

        const icons = {
        success: "fas fa-check-circle",
        info: "fas fa-info-circle",
        warning: "fas fa-exclamation-circle",
        error: "fas fa-exclamation-circle"
        };
        const icon = icons['success'];
        const delay = (3000 / 1000).toFixed(2);

        toast.classList.add("toast", "toast-success");
        toast.style.animation = `slideInLeft ease .4s, fadeOut linear 1s ${delay}s forwards`;

        toast.innerHTML = `
                        <div class="toast-icon">
                            <i class="success"></i>
                        </div>
                        <div class="toast-body">
                            <h3 class="toast-title">Success</h3>
                            <p class="toast-msg">Delete category information successful!</p>
                        </div>
                        <div class="toast-close">
                            <i class="fas fa-times"></i>
                        </div>
                    `;
        main.appendChild(toast);
    }
}

function toastDeleteCategoryError() {
    const main = document.getElementById("toast-deleteCategory-error");
    if (main) {
        const toast = document.createElement("div");

        // Auto remove toast
        const autoRemoveId = setTimeout(function () {
        main.removeChild(toast);
        }, 4000);

        // Remove toast when clicked
        toast.onclick = function (e) {
            if (e.target.closest(".toast-close")) {
                main.removeChild(toast);
                clearTimeout(autoRemoveId);
            }
        };

        const icons = {
        success: "fas fa-check-circle",
        info: "fas fa-info-circle",
        warning: "fas fa-exclamation-circle",
        error: "fas fa-exclamation-circle"
        };
        const icon = icons['error'];
        const delay = (3000 / 1000).toFixed(2);

        toast.classList.add("toast", "toast-error");
        toast.style.animation = `slideInLeft ease .4s, fadeOut linear 1s ${delay}s forwards`;

        toast.innerHTML = `
                        <div class="toast-icon">
                            <i class="error"></i>
                        </div>
                        <div class="toast-body">
                            <h3 class="toast-title">Error</h3>
                            <p class="toast-msg">Delete category information unsuccessful!</p>
                        </div>
                        <div class="toast-close">
                            <i class="fas fa-times"></i>
                        </div>
                    `;
        main.appendChild(toast);
    }
}