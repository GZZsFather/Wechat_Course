<?php
namespace Student\Controller;
use Think\Controller;

class ScoreController extends Controller{
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

  public function GetScore(){
    $SelectCourse = M("select_course");
    $Student_id = I("session.user_id");
    $Semester = C('Time_Now');

    $Year = I("post.year");
    $Season = I("post.season");

    $query_xq= $Year." ".$Season;

    $condition["select_course.xh"] = $Student_id;
    $condition["select_course.xq"] = $query_xq;

    $list = $SelectCourse->where($condition)
      ->field("select_course.kh,course.km,teacher.xm,select_course.gh,course.xf,select_course.pscj,select_course.kscj,select_course.zpcj")
      ->join("course on select_course.kh = course.kh")
      ->join("teacher on select_course.gh = teacher.gh")
      ->select();
    $this->assign('list',$list);
    $this->display("index");
  }
}
 ?>
