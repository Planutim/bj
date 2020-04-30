<?php require 'inc/header.php'?>

        <?php if(isset($_SESSION['flash'])):?>
            <p><?=$_SESSION['flash']=='success'?'SUCCESS':'FAILURE'?></p>
        <?php unset($_SESSION['flash'])?>
        <?php endif ?>
    <form class="form" method="POST" action="/edit">
            <input class="form-control" type="hidden" name='id' value="<?=htmlspecialchars($data['id'])?>">
            <div class='form-group'>
                <label for="username">Username</label>
                <input class="form-control" type="text" id='username' name="username" value="<?=htmlspecialchars($data['username'])?>" required>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input class="form-control" type="email" id='email' name="email" value="<?=htmlspecialchars($data['email'])?>" required>
            </div>
            <div class="form-group">
                <label for="textbody">Text</label>
                <textarea rows="10" class="form-control" id='textbody' name="textbody" required><?=htmlspecialchars($data['textbody'])?></textarea>
        </div>
            <div class="form-check">
                <input type="hidden" name="status" value="0">
                <input class="form-check-input" type="checkbox" id='status' name="status" value="1" <?=$data['status']?"checked":""?>>
                <label for="status">Solved</label>
            </div>
            <input class="btn btn-block btn-outline-primary my-5 p-3" type="submit" value="Submit">
            </div>
        </form>

<?php require 'inc/footer.php' ?>