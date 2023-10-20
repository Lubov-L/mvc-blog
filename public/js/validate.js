document.querySelector(".signUp__form").addEventListener("submit", function (e) {
    const password = document.querySelector("input[name='password']").value;
    const password2 = document.querySelector("input[name='password2']").value;

    if (password !== password2) {
        e.preventDefault();
        let error = document.querySelector('.invalid');
        error.classList.remove('hidden');

        document.querySelector('input[name="password"]').value = "";
        document.querySelector('input[name="password2"]').value = "";
    }
});
