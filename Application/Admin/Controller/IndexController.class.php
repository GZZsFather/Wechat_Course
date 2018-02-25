<?php
namespace Admin\Controller;
use Think\Controller;
class IndexController extends Controller {
    public function index(){
      // $this->show("Hello world");
      $Occupation = I("session.occupation");
      $Semester = C('Time_Now');
      if(!$Occupation){
        $this->error("Log in first!");
      }
      if($Occupation != "Admin"){
        if($Occupation == "Student"){
          $this->error("This page is only available for Admin!",U("/Student"));
        }
        else{
          $this->error("This page is only available for Admin!",U("/Teacher"));
        }
      }
      $this->display();
    }
}
