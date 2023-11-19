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

        const errorElement = document.querySelector('.' + key + ' p.error');
        if (errorElement) {
            errorElement.remove();
        }
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
                    window.location.href = "/login";
                } else if (data.success === false) {
                    data.errors.forEach((error) => {
                        let validationError = new ValidationError(error.field, error.error);

                        switch (error.field) {
                            case "name":
                                displayError(name, validationError.error);
                                break;
                            case "email":
                                displayError(email, validationError.error);
                                break;
                            case "password":
                                displayError(password, validationError.error);
                                break;
                            case "password2":
                                displayError(password2, validationError.error);
                                break;
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
    const existingErrors = element.querySelectorAll('p.error');
    existingErrors.forEach((error) => {
        error.remove();
    });

    const p = document.createElement("p");
    p.textContent = message;
    p.classList.add('error');
    element.appendChild(p);
}

function ValidationError(field, error) {
    this.field = field;
    this.error = error;
}
