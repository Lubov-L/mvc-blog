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

// Пагинация
function generatePagination(countPage, currentPage, paginationContainer, callback) {
    paginationContainer.innerHTML = '';

    if (countPage > 3) {
        if (currentPage > 2) {
            const firstPage = document.createElement('button');
            const prevEllipsis = document.createElement('a');

            firstPage.classList.add('pagination-item');
            prevEllipsis.classList.add('pagination-dot', 'disabled');
            prevEllipsis.textContent = '...';
            firstPage.textContent = '1';
            paginationContainer.appendChild(firstPage);
            paginationContainer.appendChild(prevEllipsis);
        }

        if (currentPage <= countPage - 2) {
            const nextEllipsis = document.createElement('a');
            const lastPage = document.createElement('button');

            for (let i = Math.max(1, currentPage - 1); i <= Math.min(countPage, currentPage + 1); i++) {
                const paginationItem = document.createElement('button');
                paginationItem.classList.add('pagination-item');
                if (i === currentPage) {
                    paginationItem.classList.add('active-pagination');
                }
                paginationItem.textContent = i.toString();
                paginationContainer.appendChild(paginationItem);
            }
            nextEllipsis.classList.add('pagination-dot', 'disabled');
            paginationContainer.appendChild(nextEllipsis);
            nextEllipsis.textContent = '...';

            lastPage.classList.add('pagination-item');
            lastPage.textContent = countPage;
            paginationContainer.appendChild(lastPage);
        } else {
            for (let i = Math.max(1, countPage - 2); i <= countPage; i++) {
                const paginationItem = document.createElement('button');
                paginationItem.classList.add('pagination-item');
                if (i === currentPage) {
                    paginationItem.classList.add('active-pagination');
                }
                paginationItem.textContent = i.toString();
                paginationContainer.appendChild(paginationItem);
            }
        }
    } else {
        // Если количество страниц меньше или равно 3, создавать ... не нужно
        for (let i = 1; i <= countPage; i++) {
            const paginationItem = document.createElement('button');
            paginationItem.classList.add('pagination-item');
            if (i === currentPage) {
                paginationItem.classList.add('active-pagination');
            }
            paginationItem.textContent = i.toString();
            paginationContainer.appendChild(paginationItem);
        }
    }

    function handlePaginationClick(event) {
        if (event.target.classList.contains('pagination-item') && !event.target.classList.contains('disabled')) {
            currentPage = parseInt(event.target.textContent);
            saveCurrentPage(currentPage);
            window.scrollTo(0, 0);
            callback();
        }
    }

    paginationContainer.addEventListener('click', handlePaginationClick);
}