<?php
require_once __DIR__ . '/head.php';
?>
<?php
require_once __DIR__ . '/header.php';
?>
<script async src="/js/auth.js"></script>

<div class="unexpected_error hidden">An unexpected error occurred</div>
<form action="/login" method="post" class="login__form">
    <p>Login</p>
    <label class="auth_email" for="email">
        <input type="email" name="email" placeholder="Enter email" required>
    </label>
    <label class="auth_password" for="password">
        <input type="password" name="password" placeholder="Enter your password" required>
    </label>
    <button type="submit" class="login_button">enter</button>
</form>
</body>
</html>