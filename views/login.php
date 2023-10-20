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
    <label>
        <input type="email" name="email" placeholder="Enter email">
    </label>
    <label>
        <input type="password" name="password" placeholder="Enter your password">
        <label class="invalid hidden">Invalid password or login</label>
    </label>
    <button type="submit" class="login_button">enter</button>
</form>
</body>
</html>