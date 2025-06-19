//Toast Approve
function toastApproveSuccess() {
    const main = document.getElementById("toast-approve-success");
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
                            <p class="toast-msg">Approve order successful!</p>
                        </div>
                        <div class="toast-close">
                            <i class="fas fa-times"></i>
                        </div>
                    `;
        main.appendChild(toast);
    }
}

function toastApproveError() {
    const main = document.getElementById("toast-approve-error");
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
                            <p class="toast-msg">Approve order unsuccessful!</p>
                        </div>
                        <div class="toast-close">
                            <i class="fas fa-times"></i>
                        </div>
                    `;
        main.appendChild(toast);
    }
}

//Toast Cancelled
function toastCancelledSuccess() {
    const main = document.getElementById("toast-cancelled-success");
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
                            <p class="toast-msg">Cancelled order successful!</p>
                        </div>
                        <div class="toast-close">
                            <i class="fas fa-times"></i>
                        </div>
                    `;
        main.appendChild(toast);
    }
}

function toastCancelledError() {
    const main = document.getElementById("toast-cancelled-error");
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
                            <p class="toast-msg">Cancelled order unsuccessful!</p>
                        </div>
                        <div class="toast-close">
                            <i class="fas fa-times"></i>
                        </div>
                    `;
        main.appendChild(toast);
    }
}

//Toast Delete
function toastDeleteOrderSuccess() {
    const main = document.getElementById("toast-deleteOrder-success");
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
                            <p class="toast-msg">Delete order successful!</p>
                        </div>
                        <div class="toast-close">
                            <i class="fas fa-times"></i>
                        </div>
                    `;
        main.appendChild(toast);
    }
}

function toastDeleteOrderError() {
    const main = document.getElementById("toast-deleteOrder-error");
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
                            <p class="toast-msg">Delete order unsuccessful!</p>
                        </div>
                        <div class="toast-close">
                            <i class="fas fa-times"></i>
                        </div>
                    `;
        main.appendChild(toast);
    }
}

//Toast Complete
function toastCompleteOrderSuccess() {
    const main = document.getElementById("toast-completeOrder-success");
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
                            <p class="toast-msg">Complete order successful!</p>
                        </div>
                        <div class="toast-close">
                            <i class="fas fa-times"></i>
                        </div>
                    `;
        main.appendChild(toast);
    }
}

function toastCompleteOrderError() {
    const main = document.getElementById("toast-completeOrder-error");
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
                            <p class="toast-msg">Complete order unsuccessful!</p>
                        </div>
                        <div class="toast-close">
                            <i class="fas fa-times"></i>
                        </div>
                    `;
        main.appendChild(toast);
    }
}