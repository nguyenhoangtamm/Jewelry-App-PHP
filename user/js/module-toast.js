export const TYPE_SUCCESS = 'success';
export const TYPE_ERROR = 'error';
export const TYPE_WARNING = 'warning';
export const TYPE_INFO = 'info';

let toastElement = document.getElementById('toast');
function ToastMessage(type = TYPE_SUCCESS, title = '', message = '', duration = 3) {
    let toast = document.createElement('div');

    let clearToast = setTimeout(() => {
        toastElement.removeChild(toast);
    }, duration*1000 + 1400);

    toast.onclick = function (evt) {
        if (evt.target.closest('.toast__close')) {
            toastElement.removeChild(toast)
            clearTimeout(clearToast)
        }
    }

    let icons = {
        [TYPE_SUCCESS]: '<i class="bi bi-check-circle"></i>',
        [TYPE_ERROR]: '<i class="bi bi-x-circle"></i>',
        [TYPE_WARNING]: '<i class="bi bi-exclamation-triangle"></i>',
        [TYPE_INFO]: '<i class="bi bi-exclamation-circle-fill"></i>'
    }

    let iconType  = icons[type];

    toast.classList.add('toast', `toast-${type}`);
    toast.style.animation = `RightToLeft 0.4s ease, fadeOut 1s linear ${duration}s forwards`
    toast.innerHTML = `
        <div class="toast__icon">
            ${iconType}
        </div>
        <div class="toast__body">
            <h3 class="toast__title">${title}</h3>
            <p class="toast__message">${message}</p>
        </div>
        <div class="toast__close">
            <i class="bi bi-x-lg"></i>
        </div>
        `
    toastElement.appendChild(toast);
}

export default ToastMessage;

