<?php
require_once __DIR__ . '/head.php';
?>
<?php
require_once __DIR__ . '/header.php';
?>
<form action="/create-user" method="post" class="login__form">
    <label>
        <input type="text" name="name" placeholder="Enter your name">
    </label>
    <label>
        <input type="tel" name="phone" placeholder="Enter your phone">
    </label>
    <label>
        <input type="email" name="email" placeholder="Enter your email">
    </label>
    <label>
        <input type="password" name="password" placeholder="Create password">
    </label>
    <label>
        <input type="password" name="password2" placeholder="Repeat password">
    </label>
    <button type="submit">registration</button>
</form>
</body>
</html>