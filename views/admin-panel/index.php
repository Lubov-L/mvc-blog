<?php
require_once __DIR__ . '/../head.php';
?>
<?php
require_once __DIR__ . '/../header.php';
?>
<script src="/js/articles.js" async></script>
<script src="/js/content.js" async></script>

<div class="content">
    <div class="content__block">
        <div class="content__panel">
            <a href="#" class="content__panel-link link-active" data-target-id="0">
                Articles
            </a>
            <div class="line"></div>
            <a href="#" class="content__panel-link users_link" data-target-id="1">
                Users
            </a>
            <div class="line"></div>
            <a href="#" class="content__panel-link" data-target-id="2">
                News
            </a>
        </div>
        <div id="articles-container" class="content__main link-pane link-pane-show" data-id="0"></div>
        <div id="users-container" class="content__main link-pane" data-id="1">
            <a href="" class="left-arrow">left</a>
            <p class="page">page</p>
            <a href="" class="right-arrow">right</a>
        </div>
        <div id="news-container" class="content__main link-pane" data-id="2">news</div>
    </div>
</div>

<script src="/js/users.js" async></script>