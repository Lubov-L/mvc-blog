<?php
require_once __DIR__ . '/head.php';
?>
<?php
require_once __DIR__ . '/header.php';
?>
<form action="/login" method="post" class="login__form">
    <p>Login</p>
    <label>
        <input type="email" name="email" placeholder="Enter email">
    </label>
    <label>
        <input type="password" name="password" placeholder="Enter your password">
    </label>
    <button>enter</button>
</form>
</body>
</html>