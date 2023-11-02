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
                response.json().then(function (data) {
                    console.log(data);
                })
            });
    });
}