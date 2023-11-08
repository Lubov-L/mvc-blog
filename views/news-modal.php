<div class="wrapper hidden">
    <div class="back"></div>
    <form action="" method="post" class="modal_news">
        <a class="close-button"></a>
        <label class="name" for="news-title">Title</label>
        <input type="text" name="title" id="news-title">
        <label for="content">Context</label>
        <textarea id="content" name="content"></textarea>
        <div class="messages"></div>
        <button type="submit" class="save-news" onclick="createNews()">create</button>
    </form>
</div>
<div class="wrapper-delete hidden">
    <div class="back"></div>
    <div id="delete-modal">
        <div class="modal-content">
            <p>Are you sure you want to delete this news?</p>
        </div>
        <div class="modal-actions">
            <a href="#" id="confirm-delete">yes</a>
            <a href="#" id="cancel-delete">no</a>
        </div>
    </div>
</div>


