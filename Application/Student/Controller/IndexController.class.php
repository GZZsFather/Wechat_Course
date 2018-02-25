<?php
namespace Student\Controller;
use Think\Controller;
class IndexController extends Controller {
    public function index(){
      $Occupation = I("session.occupation");
      if(!$Occupation){
        $this->error("Log in first!");
      }
      if($Occupation != "Student"){
        if($Occupation == "Admin"){
          $this->error("This page is only available for Student!",U("/Admin"));
        }
        else{
          $this->error("This page is only available for Student!",U("/Teacher"));
        }
      }
      $this->display();
    }
}
