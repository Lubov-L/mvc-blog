document.querySelector(".users_link").addEventListener("click", async function (e) {
    e.preventDefault();

    let userList = document.getElementById("users-container");
    let left = document.querySelector(".left-arrow");
    let right = document.querySelector(".right-arrow");
    let page = document.querySelector(".page");

    let url = `/api/v1/users/list`;

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
                data.users.forEach(user => {
                    const userInf = document.createElement('div');
                    userInf.classList.add('user_inf');

                    const name = document.createElement('p');
                    name.textContent = user.name;

                    const email = document.createElement('p');
                    email.textContent = user.email;

                    userInf.appendChild(name);
                    userInf.appendChild(email);

                    userList.appendChild(userInf);
                });
                page.textContent = data.page;

                if (data.page <= 1) {
                    left.disabled = true;
                }
                left.href = "http://localhost/api/v1/users/list?page=" + (data.page - 1);

                if (data.page >= page) {
                    right.disabled = true;
                }
                right.href = "http://localhost/api/v1/users/list?page=" + (data.page + 1);
            })
        })
        .catch(error => {
            console.error("Error:", error);
        });
});