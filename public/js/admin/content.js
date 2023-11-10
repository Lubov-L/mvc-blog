window.addEventListener("load", function () {
    const dashboardLink = document.getElementById("dashboard-link");
    const usersLink = document.getElementById("users-link");
    const dashboardBlock = document.querySelector(".dashboard");
    const usersBlock = document.querySelector(".users");

    dashboardLink.addEventListener("click", function (e) {
        e.preventDefault();
        dashboardBlock.style.display = "block";
        usersBlock.style.display = "none";
    });

    usersLink.addEventListener("click", function (e) {
        e.preventDefault();
        dashboardBlock.style.display = "none";
        usersBlock.style.display = "block";
    });
});

window.addEventListener("load", async function () {
    const countUsers = document.getElementById('count_users');
    const countNews = document.getElementById('count_news');

    let url = "/api/v1/admin/stat";

    let requestOptions = {
        method: "GET",
        headers: {
            "Content-Type": "application/json"
        }
    };

    fetch(url, requestOptions)
        .then(response => {
            if (!response.ok) {
                throw new Error("An unexpected error occurred" + response.status);
            }
            response.json().then(function (data) {
                countUsers.textContent = data.users;
                countNews.textContent = data.news;
            })
        });
});