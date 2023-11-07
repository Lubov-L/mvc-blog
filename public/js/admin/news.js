window.addEventListener("load", async function () {

    const newsBlock = document.querySelector(".news__block");

    async function loadData() {
        try {
            const response = await fetch(`/api/v1/news/list`);
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

            const dataValue = newsBlock.getAttribute("data-isadmin");

            newsElement.dataset.id = item.id;

            newsElement.classList.add("news-item");
            newsTop.classList.add("news-top");
            newsDate.classList.add("news-date");
            newsMore.classList.add("more-button");

            newsTitle.textContent = item.title;
            newsContent.textContent = item.content.length > 250
                ? item.content.slice(0, 250) + "..."
                : item.content;
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

                newsEdit.classList.add("edit-button");
                newsDelete.classList.add("delete-button");

                newsButtons.appendChild(newsEdit)
                newsButtons.appendChild(newsDelete);
                newsTop.appendChild(newsButtons);

                createNew();
            }
        });
    }
    async function loadDataAndDisplay() {
        const newsData = await loadData();
        displayNews(newsData.news);
    }

    await loadDataAndDisplay();
});

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
    }
}

function createNew() {
    document.querySelector(".create-news").addEventListener("click", async function (e) {
        e.preventDefault();

        const wrapperModal = document.querySelector(".wrapper");
        const backModal = document.querySelector(".back");
        const closeButton = document.querySelector(".close-button");

        function loadDataAndDisplay() {
            wrapperModal.classList.remove("hidden");
        }

        loadDataAndDisplay();

        function closeModal() {
            wrapperModal.classList.toggle("hidden");

            backModal.removeEventListener("click", closeModal);
            closeButton.removeEventListener("click", closeModal);
        }

        backModal.addEventListener("click", closeModal);
        closeButton.addEventListener("click", closeModal);
    });

    function createNews() {
        const modalNews = document.querySelector(".modal_news");
        if (modalNews) {
            modalNews.removeEventListener("submit", submitHandler);

            modalNews.addEventListener("submit", submitHandler);
        }
    }
}


function submitHandler(e) {
    e.preventDefault();

    let form = document.querySelector(".modal_news");
    let formData = new FormData(form);
    let jsonData = {};

    formData.forEach(function (value, key) {
        jsonData[key] = value;
    });

    let url = "/api/v1/create-news";

    let requestOptions = {
        method: "POST",
        headers: {
            "Content-Type": "application/json"
        },
        body: JSON.stringify(jsonData)
    };

    fetch(url, requestOptions)
        .then(response => {
            if (!response.ok) {
                throw new Error("An unexpected error occurred" + response.status);
            }
            return response.json();
        })
        .then(data => {
            if (data !== null) {
                if (data.success === true) {
                    showMessage("success", data.message);
                } else {
                    showMessage("error", data.message);
                }
            }
            showMessage("error", "Please fill the fields")
        })
        .catch(error => {
            showMessage("error", "Network error: " + error.message);
        });
}
