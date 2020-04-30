<?php require_once 'inc/header.php'
?>
        <?php if(isset($_SESSION['flash'])):?>
        <div class="m-auto mb-3 alert alert-<?=$_SESSION['flash']=='success'?'success':'warning'?>"><?=$_SESSION['flash']?>!</div>
        <?php unset($_SESSION['flash'])?>
        <?php endif ?>
        
        <br>

        <ul class="pagination d-flex justify-content-center">
            <!-- <li class="page-item disabled"><?=isset($params['prev'])?$params['prev']+1:""?></li> -->
            <li style="width: 13%;" class="page-item mx-3 <?=(isset($params)&&isset($params['prev']))?'':'disabled'?>">
                <a class="page-link" data-page="<?=isset($params['prev'])?$params['prev']:""?>" href="" onclick="setPage(this)"><<</a>
            </li>
            <li style="width: 13%;" class="page-item mx-3 <?=(isset($params)&&isset($params['next']))?'':'disabled'?>">
            <a class="page-link" data-page="<?=isset($params['next'])?$params['next']:""?>" href="" onclick="setPage(this)">>></a>
            </li>
            <!-- <li class="page-item disabled"><?=isset($params['next'])?$params['next']+1:""?></li> -->
        </ul>
        
        <?php if (isset($data)): ?>
        <table class="table table-bordered" style="">
            <tr>
                <th scope="col"><a id="username" href="?orderby=username&sort=asc" onclick="setOrder(this)">Username</a></th>
                <th scope="col"><a id="email" href="?orderby=email&sort=asc" onclick="setOrder(this)">Email</a></th>
                <th scope="col"><a id="textbody" href="?orderby=textbody&sort=asc" onclick="setOrder(this)">Body</a></th>
                <th scope="col"><a id="status" href="?orderby=status&sort=asc" onclick="setOrder(this)">Status</a></th>
            </tr>
            <?php foreach($data as $field): ?>
                <tr class="clickable" onclick="location.href='/task?id=<?=$field['id']?>'">
                    <td class="w-25"><?=htmlspecialchars(substr($field['username'],0,16))?></td>
                    <td class="w-25"><?=htmlspecialchars(substr($field['email'],0,16))?></td>
                    <td class="w-25"><?=htmlspecialchars(substr($field['textbody'],0,16))?></td>
                    <td class="w-25 <?=htmlspecialchars($field['status'])==1?'bg-success':'bg-secondary'?>"><?=htmlspecialchars($field['status'])==1?"Solved":"Not solved"?></td>
                </tr>
            <?php endforeach?>
            
        </table>
        <?php endif?>

        <script>
            function setOrder(e){  
                let url = new URL(window.location.href);
                let params = url.searchParams;
                if(params.get('orderby')){
                    if(params.get('orderby')===e.id){
                        switch(params.get('sort')){
                            case 'asc':
                                params.set('sort','desc');break;
                            case 'desc':
                                params.set('sort','asc');break;
                        }
                        e.href=url.toString();
                    }
                }
                
            }

            function setPage(e){
                let url = new URL(window.location.href);
                let params = url.searchParams;
                params.set("page", e.dataset.page)
                e.href = url.toString();
            }
        </script>
<?php require_once 'inc/footer.php'?>