<?php
namespace Teacher\Controller;
use Think\Controller;
class IndexController extends Controller {
    public function index(){
      // $this->show("Hello world");
      $Occupation = I("session.occupation");
      if(!$Occupation){
        $this->error("Log in first!");
      }
      if($Occupation == "Student"){
        $this->error("This page is only available for teachers!",U("/Student"));
      }
      if($Occupation == "Admin"){
        $this->error("This page is only available for teachers!",U("/Admin"));
      }
      $this->display();
    }
}
