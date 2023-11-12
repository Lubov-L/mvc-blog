// Выведение ошибок в модальных окнах
function showMessage(type, message) {
    let messageElement = document.createElement("div");
    messageElement.classList.add(type);
    messageElement.textContent = message;

    let messagesContainer = document.querySelector(".messages");
    while (messagesContainer.firstChild) {
        messagesContainer.removeChild(messagesContainer.firstChild);
    }

    messagesContainer.appendChild(messageElement);
}

// Получение номера текущей страницы
function getCurrentPage() {
    const storedPage = localStorage.getItem('currentPage');
    return storedPage ? parseInt(storedPage) : 1;
}

// Сохранение текущей страницы в localStorage
function saveCurrentPage(page) {
    localStorage.setItem('currentPage', page.toString());
}