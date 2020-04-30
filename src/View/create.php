<?php require_once 'inc/header.php' ?>

        <form class='form w-50 m-auto' method="POST" action="/create">
            <div class='form-group'>
                <label for="username">Username</label>
                <input class='form-control' type="text" id='username' name="username" maxlength="30" required>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input class='form-control' type="email" id='email' name="email" maxlength="64" required>
            </div>
            <div class="form-group">
                <label for="textbody">TextBody</label>
                <textarea class='form-control' rows="10" id='textbody' name="textbody" required></textarea>
            </div>
            <input class='mt-3 btn btn-primary btn-block' type="submit" value="Submit">
        </form>

        <script>
            // document.addEventListener('DOMContentLoaded', function(){
            //     username.value = 'user'
            //     email.value='test@test.test'
            //     textbody.textContent='This is body text'
            // })
        </script>

<?php require_once 'inc/footer.php' ?>