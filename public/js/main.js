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
