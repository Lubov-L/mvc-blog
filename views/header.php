<div class="header">
    <div class="header__nav">
        <a href="/">blog</a>
        <div>
            <a class="nav__link" href="/news">news</a>
            <?php if (empty($_SESSION['userId'])) { ?>
                <a class="nav__link" href="/login">login</a>
                <a class="nav__link" href="/registration">register</a>
            <?php } else {
                ?>
                <?php if ($_SESSION['role'] === 'admin') { ?>
                    <a class="nav__link" href="/admin-panel">admin panel</a>
                <?php } ?>
                <a class="nav__link" href="/logout">logout</a>
            <?php } ?>
        </div>
    </div>
</div>