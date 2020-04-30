<?php require_once "inc/header.php"?>

        <div class="flash">
        <?php if(isset($_SESSION['flash'])):?>
            <p><?=$_SESSION['flash']=='success'?'SUCCESS':'FAILURE'?></p>
        <?php unset($_SESSION['flash'])?>
        <?php endif ?>
        </div>

        <form class="form-signin" style="width:60%;margin:auto;" method="POST" action="/login">
            <h1 class="h3 mb-3 font-weight-normal">Пожалуйста войдите</h1>
            <label for="username">Login</label>
            <input class="form-control" placeholder="Логин" type="text" name="username" id="username" required>
            <label for="password">Password</label>
            <input class="form-control" placeholder="Пароль" type="password" name="password" id="password" required>
            <input class="btn mt-4 btn-lg btn-primary btn-block" type="submit" value="Submit">
        </form>
<?php require_once "inc/footer.php"?>