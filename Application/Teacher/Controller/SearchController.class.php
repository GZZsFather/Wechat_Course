<?php
namespace Teacher\Controller;
use Think\Controller;

class SearchController extends Controller{

  public function index(){
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

  public function SearchCourse(){
    $OpenCourse = M("open_course");
    $Student_id = I("session.user_id");
    // $Semester = C('Time_Now');

    $Course_id = I("post.course_id");
    $Teacher_id = I("post.teacher_id");
    $Course_name = I("post.course_name");
    $Teacher_name = I("post.teacher_name");
    $Grades = I("post.grades");
    $Semester = I("post.semester");
    $condition["open_course.xq"]=$Semester;

    if($Course_id){
      $condition["open_course.kh"]=array("like",$Course_id."%");
    }
    if($Teacher_id){
      $condition["open_course.gh"]=$Teacher_id;
    }
    if($Course_name){
      $condition["course.km"]=$Course_name;
    }
    if($Teacher_name){
      $condition["teacher.xm"]=$Teacher_name;
    }
    if($Grades){
      $condition["course.xf"]=$Grades;
    }

    $Day = I("post.day");
    $Begin = I("post.begin");
    $End = I("post.end");

    if($Day != "empty"){
      $query_string = $Day." ";
      if($Begin != "empty" && $End != "empty"){
        $query_string = $query_string.$Begin."-".$End;
      }
      if(($Begin == "empty" && $End != "empty") ||
        ($End == "empty" && $Begin != "empty")){
        $this->error("You can only choose both or neither!");
      }
    }
    else{
      if($Begin != "empty" && $End != "empty"){
        $query_string = "%".$Begin."-".$End;
      }
      if(($Begin == "empty" && $End != "empty") ||
        ($End == "empty" && $Begin != "empty")){
        $this->error("You can only choose both or neither!");
      }
    }

    if($query_string){
      $condition["open_course.sksj"]=array("like",$query_string."%");
    }


    $count = $OpenCourse->where($condition)
    ->join("course on open_course.kh = course.kh")
    ->join("teacher on open_course.gh = teacher.gh")
    ->count();
    $Page = new \Think\Page($count,10);


    $Selected = $OpenCourse->field("open_course.kh,course.km,teacher.xm,teacher.gh,open_course.sksj,course.xf")
      ->where($condition)
      ->join("course on open_course.kh = course.kh")
      ->join("teacher on open_course.gh = teacher.gh")
      ->limit($Page->firstRow.','.$Page->listRows)
      ->select();

    $Show = $Page->show();
    $this->assign('list',$Selected);
    $this->assign('page',$Show);

    $this->assign("count",$query_string);
    // $this->redirect('index', 1);
    $this->display("index");
  }

}
 ?>
