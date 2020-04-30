<?php require_once 'inc/header.php' ?>
    <div class="task-info d-flex justify-content-around">
       <div>
         <p class="lead">Author</p>
         <p class="h3"><?=htmlspecialchars($data['username'])?></p>
       </div>
       <div>
         <p class="lead">Email</p>
         <p class="h3"><?=htmlspecialchars($data['email'])?></p>
       </div>
       <div>
         <p class="lead">Status</p>
         <p class="h3"><?=htmlspecialchars($data['status'])=="1"?"Solved":"Not Solved"?></p>
       </div>
    </div>

    <?php if(isset($_SESSION['UID'])): ?>
        <a class="my-3 btn btn-outline-primary btn-block" href="/edit?task=<?=$data['id']?>">Edit</a>
    <?php else: ?>
        <div class="my-5"></div>
    <?php endif ?>


    <div class="task-body">
        <p class="lead">Text</p>
        <hr>
        <p class="h6"><?=htmlspecialchars($data['textbody'])?></p>
    </div>
<?php require_once 'inc/footer.php' ?>
<!-- <ul class="my-5 list-group">
        <li class="list-group-item"><span><?=htmlspecialchars($data['username'])?></span></li>
        <li class="list-group-item"><span><?=htmlspecialchars($data['email'])?></span></li>
        <li class="list-group-item"><span><?=htmlspecialchars($data['textbody'])?></span></li>
        <li class="list-group-item"><span><?=!$data['status']?"Solved":"Not solved"?></span></li>
    </ul> -->