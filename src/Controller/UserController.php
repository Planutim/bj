<?php

namespace App\Controller;

use App\Engine\Util;
use App\Model\Task;
use App\Engine\Auth;

class UserController{
    protected $util, $task;
    

    public function __construct(){
        $this->util = new Util();
        $this->task = new Task();
    }

    public function index(){
        $this->getAllTasks();
    }

    public function createTask(){
        if($_SERVER['REQUEST_METHOD']==='POST'){
            $data = $this->util->validate($_POST);
            $success=$this->task->create(
                $data['username'],
                $data['email'],
                $data['textbody']
            );
            $this->notify($success);
        }else{
            return $this->util->getView('create');
        }
        
    }
    public function getTask(){
        if(isset($_GET['id'])){
            $id = intval($_GET['id']);
            if($id){
                $result=$this->task->getTask($id);
                if($result){
                    return $this->util->getView('task',$result);
                }
            }
        }
        return $this->notFound();
    }
    public function getAllTasks(){
        $page=1;
        $orderby=isset($_GET['orderby'])?$_GET['orderby']:null;
        $sort=isset($_GET['sort'])?$_GET['sort']:null;
        if(isset($_GET['page'])){
            $temp = intval($_GET['page']);
            if($temp && $temp>1){
                $page=$temp;
            }
        }

        $offset=($page-1)*3;
        $tasks=$this->task->getAllOffset($offset,$orderby,$sort);

        $params = [];
        if(count($tasks)==3){
            $params['next']=$page+1;
        }
        if($page>1)
            $params['prev']=$page-1;
        return $this->util->getView('index',$tasks, $params);
    }

    public function notify($success){
        $_SESSION['flash']=$success?"success":"failure";
        header("Location: /");
    }

    public function test(){
        return $this->util->getView('test');
    }
    public function notFound(){
        return $this->util->getView('notFound');
    }
    
    public function error(){
        return $this->util->getView('error');
    }

    public function login(){
        if(isset($_POST)&&isset($_POST['username'])&&isset($_POST['password'])){

            if(Auth::login($_POST['username'], $_POST['password'])){
                $_SESSION['flash']='success';
                header("Location: /");
            }else{
                $_SESSION['flash']='failure';
                return $this->util->getView('login');
            }
        }else{
            
            return $this->util->getView('login');
        }
    }
}