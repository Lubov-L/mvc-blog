<?php
require_once __DIR__ . '/head.php';
?>
<?php
require_once __DIR__ . '/header.php';
?>
<script async src="/js/validate.js"></script>
<script async src="/js/registration.js"></script>

<form action="/create-user" method="post" class="signUp__form">
    <p>Registration</p>
    <label class="name" for="name">
        <input type="text" name="name" minlength="2" maxlength="32" pattern="[A-Za-z]+"
               placeholder="Enter your name*" required>
    </label>
    <label for="phone">
        <input type="tel" name="phone" pattern="^\+[1-9]\d{10}$" placeholder="Enter your phone">
    </label>
    <label class="email" for="email">
        <input type="email" name="email" placeholder="Enter your email*" >
    </label>
    <label class="password" for="password">
        <input type="password" name="password" placeholder="Create password*" required>
    </label>
    <label class="password2" for="password2">
        <input type="password" name="password2" placeholder="Repeat password*" data-password-match="password" required>
    </label>
    <button type="submit">registration</button>
</form>
</body>
</html>