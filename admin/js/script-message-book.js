// Toast add function
function toastAddSuccess() {
    const main = document.getElementById("toast-add-success");
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
                            <p class="toast-msg">Add book successful!</p>
                        </div>
                        <div class="toast-close">
                            <i class="fas fa-times"></i>
                        </div>
                    `;
        main.appendChild(toast);
    }
}

function toastAddError() {
    const main = document.getElementById("toast-add-error");
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
                            <p class="toast-msg">Add book unsuccessful!</p>
                        </div>
                        <div class="toast-close">
                            <i class="fas fa-times"></i>
                        </div>
                    `;
        main.appendChild(toast);
    }
}

// Toast delete function
function toastDeleteSuccess() {
    const main = document.getElementById("toast-delete-success");
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
                            <p class="toast-msg">Delete book successful!</p>
                        </div>
                        <div class="toast-close">
                            <i class="fas fa-times"></i>
                        </div>
                    `;
        main.appendChild(toast);
    }
}

function toastDeleteError() {
    const main = document.getElementById("toast-delete-error");
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
                            <p class="toast-msg">Delete book unsuccessful!</p>
                        </div>
                        <div class="toast-close">
                            <i class="fas fa-times"></i>
                        </div>
                    `;
        main.appendChild(toast);
    }
}

// Toast change function
function toastChangeSuccess() {
    const main = document.getElementById("toast-change-success");
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
                            <p class="toast-msg">Change book information successful!</p>
                        </div>
                        <div class="toast-close">
                            <i class="fas fa-times"></i>
                        </div>
                    `;
        main.appendChild(toast);
    }
}

function toastChangeError() {
    const main = document.getElementById("toast-change-error");
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
                            <p class="toast-msg">Change book information unsuccessful!</p>
                        </div>
                        <div class="toast-close">
                            <i class="fas fa-times"></i>
                        </div>
                    `;
        main.appendChild(toast);
    }
}