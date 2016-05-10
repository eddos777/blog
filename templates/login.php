<?php require('header.php') ?>

<form action="?act=do-login" method="POST" class="well">
    <label>Login</label>
    <input name="login" />
    <label>Password</label>
    <input name="password" type="password"/>
    <div class="checkbox">
        <label>
            <input type="checkbox"> Remember me
        </label>
    </div>
    <button type="submit" class="btn btn-default">Sign in</button>

</form>

<?php require ('footer.php') ?>