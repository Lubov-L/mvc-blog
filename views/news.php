<?php
require_once __DIR__ . '/head.php';
?>
<?php
require_once __DIR__ . '/news-modal.php';
?>
<?php
require_once __DIR__ . '/header.php';
?>

<script src="/js/admin/news.js" async></script>
<script src="/js/main.js" async></script>

<div class="content">
    <div class="content__news">
        <?php if ($params['isAdmin'] ?? false) { ?>
            <a class="create-news" href="/news">create</a>
        <?php } ?>
        <div class="news__block" data-isAdmin="<?= $params['isAdmin'] ?? false; ?>"></div>
        <div id="pagination">
            <button id="prev-page">
            </button>
            <span id="current-page"></span>
            <button id="next-page"></button>
        </div>
    </div>
</div>