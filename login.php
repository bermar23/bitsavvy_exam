<?php
require './autoload.php';

include './templates/header.php';
?>

<div class="login">
    <form id="login_form" method="post">
        <div class="controls">
            <label>Username</label>
            <input type="text" name="username"/>
        </div>
        <div class="controls">
            <label>Password</label>
            <input type="password" name="password"/>
        </div>
        <div class="controls">
            <input type="submit" value="Login"/>
        </div>
    </form>
</div>

<?php
include './templates/footer.php';
?>