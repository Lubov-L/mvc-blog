<?php
require_once __DIR__ . '/../head.php';
?>
<?php
require_once __DIR__ . '/../admin-panel/user-modal.php';
?>
<?php
require_once __DIR__ . '/../header.php';
?>

<script src="/js/admin/admin.js" async></script>

<div class="content">
    <div class="content__block">
        <div class="content__panel">
            <a href="#" class="content__panel-link" id="dashboard-link">
                Dashboard
            </a>
            <div class="line"></div>
            <a href="#" class="content__panel-link" id="users-link">
                Users
            </a>
        </div>
        <div class="content__main">
            <div class="dashboard">
                <h3>Statistics</h3>
                <div class="statistics">
                    <div class="count_users">
                        <img src="/images/users.jpg" alt="Users">
                        <p id="count_users"></p>
                        users
                    </div>
                    <div class="count_articles">
                        <img src="/images/articles.jpg" alt="Articles">
                        <p id="count_articles"></p>
                        articles
                    </div>
                    <div class="count_comments">
                        <img src="/images/comments.jpg" alt="Comments">
                        <p id="count_comments"></p>
                        comments
                    </div>
                    <div class="count_news">
                        <img src="/images/news.jpg" alt="News">
                        <p id="count_news"></p>
                        news
                    </div>
                </div>
            </div>
            <div class="users">
                <h3>USERS</h3>
                <div id="user-list"></div>
                <div id="pagination">
                    <button id="prev-page">
                    </button>
                    <span id="current-page"></span>
                    <button id="next-page"></button>
                </div>
            </div>
        </div>
    </div>
</div>

