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

function showMessage(type, message) {
    let messageElement = document.createElement("div");
    messageElement.classList.add(type);
    messageElement.textContent = message;

    let messagesContainer = document.querySelector(".messages");
    while (messagesContainer.firstChild) {
        messagesContainer.removeChild(messagesContainer.firstChild);
    }

    messagesContainer.appendChild(messageElement);
}