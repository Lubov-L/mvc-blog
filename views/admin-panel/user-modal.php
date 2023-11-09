<div class="wrapper hidden">
    <div class="back"></div>
    <form action="" method="post" class="modal_form">
        <a class="close-button"></a>
        <label class="id" for="id">
            <input type="text" name="id" id="user-id">
        </label>
        <label class="name" for="name">
            <input type="text" name="name" id="user-name">
        </label>
        <label for="phone">
            <input type="tel" name="phone" id="user-phone" pattern="^\+[1-9]\d{10}$">
        </label>
        <label class="email" for="email">
            <input type="email" name="email" id="user-email" required>
        </label>
        <div class="messages"></div>
        <button type="submit" class="save-button" onclick="save()">save</button>
    </form>
</div>