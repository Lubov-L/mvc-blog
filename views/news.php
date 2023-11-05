<?php
require_once __DIR__ . '/head.php';
?>
<?php
require_once __DIR__ . '/news-modal.php';
?>
<?php
require_once __DIR__ . '/header.php';
?>

<div class="content">
    <div class="content__news">
        <?php if ( $_SESSION['role'] === 'admin') { ?>
            <a class="create-news" href="/news">create</a>
        <?php } ?>
        <div class="news__block">

        </div>
    </div>
</div>