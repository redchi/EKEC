<?php
include_once "LoginView.php";
include_once "ConsoleView.php";
class Controller{
    
    private $lastAccessTime;
    private $isAutorised;
    public $test;
    function __construct() {
        $this->lastAccessTime = time();
        $this->isAutorised = false;
        $this->test = "yee";
    }
    
    public function processLogin($password){
        if ($password == "likliklik4"){
            $this->isAutorised = true;
            gotoView("/console");
        }
        else{
           gotoView("/login");
        }
    }
    
    public function checkAuth(){
        return $this->isAutorised;
    }
    
    public function accessed(){
        $this->lastAccessTime = time();
    }
    
    public function timeout(){
        $currentTime = time();
        $elaped = $currentTime-($this->lastAccessTime);
        $maxMin = 30;
        if(($elaped / 60)>$maxMin){
            return true; 
        }
        return false;
    }
    
    public function displayLoginView(){
        LoginView::draw();
    }
    public function displayConsoleView(){
        ConsoleView::draw();
        
    }
    
    
}