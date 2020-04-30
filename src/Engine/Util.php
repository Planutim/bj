<?php

namespace App\Engine;


class Util{


  public function getView($viewName,$data=null,$params=null){
    $viewPath = ROOT . 'View/'. $viewName . '.php';
    if(is_file($viewPath))
      require $viewPath;
    else
    {
      echo 'Something\'s wrong!'; 
      exit();
    }
  }
  public function validate($post_data){
    
    return $post_data;
  }
}