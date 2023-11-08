window.addEventListener("load", async function () {
    const newsBlock = document.querySelector(".news__block");
    const prevButton = document.getElementById("prev-page");
    const nextButton = document.getElementById("next-page");
    const currentPageElement = document.getElementById("current-page");

    let countPage;
    let currentPage = 1;

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
            newsContent.textContent = item.content.length > 250
                ? item.content.slice(0, 80) + "..."
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

    function updateUI() {
        currentPageElement.textContent = String(currentPage);
        prevButton.disabled = currentPage === 1;
        nextButton.disabled = currentPage >= countPage;

        prevButton.classList.toggle("disabled-color", prevButton.disabled);
        nextButton.classList.toggle("disabled-color", nextButton.disabled);
    }

    prevButton.addEventListener("click", () => {
        if (currentPage > 1) {
            currentPage--;
            loadDataAndDisplay();
        }
    });

    nextButton.addEventListener("click", () => {
        if (currentPage < countPage) {
            currentPage++;
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
        updateUI();
        newsDelete();
    }

    await loadDataAndDisplay();
});

function newsDelete() {
    const deleteButtons = document.querySelectorAll(".delete-button");
    const wrapper = document.querySelector(".wrapper-delete");
    const deleteModal = document.getElementById("delete-modal");
    const confirmDeleteButton = document.getElementById("confirm-delete");
    const cancelDeleteButton = document.getElementById("cancel-delete");

    function handleClick(e) {
        e.preventDefault();

        const parentElement = this.closest("[data-id]");
        const dataIdValue = parentElement.getAttribute("data-id");

        wrapper.classList.remove("hidden");

        cancelDeleteButton.addEventListener("click", () => {
            wrapper.classList.add("hidden");
        });

        confirmDeleteButton.addEventListener("click", () => {
            const jsonData = {};
            let url = '/api/v1/news';

            jsonData["id"] = dataIdValue;

            let requestOptions = {
                method: "DELETE",
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
                    if (data) {
                        if (data.success === true) {
                            wrapper.classList.add("hidden");
                            location.reload();
                        } else if (data.success === false) {
                        }
                    }
                })
                .catch(error => {
                    console.error("An error occurred:", error);
                });
        });
    }

    deleteButtons.forEach(button => {
        button.addEventListener("click", handleClick);
    });
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
