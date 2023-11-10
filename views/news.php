<?php
require_once __DIR__ . '/head.php';
?>
<?php
require_once __DIR__ . '/news-modal.php';
?>
<?php
require_once __DIR__ . '/header.php';
?>

<script src="/js/news.js" async></script>
<script src="/js/main.js" async></script>
<script src="/js/news-constructor.js" async></script>

<?php if ($params['admin'] ?? false) { ?>
    <script src="/js/admin/news.js" async></script>
<?php } ?>

<div class="content">
    <div class="content__news">
        <?php if ($params['admin'] ?? false) { ?>
            <a class="create-news" href="/news">create</a>
        <?php } ?>
        <div class="news__block" data-admin="<?= $params['admin'] ?? false; ?>"></div>
        <div id="pagination-container"></div>
    </div>
</div>
