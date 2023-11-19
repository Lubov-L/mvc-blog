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
        generatePagination(countPage, currentPage, paginationContainer, loadDataAndDisplay);
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

class Item {
    constructor(id, title, content, publication_date) {
        this.id = id;
        this.title = title;
        this.content = content;
        this.publication_date = publication_date;
    }
}

class ResponseObject {
    constructor() {
        this.news = [];
        this.page = 0;
        this.countPage = 0;
    }
}