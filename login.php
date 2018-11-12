<?php
require './autoload.php';

if(isset($_SESSION['login_user'])){
    header('Location: index.php');
}
$q = '';

if(isset($_GET['q'])){
    $q = $_GET['q'];
}

include './templates/header.php';
?>


<div class="login">
    <form id="login_form" method="post" action="./loginProcess.php">
        <p class="warning-text">
        <?php
            echo (isset($_GET['error'])?$_GET['error']:'');
        ?>
        </p>
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
<script>

</script>

<?php
include './templates/footer.php';
?>