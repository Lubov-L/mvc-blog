document.querySelector(".signUp__form").addEventListener("submit", function (e) {
    const password = document.querySelector("input[name='password']").value;
    const password2 = document.querySelector("input[name='password2']").value;
    const login = document.querySelector('.login');

    if (password !== password2) {
        e.preventDefault();
        const p = document.createElement("p");
        p.textContent = "Passwords don't match";
        login.appendChild(p);

        document.querySelector('input[name="password"]').value = "";
        document.querySelector('input[name="password2"]').value = "";
    }
});
