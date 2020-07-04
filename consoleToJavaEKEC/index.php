<?php
session_start();
include_once "./files/Controller.php";
include_once "./files/Api.php";


    define('URL', 'http://ekec.freevar.com');

    $urlParams = $_GET["requestParam"];
    $requests = explode("/", $urlParams);
    $requests = array_map("strtolower", $requests);


    if(!isset($_SESSION['Controller'])){
        $controller = new Controller();       
    }
    else{
        $controller = unserialize($_SESSION['Controller']);
        $controller->accessed();
    }
   
    if(($requests[0]=="login" && count($requests)==1) || count($requests)==0){
        $controller->displayLoginView();
    }
    else if($requests[0]=="console" && count($requests)==1){
        if($controller->checkAuth() == true){
            $controller->displayConsoleView();
        }else{
          gotoView("/login");
           
        }
    }
    else if($requests[0]=="api" && $requests[1]=="sendmsg" &&count($requests)==2){
        
        if($controller->checkAuth()){
            ob_end_clean();
            $cmd = $_POST["command"];
            Api::javaServerConnect($cmd);
        }
        else{
            echo "token timeout please login again";
        }
       
    }
    else if($requests[0]=="ui" && count($requests)==1){
        $password = $_POST["password"];
        $controller->processLogin($password);
    }
    else{
        gotoView("/login");
    }
    
    
    $_POST = array();
  
    
    
    
    
    
    
    
    
    function gotoView($view){
        $controller = $GLOBALS["controller"];
        $_SESSION['Controller'] = serialize($controller);
        header('Location: '.URL.$view);
        exit;
    }
    
    
    
    
    
    
?>