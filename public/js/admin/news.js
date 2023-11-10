/*
Удаление новости
 */
function newsDelete() {
    const deleteButtons = document.querySelectorAll(".delete-news-button");
    const wrapper = document.querySelector(".wrapper-delete");
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
                method: "DELETE", headers: {
                    "Content-Type": "application/json"
                }, body: JSON.stringify(jsonData)
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

/*
Создание новости
 */
function showCreateModal() {

    const wrapperModal = document.querySelector(".wrapper");
    const backModal = document.querySelector(".back");
    const closeButton = document.querySelector(".close-button");

    function closeModal() {
        wrapperModal.classList.toggle("hidden");
        backModal.removeEventListener("click", closeModal);
        closeButton.removeEventListener("click", closeModal);
        modalNews.reset();
        showMessage();
    }

    const modalNews = document.querySelector(".modal_news");
    if (modalNews) {
        modalNews.removeEventListener("submit", submitNews);
        modalNews.addEventListener("submit", submitNews);
    }

    document.querySelector(".create-news").addEventListener("click", async function (e) {
        e.preventDefault();

        function loadDataAndDisplay() {
            wrapperModal.classList.remove("hidden");
            showMessage();
        }

        loadDataAndDisplay();

        backModal.addEventListener("click", closeModal);
        closeButton.addEventListener("click", closeModal);
    });
}

function submitNews(e) {
    e.preventDefault();

    const wrapperModal = document.querySelector(".wrapper");

    let form = document.querySelector(".modal_news");
    let formData = new FormData(form);
    let jsonData = {};

    formData.forEach(function (value, key) {
        jsonData[key] = value;
    });

    let url = "/api/v1/create-news";

    let requestOptions = {
        method: "POST", headers: {
            "Content-Type": "application/json"
        }, body: JSON.stringify(jsonData)
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
                    wrapperModal.classList.toggle("hidden");
                    alert("Submit!");
                    form.reset();
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

/*
Редактированние новости
 */
function editNews() {
    const wrapper = document.querySelector(".wrapper-edit");
    const back = document.querySelector(".back-edit");
    const closeButton = document.querySelector(".edit-close-button");
    const editButton = document.querySelectorAll(".edit-news-button");
    const id = document.getElementById("edit-news-id");
    const title = document.getElementById("edit-news-title");
    const content = document.getElementById("edit-content");

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

            id.value = item.id
            title.value = item.title;
            content.value = item.content;
        }

        await loadDataAndDisplay();
    }

    editButton.forEach(button => {
        button.addEventListener("click", handleClick);
    });

    function closeModal() {
        wrapper.classList.toggle("hidden");
    }

    back.addEventListener("click", closeModal);
    closeButton.addEventListener("click", closeModal);
}

/*
Сохрание редактированной новости
 */
function saveEditedNews() {
    document.querySelector(".modal_edit").addEventListener("submit", async function (e) {
        e.preventDefault();

        const wrapperModal = document.querySelector(".wrapper-edit");

        let form = document.querySelector(".modal_edit");
        let formData = new FormData(form);
        let jsonData = {};

        formData.forEach(function (value, key) {
            jsonData[key] = value;
        });

        let url = "/api/v1/news";

        let requestOptions = {
            method: "PUT", headers: {
                "Content-Type": "application/json"
            }, body: JSON.stringify(jsonData)
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
                        showMessage("success", data.message);
                        alert("Successfully saved!")
                        wrapperModal.classList.toggle("hidden");
                    } else {
                        showMessage("error", data.message);
                    }
                }
            })
            .catch(error => {
                showMessage("error", "Failed to save:" + error.message);
            });
    });
}