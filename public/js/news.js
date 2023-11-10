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
            newsContent.textContent = item.content.length > 250 ? item.content.slice(0, 80) + "..." : item.content;
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

    paginationContainer.addEventListener('click', function (event) {
        if (event.target.classList.contains('pagination-item') && !event.target.classList.contains('disabled')) {
            currentPage = parseInt(event.target.textContent);
            loadDataAndDisplay();
        }
    });

    async function loadDataAndDisplay() {
        const data = await loadData(currentPage);
        const responseObject = new ResponseObject();
        responseObject.page = data.page;
        responseObject.countPage = data.countPage;

        countPage = data.countPage;
        displayNews(data.news);
        showCreateModal();
        newsDelete();
        editNews();
        saveEditedNews();
        generatePagination();
    }

    await loadDataAndDisplay(currentPage);
});