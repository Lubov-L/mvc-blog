window.addEventListener("load", async function () {
    const newsBlock = document.querySelector(".news__block");
    let countPage;
    let currentPage = 1;
    const paginationContainer = document.getElementById('pagination-container');

    async function loadData(page) {
        try {
            const response = await fetch(`/api/v1/news/list?page=${page}`);
            return await response.json();
        } catch (error) {
            console.error("Data error:", error);
        }
    }

    function displayNews(news) {
        newsBlock.innerHTML = "";
        news.forEach((item) => {
            const newsElement = document.createElement("div");
            const newsTop = document.createElement("div");
            const newsDown = document.createElement("div");
            const newsTitle = document.createElement("h4");
            const newsContent = document.createElement("p");
            const newsDate = document.createElement("p");
            const newsMore = document.createElement("a");

            const dataValue = newsBlock.getAttribute("data-admin");

            newsElement.dataset.id = item.id;

            newsElement.classList.add("news-item");
            newsTop.classList.add("news-top");
            newsDate.classList.add("news-date");
            newsMore.classList.add("more-button");

            newsTitle.textContent = item.title;
            newsContent.textContent = item.content.length > 150 ? item.content.slice(0, 150) + "..." : item.content;
            newsDate.textContent = item.publication_date;
            newsMore.textContent = "read more";

            newsTop.appendChild(newsTitle);
            newsElement.appendChild(newsTop);
            newsElement.appendChild(newsContent);
            newsDown.appendChild(newsDate);
            newsDown.appendChild(newsMore);
            newsElement.appendChild(newsDown);
            newsBlock.appendChild(newsElement);

            if (dataValue) {
                const newsButtons = document.createElement("div");
                const newsEdit = document.createElement("a");
                const newsDelete = document.createElement("a");

                newsEdit.classList.add("edit-news-button");
                newsDelete.classList.add("delete-news-button");

                newsButtons.appendChild(newsEdit)
                newsButtons.appendChild(newsDelete);
                newsTop.appendChild(newsButtons);
            }
        });
    }

    function generatePagination() {
        paginationContainer.innerHTML = '';

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

    paginationContainer.addEventListener('click', function (event) {
        if (event.target.classList.contains('pagination-item') && !event.target.classList.contains('disabled')) {
            currentPage = parseInt(event.target.textContent);
            saveCurrentPage(currentPage); // Сохранение страницы в localStorage
            window.scrollTo(0, 0);
            loadDataAndDisplay();
        }
    });

    async function loadDataAndDisplay() {
        currentPage = getCurrentPage();

        const data = await loadData(currentPage);
        const responseObject = new ResponseObject();
        responseObject.page = data.page;
        responseObject.countPage = data.countPage;
        countPage = data.countPage;

        displayNews(data.news);
        readNews();
        showCreateModal();
        newsDelete();
        editNews();
        saveEditedNews();
        generatePagination();
    }

    await loadDataAndDisplay(currentPage);
});

/*
* Чтение статьи
*/
function readNews() {
    const readButton = document.querySelectorAll(".more-button");
    const wrapper = document.querySelector(".wrapper-read");
    const back = document.querySelector(".back-read");
    const closeButton = document.querySelector(".close-button");
    const id = document.querySelector(".read-id");
    const title = document.querySelector(".read-title");
    const content = document.querySelector(".read-text");
    const date = document.querySelector(".read-date");

    async function handleClick(e) {
        e.preventDefault();

        let parentElement = this.closest("[data-id]");
        let dataIdValue = parentElement.getAttribute("data-id");

        async function loadData(dataIdValue) {
            try {
                const response = await fetch(`/api/v1/news?id=${dataIdValue}`);
                return await response.json();
            } catch (error) {
                console.error("Data error:", error);
            }
        }

        async function loadDataAndDisplay() {
            wrapper.classList.remove("hidden");

            const data = await loadData(dataIdValue);
            const item = data.news;

            console.log(item);
            id.textContent = item.id
            title.textContent = item.title;
            content.textContent = item.content;
            date.textContent = item.publication_date;
        }

        await loadDataAndDisplay();
    }

    readButton.forEach(button => {
        button.addEventListener("click", handleClick);
    });

    function closeModal() {
        wrapper.classList.toggle("hidden");
    }

    back.addEventListener("click", closeModal);
    closeButton.addEventListener("click", closeModal);
}