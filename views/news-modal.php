<!--Модальное окно для создания новостей-->
<div class="wrapper hidden">
    <div class="back"></div>
    <form action="" method="post" class="modal_news">
        <a class="close-button"></a>
        <label for="news-id" class="news-id" hidden="hidden">
            <input type="text" id="news-id" name="id">
        </label>
        <label class="name" for="news-title">Title</label>
        <input type="text" name="title" id="news-title">
        <label for="content">Content</label>
        <textarea id="content" name="content" placeholder="Minimum 500 characters long"></textarea>
        <div class="messages"></div>
        <button type="submit" class="submit-button">create</button>
    </form>
</div>
<!--Модальное окно для редактирования новостей-->
<div class="wrapper-edit hidden">
    <div class="back-edit"></div>
    <form action="" method="post" class="modal_edit">
        <a class="edit-close-button"></a>
        <label for="edit-news-id" class="news-id" hidden="hidden">
            <input type="text" id="edit-news-id" name="id">
        </label>
        <label class="name" for="edit-news-title">Title</label>
        <input type="text" name="title" id="edit-news-title">
        <label for="edit-content">Content</label>
        <textarea id="edit-content" name="content" placeholder="Minimum 500 characters long"></textarea>
        <div class="messages"></div>
        <button type="submit" class="save-button">save</button>
    </form>
</div>
<!--Модальное окно для подтверждения удаления новости-->
<div class="wrapper-delete hidden">
    <div class="back-delete"></div>
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

