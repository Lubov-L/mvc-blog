<div class="wrapper">
    <form action="" method="post" class="modal_form">
        <label class="name" for="name">
            <input type="text" name="name" id="user-name" minlength="2" maxlength="32" pattern="[A-Za-z]+" required>
        </label>
        <label for="phone">
            <input type="tel" name="phone" id="user-phone" pattern="^\+[1-9]\d{10}$">
        </label>
        <label class="email" for="email">
            <input type="email" name="email" id="user-email" required>
        </label>
        <button type="submit" class="save-button">save</button>
    </form>
</div>