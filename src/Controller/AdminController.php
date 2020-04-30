<?php

namespace App\Controller;

use App\Model\Task;
use App\Engine\Util;
use App\Engine\Auth;
use App\Controller\UserController;

class AdminController extends UserController{
    public function __construct(){
        parent::__construct();
    }
    public function logout(){
        Auth::destroy();
        header("Location: /");
    }

    public function edit(){
        if(isset($_POST['id'])){
            $data = $this->util->validate($_POST);
            if($this->task->editTask(
                $data['id'],
                $data['username'],
                $data['email'],
                $data['textbody'],
                $data['status']
            )){
                header("Location: /");
            }else{
                $_SESSION['flash']='failure';
                return $this->util->getView('edit',$data);
            }
        }else{
            $id= intval(isset($_GET['task'])?$_GET['task']:0);
            if(!$id)
                return $this->notFound();
            $task = $this->task->getTask($id);
            return $this->util->getView('edit',$task);
        }
       
    }
}