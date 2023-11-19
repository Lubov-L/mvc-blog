window.addEventListener("load", async function () {

    const userList = document.getElementById("user-list");
    let countPage;
    let currentPage = 1;
    const paginationContainer = document.getElementById('pagination-container');

    async function loadData(page) {
        try {
            const response = await fetch(`/api/v1/users/list?page=${page}`);
            return await response.json();
        } catch (error) {
            console.error("Data error:", error);
        }
    }

    function displayUsers(users) {
        userList.innerHTML = "";
        users.forEach((user) => {
            const userElement = document.createElement("div");
            const userName = document.createElement("p");
            const userEmail = document.createElement("p");
            const userButtons = document.createElement("div");
            const userEdit = document.createElement("a");
            const userDelete = document.createElement("a");

            userElement.dataset.id = user.id;

            userEdit.classList.add("edit-button");
            userDelete.classList.add("delete-button");

            userName.textContent = user.name;
            userEmail.textContent = user.email;

            userElement.appendChild(userName);
            userElement.appendChild(userEmail);
            userButtons.appendChild(userEdit)
            userButtons.appendChild(userDelete);
            userElement.appendChild(userButtons);
            userList.appendChild(userElement);
        });
    }

    async function loadDataAndDisplay() {
        currentPage = getCurrentPage();

        const data = await loadData(currentPage);
        const responseObject = new ResponseObject();
        responseObject.page = data.page;
        responseObject.countPage = data.countPage;

        data.users.forEach(user => {
            const newUser = new User(user.id, user.name, user.email);
            responseObject.users.push(newUser);
        });

        const users = data.users;
        countPage = data.countPage;
        displayUsers(users);
        userEdit();
        userDelete();
        generatePagination(countPage, currentPage, paginationContainer, loadDataAndDisplay);
    }

    await loadDataAndDisplay();
});

function userEdit() {
    const wrapper = document.querySelector(".wrapper");
    const back = document.querySelector(".back");
    const closeButton = document.querySelector(".close-button");
    const editButton = document.querySelectorAll(".edit-button");
    const id = document.getElementById("user-id");
    const name = document.getElementById("user-name");
    const phone = document.getElementById("user-phone");
    const email = document.getElementById("user-email");

    async function handleClick(e) {
        e.preventDefault();

        let parentElement = this.closest("[data-id]");
        let dataIdValue = parentElement.getAttribute("data-id");

        async function loadData(dataIdValue) {
            try {
                const response = await fetch(`/api/v1/user?id=${dataIdValue}`);
                return await response.json();
            } catch (error) {
                console.error("Data error:", error);
            }
        }

        async function loadDataAndDisplay() {

            wrapper.classList.remove("hidden");

            const data = await loadData(dataIdValue);
            const user = data.user;

            id.value = user.id
            name.value = user.name;
            phone.value = user.phone;
            email.value = user.email;
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

function userDelete() {
    const deleteButtons = document.querySelectorAll(".delete-button");
    const confirmDeleteButton = document.getElementById("confirm-delete");
    const cancelDeleteButton = document.getElementById("cancel-delete");
    const wrapper = document.querySelector(".wrapper-delete");

    function handleClick(e) {
        e.preventDefault();

        wrapper.classList.remove("hidden");

        let parentElement = this.closest("[data-id]");
        let dataIdValue = parentElement.getAttribute("data-id");
        let jsonData = {};

        cancelDeleteButton.addEventListener("click", () => {
            wrapper.classList.add("hidden");
        });

        confirmDeleteButton.addEventListener("click", () => {
            let url = '/api/v1/user';

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
                            return false;
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

function save() {
    document.querySelector(".modal_form").addEventListener("submit", async function (e) {
        e.preventDefault();

        let form = document.querySelector(".modal_form");
        let formData = new FormData(form);
        let jsonData = {};

        formData.forEach(function (value, key) {
            jsonData[key] = value;
        });

        let url = "/api/v1/user";

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
                        location.reload();
                    } else {
                        showMessage("error", data.message);
                    }
                }
            })
            .catch(error => {
                showMessage("error", "Network error: " + error.message);
            });
    });
}

class User {
    constructor(id, name, email, phone = null) {
        this.id = id;
        this.name = name;
        this.email = email;
        this.phone = phone;
    }
}

class ResponseObject {
    constructor() {
        this.users = [];
        this.page = 0;
        this.countPage = 0;
    }
}