document.querySelector(".login__form").addEventListener("submit", async function (e) {
    e.preventDefault();

    let form = document.querySelector(".login__form");
    let formData = new FormData(form);
    let jsonData = {};

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
                } else if (data.success === false && data.error) {
                    console.log("Invalid login or password");
                } else {
                    console.log("An unexpected error occurred");
                }
            })
        });
});
