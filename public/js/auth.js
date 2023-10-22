document.querySelector(".login__form").addEventListener("submit", async function (e) {
    e.preventDefault();

    let form = document.querySelector(".login__form");
    let formData = new FormData(form);
    let jsonData = {};
    let login = document.querySelector('.login');
    let unexpectedError = document.querySelector('.unexpected_error');

    formData.forEach(function (value, key) {
        jsonData[key] = value;
    });

    let url = "/api/v1/login";

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
            response.json().then(function (data) {
                if (data.success === true) {
                    window.location.href = "/";
                } else if (data.success === false) {
                    const p = document.createElement("p");
                    p.textContent = data.error;
                    login.appendChild(p);
                } else {
                    form.classList.add('hidden');
                    unexpectedError.classList.remove('hidden');
                }
            })
        });
});
