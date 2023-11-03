function userEdit() {
    const wrapper = document.querySelector(".wrapper");
    const modal = document.querySelector(".modal_form");
    const back = document.querySelector(".back");
    const closeButton = document.querySelector(".close-button");
    const editButton = document.querySelectorAll(".edit-button");
    const id = document.getElementById("user-id");
    const name = document.getElementById("user-name");
    const phone = document.getElementById("user-phone");
    const email = document.getElementById("user-email");

    async function handleClick(e) {
        e.preventDefault();

        let parentElement = this.closest("[data-id]");
        let dataIdValue = parentElement.getAttribute("data-id");

        async function loadData(dataIdValue) {
            try {
                const response = await fetch(`/api/v1/user?id=${dataIdValue}`);
                return await response.json();
            } catch (error) {
                console.error("Data error:", error);
            }
        }

        async function loadDataAndDisplay() {

            wrapper.classList.remove("hidden");
            modal.classList.remove("hidden");
            back.classList.remove("hidden");

            const data = await loadData(dataIdValue);
            const user = data.user;

            id.value = user.id
            name.value = user.name;
            phone.value = user.phone;
            email.value = user.email;
        }

        await loadDataAndDisplay();
    }

    editButton.forEach(button => {
        button.addEventListener("click", handleClick);
    });

    function closeModal() {
        wrapper.classList.toggle("hidden");
        back.classList.toggle("hidden");
    }

    back.addEventListener("click", closeModal);
    closeButton.addEventListener("click", closeModal);
}