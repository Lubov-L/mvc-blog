document.querySelector(".signUp__form").addEventListener("submit", async function (e) {
    e.preventDefault();

    let form = document.querySelector(".signUp__form");
    let formData = new FormData(form);
    let jsonData = {};
    let email = document.querySelector('.email');
    let name = document.querySelector('.name');
    let password = document.querySelector('.password');
    let password2 = document.querySelector('.password2');
    let unexpectedError = document.querySelector('.unexpected_error');

    formData.forEach(function (value, key) {
        jsonData[key] = value;
    });

    let url = "/api/v1/registration";

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
            response.json().then(function (data) {

                if (data.success === true) {
                    window.location.href = "/";
                } else if (data.success === false) {
                    data.errors.forEach((error) => {
                        if (error.field === "name") {
                            displayError(name, error.error);
                        }
                        if (error.field === "email") {
                            displayError(email, error.error);
                        }
                        if (error.field === "password") {
                            displayError(password, error.error);
                        }
                        if (error.field === "password2") {
                            displayError(password2, error.error);
                        }
                    });
                } else {
                    form.classList.add('hidden');
                    unexpectedError.classList.remove('hidden');
                }
            })
        });
});

function displayError(element, message) {
    const p = document.createElement("p");
    p.textContent = message;
    element.appendChild(p);
}
