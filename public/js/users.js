document.querySelector(".users_link").addEventListener("click", async function (e) {
    e.preventDefault();

    const userList = document.getElementById("user-list");
    const prevButton = document.getElementById("prev-page");
    const nextButton = document.getElementById("next-page");
    const currentPageElement = document.getElementById("current-page");

    let countPage;
    let currentPage = 1;

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

            userEdit.id = "edit-button";
            userDelete.id = "delete-button";

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

        data.users.forEach(user => {
            const newUser = new User(user.name, user.email);
            responseObject.users.push(newUser);
        });

        const users = data.users;
        countPage = data.countPage;
        displayUsers(users);
        updateUI();
    }

    await loadDataAndDisplay();
});

class User {
    constructor(name, email) {
        this.name = name;
        this.email = email;
    }
}

class ResponseObject {
    constructor() {
        this.users = [];
        this.page = 0;
        this.countPage = 0;
    }
}