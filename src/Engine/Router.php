<?php

namespace App\Engine;

use App\Controller\UserController;
use App\Controller\AdminController;
require_once __DIR__ . '/traits/Singleton.trait.php';


class Router{
  
  use traits\Singleton;

  private $UserController;

  public function __construct(){
    if(Auth::isLoggedIn()){
      // echo "123";
      $this->UserController = new AdminController();
    }else{
      // echo "345";
      $this->UserController = new UserController();
    }
  }
  public function run(){

    $uriWithQuery = $_SERVER['REQUEST_URI'];
    
    $uriArray = preg_split('~\?~',$uriWithQuery);
    $uri = rtrim($uriArray[0],"/");

    switch($uri){
      case "": 
        $this->UserController->index();break;
      case "/test":
        $this->UserController->test();break;
      case "/create":
        $this->UserController->createTask();break;
      case "/task":
        $this->UserController->getTask();break;
      case "/login":
        $this->UserController->login();break;
      case "/logout":
        $this->UserController->logout();break;
      case "/edit":
        if($this->UserController instanceof AdminController){
          $this->UserController->edit();break;
        }
      default:
        $this->UserController->notFound();break;
    }
    }
 
}
