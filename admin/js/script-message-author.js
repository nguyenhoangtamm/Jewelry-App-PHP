// Toast add function
function toastAddAuthorSuccess() {
    const main = document.getElementById("toast-addAuthor-success");
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
                            <p class="toast-msg">Add author successful!</p>
                        </div>
                        <div class="toast-close">
                            <i class="fas fa-times"></i>
                        </div>
                    `;
        main.appendChild(toast);
    }
}

function toastAddAuthorError() {
    const main = document.getElementById("toast-addAuthor-error");
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
                            <p class="toast-msg">Add author unsuccessful!</p>
                        </div>
                        <div class="toast-close">
                            <i class="fas fa-times"></i>
                        </div>
                    `;
        main.appendChild(toast);
    }
}

// Toast change function
function toastChangeAuthorSuccess() {
    const main = document.getElementById("toast-changeAuthor-success");
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
                            <p class="toast-msg">Change author information successful!</p>
                        </div>
                        <div class="toast-close">
                            <i class="fas fa-times"></i>
                        </div>
                    `;
        main.appendChild(toast);
    }
}

function toastChangeAuthorError() {
    const main = document.getElementById("toast-changeAuthor-error");
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
                            <p class="toast-msg">Change author information unsuccessful!</p>
                        </div>
                        <div class="toast-close">
                            <i class="fas fa-times"></i>
                        </div>
                    `;
        main.appendChild(toast);
    }
}

// Toast trùng tên
function toastNameAuthorError() {
    const main = document.getElementById("toast-changeNameAuthor-error");
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
                            <p class="toast-msg">Name author already exists!</p>
                        </div>
                        <div class="toast-close">
                            <i class="fas fa-times"></i>
                        </div>
                    `;
        main.appendChild(toast);
    }
}

// Toast delete function
function toastDeleteAuthorSuccess() {
    const main = document.getElementById("toast-deleteAuthor-success");
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
                            <p class="toast-msg">Delete author information successful!</p>
                        </div>
                        <div class="toast-close">
                            <i class="fas fa-times"></i>
                        </div>
                    `;
        main.appendChild(toast);
    }
}

function toastDeleteAuthorError() {
    const main = document.getElementById("toast-deleteAuthor-error");
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
                            <p class="toast-msg">Delete author information unsuccessful!</p>
                        </div>
                        <div class="toast-close">
                            <i class="fas fa-times"></i>
                        </div>
                    `;
        main.appendChild(toast);
    }
}