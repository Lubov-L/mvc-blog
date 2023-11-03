function userDelete() {
    const deleteButtons = document.querySelectorAll(".delete-button");

    function handleClick(e) {
        e.preventDefault();

        let parentElement = this.closest("[data-id]");
        let dataIdValue = parentElement.getAttribute("data-id");
        let jsonData = {};

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
                        return true;
                    } else if (data.success === false) {
                        return false;
                    }
                }
            })
            .catch(error => {
                console.error("An error occurred:", error);
            });
    }

    deleteButtons.forEach(button => {
        button.addEventListener("click", handleClick);
    });
}