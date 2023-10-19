<?php
require_once __DIR__ . '/head.php';
?>
<?php
require_once __DIR__ . '/header.php';
?>
<script async src="/js/validate.js"></script>

<form action="/create-user" method="post" class="login__form">
    <p>Registration</p>
    <label>
        <input type="text" name="name" minlength="2" maxlength="32" pattern="[A-Za-z]+"
               placeholder="Enter your name" required>
    </label>
    <label>
        <input type="tel" name="phone" pattern="^\+[1-9]\d{10}$" placeholder="Enter your phone">
    </label>
    <label>
        <input type="email" name="email" placeholder="Enter your email" required>
    </label>
    <label>
        <input type="password" name="password" placeholder="Create password" required>
    </label>
    <label>
        <input type="password" name="password2" placeholder="Repeat password" data-password-match="password" required>
        <label class="invalid hidden">Passwords don't match</label>
    </label>
    <button type="submit">registration</button>
</form>
</body>
</html>