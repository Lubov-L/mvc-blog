<div class="header">
    <div class="header__nav">
        <a href="/">blog</a>
        <?php if (empty($_SESSION['userId'])) { ?>
            <div>
                <a class="nav__link" href="/login">login</a>
                <a class="nav__link" href="/registration">register</a>
            </div>
        <?php } else {
            ?>
            <div>
                <?php if ( $_SESSION['role'] === 'admin') { ?>
                    <a class="nav__link" href="/admin-panel">admin panel</a>
                <?php } ?>
                <a class="nav__link" href="/logout">logout</a>
            </div> <?php } ?>
    </div>
</div>