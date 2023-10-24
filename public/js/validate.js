function checkPasswordMatch() {
    const password = document.querySelector("input[name='password']").value;
    const password2 = document.querySelector("input[name='password2']").value;
    const password_match = document.querySelector('.password2');
    const existingError = password_match.querySelector("p");

    if (password !== password2) {
        if (existingError) {
            existingError.textContent = "Passwords don't match";
        } else {
            const p = document.createElement("p");
            p.textContent = "Passwords don't match";
            password_match.appendChild(p);
        }

        document.querySelector('input[name="password"]').value = "";
        document.querySelector('input[name="password2"]').value = "";
        return false;
    }
    return true;
}